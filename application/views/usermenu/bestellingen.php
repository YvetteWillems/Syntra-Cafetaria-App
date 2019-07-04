<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h1 class="menu-title his-title">Bestellingen</h1>
            <div class="history-underline"></div>
        </div>
    </div>

    <div class="cart-background container">
        <div class="row his-table">
            <div class="col-sm-12">
                <hr>
                <div class="row">
                    <div class="his-30"><p><strong>Datum:</strong></p></div>
                    <div class="his-30"><p><strong>Totaal:</strong></p></div>
                    <div class="his-30"><p><strong>Status:</strong></p></div>
                </div>
                <hr>
    
                <!-- <div class="row">
                    <div class="his-30"><p><strong>2019-02-27</strong></p></div>
                    <div class="his-30"><p>&euro;13.50</p></div>
                    <div class="his-30"><p>Voorbeeld!!</p></div>
                </div>
                <hr> -->

                <?php 
                $keyOrders = -1; // HEEL BELANGRIJK
                $i = 0;
                foreach($orders as $order){ 

                if ($keyOrders <> $order['order_id']) {
                $keyOrders = $order['order_id'];
                $i = $i + 1; ?>
                    <!-- Order Information -->
                    <div id="idord-<?php echo $keyOrders;?>" class="row his-90" onclick="hideOrderDetails(this)">
                        <div class="his-30"><p><strong>
                            <?php echo $order['ordDateDelivery']; ?>
                        </strong></p></div>
                        <div class="his-30"><p>&euro;
                            <?php $order_price = $this->User_model->getOrderPrice($order['order_id']); 
                                echo $order_price; ?>
                        </p></div>
                        <div class="his-30"><p>
                            <?php echo $order['status_name']; ?>
                        </p></div>
                    </div>
                <hr>
                    <!-- Detailed Order Information -->
                    <div id="order-details-<?php echo $keyOrders;?>" style="display:none;" class="his-dropdown">
                        <div class="his-90">
                            <?php 
                                $order_sandwich = $this->User_model->getOrder($order['order_id']);
                                // Voor ieder broodje:
                                foreach($order_sandwich as $sandwich){ ?>
                                <div class="row his-90-drop">
                                    <div class="his-10"></div>
                                    <div class="his-10"><?php
                                        echo $sandwich['orsAmount']; ?>
                                    </div>
                                    <div class="his-40"><?php
                                        // Sandwich naam
                                        $bread = $this->User_model->getBreads($sandwich['bread_id']); 
                                        $topping = $this->User_model->getToppings($sandwich['topping_id']); 
                                        echo '<strong>'.$bread['brdName'].' met '.$topping['topName'].'</strong><br>'; 
                                        // Extra's
                                        echo 'Extra: ';
                                        $extras = $this->User_model->getSandwichExtras($sandwich['id']); 
                                        foreach($extras as $extra){
                                            $extra_name = $this->User_model->getExtras($extra['extra_id']); 
                                            echo $extra_name['xtrName']; 
                                            if(count($extras) > 1){
                                                echo ', '; 
                                            }
                                        }
                                        echo '<br>';
                                        // Prijs van sandwich
                                        $sandwich_price = $this->User_model->getSandwichPrice($sandwich['id']); 
                                        echo 'Prijs: &euro;'.$sandwich_price.'<br>'; ?>
                                    </div>
                                    <div class="his-20"><?php
                                        // Totale prijs
                                        $total_sandwich_price = ($sandwich['orsAmount'] * $sandwich_price); 
                                        echo 'Totaal: &euro;'.$total_sandwich_price; ?>
                                    </div>
                                    <hr>
                                </div>
                                <hr>
                                <?php } ?>
                                <!-- Einde dropdown met extra details -->
                        </div>
                    </div>

                <?php } ?>
                <?php } ?>

                <!-- De dropdown met extra details -->
                <!-- <div id="order-details-<?php echo $keyOrders;?>" style="display:none;" class="his-dropdown">
                    <?php foreach($orders as $order){ ?>
                        <div class="his-90">
                            <?php 
                                $order_sandwich = $this->User_model->getOrder($order['order_id']);
                                // Voor ieder broodje:
                                foreach($order_sandwich as $sandwich){ ?>
                                <div class="row his-90-drop">
                                    <div class="his-10"></div>
                                    <div class="his-10"><?php
                                        echo $sandwich['orsAmount']; ?>
                                    </div>
                                    <div class="his-40"><?php
                                        // Sandwich naam
                                        $bread = $this->User_model->getBreads($sandwich['bread_id']); 
                                        $topping = $this->User_model->getToppings($sandwich['topping_id']); 
                                        echo '<strong>'.$bread['brdName'].' met '.$topping['topName'].'</strong><br>'; 
                                        // Extra's
                                        echo 'Extra: ';
                                        $extras = $this->User_model->getSandwichExtras($sandwich['id']); 
                                        foreach($extras as $extra){
                                            $extra_name = $this->User_model->getExtras($extra['extra_id']); 
                                            echo $extra_name['xtrName']; 
                                            if(count($extras) > 1){
                                                echo ', '; 
                                            }
                                        }
                                        echo '<br>';
                                        // Prijs van sandwich
                                        $sandwich_price = $this->User_model->getSandwichPrice($sandwich['id']); 
                                        echo 'Prijs: &euro;'.$sandwich_price.'<br>'; ?>
                                    </div>
                                    <div class="his-20"><?php
                                        // Totale prijs
                                        $total_sandwich_price = ($sandwich['orsAmount'] * $sandwich_price); 
                                        echo 'Totaal: &euro;'.$total_sandwich_price; ?>
                                    </div>
                                    <hr>
                                </div>
                                <hr>
                                <?php } ?>
                                // Einde dropdown met extra details
                        </div>
                <?php } ?>
                </div> -->
                
            
        </div>
    </div>
    </div>
    </div>
    </div>
</div>
</div>

<script>
    function hideOrderDetails(x){
        var strVar = x.id;
        var resVar2 = "order-details-" + strVar.slice(6,);
        //console.log(resVar1);
        if (document.getElementById(resVar2).style.display != "none") {
            document.getElementById(resVar2).style.display = "none";
        } else {
            document.getElementById(resVar2).style.display = "block";
        }
    }
</script>