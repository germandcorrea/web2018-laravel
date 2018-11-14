# Ejemplo de Proyectos en Laravel 5.5

## Documentación

- [Traducción de la documentación oficial](https://docs.laraveles.com/docs/5.5)
  - [Autenticación](https://docs.laraveles.com/docs/5.5/authentication)
  - [Migraciones](https://docs.laraveles.com/docs/5.5/migrations)
  - [Eloquent](https://docs.laraveles.com/docs/5./eloquent)
  - [Relaciones](https://docs.laraveles.com/docs/5./eloquent-relationships)
  - [Seeders](https://docs.laraveles.com/docs/5.5/seeding)

## Trabajar con un Proyecto Compartido

### Clonar el Repositorio de git

```bash
git clone git@github.com:germandcorrea/web2018-laravel.git
```

### Moverse al directorio del proyecto

```bash
cd web2018-laravel
```

### Descargar Dependencias del Proyecto

Como las dependencias del proyecto las maneja **composer** debemos ejecutar el comando:

```bash
composer install
```

### Configurar Entorno

La configuración del entorno se hace en el archivo **.env** pero esé archivo no se puede versionar según las restricciones del archivo **.gitignore**, igualmente en el proyecto hay un archivo de ejemplo  **.env.example** debemos copiarlo con el siguiente comando:

```bash
cp .env.example .env
```

Luego es necesario modificar los valores de las variables de entorno para adecuar la configuración a nuestro entorno de desarrollo, por ejemplo los parámetros de conexión a la base de datos.

### Generar Clave de Seguridad de la Aplicación

```bash
php artisan key:generate
```

### Migrar la Base de Datos

el proyecto ya tiene los modelos, migraciones y seeders generados. Entonces lo único que nos hace falta es ejecutar la migración y ejecutar el siguiente comando:

```bash
php artisan migrate:fresh --seed
```

- **migrate:fresh** ejecuta la migración **eliminando** todas las tablas y volviendo a generarlas.
- **--seed** ejecuta los Seeders habilitados  

### Probar los modelos con Tinker

```bash
php artisan tinker
```

#### Obtener el usuario con id 1

```php
$u= App\User::find(1);
```

#### Obtener todos los proyectos de usuario

```php
$u->proyectos;
```

#### Obtener el primer proyecto de usuario

```php
$u->proyectos->first();
```

#### Obtener todas las tareas del primer proyecto de usuario

```php
$u->proyectos->first()->tareas;
```

<!---
## Crear el proyecto desde cero

```bash
composer create-project --prefer-dist laravel/laravel web2018ap  '5.5.*'
```

```bash
composer require barryvdh/laravel-debugbar --dev
```

```bash
php artisan make:auth
```

```bash
php artisan make:model Proyecto -m
```

```bash
php artisan make:model Tarea -m
```

```bash
php artisan make:seed CargaInicialSeed
```

```bash
php artisan migrate:fresh --seed
```
-->