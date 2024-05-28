import fs from "fs";

class Coquita {

    constructor() {
        this.tipo_archivo = {
            "controller": `<?php\nnamespace controller;\nclass {nombreClase} { \n}\n$controlador = new {nombreClase}();\n?>`,
            "model": `<?php\nnamespace model;\n\nuse config\\ORM;\n\nclass {nombreClase} extends ORM\n{\n    protected $tabla = '';\n    protected $id_tabla = '';\n}`,
            "view": `<div class="container">\n\t<div class="row">\n\t\t<div class="col">\n\t\t\t<!-- Hola  -->\n\t\t</div>\n\t</div>\n</div>`,
        };
    }

    comprobar_ruta(tipo, carpeta) {
        let directorio;
        if (tipo === "view") {
            directorio = "./view";
            if (carpeta) {
                directorio = `./view/${carpeta}`;
            }
        } else {
            directorio = `./app/${tipo}`;
            if (carpeta) {
                directorio = `./app/${tipo}/${carpeta}`;
            }
        }

        if (!fs.existsSync(directorio)) {
            fs.mkdir(directorio, { recursive: true }, error => {
                if (!error) {
                    console.log(`Creación de carpeta ${directorio} correcta`);
                } else {
                    console.log(`Error al crear la carpeta ${directorio}`);
                }
            });
        }
    }

    crear_archivo(tipo, nombreClase, carpeta) {
        let directorio;
        let filePath;

        if (tipo === "view") {
            directorio = carpeta ? `./view/${carpeta}` : `./view`;
            filePath = `${directorio}/${nombreClase}.view.php`;
        } else {
            directorio = carpeta ? `./app/${tipo}/${carpeta}` : `./app/${tipo}`;
            filePath = `${directorio}/${nombreClase}.php`;
        }

        this.comprobar_ruta(tipo, carpeta);

        let contenido = this.tipo_archivo[tipo].replace(/\{nombreClase\}/g, nombreClase);

        fs.writeFile(filePath,
            contenido,
            error => {
                if (!error) {
                    console.log(`Creación del ${tipo} correcta en ${filePath}`);
                } else {
                    console.log(`Error al crear el archivo en ${filePath}`);
                }
            }
        );
    }
}

const coquita = new Coquita();
const tipo = process.argv[2];
const carpeta = process.argv[3];
const nombreClase = process.argv[4] || carpeta;
coquita.crear_archivo(tipo, nombreClase, process.argv[4] ? carpeta : undefined);
