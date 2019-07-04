<div class="container menu-container">
    <h1 class="menu-title"><?php echo $title; ?></h1>
    <div class="register-underline"></div>
    <div class="login-message">
    <?php echo validation_errors('<p class="alert alert-danger alert-dismissable" style="margin-top: 40px;">'); ?>
    </div>

    <form action="<?php echo $action;?>" method="post">
        <div class="form-group">
            <input type="text"  class="menu-input reg-input" name="firstname" placeholder="First Name">
        </div>
        <div class="form-group">
            <input type="text"  class="menu-input reg-input" name="lastname" placeholder="Last Name">
        </div>
        <div class="form-group">
            <input type="text"  class="menu-input reg-input" name="phonenumber" placeholder="Phone Number">
        </div>
        <div class="form-group">
            <input type="text"  class="menu-input reg-input" name="email" placeholder="E-mail">
        </div>
        <div class="form-group">
            <input type="password" class="menu-input reg-input" name="password" placeholder="Password">
        </div>
        <div class="form-group">
            <input type="password" class="menu-input reg-input" name="confirmpassword" placeholder="Confirm Password">
        </div>    

        <div class="form-group">
            <label class="reg-label">Organisation:</label>        
            <select name="organisation" id="org" class="menu-input reg-org">
                <option value="" selected disabled hidden>Choose here</option>
                <?php foreach ($organisations as $org) { ?>
                    <option value="<?php echo $org->orgName;?>"><?php echo $org->orgName;?></option>
                <?php } ?>
            </select>
        </div>
        <div class="form-group">
            <label class="reg-label">Occupation:</label>
            <select name="occupation" class="menu-input reg-org">
                <option value="" selected disabled hidden>Choose here</option>
                <?php foreach ($Syntra as $occu) { ?>
                    <option value="<?php echo $occu->id;?>"><?php echo $occu->occName;?></option>
                <?php } ?>
            </select>
        </div>
        
        <input type="submit" value="Register" class="login-btn reg-reg">
    <form>

    <a href="<?= base_url(); ?>index.php/login">
        <input type="button" class="login-btn reg-terug" value="Terug">
    </a>
</div>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
    </body>
</html>