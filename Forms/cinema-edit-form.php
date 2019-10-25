<form action="<?php echo URL?>/cinema/editCinema" method="POST">
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
    <button type="submit" class="btn btn-info btn-lg">Editar</button>
  </div>
</form>