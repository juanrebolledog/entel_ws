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

Parámetros:

 - lat
 - lng

Ejemplo:

https://api.example.com/api/benefits?lat=10.1234&lng=-69.2134

### GET /ranking

Indice de Beneficios ordenados por el puntaje acumulado de sus votos.

Ejemplo:

https://api.example.com/api/benefits/ranking

### POST /{benefit_id}/vote

Votos sobre beneficios. Requiere datos POST en formato JSON.

Ejemplo:

https://api.example.com/api/benefits/1/vote

Datos:

	{ "vote": 10 }

#### GET /{benefit_id}

Información de un beneficio específico.

Ejemplo:

https://api.example.com/api/benefits/1

#### GET /search

Búsqueda de beneficios. Acepta el parámetro q para incluir las palabras claves.

Parámetros:

 - q

Ejemplo:

https://api.example.com/api/benefits/search?q=Busqueda+beneficio

#### POST /{benefit_id}/ignore

Ignorar un beneficio. Evitará que se regrese en las busquedas por coordenadas.

Ejemplo:

https://api.example.com/api/benefits/1/ignore

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

https://api.example.com/api/users/register

Datos:

	{
		"nombres": "Pedro",
		"apellidos": "Pérez",
		"rut": "12345678-9",
		"telefono_movil": "1234567"
	}

Respuesta de ejemplo:

	{
		"nombres": "Pedro",
		"apellidos": "Pérez",
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