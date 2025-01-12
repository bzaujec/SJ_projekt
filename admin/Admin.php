<?php

namespace Admin;

class Admin
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

    public function getCategories(int $id = null): array
    {
        if($id) {
            $sql = "SELECT id, cat_id, cat_name, cat_desc FROM tcategories where id=" . $id;;
        } else {
            $sql = "SELECT id, cat_id, cat_name, cat_desc FROM tcategories";
        }
       // $sql = "SELECT id, cat_id, cat_name, cat_desc FROM tcategories";
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $categoriesData = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $categoriesData;
    }

    public function insertCat(array $data): bool
    {
        $catInsertSQL = "INSERT INTO tcategories (`cat_id`, `cat_name`) 
                  VALUES (:catid, :catname)";
        $catInsertStmt = $this->connection->prepare($catInsertSQL);
        // Hodnoty pre hlavnú položku menu
        $catid = $data['cat_id'] ?? '';
        $catname = $data['cat_name'] ?? '';

        // Vloženie
        $insert = $catInsertStmt->execute([
            ':catid' => $catid,
            ':catname' => $catname,
        ]);

        return $insert;
    }

    public function updateCat(int $id,array $data): bool
    {
        $catUpdateSQL = "update tcategories set `cat_id` = :catid, `cat_name` = :catname where id = :id";
        $catUpdateStmt = $this->connection->prepare($catUpdateSQL);
        // Hodnoty pre hlavnú položku menu
        $catid = $data['cat_id'] ?? '';
        $catname = $data['cat_name'] ?? '';

        // Vloženie
        $update = $catUpdateStmt->execute([
            ':catid' => $catid,
            ':catname' => $catname,
            ':id' => $id,
        ]);

        return $update;
    }

    public function deleteCat(int $id): bool
    {
        $catDeleteSQL = "DELETE FROM tcategories WHERE id = :id";
        $catDeleteStmt = $this->connection->prepare($catDeleteSQL);

        // Vloženie hlavnej položky menu
        $delete = $catDeleteStmt->execute([
            ':id' => $id
        ]);

        return $delete;
    }

    public function getItems(int $id = null): array
    {
        if($id) {
            $sql = "SELECT a.id, a.item_name, a.item_price, b.cat_name, a.is_valid, a.item_desc, a.item_image, a.cat_id FROM titems a left join tcategories b on a.cat_id=b.cat_id where a.id=" . $id;;
        } else {
            $sql = "SELECT a.id, a.item_name, a.item_price, b.cat_name, a.is_valid FROM titems a left join tcategories b on a.cat_id=b.cat_id";
        }
        $stmt = $this->connection->prepare($sql);
        $stmt->execute();
        $itemsData = $stmt->fetchAll(\PDO::FETCH_ASSOC);

        return $itemsData;
    }
    public function insertItem(array $data): bool
    {
        $catInsertSQL = "INSERT INTO titems (`item_name`, `item_price`, `cat_id`, `is_valid`, `item_desc`, `item_img`) 
                  VALUES (:itemName, :itemPrice, :cat_name, :itemValid, :itemDesc, :itemImg)";
        $catInsertStmt = $this->connection->prepare($catInsertSQL);
        var_dump($data);
        // Hodnoty pre hlavnú položku menu
        $itemName = $data['itemName'] ?? '';
        $itemPrice = $data['itemPrice'] ?? '';
        $itemCat = $data['itemCat'] ?? '';
        $itemValid = $data['itemValid'] ?? '';
        $itemDesc = $data['itemDesc'] ?? '';
        $itemImg = $data['itemImg'] ?? '';
        var_dump($itemDesc);
        // Vloženie
        $insert = $catInsertStmt->execute([
            ':itemName' => $itemName,
            ':itemPrice' => $itemPrice,
            ':cat_name' => $itemCat,
            ':itemValid' => $itemValid,
            ':itemDesc' => $itemDesc,
            ':itemImg' => $itemImg,
        ]);

        return $insert;
    }
    public function deleteItem(int $id): bool
    {
        $catDeleteSQL = "DELETE FROM titems WHERE id = :id";
        $catDeleteStmt = $this->connection->prepare($catDeleteSQL);

        // Vloženie hlavnej položky menu
        $delete = $catDeleteStmt->execute([
            ':id' => $id
        ]);

        return $delete;
    }

    public function updateItem(int $id,array $data): bool
    {
        $itemUpdateSQL = "update titems set `item_name` = :itemName, `item_price` = :itemPrice,
              cat_id = :itemCat, is_valid = :itemValid, item_desc = :itemDesc, item_image = :itemImg 
              where id = :id";
        $itemUpdateStmt = $this->connection->prepare($itemUpdateSQL);
        // Hodnoty pre hlavnú položku menu
        $itemName = $data['itemName'] ?? '';
        $itemPrice = $data['itemPrice'] ?? '';
        $itemCat = $data['itemCat'] ?? '';
        $itemValid = $data['itemValid'] ?? '';
        $itemDesc = $data['itemDesc'] ?? '';
        $itemImg = $data['itemImg'] ?? '';

        // Vloženie
        $update = $itemUpdateStmt->execute([
            ':itemName' => $itemName,
            ':itemPrice' => $itemPrice,
            ':itemCat' => $itemCat,
            ':itemValid' => $itemValid,
            ':itemDesc' => $itemDesc,
            ':itemImg' => $itemImg,
            ':id' => $id,
        ]);

        return $update;
    }
    public function getCatsAsOptions():string
    {
        $catItems = self::getCategories();
        $html = '';
        foreach ($catItems as $catItem) {
        $html .= '<option value="'.$catItem['cat_id'].'">'.$catItem['cat_name'].'</option>';
        }
        return $html;
    }

    public function getImgsAsOptions():string
    {
        $imgItems = self::getImageNamesFromDir();
        $html = '';
        foreach ($imgItems as $imgItem) {
            $html .= '<option value="'.$imgItem.'">'.$imgItem.'</option>';
        }
        return $html;
    }

    function getImageNamesFromDir()
    {
//        $directory = "../img";
        $directory = getcwd()."\..\img";
        $files = scandir($directory);
        return array_diff($files, array('.', '..'));
    }
}