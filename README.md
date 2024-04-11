# Konva Editor

## Instalación

- Abrir una terminal en el directorio correspondiente del entorno utilizado :

  - `C:\xampp\htdocs` (XAMPP)
  - `C:\laragon\www` (Laragon)

- Clonar repositorio:

```bash
git clone git@github.com:NoaSalgado/konva-editor.git
```

- Iniciar servidor y ejecutar script de creación de la base de datos:

```bash
cd konva-editor

php App/DB/db-cli.php
```

Si es necesario, pueden modificarse los datos de conexión en el archivo App/DB/db-config.php

## Ejecución

- Acceder a la aplicación a través de la url `http://localhost/konva-editor`
- Registrar un nuevo usuario o bien loguearse con el usuario de prueba:
  - Email: demouser@demo.com
  - Password: 123456
- Edición de texto:
  - Aplicar negria: click sobre el texto deseado
  - Introducir/Modificar texto: doble click sobre el texto a editar
