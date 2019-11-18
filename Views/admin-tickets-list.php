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
            $moviesAdded = array();
            foreach($userBouyouts as $buy): 
                if(!in_array($buy->getMovie(), $moviesAdded)):
                    array_push($moviesAdded, $buy->getMovie()) ?>
            <tr>
                <th scope="row"><?php echo $buy->getMovie()->getTitle() ?></th>
                <td><?php echo $buysDAO->GetCountMovieTickets($buy->getMovie()->getId()); ?></td>
                <td><?php 
                $auxAmountTickets = $buy->getFunction()->getSaloon()->getCapacity() - $buysDAO->GetCountMovieTickets($buy->getMovie()->getId());
                if($auxAmountTickets < 0)
                    echo 0;
                else
                    echo $auxAmountTickets;  ?></td>
            </tr>
            <?php endif;
        endforeach; ?>
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
            $cinemasAdded = array();
            foreach($userBouyouts as $buy): 
                if(!in_array($buy->getCinema(), $cinemasAdded)):
                    array_push($cinemasAdded, $buy->getCinema());
                    $cinemaCapacity = 0; 
                    $saloons = $buy->getCinema()->getSaloon();
                    if(!is_array($saloons))
                        $saloons = array($saloons);
                    foreach($saloons as $saloon) {
                        $cinemaCapacity += $buy->getFunction()->getSaloon()->getCapacity();
                    }
                    ?>
            <tr>
                <th scope="row"><?php echo $buy->getCinema()->getName() ?></th>
                <td><?php echo $buysDAO->GetCountCinemaTickets($buy->getCinema()->getIdCinema()); ?></td>
                <td><?php 
                    $auxAmountCapacity = $cinemaCapacity - $buysDAO->GetCountCinemaTickets($buy->getCinema()->getIdCinema());
                    if($auxAmountCapacity < 0) 
                        echo 0;
                    else
                        echo $cinemaCapacity - $buysDAO->GetCountCinemaTickets($buy->getCinema()->getIdCinema()); ?></td>
            </tr>
            <?php endif;
        endforeach; ?>
        </tbody>
    </table>

    <form action="<?php URL . '/User/TicketList/' ?>">
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
            foreach($userBouyouts as $buy): 
                if(!in_array($buy->getMovie(), $moviesAmount)):
                    array_push($moviesAmount, $buy->getMovie()) ?>
            <tr>
                <th scope="row"><?php echo $buy->getMovie()->getTitle() ?></th>
                <td><?php echo $buysDAO->GetAmountMovieTickets($buy->getMovie()->getId(), $startDate, $endDate); ?>.00 $</td>
            </tr>
            <?php endif;
        endforeach; ?>
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
            foreach($userBouyouts as $buy): 
                if(!in_array($buy->getCinema(), $cinemasAmount)):
                    array_push($cinemasAmount, $buy->getCinema()) ?>
            <tr>
                <th scope="row"><?php echo $buy->getCinema()->getName() ?></th>
                <td><?php echo $buysDAO->GetAmountCinemaTickets($buy->getCinema()->getIdCinema(), $startDate, $endDate); ?>.00 $</td>
            </tr>
            <?php endif;
        endforeach; ?>
        </tbody>
    </table>
</div>