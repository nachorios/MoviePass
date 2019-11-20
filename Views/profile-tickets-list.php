<div class="container text-center bg-light rounded">
    <h1 class="">Entradas Adquiridas</h1>
    <form action="<?php URL . '/Buyout/TicketList/' ?>"> <!--cambie el user por buyout-->
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
            <th>Cantidad de entradas</th>
            <th>Pelicula</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Sala</th>
            <!--<th>Codigo QR</th>-->
        </thead>
        <tbody>
        <?php foreach($userTickets as $ticket):?>
            <tr>
                <td><?php echo $ticket->getQuan(); ?></td>
                <td><?php echo $ticket->getMovie()->getTitle(); ?></td>
                <td><?php echo $ticket->getDate(); ?></td>
                <td><?php echo $ticket->getFunction()->getSaloon()->getName(); ?></td>
                <td><?php echo 'salonsato' ?></td>
                <!--<td>QR</td>-->
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>
