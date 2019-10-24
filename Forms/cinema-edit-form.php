<form action="<?php echo URL?>/cinema/editCinema" method="POST">
  <div class="form-group">
    <label for="nameCinema"> Nombre del cine: </label>
    <input type="text" name="name" class="form-control" id="nameCinema" value="<?php if($cinemaEdit != null) echo $cinemaEdit->getName() ?>" required> </input>
  </div>
  <div class="form-group">
    <label for="capacityCinema"> Capacidad de sala: </label>
    <input type="number" min="0" max="200" name="capacity" class="form-control" id="capacityCinema" value="<?php if($cinemaEdit != null) echo $cinemaEdit->getCapacity() ?>" required> </input>
  </div>
  <div class="form-group">
    <label for="adressCinema"> Direccion: </label>
    <input type="text" name="adress" class="form-control" id="adressCinema" value="<?php if($cinemaEdit != null) echo $cinemaEdit->getAdress() ?>" required> </input>
  </div>
  <div class="form-group">
    <label for="valueCine"> Valor entrada: </label>
    <input type="number" min="0" name="value" class="form-control" id="valueCine" value="<?php if($cinemaEdit != null) echo $cinemaEdit->getValue() ?>" required> </input>
  </div>
  <input type="text" name="editCinema" class="form-control" id="editCinema" value="<?php if(isset($_GET['edit'])){ echo $_GET['edit']; }?>" hidden> </input>
  
  <div class="text-center">
    <button type="submit" class="btn btn-info btn-lg">Editar</button>
  </div>
</form>