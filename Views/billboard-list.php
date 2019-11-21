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
    if(isset($addedFunction)) {
        if($addedFunction) {
            ?><script>
            $(function(){
                $('#registro-funcion-exito').modal('show');
            });
        </script><?php
        } else {
            ?><script>
            $(function(){
                $('#registro-funcion-error').modal('show');
            });
    </script><?php
        }
    }
    if(isset($deletedFunction)) {
        if($deletedFunction) {
            ?><script>
            $(function(){
                $('#borrado-funcion-exito').modal('show');
            });
        </script><?php
        } else {
            ?><script>
            $(function(){
                $('#borrado-funcion-error').modal('show');
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
        

        document.getElementById('date-edit').value = dataAux[0];
        document.getElementById('time-edit').value = dataAux[1];
        document.getElementById('function-edit').value = dataAux[2];
        document.getElementById('function-delete').value = dataAux[2];
    
        var saloons = dataAux[4].split('-').slice(0, -1);
        var selectEdit = document.getElementById('select-edit-saloon');
        
        while (selectEdit.options.length > 1) {                
            selectEdit.remove(1);
        }
        for(var i = 0; i < saloons.length; i++){
            var newOption = document.createElement("option");
            newOption.value = saloons[i];
            i++;
            newOption.innerHTML = saloons[i];
            newOption.setAttribute("name", "saloon");

            selectEdit.options.add(newOption);
        }
        selectEdit.value = dataAux[3];
        
     }

     function addSaloon(saloon) {
        var data = saloon.id;
        var dataAux = data.split('/');
        document.getElementById('billboard-function-add').value = dataAux[0];
    
        var saloons = dataAux[1].split('-').slice(0, -1);
        var selectAdd = document.getElementById('select-add-saloon');
        
        while (selectAdd.options.length > 1) {                
            selectAdd.remove(1);
        }
        for(var i = 0; i < saloons.length; i++){
            var newOption = document.createElement("option");
            newOption.value = saloons[i];
            i++;
            newOption.innerHTML = saloons[i];
            newOption.setAttribute("name", "saloon");

            selectAdd.options.add(newOption);
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
        $billboards = $billboardList->getAll();
        if(!is_array($billboards))
            $billboards = array($billboards);
        foreach($billboards as $billboard):
        $cinema = $billboard->getCinema();
        $movie = $billboard->getMovie();
    ?>
        
    <div class ="col-md-6 float-left" >
        <div class="row no-gutters border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative bg-light">

            <div class="col p-2 d-flex flex-column position-static">
                <strong class="d-inline-block mb-2 text-primary"><?php echo substr($cinema->getName(), 0, 20); if(strlen($cinema->getName()) > 20) echo '...'; ?></strong>
                <h5 class="mb-0"><?php echo substr($movie->getTitle(), 0, 34); if(strlen($movie->getTitle()) > 34) echo '...'; ?></h5>
                <div class="mb-1 text-muted">
                    Puntaje: <?php echo $movie->getVote_average() ?>
                </div>
                <table class="table-sm table table-hover text-center" id="edit-funtion-table">
                <!-- <button type="button" value='<?php echo $cinema->getIdCinema() .'/'. $movie->getId() .'/'. $billboard->getId(); ?>' 
                id="editar-<?php echo $id ?>" onclick = "editBillboard(this);"
                 data-toggle="modal" data-target="#editar-modal" class="btn btn-info mt-2"><i class="fa fa-pencil-square-o"></i>Editar</button> -->
                    <thead >
                        <th>Fecha</th>
                        <th>Sala</th>
                        <th>Hora</th>
                    </thead>
                    <tbody>
                        <?php foreach($billboard->getFunctions() as $func): 
                            if(isset($_SESSION['loggedUser'])){
                                if($_SESSION['loggedUser']->getRole()>1){ ?> 
                        <tr class="table-secondary" id="<?php 
                            $id = $func->getDate() .'/'. $func->getHour() .'/'. $func->getId() .'/'. $func->getSaloon()->getId() ;
                            $saloonList = ""; 
                            $saloons = $billboard->getCinema()->getSaloon();
                            if(!is_array($saloons))
                                $saloons = array($saloons);
                            foreach($saloons as $saloon){ 
                                $saloonList .= $saloon->getId().'-'. $saloon->getName().'-'; 
                            } 
                            echo $id .'/'. $saloonList; ?>" onclick="editSaloon(this);" 
                            data-toggle="modal" data-target="#editar-function-modal" data-toggle="tooltip" title="Has clic para editar." >
                            
                        <?php } else { echo '<tr class="table-secondary">'; } 
                                } else { echo '<tr class="table-secondary">'; } ?>
                            <td><small><?php echo str_replace("-","/",$func->getDate()) ?></small></td>
                            <td><small><?php echo substr($func->getSaloon()->getName(), 0, 8); if(strlen($func->getSaloon()->getName()) > 8) echo '...'; ?></small></td>
                            <td><small><?php echo $func->getHour() ?></small></td>
                        </tr>

                        <?php endforeach;?>
                    </tbody>
                </table>
                <?php 
                if(!is_array($cinema->getSaloon()))
                    $saloonSize = 1;
                else 
                    $saloonSize = count($cinema->getSaloon());
                if(!is_array($billboard->getFunctions()))
                    $functionAmount = 1;
                else
                    $functionAmount = count($billboard->getFunctions());
                if($functionAmount < $saloonSize): ?>
                    <div class="text-center m-2">                
                        <button type="button" id="<?php 
                            $id = $billboard->getId();
                            $saloonList = ""; 
                            $saloons = $billboard->getCinema()->getSaloon();
                            if(!is_array($saloons))
                                $saloons = array($saloons);
                            foreach($saloons as $saloon){ 
                                $saloonExists = false;
                                $functions = $billboard->getFunctions();
                                if(!is_array($functions))
                                    $functions = array($functions);
                                foreach($functions as $function) {
                                    if($function->getSaloon()->getId() == $saloon->getId()) {
                                        $saloonExists = true;
                                    }
                                }
                                if(!$saloonExists){
                                    $saloonList .= $saloon->getId().'-'. $saloon->getName().'-'; 
                                }
                            } 
                            echo $id .'/'. $saloonList; ?>" onclick="addSaloon(this);"  data-toggle="modal" data-target="#agregar-function-modal" class="btn btn-warning btn-sm"><i class="fa fa-plus"></i></button>
                    </div>
                <?php endif; ?>
                <p class="card-text mb-auto" > </p>
                <?php if(count($billboard->getFunctions())<2): ?>
                    <p class="card-text mb-auto font-italic" ><?php echo substr($movie->getOverview(), 0, 80); if(strlen($movie->getOverview()) > 80) echo '...'; ?></p>
                <?php endif; ?>
                <button class="btn btn-secondary btn-sm mb-2" data-placement="left" data-toggle="popover" title="<?php echo $movie->getTitle() ?>" data-html="true" 
                data-content='<ul class="list-unstyled">
                    <h4><u>Sinopsis</u></h4>
                    <li><?php echo str_replace("'", "”", str_replace("\"","”", $movie->getOverview())); ?></li>
                    <br>
                    <li><h6>Datos de interes: </h6>
                        <ul>
                            <li>Fecha de Estreno: <?php echo $movie->getRelease_date(); ?></li>
                            <li>Titulo original:<?php echo str_replace("'", "”", str_replace("\"","”", $movie->getOriginal_title())); ?></li>
                            <li>Puntuacion: <?php echo $movie->getVote_average(); ?></li>
                            <li>Duracion: <?php echo $movie->getRuntime(); ?></li>
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
            ?> <button type="button" onclick="window.location.href = '<?php echo URL . '/Buyout/ShowView?movie='. $movie->getId() .'&cinema='. $cinema->getIdCinema() ?>'; " class="btn btn-warning mb-2"><i class="fa fa-shopping-bag"></i>Agregar al Carrito</button> <?php
        }
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
        if(empty($billboards)): ?>
        <div class="card text-center border-danger mb-3">
             <div class="card-header text-danger">
                  No se han encontrado peliculas en cartera...
             </div>
             <div class="card-body text-danger">
             <blockquote class="blockquote mb-0">
                  <p>Vuelve más tarde.</p>
             </blockquote>
             </div>
        </div>
   <?php endif; ?>
<div class="clearfix"></div>
</div>