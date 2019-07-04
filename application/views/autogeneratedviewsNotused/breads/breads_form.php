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
        <h2 style="margin-top:0px">Breads <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">BrdName <?php echo form_error('brdName') ?></label>
            <input type="text" class="form-control" name="brdName" id="brdName" placeholder="BrdName" value="<?php echo $brdName; ?>" />
        </div>
	    <div class="form-group">
            <label for="float">BrdPrice <?php echo form_error('brdPrice') ?></label>
            <input type="text" class="form-control" name="brdPrice" id="brdPrice" placeholder="BrdPrice" value="<?php echo $brdPrice; ?>" />
        </div>
	    <div class="form-group">
            <label for="tinyint">BrdActive <?php echo form_error('brdActive') ?></label>
            <input type="text" class="form-control" name="brdActive" id="brdActive" placeholder="BrdActive" value="<?php echo $brdActive; ?>" />
        </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('breads') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>