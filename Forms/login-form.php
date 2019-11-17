<?php
    include('Config/fb-config.php');
?>
<script>
function loadingFb() {
      document.getElementById('loading-fb').removeAttribute("hidden");
      document.getElementById('btn-fb').remove();
      return;
  }
</script>

<form action="<?php echo URL ?>/user/login" method="POST" class="login-form bg-dark-alpha p-5 text-white">
    <div class="form-group">
            <label for="mail">Correo electronico</label>
            <input type="email" name="email" id="mail" class="form-control form-control-lg" placeholder="Ingresar correo" required>
    </div>
    <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" name="pass" id="password" class="form-control form-control-lg" placeholder="Ingresar constraseña" required>
    </div>
    <button class="btn btn-success btn-block btn-lg mb-3" type="submit">Iniciar Sesión</button>
    
    <div id="loading-fb" hidden> 
      <button class="btn btn-primary btn-block btn-lg mb-3" type="button" disabled>
          <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
          Ingresando...
      </button>
    </div>
    <a class="text-decoration-none" id="btn-fb" onclick="loadingFb();" href="<?php echo $loginUrl; ?>"> <button class="btn btn-primary btn-block btn-lg mb-3" type="button"><i class="fa fa-facebook-official"></i> Iniciar con Facebook</button> </a>
    <button type="button" data-toggle="modal" data-target="#registerModal" class="btn btn-dark btn-block btn-lg">Registrarse</button>
</form>
