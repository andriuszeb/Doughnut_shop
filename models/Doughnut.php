<?php
include "./models/Db.php";

class Doughnut {
    public $id;
    public $title;
    public $price;
    public $weight;
    public $has_hole;
// ka duoda siuo atveju jeigu irasau ne null reiskme prie has hole?
    public function __construct($id = null, $title = null, $price = null, $weight = null, $has_hole = 1)
    {
        $this->id = $id;
        $this->title = $title;
        $this->price = $price;
        $this->weight = $weight;
        $this->has_hole = $has_hole;
        if ($this->has_hole == 1) {
                return $this->has_hole = "Tusciavidure";
            } else {
                return $this->has_hole = "Pilnavidure";
            }
            
    }

    public static function all() {
        $doughnuts = [];
        $db = new Db();
        $sql = "SELECT * FROM `doughnuts`";
        $result = $db->conn->query($sql);

        while ($row = $result->fetch_assoc()) {
            $doughnuts[] = new Doughnut($row['id'], $row['title'], $row['price'], $row['weight'], $row['has_hole']);
        }

        $db->conn->close();
        return $doughnuts;
    }

    public static function create()
    {
        $db = new Db();
        $stmt = $db->conn->prepare("INSERT INTO `doughnuts`(`title`, `price`, `weight`, `has_hole`) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("siii", $_POST['title'], $_POST['price'], $_POST['weight'], $_POST['has_hole']);
        $stmt->execute();
        $stmt->close();
        $db->conn->close();
    }

    public static function find($id)
    {
        $doughnut = [];
        $db = new Db();
        $sql = "SELECT * FROM `doughnuts` WHERE `id` = " . $id;
        $result = $db->conn->query($sql);

        while ($row = $result->fetch_assoc()) {
            $doughnut = new Doughnut($row['id'], $row['title'], $row['price'], $row['weight'], $row['has_hole']);
        }

        $db->conn->close();
        // Kaip padaryti kad update formoj rodytu ne reiksme duombazej o teksta?
        // if ($row['has_hole'] == 1) {
        //     return $has_hole = "Tusciavidure";
        // } else {
        //     return $has_hole = "Pilnavidure";
        // }
        return $doughnut;
    }
// Kodel price laukelyje suapvalina iki sveiko skaiciaus drant update?
    public function update()
    {
        $db = new Db();
        $stmt = $db->conn->prepare("UPDATE `doughnuts` SET `title`=?,`price`=?,`weight`=?,`has_hole`=? WHERE `id` = ?");
        $stmt->bind_param("siiii", $this->title, $this->price, $this->weight, $this->has_hole, $this->id);
        $stmt->execute();
        $stmt->close();
        $db->conn->close();
    }

    public static function destroy($id)
    {
        $db = new Db();
        $stmt = $db->conn->prepare("DELETE FROM `doughnuts` WHERE `id` = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
        $db->conn->close();
    }
}



?>