<?php

namespace classes;

class Menu
{

    private $host = "localhost";
    private $dbname = "bzsj2024";
    private $username = "root";
    private $password = "";
    private $port = 3306;

    private $connection;

    public function __construct()
    {
        try {
            // Vytvorenie PDO objektu a pripojenie k databáze
            $this->connection = new \PDO(
                "mysql:host=$this->host;dbname=$this->dbname;port=$this->port;charset=utf8",
                $this->username,
                $this->password
            );
            // Nastavenie PDO pre zobrazenie chýb a vynucenie vyvolávania výnimiek
            $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            // Spracovanie chyby pripojenia
            echo "Chyba pri pripojení k databáze: " . $e->getMessage();
        }
    }
public function GetMenuCatFromDB():string
{
    $menuSQL = "SELECT * FROM tcategories";

    $menuStmt = $this->connection->prepare($menuSQL);

    $menuStmt->execute();
    $menuData = $menuStmt->fetchAll(\PDO::FETCH_ASSOC);

    $html = '<ul>';
    $deflink = 'tm-tab-link active';
    foreach ($menuData as $menu) {
      $html .= '<li>';
      $html .= '<a href="#" class="'.$deflink.'" data-id="'.$menu['cat_id'].'">'.$menu['cat_name'].'</a>';

      $html .= '</li>';
        $deflink = 'tm-tab-link';
    }

    $html .='</ul>';
    return $html;
}

public function GetMenuItemsFromDB():string
{
    $menuSQL = "SELECT * FROM titems where is_valid=1 order by cat_id";

    $menuStmt = $this->connection->prepare($menuSQL);

    $menuStmt->execute();
    $menuData = $menuStmt->fetchAll(\PDO::FETCH_ASSOC);
    $html='';
    $cat_id = '';
    foreach ($menuData as $menu) {
      //   rozdelenie do kategorii
    if($cat_id != $menu['cat_id']&&$cat_id !='') {
        $html .= '</div></div>';
      }
      if($cat_id != $menu['cat_id']) {
        $html .= '<div id="'.$menu['cat_id'].'" class="tm-tab-content"><div class="tm-list">';
      }
      // jednotlive polozky
      $html .= '<div class="tm-list-item">';
      // obrazok
      $html .= '<img src="img/'.$menu['item_image'].'" alt="'.$menu['item_name'].'" class="tm-list-item-img">';
      // polozka
      $html .= '<div class="tm-black-bg tm-list-item-text">';
      $html .= '<h3 class="tm-list-item-name">'.$menu['item_name'].'<span class="tm-list-item-price">'.$menu['item_price'].'</span></h3>';
      $html .= '<p class="tm-list-item-description">'.$menu['item_desc'].'</p>';

      $html .= '</div>'; // tm-black-bg tm-list-item-text
      $html .= '</div>'; // tm-list-item
      $cat_id = $menu['cat_id'];
    }


    return $html;
}

}