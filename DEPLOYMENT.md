# 🚀 Guía de Deployment - Javi Labarum DJ

## 📋 Pre-requisitos

1. **Acceso SSH al servidor**
   ```bash
   ssh root@157.180.77.232
   ```

2. **Dominio configurado** (opcional para empezar)
   - javilabarumdj.com → 157.180.77.232

## 🎯 Deployment Automático

### Paso 1: Configurar Credenciales

Edita `.env.production` y cambia:
```bash
DB_PASSWORD=TU_PASSWORD_SEGURO_AQUI
DB_ROOT_PASSWORD=TU_ROOT_PASSWORD_AQUI
```

### Paso 2: Ejecutar Deployment

```bash
./deploy.sh
```

El script hará automáticamente:
- ✅ Comprimir archivos
- ✅ Subir al servidor
- ✅ Instalar Docker (si no está)
- ✅ Construir contenedores
- ✅ Ejecutar migraciones
- ✅ Optimizar caché
- ✅ Configurar permisos

## 🔧 Deployment Manual

Si prefieres hacerlo paso a paso:

### 1. En tu máquina local

```bash
# Comprimir proyecto
tar -czf app.tar.gz \
    --exclude='node_modules' \
    --exclude='vendor' \
    --exclude='.git' \
    --exclude='storage/logs/*' \
    --exclude='.env' \
    .

# Subir al servidor
scp app.tar.gz root@157.180.77.232:/var/www/javilabarumdj/
```

### 2. En el servidor

```bash
# Conectar al servidor
ssh root@157.180.77.232

# Crear directorio
mkdir -p /var/www/javilabarumdj
cd /var/www/javilabarumdj

# Extraer archivos
tar -xzf app.tar.gz
rm app.tar.gz

# Configurar .env
cp .env.production .env
nano .env  # Editar passwords

# Generar APP_KEY
docker run --rm -v $(pwd):/app -w /app php:8.1-cli php -r "echo 'base64:' . base64_encode(random_bytes(32)) . PHP_EOL;"
# Copiar el resultado a .env como APP_KEY=

# Levantar contenedores
docker-compose -f docker-compose.prod.yml up -d --build

# Esperar 10 segundos
sleep 10

# Migraciones
docker-compose -f docker-compose.prod.yml exec app php artisan migrate --force

# Storage link
docker-compose -f docker-compose.prod.yml exec app php artisan storage:link

# Optimizar
docker-compose -f docker-compose.prod.yml exec app php artisan config:cache
docker-compose -f docker-compose.prod.yml exec app php artisan route:cache
docker-compose -f docker-compose.prod.yml exec app php artisan view:cache

# Permisos
docker-compose -f docker-compose.prod.yml exec app chown -R www-data:www-data /var/www/storage
docker-compose -f docker-compose.prod.yml exec app chown -R www-data:www-data /var/www/bootstrap/cache
```

## 🌐 Configurar Nginx Proxy Manager

### Opción A: Con Nginx Proxy Manager (Recomendado)

1. **Instalar Nginx Proxy Manager**
```bash
cd /root
mkdir nginx-proxy-manager
cd nginx-proxy-manager

cat > docker-compose.yml << 'EOF'
version: '3'
services:
  app:
    image: jc21/nginx-proxy-manager:latest
    restart: unless-stopped
    ports:
      - '80:80'
      - '443:443'
      - '81:81'
    volumes:
      - ./data:/data
      - ./letsencrypt:/etc/letsencrypt
EOF

docker-compose up -d
```

2. **Acceder a panel**
   - URL: `http://157.180.77.232:81`
   - Email: `admin@example.com`
   - Password: `changeme`

3. **Crear Proxy Host**
   - Domain: `javilabarumdj.com`
   - Scheme: `http`
   - Forward Hostname: `javilabarum_web` o `172.17.0.1`
   - Forward Port: `8001`
   - SSL: ✅ Request SSL Certificate

### Opción B: Nginx Directo

```bash
# Instalar nginx
apt update && apt install nginx -y

# Crear configuración
cat > /etc/nginx/sites-available/javilabarumdj << 'EOF'
server {
    listen 80;
    server_name javilabarumdj.com www.javilabarumdj.com;

    location / {
        proxy_pass http://localhost:8001;
        proxy_set_header Host $host;
        proxy_set_header X-Real-IP $remote_addr;
        proxy_set_header X-Forwarded-For $proxy_add_x_forwarded_for;
        proxy_set_header X-Forwarded-Proto $scheme;
    }
}
EOF

# Activar sitio
ln -s /etc/nginx/sites-available/javilabarumdj /etc/nginx/sites-enabled/
nginx -t
systemctl reload nginx

# Instalar SSL con Certbot
apt install certbot python3-certbot-nginx -y
certbot --nginx -d javilabarumdj.com -d www.javilabarumdj.com
```

