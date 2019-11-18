    <!--Desarrollo modal-->
    <div class="modal fade" id="registerModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!--header-->
                <div class="modal-header">
                    <h4 class="modal-title">Registrate!</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!--body-->
                <div class="modal-body">
                  <?php include(FORMS_PATH ."/register-form.php") ?>
                </div>
                <div class="modal-footer">
                    <!--<button class="btn btn-danger" type="button" data-dismiss="modal">Cerrar</button>-->
                </div>
            </div>
        </div>
    </div>
    <!--Desarrollo modal-->
    <div class="modal fade" id="setRol">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <!--header-->
                <div class="modal-header">
                    <h4 class="modal-title">Añade un nuevo administrador</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!--body-->
                <div class="modal-body">
                  <?php include(FORMS_PATH ."/add-rol-form.php") ?>
                </div>
                <div class="modal-footer">
                    <!--<button class="btn btn-danger" type="button" data-dismiss="modal">Cerrar</button>-->
                </div>
            </div>
        </div>
    </div>

<!--en el style del fondo se coloca el 0.5 al final para indicar la opacidad del fondo,
 si se usa la caracteristica "opacity" convierte a todos los elementos en opacos-->
<div class="barrasuperior" style="background-color:rgb(0,0,0,0.5);">
<nav class="navbar navbar-expand-sm">
        <a href="<?php echo URL ?>" class="navbar-brand " ><img src="<?php echo IMG_PATH ?>/PT-logofinal.png" style="height: 80px" ></a>
        <!--el navbar-dark permite cambiar el color del boton colapsable para que destaque en el fondo oscuro/ solo hay dark y light-->
        <button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#uno"><span
                class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse ml-auto" id="uno">
            <ul class="navbar-nav ml-auto font-weight-bold" style="font-size: 1.2em;margin-right:5px;"  >
                <li class="nav-item"><a href="<?php echo URL ?>/Cinema/ShowCinemasList/" class="nav-link text-light">Cines</a></li>
                <li class="nav-item"><a href="<?php echo URL ?>/Billboard/ShowView/" class="nav-link text-light">Cartelera</a></li>
                <li class="nav-item"><a href="#" class="nav-link text-light">Horarios</a></li>
                <li class="nav-item"><a href="#" class="nav-link text-light">Precios</a></li>
                <li class="nav-item"><a href="<?php echo URL ?>/Movie/ShowListView/" class="nav-link text-light">Peliculas</a></li>
                
                <li>
                    <div class="btn-group btn-sm">
                    <div class="btn-group dropleft" role="group">
                        <button type="button" class="btn btn-light dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="sr-only">Toggle Dropleft</span>
                        </button>
                        <div class="dropdown-menu">
                        <?php
                    if(isset($_SESSION['loggedUser'])):
                    ?>
                        <button class="dropdown-item" onclick="window.location = '<?php echo URL ?>/User/Profile/'" type="button">Ver Perfil</button>
                        <button class="dropdown-item" onclick="window.location = '<?php echo URL ?>/User/TicketList/'" type="button">Consultar entradas</button>
                        <div class="dropdown-divider"></div>
                        <?php if($_SESSION['loggedUser']->getRole()>1): ?>
                        <button class="dropdown-item" onclick="window.location = '<?php echo URL ?>/User/AdminTicketList/'" type="button">Consultar Ventas</button>
                            <button class="dropdown-item" data-toggle="modal" data-target="#setRol" type="button">Dar Administrador</button>
                        <?php endif; ?>
                    <?php
                    else:
                    ?>
                            <a class="text-decoration-none" href="<?php include('Config/fb-config.php'); echo $loginUrl; ?>"> <button class="dropdown-item" type="button">Iniciar con Facebook</button> </a>
                            <div class="dropdown-divider"></div>
                            <button class="dropdown-item" data-toggle="modal" data-target="#registerModal" type="button">Registrar usuario</button>
                    <?php
                    endif;?>
                            
                        </div>
                    </div>
                    <?php if(!isset($_SESSION['loggedUser'])): ?>
                        <button type="button" onclick="window.location = '<?php echo URL ?>/Home/Login/'" class="btn btn-secondary">
                            Iniciar Sesion
                        </button>
                    <?php else: ?>
                        <button onclick="window.location = '<?php echo URL ?>/User/logout/'" class="btn btn-secondary p-0 m-0"><img src="<?php 
                        $usuario = $_SESSION['loggedUser'];
                        $fileName = str_replace(".","_",$usuario->getMail()).'.png';
                        if($usuario->getProfileImage() != null && !file_exists(FILES_PATH . $fileName)) 
                            echo $usuario->getProfileImage();
                        else if (file_exists(FILES_PATH . $fileName)) {
                            echo URL.'/'. FILES_PATH.$fileName;
                        } else 
                            echo IMG_PATH.'/user.png';
                ?>" style="width:30px; min-height: 30px; max-height: 30px;" class="float-right text-center" alt="Foto de Perfil"><span class="m-1">Cerrar Sesion </span></button>
                    <?php endif; ?>
                    </div>
                </li>

                <!--<form action="search.php" method="post" class="form-inline">// Boton de buscar
                    <input type="text" placeholder="Buscar" class="form-control mr-sm-2">
                    <button type="submit" class="btn btn-success">Buscar</button>
                </form>-->
            </ul>
        </div>
    </nav>
</div>
