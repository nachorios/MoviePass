<?php
if(isset($_SESSION['loggedUser'])) {
  if($_SESSION['loggedUser']->getRole()>1) {
    include(FORM_PATH.'/cinema-add-form.php');
  }
}
?>
<?php
if(isset($_GET['edit'])) {
       ?>
       <script>
            $(function(){
                 $('#mimodal').modal('show');
            });
       </script>
  <?php
}

?>

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

<div class="container-fluid text-center">
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
//usamos a cinemasList que viene de dao cines del metodo que muestra la vista en cinema controller
if(isset($_GET['delete']))
{ //usamos el metodo de el atributo cinemasList, cinemasList fue igualado a cinemasDAOJSON en ShowCinemasList y borramos por el dato que esta en get
    $cinemasList->Delete($_GET['delete']);
}
//aca se carga arrayCinemas con los datos de cinemas.json
$arrayCinemas = $cinemasList->GetAll();

if(!empty($arrayCinemas))
{
  foreach ($arrayCinemas as $cinema) {
?>
                    <tbody class="text-light">
                        <td><?php echo $cinema->getName() ?></td>
                        <td><?php echo $cinema->getCapacity() ?></td>
                        <td><?php echo $cinema->getAdress() ?></td>
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
          </div>
     </div>
</div>
