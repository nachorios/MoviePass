<?php
    include(MODALS_PATH . 'billboard-list-modals.php');
     if(isset($added)) {
         if($added) {

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
     if(isset($edited)) {
        if($edited) {
            ?><script>
             $(function(){
                  $('#edicion-exito').modal('show');
             });
        </script><?php
        } else {
            ?><script>
            $(function(){
                 $('#edicion-error').modal('show');
            });
       </script><?php
        }
   }
     if(isset($_GET['delete']))
     {
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
          document.getElementById('select-cinema').value = dataAux[0];
          document.getElementById('select-movie').value = dataAux[1];
          document.getElementById('oldCinema').value = dataAux[0];
          document.getElementById('oldMovie').value = dataAux[1];
     }

     function loadingDelete(id) {
        document.getElementById('loading-delete-'+id).removeAttribute("hidden");
        document.getElementById('borrar-'+id).remove();
        return;
    }

    $(document).ready(function(){
        $('[data-toggle="popover"]').popover();   
    });
</script>

<div class="container">
    <?php
        if(isset($_SESSION['loggedUser'])) {
            if($_SESSION['loggedUser']->getRole()>1) {
                include(FORMS_PATH . 'billboard-add-form.php'); 
            }
        }
        $id = 0;
        foreach($billboardList->getAll() as $billboard):
        $cinema = $billboard->getCinema();
        $movie = $billboard->getMovie();
        $time = $billboard->getHour();
        $saloons = $billboard->getSaloon();
        $date = $billboard->getDay();
        
    ?>
        
    <div class ="col-md-6 float-left" >
        <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative bg-light">

            <div class="col p-2 d-flex flex-column position-static">
                <strong class="d-inline-block mb-2 text-primary"><?php echo $cinema->getName() ?></strong>
                <h5 class="mb-0"><?php echo substr($movie->getTitle(), 0, 34); if(strlen($movie->getTitle()) > 34) echo '...'; ?></h5>
                <div class="mb-1 text-muted">
                    Puntaje: <?php echo $movie->getVote_average() ?>
                </div>
                <table class="table-sm table-hover text-center">
                    <thead >
                        <th>Fecha</th>
                        <th>Sala</th>
                        <th>Hora</th>
                    </thead>
                    <tbody>
                        <?php for($i = 0; $i < count($time); $i++): ?>
                            
                        <tr class="table-secondary">
                            <td><?php echo $date["$i"] ?></td>
                            <td><?php echo $saloons["$i"]->getName() ?></td>
                            <td><?php echo $time["$i"] ?></td>
                        </tr>

                        <?php endfor;?>
                    </tbody>
                </table>

                <p class="card-text mb-auto" > </p>
                <?php if(count($date)<2): ?>
                    <p class="card-text mb-auto font-italic" ><?php echo substr($movie->getOverview(), 0, 100); if(strlen($movie->getOverview()) > 100) echo '...'; ?></p>
                <?php endif; ?>
                <button class="btn btn-secondary btn-sm mb-2" data-placement="left" data-toggle="popover" title="<?php echo $movie->getTitle() ?>" data-html="true" 
                data-content=' <ul class="list-unstyled">
                                    <h4><u>Sinopsis</u></h4>
                                    <li><?php echo str_replace("'", "”", str_replace("\"","”", $movie->getOverview())); ?></li>
                                    <br>
                                    <li><h6>Datos de interes: </h6>
                                        <ul>
                                            <li>Fecha de Estreno: <?php echo $movie->getRelease_date(); ?></li>
                                            <li>Titulo original: <?php echo $movie->getOriginal_title(); ?></li>
                                            <li>Puntuacion: <?php echo $movie->getVote_average(); ?></li>
                                        </ul>
                                    </li>
                                    <br/>
                                    <li><h6>Generos: </h6>
                                        <ul>
                                            <?php 
                                                $movieGenres = $movie->getGenre_ids();
                                                foreach($movieGenres as $genre):
                                            ?>
                                            <li> <?php echo $genre['name']; ?> </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    </li>
                                </ul>'>
                Más información</button>
                
                <?php
        if(isset($_SESSION['loggedUser'])) {
            if($_SESSION['loggedUser']->getRole()>1) {
                ?> 
                    <div class='text-center' id="loading-delete-<?php echo $id ?>" hidden> 
                        <button class="btn btn-danger col p-2" type="button" disabled>
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Eliminando...
                        </button>
                    </div>
                    <button type="button" value="" id="borrar-<?php echo $id ?>" onclick="loadingDelete(<?php echo $id ?>); window.location = '<?php echo URL ?>/Billboard/ShowView?delete=<?php echo $cinema->getIdCinema() .'&movie='. $movie->getId();  ?>';" data-toggle="modal" data-target="#borrar-modal" class="btn btn-danger"><i class="fa fa-trash-o"></i>Eliminar</button>
                        
                    <button type="button" value='<?php echo $cinema->getIdCinema() .'/'. $movie->getId(); ?>' id="<?php echo $id ?>" onclick = "editBillboard('<?php echo $id ?>');" data-toggle="modal" data-target="#editar-modal" class="btn btn-info mt-2"><i class="fa fa-pencil-square-o"></i>Editar</button>
        <?php } else {
            ?> <button type="button"  class="btn btn-warning mb-2"><i class="fa fa-shopping-bag"></i>Agregar al Carrito</button> <?php
        }
        } else {
            ?> <button type="button"  class="btn btn-warning mb-2"><i class="fa fa-shopping-bag"></i> Agregar al Carrito</button> <?php
        } ?>  
            </div>
 
            <div class="col-auto d-none d-lg-block">
                <img src="https://image.tmdb.org/t/p/w500/<?php echo $movie->getPoster_path() ?>" style="" alt=<?php $movie->getTitle() ?> width="350" height="450" style="max-height: 100px;">
            </div>  
              
        </div>
    </div>
    <?php
        $id++;
        endforeach;
    ?>
<div class="clearfix"></div>
</div>