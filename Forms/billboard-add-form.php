<script>
    $(document).ready(function(e){
        //variables
        var i = 0;
        var maxColumnas = 4;
        
        //agregar columna
        $("#add").click(function(e){
            if(i < maxColumnas) {
                i++;
                var dia = <?php echo intval(date("d"))?>+i;
                if(dia-10 < 0) {
                    dia = '0'+dia;
                }
                var fecha = "<?php echo (date("Y-m"))?>-"+dia;
                var html = '<div id="'+i+'" class=" text-dark row" style="background-color:rgb(0,0,0,0.5);"> <div class="form-group col m-2"> <label for="date" class="text-light"> Añadir fecha: </label> <input type="date" name="date[]" value="'+fecha+'" min="<?php echo date("Y-m-d"); ?>" max="<?php  /*echo date("Y-m-31");*/  ?>" required> </div> <div class="form-group col m-2"> <label for="time" class="text-light"> Seleccionar horario: </label> <input type="time" name="time[]" min="15:00" max="23:00" required> </div> <div class="form-group col m-2 "> <label for="time" class="text-light"> Seleccionar Sala: </label> <select name="time" id="select-time" required> <option value="" selected disabled>Salas</option> <option name="nameMovie[]" value="sala-1">Sala 1</option> <option name="nameMovie[]" value="sala-2">Sala 2</option> <option name="nameMovie[]" value="sala-3">Sala 3</option> <option name="nameMovie[]" value="sala-4">Sala 4</option> </select> </div> <a href="#" class="m-2" id="remove"><button type="button" class="btn btn-warning btn-sm"><i class="fa fa-minus"></i></button></a> </div>';
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
    });

    function loadingAdd() {
        document.getElementById('loading-add').removeAttribute("hidden");
        document.getElementById('btn-add').remove();
    }

    function datesCheck() {
        var form = document.getElementById('billboard-add-form');//obtengo el formulario
        var dateReply = new Boolean(false);//creo la bandera

        var values = $("input[name='date[]']").map(function(){return $(this).val();}).get();//obtiene todas las fechas del formulario
        for (i = 0; i < values.length; i++) {
            for (j = 0; j < values.length; j++) {
                if(values[i] == values[j] && i !== j) {//si las fechas son iguales y si no se esta comparando el mismo dato
                    document.getElementById('btn-add').setCustomValidity("Solo puedes elegir una funcion por fecha.");//creo la validacion(alerta)
                    dateReply = true;//indico que se encontraron 2 fechas iguales
                }
            }
        }
        return dateReply;
    }

    function validationCheck() {
        var replyDate = datesCheck();
        var replyTime = timesCheck();
        if(replyDate == false && replyTime == false) {
            document.getElementById('btn-add').setCustomValidity("");//limpio las validaciones
            document.getElementById('btn-add').setCustomValidity("");//limpio las validaciones
        }
    }

    function timesCheck() {
        var form = document.getElementById('billboard-add-form');//obtengo el formulario
        var timeReply = new Boolean(false);//creo la bandera

        var values = $("input[name='time[]']").map(function(){return $(this).val();}).get();//obtiene todas los horarios del formulario
        for (i = 0; i < values.length; i++) {
            for (j = 0; j < values.length; j++) {
                var h1 = parseInt(values[i].replace(":", ""));
                var h2 = parseInt(values[j].replace(":", ""));
                var timeBeetween = 0;
                if(h1 < h2) {
                    timeBeetween = h2-h1;
                } else {
                    timeBeetween = h1-h2;
                }
                if(timeBeetween < 15 && i !== j) {//si los horarios son iguales y si no se esta comparando el mismo dato
                    document.getElementById('btn-add').setCustomValidity("Las funciones deben tener como minimo 15 minutos entre ellas.");//creo la validacion(alerta)
                    timeReply = true;//indico que se encontraron 2 fechas iguales
                }
            }
        }
        return timeReply;
    }
</script>

<form action="<?php echo URL?>/Billboard/add#" oninput="validationCheck();" onsubmit="loadingAdd();" id="billboard-add-form" method="POST" class="p-3 mb-2 bg-dark rounded">
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
        <option name="nameMovie" value="<?php echo $movie->getId(); ?>"><?php echo $movie->getTitle(); ?></option>
    <?php endforeach; ?>
    </select>
</div>
<div class="container" id="container">
    <div class="text-dark row" style="background-color:rgb(0,0,0,0.5);">
        <div class="form-group col m-2">
            <label for="date" class="text-light"> Añadir fecha: </label>
            <input type="date" name="date[]" value="<?php echo date("Y-m-d"); ?>" min="<?php echo date("Y-m-d"); ?>" max="<?php /*echo date("Y-m-31");*/ ?>" required>
        </div>
        <div class="form-group col m-2">
            <label for="time" class="text-light"> Seleccionar horario: </label>
            <input type="time" name="time[]" min="15:00" max="23:00" required>    
        </div>
        <div class="form-group col m-2 ">
            <label for="saloon-select" class="text-light"> Seleccionar Sala: </label>
            <select name="saloon-select" id="select-saloon" required>
                <option value="" selected disabled>Salas</option>
            <?php foreach($saloonList as $saloon): ?>
                <option name="saloon" value="<?php echo $saloon; ?>"><?php echo $saloon; ?></option>
            <?php endforeach; ?>
            </select>
        </div>
        <a href="#" class="m-2" id="add"><button type="button" class="btn btn-info btn-sm"><i class="fa fa-plus"></i></button></a>
    </div>
</div>

<div class="mt-3">
    <div class='text-center' id="loading-add" hidden> 
        <button class="btn btn-success btn-block btn-lg" type="button" disabled>
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            Agregando...
        </button>
    </div>
    <button type="submit" id="btn-add" data-toggle="modal" class="btn btn-success btn-block btn-lg">Agregar pelicula a la cartelera</button>
</div>

</form>