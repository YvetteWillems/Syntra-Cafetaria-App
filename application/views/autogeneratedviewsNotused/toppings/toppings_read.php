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
        <h2 style="margin-top:0px">Toppings Read</h2>
        <table class="table">
	    <tr><td>TopName</td><td><?php echo $topName; ?></td></tr>
	    <tr><td>TopDesciption</td><td><?php echo $topDesciption; ?></td></tr>
	    <tr><td>TopPrice</td><td><?php echo $topPrice; ?></td></tr>
	    <tr><td>TopActive</td><td><?php echo $topActive; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('toppings') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>