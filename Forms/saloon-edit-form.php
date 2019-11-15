
<form action="<?php echo URL?>/Saloon/editSaloon" onsubmit="loadingEdit()" method="POST">
<div class="form-group col m-2">
        <label for="nameCinema"> Nombre del salon: </label>
        <input type="text" name="name-saloon" class="form-control" id="name-saloon" placeholder="Nombre del salon" required> </input>
      </div>
      <div class="form-group col m-2 ">
        <label for="capacityCinema"> Capacidad de sala: </label>
        <input type="number" min="0" max="200" name="capacity-saloon" class="form-control" id="capacity-saloon" placeholder="Capacidad de butacas" required> </input>
      </div>
      <div class="form-group col m-2">
        <label for="valueCine"> Valor entrada: </label>
        <input type="number" min="0" name="value-saloon" class="form-control" id="value-saloon" placeholder="Valor de la entrada" required> </input>   
      </div>
    <input type="text" name="editSaloon" class="form-control" id="editSaloon" value="" hidden> </input>

      <div class="text-center">
        <div id="loading-edit" hidden> 
        <button class="btn btn-info btn-lg" type="button" disabled>
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            Editando...
        </button>
        </div>
        <button type="submit" id="btn-edit" class="btn btn-info btn-lg">Editar salon</button>
    </div>
</form>