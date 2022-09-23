<?php
if (isset($_POST['project_name']) != "") { 
    $sql = 'SELECT * FROM projects WHERE project_name = "' . $_POST['project_name'] . '";'; 
    $result = $connection->query($sql);
    if (mysqli_num_rows($result) == 0 && $_GET['action'] == 'add') { 
        $sql = 'INSERT INTO projects (project_name) VALUES ("' . $_POST['project_name'] . '");';
        $connection->query($sql);
        unset($_POST['project_name']);
        header('location:./?path=' . $_GET['path']);
        exit;
    }
}