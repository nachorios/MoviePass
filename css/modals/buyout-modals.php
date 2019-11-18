<?php 
    if (isset($buyComplete)) {
        if($buyComplete) {
        ?>
             <script>
                  $(function(){
                       $('#compra-exito').modal('show');
                  });
             </script>
        <?php
        } else {
        ?>
             <script>
                  $(function(){
                       $('#compra-error').modal('show');
                  });
             </script>
        <?php
        }
    }
?>

<div class = "modal fade" id = "compra-exito" role = "dialog">
     <div class = "modal-dialog modal-sm text-success">
          <div class = "modal-content">
               <div class = "modal-header">
                    <h4 class = "modal-title">¡Compra exitosa!</h4>
               </div>
               <div class = "modal-body">
                    <p>Tus entradas han sido compradas con exito.</p>
               </div>
               <div class = "modal-footer">
                    <button type = "button" class = "btn btn-success" data-dismiss = "modal">Aceptar</button>
               </div>
          </div>
     </div>
</div>

<div class = "modal fade" id = "compra-error" role = "dialog">
     <div class = "modal-dialog modal-sm text-danger">
          <div class = "modal-content">
               <div class = "modal-header">
                    <h4 class = "modal-title">Error</h4>
               </div>
               <div class = "modal-body">
                    <p>No se ha logrado registrar tu compra.</p>
               </div>
               <div class = "modal-footer">
                    <button type = "button" class = "btn btn-danger" data-dismiss = "modal">Aceptar</button>
               </div>
          </div>
     </div>
</div>