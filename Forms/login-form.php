<form action="<?php echo URL ?>/user/login" method="POST" class="login-form bg-dark-alpha p-5 text-white">
    <div class="form-group">
            <label for="">Email</label>
            <input type="email" name="user" class="form-control form-control-lg" placeholder="Ingresar correo" required>
    </div>
    <div class="form-group">
            <label for="">Contraseña</label>
            <input type="text" name="pass" class="form-control form-control-lg" placeholder="Ingresar constraseña" required>
    </div>
    <button class="btn btn-success btn-block btn-lg" type="submit">Iniciar Sesión</button>
    <div class="fb-login-button" data-width="" data-size="large" data-button-type="continue_with" data-auto-logout-link="false" data-use-continue-as="true">Logearse con facebook (a futuro)</div>
    <button type="button" data-toggle="modal" data-target="#mimodal" class="btn btn-success btn-block btn-lg"">Registrarse</button> 
</form>