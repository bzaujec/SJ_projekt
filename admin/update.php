<?php
include_once "Admin.php";
use Admin\Admin;

$admin = new Admin();
$menuItems = $admin->getItems($_GET['id']);
$menuItem = $menuItems[0];

if(isset($_POST['submit'])) {
    $update = $admin->updateItem($_POST['id'], $_POST);

    if($update) {
        header("Location: index.php");
    } else {
        echo '<p style="color: red">Zaznam neuspesne vlozeny</p>';
    }
}

?>
<ul>
    <li><a href="index.php">Home</a></li>
    <li><a href="insert.php">Vlozit polozku</a></li>
</ul><br>
<form action="update.php" method="post">
    <input type="text" name="itemName" value="<?php echo $menuItem['item_name']; ?>" placeholder="itemName"><br>
<!--
    <input type="text" name="itemCat" value="<?php echo $menuItem['cat_name']; ?>" placeholder="itemCat"><br>
    <input list="categories" name="itemCat" value="<?php echo $menuItem['cat_id']; ?>" placeholder="itemCat"><br>
-->
    <input list="categories" name="itemCat" value="<?php echo $menuItem['cat_id']; ?>" placeholder="itemCat"><br>
    <datalist id="categories">
        <?php echo $admin->getCatsAsOptions(); ?>
    </datalist>
    <input type="text" name="itemPrice" value="<?php echo $menuItem['item_price']; ?>" placeholder="itemPrice"><br>
    <input type="checkbox" name="itemValid" value="1" <?php echo ($menuItem['is_valid']=='1')?('checked'):(''); ?> placeholder="itemValid"><br>
    <textarea name="itemDesc"  placeholder="itemDesc" rows="10" cols="20"><?php echo $menuItem['item_desc']; ?></textarea><br>
    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
    <input list="images" name="itemImg" value="<?php echo $menuItem['item_image']; ?>" placeholder="itemImg"><br>
    <datalist id="images">
        <?php echo $admin->getImgsAsOptions(); ?>
    </datalist>
    <input type="submit" name="submit" value="Odoslat">

</form>

