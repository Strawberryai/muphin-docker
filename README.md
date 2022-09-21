
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

> ==Nota importante==: En macOS tuve que añadir la primera línea "services:" en el
> archivo `docker-compose.yml`.

Para parar los servicios:
```bash
$ docker-compose stop
```

Una vez iniciado el sistema deberían funcionar las siguientes urls:
    - [http://localhost:81](http://localhost:81)
    - [http://localhost:8890](http://localhost:8890)
