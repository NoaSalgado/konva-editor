<section>
    <div data-error="register-errors"></div>
    <form class="form" data-form="register" method="POST">
        <div>
            <label for="username"> Nombre de usuario:</label>
            <input type="text" name="username" id="username" placeholder="Nombre de usuario">
            <p class="error" data-error="username"></p>
        </div>

        <div>
            <label for="email"> Email:</label>
            <input type="email" name="email" id="email" placeholder="mail@example.com" required>
            <p class="error" data-error="email"></p>
        </div>

        <div>
            <label for="password"> Password:</label>
            <input type="password" name="password" id="password" required>
            <p class="error" data-error="password"></p>
        </div>

        <div>
            <label for="confirm-password"> Confirmar Password:</label>
            <input type="password" name="confirm-password" id="password" required>
            <p class="error" data-error="confirm-password"></p>
        </div>

        <div>
            <button type="submit" class="btn btn-submit">Registrar</button>
            <p>¿Tienes una cuenta? <a href="#" data-link="login">Inicia sesión</a></p>
        </div>
    </form>
</section>