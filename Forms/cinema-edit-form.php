<script>

  function loadingEdit() {
        document.getElementById('loading-edit').removeAttribute("hidden");
        document.getElementById('btn-edit').remove();
        return;
    }
</script>

<form action="<?php echo URL?>/cinema/editCinema" onsubmit="loadingEdit()" method="POST">
  <div class="form-group">
    <label for="nameCinema"> Nombre del cine: </label>
    <input type="text" name="name" class="form-control" id="nameCinema" value="" required> </input>
  </div>
  <div class="form-group">
    <label for="capacityCinema"> Capacidad de sala: </label>
    <input type="number" min="0" max="200" name="capacity" class="form-control" id="capacityCinema" value="" required> </input>
  </div>
  <div class="form-group">
    <label for="adressCinema"> Direccion: </label>
    <input type="text" name="adress" class="form-control" id="adressCinema" value="" required> </input>
  </div>
  <div class="form-group">
    <label for="valueCinema"> Valor entrada: </label>
    <input type="number" min="0" name="value" class="form-control" id="valueCinema" value="" required> </input>
  </div>
  <input type="text" name="editCinema" class="form-control" id="editCinema" value="" hidden> </input>
  
  <div class="text-center">
      <div id="loading-edit" hidden> 
      <button class="btn btn-info btn-lg" type="button" disabled>
          <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
          Editando...
      </button>
      </div>
    <button type="submit" id="btn-edit" class="btn btn-info btn-lg">Editar cine</button>
  </div>
</form>