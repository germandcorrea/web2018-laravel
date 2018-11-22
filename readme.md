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
git clone https://github.com/germandcorrea/web2018-laravel.git
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

## Desplegar la aplicación en Heroku

- [https://devcenter.heroku.com/articles/getting-started-with-php](https://devcenter.heroku.com/articles/getting-started-with-php)
- [https://devcenter.heroku.com/articles/getting-started-with-laravel](https://devcenter.heroku.com/articles/getting-started-with-laravel)

lo primero que necesitamos es una cuenta en heroku, es gratuito para eso hay que ir a la página de [https://heroku.com/](https://heroku.com/) y registrarse.

### instalar heroku

Luego es necesario instalar la herramienta de linea de comandos para comunicarse con heroku [https://devcenter.heroku.com/articles/heroku-cli#download-and-install](https://devcenter.heroku.com/articles/heroku-cli#download-and-install).
la documentación oficial sugiere usar en ubuntu el **snap** de heroku, pero 

Lamentablemente en nuestra maquina virtual no está instalada, entonces primero debemos instalar primero **snapd**

```bash
sudo apt install snapd
```

ahora si instalamos **heroku** mediante **snap**

```bash
sudo snap install --classic heroku
```

### iniciar Sesión en heroku

iniciar Sesión en heroku, nos va a pedir el correo electrónico y la password con la que nos registramos en el sitio.

```bash
heroku login
```

### Generar el archivo **Procfile**

Generar el archivo **Procfile** donde indicamos que vamos a usar como servidor WEB una instancia de apache2 con php  configurado apuntando **DocumentRoot** al directorio **public** de nuestra aplicación.  

```bash
echo "web: vendor/bin/heroku-php-apache2 public/" > Procfile
```

### GIT

Heroku como la mayoría de servicios web en la nube, utilizan **GIT** para subir los archivos al repositorio del servidor. por lo tanto es necesario iniciar un repositorio git dentro de nuestro proyecto **git init**, agregar todos los archivos del proyecto al repositorio **git add .** y por ultimo confirmar los que los archivos están listos en nuestro repositorio **git commit -m "app: inicio de repositorio"**, todos esto es en nuestro repositorio local.

```bash
git init
git add .
git commit -m "app: inicio de repositorio"
```

### crear la aplicación

crear la aplicación en la nube de Heroku con un nombre de aplicación, tener mucho cuidado de no usar un nombre de aplicación repetido.

```bash
heroku create
```

### Agregar php a la aplicación

por defecto Heroku entiende que nuestra aplicación se va a desarrollar en **nodejs** de modo que debemos especificarle un build pack correspondientes a **PHP**.

```bash
heroku buildpacks:set heroku/php
```

### Configurar variables de entorno la clave secreta

variables para la clave secreta de la aplicación.

```bash
heroku config:set APP_KEY=$(php artisan key:generate --show)
```

### Agregar PostgreSQL a nuestra aplicación

agregar PostgreSQL a nuestra aplicación en el servidor de heroku, luego podremos ver que en el heroku tenemos una variable de entorno **DATABASE_URL** que contiene los parámetros de conexión hacia el servidor de base de datos.

```bash
heroku addons:create heroku-postgresql:hobby-dev
```

#### Configurar variables de entorno para la configuración de la Base de Datos

```bash
heroku config
```

**postgres://usuario:contraseña@host:5432/base_de_datos**

declaramos las variables que necesita laravel, para funcionar.
configuramos las variables de entorno en el servidor de heroku, es decir las variables que teníamos definidas en nuestro archivo **.env** tienen que definirse como variables de entorno en los servidores de heroku.

```bash
heroku config:set DB_CONNECTION=pgsql
heroku config:set DB_HOST=host
heroku config:set DB_USERNAME=usuario
heroku config:set DB_PASSWORD=password
heroku config:set DB_DATABASE=base_de_datos
```

### Subir la aplicación

una vez configurada la aplicación es hora de subirla a la nube de Heroku, nuevamente mediante **GIT**

```bash
git push heroku master
```

Corremos las migraciones en el servidor de heroku

```bash
heroku run php artisan migrate --seed
```

### Lanzamos nuestra aplicación en el navegador web

```bash
heroku open
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