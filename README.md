# FarmaShop

API para la gestión de una farmacia, desarrollada con Laravel 12 y PHP 8.3. Incluye administración de productos, inventario, ventas, compras, clientes, proveedores, reembolsos, usuarios, permisos y reportes.

## Tecnologías

- PHP 8.3 y Laravel 12
- MySQL 8
- Redis
- Meilisearch y Laravel Scout
- Almacenamiento compatible con S3 mediante Floci
- Nginx y PHP-FPM
- Docker Compose
- Laravel Sanctum
- Spatie Laravel Permission y Media Library

## Requisitos

- Docker Desktop con Docker Compose
- Git

No es necesario instalar PHP, Composer, MySQL ni Redis directamente en el equipo.

## Instalación con Docker

1. Clona el repositorio y entra al proyecto:

   ```bash
   git clone https://github.com/jeffamed/farmashop.git
   cd farmashop
   ```

2. Crea el archivo de entorno.

   En PowerShell:

   ```powershell
   Copy-Item .env.example .env
   ```

   En Linux o macOS:

   ```bash
   cp .env.example .env
   ```

3. Configura como mínimo estas variables en `.env`:

   ```env
   APP_NAME=FarmaShop
   APP_URL=http://localhost

   DB_CONNECTION=mysql
   DB_HOST=mysql
   DB_PORT=3306
   DB_DATABASE=farmashop
   DB_USERNAME=farmashop
   DB_PASSWORD=secret

   CACHE_DRIVER=redis
   REDIS_CLIENT=phpredis
   REDIS_HOST=redis
   REDIS_PASSWORD=null
   REDIS_PORT=6379

   SCOUT_DRIVER=meilisearch
   MEILISEARCH_HOST=http://meilsearch:7700
   MEILISEARCH_KEY=masterKey

   FILESYSTEM_DISK=s3
   AWS_ACCESS_KEY_ID=test
   AWS_SECRET_ACCESS_KEY=test
   AWS_DEFAULT_REGION=us-east-1
   AWS_BUCKET=farmashop
   AWS_ENDPOINT=http://floci:4566
   AWS_USE_PATH_STYLE_ENDPOINT=true
   ```

   Los nombres `mysql`, `redis`, `meilsearch` y `floci` son los nombres internos de los servicios Docker. No deben sustituirse por `127.0.0.1` cuando Laravel se ejecuta dentro del contenedor.

4. Instala las dependencias, construye las imágenes e inicia los servicios:

   ```bash
   docker compose run --rm --no-deps composer install
   docker compose up -d --build
   ```

5. Inicializa Laravel y la base de datos:

   ```bash
   docker compose exec php php artisan key:generate
   docker compose exec php php artisan migrate --seed
   docker compose exec php php artisan optimize:clear
   ```

La aplicación estará disponible en [http://localhost](http://localhost).

El bucket indicado en `AWS_BUCKET` debe existir en Floci antes de guardar imágenes de productos.

## Servicios y puertos

| Servicio | Puerto del equipo | Uso |
| --- | ---: | --- |
| Nginx | 80 | API HTTP |
| MySQL | 3306 | Base de datos |
| Redis | 6379 | Caché y métricas |
| Meilisearch | 7700 | Búsqueda de productos |
| Floci | 4566 | API compatible con S3 |

Si MySQL ya está instalado y ejecutándose en el equipo, el puerto `3306` estará ocupado. Puedes detener el MySQL local o cambiar en `compose.yml`:

```yaml
ports:
  - "3307:3306"
```

Aunque se publique como `3307`, Laravel debe conservar `DB_HOST=mysql` y `DB_PORT=3306`. El puerto `3307` se utilizaría solamente para conectarse desde una aplicación del equipo, como DBeaver o PhpStorm.

## Comandos útiles

Consultar el estado de los contenedores:

```bash
docker compose ps
```

Ver los logs:

```bash
docker compose logs -f
```

Ejecutar comandos Artisan:

```bash
docker compose exec php php artisan <comando>
```

Procesar trabajos en cola:

```bash
docker compose exec php php artisan queue:work
```

Detener los servicios:

```bash
docker compose down
```

`docker compose down` no elimina los datos persistentes. No uses la opción `-v` si deseas conservarlos.

## Persistencia

Los datos se conservan en:

- `mysql_data/`: base de datos MySQL.
- `redis_data/`: datos de Redis.
- `meili_data/`: índices de Meilisearch.
- Volumen Docker `floci-data`: objetos administrados por Floci.

La red `farmashop` permite que los contenedores se comuniquen entre sí, pero no almacena información.

## Pruebas

Ejecuta las pruebas dentro del contenedor PHP:

```bash
docker compose exec php php artisan test
```

El workflow [`.github/workflows/test.yml`](.github/workflows/test.yml) se activa con cada `push` y `pull_request`. Actualmente solo descarga el código mediante `actions/checkout`; todavía no configura PHP, instala dependencias ni ejecuta `php artisan test`.

## API

Los recursos principales se encuentran bajo el prefijo `/api/v1` y requieren autenticación con Laravel Sanctum. La API incluye endpoints para productos, ventas, órdenes, clientes, proveedores, laboratorios, ubicaciones, presentaciones, reembolsos, usuarios, tipos, usos, reportes y cierre de caja.

## Licencia

Este proyecto utiliza el framework Laravel, distribuido bajo la licencia MIT.
