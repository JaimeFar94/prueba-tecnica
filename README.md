Acerca del proyecto

Este repositorio corresponde a una prueba técnica de la empresa Aicoll, donde se utiliza el framework Laravel (PHP) para desarrollar una REST API que gestiona información de empresas.

La API permite:

Crear nuevas empresas (con estado Activo por defecto).

Consultar todas las empresas o una en particular.

Actualizar la información completa o parcial de una empresa.

Eliminar empresas únicamente cuando se encuentran en estado Inactivo.


requisitos:

php
composer
Laravel

Ejecutar las migraciones:

php artisan migrate

Para iniciar el proyecto se utiliza el comando:

php artisan serve

La API estará disponible en:

http://127.0.0.1:8000/api/companies

Endpoints principales

GET /api/companies → Listar todas las empresas.

GET /api/companies/{id} → Consultar una empresa por ID.

POST /api/companies → Crear una nueva empresa.

PUT /api/companies/{id} → Actualizar una empresa (todos los campos).

PATCH /api/companies/{id} → Actualizar parcialmente una empresa.

DELETE /api/companies/{id} → Eliminar una empresa (solo si está inactiva).


