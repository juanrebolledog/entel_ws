# Zona Entel WebService

## Autenticación

El acceso al WS se restringe a peticiones con cabeceras HTTP específicas que ayudan al sistema a identificar la plataforma de donde se hace la petición así como también autenticar y autorizar al usuario. Las cabeceras son las siguientes:

- ENTEL-ACCESS-KEY
- ENTEL-API-KEY

La cabecera ENTEL-ACCESS-KEY cumple la función de identificar la plataforma de donde se esté haciendo la petición. La motivación de utilizar esta cabecera es autenticar la plataforma y de acuerdo al valor de la cabecera, autorizar el uso del WS. De esta forma se está evitando el uso del WS por otras plataformas/personas no autorizadas.

Adicionalmente, el usuario tiene su propia clave que lo identifica dentro del sistema: ENTEL-API-KEY. Esta clave especial (podría ser considerada como un password del usuario que nunca ve) es única para un usuario y el sistema la calcula al registrarse (ver Recursos: Usuarios mas abajo).


## Recursos

- Beneficios
- Eventos
- Categorías
- Usuarios


### Beneficios

URL Base: /api/benefits

#### GET /

Indice de beneficios. Acepta parámetros lat y lng para filtrar por coordenadas geográficas.

Parámetros (opcionales):

 - lat
 - lng

Ejemplo:

https://api.example.com/api/benefits?lat=10.1234&lng=-69.2134

Respuesta Ejemplo:

    {
        "data": [
            {
                "id": 4,
                "nombre": "Esta es una prueba",
                "descripcion": "Esta es una prueba y por lo tanto, tiene contenido de pruebas. Muchas veces es repetitivo, algunas veces es escaso. Hoy, es diferente.",
                "sub_categoria_id": 1,
                "lat": 10.134499549866,
                "lng": -68.123397827148,
                "rating": 0,
                "imagen_icono": "img/benefits/icono_1.png",
                "imagen_chica": "img/benefits/imagen_chica_1.png",
                "imagen_grante": "img/benefits/imagen_grande_1.png",
                "imagen_titulo": "img/benefits/imagen_titulo_1.png",
                "fecha": "Hoy",
                "lugar": "Ahi",
                "sms_texto": "1029",
                "sms_nro": "1209",
                "distancia": 3387818.5066704
            },
            {
                "id": 3,
                "nombre": "PruebaUPDATE",
                "descripcion": "Prueba",
                "sub_categoria_id": 1,
                "lat": 10.100999832153,
                "lng": 10.100999832153,
                "rating": 0,
                "imagen_icono": "img/benefits/icono_1.png",
                "imagen_chica": "img/benefits/imagen_chica_1.png",
                "imagen_grante": "img/benefits/imagen_grande_1.png",
                "imagen_titulo": "img/benefits/imagen_titulo_1.png",
                "fecha": "prueba",
                "lugar": "prueba",
                "sms_texto": "prueba",
                "sms_nro": "prueba",
                "distancia": 11862411.263339
            },
            {
                "id": 2,
                "nombre": "Prueba",
                "descripcion": "Prueba",
                "sub_categoria_id": 1,
                "lat": 10.100999832153,
                "lng": 10.100999832153,
                "rating": 0,
                "imagen_icono": "img/benefits/icono_1.png",
                "imagen_chica": "img/benefits/imagen_chica_1.png",
                "imagen_grante": "img/benefits/imagen_grande_1.png",
                "imagen_titulo": "img/benefits/imagen_titulo_1.png",
                "fecha": "prueba",
                "lugar": "prueba",
                "sms_texto": "prueba",
                "sms_nro": "prueba",
                "distancia": 11862411.263339
            }
        ],
        "status": true
    }


La distancia de cada beneficio está en metros.


### GET /ranking

Indice de Beneficios ordenados por el puntaje acumulado de sus votos.

Ejemplo:

https://api.example.com/api/benefits/ranking

Respuesta Ejemplo:

    {
        "data": [
            {
                "id": 4,
                "nombre": "Esta es una prueba",
                "descripcion": "Esta es una prueba y por lo tanto, tiene contenido de pruebas. Muchas veces es repetitivo, algunas veces es escaso. Hoy, es diferente.",
                "sub_categoria_id": 1,
                "lat": 10.134499549866,
                "lng": -68.123397827148,
                "rating": 10,
                "imagen_icono": "img/benefits/icono_1.png",
                "imagen_chica": "img/benefits/imagen_chica_1.png",
                "imagen_grante": "img/benefits/imagen_grande_1.png",
                "imagen_titulo": "img/benefits/imagen_titulo_1.png",
                "fecha": "Hoy",
                "lugar": "Ahi",
                "sms_texto": "1029",
                "sms_nro": "1209"
            },
            {
                "id": 3,
                "nombre": "PruebaUPDATE",
                "descripcion": "Prueba",
                "sub_categoria_id": 1,
                "lat": 10.100999832153,
                "lng": 10.100999832153,
                "rating": 6,
                "imagen_icono": "img/benefits/icono_1.png",
                "imagen_chica": "img/benefits/imagen_chica_1.png",
                "imagen_grante": "img/benefits/imagen_grande_1.png",
                "imagen_titulo": "img/benefits/imagen_titulo_1.png",
                "fecha": "prueba",
                "lugar": "prueba",
                "sms_texto": "prueba",
                "sms_nro": "prueba"
            },
            {
                "id": 2,
                "nombre": "Prueba",
                "descripcion": "Prueba",
                "sub_categoria_id": 1,
                "lat": 10.100999832153,
                "lng": 10.100999832153,
                "rating": 2.3,
                "imagen_icono": "img/benefits/icono_1.png",
                "imagen_chica": "img/benefits/imagen_chica_1.png",
                "imagen_grante": "img/benefits/imagen_grande_1.png",
                "imagen_titulo": "img/benefits/imagen_titulo_1.png",
                "fecha": "prueba",
                "lugar": "prueba",
                "sms_texto": "prueba",
                "sms_nro": "prueba"
            }
        ],
        "status": true
    }

