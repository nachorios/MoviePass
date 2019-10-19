  <main class="my-5" ">
       <section class="mb-5">
            <div class="container-fluid">
                 <div class="row-fluid">
                      <h2 class="display-2 text-center text-light ">Peliculas en proyeccion</h2>
                 </div>
            </div>
       </section>
  </main>
  <?php 
  echo "<select name='tv_taken' class='custom-select' id='tv_taken' onclick='cambiar()'>";
  ?>
     <option selected disabled>Categorias</option>
     <?php $i = 0;
     foreach($genreList as $genre => $key):
          if (isset($_GET['show_genre'])) {
               $genre_id = $_GET['show_genre'];
               if ($genre_id == $key['id']) {
                    echo '<option value='.$key['id'].' selected>'.$key['name'].'</option>';
               } else {
                    echo '<option value='.$key['id'].'>'.$key['name'].'</option>';
               }
          } else {
               echo '<option value='.$key['id'].'>'.$key['name'].'</option>';
          }
          $i++;
     endforeach;?>
  </select>

     <script>
          function cambiar() {
               document.getElementById('tv_taken').onchange = function() {
                    window.location = "?show_genre=" + this.value;
               };
          }
     </script>


  <?php
     if (!empty($arrayMovies)) {
          foreach ($arrayMovies as $movie) {
               if (isset($_GET['show_genre'])) {
                    $genre_id = $_GET['show_genre'];
                    $isThisGenre = false;
                    foreach ($movie->getGenre_ids() as $genre) {
                         if($genre == $genre_id) {
                              $isThisGenre = true;
                              break;
                         }
                    }
                    if(!$isThisGenre) {
                         continue;
                    }
               }
               ?>
            <div class="container-fluid">
                 <div class="row mt-5" style="background-color: rgb(0,0,0,0.4);">
                      <div class="col-4  my-5" >
                           <img src="https://image.tmdb.org/t/p/w500/<?php echo $movie->getPoster_path() ?>" alt=<?php $movie->getTitle() ?> 
                           class="rounded">
                      </div>
                      <div class="col-8  my-5">
                           <table class="table">
                                <thead class="text-light">
                                     <th>Titulo: <?php echo $movie->getTitle() ?></th>
                                     <th>Idioma: <?php echo strtoupper($movie->getOriginal_language()) ?></th>
                                     <th>Fecha: <?php echo $movie->getRelease_date() ?></th>
                                     <th>Calificacion: <?php echo $movie->getVote_average() ?></th>
                                </thead>
                           </table>
                           <div class="text-light"><?php echo $movie->getOverview() ?></div>
                      </div>
                 </div>
            </div>
  <?php
          }
     }
     ?>