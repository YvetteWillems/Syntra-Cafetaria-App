<div class="container menu-container">
    <h1 class="menu-title">Wachtwoord herstellen</h1>
    <div class="login-underline"></div>
    <div class="alert alert-success"><strong>Vul een nieuw wachtwoord in.</strong></div>
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
    <?php if (isset($failed)) {
    ?>
    <div class="alert alert-danger alert-dismissible" style="margin-top: 10px; width: 55%;">
        <?php echo $failed; ?>
    </div>
    <?php
    } ?>
    <form action="<?php echo $action; ?>" method="post"> 
        <input type="hidden" value="<?php echo $email;?>" name="email">
        <div class="form-group">
            <label>Wachtwoord</label>
            <input type="password" placeholder="Wachtwoord" class="menu-input" name="password">
        </div>
        <div class="form-group">
            <label>Bevestig wachtwoord</label>
            <input type="password" placeholder="Bevestig wachtwoord" class="menu-input" name="confirmpassword">
        </div>

        <input type="submit" value="Wachtwoord herstellen" class="login-btn login-login">
    <form>

</div>