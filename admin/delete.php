<?php
include_once "Admin.php";
use Admin\Admin;

$admin = new Admin();


if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $delete = $admin->deleteItem($id);
    if($delete) {
        header("Location: index.php");
    } else {
        echo '<p style="color: red">ERROR</p>';
    }
}