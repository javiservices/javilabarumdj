# 🚀 Deployment con Git - Javi Labarum DJ

## 📋 Setup Inicial (Solo la primera vez)

### 1. Inicializar Git (si no lo has hecho)

```bash
# Inicializar repositorio
git init

# Añadir archivos
git add .

# Primer commit
git commit -m "Initial commit - Javi Labarum DJ website"

# Crear repo en GitHub/GitLab y conectar
git remote add origin git@github.com:TU_USUARIO/javilabarumdj.git
git branch -M main
git push -u origin main
```

### 2. Configurar Deploy Key en Servidor

Para que el servidor pueda clonar el repo sin password:

```bash
# En el servidor
ssh root@157.180.77.232

# Generar SSH key
ssh-keygen -t ed25519 -C "deploy@javilabarumdj"
# Presiona Enter 3 veces (sin passphrase)

# Ver la clave pública
cat ~/.ssh/id_ed25519.pub
```

**Copia la clave pública y agrégala:**
- **GitHub**: Settings → Deploy keys → Add deploy key
- **GitLab**: Settings → Repository → Deploy keys → Add key

### 3. Editar Script de Deployment

```bash
nano deploy.sh
```

Cambia esta línea:
```bash
GIT_REPO="git@github.com:TU_USUARIO/javilabarumdj.git"
```

## 🚀 Deployment (Cada actualización)

### Opción 1: Automático

```bash
# El script hace commit, push y deployment automáticamente
./deploy.sh
```

### Opción 2: Manual

```bash
# 1. Commit tus cambios
git add .
git commit -m "Update: descripción de los cambios"
git push origin main

# 2. Desplegar en servidor
ssh root@157.180.77.232
cd /var/www/javilabarumdj

# Actualizar código
git pull origin main

# Reconstruir contenedores
docker-compose -f docker-compose.prod.yml up -d --build

# Migraciones (si hay nuevas)
docker-compose -f docker-compose.prod.yml exec app php artisan migrate --force

# Limpiar y regenerar caché
docker-compose -f docker-compose.prod.yml exec app php artisan config:clear
docker-compose -f docker-compose.prod.yml exec app php artisan config:cache
docker-compose -f docker-compose.prod.yml exec app php artisan route:cache
docker-compose -f docker-compose.prod.yml exec app php artisan view:cache
```

## 📦 Archivos Importantes

### ⚠️ Archivos que NO se suben a Git (.gitignore)
- `.env` (variables de entorno con passwords)
- `.env.production`
- `storage/app/google-calendar/credentials.json`
- `/vendor` (se instala con composer)
- `/node_modules`
- Logs y caché

### ✅ Archivos que SÍ se suben
- Todo el código fuente
- `docker-compose.prod.yml`
- `.env.example` (plantilla sin datos sensibles)
- Scripts de deployment
- Assets públicos (logo, favicon)

## 🔐 Configurar .env en Servidor

**Primera vez:**
```bash
ssh root@157.180.77.232
cd /var/www/javilabarumdj

# Copiar ejemplo
cp .env.example .env

# Editar con tus datos reales
nano .env
```

Cambiar:
- `DB_PASSWORD=` → password seguro
- `DB_ROOT_PASSWORD=` → otro password seguro
- `APP_URL=https://javilabarumdj.com`

Generar APP_KEY:
```bash
docker-compose -f docker-compose.prod.yml exec app php artisan key:generate
```

## 📤 Subir Archivos Sensibles Manualmente

### Logo y Assets
```bash
scp public/logo_white.png root@157.180.77.232:/var/www/javilabarumdj/public/
scp public/favicon.ico root@157.180.77.232:/var/www/javilabarumdj/public/
```

