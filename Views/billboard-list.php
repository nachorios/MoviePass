
<div class="container">
    <?php
    if(isset($_SESSION['loggedUser'])) {
        if($_SESSION['loggedUser']->getRole()>1) {
            include(FORMS_PATH . 'billboard-add-form.php'); 
        }
    }
    ?>
</div>