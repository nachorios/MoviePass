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
        } else {
               ?><script> //intente hacer un error para cuando haces una modificacion erronea - ignacio chiaradia 8/11
                    $(function(){
                         $('#edicion-error').modal('show');
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
     //aca se carga arrayCinemas con los datos de cinemas.json o con los datos del dao
     $arrayCinemas = $cinemasList->GetAll(); //para json y pdo (la firma de los metodos es la misma)

     include(MODALS_PATH . 'cinema-list-modals.php');
?>

<script>
     function editarCine(cine) {
          var data = document.getElementById(cine).value;
          var dataAux = data.split('/');
          document.getElementById('nameCinema').value = dataAux[0];
          document.getElementById('adressCinema').value = dataAux[1];
          document.getElementById('editCinema').value = cine;
     }

     function editarSaloon(saloon) {
          var data = document.getElementById('salon-'+saloon).value;
          var dataAux = data.split('/');
          document.getElementById('name-saloon').value = dataAux[0];
          document.getElementById('value-saloon').value = dataAux[1];
          document.getElementById('capacity-saloon').value = dataAux[2];
          document.getElementById('editSaloon').value = dataAux[3];
     }

    function loading(element, type, text) {
        //document.getElementById('loading-add').removeAttribute("hidden");
        element.innerHTML = '<button class="btn btn-'+type+'" type="button" disabled> <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> <span>'+text+'</span> </button>';
        return;
    }

     $('#myList a').on('click', function (e) {
          e.preventDefault()
          $(this).tab('show')
     })
</script>

<div class="row mt-4">
     <div class="col-2">
          <div class="list-group" id="myList" role="tablist">
          <?php if(!empty($arrayCinemas)) {
               $first = true;
               foreach ($arrayCinemas as $cinema) { ?>
               <a class="list-group-item list-group-item-action <?php if($first){ $first = false; echo 'active'; } ?>" id="list-<?php echo $cinema->getName(); ?>-list" data-toggle="list" href="#list-<?php echo $cinema->getName(); ?>" role="tab" aria-controls="<?php echo $cinema->getName(); ?>"><?php echo $cinema->getName(); ?></a>
               <?php }
          }?>  
          </div>
     </div>
     <div class="col-8">
          <div class="tab-content" id="nav-tabContent">
          <?php if(!empty($arrayCinemas)):
               $first = true;
               foreach ($arrayCinemas as $cinema): ?>
               <div class="tab-pane fade <?php if($first){ $first = false; echo 'show active'; } ?>" id="list-<?php echo $cinema->getName(); ?>" role="tabpanel" >
                    <div class="jumbotron">
                         <h2 class="display-4"> <?php echo $cinema->getName(); ?> 
                         <?php
                         if(isset($_SESSION['loggedUser'])) {
                              if($_SESSION['loggedUser']->getRole()>1) { ?>
                         <div class="btn-group">
                              <button type="button" value="<?php echo $cinema->getName() . '/' . $cinema->getAdress() . '/' . $cinema->getIdCinema() ?>" id="<?php echo $cinema->getIdCinema()?>" onclick = "editarCine('<?php echo $cinema->getIdCinema()  ?>');" data-toggle="modal" data-target="#editar-modal" class="btn btn-info"><i class="fa fa-pencil-square-o"> Editar</i></button>
                              <button type="button" onclick="loading(this, 'danger', ''); window.location='<?php echo URL ?>/Cinema/ShowCinemasList?delete=<?php echo $cinema->getIdCinema()  ?>'" class="btn btn-danger"><i class="fa fa-trash-o"> Eliminar</i></button>
                         </div>
                              <?php }
                          }?> 
                         </h2>
                         <p class="lead">Direccion del cine: 
          
                         <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#<?php echo str_replace(" ", "-",$cinema->getAdress()); ?>"><?php echo $cinema->getAdress() ?></button>
                         <!--Modal Direccion-->
                         <div class="modal fade" id="<?php echo str_replace(" ", "-",$cinema->getAdress()); ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-lg" role="document">
                              <!--Content-->
                                   <div class="modal-content">
                                        <!--Body-->
                                        <div class="modal-body mb-0 p-0">
                                        <!--Google map-->
                                             <div id="map-container-google-2" class="z-depth-1-half map-container" style="height: 500px">
                                                  <div id="googleMap" style="width:100%;height:400px;">
                                                  <?php echo '<iframe frameborder="0" width="798" height="500" src="https://maps.google.com/maps?f=q&source=s_q&hl=en&geocode=&q=' . str_replace(",", "", str_replace(" ", "+", $cinema->getAdress())) . '&z=14&output=embed"></iframe>'; ?>
                                                  </div>
                                             </div>
                                        <!--Google Maps-->
                                        </div>
                                        <!--Footer-->
                                        <div class="modal-footer justify-content-center">
                                        <button type="button" class="btn btn-outline-secondary btn-md" data-dismiss="modal">Cerrar <i class="fa fa-check-circle"></i></button>
                                        </div>
                                   </div>
                              <!--/.Content-->
                              </div>
                         </div>
                         <!--Fin Modal Direccion-->
          
                         <hr class="my-4">
                         <h3 class="text-center"> <u>Salas de cine disponibles</u> </h3>
                         <table class="table text-center">
                              <thead class="text-dark">
                                   <th>Nombre</th>
                                   <th>Capacidad</th>
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
                              <tbody>
                              <?php foreach($cinema->getSaloon() as $salon):?>
                              
                                   <tr>
                                        <td><?php echo $salon->getName() ?></td>
                                        <td><?php echo $salon->getValue() ?></td>
                                        <td><?php echo $salon->getCapacity() ?></td>
                                        <?php
                                        if(isset($_SESSION['loggedUser'])) {
                                        if($_SESSION['loggedUser']->getRole()>1) {
                                             ?>
                                             <td><button type="button" value="<?php echo $salon->getName() . '/' . $salon->getValue(). '/'. $salon->getCapacity() . '/'. $salon->getId()  ?>" id="salon-<?php echo $salon->getId()?>" onclick = "editarSaloon('<?php echo $salon->getId() ?>');" data-toggle="modal" data-target="#editar-salon-modal" class="btn btn-info"><i class="fa fa-pencil-square-o"></i></button></td>

                                             <td><a href="<?php echo URL ?>/Cinema/ShowCinemasList?delete-saloon=<?php echo $salon->getId()  ?>" onclick="loading(this, 'danger', '');"> <button type="submit" class="btn btn-danger"><i class="fa fa-trash-o"></i></button> </a> </td>

                                        <?php
                                        }
                                        }
                                   ?>
                                   </tr>
                                   <?php endforeach; ?>
                              </tbody>
                         </table>
                    </div>
               </div>
          <?php endforeach; 
          endif; ?>            
          </div>
     </div>
     
     <div class="mb-4 <?php echo (!empty($arrayCinemas)) ? 'col-2' : 'container' ?>">
          <div class="list-group" id="myList" role="tablist">
          <?php
          if(isset($_SESSION['loggedUser'])) {
               if($_SESSION['loggedUser']->getRole()>1) { ?>
                    <button type="button" data-toggle="modal" data-target="#newCinema" class="btn btn-success btn-block btn-lg">Agregar nuevo cine</button>
          <?php }
          }?> 
          </div>
     </div>
</div>
