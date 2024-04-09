<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="css/main.css">
    <!-- JQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <!-- KonvaJS -->
    <script src="https://unpkg.com/konva@9/konva.min.js"></script>
    <!-- jsPDF -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js" integrity="sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/" crossorigin="anonymous"></script>
    <script src="js/main.js" type="module" defer></script>

    <title>Konva Editor</title>
</head>

<body>
    <header class="header">
        <h1 class="logo">Konva Editor</h1>
        <nav class="nav">
            <ul class="nav__list">
                <li class="nav__item">
                    <a href="#" class="nav__link" data-link="login">Login</a>
                </li>
                <li class="nav__item">
                    <a href="#" class="nav__link" data-link="register">Registro</a>
                </li>
                <li class="nav__item">
                    <a href="#" class="nav__link" data-link="logout">Cerrar Sesión</a>
                </li>
            </ul>
        </nav>
    </header>
    <main class="main" id="content">

    </main>
</body>

</html>