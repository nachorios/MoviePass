<div class="container">
<form action="<?php echo URL?>/cinema/registerCinema" method="POST">
  <div class="form-group">
    <label for="nameCinema"> Nombre del cine: </label>
    <input type="text" name="name" class="form-control" id="nameCinema" placeholder="Ingresar nombre del cine" required> </input>
  </div>
  <div class="form-group">
    <label for="capacityCinema"> Capacidad de sala: </label>
    <input type="number" min="0" max="200" name="capacity" class="form-control" id="capacityCinema" placeholder="Ingresar capacidad de sala" required> </input>
  </div>
  <div class="form-group">
    <label for="adressCinema"> Direccion: </label>
    <input type="text" name="adress" class="form-control" id="adressCinema" placeholder="Ingresar direccion" required> </input>
  </div>
  <div class="form-group">
    <label for="valueCine"> Valor entrada: </label>
    <input type="number" min="0" name="value" class="form-control" id="valueCine" placeholder="Ingresar valor unico de entrada" required> </input>
  </div>
  <div class="text-center">
    <button type="submit" class="btn btn-success btn-lg">Agregar</button>
  </div>
</form>
</div>