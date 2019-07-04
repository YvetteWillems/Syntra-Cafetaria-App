<div class="container menu-container">
    <h1 class="menu-title">Login</h1>
    <div class="login-underline"></div>
    <div class="login-message">
    <?php
    if($this->session->userdata('user')['logged_in'] == 1) {
        ?>
        <a href="<?= base_url().'bestel';?>"><div class="alert alert-success" style="width: 50%; margin-top: 10px;">Ingelogd, klik hier om te bestellen</div></a>
        <?php
    }
    echo validation_errors('<p class="alert alert-danger alert-dismissable" style="margin-top: 10px;">');
?>
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
    </div>
    <form action="<?php echo $action;?>" method="post">
        <div class="form-group">
            <label>E-mail</label>
            <input type="text" placeholder="E-mail" class="menu-input" name="email">
        </div>
        <div class="form-group">
            <label>Password</label>
            <input type="password" placeholder="Password" class="menu-input" name="password">
        </div>
        <input type="submit" value="Login" class="btn-left sm-btn-green">
    <form>

    <a href="<?php echo site_url('login/forgot_password_link');?>">
                <input type="button" class="btn-right big-btn-white " value="Wachtwoord vergeten?">
    </a>

    <a href="<?php echo site_url('register');?>">
                <input type="button" class="btn-right big-btn-white" value="Registreren">
    </a>

</div>