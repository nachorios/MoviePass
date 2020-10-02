
<section class="container">


<div class="card mb-3">
  <img src="https://image.tmdb.org/t/p/h632/<?php echo $movies_list[rand ( 0, count($movies_list)-1)]->getBackdrop_path() ?>" class="card-img-top" alt="...">
  <div class="card-body">
    <h2 class="card-title">¡Bienvenido a MyTicket!</h2>
    <div class="card-footer">
    	 <p class="card-text">En nuestra web podras comprar consultar los cines, visitar nuestra cartelera y comprar entradas para ver tu proxima pelicula favorita.</p>
    </div>
  </div>
</div>

<div class="card bg-dark text-white mb-4 text-center">
  <img src="<?php echo IMG_PATH ?>/bg-cine.jpg" class="card-img" style="height:350px" alt="...">
  <div class="card-img-overlay">
    <h2 class="card-title"><u>Peliculas en emisión</u></h5>
    <br></br>
    <br></br>
    <h3 class="card-text">Puedes visitar todo el catalogo en emision desde la opción <a href="<?php echo URL ?>/Movie/ShowListView" class="badge badge-dark">Peliculas</a>.</h3>
  </div>
</div>

<?php
	if (!empty($movies_in_billboard)):
	$i = 0;
	   foreach ($movies_in_billboard as $movie):
	   if(++$i % 4 == 0) break;
?>
<div class="card col-md-6 float-left mr-4 ml-4 mb-4" style="width: 20rem;">
     <div class="row">
     	  <img src="https://image.tmdb.org/t/p/h632/<?php echo $movie->getPoster_path() ?>" class="card-img-top" alt="...">
     	       <div class="card-body">
		   <h5 class="card-title"><?php echo $movie->getTitle() ?></h5>
    	       	   <p class="card-text"><?php echo substr($movie->getOverview(), 0, 120); if(strlen($movie->getOverview()) > 80) echo '...'; ?></p>
    	       	   <a href="<?php echo URL . '/Buyout/ShowView?movie='. $movie->getId() ?>" class="btn btn-primary">Consultar entrada</a>
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
                         <p>Vuelve más tarde</p>
                    </blockquote>
                    </div>
               </div>
<?php endif;?>

<div class="clearfix"></div>

<div class="card bg-dark text-white mb-4 text-center">
  <img src="<?php echo IMG_PATH ?>/bg-movie.png" class="card-img" style="height:350px" alt="...">
  <div class="card-img-overlay">
    <h2 class="card-title"><u>Cines disponibles</u></h5>
    <br></br>
    <br></br>
    <h3 class="card-text">Puedes visitar todo los cines disponibles desde la opción <a href="<?php echo URL ?>/Cinema/ShowCinemasList" class="badge badge-dark">Cines</a>.</h3>
  </div>
</div>

<div class="row">
<?php
	if (!empty($cinemas_list)):
	   foreach ($cinemas_list as $cinema):
?>
<div class="col-4 mb-4">
<div class="card  text-primary text-center">

    <blockquote class="blockquote mb-0">
      <p class="card-header"><?php echo $cinema->getName(); ?></p>
      <div class="card-footer text-muted text-primary">
        <small>
           • Ubicación del cine <cite title="Source Title"><?php echo $cinema->getAdress(); ?></cite>
        </small>
      </div>
    </blockquote>
  </div>
</div>
<?php
	endforeach;
    else: ?>
    <div class="container">
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
	       </div>
	       
<?php endif;?>
</div>

<div class="clearfix"></div>
</section>

