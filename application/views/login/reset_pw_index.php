<div class="container menu-container">
    <h1 class="menu-title">Wachtwoord herstellen</h1>
    <div class="login-underline"></div>
    <div class="alert alert-success"><strong>Vul uw gebruikte e-mail adres in om uw wachtwoord te resetten.</strong></div>
    <div class="login-message">
        <?php echo validation_errors('<p class="alert alert-danger alert-dismissable" style="margin-top: 10px;">'); ?>    
    </div>
    <?php if (isset($success)) {
    ?>
    <div class="alert alert-success alert-dismissible" style="margin-top: 10px; width: 55%;">
        <?php echo $success; ?>
    </div>
    <?php
    } ?>
    <form action="<?php echo $action; ?>" method="post"> 
        <div class="form-group">
            <label>E-mail</label>
            <input type="text" placeholder="E-mail" class="menu-input" name="veri_email">
        </div>

        <input type="submit" value="Versturen" class="login-btn login-login">
    <form>

</div>