<?php 
// print_r($statussen);
//             [id] => 85
//             [user_id] => 1
//             [ordTimestamp] => 2019-02-26 20:53:23
//             [ordDateDelivery] => 2019-02-28
//             [status_id] => 7
//             [usrLastName] => Yvette
//             [usrFirstName] => Willems
//             [usrPhone] => 124
//             [usrEmail] => test@test.com
//             [usrAdmin] => 0
//             [usrEmailConfirmed] => 1
//             [occupation_id] => 5
//             [usrPassword] => 51abb9636078defbf888d8457a7c76f85c8f114c
//             [usrTimestampRegistration] => 2019-02-14 11:38:44
//             [bread_id] => 2
//             [topping_id] => 2
//             [staDescription] => nog niet betaald
?>
<div class="container">
        <div class="fav-background col-sm-12">
            <div class="checkout-message">
            </div>
            <div class="row justify-content-center fav-title">
                <div class="col-sm-12">
                    <i class="fas fa-smile"></i>
                    <h1 class="p-2">
                        Overzicht: <?php echo date('Y/m/d'); ?>
                    </h1>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-sm-12 fav-extras">
                    <div class="form-group px-6">
                        <?php
                        foreach ($orders as $order) {
                            ?>
                            <table class="table">
                                <tbody class="admin-today-table">
                                    <tr>
                                        <td><p><i><?php echo $order['usrFirstName'].', '.$order['usrLastName'];?></i></p></td>
                                        <td><p><?php echo $order['staDescription'];?></p></td>
                                            <form action="<?php echo $action;?>" method="post">
                                                <td>
                                                    <input type="hidden" value="<?php echo $order['id']; ?>" name="orderId">
                                                    <label><strong>Pas status aan</strong></label><br>
                                                    <select class="admin-today-select" name="statusId">
                                                        <option value="" selected disabled hidden><?php echo $order['staDescription']; ?></option>
                                                            <?php foreach ($statussen as $sta) {
                                                                echo $order['status_id'];?>
                                                                <option value="<?php echo $sta['id'];?>" name="statusId"><?php echo $sta['staDescription'];?></option>
                                                            <?php } ?>                                              
                                                    </select>
                                                </td>
                                                <td><input type="submit" value="Update" class="btn btn-dark admin-today-btn"></td>
                                            </form>
                                    </tr>
                                </tbody>
                            </table>
                        <?php }
                        ?>
                    </div>
                        <hr>
                    </form>                       
                </div>
            </div>   
        </div>
</div>
