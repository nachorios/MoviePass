<?php
    include(MODALS_PATH . 'billboard-list-modals.php');
     if(isset($added)) {
          ?><script>
               $(function(){
                    $('#registro-exito').modal('show');
               });
          </script><?php
     }
     if(isset($_GET['delete']))
     { //usamos el metodo de el atributo cinemasList, cinemasList fue igualado a cinemasDAOJSON en ShowCinemasList y borramos por el dato que esta en get
          $billboardList->Delete($_GET['delete'],$_GET['movie']);
          $borrado = true;
     }
     if(isset($borrado)) {
        ?><script>
             $(function(){
                  $('#borrado-exito').modal('show');
             });
        </script><?php
   }
?>

<script>
     function editBillboard(billboard) {
          var data = document.getElementById(billboard).value;  
          var dataAux = data.split('/');
          document.getElementById('nameCinema').value = dataAux[0];
          document.getElementById('capacityCinema').value = dataAux[1];
          document.getElementById('adressCinema').value = dataAux[2];
          document.getElementById('valueCinema').value = dataAux[3];
          document.getElementById('editCinema').value = billboard;
     }
</script>

<div class="container">
    <?php
        if(isset($_SESSION['loggedUser'])) {
            if($_SESSION['loggedUser']->getRole()>1) {
                include(FORMS_PATH . 'billboard-add-form.php'); 
            }
        }
        foreach($billboardList->getAll() as $billboard):
        $cinema = $billboard->getCinema();
        $movie = $movieList->getMovieById($billboard->getMovie());
        $time = $billboard->getHour();
        $date = $billboard->getDay();
    ?>
        
    <div class ="col-md-6 float-left" >
        <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative bg-light">

            <div class="col p-4 d-flex flex-column position-static">
                <strong class="d-inline-block mb-2 text-primary"><?php echo $cinema ?></strong>
                <h4 class="mb-0"><?php echo substr($movie->getTitle(), 0, 25); if(strlen($movie->getTitle()) > 25) echo '...'; ?></h4>
                <div class="mb-1 text-muted">
                    Puntaje: <?php echo $movie->getVote_average() ?>
                </div>
                <table class="table-sm table-hover">
                    <thead >
                        <th>Fecha</th>
                        <th>Hora</th>
                    </thead>
                    <tbody>
                        <?php for($i = 0; $i < count($time); $i++): ?>
                            
                        <tr class="table-secondary">
                            <td><?php echo $date["$i"] ?></td>
                            <td><?php echo $time["$i"] ?></td>
                        </tr>

                        <?php endfor;?>
                    </tbody>
                </table>

                <p class="card-text mb-auto" ><?php echo substr($movie->getOverview(), 0, 100); if(strlen($movie->getOverview()) > 100) echo '...'; ?></p>
                <a href="#" class="">Más información</a>
                <?php
        if(isset($_SESSION['loggedUser'])) {
            if($_SESSION['loggedUser']->getRole()>1) {
                ?> 
                    <button type="button" value="" id="borrar" onclick = "window.location = '<?php echo URL ?>/Billboard/ShowView?delete=<?php echo $cinema.'&movie='.$billboard->getMovie();  ?>';" data-toggle="modal" data-target="#borrar-modal" class="btn btn-danger"><i class="fa fa-trash-o"></i>Eliminar</button>
                        
                    <button type="button" value="" id="" onclick = "editarCine('');" data-toggle="modal" data-target="#editar-modal" class="btn btn-info mt-2"><i class="fa fa-pencil-square-o"></i>Editar</button>
        <?php }
        } ?>  
            </div>
 
            <div class="col-auto d-none d-lg-block">
                <img src="https://image.tmdb.org/t/p/w500/<?php echo $movie->getPoster_path() ?>" style="" alt=<?php $movie->getTitle() ?> width="200" height="350">
            </div>  
              
        </div>
    </div>
    <?php
        endforeach;
    ?>
<div class="clearfix"></div>
</div>