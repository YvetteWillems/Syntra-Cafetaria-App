<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Orders <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">User Id <?php echo form_error('user_id') ?></label>
            <input type="text" class="form-control" name="user_id" id="user_id" placeholder="User Id" value="<?php echo $user_id; ?>" />
        </div>
	    <div class="form-group">
            <label for="datetime">OrdTimestamp <?php echo form_error('ordTimestamp') ?></label>
            <input type="text" class="form-control" name="ordTimestamp" id="ordTimestamp" placeholder="OrdTimestamp" value="<?php echo $ordTimestamp; ?>" />
        </div>
	    <div class="form-group">
            <label for="date">OrdDateDelivery <?php echo form_error('ordDateDelivery') ?></label>
            <input type="text" class="form-control" name="ordDateDelivery" id="ordDateDelivery" placeholder="OrdDateDelivery" value="<?php echo $ordDateDelivery; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Status Id <?php echo form_error('status_id') ?></label>
            <input type="text" class="form-control" name="status_id" id="status_id" placeholder="Status Id" value="<?php echo $status_id; ?>" />
        </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('orders') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>