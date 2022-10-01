<?php
include "./models/Db.php";

class Doughnut {
    public $id;
    public $title;
    public $price;
    public $weight;
    public $has_hole;

    public function __construct($id = null, $title = null, $price = null, $weight = null, $has_hole = "")
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

}



?>