<?php
include "./controllers/DoughnutController.php";

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
    <div class="table-responsive">
        <table class="table table-hover table-dark" id="table">
            <tr >
                <th>Id</th>
                <th>Title</th>
                <th>Price</th>
                <th>Weight</th>
                <th>With hole</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            <?php foreach ($doughnuts as $doughnut) {?>
        <tr>
        <?php foreach ($doughnut as $prop) {?>
            <td> <?=$prop?> </td>
        <?php }?>
        </tr>
        <?php }?>
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