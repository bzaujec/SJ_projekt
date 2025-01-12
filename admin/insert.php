<?php
include_once "Admin.php";
use Admin\Admin;

$admin = new Admin();


if(isset($_POST['submit'])) {
    $insert = $admin->insertItem($_POST);
    if($insert) {
        echo '<p style="color: green">Zaznam uspesne vlozeny</p>';
    } else {
        echo '<p style="color: red">Zaznam neuspesne vlozeny</p>';
    }
}

?>
<ul>
    <li><a href="index.php">Home</a></li>
    <li><a href="insert.php">Vlozit polozku</a></li>
</ul><br>
<form action="insert.php" method="post">
    <input type="text" name="itemName" value="" placeholder="itemName"><br>
    <input list="categories" name="itemCat" value="" placeholder="itemCat"><br>
    <datalist id="categories">
        <?php echo $admin->getCatsAsOptions(); ?>
    </datalist>
    <input type="text" name="itemPrice" value="" placeholder="itemPrice"><br>
    <input type="checkbox" name="itemValid" value="1" checked placeholder="itemValid"><br>
    <textarea name="itemDesc"  placeholder="itemDesc" rows="10" cols="20"></textarea><br>
    <input list="images" name="itemImg"  placeholder="itemImg"><br>
    <datalist id="images">
        <?php echo $admin->getImgsAsOptions(); ?>
    </datalist>

    <input type="submit" name="submit" value="Odoslat">
</form>