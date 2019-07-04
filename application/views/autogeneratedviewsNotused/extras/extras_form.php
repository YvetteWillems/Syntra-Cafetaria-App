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
        <h2 style="margin-top:0px">Extras <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">XtrName <?php echo form_error('xtrName') ?></label>
            <input type="text" class="form-control" name="xtrName" id="xtrName" placeholder="XtrName" value="<?php echo $xtrName; ?>" />
        </div>
	    <div class="form-group">
            <label for="float">XtrPrice <?php echo form_error('xtrPrice') ?></label>
            <input type="text" class="form-control" name="xtrPrice" id="xtrPrice" placeholder="XtrPrice" value="<?php echo $xtrPrice; ?>" />
        </div>
	    <div class="form-group">
            <label for="tinyint">XtrActive <?php echo form_error('xtrActive') ?></label>
            <input type="text" class="form-control" name="xtrActive" id="xtrActive" placeholder="XtrActive" value="<?php echo $xtrActive; ?>" />
        </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('extras') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>