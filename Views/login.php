
<main class="d-flex align-items-center justify-content-center height-100">
  <div style="background-color:rgb(0,0,0,0.5); margin-top:5%; margin-bottom:5%;">
          <div class="content">
               <header class="text-center">
                    <h2 style="color:white">Ingresar</h2>
               </header>
               <?php include(FORM_PATH ."/login-form.php"); ?>
          </div>
    </div>
    <!-- en vez de class="btn btn-success" o class="btn btn-dark btn-block btn-lg" quedo -->

     <?php
     if (isset($userRegistered)) {
          if($userRegistered) {
          ?>
               <script>
                    $(function(){
                         $('#registro-exito').modal('show');
                    });
               </script>
          <?php
          } else {
          ?>
               <script>
                    $(function(){
                         $('#registro-error').modal('show');
                    });
               </script>
          <?php
          }
     }

     if(isset($logeado)) {
          if(!$logeado) {
               ?>
               <script>
                    $(function(){
                         $('#login-error').modal('show');
                    });
               </script>
          <?php
          }
     }

      ?>

  <div class = "modal fade" id = "registro-exito" role = "dialog">
     <div class = "modal-dialog modal-sm text-success">
          <div class = "modal-content">
               <div class = "modal-header">
                    <h4 class = "modal-title">¡Bienvenido!</h4>
               </div>
               <div class = "modal-body">
                    <p>Usuario registrado con exito.</p>
               </div>
               <div class = "modal-footer">
                    <button type = "button" class = "btn btn-success" data-dismiss = "modal">Aceptar</button>
               </div>
          </div>
     </div>
</div>

<div class = "modal fade" id = "login-error" role = "dialog">
     <div class = "modal-dialog modal-sm text-danger">
          <div class = "modal-content">
               <div class = "modal-header">
                    <h4 class = "modal-title">Error</h4>
               </div>
               <div class = "modal-body">
                    <p>Mail de usuario o contraseña incorrecta.</p>
               </div>
               <div class = "modal-footer">
                    <button type = "button" class = "btn btn-danger" data-dismiss = "modal">Aceptar</button>
               </div>
          </div>
     </div>
</div>

<div class = "modal fade" id = "registro-error" role = "dialog">
     <div class = "modal-dialog modal-sm text-danger">
          <div class = "modal-content">
               <div class = "modal-header">
                    <h4 class = "modal-title">Lo sentimos</h4>
               </div>
               <div class = "modal-body">
                    <p>No se ha logrado registrar la cuenta.</p>
               </div>
               <div class = "modal-footer">
                    <button type = "button" class = "btn btn-danger" data-dismiss = "modal">Aceptar</button>
               </div>
          </div>
     </div>
</div>

    <!--Desarrollo modal-->
    <div class="modal fade" id="mimodal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!--header-->
                <div class="modal-header">
                    <h4 class="modal-title">Registrate!</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!--body-->
                <div class="modal-body">
                  <?php include(FORM_PATH ."/register-form.php") ?>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

<!-- <div style="background-color:rgb(0,0,0,0.5)">
          <div class="content">
               <header class="text-center">
                    <h2 style="color:white">Sign up</h2>
               </header>
               <form action="" method="POST" class="login-form bg-dark-alpha p-5 text-white">
                    <div class="form-group">
                         <label for="">User Name</label>
                         <input type="text" name="user" class="form-control form-control-lg" placeholder="Ingresar usuario">
                    </div>
                    <div class="form-group">
                         <label for="">Password</label>
                         <input type="text" name="pass" class="form-control form-control-lg" placeholder="Ingresar constraseña">
                    </div>
                    <div class="form-group">
                         <label for="">Apellido</label>
                         <input type="text" name="user" class="form-control form-control-lg" placeholder="Ingrese su apellido">
                    </div>
                    <div class="form-group">
                         <label for="">Nombre</label>
                         <input type="text" name="user" class="form-control form-control-lg" placeholder="Ingrese su nombre">
                    </div>
                    <div class="form-group">
                         <label for="">Dni</label>
                         <input type="text" name="user" class="form-control form-control-lg" placeholder="Ingrese su dni">
                    </div>
                    <button class="btn btn-dark btn-block btn-lg" type="submit">Registrarse</button>
               </form>
          </div>
      </div> -->
     </main>
