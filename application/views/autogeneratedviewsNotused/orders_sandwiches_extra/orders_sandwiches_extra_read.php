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
        <h2 style="margin-top:0px">Orders_sandwiches_extra Read</h2>
        <table class="table">
	    <tr><td>Orders Sandwich Id</td><td><?php echo $orders_sandwich_id; ?></td></tr>
	    <tr><td>Extra Id</td><td><?php echo $extra_id; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('orders_sandwiches_extra') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>