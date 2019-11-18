<div class="container text-center bg-light rounded">
    <h1 class="">Entradas Adquiridas</h1>
    <form action="<?php URL . '/User/TicketList/' ?>">
        <div class="row">
            <div class="form-group col-4">
                <label for="" class="">Buscar por pelicula: </label>
                <input type="text" class="form-control" name="movie" id="">
            </div>
            <div class="form-group col-4">
                <label for="" class="">Buscar entradas: </label>
                <button type="submit" class="btn btn-primary form-control">Filtrar</button>
            </div>
            <div class="form-group col-4">
                <label for="" class="">Buscar por Fecha: </label>
                <input type="date" class="form-control" name="date" id="">
            </div>
        </div>
    </form>
    <table class="table">
        <thead>
            <th>Numero de Entrada</th>
            <th>Pelicula</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Sala</th>
            <th>Codigo QR</th>
        </thead>
        <tbody>
        <?php $i=0; foreach(array(1) as $ticket): $i++;?>
            <tr>
                <td><?php echo 'numero' ?></td>
                <td><?php echo  $i ?></td>
                <td><?php echo "$i-11-2019" ?></td>
                <td><?php echo '18:15' ?></td>
                <td><?php echo 'salonsato' ?></td>
                <td><a href="<?php echo URL ?>/User/viewQR">QR</a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>