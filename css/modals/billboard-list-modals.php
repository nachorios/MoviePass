
<!-- BORRAR CINE -->
<div class = "modal fade" id = "borrado-exito" role = "dialog">
        <div class = "modal-dialog modal-sm text-danger">
            <div class = "modal-content">
                <div class = "modal-header">
                        <h4 class = "modal-title">Pelicula de cartelera borrada</h4>
                </div>
                <div class = "modal-body">
                        <p>La cartelera se ha borrado con exito.</p>
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
                    <h4 class = "modal-title">Cartelera editada</h4>
               </div>
               <div class = "modal-body">
                    <p>La cartelera se ha editado con exito.</p>
               </div>
               <div class = "modal-footer">
                    <button type = "button" class = "btn btn-info" data-dismiss = "modal">Aceptar</button>
               </div>
          </div>
     </div>
</div>
<!---->
<!-- EDITAR CINE ERROR -->
<div class = "modal fade" id = "edicion-error" role = "dialog">
        <div class = "modal-dialog modal-sm text-danger">
            <div class = "modal-content">
                <div class = "modal-header">
                        <h4 class = "modal-title">Error al editar</h4>
                </div>
                <div class = "modal-body">
                        <p>No se ha logrado editar la cartelera, verifica si el cine ya posee la pelicula seleccionada.</p>
                </div>
                <div class = "modal-footer">
                        <button type = "button" class = "btn btn-danger" data-dismiss = "modal">Aceptar</button>
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
                        <h4 class = "modal-title">Pelicula de cartelera Agregada</h4>
                </div>
                <div class = "modal-body">
                        <p>La pelicula se ha agregado con exito a la cartelera.</p>
                </div>
                <div class = "modal-footer">
                        <button type = "button" class = "btn btn-success" data-dismiss = "modal">Aceptar</button>
                </div>
            </div>
        </div>
    </div>
<!---->
<!-- EDITAR CINE ERROR -->
<div class = "modal fade" id = "registro-error" role = "dialog">
        <div class = "modal-dialog modal-sm text-danger">
            <div class = "modal-content">
                <div class = "modal-header">
                        <h4 class = "modal-title">Error al agregar pelicula</h4>
                </div>
                <div class = "modal-body">
                        <p>Se puede agregar una sola vez la misma pelicula por cine.</p>
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
        <div class="modal-dialog modal-lg ">
            <div class="modal-content">
                <!--header-->
                <div class="modal-header color-info">
                    <h4 class="modal-title">Editar</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!--body-->
                <div class="modal-body">
                  <?php include(FORMS_PATH ."/billboard-edit-form.php") ?>
                </div>
            </div>
        </div>
    </div>
<!---->