<?php
include_once "Admin.php";
use Admin\Admin;

$admin = new Admin();
$catItems = $admin->getCategories();
$menuItems = $admin->getItems();
?>

<html>
<head>
    <title>Admin panel</title>
</head>
<body>
<ul>
    <li><a href="index.php">Home</a></li>
    <li><a href="insert_cat.php">Vlozit kategoriu</a></li>
</ul>
<div categories>
    <a href="insert_cat.php">Vlozit kategoriu</a>
<table>
    <tr>
        <th>ID</th>
        <th>Nazov</th>
        <th></th>
        <th></th>
    </tr>
    <?php
    foreach ($catItems as $catItem) {
        ?>
        <tr>
            <td><?php echo $catItem['cat_id']; ?></td>
            <td><?php echo $catItem['cat_name']; ?></td>
            <td><a href="update_cat.php?id=<?php echo $catItem['id']; ?>">Aktualizuj</a></td>
            <td><a href="delete_cat.php?id=<?php echo $catItem['id']; ?>">Vymazat</a></td>
        </tr>
        <?php
    }
    ?>
</table></div>
<br>
<br>
<div items>
    <a href="insert.php">Vlozit polozku</a>
    <table>
  <tr>
      <th>ID</th>
      <th>Nazov</th>
      <th>Kategoria</th>
      <th>Cena</th>
      <th>Platny</th>
      <th></th>
      <th></th>
  </tr>
    <?php
    foreach ($menuItems as $menuItem) {
        ?>
        <tr>
            <td><?php echo $menuItem['id']; ?></td>
            <td><?php echo $menuItem['item_name']; ?></td>
            <td><?php echo $menuItem['cat_name']; ?></td>
            <td><?php echo $menuItem['item_price']; ?></td>
            <td><input type="checkbox"<?php echo ($menuItem['is_valid']=='1')?('checked'):(''); ?>></td>
            <td><a href="update.php?id=<?php echo $menuItem['id']; ?>">Aktualizuj</a></td>
            <td><a href="delete.php?id=<?php echo $menuItem['id']; ?>">Vymazat</a></td>
        </tr>
        <?php
    }
    ?>
</table>
</div>
</body>
</html>
