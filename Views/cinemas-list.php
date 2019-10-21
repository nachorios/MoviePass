<form action="<?php echo URL?>/cinema/registerCinema" method="POST" class="text-white">
  <div class="form-group">
    <label for="nameCinema"> Nombre del cine: </label>
    <input type="text" name="name" class="form-control" id="nameCinema" placeholder="Ingresar nombre del cine" required> </input>
  </div>
  <div class="form-group">
    <label for="capacityCinema"> Capacidad de sala: </label>
    <input type="number" name="capacity" class="form-control" id="capacityCinema" placeholder="Ingresar capacidad de sala" required> </input>
  </div>
  <div class="form-group">
    <label for="adressCinema"> Direccion: </label>
    <input type="text" name="adress" class="form-control" id="adressCinema" placeholder="Ingresar direccion" required> </input>
  </div>
  <div class="form-group">
    <label for="valueCine"> Valor entrada: </label>
    <input type="text" name="value" class="form-control" id="valueCine" placeholder="Ingresar valor unico de entrada" required> </input>
  </div>
  <button type="submit" class="btn btn-success btn-lg">Agregar</button>
</form>



<div class="container-fluid text-center">
     <div class="row mt-5 d-flex justify-content-center" style="background-color: rgb(0,0,0,0.4)">
          <div class="col-8  my-5">
               <table class="table">
                    <thead class="text-light">
                         <th>Nombre</th>
                         <th>Capacidad</th>
                         <th>Direccion</th>
                         <th>Valor unico de entrada</th>
                         <th>Accion</th>
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
                        <td> <a href="?delete=<?php echo $cinema->getName()  ?>"> <button type="submit" class="btn btn-danger">Borrar</button> </a> </td>
                    </tbody>
<?php   }
        } ?>
                </table>
          </div>
     </div>
</div>
