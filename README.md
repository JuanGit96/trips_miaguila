## Pasos para poner en funcionamiento proyecto

1) Clonar repositorio

2) Tener instalado mongodb y sus drivers con php

3) Tener instalado composer

4) verificar que el archivo de entorno tenga nombre y usuarios a la base de datos de mongo

5) desde consola de comandos ejecutar composer install para instalar proyecto laravel

6) probar en el proyecto desde linea de comandos php artisan para verificar que todo va ok

7) hacer las migraciones con php artisan migrate una vez se tenga creada la base de datos

8) ingresar registros de prueba a la db con comando similar a este 

    db.people.insert( [ {name: "Kiran", age: 20}, {name: "John"} ]);

9) si todo va bien podemosmontar servidor virtual desde linea de comandos en el proyecto y ejecutando php artisan serve y desde el navegador entrar a http://localhost:8000

10) la documentación del api está en la ruta http://localhost:8000/api/documentation

## info extra

11) asi mismo si hay alguna duda se puede verificar api en postman

12) no se dejó ningun parametro obligatorio para el ejercicio

11) para el servicio que lista todos los viajes se implementó paginacion

12) los controladores del proyecto están en App/Http/Controlers

13) mas codigo de utilidad está en App/Http/Traits

14) El archivo de rutas está en Routes/Api

15) Adjunto imagenes de funcionamiento del api en carpeta imagenes_prueba dentro del mismo repositorio

## Tambien se deja el proyecto listo para usar en un .zip dentro del repositorio

## Si se desea ver el desarrollo en mi local puedo habilitar tunel por ngrok.

## Quedo atento a cualquier correccion o caracteristica extra al Api


<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>
