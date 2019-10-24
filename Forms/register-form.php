<form action= "<?php echo URL?>/user/register" method="POST" class="login-form bg-dark-alpha p-5 text-black" oninput='pass.setCustomValidity(pass.value != passReply.value ? "Las contraseñas no coinciden." : "")'>
                       <div class="form-group">
                            <label for="email" >Email</label>
                            <input type="email" id="email" name="mail" class="form-control form-control-lg" placeholder="Ingresar Email" required>
                       </div>
                       <div class="form-group">
                            <label for="passw">Contraseña</label>
                            <input type="password" id="passw" name="pass" class="form-control form-control-lg" placeholder="Ingresar constraseña" required>
                       </div>
                       <div class="form-group">
                            <label for="passw">Repetir Contraseña</label>
                            <input type="password" id="passw" name="passReply" class="form-control form-control-lg" placeholder="Repetir constraseña" required>
                       </div>
                       <div class="form-group">
                            <label for="name">Nombre</label>
                            <input type="text" id="name" name="name" class="form-control form-control-lg" placeholder="Ingrese su nombre" required>
                       </div>
                       <div class="form-group">
                            <label for="lastname">Apellido</label>
                            <input type="text" id="lastname" name="last-name" class="form-control form-control-lg" placeholder="Ingrese su apellido" required>
                       </div>
                       <div class="form-group">
                            <label for="dni">Dni</label>
                            <input type="number" id="dni" name="dni" class="form-control form-control-lg" placeholder="Ingrese su dni" required>
                       </div>
                       <input type="text" name="role" value="1" class="form-control form-control-lg" hidden>
                       
                       <button class="btn btn-dark btn-block btn-lg" type="submit">Registrarse</button>
                  </form>