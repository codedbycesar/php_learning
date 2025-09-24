# 🐘 Stack PHP Docker Completo

Este proyecto proporciona un stack completo de desarrollo PHP usando Docker con los siguientes servicios:

- **PHP-FPM 8.2** con extensiones recomendadas
- **Nginx** como servidor web
- **MySQL 8.0** como base de datos
- **Redis 7** para caché y sesiones
- **Composer** para gestión de dependencias

## 📁 Estructura del Proyecto

```
.
├── docker-compose.yml          # Configuración principal de Docker Compose
├── .env                       # Variables de entorno
├── src/                       # Código fuente de la aplicación PHP
│   ├── index.php             # Página de demo
│   └── composer.json         # Configuración de Composer
├── docker/
│   ├── php/
│   │   ├── Dockerfile        # Imagen personalizada de PHP-FPM
│   │   ├── php.ini          # Configuración de PHP
│   │   └── php-fpm.conf     # Configuración de PHP-FPM
│   ├── nginx/
│   │   ├── nginx.conf       # Configuración principal de Nginx
│   │   └── default.conf     # Virtual host por defecto
│   ├── mysql/
│   │   └── my.cnf          # Configuración de MySQL
│   └── redis/
│       └── redis.conf      # Configuración de Redis
└── README.md               # Este archivo
```

## 🚀 Inicio Rápido

### Prerrequisitos

- Docker
- Docker Compose

### 1. Clonar o preparar el proyecto

```bash
# Si tienes el código, navega al directorio
cd barebones_php

# O si empiezas desde cero, crea la estructura que se muestra arriba
```

### 2. Configurar variables de entorno

Edita el archivo `.env` con tus configuraciones:

```bash
# Database Configuration
DB_ROOT_PASSWORD=tu_password_root_aqui
DB_DATABASE=tu_base_datos
DB_USERNAME=tu_usuario
DB_PASSWORD=tu_password_aqui
```

### 3. Construir y ejecutar los contenedores

```bash
# Construir las imágenes y levantar todos los servicios
docker-compose up -d --build

# Ver los logs
docker-compose logs -f

# Ver el estado de los contenedores
docker-compose ps
```

### 4. Verificar la instalación

Abre tu navegador y ve a: `http://localhost`

Deberías ver una página de demo que muestra:
- Información de PHP y extensiones instaladas
- Conexión exitosa a MySQL
- Conexión exitosa a Redis
- Información del servidor

## 🔧 Comandos Útiles

### Gestión de contenedores

```bash
# Levantar todos los servicios
docker-compose up -d

# Parar todos los servicios
docker-compose down

# Reiniciar un servicio específico
docker-compose restart php-fpm

# Ver logs de un servicio específico
docker-compose logs -f nginx

# Acceder al contenedor de PHP
docker-compose exec php-fpm bash

# Acceder al contenedor de MySQL
docker-compose exec mysql mysql -u root -p
```

### Composer

```bash
# Instalar dependencias
docker-compose run --rm composer install

# Agregar un paquete
docker-compose run --rm composer require vendor/package

# Actualizar dependencias
docker-compose run --rm composer update

# Autoload
docker-compose run --rm composer dump-autoload
```

### Base de datos

```bash
# Conectar a MySQL
docker-compose exec mysql mysql -u app_user -p app_database

# Hacer backup de la base de datos
docker-compose exec mysql mysqldump -u root -p app_database > backup.sql

# Restaurar backup
docker-compose exec -T mysql mysql -u root -p app_database < backup.sql

# Ver logs de MySQL
docker-compose logs mysql
```

### Redis

```bash
# Conectar a Redis CLI
docker-compose exec redis redis-cli

# Monitorear Redis
docker-compose exec redis redis-cli monitor

# Ver información de Redis
docker-compose exec redis redis-cli info
```

## 📝 Extensiones PHP Incluidas

El contenedor PHP incluye las siguientes extensiones:

### Extensiones básicas:
- **pdo** - PHP Data Objects
- **pdo_mysql** - MySQL driver para PDO
- **mysqli** - MySQL Improved extension
- **mbstring** - Multibyte String Functions
- **xml** - XML Parser
- **curl** - Client URL Library
- **zip** - ZIP archive management
- **gd** - Image Processing (GD Library)
- **intl** - Internationalization Functions
- **fileinfo** - File Information
- **tokenizer** - Tokenizer Functions
- **soap** - SOAP Protocol support

