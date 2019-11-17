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
                var html = '<div id="'+i+'" class=" text-dark row" style="background-color:rgb(0,0,0,0.5);"> <div class="form-group col m-2"> <label for="date" class="text-light"> Añadir fecha: </label> <input type="date" name="date[]" value="'+fecha+'" min="<?php echo date("Y-m-d"); ?>" max="<?php  /*echo date("Y-m-31");*/  ?>" required> </div> <div class="form-group col m-2"> <label for="time" class="text-light"> Seleccionar horario: </label> <input type="time" name="time[]" min="15:00" max="23:00" required> </div> <div class="form-group col m-2 "> <label for="time" class="text-light"> Seleccionar Sala: </label> <select name="saloon-select[]" id="select-saloon" class="select-class" onmouseover="actualizarSalasNoEditadas()" required> <option value="" selected disabled>Salas</option> </select> </div> <a href="#" class="m-2" id="remove"><button type="button" class="btn btn-warning btn-sm"><i class="fa fa-minus"></i></button></a> </div>';
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
        var replySaloon = saloonCheck();
        var replyDate = datesCheck();
        if(replyDate == false && replySaloon == false) {
            document.getElementById('btn-add').setCustomValidity("");//limpio las validaciones
        }
    }

    function saloonCheck() {    
        var form = document.getElementById('billboard-add-form');//obtengo el formulario
        var saloonReply = new Boolean(false);//creo la bandera

        var values = $("select[name='saloon-select[]']").map(function(){return $(this).val();}).get();//obtiene todas las fechas del formulario
        for (i = 0; i < values.length; i++) {
            for (j = 0; j < values.length; j++) {
                if(values[i] == values[j] && i != j) {//si las fechas son iguales y si no se esta comparando el mismo dato
                    document.getElementById('btn-add').setCustomValidity("Solo puedes elegir una funcion por sala.");//creo la validacion(alerta)
                    saloonReply = true;//indico que se encontraron 2 fechas iguales
                }
            }
        }
        return saloonReply;
    }

    /*function timesCheck() {
        var form = document.getElementById('billboard-add-form');//obtengo el formulario
        var timeReply = new Boolean(false);//creo la bandera

        var values = $("input[name='time[]']").map(function(){return $(this).val();}).get();//obtiene todas los horarios del formulario
        var valuesDates = $("input[name='date[]']").map(function(){return $(this).val();}).get();//obtiene todas las fechas del formulario
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
                if(timeBeetween < 15 && values[i] != values[j] && i !== j) {//si los horarios son iguales y si no se esta comparando el mismo dato
                    document.getElementById('btn-add').setCustomValidity("Las funciones deben tener como minimo 15 minutos entre ellas.");//creo la validacion(alerta)
                    timeReply = true;//indico que se encontraron 2 fechas iguales
                }
            }
        }
        return timeReply;
    }*/

    function actualizarSalas() {
        var s1 = document.getElementById('select-add-cinema');
        var value = s1.options[s1.selectedIndex].id;
        var data = value.slice(0, -1); //le quitamos la ultima '/' para evitar errores.s
        var optionArray = data.split("/");
        
        //$("#select-saloon").empty();
        var elements = document.getElementsByClassName("select-class");
        for(i = 0; i < elements.length; i++) {
            var e = elements[i];
            while (e.options.length > 1) {                
                e.remove(1);
            } 
            for(var option in optionArray){
                var pair = optionArray[option].split("-");
                var newOption = document.createElement("option");
                newOption.innerHTML = pair[0];
                newOption.value = pair[1];
                newOption.setAttribute("name", "saloon[]");

                e.options.add(newOption);
            }
        }
    }

    function actualizarSalasNoEditadas() {
        var s1 = document.getElementById('select-add-cinema');
        var value = s1.options[s1.selectedIndex].id;
        var data = value.slice(0, -1); //le quitamos la ultima '/' para evitar errores.s
        var optionArray = data.split("/");
        
        //$("#select-saloon").empty();
        var elements = document.getElementsByClassName("select-class");
        for(i = 0; i < elements.length; i++) {
            var e = elements[i];
            if (e.options.length == 1) {
                while (e.options.length > 1) {                
                    e.remove(1);
                } 
                for(var option in optionArray){
                    var pair = optionArray[option].split("-");
                    var newOption = document.createElement("option");
                    newOption.innerHTML = pair[0];
                    //newOption.value = pair[1];
                    newOption.setAttribute("name", "saloon[]");
                    newOption.setAttribute("value", pair[1]);

                    e.options.add(newOption);
                }
            }
            
        }
    }

</script>
<?php 
    $cinemas = $cinemasList->GetAll();
    if($cinemas != null && !is_array($cinemas))
        $cinemas = array($cinemas);
?>
<form action="<?php echo URL?>/Billboard/add#" onclick="validationCheck();" onsubmit="loadingAdd();" id="billboard-add-form" method="POST" class="p-3 mb-2 bg-dark rounded">
<div class="form-group">
    <label for="select-cinema" class="text-light"> Seleccionar Cine: </label>
    <select class="form-control" id="select-add-cinema" onchange="actualizarSalas()" name="cinema" id="select-cinema" required>
        <option value="" selected disabled>Cines</option>
    <?php foreach($cinemas as $cinema):  ?>
        <option name="nameCinema" id="<?php foreach($cinema->getSaloon() as $saloons){ echo $saloons->getName() .'-'. $saloons->getId().'/'; } ?>" value="<?php echo $cinema->getIdCinema(); ?>"><?php echo $cinema->getName(); ?></option>
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
            <select name="saloon-select[]" id="select-saloon" onmouseover="actualizarSalasNoEditadas()" class="select-class" required>
                <option value="" selected disabled>Salas</option>
                <!--<option name="saloon" value=""></option>-->
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