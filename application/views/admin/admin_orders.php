    <body>
        <div class="container-fluid">
            <div class="cart-background">
                <?PHP echo validation_errors();
                list($yearDelivery,$monthDelivery,$dayDelivery) = explode ('-',$dateDelivery);
                echo form_open('Orders_sandwiches/Adminorderssandwiches/'); ?>
                <form action="<?PHP echo site_url('Orders_sandwiches/Adminorderssandwiches/')?>" method="POST">
                    <div class="row">
                        <div class="col-md-3">
                            <label>&nbspWijzig besteldatum:&nbsp</label>
                        </div>
                        <div class="col-md-3">
                            <input class="admin-today-select" type="date" name="datedelivery" value="<?PHP echo $dateDelivery ?>">
                        </div>
                        <div class="col-md-2">
                            <label>Selecteer orders:&nbsp</label>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                     <input class="admin-today-select" type="text" name="zoeknaam" placeholder="Zoek op naam" value="<?PHP echo $searchName ?>">
                                 </div>
                            <br>
                            <div class="form-group">
                                     <input class="admin-today-select" type="email" name="zoekmail" placeholder="Zoek op email" value="<?PHP echo $searchMail ?>">
                                 </div>
                        </div>
                    </div>
                    <input type="submit" value="Bekijken" class="btn-left sm-admbtn-white"></td>
                </form>
            </div>
        </div>

        <div class="container-fluid">
            <div class="admin-title">
                <h2 style="margin-top:0px">Bestellingen voor <?php echo $dateDelivery ?></h2>
            </div>
        </div>

        <?PHP
        if(empty($adminbestellingen_data)){
            ?>

            <div class="alert alert-info" role="alert">
                Geen bestellingen gevonden
            </div>
            <?php
        }
        //    print_r($adminbestellingen_data);
        //    echo "<br><br>";

        // initialisation for correct processing first order
        $keyOrders = -1;
        $keySandwiches = -1;
        foreach ($adminbestellingen_data as $adminbestelling) {
            // new orders_id: process next order row
            if ($keyOrders <> $adminbestelling->order_id){
                $keyOrders = $adminbestelling->order_id;
                // init for next rijSandwichKey
                $volgnrSandwiches = 0;
                $rijOrders[$keyOrders]['orders_id'] = $adminbestelling->order_id;
                $rijOrders[$keyOrders]['usrFirstName'] = $adminbestelling->usrFirstName;
                $rijOrders[$keyOrders]['usrLastName'] = $adminbestelling->usrLastName;
                $rijOrders[$keyOrders]['usrEmail'] = $adminbestelling->usrEmail;
                $rijOrders[$keyOrders]['usrPhone'] = $adminbestelling->usrPhone;
                $rijOrders[$keyOrders]['staDescription'] = $adminbestelling->staDescription;
                $rijOrders[$keyOrders]['ordDateDelivery'] = $adminbestelling->ordDateDelivery;
                $rijOrders[$keyOrders]['ordTimestamp'] = $adminbestelling->ordTimestamp;
                $rijOrders[$keyOrders]['totPriceOrder'] = 0;
                $rijOrders[$keyOrders]['totAmountSandwiches'] = 0;
                // initial overall sandwich name for order from first sandwich (mostly just 1)
                $rijOrders[$keyOrders]['ordNameSandwichOverall'] = $adminbestelling->brdName." ".$adminbestelling->topName;
            }

            // new orders_sandwiches_id (= juisteId): process next sandwich(_order) row
            if ($keySandwiches <> $adminbestelling->juisteId) {
                $keySandwiches = $adminbestelling->juisteId;
                // process next rijSandwichKey row
                $rijSandwichKeys[$keyOrders][$volgnrSandwiches]['volgnrSandwiches'] =  $volgnrSandwiches;
                $rijSandwichKeys[$keyOrders][$volgnrSandwiches]['orders_id'] =  $adminbestelling->order_id;
                $rijSandwichKeys[$keyOrders][$volgnrSandwiches]['juisteId'] = $adminbestelling->juisteId;
                $volgnrSandwiches = $volgnrSandwiches + 1;
                // init for next rijExtras
                $volgnrExtras = 0;
                $rijSandwiches[$keySandwiches]['juisteId'] = $adminbestelling->juisteId;
                $rijSandwiches[$keySandwiches]['orsAmount'] = $adminbestelling->orsAmount;
                $rijSandwiches[$keySandwiches]['brdName'] = $adminbestelling->brdName;
                $rijSandwiches[$keySandwiches]['brdPrice'] = $adminbestelling->brdPrice;
                $rijSandwiches[$keySandwiches]['topName'] = $adminbestelling->topName;
                $rijSandwiches[$keySandwiches]['topDescription'] = $adminbestelling->topDescription;
                $rijSandwiches[$keySandwiches]['topPrice'] = $adminbestelling->topPrice;
                $rijOrders[$keyOrders]['totAmountSandwiches'] = $rijOrders[$keyOrders]['totAmountSandwiches'] + $adminbestelling->orsAmount;
                $rijSandwiches[$keySandwiches]['totPriceSandwich'] = (($adminbestelling->orsAmount * $adminbestelling->brdPrice) + ($adminbestelling->orsAmount * $adminbestelling->topPrice));
                $rijOrders[$keyOrders]['totPriceOrder'] = (($rijOrders[$keyOrders]['totPriceOrder']) + ($adminbestelling->orsAmount * $adminbestelling->brdPrice) + ($adminbestelling->orsAmount * $adminbestelling->topPrice));
                // change overall sandwich name when more than 1 sandwich
                $ordNameSandwichNext = $adminbestelling->brdName." ".$adminbestelling->topName;
                if ($rijOrders[$keyOrders]['ordNameSandwichOverall'] <> $ordNameSandwichNext) {
                    $rijOrders[$keyOrders]['ordNameSandwichOverall'] = "Diverse soorten broodjes";
                }
            }
            // prepare fields addicted to every extra for constructing row in array rijExtras
            $orsAmount = $adminbestelling->orsAmount;
            if ($adminbestelling->xtrPrice <> "") {
                $xtrName = $adminbestelling->xtrName;
                $xtrPrice = $adminbestelling->xtrPrice;
            // but mostly there's no extra:
            } else {
                $xtrName = '';
                $xtrPrice = 0;
            }
            // construct row in array rijExtras
            $rijExtras[$keySandwiches][$volgnrExtras]['xtrId'] = $adminbestelling->xtrId;
            $rijExtras[$keySandwiches][$volgnrExtras]['xtrName'] = $xtrName;
            $rijExtras[$keySandwiches][$volgnrExtras]['xtrPrice'] = $xtrPrice;
            $volgnrExtras = $volgnrExtras + 1;
            // add Extra price to total of order and total of sanwich:
            $totExtras = $orsAmount * $xtrPrice;
            $rijSandwiches[$keySandwiches]['totPriceSandwich'] = $rijSandwiches[$keySandwiches]['totPriceSandwich'] + $totExtras;
            $rijOrders[$keyOrders]['totPriceOrder'] = $rijOrders[$keyOrders]['totPriceOrder'] + $totExtras;
        // END FOR EACH:
        } ?> 
        <div class="container-fluid">
            <?PHP
            $keyOrders = -1; // HEEL BELANGRIJK
            $i = 0;
            foreach ($adminbestellingen_data as $adminbestelling) {
                //print_r($arrayOrder);
                if ($keyOrders <> $adminbestelling->order_id) {
                    $keyOrders = $adminbestelling->order_id;
                    $i = $i + 1;
                    ?>
                    <div class="admin-order-heading">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-xs-3">
                                        <input type="button" class="btn-left sm-admbtn-white" id="idord-<?PHP echo $keyOrders ?>" class="button" onclick="hideOrderDetails(this)" value="Details">
                                    </div>
                                    <div class="col-xs-3">
                                        <?PHP
                                        $iPrint = $i;
                                        if ($i < 10){
                                            $iPrint = "0".$iPrint;
                                        }
                                        if ($i < 100){
                                            $iPrint = "0".$iPrint;
                                        }
                                        ?>
                                        <span><?PHP echo $iPrint ?></span>
                                    </div>
                                    <div class="col-xs-6">
                                        <span><?PHP echo $rijOrders[$keyOrders]['usrLastName']." ".$rijOrders[$keyOrders]['usrFirstName']; ?></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <span><?PHP echo $rijOrders[$keyOrders]['ordNameSandwichOverall']; ?></span>
                                    </div>
                                    <div class="col-xs-3">
                                        <span><?PHP echo $rijOrders[$keyOrders]['totAmountSandwiches']; ?></span>
                                    </div>
                                    <div class="col-xs-3">
                                        <span>&euro;<?PHP echo $rijOrders[$keyOrders]['totPriceOrder']; ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="order-subheading-<?PHP echo $keyOrders;?>" style="display:none;">
                        <div class="admin-order-subheading">
                            <div class="row">
                                <div class="col-md-3">
                                    <span><?PHP echo $rijOrders[$keyOrders]['usrEmail']; ?></span>
                                </div>
                                <div class="col-md-3">
                                    <span><?PHP echo $rijOrders[$keyOrders]['usrPhone']; ?></span>
                                </div>
                                <div class="col-md-3">
                                    <span><?PHP echo $rijOrders[$keyOrders]['staDescription']; ?></span>
                                </div>
                                <div class="col-md-3">
                                    <span><?PHP echo $rijOrders[$keyOrders]['ordTimestamp']; ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="order-details-<?PHP echo $keyOrders;?>" style="display:none;">
                        <?PHP
                        foreach ($rijSandwichKeys[$keyOrders] as $sandwich) {
                            $keySandwiches = $sandwich['juisteId']; ?>
                            <div class="admin-order-details1">
                                <div class="row">
                                    <div class="col-xs-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <span><?PHP echo $rijSandwiches[$keySandwiches]['brdName']." (&euro;".$rijSandwiches[$keySandwiches]['brdPrice'].")"; ?></span>
                                            </div>
                                            <div class="col-md-6">
                                                <span><?PHP echo $rijSandwiches[$keySandwiches]['topName']." (&euro;".$rijSandwiches[$keySandwiches]['topPrice'].")"; ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <span><?PHP echo $rijSandwiches[$keySandwiches]['orsAmount']; ?></span>
                                            </div>
                                            <div class="col-md-6">
                                                <?PHP 
                                                foreach ($rijExtras[$keySandwiches] as $extra) { ?>
                                                    <span><?PHP 
                                                        echo $extra['xtrName']." ";
                                                        if ($extra['xtrPrice'] == 0) {
                                                            echo "(-)";
                                                        } else {
                                                            echo " (&euro;".$extra['xtrPrice'].")";
                                                        } ?>
                                                    <br>
                                                    </span>
                                                <?PHP } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?PHP } ?>
                    </div>
                <?PHP }
            } ?> 
        </div>
    </body>
</html>
<script>
    function hideOrderDetails(x){
        var strVar = x.id;
        var resVar1 = "order-subheading-" + strVar.slice(6,);
        var resVar2 = "order-details-" + strVar.slice(6,);
        //console.log(resVar1);
        if (document.getElementById(resVar1).style.display != "none") {
            document.getElementById(resVar1).style.display = "none";
        } else {
            document.getElementById(resVar1).style.display = "block";
        }
        if (document.getElementById(resVar2).style.display != "none") {
            document.getElementById(resVar2).style.display = "none";
        } else {
            document.getElementById(resVar2).style.display = "block";
        }
    }
</script>
