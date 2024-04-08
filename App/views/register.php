<section>
    <form class="form" data-form="register">
        <div>
            <label for="username"> Nombre de usuario:</label>
            <input type="text" name="username" id="username" placeholder="Nombre de usuario">
        </div>

        <div>
            <label for="email"> Email:</label>
            <input type="email" name="email" id="email" placeholder="mail@example.com" required>
        </div>

        <div>
            <label for="password"> Password:</label>
            <input type="password" name="password" id="password" required>
        </div>

        <div>
            <label for="confirm-password"> Confirmar Password:</label>
            <input type="confirm-password" name="confirm-password" id="password" required>
        </div>

        <div>
            <button type="submit" class="btn-submit">Registrar</button>
            <p>¿Tienes una cuenta? <a href="#" data-link="login">Inicia sesión</a></p>
        </div>
    </form>
</section>