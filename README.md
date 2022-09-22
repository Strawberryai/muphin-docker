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
- [http://localhost:81](http://localhost:81)
- [http://localhost:8890](http://localhost:8890)

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

4. Posibilidad de añadir elementos al sistema (en nuestro caso muphin-stickers)

5. Generación de un listado de los elementos de la base de datos (en nuestro
   caso el catálogo de muphins)

6. Posibilidad de modificar los datos de los elementos del catálogo.

7. Posibilidad de eliminar elementos del catálogo (pidiendo confirmación)

# Reparto de tareas inicial (22/9/2022)

Este es el apartado en el que definimos un reparto de tareas inicial:

1. Casos de uso e interfaces de la aplicación (conjunto) (DEADLINE: 22/9/2022)
    a. Interfaz Main (Alan)
    b. Interfaz Sign in (Adrián)
    c. Interfaz Sign up (Álvaro)
    d. Interfaz Modificar datos usuario (Alan)
    e. Interfaz Catálogo / Modificar datos elementos / Eliminar elementos (Álvaro)
    f. Interfaz Añadir datos catálogo (Adrián)

2. Diseñar e implementar la estructura de la base de datos (según el enunciado
   son tablas independientes)
    a. Tabla usuarios
    b. Tabla muphins

3. Diseñar e implementar el backend con PHP
    a. Implementar un Router.php
    b. Implementar un Database.php
    c. Implementar un Muphin.php
    d. Implementar un Usuario.php
    e. Implementar index.php (entrada principal)

