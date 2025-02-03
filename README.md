<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Práctica 1 y 2 Desarrollo Backend 2025
El presente proyecto es una API simple para visualizar email de prueba según un pedido de un usuario.
Sigue los principios REST para la creación de APIs, como el uso de métodos descriptivos, códigos de error
HTTP semánticos y mejores prácticas impulsadas por el framework Laravel.
Además, se ha incluido funcionalidad para el registro y la consulta de usuarios ficticios, mediante el uso
de una base de datos MySQL.

## Captura de pantalla
![Captura de pantalla de la muestra del correo electrónico generado](./screenshots/ss.PNG)

## Requisitos y especificaciones
1. PHP Versión 8.4
2. Composer Versión 2.8.5
3. Laravel Versión 11
4. Desarrollado en stack WAMP (Windows, Apache, MySQL y PHP) con Laragon

## Pasos para ejecutar el proyecto
1. Clonar el repositorio y hacer un `cd` al directorio
2. Ejecutar el comando `composer install`
3. Crear un archivo `.env` en la raiz del directorio (copiar y pegar la información en el archivo `.env.example` para utilizar valores predeterminados)
4. Ejecutar el comando `php artisan serve`