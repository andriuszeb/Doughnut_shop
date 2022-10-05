<?php
include "./controllers/DoughnutController.php";

$edit = false;
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    if (isset($_POST['save'])) {
        DoughnutController::store();
        header("Location: ./index.php");
        die;
    }

    if (isset($_POST['edit'])) {
        $doughnut = DoughnutController::show();
        $edit = true;
    }
    
    if (isset($_POST['update'])) {
        $doughnut = DoughnutController::update();
        header("Location: ./index.php");
        die;
    }

    if (isset($_POST['cancel'])) {
        header("Location: ./index.php");
        die;
    }


    if (isset($_POST['destroy'])) {
        DoughnutController::destroy();
        header("Location: ./index.php");
        die;
    }
}

$doughnuts = DoughnutController::index();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/table.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <title>Document</title>
</head>

<body>
    <form action="" method="post">
        <div class="form-group row mb-3">
            <label for="title" class="col-sm-1 col-form-label text-center">Title</label>
            <div class="col-sm-4">
                <input type="text" name="title" value="<?= $edit ? $doughnut->title : "" ?>" class="form-control" required placeholder="Spurgos pavadinimas">
            </div>
        </div>
        <div class="form-group row mb-3">
            <label for="price" class="col-sm-1 col-form-label text-center">Price</label>
            <div class="col-sm-4">
                <input type="number" name="price" value="<?= $edit ? $doughnut->price : "" ?>" class="form-control" step="0.01" min="0" max="20" required placeholder="Kaina Eur.">
            </div>
        </div>
        <div class="form-group row mb-3">
            <label for="weight" class="col-sm-1 col-form-label text-center">Weight</label>
            <div class="col-sm-4">
                <input type="number" name="weight" value="<?= $edit ? $doughnut->weight : "" ?>" class="form-control" step="1" min="1" max="500" placeholder="Svoris (g.)">
            </div>
        </div>
        <div class="form-group row mb-3">
            <label for="has_hole" class="col-sm-1 col-form-label text-center">With hole</label>
            <div class="col-sm-4">
                <input type="number" name="has_hole" value="<?= $edit ? $doughnut->has_hole : "" ?>" class="form-control"  step="1" min="0" max="1" placeholder="Pilnavidurė (0), tusciavidure(1)">
            </div>
        </div>
        <div hidden class="form-group row mb-3">
            <label for="price" class="col-sm-1 col-form-label text-center">ID</label>
            <div class="col-sm-4">
                <input type="hidden" name="id" value="<?= $edit ? $doughnut->id : "" ?>" class="form-control">
            </div>
        </div>
        <div class="form-group row mb-3">
            <div class="col-sm-4 text-center">
                <?php
                if ($edit) { ?>
                    <button type="submit" name="update" class="btn btn-success">Update</button>
                    <button type="submit" name="cancel" class="btn btn-warning">Cancel</button>
                <?php } else { ?>
                    <button type="submit" name="save" class="btn btn-primary">Save</button>
                <?php } ?>
            </div>
        </div>
    </form>
    <div class="table-responsive">
        <table class="table table-hover table-dark" id="table">
            <tr>
                <th>Id</th>
                <th>Title</th>
                <th>Price</th>
                <th>Weight</th>
                <th>With hole</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php foreach ($doughnuts as $doughnut) { ?>
                <tr>
                    <?php foreach ($doughnut as $prop) { ?>
                        <td> <?= $prop ?> </td>
                    <?php } ?>
                    <td>
                        <form action="" method="post">
                            <input type="hidden" name="id" value="<?= $doughnut->id ?>">
                            <button type="submit" name="edit" class="btn btn-primary">edit</button>
                        </form>
                    </td>
                    <td>
                        <form action="" method="post">
                            <input type="hidden" name="id" value="<?= $doughnut->id ?>">
                            <button type="submit" name="destroy" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this item?');">delete</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>
</body>
<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
?>

</html>