<?php 
    $cinemas = $cinemasList->GetAll();
    if($cinemas != null && !is_array($cinemas))
        $cinemas = array($cinemas);
?>
<form action="<?php echo URL?>/Billboard/editBillboard"  oninput="validationEditCheck();" onsubmit="loadingEdit();" id="billboard-edit-form" method="POST" name="frm" class="p-3 mb-2">
    <div class="form-group">
        <label for="select-cinema"> Seleccionar Cine: </label>
        <select class="form-control" id="select-edit-cinema" onchange="actualizarEditSalas()" name="cinema" required>
            <option value="" disabled>Cines</option>
        <?php foreach($cinemas as $cinema): ?>
            <option name="nameCinema" id="<?php foreach($cinema->getSaloon() as $saloons){ echo $saloons->getName() .'-'. $saloons->getId().'/'; } ?>" value="<?php echo $cinema->getIdCinema(); ?>"><?php echo $cinema->getName(); ?></option>
        <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="select-movie"> Seleccionar Pelicula: </label>
        <select class="form-control" name="movie" id="select-edit-movie" required>
            <option value="" disabled>Peliculas</option>
        <?php foreach($movieList->getNowApi() as $movie): ?>
            <option name="nameMovie" value="<?php echo $movie->getId(); ?>"><?php echo $movie->getTitle(); ?></option>
        <?php endforeach; ?>
        </select>
    </div>
  
    <input type="text" name="idBillboardEdit" class="form-control" id="idBillboardEdit" value="" hidden> </input>
    <!--<input type="text" name="oldCinema" class="form-control" id="oldCinema" value="" hidden> </input>-->
    
    <div class="mt-3">
        <div class='text-center' id="loading-edit" hidden> 
        <button class="btn btn-info btn-block btn-lg" type="button" disabled>
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            Editando...
        </button>
        </div>
        <button type="submit" id="btn-edit" class="btn btn-info btn-block btn-lg">Confirmar edicion de cartelera</button>
        
    </div>
</form>