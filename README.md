# VirtualMeet - Plataforma de Conferencias Virtuales

VirtualMeet es una plataforma web desarrollada en Laravel que permite a los usuarios registrarse y comprar boletos para conferencias virtuales. Está construida utilizando tecnologías como Jetstream, AdminLTE, Blade, Tailwind CSS, JavaScript, MySQL y Vite.

## Características

- **Laravel y Jetstream:** El proyecto está desarrollado utilizando el framework Laravel y la plantilla Jetstream, lo que proporciona una base sólida para la autenticación, autorización y gestión de usuarios.
- **AdminLTE y Blade:** Se utiliza el tema AdminLTE para el diseño de la interfaz de administración. Blade, el motor de plantillas de Laravel, permite construir las vistas de manera eficiente y dinámica.
- **Tailwind CSS:** Se emplea Tailwind CSS como framework CSS para facilitar el diseño y estilizado de los componentes de la interfaz.
- **JavaScript:** Se utiliza JavaScript para implementar funcionalidades interactivas y dinámicas en el frontend.
- **MySQL:** La base de datos MySQL se utiliza para almacenar la información de los usuarios, conferencias y boletos adquiridos.
- **Vite:** Vite se utiliza como un bundler rápido y eficiente para compilar y construir el código JavaScript y CSS del proyecto.
- **patron de diseño repositorie:** el proyecto implementa el patrón de diseño Repositorio para separar la lógica de acceso a datos de la lógica de negocio.

## Uso

1. Clona este repositorio en tu máquina local.
2. Asegúrate de tener instalado PHP, Composer y Node.js en tu entorno de desarrollo.
3. Ejecuta `composer install` para instalar las dependencias de PHP.
4. Ejecuta `npm install` para instalar las dependencias de JavaScript.
5. Crea una copia del archivo `.env.example` y renómbrala como `.env`. Configura las variables de entorno según tu configuración local.
6. Genera una nueva clave de aplicación utilizando el comando `php artisan key:generate`.
7. Ejecuta las migraciones y los seeders utilizando los siguientes comandos:
   - `php artisan migrate` para ejecutar las migraciones de la base de datos.
   - `php artisan db:seed` para ejecutar los seeders y poblar la base de datos con datos de prueba.
8. Inicia el servidor de desarrollo con el comando `php artisan serve`.
9. Accede a la aplicación en tu navegador y regístrate para obtener una cuenta de administrador.
10. En la sección administrativa, podrás gestionar las conferencias, los boletos y otras configuraciones de la plataforma.

## Credenciales de Acceso

- **Rol de Administrador:**
  - Correo electrónico: *regístrate para obtener una cuenta de administrador*
  - Contraseña: *la que hayas proporcionado al registrarte*

- **Cuenta de PayPal:**
  - Correo electrónico: sb-b470rb25154544@personal.example.com
  - Contraseña: 1_Sm@{W?

## Contribución

Si deseas contribuir a este proyecto, puedes seguir estos pasos:

1. Haz un fork de este repositorio.
2. Crea una rama con la nueva funcionalidad o corrección que deseas implementar.
3. Realiza tus cambios y realiza commits descriptivos.
4. Envía una solicitud de pull con tus cambios.

Agradecemos todas las contribuciones y sugerencias para mejorar este proyecto.
