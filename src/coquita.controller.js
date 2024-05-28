class Coquita {
    constructor(url, data, method) {
        this.url = url;
        this.data = data;
        this.method = method;
    }
    async consulta() {
        try {
            const respuesta = await fetch(this.url, {
                body: this.data,
                method: this.method,
            });
            const datos = await respuesta.json();
            return datos;
        } catch (error) {
            console.log(`Error de consulta: \n${error}`);
        }
    }
    insercion() {
        fetch(this.url, {
            method: this.method,
            body: this.data,
        })
            .then((respuesta) => respuesta.json())
            .then((respuesta) => {
                if (respuesta[0] == 1) {
                    alert("Datos Agregados correctamente")
                } else {
                    console.warn(respuesta[1]);
                }
            });
    }
    actualizar() {
        fetch(this.url, {
            method: this.method,
            body: this.data,
        })
            .then((respuesta) => respuesta.json())
            .then((respuesta) => {
                if (respuesta[0] == 1) {
                    alert("Datos actualizados correctamente")
                } else {
                    console.warn(respuesta[1]);
                }
            });
    }
    eliminar() {
        fetch(this.url, {
            method: this.method,
            body: this.data,
        })
            .then((respuesta) => respuesta.json())
            .then((respuesta) => {
                if (respuesta[0] == 1) {
                    alert("Datos eliminados correctamente");
                } else {
                    console.warn(respuesta[1]);
                }
            });
    }
}

class Interfaz {
    msj_error(msj) {
        Swal.fire({
            icon: "warning",
            title: "Error!",
            text: msj
        });
    }
    msj_exito(msj) {
        Swal.fire({
            icon: "success",
            title: "Correcto",
            text: msj
        });
    }
}


class ValidacionesCampos extends Interfaz {
    static restriccion = {
        "vacios": {
            "expresion": /(?!(^$))/,
            "msj": "No puedes dejar vacio el campo"
        },
        "letras": {
            "expresion": /^[a-zA-Záéíóú]+[\s]/i,
            "msj": "Solo puedes ingresar letras en el campo"
        },
        "numeros": {
            "expresion": /([0-9])+$/,
            "msj": "Solo puedes ingresar numeros en el campo"
        },
        "email": {
            "expresion": /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/,
            "msj": "Estructura de correo no valida! en el campo"
        },
        "curp": {
            "expresion": /^([A-Z][AEIOUX][A-Z]{2}\d{2}(?:0[1-9]|1[0-2])(?:0[1-9]|[12]\d|3[01])[HM](?:AS|B[CS]|C[CLMSH]|D[FG]|G[TR]|HG|JC|M[CNS]|N[ETL]|OC|PL|Q[TR]|S[PLR]|T[CSL]|VZ|YN|ZS)[B-DF-HJ-NP-TV-Z]{3}[A-Z\d])(\d)$/,
            "msj": "Estructura de CURP no valida! en el campo"
        },
        "rfc": {
            "expresion": /^[A-ZÑ&]{4}[0-9]{6}[A-Z0-9]{3}$/,
            "msj": "Estructura de RFC no valida! en el campo"
        },
        "password": {
            "expresion": /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&.])[A-Za-z\d@$!%*?&.]{8,15}$/,
            "msj": "Debe tener una combinación de letras (mayúsculas y minúsculas), dígitos y caracteres especiales, con una longitud mínima de 8 caracteres máximo 15 caracteres en el campo "
        }
    }
    limpiar_cadena = (cadena, caracter_busqueda, caracter_remplazo) => {
        return cadena.replace(`${caracter_busqueda}`, `${caracter_remplazo}`)
    }
    validar_campo(input, tipo_validacion, mensaje = "") {
        let resultado = true;
        let error = "";
        let msj_final = "";
        const incorrecto = (nombre, msj) => {
            error = (error == "") ? nombre : error;
            msj_final = (msj_final == "") ? msj : msj_final;
            return false;
        }
        if (Array.isArray(input)) {
            if (Array.isArray(tipo_validacion)) {
                tipo_validacion.map(validacion => {
                    let { expresion, msj } = ValidacionesCampos.restriccion[validacion];
                    input.map(nombre => {
                        resultado = expresion.test(document.getElementsByName(`${nombre}`)[0].value) ? resultado : incorrecto(document.querySelector('[for="' + nombre + '"]').textContent, msj);
                    })
                });
            } else {
                const { expresion, msj } = ValidacionesCampos.restriccion[tipo_validacion];
                input.map(nombre => {
                    resultado = expresion.test(document.getElementsByName(`${nombre}`)[0].value) ? resultado : incorrecto(document.querySelector('[for="' + nombre + '"]').textContent, msj);
                });
            }
        } else {
            const { expresion, msj } = ValidacionesCampos.restriccion[tipo_validacion];
            resultado = expresion.test(document.getElementsByName(`${input}`)[0].value) ? resultado : incorrecto(document.querySelector('[for="' + input + '"]').textContent, msj);
        }
        if (error != "") {
            this.msj_error(mensaje != "" ? mensaje : `${msj_final} ${error}`);
        }
        return resultado;
    }
    caracter_numeros = (input) => {
        document.getElementsByName(`${input}`)[0].addEventListener("input", () => {
            document.getElementsByName(`${input}`)[0].value = document.getElementsByName(`${input}`)[0].value.replace(/[0-9]/g, '')
        })
    }
    caracter_letras = (input) => {
        document.getElementsByName(`${input}`)[0].addEventListener("input", () => {
            document.getElementsByName(`${input}`)[0].value = document.getElementsByName(`${input}`)[0].value.replace(/([^a-zA-Záéíóú\s])/i, '')
        })
    }
    caracter_varios = (input) => {
        document.getElementsByName(`${input}`)[0].addEventListener("input", () => {
            document.getElementsByName(`${input}`)[0].value = document.getElementsByName(`${input}`)[0].value.replace(/([A-Za-z0-9ñÑ])/g, '')
        })
    }
    primer_mayuscula = (input) => {
        document.getElementsByName(`${input}`)[0].addEventListener("input", () => {
            document.getElementsByName(`${input}`)[0].value = document.getElementsByName(`${input}`)[0].value.charAt(0).toUpperCase() + document.getElementsByName(`${input}`)[0].value.slice(1)
        })
    }
    limitar_valor = (input, inicio, fin, msj) => {
        return document.getElementsByName(`${input}`)[0].value > inicio && document.getElementsByName(`${input}`)[0].value < fin ? true : this.msj_error(msj)
    }
    longitud_campo = (input, inicio, fin, msj) => {
        let campo = document.getElementsByName(`${input}`)[0].value;
        return campo.length > inicio && campo.length < fin ? true : this.msj_error(msj)
    }
    longitud_campo_exacta = (input, longitud, msj) => {
        let campo = document.getElementsByName(`${input}`)[0].value;
        return campo.length == longitud ? true : this.msj_error(msj)
    }
}

let validate = new ValidacionesCampos();
const validarProducto = () => {
    if (!validate.validar_campo(['nombre'], 'vacios')) return;
    if (!validate.validar_campo(['marca'], 'vacios')) return;
    if (!validate.validar_campo(['precio'], 'numeros')) return;
    if (!validate.validar_campo(['cantidad'], 'numeros')) return;
    document.getElementById('form').submit();
}
const validarLogin = () => {
    if (!validate.validar_campo(['email'], 'email')) return;
    if (!validate.validar_campo(['password'], 'password')) return;
    document.getElementById('form').submit();
}

