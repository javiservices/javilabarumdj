# 🎵 Javi La Barum DJ - Sitio Web Profesional

Sitio web profesional para DJ con gestión de eventos, sincronización con Google Calendar y página de enlaces estilo Linktree.

## ✨ Características

### 🎪 Gestión de Eventos
- CRUD completo de eventos
- Vista de calendario interactivo con FullCalendar.js
- Sincronización bidireccional con Google Calendar
- Diseño moderno y responsive
- Sistema de imágenes para eventos

### 🔗 Página de Links (Linktree Style)
- Gestión de redes sociales
- Página pública con todos tus enlaces
- Diseño minimalista y profesional
- Ordenamiento personalizable
- Iconos de Font Awesome

### 📅 Integración con Google Calendar
- Sincronización automática de eventos
- Importación de eventos desde Google Calendar
- Actualización bidireccional
- Autenticación OAuth2

### 🎨 Diseño Moderno
- Gradientes purple/indigo profesionales
- Animaciones suaves y atractivas
- Totalmente responsive
- Fuentes modernas (Montserrat, Poppins)
- Efectos hover y transiciones

## 🚀 Instalación

### Requisitos
- Docker y Docker Compose
- PHP 8.1+
- MySQL 8.0+
- Composer

### Pasos de Instalación

1. **Clonar el repositorio**
```bash
git clone <tu-repositorio>
cd javilabarumdj
```

2. **Levantar contenedores Docker**
```bash
docker compose up -d
```

3. **Instalar dependencias**
```bash
docker compose exec app composer install
```

4. **Copiar archivo de configuración**
```bash
cp .env.example .env
```

5. **Generar key de aplicación**
```bash
docker compose exec app php artisan key:generate
```

6. **Ejecutar migraciones**
```bash
docker compose exec app php artisan migrate
```

7. **Crear enlace simbólico para storage**
```bash
docker compose exec app php artisan storage:link
```

## 🔧 Configuración de Google Calendar

### Paso 1: Crear Proyecto en Google Cloud Console

1. Ve a [Google Cloud Console](https://console.cloud.google.com/)
2. Crea un nuevo proyecto o selecciona uno existente
3. Habilita la API de Google Calendar:
   - Ve a "APIs & Services" > "Library"
   - Busca "Google Calendar API"
   - Haz clic en "Enable"

### Paso 2: Crear Credenciales OAuth 2.0

1. Ve a "APIs & Services" > "Credentials"
2. Haz clic en "Create Credentials" > "OAuth client ID"
3. Si es necesario, configura la pantalla de consentimiento:
   - Tipo: Externa
   - Nombre de la aplicación: "Javi Labarum DJ"
   - Correo de soporte: tu email
   - Alcances: Google Calendar API
4. Crear OAuth client ID:
   - Tipo de aplicación: "Web application"
   - Nombre: "DJ Website"
   - **Orígenes de JavaScript autorizados** (sin rutas):
     - `http://localhost:8000`
     - `http://tu-dominio.com`
   - **URIs de redirección autorizados** (con rutas completas):
     - `http://localhost:8000/google/callback`
     - `http://tu-dominio.com/google/callback`
5. Descarga el archivo JSON de credenciales

### Paso 3: Configurar Credenciales en la Aplicación

1. Crea el directorio de Google Calendar:
```bash
mkdir -p storage/app/google-calendar
```

2. Copia el archivo de credenciales descargado:
```bash
cp /path/to/credentials.json storage/app/google-calendar/credentials.json
```

3. Asegúrate de que el archivo tenga los permisos correctos:
```bash
chmod 600 storage/app/google-calendar/credentials.json
```

### Paso 4: Conectar Google Calendar

1. Accede a tu aplicación web
2. Ve a la sección de Eventos
3. Haz clic en "Conectar Google Calendar"
4. Autoriza la aplicación en Google
5. ¡Listo! Ahora tus eventos se sincronizarán automáticamente

## 📱 Uso

### Gestionar Redes Sociales

1. Ve a `/social-links` para administrar tus redes sociales
2. Agrega tus plataformas (Instagram, Spotify, SoundCloud, etc.)
3. Configura el orden de aparición
4. Previsualiza en `/links`

### Gestionar Eventos

1. Ve a `/events` para ver todos los eventos
2. Crea nuevos eventos con fecha, ubicación e imagen
3. Los eventos se sincronizan automáticamente con Google Calendar
4. Vista de calendario disponible en `/calendar`

### Página Pública de Links

- Comparte `/links` en tus redes sociales
- Diseño similar a Linktree
- Todos tus enlaces en un solo lugar

## 🎨 Personalización

### Colores y Estilos

Los colores principales se pueden modificar en `resources/views/layouts/app.blade.php`:
- Gradiente principal: `from-purple-500 to-indigo-600`
- Colores de acento: purple-600, indigo-600

### Contenido de la Página Principal

Edita `resources/views/welcome.blade.php` para personalizar:
- Biografía
- Estadísticas
- Secciones adicionales

## 🌐 Rutas Principales

- `/` - Página de inicio
- `/events` - Lista de eventos
- `/calendar` - Vista de calendario
- `/links` - Página pública de enlaces
- `/social-links` - Administración de redes sociales
- `/google/auth` - Conectar Google Calendar

## 🔐 Seguridad

**Importante:** Nunca subas a git:
- `storage/app/google-calendar/credentials.json`
- `storage/app/google-calendar/token.json`
- `.env`

Estos archivos están en `.gitignore` por defecto.

## 📦 Tecnologías Utilizadas

- **Backend:** Laravel 10.x
- **Frontend:** Tailwind CSS
- **Calendario:** FullCalendar.js
- **Iconos:** Font Awesome 6
- **API:** Google Calendar API
- **Base de datos:** MySQL 8.0
- **Contenedores:** Docker

## 🤝 Contribuir

Las contribuciones son bienvenidas. Por favor:

1. Fork el proyecto
2. Crea una rama para tu feature (`git checkout -b feature/AmazingFeature`)
3. Commit tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abre un Pull Request

## 📄 Licencia

Este proyecto está bajo la Licencia MIT.

## 👤 Autor

**Javi La Barum**
- Website: [tu-dominio.com]
- Instagram: [@javilabarumdj]
- Email: [tu-email@example.com]

## 🙏 Agradecimientos

- Laravel Framework
- Google Calendar API
- FullCalendar.js
- Tailwind CSS
- Font Awesome

---

¡Disfruta de tu nuevo sitio web profesional para DJ! 🎧🎶
