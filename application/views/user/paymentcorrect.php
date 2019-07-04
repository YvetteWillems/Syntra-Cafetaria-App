
<div class="container" onload="getGif()">
    <div class="row">
        <div class="col-sm-12">
            <div class="row justify-content-center">
                <div class="payment-gif col-sm-7" id="gif_frame">
                    <!-- <div style="width:100%;height:0;padding-bottom:56%;position:relative;" id="gif_frame">
                        <iframe src="https://giphy.com/embed/l4FGlJXuJconhSLIs" width="100%" height="100%" style="position:absolute" frameBorder="0" class="giphy-embed" allowFullScreen></iframe>
                    </div> -->
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="payment-gif col-sm-5">
                    <h1>Je betaling is gelukt!</h1>
                    <p class="my-4">Je broodjes worden klaargemaakt.<br>Vanaf 1 uur smiddags kun je de broodjes ophalen.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.onload = function(){getGif()}; 

    function getGif(){
        var gifsArray = [
            '<div style="width:100%;height:0;padding-bottom:56%;position:relative;"><iframe src="https://giphy.com/embed/l4FGlJXuJconhSLIs" width="100%" height="100%" style="position:absolute" frameBorder="0" class="giphy-embed" allowFullScreen></iframe></div>', 
            '<div style="width:100%;height:0;padding-bottom:100%;position:relative;"><iframe src="https://giphy.com/embed/5xaOcLNPpDS4E6QIv5K" width="100%" height="100%" style="position:absolute" frameBorder="0" class="giphy-embed" allowFullScreen></iframe></div>', 
            '<div style="width:100%;height:0;padding-bottom:48%;position:relative;"><iframe src="https://giphy.com/embed/hhzPU7pZksqgU" width="100%" height="100%" style="position:absolute" frameBorder="0" class="giphy-embed" allowFullScreen></iframe></div>', 
            '<div style="width:100%;height:0;padding-bottom:56%;position:relative;"><iframe src="https://giphy.com/embed/l0Iy3Fswao3qYKWCk" width="100%" height="100%" style="position:absolute" frameBorder="0" class="giphy-embed" allowFullScreen></iframe></div>', 
            '<div style="width:100%;height:0;padding-bottom:67%;position:relative;"><iframe src="https://giphy.com/embed/dEg9i6nTmjXyM" width="100%" height="100%" style="position:absolute" frameBorder="0" class="giphy-embed" allowFullScreen></iframe></div>', 
            '<div style="width:100%;height:0;padding-bottom:90%;position:relative;"><iframe src="https://giphy.com/embed/35vMe1XwJmdyM" width="100%" height="100%" style="position:absolute" frameBorder="0" class="giphy-embed" allowFullScreen></iframe></div>',  
            '<div style="width:100%;height:0;padding-bottom:66%;position:relative;"><iframe src="https://giphy.com/embed/13aIDSExOPcf84" width="100%" height="100%" style="position:absolute" frameBorder="0" class="giphy-embed" allowFullScreen></iframe></div>', 
            '<div style="width:100%;height:0;padding-bottom:61%;position:relative;"><iframe src="https://giphy.com/embed/V2XKHmzFTXBWE" width="100%" height="100%" style="position:absolute" frameBorder="0" class="giphy-embed" allowFullScreen></iframe></div>'
        ]; 

        var rand = Math.floor(Math.random() * 8);
        document.getElementById("gif_frame").innerHTML = gifsArray[rand]; 
 
        return gifsArray[rand];
    }

    console.log(getGif()); 


</script>