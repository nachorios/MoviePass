<script type="text/javascript">

    function loadingEdit() {
        document.getElementById('loading-add').removeAttribute("hidden");
        document.getElementById('btn-add').remove();
        return;
    }

    function datesEditCheck() {
        var form = document.getElementById('billboard-add-form');//obtengo el formulario
        var dateReply = new Boolean(false);//creo la bandera

        var values = $("input[name='date-add[]']").map(function(){return $(this).val();}).get();//obtiene todas las fechas del formulario
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

    function validationEditCheck() {
        var replyEditDate = datesEditCheck();
        var replyEditSaloon = saloonEditCheck();
        if(replyEditDate == false && replyEditSaloon == false) {
            document.getElementById('btn-add').setCustomValidity("");//limpio las validaciones
        }
    }

    function saloonEditCheck() {
        var form = document.getElementById('billboard-add-form');//obtengo el formulario
        var saloonReply = new Boolean(false);//creo la bandera

        var values = $("select[name='saloon-add-select']").map(function(){return $(this).val();}).get();//obtiene todas las fechas del formulario
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

</script>

<form action="<?php echo URL?>/billboard/addFunction" oninput="validationEditCheck();" onsubmit="loadingEdit();" id="billboard-add-form" method="POST" name="frm" class="p-3 mb-2">
    <div class="container" id="container-add">
        <div class="text-dark row">
            <div class="form-group col m-2">
                <label for="date"> Añadir fecha: </label>
                <input type="date" name="date-add" id="date-add" class="form-control" min="<?php echo date("Y-m-d"); ?>" max="<?php /*echo date("Y-m-31");*/ ?>" required>
            </div>
            <div class="form-group col m-2">
                <label for="time"> Añadir horario: </label>
                <input type="time" name="time-add" id="time-add" class="form-control" min="15:00" max="23:00" required>    
            </div>
            <div class="form-group col m-2 ">
                <label for="saloon-select"> Añadir Sala: </label>
                <select name="saloon-add-select" id="select-add-saloon" class="form-control" class="select-add-class" required>
                    <option value="" selected disabled>Salas</option>
                    <!--<option name="saloon" value=""></option>-->
                </select>
            </div>
        </div>
    </div>
  
    <input type="text" name="billboard-function-add" class="form-control" id="billboard-function-add" value="" hidden> </input>
    <!--<input type="text" name="oldCinema" class="form-control" id="oldCinema" value="" hidden> </input>-->
    
    <div class="mt-3">
        <div class='text-center' id="loading-add" hidden> 
        <button class="btn btn-info btn-block btn-lg" type="button" disabled>
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            Agregando...
        </button>
        </div>
        <button type="submit" id="btn-add" class="btn btn-info btn-block btn-lg">Añadir función a la cartelera</button>
        
    </div>
</form>