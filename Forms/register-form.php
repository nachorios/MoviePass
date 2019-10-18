<form action= "<?php echo URL?>/user/register" method="POST" class="login-form bg-dark-alpha p-5 text-black">
                       <div class="form-group">
                            <label for="user" >Email</label>
                            <input type="email" name="mail" class="form-control form-control-lg" placeholder="Ingresar nombre de usuario" required>
                       </div>
                       <div class="form-group">
                            <label for="">Contraseña</label>
                            <input type="password" name="pass" class="form-control form-control-lg" placeholder="Ingresar constraseña" required>
                       </div>
                       <div class="form-group">
                            <label for="">Nombre</label>
                            <input type="text" name="name" class="form-control form-control-lg" placeholder="Ingrese su nombre" required>
                       </div>
                       <div class="form-group">
                            <label for="">Apellido</label>
                            <input type="text" name="last-name" class="form-control form-control-lg" placeholder="Ingrese su apellido" required>
                       </div>
                       <div class="form-group">
                            <label for="">Dni</label>
                            <input type="number" name="dni" class="form-control form-control-lg" placeholder="Ingrese su dni" required>
                       </div>
                       <input type="text" name="role" value="1" class="form-control form-control-lg" hidden>
                       
                       <button class="btn btn-dark btn-block btn-lg" type="submit">Registrarse</button>
                  </form>