<?php 
if(isset($_SESSION['loggedUser'])) {
  if($_SESSION['loggedUser']->getRole()>1) {
    include(FORM_PATH.'/cinema-add-form.php');
  }
}
?>



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
//viene cargado el dao cines del metodo que muestra la vista en cinema controller
if(isset($_GET['delete']))
{ //borramos por el dato que esta en get
    $cinemasDao->Delete($_GET['delete']);
}
//aca se carga
$arrayCinemas = $cinemasDao->GetAll();

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
                                  <td> <a href="?delete=<?php echo $cinema->getName()  ?>"> <button type="submit" class="btn btn-danger">Borrar</button> </a> </td>
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
