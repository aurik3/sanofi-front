# Sanofi Web-Frontend

Desarrollo realizado en Laravel (PHP) para la divulgación de información por parte de Sanofi, alimentada por una API externa.

## Especificación Técnica

- Maquetado web con Framework Laravel 8.0
- Autenticación dinámica con Fortify
- Compilación de recursos estáticos mediante Mix (Webpack)
- Diseño responsivo con SCSS + Bootstrap
- Componentes de vista reutilizables dinámicos con Blade
- Almacenamiento de datos básicos de sesión mediante SQLite

## Preparación del proyecto

### Entorno necesario

Para la correcta ejecución del software en producción, se hace necesario un servidor web con las siguientes especificaciones:

- PHP >= 7.4
- BCMath (Ext. PHP)
- CType (Ext. PHP)
- Fileinfo (Ext. PHP)
- JSON (Ext. PHP)
- Mbstring (Ext. PHP)
- OpenSSL (Ext. PHP)
- PDO (Ext. PHP)
- PDO SQLite (Ext. PHP)
- Tokenizer (Ext. PHP)
- XML (Ext. PHP)
- Composer
- NGINX HTTP o Apache >= 2.0

Además, si se hace necesaria la compilación de recursos estáticos (Cambios en CSS, JS, Imágenes o scripts externos) se
necesitan adicionalmente:

- NodeJS >= 10.0
- Yarn

### Gestión de dependencias

