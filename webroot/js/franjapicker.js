var tablaFranjas;
var ultimoDiaFranjas;

/**
 * Muestra una tabla de franjas horarias a partir de los datos recibidos del servidor.
 *
 * @param {Object} data La respuesta JSON del servidor, ya interpretada como un
 * objeto de JavaScript.
 * @param {String} textStatus El estado textual recibido de la respuesta.
 * @param {jqXHR} jqXHR El objeto de JQuery que encapsula las funcionalidades de
 * XMLHttpRequest, de manera uniforme entre diferentes navegadores.
 */
function mostrarTablaFranjas(data, _textStatus, jqXHR) {
    if (!Array.isArray(data.franjas)) {
        mostrarErrorAjax(undefined, undefined);
        return;
    }

    var tablaFranjas = $("<table>").addClass("franjapicker").append($("<tbody>"));
    for (var i = 0; i < data.franjas.length; ++i) {
        var franja = data.franjas[i];

        // Comprobar adecuación de la respuesta del servidor
        if (
            !Array.isArray(franja) || franja.length != 3 ||
            typeof franja[0] !== "string" || typeof franja[1] !== "string" ||
            typeof franja[2] !== "boolean"
        ) {
            mostrarErrorAjax(undefined, undefined);
            return;
        }

        tablaFranjas.append(
            $("<tr>")
            .addClass(franja[2] ? "franja-disponible" : "franja-ocupada")
            .append(
                $("<td>")
                .attr({
                    "data-toggle": "tooltip",
                    "data-placement": "bottom",
                    "title": franja[2] ? "Disponible" : "Ocupada"
                })
                .append(
                    $("<input>")
                    .attr({
                        "type": "radio",
                        "name": "franja",
                        "value": i,
                        "id": "franjapicker-franja-" + i,
                        "disabled": franja[2] ? undefined : "disabled"
                    })
                )
                .append(
                    $("<label>")
                    .attr("for", "franjapicker-franja-" + i)
                    .addClass(franja[2] ? "text-black" : "text-white-50")
                    .text(franja[0] + " — " + franja[1])
                )
                .tooltip()
            )
        );
    }

    $("div.franjapicker-mensaje-carga").addClass("franjapicker-oculto");
    $("div.franjapicker-mensaje-inicial").addClass("franjapicker-oculto");

    $("div.input.franja_horaria").append(tablaFranjas);
}

/**
 * Muestra un mensaje de error en una operación Ajax al usuario.
 *
 * @param {jqXHR} jqXHR El objeto de JQuery que encapsula las
 * funcionalidades de XMLHttpRequest, de manera uniforme entre
 * diferentes navegadores.
 * @param {String} textStatus El estado textual recibido
 * de la respuesta.
 */
function mostrarErrorAjax(jqXHR, _textStatus) {
    Swal.fire({
        title: "Error",
        text: "Ha ocurrido un error al recuperar las horas de reserva disponibles. Por favor, vuélvelo a intentar más tarde.",
        icon: "error",
        allowOutsideClick: false,
        confirmButtonText: "Vale"
    });

    // Ocultar resultados y mensaje de carga, pero mostrar mensaje inicial
    $("div.input.franja_horaria > table.franjapicker").remove();
    $("div.franjapicker-mensaje-carga").addClass("franjapicker-oculto");
    $("div.franjapicker-mensaje-inicial").removeClass("franjapicker-oculto");

    ultimoDiaFranjas = undefined;
}

/**
 * Actualiza y/o muestra las franjas horarias diponibles para reservas en
 * una fecha dada.
 *
 * @param {Date} dia El día cuyas franjas horarias obtener.
 */
function actualizarFranjas(dia) {
    if (ultimoDiaFranjas !== dia.getTime()) {
        $.get({
            url: "franjas-fecha",
            data: { fecha: dia.getTime() },
            dataType: "json",
            beforeSend: function(_jqXHR, _settings) {
                // Ocultar resultados y mensaje inicial, para mostrar mensaje de carga
                $("div.input.franja_horaria > table.franjapicker").remove();
                $("div.franjapicker-mensaje-carga").removeClass("franjapicker-oculto");
                $("div.franjapicker-mensaje-inicial").addClass("franjapicker-oculto");
            },
            success: mostrarTablaFranjas,
            error: mostrarErrorAjax
        });
    }

    ultimoDiaFranjas = dia.getTime();
}

// Comprobar que el usuario marque una franja cuando se envíe el formulario
$(document).on("submit", "form", function(evt) {
    $toret = $("input[name=\"franja\"]:checked", "form table.franjapicker").length == 1;

    if (!$toret) {
        Swal.fire({
            title: "Aviso",
            text: "Por favor, marca también una hora para la reserva.",
            icon: "warning",
            allowOutsideClick: false,
            confirmButtonText: "Vale"
        });
    }

    return $toret;
});
