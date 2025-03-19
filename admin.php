<?php
session_start();
$conn = mysqli_connect("localhost", "root", "root", "cars");
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
    $city = $_POST['city'];
    $photolink = $_POST['photolink'];
    $model = $_POST['model'];
    $gasoline = $_POST['gasoline'];
    $horsepower = $_POST['horsepower'];
    $cost = $_POST['cost'];
    $class = $_POST['class'];
    
    $sql = "INSERT INTO list (city, photolink, model, gasoline, horsepower, cost, class)
            VALUES ('$city', '$photolink', '$model', '$gasoline', $horsepower, $cost, '$class')";

    if (mysqli_query($conn, $sql)) {
        header("Location: ".$_SERVER['PHP_SELF']);
        exit();
    }
}

if (isset($_POST['delete'])) {
    $id = $_POST['id'];
    mysqli_query($conn, "DELETE FROM list WHERE id = $id");
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>АРЕНДАТАЧЕК.РФ</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="шрифт/stylesheet.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;500;600;700;800;900&family=Unbounded:wght@200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
</head>

<form method="post" class="add-form">
    <h2>Добавить новый автомобиль</h2>
    <input type="text" name="city" placeholder="Город" >
    <input type="text" name="photolink" placeholder="Ссылка на фото" >
    <input type="text" name="model" placeholder="Модель" >
    <input type="text" name="gasoline" placeholder="Расход топлива (л)" >
    <input type="number" name="horsepower" placeholder="Лошадиные силы" >
    <input type="number" name="cost" placeholder="Стоимость" >
    <input type="text" name="class" placeholder="Класс автомобиля" >
    <button type="submit" name="add">Добавить</button>
</form>
<h1>Autos in mysql:</h1>
<div class="autopark container2">
<?php
$result = mysqli_query($conn, "SELECT * FROM list");
while ($row = mysqli_fetch_assoc($result)) {
    echo '<div class="cards">
    <div class="card_block">
        <div class="card '.htmlspecialchars($row['class']).'">
        <form method="post" action="">
    <button type="submit" name="delete" class="delete-button" style="width:50px;     background-image: url(bin.png);
    background-size: 100%;"></button>
</form>
            
            <a class="city" href="">'.htmlspecialchars($row['city']).'</a>
            <img class="img_car" src="'.htmlspecialchars($row['photolink']).'" alt="">
            <div class="cont">
                <p class="name_car">'.htmlspecialchars($row['model']).'</p>
                <div class="about2">
                    <div>
                        <img src="img/xz.svg" alt="">
                        <p>'.htmlspecialchars($row['gasoline']).' л/бензин</p>
                    </div>
                    <div>
                        <img src="img/xz2.svg" alt="">
                        <p>'.htmlspecialchars($row['horsepower']).' л.с.</p>
                    </div>
                </div>
                <div class="line"></div>
                <div class="foot">
                    <p>от <span>'.$row['cost'], 0, '', ' '.'</span> руб/сут.</p>
                </div>
            </div>
        </div>
    </div></div>';
}
?>
</html>
