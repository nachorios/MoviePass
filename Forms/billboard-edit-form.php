<script type="text/javascript">
    $(document).ready(function(e){
        //variables
        var i = 0;
        var maxColumnas = 4;
        
        //agregar columna
        $("#add-edit").click(function(e){
            if(i < maxColumnas) {
                i++;
                var dia = <?php echo intval(date("d"))?>+i;
                if(dia-10 < 0) {
                    dia = '0'+dia;
                }
                var fecha = "<?php echo (date("Y-m"))?>-"+dia;
                var html = '<div id="'+i+'" class=" text-dark row" style="background-color:rgb(0,0,0,0.5);"> <div class="form-group col m-2"> <label for="date" class="text-light"> Añadir fecha: </label> <input type="date" name="date-edit[]" value="'+fecha+'" min="<?php echo date("Y-m-d"); ?>" max="<?php  /*echo date("Y-m-31");*/  ?>" required> </div> <div class="form-group col m-2"> <label for="time" class="text-light"> Seleccionar horario: </label> <input type="time" name="time-edit[]" min="15:00" max="23:00" required> </div> <div class="form-group col m-2 "> <label for="saloon-select-edit" class="text-light"> Seleccionar Sala: </label> <select name="saloon-select" id="select-saloon-edit" required> <option value="" selected disabled>Salas</option> <?php foreach($saloonList as $saloon): ?> <option name="saloon-edit" value="<?php echo $saloon; ?>"><?php echo $saloon; ?></option> <?php endforeach; ?> </select> </div> <a href="#" class="m-2" id="remove-edit"><button type="button" class="btn btn-warning btn-sm"><i class="fa fa-minus"></i></button></a> </div>';
                $("#container-edit").append(html);
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
        $("#container-edit").on('click', '#remove-edit', function(e){
            $(this).parent('div').remove();
            
            i--;
        });

        //populate values from the first row
    });

    function loadingEdit() {
        document.getElementById('loading-edit').removeAttribute("hidden");
        document.getElementById('btn-edit').remove();
        return;
    }

    function datesEditCheck() {
        var form = document.getElementById('billboard-edit-form');//obtengo el formulario
        var dateReply = new Boolean(false);//creo la bandera

        var values = $("input[name='date-edit[]']").map(function(){return $(this).val();}).get();//obtiene todas las fechas del formulario
        for (i = 0; i < values.length; i++) {
            for (j = 0; j < values.length; j++) {
                if(values[i] == values[j] && i !== j) {//si las fechas son iguales y si no se esta comparando el mismo dato
                    document.getElementById('btn-edit').setCustomValidity("Solo puedes elegir una funcion por fecha.");//creo la validacion(alerta)
                    dateReply = true;//indico que se encontraron 2 fechas iguales
                }
            }
        }
        return dateReply;
    }

    function validationEditCheck() {
        var replyEditDate = datesEditCheck();
        var replyEditTime = timesEditCheck();
        if(replyEditDate == false && replyEditTime == false) {
            document.getElementById('btn-edit').setCustomValidity("");//limpio las validaciones
            document.getElementById('btn-edit').setCustomValidity("");//limpio las validaciones
        }
    }

    function timesEditCheck() {
        var form = document.getElementById('billboard-edit-form');//obtengo el formulario
        var timeReply = new Boolean(false);//creo la bandera

        var values = $("input[name='time-edit[]']").map(function(){return $(this).val();}).get();//obtiene todas los horarios del formulario
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
                    document.getElementById('btn-edit').setCustomValidity("Las funciones deben tener como minimo 15 minutos entre ellas.");//creo la validacion(alerta)
                    timeReply = true;//indico que se encontraron 2 fechas iguales
                }
            }
        }
        return timeReply;
    }
</script>
<?php 
    $cinemas = $cinemasList->GetAll();
    if($cinemas != null && !is_array($cinemas))
        $cinemas = array($cinemas);
?>
<form action="<?php echo URL?>/Billboard/editBillboard"  oninput="validationEditCheck();" onsubmit="loadingEdit();" id="billboard-edit-form" method="POST" name="frm" class="p-3 mb-2 bg-dark">
    <div class="form-group">
        <label for="select-cinema" class="text-light"> Seleccionar Cine: </label>
        <select class="form-control" id="select-cinema" name="cinema" required>
            <option value="" disabled>Cines</option>
        <?php foreach($cinemas as $cinema): ?>
            <option name="nameCinema" value="<?php echo $cinema->getName(); ?>"><?php echo $cinema->getName(); ?></option>
        <?php endforeach; ?>
        </select>
    </div>
    <div class="form-group">
        <label for="select-movie" class="text-light"> Seleccionar Pelicula: </label>
        <select class="form-control" name="movie" id="select-movie" required>
            <option value="" disabled>Peliculas</option>
        <?php foreach($movieList->getNowApi() as $movie): ?>
            <option name="nameMovie" value="<?php echo $movie->getId(); ?>"><?php echo $movie->getTitle(); ?></option>
        <?php endforeach; ?>
        </select>
    </div>
    <div class="container" id="container-edit">
        <div class="text-dark row" style="background-color:rgb(0,0,0,0.5);">
            <div class="form-group col m-2">
                <label for="date" class="text-light"> Añadir fecha: </label>
                <input type="date" name="date-edit[]" value="<?php echo date("Y-m-d"); ?>" min="<?php echo date("Y-m-d"); ?>" max="<?php /*echo date("Y-m-31");*/ ?>" required>
            </div>
            <div class="form-group col m-2">
                <label for="time" class="text-light"> Seleccionar horario: </label>
                <input type="time" name="time-edit[]" min="15:00" max="23:00" required>    
            </div>
            <div class="form-group col m-2 ">
                <label for="saloon-select-edit" class="text-light"> Seleccionar Sala: </label>
                <select name="saloon-select" id="select-saloon-edit" required>
                    <option value="" selected disabled>Salas</option>
                </select>
            </div>
            <a href="#" class="m-2" id="add-edit"><button type="button" class="btn btn-info btn-sm"><i class="fa fa-plus"></i></button></a>
        </div>
    </div>
  
    <input type="text" name="oldMovie" class="form-control" id="oldMovie" value="" hidden> </input>
    <input type="text" name="oldCinema" class="form-control" id="oldCinema" value="" hidden> </input>
    
    <div class="mt-3">
        <div class='text-center' id="loading-edit" hidden> 
        <button class="btn btn-info btn-block btn-lg" type="button" disabled>
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            Editando...
        </button>
        </div>
        <button type="submit" id="btn-edit" class="btn btn-info btn-block btn-lg">Confirmar edicion de cartelera</button>
        
    </div>
</form>