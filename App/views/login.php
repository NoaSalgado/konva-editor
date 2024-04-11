<section>
    <form class="form" data-form="login" method="POST">
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
            <button type="submit" class="btn btn-submit">Login</button>
            <p>¿No tienes cuenta? <a href="#" data-link="register">Regístrate</a></p>
        </div>
    </form>
</section>