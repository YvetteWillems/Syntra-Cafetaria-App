<div class="container menu-container">
    <div class="row">
        <div class="col-sm-12">
            <h1 class="menu-title">Mijn favoriet</h1>
            <div class="fav-underline">
            </div>
        </div>
    </div>

<div class="container">
        <?php if($favourite_bread != NULL && $favourite_topping != NULL){
            echo form_open('bestel/index');
            echo form_hidden('bread', $favourite_bread_id);
            echo form_hidden('topping', $favourite_topping_id);
            echo form_hidden('amount', 1);
        } ?>
        <div class="fav-background col-sm-6">
            <div class="checkout-message">
                <p><?php 
                    $message = $this->session->flashdata('message');
                    echo $message; 
                ?></p>
            </div>
            <div class="row justify-content-center fav-title">
                <div class="col-sm-6">
                    <i class="fas fa-heart"></i>
                    <h1 class="p-2">
                        <?php 
                            if($favourite_bread != NULL && $favourite_topping != NULL){
                                echo $favourite_bread.' met '.$favourite_topping; 
                            } else {
                                echo "Geen favoriet!"; 
                            }
                        ?>
                    </h1>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-sm-8 fav-extras">
                    <hr>
                    <div class="form-group px-3">
                        <?php 
                            if($favourite_bread != NULL && $favourite_topping != NULL){ ?>
                                <label class="pt-2">Kies een extra:</label>
                            <div>
                                <?php foreach($extras as $extra) : ?>
                                    <label class="menu-check"><?php echo '. '.$extra['xtrName'] . " - &euro;" . $extra['xtrPrice'] .'<br>'; ?>
                                        <input id="extra<?php echo $extra['id'];?>" name="extra<?php echo $extra['id']; ?>" type="checkbox" value="<?php echo $extra['id']; ?>" onchange="calculateTotal(<?php echo $extra['id']; ?>)">
                                        <span class="checkmark fav-checkmark"></span>
                                    </label>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group px-3">
                            <label class="pt-2">Een opmerking?</label>
                            <textarea name="note" class="fav-text mb-4" rows="1"></textarea>
                        </div>
                        <button name="submit" type="submit" class="fav-submit">Plaats in Broodmandje</button>
                    </form>
                            <?php } else { ?>
                                <div class="form-group px-3"><p class="pt-2 text-center">Voeg een favoriet toe:</p></div>
                                <a href="<?php echo base_url(); ?>bestel/index"><button class="fav-submit">Bestellen</button></a>
                            <?php }
                        ?>
                        
                </div>
            </div>   
        </div>
</div>
</div>