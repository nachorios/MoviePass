<?php

     //usamos a cinemasList que viene de dao cines del metodo que muestra la vista en cinema controller
     if(isset($_GET['delete']))
     { //usamos el metodo de el atributo cinemasList, cinemasList fue igualado a cinemasDAOJSON en ShowCinemasList y borramos por el dato que esta en get
          $cinemasList->Delete($_GET['delete']);
          $borrado = true;
     }

     if(isset($_GET['edit'])) {
     $cinemaEdit = $cinemasList->GetCinema($_GET['edit']);
          ?><script>
               $(function(){
                    $('#mimodal').modal('show');
               });
          </script><?php
     }

     if(isset($editado)) {
          ?><script>
               $(function(){
                    $('#edicion-exito').modal('show');
               });
          </script><?php
     }

     if(isset($borrado)) {
          ?><script>
               $(function(){
                    $('#borrado-exito').modal('show');
               });
          </script><?php
     }

     if(isset($agregado)) {
          if($agregado) {
               ?><script>
                    $(function(){
                         $('#registro-exito').modal('show');
                    });
               </script><?php
          } else {
               ?><script>
                    $(function(){
                         $('#registro-error').modal('show');
                    });
               </script><?php
          }
     }
?>

<?php 
     //aca se carga arrayCinemas con los datos de cinemas.json
     $arrayCinemas = $cinemasList->GetAll();
     include(MODALS_PATH . 'cinema-list-modals.php'); 
?>

<script>
     function editarCine(cine) {
          var data = document.getElementById(cine).value;  
          var dataAux = data.split('/');
          document.getElementById('nameCinema').value = dataAux[0];
          document.getElementById('capacityCinema').value = dataAux[1];
          document.getElementById('adressCinema').value = dataAux[2];
          document.getElementById('valueCinema').value = dataAux[3];
          document.getElementById('editCinema').value = cine;
     }
</script>

<div class="container-fluid text-center ">
     <div class="row mt-5 d-flex justify-content-center" style="background-color: rgb(0,0,0,0.4)">
          <div class="col-8  my-5">
               <table class="table">
                    <thead class="text-light">
                         <th>Nombre</th>
                         <th>Capacidad</th>
                         <th>Dirección</th>
                         <th>Valor unico de entrada</th>
                         <?php
                            if(isset($_SESSION['loggedUser'])) {
                                   if($_SESSION['loggedUser']->getRole()>1) {
                                   ?> 
                                   <th>Modificar</th> 
                                   <th>Eliminar</th
                                   ><?php
                                   }
                              }?>
                    </thead>
          <?php
               if(!empty($arrayCinemas)) {
                    foreach ($arrayCinemas as $cinema) {
          ?>
                    <tbody class="text-light">
                        <td><?php echo $cinema->getName() ?></td>
                        <td><?php echo $cinema->getCapacity() ?></td>
                        <td><a class="text-light font-weight-bold" target="_blank" href="<?php
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
                                   <td><button type="button" value="<?php echo $cinema->getName() . '/' . $cinema->getCapacity() . '/' . $cinema->getAdress() . '/' . $cinema->getValue() ?>" id="<?php echo $cinema->getName()?>" onclick = "editarCine('<?php echo $cinema->getName()  ?>');" data-toggle="modal" data-target="#editar-modal" class="btn btn-info"><i class="fa fa-pencil-square-o"></i></button></td>
                                   
                                   <td> <a href="<?php echo URL ?>/Cinema/ShowCinemasList?delete=<?php echo $cinema->getName()  ?>"> <button type="submit" class="btn btn-danger"><i class="fa fa-trash-o"></i></button> </a> </td>
                                   
                                   <!--<td> <a href="<?php echo URL ?>/Cinema/ShowCinemasList?edit=<?php echo $cinema->getName()  ?>"> <button type="submit" class="btn btn-info"><i class="fa fa-pencil-square-o"></i></button> </a> </td>
                                   <td> <a href="<?php echo URL ?>/Cinema/ShowCinemasList?delete=<?php echo $cinema->getName()  ?>"> <button type="submit" class="btn btn-danger"><i class="fa fa-trash-o"></i></button> </a> </td>
                                   -->
                              <?php
                              }
                          }
                        ?>
                      </tbody>
          <?php   }
          }?>
                </table>
                <div class="container col-5">
                <?php
                if(isset($_SESSION['loggedUser'])) {
                    if($_SESSION['loggedUser']->getRole()>1) {
                      ?>
                         <button type="button" data-toggle="modal" data-target="#newCinema" class="btn btn-success btn-block btn-lg">Agregar nuevo cine</button>
                      <?php
                    }
                   }?>
                
                </div>
          </div>
     </div>

</div>