El presente proyecto hace uso de un sistema dual de gestión de dependencias, en donde la plataforma web hace uso de 
[Composer](https://getcomposer.org/) para la gestión de dependencias de PHP, y de [Yarn](https://yarnpkg.com) para realizar
la gestión de dependencias de NodeJS para la compilación y empaquetamiento de recursos estáticos.

#### Dependencias de PHP

Para la ejecución y desarrollo del proyecto, es necesario actualizar e instalar las dependencias contenidas en el archivo
`composer.json`, ejecutando las siguientes en el procesador de comandos del sistema operativo de su elección:

```bash
$  composer update
$  composer install
```

#### Dependencias de NodeJS

Si se va a hacer uso de una recompilación de recursos estáticos, es necesario instalar las dependencias que hacen esto posible
contenidas en el archivo `package.json`. Estas depedencias pueden ser instaladas de la siguiente manera:

```bash
$  yarn install
```

### Entorno de ejecución

Para la correcta ejecución del aplicativo web, se hace necesaria la fijación de múltiples variables de entorno de ejecución.
Por motivos de seguridad, dichas variables no se encuentran incluidas en el presente repositorio, y deben ser manualmente incluidas
por medio de un archivo `.env` en la raíz del proyecto. En dicha raíz se encuentra un documento `.env.example` 
(En sistemas Linux y macOS, asegúrese de poder visualizar archivos ocultos) cuyo contenido sirve como maqueta del contenido
que el archivo `.env` debe contener.

- `APP_NAME`: Nombre de la aplicación (Identificación)
- `APP_ENV`: Debe fijarse a local o production de acuerdo al caso.
- `APP_KEY`: Debe ser automáticamente generada una vez creado el archivo `.env` por medio del comando `php artisan key:generate`.
- `APP_DEBUG`: Debe fijarse a `true` o `false`. Permite mostrar errores de ejecución.
- `DB_CONNECTION`: Debe fijarse a SQLite
- `DB_DABASE`: Debe apuntar a la localización absoluta del archivo de base de datos SQLite.
- `SFAPI_HOST`: Localización de la API de Sanofi a consumir
- `SFAPI_USERNAME`: El nombre de usuario de administración a usar.
- `SFAPI_PASSWORD`: La contraseña del usuario de administración a usar.

### Creación de la base de datos

Cree un archivo de base de datos `engine.db` en la carpeta database si no existe y apunte la llave `DB_DATABASE` de las claves
de entorno a dicho archivo.

Posteriormente, realize una migración de datos a dicho archivo de base de datos por medio de Artisan, de la siguiente manera:

```bash
$  php artisan migrate:fresh
```

Este comando generará las tablas necesarias para la persistencia de usuarios en el aplicativo web.

## Inicialización del servidor

En un entorno de producción o de desarrollo, el proyecto debe ser alojado en un espacio reconocido por NGINX o Apache, como
se indica en la documentación oficial de Laravel, [Apartado Web Server Configuration](https://laravel.com/docs/8.x/installation#web-server-configuration.

Adicionalmente, existe la posibilidad de inicializar un servidor temporal de desarrollo local, mediante el comando
```bash
$  php artisan serve
```
*Tenga en cuenta que serve es una alternativa menos robusta a un stack basado en NGINX o Apache.*

## Compilación de recursos estáticos

Después de haber realizado cambios de recursos estáticos alojados en la sección `/resources` del aplicativo web, se requiere de
la realización de una compilación estática mediante webpack que permita un buen rendimiento de carga en la web. Esto es posible gracias
a `Laravel Mix`.

Para empezar, asegúrese de que las dependencias de NodeJS hayan sido correctamente instaladas mediante el comando:
```bash
$  yarn install
```

Una vez completado el proceso de instalación, puede realizar una compilación en modo de desarrollo mediante el comando:
```bash
$  yarn watch
```

O, si desea realizar una compilación en modo producción que genere archivos minificados y obfuscados, ejecute el comando:
```bash
$ yarn prod
```

Adicionalmente, si desea añadir nuevos recursos a la cola de compilación, modifique el archivo `/webpack.mix.js` en la raíz del proyecto
de acuerdo a sus necesidades, como se indica en su [documentación oficial](https://laravel.com/docs/8.x/mix).

## Uso del motor interno de consultas a la API Externa

Si se requiere del uso de nuevas consultas directas a la API Externa de Sanofi, es posible generar las peticiones necesarios tanto para
usuarios autenticados tanto como para administrador, haciendo uso del controlador de consultas `SFQueryController`. Este controlador
se encargará de satisfacer las necesidades del cuerpo de la petición y se autenticará de manera automática, además de procesar los
resultados obtenidos de manera automática.

El uso de dicho controlador para una petición de nivel administrador es el siguiente:

```php
$query_controller = new SFQueryController();
$result = $query_controller -> admin_basic('SELECT * FROM Users;');
return response($result, 200) -> header('Content-Type', 'text/json');
```

O también, para una petición a nivel de usuario autenticado:

```php
$session_controller = new SFSessionController();
$query_controller = new SFQueryController();
$uid = $session_controller -> current_Id();
$planned = $query_controller -> stateful_basic('SELECT COUNT(*) FROM Events WHERE assigned_user_id = \''.$uid.'\' AND eventstatus = \''.'Planned'.'\';')[0] -> count;
```

*Puede encontrar documentación adicional sobre estos procedimientos en los PHPDocs de cada controlador.*

## Uso de componentes reutilizables en vistas de Blade

La lógica de negocio de todos los componentes reutilizables puede ser encontrada en el directorio `/app/View/Components`, y sus representaciones visuales pueden ser encontradas en el directorio `/app/resources/views/components`.

Dichos componentes pueden ser inyectados en vistas de Blade haciendo uso de las directrices `x-`, de la siguiente manera:

Si se tiene un componente de nombre `FeelCards` con parámetros `type` y `title`, se llamará de la siguiente manera en la vista de blade:
```html
<x-feel-cards type="home" title="Noticias"/>
```

*Esta estructura es válida para todos los componentes blade que desee incluir. Tenga en cuenta que si hay parámetros faltantes, la renderización de dicha vista resultará en un error.*

## Gestión de la autenticación

La autenticación es realizada de manera fraccional debido a la existencia de un mecanismo de autenticación externo en la API externa de Sanofi. Para mantener un order sincronizado entre el
presente aplicativo web y la API externa, se hace uso de un controlador `SFSessionController`, que sincroniza y obtiene sesiones desde la localización externa y genera un puente
con Laravel Fortify, y `SFTokenController`, que se encarga de generar tokens y sesiones para la aplicación en base a los requerimientos de la API externa.

El proceso de autenticación interna puede ser visualizado y modificado en el proveedor de servicio `FortifyServiceProvider` localizado en `/app/Providers`.

## Creación de vistas

Toda vista nueva debe ser creada por medio del motor de plantillas Blade y debe ser almacenada en el directorio `/resources/views`, siguiendo el esquema de nomenclatura `xxx.blade.php`. Adicionalmente, dichas vistas deben tener un controlador asociado o 
deben ser directamente accedidas mediante una entrada en el archivo `web.php` localizado en el directorio `/routes` del proyecto.
