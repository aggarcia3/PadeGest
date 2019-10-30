# PadeGest
Un proyecto de aplicación web de gestión integral de un club de pádel para la asignatura de Aprendizaje Basado en Proyectos, basado en el esqueleto de aplicación de CakePHP 3.x.

## Instalación

1. Descarga [Composer](https://getcomposer.org/doc/00-intro.md) o actualízalo: `composer self-update`.
2. Ejecuta `php composer.phar create-project --prefer-dist cakephp/app [app_name]`.

Si Composer está instalado globalmente, ejecuta:

```bash
composer create-project --prefer-dist cakephp/app
```

Si quieres usar un nombre de directorio personalizado (e.g. `/myapp/`):

```bash
composer create-project --prefer-dist cakephp/app myapp
```

Ahora puedes usar tu servidor web local para interactuar con la aplicación, o iniciar
el servidor web embebido con:

```bash
bin/cake server -p 8765
```

Luego visita `http://localhost:8765` para ver la página de bienvenida.

## Configuración inicial

Lee y edita `config/app.php`, y establece las `'Datasources'` y cualquier
otra configuración relevante.

## Diseño

El esqueleto de aplicación PHP usa el marco de trabajo [Foundation](http://foundation.zurb.com/)
(v5).
