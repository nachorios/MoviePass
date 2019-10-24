
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
    <div class="modal fade" id="mimodal">
        <div class="modal-dialog">
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
<!-- AGREGAR CINE -->
<div class="modal fade" id="newCinema">
        <div class="modal-dialog">
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