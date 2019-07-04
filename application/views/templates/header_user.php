<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url(); ?>/assets/css/style.css"> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
    <title>Syntra Catering</title>
</head>
<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-1">
                <a href="<?php echo base_url(); ?>bestel/index">
                    <img class="logo" src="https://t2-campus.be/wp-content/uploads/2018/01/T2-campus_logo_wit.svg">
                </a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="favorites" class="col-xs-2">
            <a href="<?php echo base_url(); ?>bestel/favourite">
                <div class="cirkel-white">
                    <div class="favorite-heart">
                        <i class="fas fa-heart fa-2x"></i>
                    </div>
                </div>
            </a>
        </div>
    </div>            
    <!-- <div class="container-fluid">
        <div class="users" class="col-xs-2">
            <a href="<?php echo base_url(); ?>user/userDetails">
                <div class="cirkel">
                    <div class="user-man">
                        <i class="fas fa-user fa-2x"></i>
                    </div>
                </div>
            </a>
        </div>
    </div> -->

<!-- DROPDOWN MENU GEBRUIKER -->

    <div class="container-fluid">
        <div class="users col-xs-4">
                <div class="btn-group">
                <button type="button" class="cirkel" style="border:none;" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="user-man">
                        <i class="fas fa-user fa-2x"></i>
                    </div>
                </button>
                <div class="dropdown-menu dropdown-menu-right user-dropdown">
                    <div class="user-dropdown">
                        <a class="dropdown-item" href="<?php echo base_url(); ?>user/history">Bestellingen</a>
                        <a class="dropdown-item" href="<?php echo base_url(); ?>user/information">Persoonlijke gegevens</a>
                        <a class="dropdown-item" href="<?php echo base_url(); ?>user/contact">Contact</a>
                        <div class="dropdown-divider"></div>
                         <?php if ($this->session->userdata('user')['admin'] == 1) {
                            ?> <a class="dropdown-item" href="<?php echo base_url().'orders_sandwiches/adminOrdersSandwiches';?>">Besteloverzicht</a>        
                         <?php } ?>
                        <a class="dropdown-item" href="<?php echo base_url(); ?>login/logout_user">Uitloggen</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<!-- REST VAN MENU -->
       
    <div class="container-fluid">
        <div class="orders-plus" class="col-xs-2">
            <a href="<?php echo base_url(); ?>bestel/index">
                <div class="cirkel">
                    <div class="order-plus">
                        <i class="fas fa-plus fa-2x"></i>
                    </div>
                </div>
            </a>
        </div>
    </div>

    <div class="container-fluid">
        <div class="shopping-carts" class="col-xs-2">
            <a href="<?php echo base_url(); ?>bestel/cart">
                <div class="cirkel">
                    <div class="shopping-cart">
                        <i class="fas fa-shopping-basket"></i>
                    </div>
                </div>
            </a>
        </div>
    </div>
    <?php
        if($this->cart->total_items() > 0){
    ?>
            <div class="container-fluid">
                <div class="count" class="col-xs-2">
                    <div class="cirkel-red">
                        <p><?php echo $this->cart->total_items(); ?></p> 
                    </div>
                </div>
            </div>
    <?php } else { 
        // Do not display cirkel
          } ?>