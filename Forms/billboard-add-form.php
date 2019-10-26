<script>
    $(document).ready(function(e){
        //variables
        var i = 0;
        var maxColumnas = 4;
        
        //agregar columna
        $("#add").click(function(e){
            if(i < maxColumnas) {
                i++;
                var html = '<div id="'+i+'" class=" text-dark row" style="background-color:rgb(0,0,0,0.5);"> <div class="form-group col m-2"> <label for="date" class="text-light"> Añadir fecha: </label> <input type="date" id="date" name="date" value="<?php echo date("Y-m-d"); ?>" min="<?php echo date("Y-m-d"); ?>" max="<?php  /*echo date("Y-m-31");*/  ?>" required> </div> <div class="form-group col m-2"> <label for="time" class="text-light"> Seleccionar horario: </label> <input type="time" id="time" name="time" min="15:00" max="23:00" required> </div> <a href="#" class="m-2" id="remove"><button type="button" class="btn btn-warning btn-sm"><i class="fa fa-minus"></i></button></a> </div>';
                $("#container").append(html);
                if(i%2) {
                    document.getElementById(i).style.backgroundColor = "rgba(0,0,0,0.25)";
                } else {
                    document.getElementById(i).style.backgroundColor = "rgba(0,0,0,0.5)";
                }
            } else {
                alert('No puedes agregar más funciones.');
            }
        });

        //remover columna
        $("#container").on('click', '#remove', function(e){
            $(this).parent('div').remove();
            
            i--;
        });

        //populate values from the first row
    });
</script>

<form action="#" method="GET" class="p-3 mb-2 bg-dark">
<div class="form-group">
    <label for="select-cinema" class="text-light"> Seleccionar Cine: </label>
    <select class="form-control" id="select-cinema" name="cinema" id="" required>
        <option value="" selected disabled>Cines</option>
    <?php foreach($cinemasList->GetAll() as $cinema): ?>
        <option name="nameCinema" value="<?php echo $cinema->getName(); ?>"><?php echo $cinema->getName(); ?></option>
    <?php endforeach; ?>
    </select>
</div>
<div class="form-group">
    <label for="select-movie" class="text-light"> Seleccionar Pelicula: </label>
    <select class="form-control" name="movie" id="select-movie" required>
        <option value="" selected disabled>Peliculas</option>
    <?php foreach($movieList->getNowApi() as $movie): ?>
        <option name="nameMovie" value="<?php echo $movie->getTitle(); ?>"><?php echo $movie->getTitle(); ?></option>
    <?php endforeach; ?>
    </select>
</div>
<div class="container" id="container">
    <div class="text-dark row" style="background-color:rgb(0,0,0,0.5);">
        <div class="form-group col m-2">
            <label for="date" class="text-light"> Añadir fecha: </label>
            <input type="date" id="date" name="date" value="<?php echo date("Y-m-d"); ?>" min="<?php echo date("Y-m-d"); ?>" max="<?php /*echo date("Y-m-31");*/ ?>" required>
        </div>
        <div class="form-group col m-2">
            <label for="time" class="text-light"> Seleccionar horario: </label>
            <input type="time" id="time" name="time" min="15:00" max="23:00" required>    
        </div>
        <a href="#" class="m-2" id="add"><button type="button" class="btn btn-info btn-sm"><i class="fa fa-plus"></i></button></a>
    </div>
</div>

<div class="mt-3">
    <button type="submit" data-toggle="modal" class="btn btn-success btn-block btn-lg ">Agregar pelicula a la cartelera</button>
</div>

</form>