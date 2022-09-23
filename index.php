<?php

include_once './Files/db.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>People & Projects </title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <header>
        <div class="header container">
            <div class="link-wrap">
                <a href="./?path=projects">Projects</a><br>
                <a href="./?path=people">People</a>
            </div>
            <h1><?php $path = $_GET['path'] ?? 'projects';
                echo $path; ?></h1>
        </div>
    </header>
</body>

</html>