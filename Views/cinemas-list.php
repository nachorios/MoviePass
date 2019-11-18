<?php

     if(isset($editedCinema)) {
          if($editedCinema) {
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
     }

     if(isset($deletedCinema)) {
          if($deletedCinema) {
               ?><script>
                    $(function(){
                         $('#borrado-exito').modal('show');
                    });
               </script><?php
          } else {
               ?><script>
                    $(function(){
                         $('#borrado-error').modal('show');
                    });
               </script><?php
          }
     }

     if(isset($addedCinema)) {
          if($addedCinema) {
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
     if(isset($addedSaloon)) {
          if($addedSaloon) {
               ?><script>
                    $(function(){
                         $('#registro-salon-exito').modal('show');
                    });
               </script><?php
          } else {
               ?><script>
                    $(function(){
                         $('#registro-salon-error').modal('show');
                    });
               </script><?php
          }
     }
     if(isset($addedSaloon)) {
          if($addedSaloon) {
               ?><script>
                    $(function(){
                         $('#registro-salon-exito').modal('show');
                    });
               </script><?php
          } else {
               ?><script>
                    $(function(){
                         $('#registro-salon-error').modal('show');
                    });
               </script><?php
          }
     }
     if(isset($editedSaloon)) {
          if($editedSaloon) {
               ?><script>
                    $(function(){
                         $('#edicion-salon-exito').modal('show');
                    });
               </script><?php
          } else {
               ?><script>
                    $(function(){
                         $('#edicion-salon-error').modal('show');
                    });
               </script><?php
          }
     }
     if(isset($deletedSaloon)) {
          if($deletedSaloon) {
               ?><script>
                    $(function(){
                         $('#borrado-salon-exito').modal('show');
                    });
               </script><?php
          } else {
               ?><script>
                    $(function(){
                         $('#borrado-salon-error').modal('show');
                    });
               </script><?php
          }
     }
?>

<?php
     //aca se carga arrayCinemas con los datos de cinemas.json o con los datos del dao
     $arrayCinemas = $cinemasList->GetAll(); //para json y pdo (la firma de los metodos es la misma)
     if(!is_array($arrayCinemas))
         $arrayCinemas = array($arrayCinemas);
     include(MODALS_PATH . 'cinema-list-modals.php');
?>

<script>
     function editarCine(cine) {
          var data = document.getElementById(cine).value;
          var dataAux = data.split('/');
          document.getElementById('nameCinema').value = dataAux[0];
          document.getElementById('addressCinema').value = dataAux[1];
          document.getElementById('editCinema').value = dataAux[2];
     }

     function editarSaloon(saloon) {
          var data = document.getElementById('salon-'+saloon).value;
          var dataAux = data.split('/');
          document.getElementById('name-saloon').value = dataAux[0];
          document.getElementById('capacity-saloon').value = dataAux[1];
          document.getElementById('value-saloon').value = dataAux[2];
          document.getElementById('editSaloon').value = dataAux[3];
     }

     function agregarSaloon(saloon) {
          document.getElementById('id_cinema').value = saloon;
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

<div class="container">
<div class="row mt-4">
     <div class="col-2">
          <div class="list-group" id="myList" role="tablist">
          <?php if(!empty($arrayCinemas)) {
               $first = true;
               foreach ($arrayCinemas as $cinema) { ?>
               <a class="list-group-item list-group-item-action <?php if($first){ $first = false; echo 'active'; } ?>" id="list-<?php echo $cinema->getIdCinema(); ?>-list" data-toggle="list" href="#list-<?php echo $cinema->getIdCinema(); ?>" role="tab" aria-controls="<?php echo $cinema->getIdCinema(); ?>"><?php echo $cinema->getName(); ?></a>
               <?php }
          }?>
          </div>
     </div>
     <div class="col-8">
          <div class="tab-content" id="nav-tabContent">
          <?php if(!empty($arrayCinemas)):
               $first = true;
               foreach ($arrayCinemas as $cinema): ?>
               <div class="tab-pane fade <?php if($first){ $first = false; echo 'show active'; } ?>" id="list-<?php echo $cinema->getIdCinema(); ?>" role="tabpanel" >
                    <div class="jumbotron">
                         <h2 class="display-4"> <?php echo $cinema->getName(); ?>
                         <?php
                         if(isset($_SESSION['loggedUser'])) {
                              if($_SESSION['loggedUser']->getRole()>1) { ?>
                         <div class="btn-group">
                              <button type="button" value="<?php echo $cinema->getName() . '/' . $cinema->getAdress() . '/' . $cinema->getIdCinema() ?>" id="<?php echo $cinema->getIdCinema()?>" onclick = "editarCine('<?php echo $cinema->getIdCinema()  ?>');" data-toggle="modal" data-target="#editar-modal" class="btn btn-info"><i class="fa fa-pencil-square-o"> Editar</i></button>
                              <button type="button" onclick="loading(this, 'danger', ''); window.location='<?php echo URL ?>/Cinema/deleteCinema?delete=<?php echo $cinema->getIdCinema()  ?>'" class="btn btn-danger"><i class="fa fa-trash-o"> Eliminar</i></button>
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
                              <?php 
                              if($cinema->getSaloon() != null):
                                   $saloons = $cinema->getSaloon();
                                   if(!is_array($saloons))
                                        $saloons = array($saloons);
                                        foreach($saloons as $salon):?>
                                        <tr>
                                             <td><?php echo $salon->getName() ?></td>
                                             <td><?php echo $salon->getCapacity() ?></td>
                                             <td><?php echo $salon->getValue() ?></td>
                                             <?php
                                             if(isset($_SESSION['loggedUser'])) {
                                                  if($_SESSION['loggedUser']->getRole()>1) {
                                                       ?>
                                                       <td><button type="button" value="<?php echo $salon->getName() . '/' . $salon->getCapacity(). '/'. $salon->getValue() . '/'. $salon->getId()  ?>" id="salon-<?php echo $salon->getId()?>" onclick = "editarSaloon('<?php echo $salon->getId() ?>');" data-toggle="modal" data-target="#editar-salon-modal" class="btn btn-info"><i class="fa fa-pencil-square-o"></i></button></td>

                                                       <td><a href="<?php echo URL ?>/Saloon/deleteSaloon?delete-saloon=<?php echo $salon->getId()  ?>" onclick="loading(this, 'danger', '');"> <button type="submit" class="btn btn-danger"><i class="fa fa-trash-o"></i></button> </a> </td>

                                                  <?php
                                                  }
                                             } ?>
                                        </tr>  
                                   <?php endforeach;
                                   endif; ?>
                              </tbody>
                         </table>
                         <?php 
                         if(isset($_SESSION['loggedUser'])):
                              if($_SESSION['loggedUser']->getRole()>1 && (empty($cinema->getSaloon()) || !is_array($cinema->getSaloon()) || count($cinema->getSaloon()) < 5)):
                                   ?>
                         <div class="text-center">
                              <button type="button" onclick = "agregarSaloon('<?php echo $cinema->getIdCinema() ?>');" data-toggle="modal" data-target="#agregar-salon-modal" class="btn btn-warning"><i class="fa fa-plus"> Agregar Salón</i></button>
                         </div>
                         <?php
                              endif;
                         endif; ?>
                    </div>
               </div>
          <?php endforeach;
          else: ?>
               <div class="card text-center border-danger mb-3">
                    <div class="card-header text-danger">
                         No se han encontrado cines...
                    </div>
                    <div class="card-body text-danger">
                    <blockquote class="blockquote mb-0">
                         <p>Vuelve más tarde</p>
                    </blockquote>
                    </div>
               </div>
          <?php endif; ?>
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

</div>