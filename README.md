![Symfony 6](https://img.shields.io/badge/Symfony-7.2-blueviolet)
![PHP Version](https://img.shields.io/badge/php-8.4-blue.svg)
[![CI](https://github.com/sefhirot69/template-symfony/actions/workflows/build.yml/badge.svg)](https://github.com/sefhirot69/template-symfony/actions/workflows/build.yml)
--------------------------------------

# 🚀 Template Symfony

Este es un template para Symfony 6 en php 8.4, con algunas configuraciones ya predefinidas. Para empezar a desarrollar tu propia
API o microservicio.

## 🛠️ Requisitos

- 🐳 Docker
- __Opcional__: Instalar el comando `make` para mejorar el punto de entrada a nuestra aplicación.
    1. [Instalar en OSX](https://formulae.brew.sh/formula/make)
    2. [Instalar en Window](https://parzibyte.me/blog/2020/12/30/instalar-make-windows/#Descargar_make)

## ⚙️ Configuración del entorno

1. Clona el repositorio o haz un fork
2. Escribe por terminal el comando `make`. Este comando instalara todo lo necesario para arrancar la aplicación.
3. El api está disponible en la url http://localhost:81
   4. Tienes un endpoint para verificar si la aplicación funciona http://localhost:81/api/health

```Puedes cambiar el puerto de salida, en el fichero docker-compose por el que más te guste. O definirlo en el .env```

## 🚀 Comandos Útiles

Este proyecto incluye un Makefile con algunos comandos útiles para el desarrollo. Puedes ejecutarlos con el comando *
*make** seguido del nombre del comando.

### Comandos de Docker Compose

* `make start`: Inicia los contenedores de Docker Compose.
* `make stop`: Detiene los contenedores de Docker Compose.
* `make down`: Detiene y elimina los contenedores de Docker Compose.
* `make recreate`: Reinicia los contenedores de Docker Compose.
* `make rebuild`: Reconstruye los contenedores de Docker Compose.

### Comandos de Composer

* `make deps`: Instala las dependencias del proyecto.
* `make update-deps`: Actualiza las dependencias del proyecto.
* `make clear`: Limpia la caché de Symfony.
* `make bash`: Abre una sesión de terminal en el contenedor de Docker.

### Otros comandos

* `make test`: Ejecuta los tests del proyecto.
* `make lint`: Verifica el cumplimiento de los estándares de codificación.
* `make style`: Corrige los problemas de formato de código.
* `make static-analysis`: Verifica la calidad del código fuente.


📝 Recuerda que puedes consultar los detalles de cada comando en el Makefile del proyecto.

## 🧪 Testing

### Ejecutar todos los tests
```bash
make test
```


## Estructura del proyecto

### Estructura de la carpeta src
```
src
├── Health
│   ├── Application
│   │   ├── Commands
│   │   └── Queries
│   │       ├── GetHealthQuery.php
│   │       ├── GetHealthQueryHandler.php
│   │       └── Response
│   │           └── GetHealthQueryResponse.php
│   ├── Domain
│   │   ├── DatabaseNotHealthyException.php
│   │   ├── Health.php
│   │   └── HealthRepository.php
│   └── Infrastructure
│       ├── Api
│       │   ├── HealthcheckController.php
│       │   └── routes.yaml
│       └── Persistence
│           └── Repository
│               └── DoctrineHealthRepository.php
├── Kernel.php
├── Sesame
│   ├── TimeTracking
│   │   ├── Application
│   │   │   └── Commands
│   │   │       ├── ClockIn
│   │   │       │   ├── ClockInCommand.php
│   │   │       │   └── ClockInHandler.php
│   │   │       └── ClockOut
│   │   │           ├── ClockOutCommand.php
│   │   │           └── ClockOutHandler.php
│   │   ├── Domain
│   │   │   └── Exceptions
│   │   │       ├── WorkEntryAlreadyClockedInException.php
│   │   │       ├── WorkEntryAlreadyClockedOutException.php
│   │   │       ├── WorkEntryNotBelongToUserException.php
│   │   │       └── WorkEntryNotClockedInException.php
│   │   └── Infrastructure
│   │       └── Api
│   │           ├── ClockIn
│   │           │   ├── ClockInController.php
│   │           │   └── ClockInRequest.php
│   │           ├── ClockOut
│   │           │   ├── ClockOutController.php
│   │           │   └── ClockOutRequest.php
│   │           └── routes.yaml
│   ├── User
│   │   ├── Application
│   │   │   ├── Commands
│   │   │   │   ├── CreateUser
│   │   │   │   │   ├── CreateUserCommand.php
│   │   │   │   │   └── CreateUserHandler.php
│   │   │   │   ├── DeleteUser
│   │   │   │   │   ├── DeleteUserCommand.php
│   │   │   │   │   └── DeleteUserHandler.php
│   │   │   │   └── UpdateUser
│   │   │   │       ├── UpdateUserCommand.php
│   │   │   │       └── UpdateUserHandler.php
│   │   │   └── Queries
│   │   │       ├── FindUserById
│   │   │       │   ├── FindUserByIdHandler.php
│   │   │       │   ├── FindUserByIdQuery.php
│   │   │       │   └── UserResponse.php
│   │   │       └── Me
│   │   │           ├── GetUserMeHandler.php
│   │   │           └── GetUserMeQuery.php
│   │   ├── Domain
│   │   │   ├── Entities
│   │   │   │   └── User.php
│   │   │   ├── Exceptions
│   │   │   │   └── UserNotFoundException.php
│   │   │   ├── Repositories
│   │   │   │   ├── UserFindRepository.php
│   │   │   │   └── UserSaveRepository.php
│   │   │   ├── Security
│   │   │   │   ├── AuthenticatedUserProvider.php
│   │   │   │   └── PasswordHasher.php
│   │   │   ├── Services
│   │   │   │   └── EnsureExistsUserByIdService.php
│   │   │   └── ValueObjects
│   │   │       ├── UserName.php
│   │   │       └── UserPassword.php
│   │   └── Infrastructure
│   │       ├── Api
│   │       │   ├── CreateUser
│   │       │   │   ├── CreateUserController.php
│   │       │   │   └── CreateUserRequest.php
│   │       │   ├── DeleteUser
│   │       │   │   └── DeleteUserController.php
│   │       │   ├── FindUserById
│   │       │   │   └── FindUserByIdController.php
│   │       │   ├── Me
│   │       │   │   └── MeController.php
│   │       │   ├── UpdateUser
│   │       │   │   ├── UpdateUserController.php
│   │       │   │   └── UpdateUserRequest.php
│   │       │   └── routes.yaml
│   │       ├── Persistence
│   │       │   ├── Doctrine
│   │       │   │   └── Mapping
│   │       │   │       ├── Entities
│   │       │   │       │   └── User.orm.xml
│   │       │   │       └── ValueObjects
│   │       │   │           ├── UserName.orm.xml
│   │       │   │           └── UserPassword.orm.xml
│   │       │   └── Repositories
│   │       │       ├── DoctrineUserFindRepository.php
│   │       │       └── DoctrineUserSaveRepository.php
│   │       └── Security
│   │           ├── SymfonyAuthenticatedUserProvider.php
│   │           ├── SymfonyPasswordHasher.php
│   │           ├── UserAdapter.php
│   │           └── UserProvider.php
│   └── WorkEntry
│       ├── Application
│       │   ├── Commands
│       │   │   ├── CreateWorkEntry
│       │   │   │   ├── CreateWorkEntryCommand.php
│       │   │   │   └── CreateWorkEntryHandler.php
│       │   │   ├── DeleteWorkEntry
│       │   │   │   ├── DeleteWorkEntryCommand.php
│       │   │   │   └── DeleteWorkEntryHandler.php
│       │   │   └── UpdateWorkEntry
│       │   │       ├── UpdateWorkEntryCommand.php
│       │   │       └── UpdateWorkEntryHandler.php
│       │   └── Queries
│       │       ├── FindWorkEntryByIdHandler.php
│       │       ├── FindWorkEntryByIdQuery.php
│       │       ├── ListWorkEntry
│       │       │   ├── ListWorkEntryHandler.php
│       │       │   ├── ListWorkEntryQuery.php
│       │       │   └── ListWorkEntryResponse.php
│       │       └── WorkEntryResponse.php
│       ├── Domain
│       │   ├── Collections
│       │   │   └── WorkEntries.php
│       │   ├── Entities
│       │   │   └── WorkEntry.php
│       │   ├── Exceptions
│       │   │   └── WorkEntryNotFoundException.php
│       │   ├── Repositories
│       │   │   ├── WorkEntryFindRepository.php
│       │   │   └── WorkEntrySaveRepository.php
│       │   └── Services
│       │       └── EnsureExistWorkEntryByIdService.php
│       └── Infrastructure
│           ├── Api
│           │   ├── CreateWorkEntry
│           │   │   ├── CreateWorkEntryController.php
│           │   │   └── CreateWorkEntryRequest.php
│           │   ├── DeleteWorkEntry
│           │   │   └── DeleteWorkEntryController.php
│           │   ├── FindWorkEntryById
│           │   │   └── FindWorkEntryByIdController.php
│           │   ├── ListWorkEntry
│           │   │   └── ListWorkEntryController.php
│           │   ├── UpdateWorkEntry
│           │   │   ├── UpdateWorkEntryController.php
│           │   │   └── UpdateWorkEntryRequest.php
│           │   └── routes.yaml
│           └── Persistence
│               ├── Doctrine
│               │   └── Mapping
│               │       └── Entities
│               │           └── WorkEntry.orm.xml
│               └── Repositories
│                   ├── DoctrineWorkEntryFindRepository.php
│                   └── DoctrineWorkEntrySaveRepository.php
└── Shared
    ├── Api
    │   └── BaseController.php
    ├── Domain
    │   ├── Aggregate
    │   │   └── AggregateRoot.php
    │   ├── Bus
    │   │   ├── Command
    │   │   │   ├── Command.php
    │   │   │   ├── CommandBus.php
    │   │   │   ├── CommandBusSync.php
    │   │   │   ├── CommandHandler.php
    │   │   │   ├── CommandResponse.php
    │   │   │   ├── CommandSync.php
    │   │   │   └── CommandSyncHandler.php
    │   │   ├── Event
    │   │   │   ├── DomainEvent.php
    │   │   │   ├── EventBus.php
    │   │   │   └── EventHandler.php
    │   │   └── Query
    │   │       ├── Query.php
    │   │       ├── QueryBus.php
    │   │       ├── QueryHandler.php
    │   │       └── QueryResponse.php
    │   ├── Criteria
    │   │   ├── Criteria.php
    │   │   ├── Filter.php
    │   │   ├── FilterField.php
    │   │   ├── FilterOperator.php
    │   │   ├── FilterValue.php
    │   │   ├── Filters.php
    │   │   ├── Order.php
    │   │   ├── OrderBy.php
    │   │   ├── OrderType.php
    │   │   └── OrderTypes.php
    │   ├── Exceptions
    │   │   └── NotFoundException.php
    │   ├── Utils
    │   │   └── Collection.php
    │   └── ValueObjects
    │       ├── Email.php
    │       ├── StringValueObject.php
    │       └── Timestamps.php
    └── Infrastructure
        ├── Bus
        │   ├── Command
        │   │   ├── InMemorySymfonyCommandBus.php
        │   │   └── InMemorySymfonyCommandBusSync.php
        │   ├── Event
        │   │   └── InMemorySymfonyEventBus.php
        │   └── Query
        │       └── InMemorySymfonyQueryBus.php
        ├── Exceptions
        │   └── SymfonyExceptionsHttpStatusCodeMapping.php
        ├── Listener
        │   └── SymfonyExceptionListener.php
        └── Persistence
            ├── Criteria
            │   ├── DoctrineCriteriaConverter.php
            │   └── SqlCriteriaConverter.php
            ├── Doctrine
            │   ├── Filter
            │   │   └── DeletedAtFilter.php
            │   └── Mapping
            │       └── ValueObjects
            │           ├── Email.orm.xml
            │           └── Timestamps.orm.xml
            └── Repository
                └── DoctrineRepository.php
```

### Estructura de la carpeta tests
```
tests
├── Functional
│   ├── BaseApiTestCase.php
│   ├── Health
│   │   └── Infrastructure
│   │       └── Api
│   │           └── HealthcheckControllerTest.php
│   └── Sesame
│       ├── TimeTracking
│       │   └── Infrastructure
│       │       └── Api
│       │           ├── ClockIn
│       │           │   └── ClockInControllerTest.php
│       │           └── ClockOut
│       │               └── ClockOutControllerTest.php
│       ├── User
│       │   └── Infrastructure
│       │       └── Api
│       │           ├── CreateUser
│       │           │   └── CreateUserControllerTest.php
│       │           ├── DeleteUser
│       │           │   └── DeleteUserControllerTest.php
│       │           ├── FindUserById
│       │           │   └── FindUserByIdControllerTest.php
│       │           ├── Me
│       │           │   └── MeControllerTest.php
│       │           └── UpdateUser
│       │               └── UpdateUserControllerTest.php
│       └── WorkEntry
│           └── Infrastructure
│               └── Api
│                   ├── CreateWorkEntry
│                   │   └── CreateWorkEntryControllerTest.php
│                   ├── DeleteWorkEntry
│                   │   └── DeleteWorkEntryControllerTest.php
│                   ├── FindWorkEntryById
│                   │   └── FindWorkEntryByIdControllerTest.php
│                   ├── ListWorkEntry
│                   │   └── ListWorkEntryControllerTest.php
│                   └── UpdateWorkEntry
│                       └── UpdateWorkEntryControllerTest.php
├── Integration
│   └── BaseDoctrineIntegrationTestCase.php
├── Unit
│   ├── Sesame
│   │   ├── TimeTracking
│   │   │   └── Application
│   │   │       └── Commands
│   │   │           ├── ClockIn
│   │   │           │   └── ClockInHandlerTest.php
│   │   │           └── ClockOut
│   │   │               └── ClockOutHandlerTest.php
│   │   ├── User
│   │   │   ├── Application
│   │   │   │   ├── Commands
│   │   │   │   │   ├── CreateUser
│   │   │   │   │   │   ├── CreateUserCommandMother.php
│   │   │   │   │   │   └── CreateUserHandlerTest.php
│   │   │   │   │   ├── DeleteUser
│   │   │   │   │   │   └── DeleteUserHandlerTest.php
│   │   │   │   │   └── UpdateUser
│   │   │   │   │       ├── UpdateUserCommandMother.php
│   │   │   │   │       └── UpdateUserHandlerTest.php
│   │   │   │   └── Queries
│   │   │   │       └── FindUserById
│   │   │   │           └── FindUserByIdHandlerTest.php
│   │   │   └── Domain
│   │   │       ├── Entities
│   │   │       │   └── UserMother.php
│   │   │       └── Services
│   │   │           └── EnsureExistsUserByIdServiceTest.php
│   │   └── WorkEntry
│   │       ├── Application
│   │       │   ├── Commands
│   │       │   │   ├── CreateWorkEntry
│   │       │   │   │   ├── CreateWorkEntryCommandMother.php
│   │       │   │   │   └── CreateWorkEntryHandlerTest.php
│   │       │   │   ├── DeleteWorkEntry
│   │       │   │   │   └── DeleteWorkEntryHandlerTest.php
│   │       │   │   └── UpdateWorkEntry
│   │       │   │       ├── UpdateWorkEntryCommandMother.php
│   │       │   │       └── UpdateWorkEntryHandlerTest.php
│   │       │   └── Queries
│   │       │       └── ListWorkEntry
│   │       │           └── ListWorkEntryHandlerTest.php
│   │       └── Domain
│   │           └── Entities
│   │               └── WorkEntryMother.php
│   └── Shared
│       ├── Application
│       ├── Domain
│       │   ├── Criteria
│       │   │   ├── CriteriaMother.php
│       │   │   ├── FilterMother.php
│       │   │   ├── FilterValueMother.php
│       │   │   ├── FiltersMother.php
│       │   │   ├── OrderByMother.php
│       │   │   ├── OrderMother.php
│       │   │   └── OrderTypeMother.php
│       │   └── ValueObjects
│       │       ├── EmailTest.php
│       │       └── TimestampsMother.php
│       └── Infrastruture
│           ├── Exceptions
│           │   └── SymfonyExceptionsHttpStatusCodeMappingTest.php
│           ├── Listener
│           │   └── SymfonyExceptionListenerTest.php
│           └── Persistence
│               └── Criteria
│                   └── SqlCriteriaConverterTest.php
├── Utils
│   ├── Factory
│   │   ├── AbstractFactory.php
│   │   ├── DoctrinePersistence.php
│   │   ├── PersistenceInterface.php
│   │   ├── User
│   │   │   └── UserFactory.php
│   │   └── WorkEntry
│   │       └── WorkEntryFactory.php
│   └── Mother
│       └── MotherCreator.php
└── bootstrap.php
```

¡Que lo disfrutes! 😎

---------------------------------------------------------------------

### Event Driven

Aunque ya tengo un eventBus y todas las entidades tienen soporte para eventos de dominio, no se ha implementado por falta de tiempo. 
Pero seguramente como es una prueba monolítica, y el redimiento ahora mismo importa poco, la implementación del event bus sería en memoria.

Mi enfoque para esta tarea sería el siguiente:

Como se quiere mantener un registro de todos los cambios de los empleados, crearía un evento de dominio para cada operación que se produzca.
Es decir, si se crea, actualiza o elimina un WorkEntry, eso publicaría un evento de dominio con todos los datos necesarios.

Por ejemplo, si creo un WorkEntry, en el dominio creo el evento **WorkEntryCreated**, y en el caso de uso, una vez ya he persistido
la creación del WorkEntry, publico todos los eventos que hayan ocurrido en ese caso de uso. En este caso, publico el evento **WorkEntryCreated**.
La idea es que los suscriptores de cada evento tengan lo necesario para trabajar con dichos eventos.

En este caso, como tiene pinta de que es para reportes o informes, crearía un bounded context llamado **Report**.
Ese _BC_ tendría un módulo llamado **TrackingWorkEntry**, con una carpeta _Events_ que, a diferencia de los Commands y Queries,
sería la carpeta donde estarían los suscriptores escuchando los eventos.

En esta carpeta de **Events** habría un caso de uso que se podría llamar _WorkEntryCreated_, _WorkEntryUpdated_, etc., con los handlers correspondientes
que harían las operaciones pertinentes.

Otras consideraciones a tener en cuenta: como parece que es para analítica, reportes e informes, tiene que ser una proyección en un _read model_.
Lo que significa que tendría que estar en otra base de datos y mirar con negocio los datos que son necesarios almacenar en la nueva tabla.

A nivel de infraestructura, usaría como sistema de colas principal **Rabbitmq** y configuraría uno secundario por si el primaria falla, que podría ser _OpenSearch_, _ElasticSearch_ o _Postgres_(mi favorito)
para que, si el sistema principal cae o falla, tener un fallback. 

Además añadiría/configuraría un _Dead Letter_, para los reintentos cuando falla repetidamente, guardarlos en base de datos
y con un sistema de cron, volver a reinyectarlos. 

