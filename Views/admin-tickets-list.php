<div class="container text-center bg-light rounded">
    <h1 class="mt-2 mb-5">Informe de Ventas</h1>
    <table class="table mb-5">
        <thead class="thead-dark">
            <tr>
            <th scope="col">Peliculas</th>
            <th scope="col">Cantidad de entradas vendidas</th>
            <th scope="col">Cantidad de entradas remanentes</th>
            </tr>
        </thead>
        <tbody>
        <?php
            foreach($movieTicketList as $movieTicket):
            ?>
                <tr>
                    <th scope="row"><?php echo $movieTicket->getName() ?></th>
                    <td><?php echo $movieTicket->getTicketsSold(); ?></td>
                    <td><?php echo $movieTicket->getTicketsRemaining(); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <table class="table mb-5">
        <thead class="thead-dark">
            <tr>
            <th scope="col">Cines</th>
            <th scope="col">Cantidad de entradas vendidas</th>
            <th scope="col">Cantidad de entradas remanentes</th>
            </tr>
        </thead>
        <tbody>
        <?php
            foreach($cinemaTicketList as $cinemaTicket):
            ?>
                <tr>
                    <th scope="row"><?php echo $cinemaTicket->getName() ?></th>
                    <td><?php echo $cinemaTicket->getTicketsSold(); ?></td>
                    <td><?php echo $cinemaTicket->getTicketsRemaining(); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <form action="<?php URL . '/Buyout/TicketList/' ?>"> <!--cambie el user por buyout-->
        <h4 class="">Busqueda personalizada por fechas</h4>
        <div class="row">
            <div class="form-group col-4">
                <label for="" class="">Fecha de inicio: </label>
                <input type="date" class="form-control" name="date-start" id="">
            </div>
            <div class="form-group col-4">
                <label for="" class="">Buscar ventas: </label>
                <button type="submit" class="btn btn-primary form-control">Filtrar</button>
            </div>
            <div class="form-group col-4">
                <label for="" class="">Fecha de cierre: </label>
                <input type="date" class="form-control" name="date-end" id="">
            </div>
        </div>
    </form>
    <table class="table mb-5">
        <h4 class=""><u>Ventas por pelicula</u></h4>
        <thead class="thead-dark">
            <tr>
            <th scope="col">Pelicula</th>
            <th scope="col">Obtenido en pesos</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $moviesAmount = array();
            foreach($userBuyouts as $buy):
                if(!in_array($buy->getMovie(), $moviesAmount)):
                    array_push($moviesAmount, $buy->getMovie()) ?>
            <tr>
                <th scope="row"><?php echo $buy->getMovie()->getTitle() ?></th>
                <!--accedo a travez de buysdao porque esa es la variable que se genero en BuyoutController-->
                <td><?php echo $buysDAO->GetAmountMovieTickets($buy->getMovie()->getId(), $startDate, $endDate); ?>.00 $</td>
            </tr>
            <?php endif;
        endforeach;
        if(empty($userBuyouts)): ?>
        <td>Aún no se han registrado ventas...</td>
        <td>0.00$</td>
        <?php endif; ?>
        </tbody>
    </table>
    <table class="table mb-5">
        <h4 class=""><u>Ventas por cine</u></h4>
        <thead class="thead-dark">
            <tr>
            <th scope="col">Cine</th>
            <th scope="col">Obtenido en pesos</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $cinemasAmount = array();
            foreach($userBuyouts as $buy):
                if(!in_array($buy->getCinema(), $cinemasAmount)):
                    array_push($cinemasAmount, $buy->getCinema()) ?>
            <tr>
                <th scope="row"><?php echo $buy->getCinema()->getName() ?></th>
                <!--accedo a travez de buysdao porque esa es la variable que se genero en BuyoutController-->
                <td><?php echo $buysDAO->GetAmountCinemaTickets($buy->getCinema()->getIdCinema(), $startDate, $endDate); ?>.00 $</td>
            </tr>
            <?php endif;
        endforeach; 
        if(empty($userBuyouts)): ?>
            <td>Aún no se han registrado ventas...</td>
            <td>0.00$</td>
        <?php endif; ?>
        </tbody>
    </table>
</div>
