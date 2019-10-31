# PadeGest [![Estado CI](https://status.continuousphp.com/git-hub/aggarcia3/PadeGest?token=362304b9-842b-414b-bd76-e83b3bdca02d&branch=master)](https://continuousphp.com/git-hub/aggarcia3/PadeGest)

Un proyecto de aplicación web de gestión integral de un club de pádel para la asignatura de Aprendizaje Basado en Proyectos, basado en el esqueleto de aplicación de CakePHP 3.x.

## Instalación

Primero descarga [Composer](https://getcomposer.org/doc/00-intro.md), o actualízalo: `composer self-update`.

### Instalación tras clonado manual

Asumiendo que ya has clonado este repositorio, y que tu directorio de trabajo actual es el directorio raíz del repositorio, instala PadeGest usando Composer:

```bash
composer install
```

### Instalación automática

Alternativamente, puedes dejar que Composer clone el repositorio por ti. Para ello, crea o edita el fichero `config.json` en el directorio [COMPOSER_HOME](https://getcomposer.org/doc/03-cli.md#composer-home), de forma que tenga el siguiente contenido:

```json
{
	"repositories": [
		{
			"type": "vcs",
			"url": "git@github.com:aggarcia3/PadeGest.git"
		}
	]
}
```

Ahora puedes crear el proyecto de Composer, de manera similar a cómo se haría con la aplicación esqueleto de CakePHP. Con `--keep-vcs` el repositorio se inicializa automáticamente: sin ese parámetro, simplemente se descargan sus archivos.

```bash
composer create-project --prefer-dist --stability=dev --keep-vcs aggarcia3/padegest PadeGest
```

### Avanzado: integración de Composer y PHP para Windows con Cygwin

[Esta respuesta de StackOverflow](https://stackoverflow.com/a/14904607/9366153) da buenas instrucciones acerca de cómo combinar esas herramientas.

## Ejecutando la aplicación

Una vez instalado PadeGest, puedes usar tu servidor web local para interactuar con la aplicación, o iniciar
el servidor web embebido de desarrollo con:

```bash
bin/cake server -p 8765
```

Si todo va bien, al visitar `http://localhost:8765` te encontrarás con PadeGest. El comando anterior asume que tu directorio de trabajo actual es el directorio raíz de este repositorio.

## Editor recomendado

Se recomienda Visual Studio Code, con las extensiones recomendadas indicadas por este repositorio. Entre otras funcionalidades, proporciona:

- Comprobación de errores de sintaxis PHP.
- Documentación acerca de clases y métodos de CakePHP.
- Comprobación de estilo del código fuente, y formateo automático.

## Integración continua

Usamos ContinuousPHP para ejecutar un trabajo para cada confirmación enviada al repositorio, enfocado a ejecutar tests de integración y de coherencia del código fuente. Este servicio de CI es también una buena fuente de información acerca de cómo trabajar con la aplicación, y qué requisitos tiene.

Para ver los resultados de CI de una confirmación, observa la lista de "Commits" del repositorio, y haz clic en la aspa roja o tick verde de la confirmación deseada (el aspa significa que algo ha ido mal, mientras que el tick simboliza que todo fue bien).
