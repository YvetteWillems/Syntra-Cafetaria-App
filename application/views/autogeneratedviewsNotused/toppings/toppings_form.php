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
        <h2 style="margin-top:0px">Toppings <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">TopName <?php echo form_error('topName') ?></label>
            <input type="text" class="form-control" name="topName" id="topName" placeholder="TopName" value="<?php echo $topName; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">TopDesciption <?php echo form_error('topDesciption') ?></label>
            <input type="text" class="form-control" name="topDesciption" id="topDesciption" placeholder="TopDesciption" value="<?php echo $topDesciption; ?>" />
        </div>
	    <div class="form-group">
            <label for="float">TopPrice <?php echo form_error('topPrice') ?></label>
            <input type="text" class="form-control" name="topPrice" id="topPrice" placeholder="TopPrice" value="<?php echo $topPrice; ?>" />
        </div>
	    <div class="form-group">
            <label for="tinyint">TopActive <?php echo form_error('topActive') ?></label>
            <input type="text" class="form-control" name="topActive" id="topActive" placeholder="TopActive" value="<?php echo $topActive; ?>" />
        </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('toppings') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>