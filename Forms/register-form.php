<form action= "<?php echo URL?>/user/register" method="POST" class="login-form bg-dark-alpha p-5 text-black">
                       <div class="form-group">
                            <label for="user" >Email</label>
                            <input type="text" name="mail" class="form-control form-control-lg" placeholder="Ingresar nombre de usuario">
                       </div>
                       <div class="form-group">
                            <label for="">Contraseña</label>
                            <input type="password" name="pass" class="form-control form-control-lg" placeholder="Ingresar constraseña">
                       </div>
                       <div class="form-group">
                            <label for="">Nombre</label>
                            <input type="text" name="name" class="form-control form-control-lg" placeholder="Ingrese su nombre">
                       </div>
                       <div class="form-group">
                            <label for="">Apellido</label>
                            <input type="text" name="last-name" class="form-control form-control-lg" placeholder="Ingrese su apellido">
                       </div>
                       <div class="form-group">
                            <label for="">Dni</label>
                            <input type="text" name="dni" class="form-control form-control-lg" placeholder="Ingrese su dni">
                       </div>
                       <input type="text" name="role" value="1" class="form-control form-control-lg" hidden>
                       
                       <button class="btn btn-dark btn-block btn-lg" type="submit">Registrarse</button>
                  </form>