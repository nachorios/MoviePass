<script>

  $(document).ready(function(e){
    //variables
    var i = 0;
    var maxColumnas = 4;
    var rounded = '';

    //agregar columna
    $("#add").click(function(e){
        if(i < maxColumnas) {
            i++;
            if (i== maxColumnas)
              rounded = 'rounded-bottom';
            else
              rounded = '';
            var html = '<div id="'+i+'" class=" text-dark row '+rounded+'" style="background-color:rgb(0,0,0,0.5);"> <div class="form-group col m-2"> <label for="nameCinema"> Nombre del salon: </label> <input type="text" name="name-saloon[]" class="form-control" id="nameCinema" placeholder="Nombre del salon" required> </input> </div> <div class="form-group col m-2"> <label for="valueCine"> Valor entrada: </label> <input type="number" min="0" name="value-saloon[]" class="form-control" id="valueCine" placeholder="Valor de la entrada" required> </input> </div> <div class="form-group col m-2 "> <label for="capacityCinema"> Capacidad de sala: </label> <input type="number" min="0" max="200" name="capacity-saloon[]" class="form-control" id="capacityCinema" placeholder="Capacidad de butacas" required> </input> </div> <a href="#" class="m-2" id="remove"><button type="button" class="btn btn-warning btn-sm"><i class="fa fa-minus"></i></button></a> </div>';
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
        return;
    }
</script>

<div class="container">
<form action="<?php echo URL?>/cinema/registerCinema" onsubmit="loadingAdd()" method="POST">

  <div class="form-group col-6 float-left">
    <label for="nameCinema"> Nombre del cine: </label>
    <input type="text" name="name" class="form-control" id="nameCinema" placeholder="Ingresar nombre del cine" required> </input>
  </div>
  <!--<div class="form-group col-6 float-left">
    <label for="capacityCinema"> Capacidad de sala: </label>
    <input type="number" min="0" max="200" name="capacity" class="form-control" id="capacityCinema" placeholder="Ingresar capacidad de sala" required> </input>
  </div>-->
  <div class="form-group col-6 float-left">
    <label for="adressCinema"> Direccion: </label>
    <input type="text" name="adress" class="form-control" id="adressCinema" placeholder="Ingresar direccion" required> </input>
  </div>
  <!--<div class="form-group col-6 float-left">
    <label for="valueCine"> Valor entrada: </label>
    <input type="number" min="0" name="value" class="form-control" id="valueCine" placeholder="Ingresar valor unico de entrada" required> </input>
  </div>-->

    <h3 class="text-center"><u>Agregar salones</u></h3>
    <div class="container mb-2" id="container">
    <div class="text-dark row rounded-top" style="background-color:rgb(0,0,0,0.5);">
      <div class="form-group col m-2">
        <label for="nameCinema"> Nombre del salon: </label>
        <input type="text" name="name-saloon[]" class="form-control" id="nameCinema" placeholder="Nombre del salon" required> </input>
      </div>
      <div class="form-group col m-2">
        <label for="valueCine"> Valor entrada: </label>
        <input type="number" min="0" name="value-saloon[]" class="form-control" id="valueCine" placeholder="Valor de la entrada" required> </input>
      </div>
      <div class="form-group col m-2 ">
        <label for="capacityCinema"> Capacidad de sala: </label>
        <input type="number" min="0" max="200" name="capacity-saloon[]" class="form-control" id="capacityCinema" placeholder="Capacidad de butacas" required> </input>
      </div>
      <a href="#" class="m-2" id="add"><button type="button" class="btn btn-info btn-sm"><i class="fa fa-plus"></i></button></a>
    </div>
  </div>

  <div class="text-center">
      <div id="loading-add" hidden>
      <button class="btn btn-success btn-lg" type="button" disabled>
          <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
          Agregando...
      </button>
      </div>
    <button type="submit" id="btn-add" class="btn btn-success btn-lg">Agregar</button>
  </div>
</form>
</div>
