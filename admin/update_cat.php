<?php
include_once "Admin.php";
use Admin\Admin;

$admin = new Admin();
$catItems = $admin->getCategories($_GET['id']);
$catItem = $catItems[0];

if(isset($_POST['submit'])) {
    $update = $admin->updateCat($_POST['id'], $_POST);

    if($update) {
        header("Location: index.php");
    } else {
        echo '<p style="color: red">Zaznam neuspesne vlozeny</p>';
    }
}
?>
<ul>
    <li><a href="index.php">Home</a></li>
    <li><a href="insert_cat.php">Vlozit kategoriu</a></li>
</ul><br>
<form action="update_cat.php" method="post">
    <input type="text" name="cat_id" value="<?php echo $catItem['cat_id']; ?>" placeholder="catid"><br>
    <input type="text" name="cat_name" value="<?php echo $catItem['cat_name']; ?>" placeholder="catname"><br>
    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
    <input type="submit" name="submit" value="Aktualizuj">
</form>