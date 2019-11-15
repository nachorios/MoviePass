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
     if(isset($deletedCinema)) {
        ?><script>
             $(function(){
                  $('#borrado-exito').modal('show');
             });
        </script><?php
   }
?>

<script>
     function editBillboard(billboard) {
          var data = billboard.value;  
          var dataAux = data.split('/');
          
          document.getElementById('select-edit-cinema').value = dataAux[0];
          document.getElementById('select-edit-movie').value = dataAux[1];
          document.getElementById('idBillboardEdit').value = dataAux[2];
     }

     function editSaloon(saloon) {
        var data = saloon.id;
        var dataAux = data.split('/');
        

        document.getElementById('time-edit').value = dataAux[1];
        document.getElementById('date-edit').value = dataAux[0];
    
        var saloons = dataAux[2].split('-').slice(0, -1);
        var selectEdit = document.getElementById('select-edit-saloon');
        
        while (selectEdit.options.length > 1) {                
            selectEdit.remove(1);
        }
        document.getElementById('select-edit-saloon').value = dataAux[2];
        for(var i = 0; i < saloons.length; i++){
            var newOption = document.createElement("option");
            newOption.value = saloons[i];
            i++;
            newOption.innerHTML = saloons[i];
            newOption.setAttribute("name", "saloon");

            selectEdit.options.add(newOption);
        }

        
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
                <table class="table-sm table-hover text-center" id="edit-funtion-table">
                <!-- <button type="button" value='<?php echo $cinema->getIdCinema() .'/'. $movie->getId() .'/'. $billboard->getId(); ?>' 
                id="editar-<?php echo $id ?>" onclick = "editBillboard(this);"
                 data-toggle="modal" data-target="#editar-modal" class="btn btn-info mt-2"><i class="fa fa-pencil-square-o"></i>Editar</button> -->
                    <thead >
                        <th>Fecha</th>
                        <th>Sala</th>
                        <th>Hora</th>
                    </thead>
                    <tbody>
                        <?php for($i = 0; $i < count($time); $i++): ?>
                        <tr class="table-secondary" id="<?php 
                            $id = $date["$i"] .'/'. $time["$i"] ;
                            $saloonList = ""; 
                            foreach($cinema->getSaloon() as $saloon){ 
                                $saloonList .= $saloon->getId().'-'. $saloon->getName().'-'; 
                            } 
                            echo $id .'/'. $saloonList; ?>" onclick = "editSaloon(this);" data-toggle="modal" data-target="#editar-function-modal" >
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
                data-content='<ul class="list-unstyled">
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
                    <div class='text-center' id="loading-delete-<?php echo $billboard->getId() ?>" hidden> 
                        <button class="btn btn-danger col p-2" type="button" disabled>
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            Eliminando...
                        </button>
                    </div>
                    <button type="button" value="" id="borrar-<?php echo $billboard->getId() ?>" onclick="loadingDelete(<?php echo $billboard->getId() ?>); window.location='<?php echo URL ?>/Billboard/deleteBillboard?delete=<?php echo $billboard->getId();  ?>';" data-toggle="modal" data-target="#borrar-modal" class="btn btn-danger"><i class="fa fa-trash-o"></i>Eliminar</button>
                        
                    <button type="button" value='<?php echo $cinema->getIdCinema() .'/'. $movie->getId() .'/'. $billboard->getId(); ?>' id="editar-<?php echo $id ?>" onclick = "editBillboard(this);" data-toggle="modal" data-target="#editar-modal" class="btn btn-info mt-2"><i class="fa fa-pencil-square-o"></i>Editar</button>
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