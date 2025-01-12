<?php
include_once "Admin.php";
use Admin\Admin;

$admin = new Admin();


if(isset($_POST['submit'])) {
    $insert = $admin->insertCat($_POST);
    if($insert) {
        echo '<p style="color: green">Zaznam uspesne vlozeny</p>';
    } else {
        echo '<p style="color: red">Zaznam neuspesne vlozeny</p>';
    }
}

?>
<ul>
    <li><a href="index.php">Home</a></li>
    <li><a href="insert_cat.php">Vlozit kategoriu</a></li>
</ul><br>
<form action="insert_cat.php" method="post">
    <input type="text" name="cat_id" value="" placeholder="catid"><br>
    <input type="text" name="cat_name" value="" placeholder="catname"><br>
    <input type="submit" name="submit" value="Odoslat">
</form>