<?php

//usamos a cinemasList que viene de dao cines del metodo que muestra la vista en cinema controller
if(isset($_GET['delete']))
{ //usamos el metodo de el atributo cinemasList, cinemasList fue igualado a cinemasDAOJSON en ShowCinemasList y borramos por el dato que esta en get
    $cinemasList->Delete($_GET['delete']);
    $borrado = true;
}
?>
<?php
if(isset($_GET['edit'])) {
  $cinemaEdit = $cinemasList->GetCinema($_GET['edit']);
       ?>
       <script>
            $(function(){
                 $('#mimodal').modal('show');
            });
       </script>
  <?php
}
if(isset($editado)) {
       ?>
       <script>
            $(function(){
                 $('#edicion-exito').modal('show');
            });
       </script>
  <?php
}
if(isset($borrado)) {
  ?>
  <script>
       $(function(){
            $('#borrado-exito').modal('show');
       });
  </script>
<?php
}
if(isset($agregado)) {
  if($agregado) {
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
?>
 
<div class = "modal fade" id = "borrado-exito" role = "dialog">
     <div class = "modal-dialog modal-sm text-info">
          <div class = "modal-content">
               <div class = "modal-header">
                    <h4 class = "modal-title">Cine borrado</h4>
               </div>
               <div class = "modal-body">
                    <p>El cine se ha borrado con exito.</p>
               </div>
               <div class = "modal-footer">
                    <button type = "button" class = "btn btn-info" data-dismiss = "modal">Aceptar</button>
               </div>
          </div>
     </div>
</div>
<div class = "modal fade" id = "edicion-exito" role = "dialog">
     <div class = "modal-dialog modal-sm text-success">
          <div class = "modal-content">
               <div class = "modal-header">
                    <h4 class = "modal-title">Cine editado</h4>
               </div>
               <div class = "modal-body">
                    <p>El cine se ha editado con exito.</p>
               </div>
               <div class = "modal-footer">
                    <button type = "button" class = "btn btn-success" data-dismiss = "modal">Aceptar</button>
               </div>
          </div>
     </div>
</div>
<div class = "modal fade" id = "registro-exito" role = "dialog">
     <div class = "modal-dialog modal-sm text-success">
          <div class = "modal-content">
               <div class = "modal-header">
                    <h4 class = "modal-title">Cine Agregado</h4>
               </div>
               <div class = "modal-body">
                    <p>El cine se ha agregado con exito.</p>
               </div>
               <div class = "modal-footer">
                    <button type = "button" class = "btn btn-success" data-dismiss = "modal">Aceptar</button>
               </div>
          </div>
     </div>
</div>
<div class = "modal fade" id = "registro-error" role = "dialog">
     <div class = "modal-dialog modal-sm text-danger">
          <div class = "modal-content">
               <div class = "modal-header">
                    <h4 class = "modal-title">Cine existente</h4>
               </div>
               <div class = "modal-body">
                    <p>El cine que esta intentando agregar ya existe.</p>
               </div>
               <div class = "modal-footer">
                    <button type = "button" class = "btn btn-danger" data-dismiss = "modal">Aceptar</button>
               </div>
          </div>
     </div>
</div>

<div class="modal fade" id="mimodal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!--header-->
                <div class="modal-header">
                    <h4 class="modal-title">Editar</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!--body-->
                <div class="modal-body">
                  <?php include(FORM_PATH ."/cinema-edit-form.php") ?>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

<div class="modal fade" id="newCinema">
        <div class="modal-dialog">
            <div class="modal-content">
                <!--header-->
                <div class="modal-header">
                    <h4 class="modal-title">Cine nuevo</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!--body-->
                <div class="modal-body">
                  <?php     if(isset($_SESSION['loggedUser'])) {
                              if($_SESSION['loggedUser']->getRole()>1) {
                                include(FORM_PATH.'/cinema-add-form.php');
                              }
                             }?>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
<div class="container-fluid text-center ">
     <div class="row mt-5 d-flex justify-content-center" style="background-color: rgb(0,0,0,0.4)">
          <div class="col-8  my-5">
               <table class="table">
                    <thead class="text-light">
                         <th>Nombre</th>
                         <th>Capacidad</th>
                         <th>Direccion</th>
                         <th>Valor unico de entrada</th>
                         <?php
                            if(isset($_SESSION['loggedUser'])) {
                                if($_SESSION['loggedUser']->getRole()>1) {
                                  ?> <th>Accion</th> <?php
                                }
                            }
                          ?>

                    </thead>
<?php
//aca se carga arrayCinemas con los datos de cinemas.json
$arrayCinemas = $cinemasList->GetAll();
if(!empty($arrayCinemas))
{
  foreach ($arrayCinemas as $cinema) {
?>
                    <tbody class="text-light">
                        <td><?php echo $cinema->getName() ?></td>
                        <td><?php echo $cinema->getCapacity() ?></td>
                        <td><a class="text-light font-weight-bold" href="<?php
                        $url = 'https://www.google.com.ar/maps/place/%calle%,+Mar+del+Plata,+Buenos+Aires';
                        $lugar = str_replace(" ", "+",$cinema->getAdress());
                        $url = str_replace("%calle%", $lugar, $url);
                        echo $url;
                        ?>"><?php echo $cinema->getAdress() ?></a></td>
                        <td><?php echo $cinema->getValue() ?></td>
                        <?php
                          if(isset($_SESSION['loggedUser'])) {
                              if($_SESSION['loggedUser']->getRole()>1) {
                                ?>
                                  <td> <a href="<?php echo URL ?>/Cinema/ShowCinemasList?delete=<?php echo $cinema->getName()  ?>"> <button type="submit" class="btn btn-danger">Borrar</button> </a> </td>
                                  <td> <a href="<?php echo URL ?>/Cinema/ShowCinemasList?edit=<?php echo $cinema->getName()  ?>"> <button type="submit" class="btn btn-info">Editar</button> </a> </td>
                                <?php
                              }
                          }
                        ?>
                      </tbody>
<?php   }
        } ?>
                </table>
                <div class="container col-5">
                <button type="button" data-toggle="modal" data-target="#newCinema" class="btn btn-success btn-block btn-lg"">Agregar nuevo cine</button>
                </div>
          </div>
     </div>
     
</div>