### Extensiones de rendimiento:
- **opcache** - OPcode caching
- **redis** - Redis client
- **bcmath** - BCMath Arbitrary Precision Mathematics

### Extensiones de desarrollo:
- **xdebug** - Debugging and profiling (solo en desarrollo)

## ⚙️ Configuraciones Personalizadas

### PHP (`docker/php/php.ini`)
- Memory limit: 256M
- Upload max filesize: 100M
- Post max size: 100M
- Max execution time: 120s
- OPcache habilitado
- Xdebug configurado para desarrollo

### Nginx (`docker/nginx/default.conf`)
- Gzip compresión habilitada
- Headers de seguridad
- Configuración optimizada para PHP-FPM
- Cache de archivos estáticos

### MySQL (`docker/mysql/my.cnf`)
- Charset UTF8MB4
- InnoDB optimizado
- Query cache habilitado
- Slow query log habilitado

### Redis (`docker/redis/redis.conf`)
- Persistencia RDB configurada
- Memory policy: allkeys-lru
- Max memory: 128MB

## 🛠️ Desarrollo

### Estructura recomendada para tu aplicación PHP:

```
src/
├── index.php              # Punto de entrada
├── config/                # Configuraciones
├── app/
│   ├── Controllers/       # Controladores
│   ├── Models/           # Modelos
│   └── Views/            # Vistas
├── public/               # Archivos públicos (CSS, JS, imágenes)
├── vendor/              # Dependencias de Composer (auto-generado)
└── composer.json        # Configuración de Composer
```

### Variables de entorno en PHP

Para acceder a las variables de entorno en tu código PHP:

```php
$dbHost = $_ENV['DB_HOST'] ?? 'mysql';
$dbName = $_ENV['DB_DATABASE'] ?? 'app_database';
$dbUser = $_ENV['DB_USERNAME'] ?? 'app_user';
$dbPass = $_ENV['DB_PASSWORD'] ?? 'user_password_here';
```

## 🔍 Debugging

### Xdebug

Xdebug está configurado y listo para usar con VS Code o PHPStorm:

- **Host:** host.docker.internal
- **Port:** 9003
- **IDE Key:** PHPSTORM o VSCODE

### Logs importantes

```bash
# Logs de PHP-FPM
docker-compose exec php-fpm tail -f /var/log/fpm-php.www.log

# Logs de Nginx
docker-compose logs nginx

# Logs de aplicación (si usas error_log en PHP)
docker-compose exec php-fpm tail -f /var/log/php_errors.log
```

## 🚨 Troubleshooting

### Problemas comunes:

1. **Puerto ya en uso**
   ```bash
   # Cambiar puertos en docker-compose.yml
   ports:
     - "8080:80"  # En lugar de "80:80"
   ```

2. **Permisos de archivos**
   ```bash
   # Dar permisos a la carpeta src
   chmod -R 755 src/
   chown -R $USER:$USER src/
   ```

3. **Base de datos no conecta**
   ```bash
   # Verificar que MySQL esté corriendo
   docker-compose ps mysql
   
   # Ver logs de MySQL
   docker-compose logs mysql
   ```

4. **Limpiar todo y empezar de nuevo**
   ```bash
   # Parar y eliminar todo (¡CUIDADO: borra los datos!)
   docker-compose down -v --rmi all
   docker-compose up -d --build
   ```

## 🔒 Seguridad

Para producción, recuerda:

1. Cambiar todas las contraseñas por defecto
2. Deshabilitar Xdebug
3. Usar HTTPS con certificados SSL
4. Configurar firewall apropiadamente
5. Actualizar regularmente las imágenes Docker

## 📚 Recursos Adicionales

- [Documentación oficial de PHP](https://www.php.net/docs.php)
- [Documentación de Docker Compose](https://docs.docker.com/compose/)
- [Nginx documentation](https://nginx.org/en/docs/)
- [MySQL documentation](https://dev.mysql.com/doc/)
- [Redis documentation](https://redis.io/documentation)

---

¡Tu stack PHP completo está listo! 🎉