<?php
session_start();


if(isset($_SESSION["numItems"]) and isset($_SESSION["add_items"])){
    echo "<script>let item_num = ".$_SESSION["numItems"]."</script>";

foreach($_SESSION["add_items"] as $ele){
    echo "<script>item_list.push(".$ele.")</script>";
}
}

?>


<font size = "4"> User ID: <?php echo $_SESSION["UserId"]?></font>
items:
Total cost($):
<button type="button" onclick="(()=>{document.querySelector('.items').innerHTML=''; document.querySelector('.notice-container').style.display='none';document.querySelector('header span').closest('p').click()})()">Ok</button>

    </div>
</div>
<main>
<div class="cart-container">
    <h1>Cart Information</h1>
<div class="cart">

</div>
<hr>
<div>
<p class="tcost"><span>Total cost: </span><label>$<span class="Total"></span></label></p>
    <hr>
    <p class="note">Important note: </p>
    <p class="note">*This amount only applies to on time return. Extra cost will apply if the product is returned after specified renting period</p>
</div>
</div>

</div>
</main>    
</body>
<script src="javascript/shopping_cart.js"></script>
<script src="javascript/logout.js"></script>
</html>
