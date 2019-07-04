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
        <h2 style="margin-top:0px">Breads Read</h2>
        <table class="table">
	    <tr><td>BrdName</td><td><?php echo $brdName; ?></td></tr>
	    <tr><td>BrdPrice</td><td><?php echo $brdPrice; ?></td></tr>
	    <tr><td>BrdActive</td><td><?php echo $brdActive; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('breads') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>