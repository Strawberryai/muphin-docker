# Muphin Docker

Este proyecto se trata de una aplicación web sobre muphins alojada en un
conjunto de servicios corriendo en contenedores Docker. En concreto, este
sistema está basado en una arquitectura Linux + Apache + MariaDB (MySQL) + PHP 7.2 en Docker Compose. 

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
    a. Nombre y apellidos (sólo texto) 
    b. DNI (formato xxxxxxxx-Z aplicando algoritmo para comprobar la letra)
    c. Teléfono (sólo números)
    d. Fecha nacimiento (formato aaaa-mm-dd)
    e. E-mail (formato e-mail válido)

2. Identificación en base a un nombre de usuario y contraseña

3. Modificación de datos de un usuario identificado (realizar comprobaciones
   del formato).

4. Posibilidad de añadir elementos al sistema (en nuestro caso muffin-stickers)

5. Generación de un listado de los elementos de la base de datos (en nuestro
   caso el catálogo de muffins)

6. Posibilidad de modificar los datos de los elementos del catálogo.

7. Posibilidad de eliminar elementos del catálogo (pidiendo confirmación)
