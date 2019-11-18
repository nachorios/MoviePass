 

<script>
     function cambiar() {
          document.getElementById('genre_select').onchange = function() {
               var date = document.getElementById('date_select').value + "";
               var genre = document.getElementById('genre_select').value + "";
               var url = "";
               if (date != "") {
                    url += "?show_date=" + date;
                    if (genre != ""){
                         url += "&show_genre=" + genre;
                    }
               } else {
                    if (genre != ""){
                         url += "?show_genre=" + genre;
                    }
               }
               let p = document.getElementById('loading');
               p.removeAttribute("hidden");
               document.getElementById('peliculas').remove();
               window.location = url;
          };
     }
     function cambiarFecha() {
          document.getElementById('date_select').onchange = function() {
               var date = document.getElementById('date_select').value + "";
               var genre = document.getElementById('genre_select').value + "";
               var url = "";
               if (date != "") {
                    url += "?show_date=" + date;
                    if (genre != ""){
                         url += "&show_genre=" + genre;
                    }
               } else {
                    if (genre != ""){
                         url += "?show_genre=" + genre;
                    }
               }
               let p = document.getElementById('loading');
               p.removeAttribute("hidden");
               document.getElementById('peliculas').remove();
               window.location = url;
          };
     }
</script>

<main class="my-5" ">
     <section class="mb-5">
          <div class="container-fluid">
               <div class="row-fluid">
                    <h2 class="display-2 text-center text-light ">Peliculas estrenadas</h2>
               </div>
          </div>
     </section>
</main>

<div class="container text-center">
     <?php include(FORMS_PATH . "search-movie-form.php") ?>
</div>

<div class="text-center">
     <div id="loading" class="spinner-border text-primary mb-4" style="width: 3rem; height: 3rem;" hidden></div>
</div>

<div id="peliculas" class="container">
     <?php
     if (!empty($arrayMovies)):
          foreach ($arrayMovies as $movie):
     ?>

     <div class="card mb-3 float-left">
          <div class="row no-gutters">
               <div class="col-md-4">
                    <img src="https://image.tmdb.org/t/p/w500/<?php echo $movie->getPoster_path() ?>" class="card-img" alt="...">
               </div>
               <div class="col-md-8">
                    <div class="card-header">
                         <h2 class="card-title"><?php echo $movie->getTitle() ?></h2>
                    </div>
                    <div class="card-body">
                         <p class="card-text"><small class="text-muted">Sinopsis</small></p>
                         <p class="card-text"><?php echo $movie->getOverview() ?></p>
                         <ul class="list-group list-group-flush">
                              <li class="list-group-item">Fecha de estreno: <?php echo $movie->getRelease_date() ?></li>
                              <li class="list-group-item">Calificacion: <?php echo $movie->getVote_average() ?></li>
                              <li class="list-group-item">Idioma original: <?php echo strtoupper($movie->getOriginal_language()) ?></li>
                         </ul>
                    </div>
                    <div class="card-footer">
                         <small class="text-muted">Comprar entradas de esta pelicula</small>
                         <button onclick="window.location.href = '<?php echo URL . '/Buyout/ShowView?movie='. $movie->getId() ?>'; " class="btn btn-warning"
                              type="button"><i class="fa fa-chevron-right"></i>
                         </button> 
                    </div>
               </div>
          </div>
     </div>
     <?php
          endforeach;
     else: ?>
          <div class="card text-center border-danger mb-3">
               <div class="card-header text-danger">
                    No se han encontrado peliculas...
               </div>
               <div class="card-body text-danger">
               <blockquote class="blockquote mb-0">
                    <p>Intenta con otro genero u otra fecha.</p>
               </blockquote>
               </div>
          </div>
     <?php endif;
     ?>
</div>
<div class="clearfix"></div>