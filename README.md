# PadeGest [![Estado CI](https://status.continuousphp.com/git-hub/aggarcia3/PadeGest?token=362304b9-842b-414b-bd76-e83b3bdca02d&branch=master)](https://continuousphp.com/git-hub/aggarcia3/PadeGest)
Un proyecto de aplicación web de gestión integral de un club de pádel para la asignatura de Aprendizaje Basado en Proyectos, basado en el esqueleto de aplicación de CakePHP 3.x.

## Instalación

Primero descarga [Composer](https://getcomposer.org/doc/00-intro.md), o actualízalo: `composer self-update`.

Asumiendo que ya has clonado este repositorio, y que tu directorio de trabajo actual es el directorio raíz del repositorio, instala PadeGest usando Composer:

```bash
composer install
```

Ahora puedes usar tu servidor web local para interactuar con la aplicación, o iniciar
el servidor web embebido con:

```bash
bin/cake server -p 8765
```

Luego visita `http://localhost:8765` para ver la página de bienvenida.

## Integración continua

Usamos ContinuousPHP para ejecutar un trabajo para cada confirmación enviada al repositorio, enfocado a ejecutar tests de integración y de coherencia del código fuente. Este servicio de CI es también una buena fuente de información acerca de cómo trabajar con la aplicación, y qué requisitos tiene.

Para ver los resultados de CI de una confirmación, observa la lista de "Commits" del repositorio, y haz clic en la aspa roja o tick verde de la confirmación deseada (el aspa significa que algo ha ido mal, mientras que el tick simboliza que todo fue bien).
