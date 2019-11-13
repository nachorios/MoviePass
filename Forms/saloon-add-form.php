
<form action="<?php echo URL?>/cinema/registerSaloon" onsubmit="loadingEdit()" method="POST">
<div class="form-group col m-2">
        <label for="nameCinema"> Nombre del salon: </label>
        <input type="text" name="nameCinema" class="form-control" id="new-name-saloon" placeholder="Nombre del salon" required> </input>
      </div>
      <div class="form-group col m-2">
        <label for="valueCine"> Valor entrada: </label>
        <input type="number" min="0" name="valueCine" class="form-control" id="new-value-saloon" placeholder="Valor de la entrada" required> </input>   
      </div>
      <div class="form-group col m-2 ">
        <label for="capacityCinema"> Capacidad de sala: </label>
        <input type="number" min="0" max="200" name="capacityCinema" class="form-control" id="new-capacity-saloon" placeholder="Capacidad de butacas" required> </input>
      </div>
    <input type="text" name="id_cinema" class="form-control" id="id_cinema" value="" hidden> </input>

      <div class="text-center">
        <div id="loading-edit" hidden> 
        <button class="btn btn-info btn-lg" type="button" disabled>
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            Editando...
        </button>
        </div>
        <button type="submit" id="btn-edit" class="btn btn-info btn-lg">Agregar nuevo salon</button>
    </div>
</form>