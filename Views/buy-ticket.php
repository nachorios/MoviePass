    <div class="row mt-4">
     <div class="col-2">
    <h4 class="text-light">Seleccionar cine: </h4>
          <div class="list-group" id="myList" role="tablist">
          <?php if(!empty($cinemasList)) {
               $first = true;
               foreach ($cinemasList as $cinema) { ?>
               <a class="list-group-item list-group-item-action <?php if($first){ $first = false; echo 'active'; } ?>" id="list-<?php echo $cinema->getIdCinema(); ?>-list" data-toggle="list" href="#list-<?php echo $cinema->getIdCinema(); ?>" role="tab" aria-controls="<?php echo $cinema->getIdCinema(); ?>"><?php echo $cinema->getName(); ?></a>
               <?php }
          }?>
          </div>
     </div>
     <div class="col-8">
          <div class="tab-content" id="nav-tabContent">
          <?php if(!empty($cinemasList)):
               $first = true;
               foreach ($cinemasList as $cinema): ?>
               <div class="tab-pane fade <?php if($first){ $first = false; echo 'show active'; } ?>" id="list-<?php echo $cinema->getIdCinema(); ?>" role="tabpanel" >
                    <div class="jumbotron">
                         <h2 class="display-4"> <?php echo $cinema->getName(); ?> </h2>
                        
                         <hr class="my-4">
                         <h3 class="text-center"> <u>Salas de cine disponibles</u> </h3>
                         <table class="table text-center">
                              <thead class="text-dark">
                                   <th>Nombre</th>
                                   <th>Valor unico de entrada</th>
                                   <th>Capacidad</th>
                                   <th>Seleccionar</th>
                              </thead>
                              <tbody>
                              <?php if(!empty($cinema->getSaloon())) foreach($cinema->getSaloon() as $salon):?>

                                   <tr>
                                        <td><?php echo $salon->getName() ?></td>
                                        <td><?php echo $salon->getValue() ?></td>
                                        <td><?php echo $salon->getCapacity() ?></td>
                                        <td><input type="radio" name="saloon"></td>
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

     <div class="mb-4 col-2">
            <div class="list-group text-center" id="myList" role="tablist">
                <div class="card" style="">
                    <img class="card-img-top" src="https://image.tmdb.org/t/p/w500/<?php echo $movie->getPoster_path() ?>" alt="Card image cap">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $movie->getTitle(); ?></h5>
                        <div class="form-group">
                            <label for="">Numero de entradas: </label>
                            <input type="number" class="form-control text-center" min="0">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">$</span>
                            </div>
                            <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)" value="150" readonly>
                            <div class="input-group-append">
                                <span class="input-group-text">.00</span>
                            </div>
                        </div>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>
            </div>
     </div>
</div>
