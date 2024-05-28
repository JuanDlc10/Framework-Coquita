# Framework-Coquita

## Descubre Coquita

**Coquita** es un framework para aplicaciones web con una sintaxis expresiva y elegante. Proporciona una estructura sólida y un punto de partida para crear tu aplicación, permitiéndote concentrarte en la creación de algo asombroso.

**Coquita** se esfuerza por ofrecer una excelente experiencia de desarrollo al tiempo que incluye características potentes, como un ORM avanzado, validación de entradas en el frontend, una estructura de directorios clara y organizada, y manejo de solicitudes asíncronas, entre otras.

Ya seas nuevo en los frameworks web de PHP o tengas años de experiencia, Coquita es un framework que puede crecer contigo. Ofrece herramientas sólidas para la gestión de solicitudes asíncronas, validaciones exhaustivas y un ORM avanzado. En resumen, **Coquita** está diseñado para construir aplicaciones web profesionales. 🚀


### Un Framework Escalable

**Coquita** es altamente escalable. Debido a la naturaleza escalable de **PHP** y al soporte incorporado de **Coquita** para sistemas de caché rápidos y distribuidos, el escalado horizontal con **Coquita** es sencillo. De hecho, las aplicaciones basadas en **Coquita** pueden crecer sin dificultad.

### Un Framework Comunitario

Coquita combina los mejores paquetes en el ecosistema PHP para ofrecer el framework más robusto y amigable para el desarrollador disponible.


## Principales características

- **ORM avanzado:** Simplifica la interacción con bases de datos, permitiendo realizar operaciones CRUD (crear, leer, actualizar y eliminar) de manera eficiente.
- **Validación de inputs en frontend:** Utiliza JavaScript para validar formularios y otros inputs en el frontend, mejorando la experiencia del usuario y asegurando la integridad de los datos.
- **Estructura clara y organizada:** Proporciona un flujo de trabajo intuitivo y una estructura de directorios bien organizada, facilitando el desarrollo y mantenimiento de la aplicación.
- **Gestión de solicitudes asíncronas:** Facilita la realización de consultas, inserciones, actualizaciones y eliminaciones a través de `fetch` con métodos personalizados.
- **Mensajes de interfaz de usuario:** Utiliza la biblioteca SweetAlert para mostrar mensajes de éxito y advertencia de manera atractiva.
- **Validaciones extensivas:** Implementa validaciones comunes como campos vacíos, solo letras, solo números, correos electrónicos, CURP, RFC y contraseñas.
- **Utilidades de manipulación de cadenas:** Funciones para limpiar cadenas y transformar caracteres en campos de formulario.
- **Control de longitud y valores:** Métodos para limitar el valor y la longitud de los campos, asegurando que los datos cumplan con los requisitos específicos.


# Requisitos

Para utilizar "coquita", asegúrate de tener el siguiente entorno:

- **PHP** 8.2 o superior
- **Composer** para la gestión de dependencias
- **Node.js 21 o superior** y **npm** para manejar paquetes de frontend
- Un servidor **web** como **Apache**
- Un **host-Virtual**
- **MySQL** o **MariaDb**


## Configuración recomendada
- **Apache:** Habilitar mod_rewrite
 
# Instalación

Sigue estos pasos para instalar "coquita":

1. Clona el repositorio desde GitHub:
    ```sh
    https://github.com/JuanDlc10/Framework-Coquita.git
    cd coquita
    ```
2. Configura tu servidor web para apuntar al directorio `raiz` del proyecto.
 
3. Instala las dependencias de PHP usando Composer:
    ```sh
    composer install
    ```

4. Configura tu archivo de entorno `.env`:
   
    Edita el archivo `.env` con las credenciales de tu base de datos y otras configuraciones necesarias.
   ```sh
   -HOST = "localhost"
   -PORT = "3306"
   -USER = "root"
   -PASSWORD = ""
   -DB = "example"
   ```
5. Configura el archivo `Config`:
   ```sh
    -private const SERVER = "http://url-host-virtual";
    -private const DEP_IMG = self::SERVER . "/public/img/";
    -private const DEP_JS = self::SERVER . "/public/js/";
    -private const DEP_CSS = self::SERVER . "/public/css/";
   ```
6. Instala las dependencias de frontend:
    ```sh
    npm install
    ```


¡Y listo! Ahora puedes acceder a tu aplicación en tu navegador web.

## Ejemplo de configuración de Apache
```apache
<VirtualHost *:80>
    ServerName coquita
    DocumentRoot /ruta/a/tu-proyecto/public

    <Directory /ruta/a/tu-proyecto>
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```
### Después de instalar "coquita", tu proyecto tendrá la siguiente estructura de directorios:
```
Framework-Coquita/
├── app/
│   └── config/
│       └── Conexion.php
│       └── Config.php
│       └── MyRoutes.php
│       └── ORM.php
│       └── View.php
│   └── controller/  
│   └── model/
├── controller/
│       └── coquita.controller.js
├── node_modules/
├── public/
│       └── css/
│       └── img/
│       └── js/
├── src/
│       └── coquita.controller.js
├── vendor/
├── view/
├── .babelrc
├── .env
├── .htaccess
├── composer.json
├── composer.lock
├── coquita.js
├── index.php
├── package-lock.json
└── package.json
```
  
## Generadores de Coquita

Coquita proporciona comandos de CLI para facilitar la creación de controladores, modelos y vistas. Estos comandos ayudan a mantener una estructura organizada y consistente en tu aplicación.

### Creando un Controlador

Para crear un nuevo controlador, utiliza el siguiente comando:

```sh
node coquita controller NombreCarpeta NombreControlador
```
### Creando un Modelo

Para crear un nuevo modelo, utiliza el siguiente comando:

```sh
node coquita model NombreCarpeta NombreModelo
```
### Creando una Vista

Para crear una nueva vista, utiliza el siguiente comando:

```sh
node coquita view NombreCarpeta NombreVista
```
## Licencia
Este proyecto está licenciado bajo la Licencia MIT. Consulta el archivo LICENSE para más detalles.

## Autores

Autores: 
-Juan Alberto De la cruz Cruz - JuanDlc10 
-Diego Bollas Paredes
