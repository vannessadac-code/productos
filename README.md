# CRUD DE PRODUCTOS

Crud de basico de productos

## Requerimientos

- PHP 8.4+
- PostgreSQL
- Laragon
- Node

## Ejecucion

### Local

1. Copiar archivo .env.example a .env

```bash
cp .env.example .env
```   

2. Instalar dependencias

```bash
composer install
```

3. Configurar la base de datos en el archivo .env

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=products_crud
DB_USERNAME=root
DB_PASSWORD=your_mysql_password
```

4. Generar la base de datos

```bash
php artisan migrate
```

5. Iniciar el servidor

```bash
php artisan serve
```

### Docker compose

Este proyecto incluye una configuración de Docker para facilitar su despliegue y desarrollo.

1. Asegurarse de tener Docker instalado.
2. Ejecutar el siguiente comando para iniciar la aplicación:

```bash
docker compose up -d
```

La aplicación estará disponible en `http://localhost:8000`.

La primera vez que se ejecute, se realizarán las siguientes acciones automáticamente:
- Instalación de dependencias de PHP y Node.
- Compilación de assets (Tailwind CSS, Vite).
- Ejecución de migraciones.

#### Comandos útiles de Docker

- Detener contenedores: `docker compose stop`
- Ver logs: `docker compose logs -f`
- Ejecutar comandos artisan: `docker compose exec api php artisan [comando]`