### Credenciales de Google Calendar
```bash
scp storage/app/google-calendar/credentials.json root@157.180.77.232:/var/www/javilabarumdj/storage/app/google-calendar/

# Configurar permisos
ssh root@157.180.77.232
cd /var/www/javilabarumdj
docker-compose -f docker-compose.prod.yml exec app chown www-data:www-data storage/app/google-calendar/credentials.json
docker-compose -f docker-compose.prod.yml exec app chmod 600 storage/app/google-calendar/credentials.json
```

## 🔄 Workflow de Desarrollo

```
Local Development → Commit → Push → Deploy al Servidor
      ↓                ↓        ↓            ↓
  localhost:8000    Git Add   GitHub    157.180.77.232
```

### Pasos recomendados:

1. **Desarrollar localmente**
   ```bash
   docker compose up -d
   # Hacer cambios, probar en localhost:8000
   ```

2. **Commitear cambios**
   ```bash
   git add .
   git commit -m "Feature: descripción clara"
   git push origin main
   ```

3. **Desplegar**
   ```bash
   ./deploy.sh
   # O manualmente: ssh + git pull + docker-compose up
   ```

## 🌿 Branches (Opcional pero recomendado)

```bash
# Crear branch para desarrollo
git checkout -b desarrollo

# Hacer cambios
git add .
git commit -m "Working on new feature"
git push origin desarrollo

# Cuando esté listo, merge a main
git checkout main
git merge desarrollo
git push origin main

# Desplegar main
./deploy.sh
```

## 🔍 Ventajas de Git vs SCP

| Git | SCP/Tarball |
|-----|-------------|
| ✅ Historial completo | ❌ Sin historial |
| ✅ Rollback fácil | ❌ Rollback manual |
| ✅ Solo actualiza cambios | ❌ Copia todo siempre |
| ✅ Branches para testing | ❌ Sin branches |
| ✅ Colaboración fácil | ❌ Complicado |
| ✅ Backup automático | ❌ Sin backup |

## 🔧 Rollback (Volver a Versión Anterior)

Si algo sale mal:

```bash
ssh root@157.180.77.232
cd /var/www/javilabarumdj

# Ver commits recientes
git log --oneline -10

# Volver a un commit específico
git reset --hard abc1234

# Reconstruir
docker-compose -f docker-compose.prod.yml up -d --build
```

## 🛠️ Comandos Git Útiles

```bash
# Ver estado
git status

# Ver diferencias
git diff

# Ver historial
git log --oneline

# Ver ramas
git branch -a

# Descartar cambios locales
git reset --hard HEAD

# Actualizar desde remoto
git pull origin main

# Ver qué archivos se ignorarán
git status --ignored
```

## 📊 Workflow Completo Ejemplo

```bash
# 1. Desarrollo local
cd ~/proyectos/javilabarumdj
# ... hacer cambios ...

# 2. Probar localmente
docker compose up -d
# Verificar en localhost:8000

# 3. Commit
git add .
git commit -m "Feature: Agregado sistema de reservas"

# 4. Push
git push origin main

# 5. Deploy automático
./deploy.sh

# 6. Verificar
# Esperar 30 segundos
# Abrir https://javilabarumdj.com
```

## ⚠️ Notas Importantes

1. **Nunca subas .env al repositorio** - Contiene passwords
2. **Usa .env.example** - Template sin datos sensibles
3. **Credenciales de Google** - Súbelas manualmente por SCP
4. **Assets grandes** - Considera usar Git LFS si subes muchas imágenes
5. **Composer install** - Se ejecuta en el Dockerfile, no commitees `/vendor`

## 🚨 Troubleshooting

### Error: "Permission denied (publickey)"
```bash
# Verificar que la deploy key esté agregada en GitHub/GitLab
# Y que la SSH key del servidor sea correcta
ssh -T git@github.com
```

### Error: "Could not resolve host"
```bash
# Verificar conectividad
ping github.com
```

### Error: "Changes not showing"
```bash
# Limpiar caché de Docker
docker-compose -f docker-compose.prod.yml down
docker system prune -a
docker-compose -f docker-compose.prod.yml up -d --build
```
