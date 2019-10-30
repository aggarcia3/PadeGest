# PadeGest
Un proyecto de aplicación web de gestión integral de un club de pádel para la asignatura de Aprendizaje Basado en Proyectos, basado en el esqueleto de aplicación de CakePHP 3.x.

## Instalación

Primero descarga [Composer](https://getcomposer.org/doc/00-intro.md), o actualízalo: `composer self-update`.

Si Composer está instalado globalmente, ejecuta el siguiente comando para crear ficheros esqueleto de CakePHP en el subdirectorio `app`, colgando del directorio de trabajo actual:

```bash
composer create-project --prefer-dist cakephp/app
```

Si quieres usar otro subdirectorio (p. ej. `padegest`):

```bash
composer create-project --prefer-dist cakephp/app padegest
```

Ya tienes el esqueleto de aplicación de CakePHP básico, pero no contiene todavía el código propio de PadeGest. Añádeselo copiando los ficheros de este repositorio sobre el subdirectorio que se acaba de generar.

Ahora puedes usar tu servidor web local para interactuar con la aplicación, o iniciar
el servidor web embebido con:

```bash
bin/cake server -p 8765
```

Luego visita `http://localhost:8765` para ver la página de bienvenida.

## Diseño

El esqueleto de aplicación PHP usa el marco de trabajo [Foundation](http://foundation.zurb.com/)
(v5).
