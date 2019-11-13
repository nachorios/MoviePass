
<!-- BORRAR CINE -->
    <div class = "modal fade" id = "borrado-exito" role = "dialog">
        <div class = "modal-dialog modal-sm text-danger">
            <div class = "modal-content">
                <div class = "modal-header">
                        <h4 class = "modal-title">Cine borrado</h4>
                </div>
                <div class = "modal-body">
                        <p>El cine se ha borrado con exito.</p>
                </div>
                <div class = "modal-footer">
                        <button type = "button" class = "btn btn-danger" data-dismiss = "modal">Aceptar</button>
                </div>
            </div>
        </div>
    </div>
<!---->
<!-- BORRAR CINE ERROR -->
<div class = "modal fade" id = "borrado-error" role = "dialog">
        <div class = "modal-dialog modal-sm text-danger">
            <div class = "modal-content">
                <div class = "modal-header">
                        <h4 class = "modal-title">Cine inexistente</h4>
                </div>
                <div class = "modal-body">
                        <p>El cine que intenta borrar no existe.</p>
                </div>
                <div class = "modal-footer">
                        <button type = "button" class = "btn btn-danger" data-dismiss = "modal">Aceptar</button>
                </div>
            </div>
        </div>
    </div>
<!---->
<!-- EDITAR CINE EXITO-->
<div class = "modal fade" id = "edicion-exito" role = "dialog">
     <div class = "modal-dialog modal-sm text-info">
          <div class = "modal-content">
               <div class = "modal-header">
                    <h4 class = "modal-title">Cine editado</h4>
               </div>
               <div class = "modal-body">
                    <p>El cine se ha editado con exito.</p>
               </div>
               <div class = "modal-footer">
                    <button type = "button" class = "btn btn-info" data-dismiss = "modal">Aceptar</button>
               </div>
          </div>
     </div>
</div>
<!---->
<!-- AGREGAR CINE EXITO -->
    <div class = "modal fade" id = "registro-exito" role = "dialog">
        <div class = "modal-dialog modal-sm text-success">
            <div class = "modal-content">
                <div class = "modal-header">
                        <h4 class = "modal-title">Cine Agregado</h4>
                </div>
                <div class = "modal-body">
                        <p>El cine se ha agregado con exito.</p>
                </div>
                <div class = "modal-footer">
                        <button type = "button" class = "btn btn-success" data-dismiss = "modal">Aceptar</button>
                </div>
            </div>
        </div>
    </div>
<!---->
<!-- AGREGAR CINE ERROR -->
    <div class = "modal fade" id = "registro-error" role = "dialog">
        <div class = "modal-dialog modal-sm text-danger">
            <div class = "modal-content">
                <div class = "modal-header">
                        <h4 class = "modal-title">Cine existente</h4>
                </div>
                <div class = "modal-body">
                        <p>El cine que esta intentando agregar ya existe.</p>
                </div>
                <div class = "modal-footer">
                        <button type = "button" class = "btn btn-danger" data-dismiss = "modal">Aceptar</button>
                </div>
            </div>
        </div>
    </div>
<!---->
<!-- EDITAR CINE -->
    <div class="modal fade bd-example-modal-lg" id="editar-modal">
        <div class="modal-dialog modal-dialog modal-lg">
            <div class="modal-content">
                <!--header-->
                <div class="modal-header color-info">
                    <h4 class="modal-title">Editar</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!--body-->
                <div class="modal-body">
                  <?php include(FORMS_PATH ."/cinema-edit-form.php") ?>
                </div>
                <div class="modal-footer">
                    <!--<button class="btn btn-danger" type="button" data-dismiss="modal">Cerrar</button>-->
                </div>
            </div>
        </div>
    </div>
<!---->
<!-- EDITAR CINE ERROR--> <!--intente hacer un error para cuando haces una modificacion erronea - ignacio chiaradia 8/11 -->
    <div class="modal fade" id="editar-modal">
        <div class="modal-dialog">
          <div class = "modal-content">
              <div class = "modal-header">
                      <h4 class = "modal-title">Cine existente</h4>
              </div>
              <div class = "modal-body">
                      <p>El cine que esta intentando modificar ya existe.</p>
              </div>
              <div class = "modal-footer">
                    <!--<button class="btn btn-danger" type="button" data-dismiss="modal">Cerrar</button>-->
                </div>
            </div>
        </div>
    </div>
<!---->
<!-- AGREGAR CINE -->
<div class="modal fade bd-example-modal-lg" id="newCinema">
        <div class="modal-dialog  modal-dialog modal-lg">
            <div class="modal-content">
                <!--header-->
                <div class="modal-header">
                    <h4 class="modal-title">Cine nuevo</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!--body-->
                <div class="modal-body">
                  <?php include(FORMS_PATH.'/cinema-add-form.php'); ?>
                </div>
                <div class="modal-footer">
                    <!--<button class="btn btn-danger" type="button" data-dismiss="modal">Cerrar</button>-->
                </div>
            </div>
        </div>
    </div>
<!--EDITAR SALON-->
<div class="modal fade bd-example-modal-lg" id="editar-salon-modal">
        <div class="modal-dialog modal-dialog modal-lg">
            <div class="modal-content">
                <!--header-->
                <div class="modal-header color-info">
                    <h4 class="modal-title">Editar</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!--body-->
                <div class="modal-body">
                  <?php include(FORMS_PATH ."/saloon-edit-form.php") ?>
                </div>
                <div class="modal-footer">
                    <!--<button class="btn btn-danger" type="button" data-dismiss="modal">Cerrar</button>-->
                </div>
            </div>
        </div>
    </div>
<!--AGREGAR SALON-->
<div class="modal fade bd-example-modal-lg" id="agregar-salon-modal">
        <div class="modal-dialog modal-dialog modal-lg">
            <div class="modal-content">
                <!--header-->
                <div class="modal-header color-info">
                    <h4 class="modal-title">Agregar</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!--body-->
                <div class="modal-body">
                  <?php include(FORMS_PATH ."/saloon-add-form.php") ?>
                </div>
                <div class="modal-footer">
                    <!--<button class="btn btn-danger" type="button" data-dismiss="modal">Cerrar</button>-->
                </div>
            </div>
        </div>
    </div>