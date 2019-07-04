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
        <h2 style="margin-top:0px">Orders_sandwiches_extra <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">Orders Sandwich Id <?php echo form_error('orders_sandwich_id') ?></label>
            <input type="text" class="form-control" name="orders_sandwich_id" id="orders_sandwich_id" placeholder="Orders Sandwich Id" value="<?php echo $orders_sandwich_id; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Extra Id <?php echo form_error('extra_id') ?></label>
            <input type="text" class="form-control" name="extra_id" id="extra_id" placeholder="Extra Id" value="<?php echo $extra_id; ?>" />
        </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('orders_sandwiches_extra') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>