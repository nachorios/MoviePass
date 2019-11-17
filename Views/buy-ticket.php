<script>
     function actualizarPrecio() {
          var id = $("input[name='function']:checked").val();
          var price = document.getElementById('ticket-price');
          var uniq_price = document.getElementById('value-'+id).innerText;
          var max_amount = document.getElementById('capacity-'+id).innerText;
          price.value = document.getElementById('num-tickets').value * uniq_price;
          document.getElementById('num-tickets').max = max_amount;
     }
     function finalizarCompra() {
          var idFunction = $("input[name='function']:checked").val().split('-')[1];
          window.location.href = "<?php echo URL . '/Boyout/checkout?function=' ?>" + idFunction;
     }
</script>  
<div class="container">
     
<div class="row">
     <div class="col-2">
          <h5 class="text-light">Seleccionar cine: </h5>
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

     <div class="col-7 p-0">
          <div class="tab-content" id="nav-tabContent">
          <?php if(!empty($billboardList)):
               $first = true;
               foreach ($billboardList as $billboard):
                    $cinema = $billboard->getCinema(); ?>
               <div class="tab-pane fade <?php if($first){ $first = false; echo 'show active'; } ?>" id="list-<?php echo $cinema->getIdCinema(); ?>" role="tabpanel" >
                    <div class="jumbotron">
                         <h2 class="display-4"> <?php echo $cinema->getName(); ?> </h2>
                         <p class="lead">Pelicula elegida: <b><?php echo $movie->getTitle(); ?></b>
                         <hr class="my-4">
                         <h3 class="text-center"><u>Selecionar función:</u></h3>
                         <table class="table table-sm text-center">
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
                                        <td id="value-<?php echo $func->getId(); ?>"><?php echo $func->getSaloon()->getValue() ?></td>
                                        <td id="capacity-<?php echo $func->getId(); ?>"><?php echo $func->getSaloon()->getCapacity() ?></td>
                                        <td><input form="buyticket" onclick="actualizarPrecio();" type="radio" value="<?php echo $func->getId(); ?>" name="function" requiered></td>
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
                         <form action="<?php echo URL . '/Boyout/checkout'?>" id="buyticket" method="GET" onsubmit="finalizarCompra();">
                              <div class="form-group">
                                   <label for="">Numero de entradas: </label>
                                   <input type="number" name="num-tickets" onchange="actualizarPrecio();" id="num-tickets" value="0" max="0" class="form-control text-center" min="1" required>
                              </div>
                              <div class="input-group mb-3">
                                   <div class="input-group-prepend">
                                        <span class="input-group-text">Total $</span>
                                   </div>
                                   <input type="text" name="total-price" class="form-control text-center" id="ticket-price" aria-label="" value="0" readonly>
                                   <div class="input-group-append">
                                        <span class="input-group-text">.00</span>
                                   </div>
                              </div>
                              <button type="submit" class="btn btn-warning">Comprar Entradas</button>
                         </form>
                    </div>
               </div>
          </div>
     </div>
</div>
</div>