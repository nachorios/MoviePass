<form action="<?php echo URL ?>/Home/Index" method="POST" class="login-form bg-dark-alpha p-5 text-white">
    <div class="form-group">
            <label for="">Nombre de usuario</label>
            <input type="text" name="user" class="form-control form-control-lg" placeholder="Ingresar usuario">
    </div>
    <div class="form-group">
            <label for="">Contraseña</label>
            <input type="text" name="pass" class="form-control form-control-lg" placeholder="Ingresar constraseña">
    </div>
    <button class="btn btn-success btn-block btn-lg" type="submit">Iniciar Sesión</button>
    <div class="fb-login-button" data-width="" data-size="large" data-button-type="continue_with" data-auto-logout-link="false" data-use-continue-as="true">Logearse con facebook (a futuro)</div>
    <button type="button" data-toggle="modal" data-target="#mimodal" class="btn btn-success btn-block btn-lg"">Registrarse</button> 
</form>