<?php
    foreach($this->cart->contents() as $getBreadId){
        $rowid = $getBreadId['rowid']; 
        $bread_id = $getBreadId['bread_id']; 
        $rowIdBread[$rowid] = $bread_id; 
    }
    foreach($this->cart->contents() as $getToppingId){
        $rowid = $getToppingId['rowid']; 
        $topping_id = $getToppingId['topping_id']; 
        $rowIdTopping[$rowid] = $topping_id; 
    }
?>

<?php
        $user_id = $this->session->userdata('user')['user_id'];
?>

<div class="container">
<div class="cart-background container">
        <?php echo form_open('#', 'id="cartForm"'); ?>

        <div class="checkout-message">
            <p><?php 
                $message = $this->session->flashdata('message');
                echo $message; 
            ?></p>
        </div>


        <?php $i = 1;?>
        <?php foreach ($this->cart->contents() as $items): ?>
                <?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>

                <div class="container">
                        <div class="cart-item col-sm-12">
                                <div class="row">
                                        <div class="cart-topright">
                                                <a href="<?php echo base_url('bestel/removeItem/'.$items["rowid"]); ?>" class="cart-delete" onclick="return confirm('Je wil dit broodje verwijderen. Weet je het zeker?')">
                                                        <div class="cart-delete">
                                                                <i class="fas fa-times"></i>
                                                        </div>
                                                </a>
                                        </div>


                                        <div class="col-sm-9">
                                                <h1><?php echo $items['name']; ?></h1>
                                                <h1 class="mb-4">&euro;<?php echo $this->cart->format_number($items['price']); ?></h1>

                                                <?php if ($this->cart->has_options($items['rowid']) == TRUE): ?>
                                                        <p>
                                                                <?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): ?>
                                                                        <strong><?php echo $option_name; ?>:</strong> 
                                                                                <?php   if($option_value != NULL){
                                                                                                foreach ($option_value as $option){
                                                                                                echo $option;

                                                                                                if(count($option_value) > 1){
                                                                                                        echo ", "; 
                                                                                                }
                                                                                        }
                                                                                } ?>
                                                                        <br>
                                                                <?php endforeach; ?>
                                                                <p>subtotaal: &euro;
                                                                <?php echo $this->cart->format_number($items['subtotal']);?></p>
                                                        </p>
                                                <?php endif; ?>
                                        </div>

                                        <div class="col-sm-3">
                                                <div class="cart-bottomright">
                                                        <input type="number" class="cart-qty" name="amount" id="amount<?php echo $items['rowid'];?>" value="<?php echo $items['qty']; ?>" onchange="updateQuantity('<?php echo $items['rowid'];?>', '<?php echo $this->cart->format_number($items['subtotal']); ?>')">

                                                        <div class="cart-fav">
                                                                <?php if($items['bread_id'] === $favourite_bread && $items['topping_id'] === $favourite_topping){ ?>
                                                                        <i id="<?php echo $items['rowid']; ?>" class="fas fa-heart" onclick="setFavourite('<?php echo $items['rowid'];?>')"></i>
                                                                <?php } else { ?>
                                                                        <i id="<?php echo $items['rowid']; ?>" class="far fa-heart" onclick="setFavourite('<?php echo $items['rowid'];?>')"></i>
                                                                <?php } ?>
                                                        </div>
                                                </div>
                                        </div>
                                </div>
                        </div>
                </div>

        <?php $i++; ?>
        <?php endforeach; ?>

                <div class="cart-total total-left">
                        <p>Totaal: &euro;<?php echo $this->cart->format_number($this->cart->total()); ?></p>
                </div>

                <a href="<?php echo base_url(); ?>checkout/index">
                        <input type="button" class="cart-btn" value="Afrekenen">
                </a>

</div>
</div>

<script>
/* Update item quantity */
function updateQuantity(rowid, subtotal){
        var selectedQuantity = document.getElementById('amount'+rowid).value;

        $.get("<?php echo base_url('bestel/updateItemQty/'); ?>", {rowid:rowid, qty:selectedQuantity}, function(resp){
		if(resp == 'ok'){
			location.reload();
		}else{
			alert('Cart update failed, please try again.');
		}
	});
        return total;
}

/* Mark sandwich as (not) favourite */
function setFavourite(rowid){
        // var rowid = "b2cc42f6414c92abaa69c56b342e686d"; 
        var rowIdBread = <?php echo json_encode($rowIdBread); ?>;
        var rowIdTopping = <?php echo json_encode($rowIdTopping); ?>;

        var icon = document.getElementById(rowid).className;
        var set = icon.includes("fas fa-heart");

        // if(set){
        //         document.getElementById(rowid).className = "far fa-heart";
        // } else {
        //         document.getElementById(rowid).className = "fas fa-heart";
        // } 

        if(set){
                document.getElementById(rowid).className = "far fa-heart"; 
                // Delete $favourite_bread and $favourite_topping:
                $.get("<?php echo base_url('bestel/deleteFavourite');?>", function(resp){
                        //location.reload();
                        console.log(resp);

                        if(resp == 'ok'){
                                location.reload();
                        }else{
                                // location.reload();
                                alert('Kan favoriet niet verwijderen. Probeer overnieuw.');
                        }
	        });
        } else {
                document.getElementById(rowid).className = "fas fa-heart";
                // Set $favourite_bread and $favourite_topping:
                var bread_id = rowIdBread[rowid];
                var topping_id = rowIdTopping[rowid]; 

                $.get("<?php echo base_url('bestel/updateFavourite');?>", {bread_id:bread_id, topping_id:topping_id}, function(resp){
                        // location.reload();
                        console.log(resp); 
                        
                        if(resp == 'ok'){
                                location.reload();
                        }else{
                                // location.reload();
                                alert('Kan favoriet niet toevoegen. Probeer overnieuw.');
                        }
	        });
        }
}
// console.log(setFavourite()); 
</script>