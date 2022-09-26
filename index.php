<?php

include_once './Assets/Files/db.php';

if (isset($_GET['action']) && $_GET['action'] == 'delete') {
    $sql = 'DELETE FROM ' . $_GET['path'] . ' WHERE id = ' . $_GET['id'];
    $connection->query($sql);
    header('location:./?path=' . $_GET['path']);
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects & People</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="./Assets/CSS/style.css">
</head>
<body>
    <header>
        <div class="card text-center container">
            <div class="card-header">
                <ul class="nav nav-tabs card-header-tabs">
                    <li class="nav-item">
                        <a class="<?php echo ($_GET['path'] == "projects" ? "nav-link active" : "nav-link")?>"href="./?path=projects">Projects</a>
                    </li>
                    <li class="nav-item">
                        <a class="<?php echo ($_GET['path'] == "people" ? "nav-link active" : "nav-link")?>" href="./?path=people">People</a>
                    </li>
                </ul>
            </div>
            <div>
                <h1 class="text-center text-capitalize pt-2"><?php $path = $_GET['path'] ?? 'projects';
                 echo $path; ?></h1>
            </div>
    </header>
    <div>
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