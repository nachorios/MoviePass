<script>
     function actualizarPrecio() {
          var id = $("input[name='id-function']:checked").val();
          var price = document.getElementById('ticket-price');
          var uniq_price = document.getElementById('value-'+id).innerText;
          var max_amount = document.getElementById('capacity-'+id).innerText;
          document.getElementById('num-tickets').max = max_amount;

          var myDate = new Date();
          var num_tickets = document.getElementById('num-tickets').value;

          if((myDate.getDay() == 6 || myDate.getDay() == 0) && num_tickets > 1/* myDate.getDay() == 2 || myDate.getDay() == 3 */) {
               price.value = document.getElementById('num-tickets').value * uniq_price - ((document.getElementById('num-tickets').value * uniq_price)*0.25);
               document.getElementById("desc").removeAttribute("hidden");
               document.getElementById("is-desc").checked = true;
          } else {
               document.getElementById("desc").setAttribute("hidden", true);
               document.getElementById("is-desc").checked = false;
               price.value = document.getElementById('num-tickets').value * uniq_price;
          }
     }
</script>
<div class="container">
     <div class="row">
          <div class="col-2">
               <h5 class="text-light">Seleccionar cine: </h5>
               <div class="list-group" id="myList" role="tablist">
                    <?php if(!empty($billboardList)) {
                         foreach ($billboardList as $billboard){
                              $cinema = $billboard->getCinema(); ?>
                         <a class="list-group-item list-group-item-action " onclick="document.getElementById('id-cinema').value='<?php echo $cinema->getIdCinema(); ?>'" id="list-<?php echo $cinema->getIdCinema(); ?>-list" data-toggle="list" href="#list-<?php echo $cinema->getIdCinema(); ?>" role="tab" aria-controls="<?php echo $cinema->getIdCinema(); ?>"><?php echo $cinema->getName(); ?></a>
                         <?php }
                    }?>
               </div>
          </div>

          <div class="col-7 p-0">
               <div class="tab-content" id="nav-tabContent">
               <?php if(!empty($billboardList)):
                    foreach ($billboardList as $billboard):
                         $cinema = $billboard->getCinema(); ?>
                    <div class="tab-pane fade " id="list-<?php echo $cinema->getIdCinema(); ?>" role="tabpanel" >
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
                                             <td><input form="buyticket" onclick="actualizarPrecio();" type="radio" value="<?php echo $func->getId(); ?>" name="id-function" requiered></td>
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
                                             <span class="input-group-text">Total<sub class="text-success" id="desc" hidden> -25%</sub></span>
                                        </div>
                                        <input type="text" name="total-price" class="form-control text-center" id="ticket-price" aria-label="" value="0" readonly>
                                        <div class="input-group-append">
                                             <span class="input-group-text">.00$</span>
                                        </div>
                                   </div>

                                   <input type="text" name="id-cinema" id="id-cinema" hidden>
                                   <input type="checkbox" name="is-desc" id="is-desc" hidden>
                                   <input type="text" name="id-movie" id="id-movie" value="<?php echo $movie->getId(); ?>" hidden>
                              </form>
                         </div>

                         <div class="card-footer">
                              <div class="form-group">
                                   <label for="cardNumber">Tarjeta de credito</label>
                                   <div class="input-group">
                                        <input form="buyticket" type="number" min="0" name="cardNumber" placeholder="Numero de tarjeta" class="form-control" required>
                                        <div class="input-group-append">
                                             <span class="input-group-text text-muted">
                                                  <i class="fa fa-cc-visa mx-1"></i>
                                                  <i class="fa fa-cc-mastercard mx-1"></i>
                                             </span>
                                        </div>
                                   </div>
                              </div>
                              <div class="row">
                                   <div class="col-sm-8">
                                        <div class="form-group">
                                             <label><span class="hidden-xs">Vencimiento</span></label>
                                             <div class="input-group">
                                                  <input form="buyticket" type="number" placeholder="Mes" name="" class="form-control" min="0" max="12" required>
                                                  <input form="buyticket" type="number" placeholder="Año" name="" class="form-control" min="0" required>
                                             </div>
                                        </div>
                                   </div>
                                   <div class="col-sm-4">
                                        <div class="form-group mb-4">
                                             <label data-toggle="tooltip" title="Tres digitos detrás de tu tarjeta.">CVV <i class="fa fa-question-circle"></i></label>
                                             <input form="buyticket" type="text" min="0" max="999" required class="form-control">
                                        </div>
                                   </div>
                              </div>

                              <button form="buyticket" type="submit" class="btn btn-warning">Comprar Entradas</button>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</div>
