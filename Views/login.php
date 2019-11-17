
<main class="d-flex align-items-center justify-content-center height-100">
  <div style="background-color:rgb(0,0,0,0.5); margin-top:5%; margin-bottom:5%;">
          <div class="content">
               <header class="text-center">
                    <h2 style="color:white">Ingresar</h2>
               </header>
               <?php include(FORMS_PATH ."/login-form.php"); ?>
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

     if(isset($logged)) {
          if(!$logged) {
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

<?php include(MODALS_PATH . 'login-modals.php'); ?>

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
