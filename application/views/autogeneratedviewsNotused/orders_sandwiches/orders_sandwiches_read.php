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
        <h2 style="margin-top:0px">Orders_sandwiches Read</h2>
        <table class="table">
	    <tr><td>Order Id</td><td><?php echo $order_id; ?></td></tr>
	    <tr><td>OrsAmount</td><td><?php echo $orsAmount; ?></td></tr>
	    <tr><td>Bread Id</td><td><?php echo $bread_id; ?></td></tr>
	    <tr><td>Topping Id</td><td><?php echo $topping_id; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('orders_sandwiches') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>