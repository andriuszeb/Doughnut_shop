<?php
include "./models/Doughnut.php";

class DoughnutController
{
    public static function index()
    {
        $doughnut = Doughnut::all();
        return $doughnut;
    }

    public static function store()
    {
        Doughnut::create();
    }

    public static function show()
    {
        $doughnut = Doughnut::find($_POST['id']);
        return $doughnut;
    }
        
    public static function edit()
    {

    }
    
    public static function update()
    {
        $doughnut = new Doughnut();
        $doughnut->id = $_POST['id'];
        $doughnut->title = $_POST['title'];
        $doughnut->price = $_POST['price'];
        $doughnut->weight = $_POST['weight'];
        $doughnut->has_hole = $_POST['has_hole'];
        $doughnut->update();
    }
    
    public static function destroy()
    {
        Doughnut::destroy($_POST['id']);
    }
}

?>