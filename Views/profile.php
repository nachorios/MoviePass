<?php

    $usuario = $_SESSION['loggedUser'];
    
    if(isset($_POST['save_file']) && !empty($_FILES['file_uploaded']['tmp_name'])) {
        $finalRoute = FILES_PATH . basename($_FILES['file_uploaded']['name']);
        $error = false;
        $img_type = pathinfo($finalRoute, PATHINFO_EXTENSION);

        /*$check = getimagesize($_FILES['file_uploaded']['tmp_name']);
        if($check !== false) {
            $error = true;
        }*/
        if($_FILES['file_uploaded']['size']> 500000) {
            $error = true;
        }
        if($img_type != "jpg" && $img_type != "png" && $img_type != "jpeg" && $img_type != "gif") {
            $error = true;
        }
        if(!$error) {
            $fileName = str_replace(".","_",$usuario->getMail());
            if(move_uploaded_file($_FILES['file_uploaded']['tmp_name'], FILES_PATH.$fileName.'.png')) {
                //echo "El archivo". basename($_FILES['file_uploaded']['name']). " ha sido subido.";
            }
        }

    }
    include(MODALS_PATH . 'profile-modals.php');     
    if(isset($error)) {
        if(!$error) {
             ?><script>
                  $(function(){
                       $('#subir-imagen-exito').modal('show');
                  });
             </script><?php
        } else {
             ?><script>
                  $(function(){
                       $('#subir-imagen-error').modal('show');
                  });
             </script><?php
        }
   }
?>



<div class="container bg-light col-8 mb-4 mt-4">
    <div class="row">
        <div class="col-md-3">
            <img src="<?php 
            $fileName = str_replace(".","_",$usuario->getMail()).'.png';
            if($usuario->getProfileImage() != null && !file_exists(FILES_PATH . $fileName)) 
                echo $usuario->getProfileImage();
            else if (file_exists(FILES_PATH . $fileName)) {
                echo URL.'/'. FILES_PATH.$fileName;
            } else 
                echo IMG_PATH.'/user.png';
                ?>" style="width:100%; max-height: 250px; min-height: 250px;" class="img-thumbnail" class="img-responsive" alt="Foto de Perfil">
            <br>
            <form action="#" class="text-center" method="POST" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="file_uploaded" class="form-control btn-primary mt-4 mb-4">Sube una Imagen</label>
                    <input type="file" id="file_uploaded" name="file_uploaded" class="btn_upload" hidden>
                </div>
                <input type="submit" value="Guardar" name="save_file" class="form-control btn-secondary mb-4">
            </form>
        </div>
        <div class="col-md-9">
            <table class="table table-hover">
                <tbody>
                    <tr>
                        <td>
                            <h4><small class="font-italic"><u>Nombre</u></small></h4>
                            <h4><?php echo $usuario->getName() ?></h4>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h4><small><u class="font-italic">Apellido</u></h4>
                            <h4><?php echo $usuario->getLastName() ?></h4>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h4><small><u class="font-italic">Correo Electronico</u></h4>
                            <h4><?php echo $usuario->getMail() ?></h4>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <?php if($usuario->getDni() != null): ?>
                                <h4><small><u class="font-italic">Dni</u></h4>
                                <h4><?php echo $usuario->getDni() ?></h4>
                            <?php else: ?>
                                <!--<h4><small><u class="font-italic">Fecha de nacimiento</u></h4>
                                <h4><?php echo explode(" ", $usuario->getBirthday()->date)[0] ?></h4>-->
                            <?php endif; ?>
                        </td>
                    </tr>
                
                </tbody>
            </table>
        </div>
    </div>
</div>