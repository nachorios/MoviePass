<form action="<?php echo URL?>/cinema/registerCinema" method="POST" class="text-white">
  <div class="form-group">
    <label for="nameCinema"> Nombre del cine: </label>
    <input type="text" name="name" class="form-control" id="nameCinema" placeholder="Ingresar nombre del cine"> </input>
  </div>
  <div class="form-group">
    <label for="capacityCinema"> Capacidad de sala: </label>
    <input type="number" name="capacity" class="form-control" id="capacityCinema" placeholder="Ingresar capacidad de sala"> </input>
  </div>
  <div class="form-group">
    <label for="adressCinema"> Direccion: </label>
    <input type="text" name="adress" class="form-control" id="adressCinema" placeholder="Ingresar direccion"> </input>
  </div>
  <div class="form-group">
    <label for="valueCine"> Valor entrada: </label>
    <input type="text" name="value" class="form-control" id="valueCine" placeholder="Ingresar valor unico de entrada"> </input>
  </div>
  <button type="submit" class="btn btn-success btn-lg">Agregar</button>
</form>