### POST /{benefit_id}/vote

Votos sobre beneficios. El usuario podrá votar cuantas veces prefiera pero se guardará siempre el último valor y no se guardarán duplicados para un usuario en particular. Requiere datos POST en formato JSON.

Ejemplo:

https://api.example.com/api/benefits/1/vote

Datos:

    {
        "vote": 10
    }

Respuesta Ejemplo:

    {
        "data": {
            "vote": 10,
            "id": "4"
        },
        "status": true
    }

#### GET /{benefit_id}

Información de un beneficio específico.

Ejemplo:

https://api.example.com/api/benefits/4

Respuesta Ejemplo:

    {
        "data": {
            "id": 4,
            "nombre": "Esta es una prueba",
            "descripcion": "Esta es una prueba y por lo tanto, tiene contenido de pruebas. Muchas veces es repetitivo, algunas veces es escaso. Hoy, es diferente.",
            "sub_categoria_id": 1,
            "icono": "img/benefits/icono_1.png",
            "imagen_grande": "img/benefits/imagen_grande_1.png",
            "imagen_chica": "img/benefits/imagen_chica_1.png",
            "imagen_titulo": "img/benefits/imagen_titulo_1.png",
            "fecha": "Hoy",
            "lugar": "Ahi",
            "sms_texto": "1029",
            "sms_nro": "1209",
            "lat": 10.134499549866,
            "lng": -68.123397827148,
            "rating": 0
        },
        "status": true
    }

#### GET /search

Búsqueda de beneficios. Acepta el parámetro q para incluir las palabras claves.

Parámetros:

 - q

Ejemplo:

https://api.example.com/api/benefits/search?q=contenido+de+pruebas

Respuesta Ejemplo:

    {
        "data": [
            {
                "id": 4,
                "nombre": "Esta es una prueba",
                "descripcion": "Esta es una prueba y por lo tanto, tiene contenido de pruebas. Muchas veces es repetitivo, algunas veces es escaso. Hoy, es diferente.",
                "sub_categoria_id": 1,
                "icono": "img/benefits/icono_1.png",
                "imagen_grande": "img/benefits/imagen_grande_1.png",
                "imagen_chica": "img/benefits/imagen_chica_1.png",
                "imagen_titulo": "img/benefits/imagen_titulo_1.png",
                "fecha": "Hoy",
                "lugar": "Ahi",
                "tags": "prueba, beneficio, diferente, contenido",
                "sms_texto": "1029",
                "sms_nro": "1209",
                "lat": 10.134499549866,
                "lng": -68.123397827148,
                "rating": 0,
                "caducado": 0,
                "created_at": "2013-11-25 22:33:12",
                "updated_at": "2013-12-04 01:20:39"
            }
        ],
        "status": true
    }

#### POST /{benefit_id}/ignore

Ignorar un beneficio. Evitará que se regrese en las busquedas por coordenadas.

Ejemplo:

https://api.example.com/api/benefits/1/ignore

Respuesta Ejemplo:

    {
        "data": {
            "id": "2"
        },
        "status": true
    }

### Eventos

URL Base: /api/events

#### GET /

Indice de Eventos. Aceptará parámetros lat y lng para filtrar por coordenadas geográficas.

Parámetros:

 - lat
 - lng

Ejemplo:

https://api.example.com/api/events?lat=10.1234&lng=-69.1234

#### GET /{event_id}

Información detallada de un evento.

Ejemplo:

https://api.example.com/api/events/1

#### GET /search

Busqueda de eventos. Aceptará el parámetro **q** para filtrar.

Parámetros:

 - q

Ejemplo:

https://api.example.com/api/events/search?q=Text+search


### Usuarios

URL Base: /api/users

#### POST /

Registro de usuarios. Es el único punto del WS donde solo se necesita la cabecera de autenticación ENTEL-ACCESS-KEY para utilizarlo. Al registrar exitosamente al usuario, el sistema regresará los mismos datos que fueron enviados mas el valor único para el usuario y que será el valor para la cabecera ENTEL-API-KEY. Como es el valor que identifica al usuario y se entrega una sola vez, es recomendable guardarlo localmente en la aplicación móvil.

Ejemplo:

https://api.example.com/api/users

Datos:

    {
        "nombres": "Pedro Pérez",
        "rut": "12345678-9",
        "telefono_movil": "1234567",
        "email": "pedro@perez.net"
    }

Respuesta de ejemplo:

    {
        "nombres": "Pedro Pérez",
        "rut": "12345678-9",
        "telefono_movil": "1234567",
        "api_key": "d3242ea998d9f8298f029e0"
    }


### Categorías

URL Base: /api/categories

#### GET /

Índice de Categorías

Ejemplo:

https://api.example.com/api/categories

#### GET /{category_id}

Información de categoría específica

Ejemplo:

https://api.example.com/api/categories/1