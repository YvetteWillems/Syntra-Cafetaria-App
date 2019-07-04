<?php
    foreach($breads as $bread){
        $id = $bread['id']; 
        $price = $bread['brdPrice']; 
        $breadPrices[$id] = $price; 
    }
    foreach($toppings as $topping){
        $id = $topping['id']; 
        $price = $topping['topPrice']; 
        $toppingPrices[$id] = $price; 
    }
    foreach($extras as $extra){
        $id = $extra['id']; 
        $price = $extra['xtrPrice']; 
        $extraPrices[$id] = $price; 
    }
?>

<div class="container menu-container">
    <div class="row">
        <div class="col-sm-12">
            <h1 class="menu-title">Mijn bestelling</h1>
            <div class="menu-price">
                <p id="totalPrice"></p>        
            </div>
        </div>
    </div>

    <?php echo validation_errors(); ?>

    <?php echo form_open('bestel/index', 'id = "bestelForm"'); ?>
        <div class="form-group">
            <select id="bread" name="bread" class="menu-input" onchange="calculateTotal()">
                <option selected disabled>Welk broodje wil je?</option>
                <?php foreach($breads as $bread) : ?>
                <option value="<?php echo $bread['id']; ?>"><?php echo $bread['brdName'] . " - &euro;" . $bread['brdPrice']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="form-group">
            <select id="topping" name="topping" class="menu-input" onchange="calculateTotal()">
                <option selected disabled>En welke topping?</option>
                <?php foreach($toppings as $topping) : ?>
                <option value="<?php echo $topping['id']; ?>"><?php echo $topping['topName'] . " (" . $topping['topDescription'] . ") - &euro;" . $topping['topPrice']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="form-group">
            <label>Extra's:</label>
            <div>
                <?php foreach($extras as $extra) : ?>
                    <label class="menu-check"><?php echo '. '.$extra['xtrName'] . " - &euro;" . $extra['xtrPrice'] .'<br>'; ?>
                        <input id="extra<?php echo $extra['id'];?>" name="extra<?php echo $extra['id']; ?>" type="checkbox" value="<?php echo $extra['id']; ?>" onchange="calculateTotal(<?php echo $extra['id']; ?>)">
                        <span class="checkmark"></span>
                    </label>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="form-group">
            <label>Opmerking:</label>
            <textarea name="note" class="menu-input-text" rows="3"></textarea>
        </div>
        
        <div class="form-group">
            <label class="float-left">Aantal:</label>
            <select id="amount" name="amount" class="menu-amount" onchange="calculateTotal()">
                <?php   for ($i = 1; $i <= 8; $i++) { ?>
                    <option value='<?php echo $i; ?>'><?php echo $i; ?></option>
                <?php   }   ?>
            </select>
        </div>

        <button name="submit" type="submit" class="menu-submit">Plaats in Broodmandje</button>
    </form>
</div>


<script>

    var price = 0;
    function calculateTotal(extraId){
        var bestelForm = document.forms["bestelForm"]; 

        var breadPrices = <?php echo json_encode($breadPrices); ?>;
        var toppingPrices = <?php echo json_encode($toppingPrices); ?>;
        var extraPrices = <?php echo json_encode($extraPrices); ?>;

        function getBreadPrice(){
            var bestelForm = document.forms["bestelForm"]; 
            var selectedBread = bestelForm.elements["bread"]; 

            breadPrice = parseFloat(breadPrices[selectedBread.value]); 
            
            if (!breadPrice) {
                breadPrice = 0;
            }
            return breadPrice;
        }

        console.log(getBreadPrice());

        function getToppingPrice(){
            var bestelForm = document.forms["bestelForm"]; 
            var selectedTopping = bestelForm.elements["topping"];        

            toppingPrice = parseFloat(toppingPrices[selectedTopping.value]); 

            if (!toppingPrice) {
                toppingPrice = 0;
            }
            return toppingPrice;
        }

        console.log(getToppingPrice());

        function getExtraPrice() {
            var bestelForm = document.forms["bestelForm"]; 
            var selectedExtra = bestelForm.elements["extra"+extraId];

            if (selectedExtra) {
                if (selectedExtra.checked) {
                    var extraPrice = parseFloat(extraPrices[selectedExtra.value]);
            
                    price = price + extraPrice;

                    if (!price) price = 0;
                    if (!extraPrice) {
                        extraPrice = 0;
                    }            
                } else {
                    var extraPrice = parseFloat(extraPrices[selectedExtra.value]);
                    
                    price = price - extraPrice;
                    
                    if (!price) price = 0;
                    if (!extraPrice) {
                        extraPrice = 0;
                    }            

                    selectedExtra.checked = false;                
                    return price;
                }
            }
            return price;
        } 

        //console.log(getExtraPrice());

        function getQuantity(){
            var bestelForm = document.forms["bestelForm"]; 
            var selectedQuantity = bestelForm.elements["amount"].value; 
            
            return selectedQuantity; 
        }
        //console.log(getQuantity()); 

        function getTotal(){
            var sandwichPrice = getQuantity() * (getBreadPrice() + getToppingPrice() + getExtraPrice());
 
            //display the result
            document.getElementById('totalPrice').innerHTML = "Totale Prijs: &euro;"+sandwichPrice;
            return sandwichPrice;
        }
        console.log('Total price: ' + getTotal()); 
    }

    // function getExtraPrice(){
    //     var extraPrice = 0; 
    //     var bestelForm = document.forms["bestelForm"]; 
    //     var extra = bestelForm.elements["extra"]; 

    //     for(var i = 0; i < extra.Length; i++){
    //         if(extra[i].checked){
    //             extraPrice = extraPrices[extra[i].value]; 
    //             break;
    //         }
    //     }
    //     return extraPrice;
    // }
</script>