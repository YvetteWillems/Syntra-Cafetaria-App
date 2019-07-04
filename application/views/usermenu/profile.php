<?php ?>

<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h1 class="menu-title his-title">Informatie</h1>
            <div class="history-underline"></div>
        </div>
    </div>

    <div class="cart-background container">
        <div class="row his-table">
            <div class="col-sm-12">
                <div class="checkout-message"><strong>Als u uw e-mail update moet u opnieuw inloggen.</strong>
                    
                </div>
                    <?php if (isset($success)) { ?>
                        <div class="checkout-message" style="margin-top: 10px; width: 55%; text-align: center">
                            <?php echo $success; ?>
                        </div>    
                    <?php } ?>
                    <?php echo validation_errors('<p class="checkout-message" style="margin-top: 10px; color:red">'); ?>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-sm-8">
                <form action="<?php echo $action;?>" method="post" class="profile-form">
                    <div class="form-group">
                        <input type="hidden" value="<?php echo $user_details[0]['id'];?>" class="form-control" name="id">
                    </div>
                    <div class="form-group">
                        <label>Voornaam: </label>
                        <input type="text" value="<?php echo $user_details[0]['usrFirstName'];?>" class="menu-input profile-input" name="firstname">
                    </div>
                    <div class="form-group">
                        <label>Achternaam: </label>
                        <input type="text" value="<?php echo $user_details[0]['usrLastName'];?>" class="menu-input profile-input" name="lastname">
                    </div>
                    <div class="form-group">
                        <label>E-mail: </label>
                        <input type="hidden" value="<?php echo $user_details[0]['usrEmail'];?>" name="oldemail">
                        <input type="text" value="<?php echo $user_details[0]['usrEmail'];?>" class="menu-input profile-input" name="email">
                    </div>
                    <div class="form-group">
                        <label>Tel. nr: </label>
                        <input type="text" value="<?php echo $user_details[0]['usrPhone'];?>" class="menu-input profile-input" name="phone">
                    </div>
        
                    <?php if ($this->session->userdata('user')['admin'] == 1) { ?> 
                        <a href="<?php echo base_url().'/admin/send_bulk_mail';?>" class="btn btn-primary"><input type="button"  class="btn btn-primary">Send bulk mail</button></a>            
                    <?php } ?>
                    <a href="<?php echo base_url().'bestel';?>"><input type="button" value="Terug" class="sm-btn-green btn-right"></a>
                    <input type="submit" value="Update gegevens" class="big-btn-green btn-left">        
                </form>
            </div>
        </div>
    </div>
</div>

<?php ?>