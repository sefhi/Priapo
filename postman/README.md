# Colección de Postman para Sesame API

Esta carpeta contiene los archivos necesarios para probar la API de Sesame utilizando Postman.

## Contenido

- `Sesame.postman_collection.json`: Colección de Postman con todos los endpoints disponibles.
- `Sesame.postman_environment.json`: Variables de entorno para la colección.

## Cómo importar en Postman

1. Abre Postman.
2. Haz clic en el botón "Import" en la esquina superior izquierda.
3. Arrastra los archivos `Sesame.postman_collection.json` y `Sesame.postman_environment.json` a la ventana de importación, o haz clic en "Upload Files" y selecciona ambos archivos.
4. Haz clic en "Import" para completar el proceso.
5. Asegúrate de seleccionar el entorno "Sesame" en el selector de entornos en la esquina superior derecha de Postman.

## Variables de entorno

La colección utiliza las siguientes variables de entorno:

- `baseUrl`: URL base de la API (por defecto: `http://localhost:81/api`)
- `pathUsers`: Ruta para los endpoints de usuarios (por defecto: `users`)
- `pathWorkEntries`: Ruta para los endpoints de entradas de trabajo (por defecto: `work-entries`)

## ⚠️ Formato de fechas

**Importante**: Todos los campos de fecha y hora deben usar el formato **ATOM** (ISO 8601).

- **Formato requerido**: `YYYY-MM-DDTHH:MM:SS+TZ`
- **Ejemplo**: `2025-06-08T09:40:00+00:00`

### Ejemplos de fechas válidas:

- 2025-06-08T09:40:00+00:00 
- 2025-12-25T14:30:15+01:00 
- 2025-01-01T00:00:00Z

### ❌ Formatos NO válidos:

- 2025-06-08 09:40:00 
- 2025/06/08 09:40:00 
- 08-06-2025T09:40:00


## Endpoints disponibles

### Health

- **GET /health**: Comprueba el estado de salud de la API.
  - Ejemplo de uso: Envía una solicitud GET a `{{baseUrl}}/health`.
  - No requiere autenticación.

### Autenticación

- **POST /login**: Inicia sesión y obtiene un token JWT.
  - Ejemplo de uso: Envía una solicitud POST a `{{baseUrl}}/login` con el siguiente cuerpo:
    ```json
    {
        "email": "usuario@ejemplo.com",
        "password": "contraseña"
    }
    ```
  - No requiere autenticación.
  - La respuesta incluirá un token JWT que deberás usar para los endpoints autenticados.

### Usuarios

- **POST /users**: Crea un nuevo usuario.
  - Ejemplo de uso: Envía una solicitud POST a `{{baseUrl}}/{{pathUsers}}` con el siguiente cuerpo:
    ```json
    {
        "id": "uuid-generado",
        "name": "Nombre Usuario",
        "email": "usuario@ejemplo.com",
        "plainPassword": "contraseña",
        "createdAt": "2025-06-08T09:40:00+00:00"
    }
    ```
  - No requiere autenticación.

- **PUT /users/:id**: Actualiza un usuario existente.
  - Ejemplo de uso: Envía una solicitud PUT a `{{baseUrl}}/{{pathUsers}}/id-del-usuario` con el siguiente cuerpo:
    ```json
    {
        "name": "Nuevo Nombre",
        "email": "nuevo@ejemplo.com",
        "createdAt": "2025-06-08T09:40:00+00:00",
        "updatedAt": "2025-06-08T09:40:00+00:00"
    }
    ```
  - No requiere autenticación.

- **GET /users/me**: Obtiene información del usuario autenticado.
  - Ejemplo de uso: Envía una solicitud GET a `{{baseUrl}}/{{pathUsers}}/me`.
  - **Requiere autenticación** con token Bearer.

- **GET /users/:id**: Obtiene información de un usuario específico.
  - Ejemplo de uso: Envía una solicitud GET a `{{baseUrl}}/{{pathUsers}}/id-del-usuario`.
  - No requiere autenticación.

- **DELETE /users/:id**: Elimina un usuario.
  - Ejemplo de uso: Envía una solicitud DELETE a `{{baseUrl}}/{{pathUsers}}/id-del-usuario`.
  - No requiere autenticación.

### Entradas de trabajo (WorkEntry)

- **POST /work-entries**: Crea una nueva entrada de trabajo.
  - Ejemplo de uso: Envía una solicitud POST a `{{baseUrl}}/{{pathWorkEntries}}` con el siguiente cuerpo:
    ```json
    {
        "id": "uuid-generado",
        "userId": "id-del-usuario",
        "startDate": "2025-06-10T09:40:00+00:00",
        "createdAt": "2025-06-08T09:40:00+00:00"
    }
    ```
  - No requiere autenticación.

- **PUT /work-entries/:id**: Actualiza una entrada de trabajo existente.
  - Ejemplo de uso: Envía una solicitud PUT a `{{baseUrl}}/{{pathWorkEntries}}/id-de-la-entrada` con el siguiente cuerpo:
    ```json
    {
        "id": "uuid-generado",
        "userId": "id-del-usuario",
        "startDate": "2025-06-10T09:40:00+00:00",
        "createdAt": "2025-06-08T09:40:00+00:00"
    }
    ```
  - No requiere autenticación.

- **GET /work-entries/:id**: Obtiene información de una entrada de trabajo específica.
  - Ejemplo de uso: Envía una solicitud GET a `{{baseUrl}}/{{pathWorkEntries}}/id-de-la-entrada`.
  - No requiere autenticación.

- **DELETE /work-entries/:id**: Elimina una entrada de trabajo.
  - Ejemplo de uso: Envía una solicitud DELETE a `{{baseUrl}}/{{pathWorkEntries}}/id-de-la-entrada`.
  - No requiere autenticación.

- **GET /work-entries**: Lista todas las entradas de trabajo.
  - Ejemplo de uso: Envía una solicitud GET a `{{baseUrl}}/{{pathWorkEntries}}`.
  - **Requiere autenticación** con token Bearer.

### Control de tiempo (TimeTracking)

- **PATCH /work-entries/:id/clock-in**: Registra la hora de entrada.
  - Ejemplo de uso: Envía una solicitud PATCH a `{{baseUrl}}/{{pathWorkEntries}}/id-de-la-entrada/clock-in` con el siguiente cuerpo:
    ```json
    {
        "startDate": "2025-06-08T09:40:00+00:00"
    }
    ```
  - **Requiere autenticación** con token Bearer.

- **PATCH /work-entries/:id/clock-out**: Registra la hora de salida.
  - Ejemplo de uso: Envía una solicitud PATCH a `{{baseUrl}}/{{pathWorkEntries}}/id-de-la-entrada/clock-out` con el siguiente cuerpo:
    ```json
    {
        "endDate": "2025-06-10T09:40:00+00:00"
    }
    ```
  - **Requiere autenticación** con token Bearer.

## Autenticación con Bearer Token

Varios endpoints requieren autenticación mediante un token JWT. Para usar estos endpoints:

1. Primero, obtén un token utilizando el endpoint `POST /login`.
2. Copia el token JWT de la respuesta.
3. Para los endpoints que requieren autenticación, ve a la pestaña "Authorization" de la request en Postman.
4. Selecciona el tipo "Bearer Token".
5. Pega el token JWT en el campo "Token".

Los endpoints que requieren autenticación con Bearer Token son:
- GET /users/me
- GET /work-entries (listar todos)
- PATCH /work-entries/:id/clock-in
- PATCH /work-entries/:id/clock-out

*Creado con ❤️ y la amable asistencia de la IA* 🤖✨