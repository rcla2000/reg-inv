# Registro de investigadores CONACYT

## Requerimientos

- PHP 8.2.4
- Composer
- Base de datos MySQL o MariaDB

### Pasos para ejecutar el proyecto

Una vez que se haya clonado el repositorio acceda a la carpeta generada, dentro de dicha carpeta  
ejecute el comando **composer install** para descargar todas las dependencias del proyecto.

Copie el archivo **.env.example** y renombrelo como **.env** aquí debe colocar las credenciales de la base de datos,  
luego de haber configurado la conexión ejecute el comando **php artisan config:clear**

Para lanzar el proyecto en el servidor local ejecute el comando **php artisan serve**
