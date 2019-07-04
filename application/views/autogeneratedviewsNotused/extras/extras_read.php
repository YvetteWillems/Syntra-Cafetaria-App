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
        <h2 style="margin-top:0px">Extras Read</h2>
        <table class="table">
	    <tr><td>XtrName</td><td><?php echo $xtrName; ?></td></tr>
	    <tr><td>XtrPrice</td><td><?php echo $xtrPrice; ?></td></tr>
	    <tr><td>XtrActive</td><td><?php echo $xtrActive; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('extras') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>