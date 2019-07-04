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
        <h2 style="margin-top:0px">Orders_sandwiches List</h2>
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('orders_sandwiches/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('orders_sandwiches/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('orders_sandwiches'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form>
            </div>
        </div>
        <table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Order Id</th>
		<th>OrsAmount</th>
		<th>Bread Id</th>
		<th>Topping Id</th>
		<th>Action</th>
            </tr><?php
            foreach ($orders_sandwiches_data as $orders_sandwiches)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $orders_sandwiches->order_id ?></td>
			<td><?php echo $orders_sandwiches->orsAmount ?></td>
			<td><?php echo $orders_sandwiches->bread_id ?></td>
			<td><?php echo $orders_sandwiches->topping_id ?></td>
			<td style="text-align:center" width="200px">
				<?php 
				echo anchor(site_url('orders_sandwiches/read/'.$orders_sandwiches->id),'Read'); 
				echo ' | '; 
				echo anchor(site_url('orders_sandwiches/update/'.$orders_sandwiches->id),'Update'); 
				echo ' | '; 
				echo anchor(site_url('orders_sandwiches/delete/'.$orders_sandwiches->id),'Delete','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
				?>
			</td>
		</tr>
                <?php
            }
            ?>
        </table>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
    </body>
</html>