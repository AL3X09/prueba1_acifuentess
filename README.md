# prueba Alexander Cifuentes S.

Solución desarrollada en PHP-Codeigneiter
Backend en RESTfULL
ForntEnd
usando el framework 
limpio usando solo html

## Instalación

1-Descargue el proyecto desde el repositorio <br />
2-Aloje la carpeta descomprimida en su servidor local o empresarial <br />
3-debe alojarlo el paquete en su carpeta donde almacene sus sitios (exemplo: si tiene XAMMP la ruta es /xampp/htdocs) <br />
4-Antes de iniciar debe configurara en el framework la conexion a la base de datos a su servidor de pruebas<br />
    4.1- debe abrir la carpeta del proyecto e ir a la carpeta "/app", posteriormente a la carpeta "/config" y posteriormente abrir en su entorno de desarrollo el archivo "Database.php" <br />
    4.2-Debe cambiar la linea de conexion en producción <br />

    ```php
        public $default = [
        'DSN'      => 'pgsql:host=192.168.0.2;port=5432;dbname=hotel_dev;user=postgres;password=root',
        //'DSN'      => 'pgsql:host=suhosturl;port=puesto;dbname=nombredb;user=usuario;password=contraseña',
        'hostname' => '',
        'username' => 'postgres',
        'password' => 'root',
        'database' => 'hotel_dev',
        'DBDriver' => 'postgre',
        'DBPrefix' => '',
        'pConnect' => false,
        'DBDebug'  => (ENVIRONMENT !== 'production'),
        'charset'  => 'utf8',
        'DBCollat' => 'utf8_general_ci',
        'swapPre'  => '',
        'encrypt'  => false,
        'compress' => false,
        'strictOn' => false,
        'failover' => [],
        'port'     => 5432,
    ];
    ```
   4-3 no configure su htacces, ni defina un host para desplegar la solución ya que deberia hacer mas cambios al fichero de configuración <br />
5-abra su navegador de preferencia y en la cinta de opciones coloque lo siguiente: http://localhost/prueba1_acifuentess <br />

## Uso

La solución solo tiene como objetivo ser proceso de prueba integra sus propia vista sin embargo tiene separado el fornt <br />

La Herramienta consume información con API´s que se conectan a la base de datos subida en el motor Postgressql


## Contribuciones

Por favor abstengace de chacer contribuciones a la solución ya que es solo una prueba de ingreso laboral  y no es de uso comercial.

## Licencia temporal

[MIT](https://choosealicense.com/licenses/mit/)
 
# UML
Diagrame de Clases  <br />
<img src="https://raw.githubusercontent.com/AL3X09/prueba1_acifuentess/main/UML/uml_clases.PNG" width="auto"/>