## 🔍 Verificación

1. **Verificar contenedores**
```bash
docker-compose -f docker-compose.prod.yml ps
```

2. **Ver logs**
```bash
docker-compose -f docker-compose.prod.yml logs -f app
```

3. **Acceder temporalmente**
```bash
http://157.180.77.232:8001
```

## 🗂️ Subir Archivos Adicionales

### Logo y Assets
```bash
# Desde tu máquina local
scp public/logo_white.png root@157.180.77.232:/var/www/javilabarumdj/public/
scp public/favicon.ico root@157.180.77.232:/var/www/javilabarumdj/public/
```

### Credenciales de Google Calendar
```bash
scp storage/app/google-calendar/credentials.json root@157.180.77.232:/var/www/javilabarumdj/storage/app/google-calendar/

# En el servidor, configurar permisos
ssh root@157.180.77.232
cd /var/www/javilabarumdj
docker-compose -f docker-compose.prod.yml exec app chown -R www-data:www-data storage/app/google-calendar
docker-compose -f docker-compose.prod.yml exec app chmod 600 storage/app/google-calendar/credentials.json
```

## 🔄 Actualizar Aplicación

```bash
# Simplemente ejecuta de nuevo
./deploy.sh
```

O manualmente:
```bash
ssh root@157.180.77.232
cd /var/www/javilabarumdj
git pull  # Si usas git
docker-compose -f docker-compose.prod.yml up -d --build
docker-compose -f docker-compose.prod.yml exec app php artisan migrate --force
docker-compose -f docker-compose.prod.yml exec app php artisan config:cache
docker-compose -f docker-compose.prod.yml exec app php artisan route:cache
docker-compose -f docker-compose.prod.yml exec app php artisan view:cache
```

## 🛠️ Comandos Útiles

```bash
# Ver estado
docker-compose -f docker-compose.prod.yml ps

# Logs en tiempo real
docker-compose -f docker-compose.prod.yml logs -f

# Reiniciar
docker-compose -f docker-compose.prod.yml restart

# Parar
docker-compose -f docker-compose.prod.yml down

# Entrar al contenedor
docker-compose -f docker-compose.prod.yml exec app bash

# Limpiar caché
docker-compose -f docker-compose.prod.yml exec app php artisan cache:clear
docker-compose -f docker-compose.prod.yml exec app php artisan config:clear
docker-compose -f docker-compose.prod.yml exec app php artisan route:clear
docker-compose -f docker-compose.prod.yml exec app php artisan view:clear

# Backup de base de datos
docker-compose -f docker-compose.prod.yml exec db mysqldump -u javilabarum -p javilabarum_dj > backup_$(date +%Y%m%d).sql
```

## 🔐 Seguridad

1. **Cambiar passwords por defecto** en `.env`
2. **Firewall básico**
```bash
ufw allow 22
ufw allow 80
ufw allow 443
ufw allow 81  # Solo si usas Nginx Proxy Manager
ufw enable
```

3. **Cerrar puerto 8001 al público** (solo accesible via nginx)
```bash
# Si NO usas Nginx Proxy Manager, cierra el puerto
# Ya que nginx hará el proxy internamente
```

## 📊 Monitoreo

```bash
# Recursos del servidor
htop

# Recursos de Docker
docker stats

# Logs de errores Laravel
docker-compose -f docker-compose.prod.yml exec app tail -f storage/logs/laravel.log
```

## ⚠️ Troubleshooting

### Error: "Permission denied"
```bash
docker-compose -f docker-compose.prod.yml exec app chown -R www-data:www-data storage bootstrap/cache
docker-compose -f docker-compose.prod.yml exec app chmod -R 775 storage bootstrap/cache
```

### Error: "Database connection refused"
```bash
# Verificar que la base de datos esté corriendo
docker-compose -f docker-compose.prod.yml ps db

# Ver logs
docker-compose -f docker-compose.prod.yml logs db
```

### Error 500
```bash
# Ver logs
docker-compose -f docker-compose.prod.yml logs app

# Limpiar caché
docker-compose -f docker-compose.prod.yml exec app php artisan cache:clear
docker-compose -f docker-compose.prod.yml exec app php artisan config:clear
```

## 📞 Soporte

Si algo falla, revisa:
1. Logs: `docker-compose logs -f`
2. Permisos de storage
3. Variables de .env correctas
4. Contenedores corriendo: `docker-compose ps`
