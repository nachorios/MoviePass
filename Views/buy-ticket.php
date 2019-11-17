<script>
     function actualizarPrecio() {
          var price = document.getElementById('ticket-price');
          var uniq_price = $("input[name='function']:checked").val().split('-')[0];
          price.value = document.getElementById('num-tickets').value * uniq_price;
     }
     function finalizarCompra() {
          var idFunction = $("input[name='function']:checked").val().split('-')[0];
          window.location.href = "<?php echo URL . '/Boyout/checkout?function=' ?>" + idFunction;
     }
</script>  
<div class="container">
     
<div class="row">
     <div class="col-3">
          <h4 class="text-light">Seleccionar cine: </h4>
          <div class="list-group" id="myList" role="tablist">
               <?php if(!empty($billboardList)) {
                    $first = true;
                    foreach ($billboardList as $billboard){
                         $cinema = $billboard->getCinema(); ?>
                    <a class="list-group-item list-group-item-action <?php if($first){ $first = false; echo 'active'; } ?>" id="list-<?php echo $cinema->getIdCinema(); ?>-list" data-toggle="list" href="#list-<?php echo $cinema->getIdCinema(); ?>" role="tab" aria-controls="<?php echo $cinema->getIdCinema(); ?>"><?php echo $cinema->getName(); ?></a>
                    <?php }
               }?>
          </div>
     </div>

     <div class="col-6">
          <div class="tab-content" id="nav-tabContent">
          <?php if(!empty($billboardList)):
               $first = true;
               foreach ($billboardList as $billboard):
                    $cinema = $billboard->getCinema(); ?>
               <div class="tab-pane fade <?php if($first){ $first = false; echo 'show active'; } ?>" id="list-<?php echo $cinema->getIdCinema(); ?>" role="tabpanel" >
                    <div class="jumbotron">
                         <h2 class="display-4"> <?php echo $cinema->getName(); ?> </h2>
                         
                         <hr class="my-4">
                         <h3 class="text-center"> <u>Selecionar función</u> </h3>
                         <table class="table text-center">
                              <thead class="text-dark">
                                   <th>Sala</th>
                                   <th>Fecha</th>
                                   <th>Hora</th>
                                   <th>Precio por entrada</th>
                                   <th>Asientos disponibles</th>
                                   <th>Seleccionar</th>
                              </thead>
                              <tbody>
                              <?php if(!empty($billboard->getFunctions())) foreach($billboard->getFunctions() as $func):?>

                                   <tr>
                                        <td><?php echo $func->getSaloon()->getName() ?></td>
                                        <td><?php echo $func->getDate() ?></td>
                                        <td><?php echo $func->getHour() ?></td>
                                        <td><?php echo $func->getSaloon()->getValue().'.00 $' ?></td>
                                        <td><?php echo $func->getSaloon()->getCapacity() ?></td>
                                        <td><input onclick="actualizarPrecio();" type="radio" value="<?php echo $func->getSaloon()->getValue() .'-'. $func->getId(); ?>" name="function" requiered></td>
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

     <div class="mb-4 col-3">
          <div class="list-group text-center" id="myList" role="tablist">
               <div class="card" style="">
                    <img class="card-img-top" src="https://image.tmdb.org/t/p/w500/<?php echo $movie->getPoster_path() ?>" alt="Card image cap">
                    <div class="card-body">
                         <h5 class="card-title"><?php echo $movie->getTitle(); ?></h5>
                         <div class="form-group">
                              <label for="">Numero de entradas: </label>
                              <input type="number" onchange="actualizarPrecio();" id="num-tickets" value="1" class="form-control text-center" min="0">
                         </div>
                         <div class="input-group mb-3">
                              <div class="input-group-prepend">
                                   <span class="input-group-text">$</span>
                              </div>
                              <input type="text" class="form-control text-center" id="ticket-price" aria-label="" value="0" readonly>
                              <div class="input-group-append">
                                   <span class="input-group-text">.00</span>
                              </div>
                         </div>
                         <a onclick="finalizarCompra();" class="btn btn-warning">Comprar Entradas</a>
                    </div>
               </div>
          </div>
     </div>
</div>
</div>