# Muphin Docker

Este proyecto se trata de una aplicación web sobre muphins alojada en un
conjunto de servicios corriendo en contenedores Docker. En concreto, este
sistema está basado en una arquitectura Linux + Apache + MariaDB (MySQL) + PHP 7.2 en Docker Compose. 

Además, hemos logrado alojar nuestra web en un servidor de Google Cloud 
haciendo uso de un servicio DNS y creando un certificado expedido por una 
CA permitiéndonos establecer conexiones HTTPS con nuestra página. En concreto, 
nuestra dirección es la siguiente: [http://muffin.ddns.net](https://muffin.ddns.net)

## Integrantes del grupo

Este proyecto está compuesto por los siguientes integrantes:
- Alan García Justel
- Álvaro Díez-Andino
- Adrián López Oyón

## Instrucciones para iniciar el sistema

Introduce los siguientes comandos para iniciar los contenedores:
```bash
$ docker build -t="web" .  # si la imagen no está buildeada
$ docker-compose up -d
```

> **Nota importante**: En macOS tuve que añadir la primera línea "services:" en el
> archivo `docker-compose.yml`.

Para parar los servicios:
```bash
$ docker-compose stop
```

Una vez iniciado el sistema deberían funcionar las siguientes urls:
- Web: [http://localhost:81](http://localhost:81)
- phpMyAdmin: [http://localhost:8890](http://localhost:8890)

## Descripción del sistema web 

El sistema web se trata de una aplicación que implementa las siguientes
funcionalidades:

1. Registro de usuarios introduciendo y comprobando el formato de los
   siguientes datos:
    - Nombre y apellidos (sólo texto) 
    - DNI (formato xxxxxxxxZ aplicando algoritmo para comprobar la letra)
    - Teléfono (sólo números)
    - Fecha nacimiento (formato aaaa-mm-dd)
    - E-mail (formato e-mail válido)

2. Identificación en base a un nombre de usuario y contraseña

3. Modificación de datos de un usuario identificado (realizar comprobaciones
   del formato).

4. Posibilidad de añadir elementos al sistema (en nuestro caso muffin-stickers)

5. Generación de un listado de los elementos de la base de datos (en nuestro
   caso el catálogo de muffins)

6. Posibilidad de modificar los datos de los elementos del catálogo.

7. Posibilidad de eliminar elementos del catálogo (pidiendo confirmación)
