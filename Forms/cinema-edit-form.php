<form action="<?php echo URL?>/cinema/editCinema" method="POST" class="text-white">
  <div class="form-group">
    <label for="nameCinema"> Nombre del cine: </label>
    <input type="text" name="name" class="form-control" id="nameCinema" placeholder="Ingresar nombre del cine" required> </input>
  </div>
  <div class="form-group">
    <label for="capacityCinema"> Capacidad de sala: </label>
    <input type="number" name="capacity" class="form-control" id="capacityCinema" placeholder="Ingresar capacidad de sala" required> </input>
  </div>
  <div class="form-group">
    <label for="adressCinema"> Direccion: </label>
    <input type="text" name="adress" class="form-control" id="adressCinema" placeholder="Ingresar direccion" required> </input>
  </div>
  <div class="form-group">
    <label for="valueCine"> Valor entrada: </label>
    <input type="text" name="value" class="form-control" id="valueCine" placeholder="Ingresar valor unico de entrada" required> </input>
  </div>
  <input type="text" name="editCinema" class="form-control" id="editCinema" value="<?php if(isset($_GET['edit'])){ echo $_GET['edit']; }?>" hidden> </input>
  
  <button type="submit" class="btn btn-success btn-lg">Editar</button>
</form>