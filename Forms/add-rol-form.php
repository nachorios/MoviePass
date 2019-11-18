<form action="<?php echo URL . '/User/setRol' ?>" method="POST">
    <div class="">
    <div class="form-group ">
        <label for="">Correo electronico: </label>
        <input class="form-control" type="email" name="mail" id="">
    </div>
    <div class="form-group ">
        <label for="">Nivel del rol: </label>
        <input class="form-control" type="number" name="rol" min="1" max="5" id="">
    </div>
    <button type="submit" class="btn btn-primary btn-sm col">Agregar</button>
    </div>
</form>