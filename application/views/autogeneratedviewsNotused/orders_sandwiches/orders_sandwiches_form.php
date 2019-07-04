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
        <h2 style="margin-top:0px">Orders_sandwiches <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="int">Order Id <?php echo form_error('order_id') ?></label>
            <input type="text" class="form-control" name="order_id" id="order_id" placeholder="Order Id" value="<?php echo $order_id; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">OrsAmount <?php echo form_error('orsAmount') ?></label>
            <input type="text" class="form-control" name="orsAmount" id="orsAmount" placeholder="OrsAmount" value="<?php echo $orsAmount; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Bread Id <?php echo form_error('bread_id') ?></label>
            <input type="text" class="form-control" name="bread_id" id="bread_id" placeholder="Bread Id" value="<?php echo $bread_id; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Topping Id <?php echo form_error('topping_id') ?></label>
            <input type="text" class="form-control" name="topping_id" id="topping_id" placeholder="Topping Id" value="<?php echo $topping_id; ?>" />
        </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('orders_sandwiches') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>