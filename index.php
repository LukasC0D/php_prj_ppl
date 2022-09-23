<?php

include_once './Assets/Files/db.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects & People</title>
    <link rel="stylesheet" href="./Assets/CSS/style.css">
</head>
<body>
    <header>
        <div>
            <div class="link-wrap">
                <a href="./?path=projects">Projects</a><br>
                <a href="./?path=people">People</a>
            </div>
            <h1><?php $path = $_GET['path'] ?? 'projects';
                echo $path; ?></h1>
        </div>
    </header>
    <div class="">
        <?php
        if ($path == 'people') {
            include './Assets/Files/people.php'; 
        } else if ($path == 'projects') {
            include './Assets/Files/projects.php'; 
        }
        ?>
    </div>
</body>
</html>