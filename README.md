# Prueba Técnica Solati

Este repositorio contiene la solución a la prueba técnica de Solati.

## Descripción

Este proyecto tiene como objetivo demostrar habilidades en desarrollo de software mediante la implementación de una serie de requisitos técnicos especificados por Solati.

## Instalación

Sigue estos pasos para instalar y configurar el proyecto en tu entorno local:

1. Clona el repositorio:
    ```bash
    git clone https://github.com/tu-usuario/prueba-tecnica-solati.git
    ```

2. Navega al directorio del proyecto:
    ```bash
    cd prueba-tecnica-solati
    ```

3. Instala las dependencias:
    ```bash
    composer install
    ```

4. Configura las variables de entorno (si es necesario):
    ```bash
    cp .env.example .env
    ```

5. Configura la base de datos PostgreSQL:
    ```bash
    # Abre el archivo .env y actualiza las siguientes variables
    DB_CONNECTION=pgsql
    DB_HOST=127.0.0.1
    DB_PORT=5432
    DB_DATABASE=nombre_de_tu_base_de_datos
    DB_USERNAME=tu_usuario
    DB_PASSWORD=tu_contraseña
    ```

6. Si necesitas realizar migraciones de base de datos, ejecuta:
    ```bash
    php artisan migrate
    ```

7. Para generar datos de prueba, puedes usar:
    ```bash
    php artisan db:seed
    ```

8. Para ejecutar las pruebas, utiliza el siguiente comando:
    ```bash
    php artisan test
    ```

9. Inicia la aplicación:
    ```bash
    php artisan serve
    ```

10. Abre tu navegador web y navega a la URL donde se está ejecutando la aplicación, por defecto:
    ```bash
        http://127.0.0.1:8000
