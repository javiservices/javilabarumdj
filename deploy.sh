#!/bin/bash

# Script de deployment para Javi Labarum DJ via Git
# Uso: ./deploy.sh

set -e

echo "🚀 Iniciando deployment de Javi Labarum DJ..."

# Colores para output
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
NC='\033[0m' # No Color

# Variables
SERVER="157.180.77.232"
USER="root"
REMOTE_PATH="/var/www/javilabarumdj"
DOMAIN="javilabarumdj.com"
GIT_REPO="https://github.com/javiservices/javilabarumdj.git"
BRANCH="main"

# Verificar si estamos en un repo git
if [ ! -d .git ]; then
    echo -e "${RED}❌ Error: No estás en un repositorio Git${NC}"
    echo "Inicializa git primero: git init && git add . && git commit -m 'Initial commit'"
    exit 1
fi

echo -e "${YELLOW}📤 Verificando cambios locales...${NC}"

# Verificar que no haya cambios sin commitear
if ! git diff-index --quiet HEAD --; then
    echo -e "${RED}⚠️  Tienes cambios sin commitear${NC}"
    read -p "¿Quieres hacer commit ahora? (s/n): " -n 1 -r
    echo
    if [[ $REPLY =~ ^[Ss]$ ]]; then
        git add .
        read -p "Mensaje del commit: " commit_msg
        git commit -m "$commit_msg"
        git push origin $BRANCH
    else
        echo "Por favor, haz commit de tus cambios antes de desplegar"
        exit 1
    fi
else
    echo -e "${GREEN}✓ Cambios locales sincronizados${NC}"
    echo -e "${YELLOW}Pusheando cambios...${NC}"
    git push origin $BRANCH
fi

echo -e "${YELLOW}🔧 Preparando servidor...${NC}"

# Conectar y preparar servidor
ssh $USER@$SERVER << ENDSSH
    # Instalar Git si no está
    if ! command -v git &> /dev/null; then
        echo "Instalando Git..."
        apt update && apt install -y git
    fi
    
    # Instalar Docker y Docker Compose si no están instalados
    if ! command -v docker &> /dev/null; then
        echo "Instalando Docker..."
        curl -fsSL https://get.docker.com -o get-docker.sh
        sh get-docker.sh
        rm get-docker.sh
    fi
    
    if ! command -v docker-compose &> /dev/null; then
        echo "Instalando Docker Compose..."
        curl -L "https://github.com/docker/compose/releases/latest/download/docker-compose-\$(uname -s)-\$(uname -m)" -o /usr/local/bin/docker-compose
        chmod +x /usr/local/bin/docker-compose
    fi
ENDSSH

echo -e "${GREEN}✓ Servidor preparado${NC}"

# Desplegar en servidor
ssh $USER@$SERVER << ENDSSH
    # Si el directorio no existe, clonar el repo
    if [ ! -d "$REMOTE_PATH" ]; then
        echo "📥 Clonando repositorio..."
        git clone -b $BRANCH $GIT_REPO $REMOTE_PATH
    fi
    
    cd $REMOTE_PATH
    
    echo "🔄 Actualizando código..."
    git fetch origin
    git reset --hard origin/$BRANCH
    git clean -fd
    
    echo "🔧 Configurando .env..."
    if [ ! -f .env ]; then
        cp .env.production .env
        echo "⚠️  IMPORTANTE: Configura las variables en .env antes de continuar"
        nano .env
    fi
    
    echo "🔑 Generando APP_KEY..."
    docker run --rm -v \$(pwd):/app -w /app php:8.1-cli php artisan key:generate --force
    
    echo "📦 Construyendo contenedores..."
    docker-compose -f docker-compose.prod.yml up -d --build
    
    echo "⏳ Esperando que los servicios inicien..."
    sleep 10
    
    echo "🗄️ Ejecutando migraciones..."
    docker-compose -f docker-compose.prod.yml exec -T app php artisan migrate --force
    
    echo "🔗 Creando enlace de storage..."
    docker-compose -f docker-compose.prod.yml exec -T app php artisan storage:link
    
    echo "⚡ Optimizando aplicación..."
    docker-compose -f docker-compose.prod.yml exec -T app php artisan config:cache
    docker-compose -f docker-compose.prod.yml exec -T app php artisan route:cache
    docker-compose -f docker-compose.prod.yml exec -T app php artisan view:cache
    
    echo "🔐 Configurando permisos..."
    docker-compose -f docker-compose.prod.yml exec -T app chown -R www-data:www-data /var/www/storage
    docker-compose -f docker-compose.prod.yml exec -T app chown -R www-data:www-data /var/www/bootstrap/cache
    
    echo "✅ Deployment completado!"
    echo ""
    echo "📊 Estado de los contenedores:"
    docker-compose -f docker-compose.prod.yml ps
ENDSSH

# Limpiar archivo temporal
rm app.tar.gz

echo ""
echo -e "${GREEN}🎉 Deployment completado exitosamente!${NC}"
echo ""
echo -e "${YELLOW}📝 Próximos pasos:${NC}"
echo "1. Configurar dominio $DOMAIN apuntando a $SERVER"
echo "2. Configurar Nginx Proxy Manager para SSL"
echo "3. Acceder a http://$SERVER:8001 para verificar"
echo ""
echo -e "${YELLOW}🔧 Comandos útiles:${NC}"
echo "  Ver logs:      ssh $USER@$SERVER 'cd $REMOTE_PATH && docker-compose -f docker-compose.prod.yml logs -f'"
echo "  Reiniciar:     ssh $USER@$SERVER 'cd $REMOTE_PATH && docker-compose -f docker-compose.prod.yml restart'"
echo "  Actualizar:    ./deploy.sh"
echo ""
