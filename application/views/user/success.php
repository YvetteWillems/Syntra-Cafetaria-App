<?php
    $totalPrice = $_SESSION['totalPrice'];
    $_SESSION['orderId'] = $orderId;

?>

<div class="container">
    <div class="container cart-background">
        <div class="row justify-content-center">
            <div class="col-sm-12 success">
                <h1 class="py-5"><strong>Mollie</strong></h1>
                <p>Totaal bedrag: &euro;<?php echo $totalPrice; ?></p>
                <p>Je ordernummer is: #<?php echo $orderId; ?></p>
            </div>

        </div>
    </div>
</div>
