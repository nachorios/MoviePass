<script type="text/javascript">

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
                if(timeBeetween < 15 && values[i] != values[j] && i !== j) {//si los horarios son iguales y si no se esta comparando el mismo dato
                    document.getElementById('btn-edit').setCustomValidity("Las funciones deben tener como minimo 15 minutos entre ellas.");//creo la validacion(alerta)
                    timeReply = true;//indico que se encontraron 2 fechas iguales
                }
            }
        }
        return timeReply;
    }

</script>

<form action="<?php echo URL?>/billboard/editFunction"  oninput="validationEditCheck();" onsubmit="loadingEdit();" id="billboard-edit-form" method="POST" name="frm" class="p-3 mb-2">
    <div class="container" id="container-edit">
        <div class="text-dark row">
            <div class="form-group col m-2">
                <label for="date"> Modificar fecha: </label>
                <input type="date" name="date-edit" id="date-edit" class="form-control" min="<?php echo date("Y-m-d"); ?>" max="<?php /*echo date("Y-m-31");*/ ?>" required>
            </div>
            <div class="form-group col m-2">
                <label for="time"> Modificar horario: </label>
                <input type="time" name="time-edit" id="time-edit" class="form-control" min="15:00" max="23:00" required>    
            </div>
            <div class="form-group col m-2 ">
                <label for="saloon-select"> Modificar Sala: </label>
                <select name="saloon-edit-select" id="select-edit-saloon" class="form-control" class="select-edit-class" required>
                    <option value="" selected disabled>Salas</option>
                    <!--<option name="saloon" value=""></option>-->
                </select>
            </div>
        </div>
    </div>
  
    <input type="text" name="idBillboardEdit" class="form-control" id="idBillboardEdit" value="" hidden> </input>
    <!--<input type="text" name="oldCinema" class="form-control" id="oldCinema" value="" hidden> </input>-->
    
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