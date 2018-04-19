# CELIA360 - NOTAS DE INSTALACIÓN

Celia360 debe desplegarse en servidor como cualquier otra aplicación web.

El procedimiento general es:

1. Mover todo el código fuente a un directorio del servidor accesible vía web.
2. Crear una base de datos MySQL o MariaDB vacía.
3. Crear un archivo de configuración a partir del archivo de ejemplo [`.env.example`](.env.example). El nombre  del archivo dependerá del entorno donde se esté ejecutando la aplicación. Los nombres posibles son:

    - `.env.development`
    - `.env.production`
    - `.env.testing`

    Tendrá que especificar:
    - Host de la base de datos.  
    - Nombre de la base de datos.
    - Usuario y contraseña con privilegios suficientes para operar esa base de datos.
    - URL base de la instalación (algo el tipo: http://host/aplicacion, donde host es el nombre de dominio de su servidor y aplicación es el directorio donde ha desplegado el código de Celia360)
    - Directorio donde escribir datos de la sesión. En la mayoría de los servidores servirá /tmp. Si no funciona, puede probar a crear un subdirectorio dentro de su directorio de usuario e indicar la ruta absoluta aquí. El directorio debe tener permisos de escritura. Consulte con su administrador de sistemas si tiene alguna duda.

4. (TODO) Lanzar el script install.php. Este script creará la estructura necesaria de tablas en su base de datos.
5. Lanzar la web desde cualquier navegador web. La aplicación estará ya lista para comenzar a recibir datos. 

Puede acceder al panel de administración mediante la URI <http://host/aplicacion/usuario>,
donde host es el nombre de dominio de su servidor y aplicacion es el directorio
donde ha desplegado el código de Celia360.

Para conocer la forma en la que puede comenzar a introducir datos en la aplicación,
remítase a la documentación de usuario disponible en el directorio /guia_usuario de su instalación.