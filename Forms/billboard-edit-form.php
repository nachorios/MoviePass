<form action="<?php echo URL?>/Billboard/add" method="POST" class="p-3">
<div class="form-group">
    <label for="select-cinema" class="text-light"> Seleccionar Cine: </label>
    <select class="form-control" id="select-cinema" name="cinema" id="" required>
        <option value="" selected disabled>Cines</option>
        <option name="nameCinema" value=""></option>
    </select>
</div>
<div class="form-group">
    <label for="select-movie" class="text-light"> Seleccionar Pelicula: </label>
    <select class="form-control" name="movie" id="select-movie" required>
        <option value="" selected disabled>Peliculas</option>
        <option name="nameMovie" value=""></option>
    </select>
</div>
<div class="container" id="container">
    <div class="text-dark row border border-secondary rounded">
        <div class="form-group col m-2">
            <label for="date" class="text-dark"> Añadir fecha: </label>
            <input type="date" id="date" name="date[]" value="" min="<?php echo date("Y-m-d"); ?>" max="<?php /*echo date("Y-m-31");*/ ?>" required>
        </div>
        <div class="form-group col m-2">
            <label for="time" class="text-dark"> Seleccionar horario: </label>
            <input type="time" id="time" name="time[]" value="" min="15:00" max="23:00" required>    
        </div>
    </div>
</div>

<div class="mt-3">
    <button type="submit" data-toggle="modal" class="btn btn-success btn-block btn-lg ">Agregar pelicula a la cartelera</button>
</div>

</form>