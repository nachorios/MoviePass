
<form class="login-form bg-light rounded p-3 mb-4">
    <h3 class="mb-2"><u>Busqueda personalizada</u></h3>
    <div class="row">
        <div class="form-group col">
            <label for="genre_select" >Seleccionar Genero: </label>
            <select name='genre_select' class='form-control' id='genre_select' onclick='cambiar()'>
                <option value='-1' selected disabled>Categorias</option>
                <option value='-1'>Todos</option>
                <?php $i = 0;
                foreach($genreList as $genre => $key):
                    if (isset($_GET['show_genre'])) {
                        $genre_id = $_GET['show_genre'];
                        if ($genre_id == $key['id']) {
                            echo '<option value='.$key['id'].' selected>'.$key['name'].'</option>';
                        } else {
                            echo '<option value='.$key['id'].'>'.$key['name'].'</option>';
                        }
                    } else {
                        echo '<option value='.$key['id'].'>'.$key['name'].'</option>';
                    }
                    $i++;
                endforeach;?>
            </select>
        </div>

        <div class="form-group col">
            <label for="date_select" >Seleccionar Fecha: </label>
            <input type="date" id="date_select" class="form-control" name="date_select" onclick='cambiarFecha()' value="<?php 
            if (isset($_GET['show_date'])) {
                echo $_GET['show_date'];
            } else {
                //echo date("Y-m-d");
            }?>" >
        </div>
    </div>
</form>
