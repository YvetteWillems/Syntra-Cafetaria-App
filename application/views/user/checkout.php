<?php
    $_SESSION['totalPrice'] = $this->cart->format_number($this->cart->total());
?>

<div class="container">
<div class="cart-background container">
        <?php echo form_open('checkout/mollie'); ?>

        <div class="checkout-message">
            <p><?php 
                $message = $this->session->flashdata('message');
                echo $message; 
            ?></p>
        </div>

        <?php $i = 1; ?>
        <?php foreach ($this->cart->contents() as $items): ?>
                <?php echo form_hidden($i.'[rowid]', $items['rowid']); ?>

                <?php echo form_hidden('bread_id', $items['bread_id']); ?>
                <?php echo form_hidden('topping_id', $items['topping_id']); ?>

                <div class="container">
                    <div class="checkout-item col-sm-12">
                        <div class="row">
                            <div class="col-sm-12">
                                <h1><?php echo $items['name']; ?></h1>
                                <h1 class="mb-4">&euro;<?php echo $this->cart->format_number($items['price']); ?></h1>
                            </div>

                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-sm-9">
                                        <div class="checkout-options">
                                            <?php if ($this->cart->has_options($items['rowid']) == TRUE): ?>
                                                <p>
                                                    <?php foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value): ?>
                                                        <strong><?php echo $option_name; ?>:</strong> 
                                                            <?php if($option_value != NULL){
                                                                    foreach ($option_value as $option){
                                                                    echo $option;

                                                                    if(count($option_value) > 1){
                                                                        echo ", "; 
                                                                    }
                                                                }
                                                            } ?>
                                                        <br>
                                                    <?php endforeach; ?>
                                                </p>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="checkout-prices">
                                            <p>
                                                <strong>aantal:</strong> <?php echo $items['qty']; ?><br>
                                                <strong>subtotaal:</strong> &euro;<?php echo $this->cart->format_number($items['subtotal']); ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>                          
                            
                        </div>
                    </div>
                </div>
        <?php $i++; ?>
        <?php endforeach; ?>

        <div class="col-sm-12"><div class="row"><div class="col-sm-8"></div><div class="col-sm-4">
        <div class="total-right">
            <p>Totaal: &euro;<?php echo $this->cart->format_number($this->cart->total()); ?></p>
        </div>
        </div></div></div>

        <div class="checkout-date">
            <h5>Voor wanneer wil je de broodjes bestellen?</h5>
            <p>Let op: broodjes moeten voor 11 uur besteld worden!<br>
               Na 11 uur kunnen geen bestellingen meer worden geplaatst.</p>
            <div>
                <input name="ordDateDelivery" class="form-control" type="date" value="<?php echo date("h:i:sa"); ?>">
            </div>
        </div>
    

        <p><?php echo form_submit('submit', 'Betalen', "class = 'checkout-btn'"); ?></p>
        
        <div><p class="text-white">.</p></div>
</div>
</div>
