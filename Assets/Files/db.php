<?php
$srvname = "localhost";
$username = "root";
$password = "";
$dbname = "projectsdb";

$connection = mysqli_connect($srvname, $username, $password);

if (!$connection->connect_error) {
        $sql = 'CREATE DATABASE IF NOT EXISTS ' . $dbname . ';';
        $connection->query($sql);
        $connection->select_db($dbname);
        if (!$connection) {
                die("Connection failed: " . mysqli_connect_error());
        }
        $sql = 'CREATE TABLE IF NOT EXISTS projects (
                id INT AUTO_INCREMENT PRIMARY KEY,
                project_name VARCHAR(30) NOT NULL);';
        $connection->query($sql);
        $sql = 'CREATE TABLE IF NOT EXISTS people (
                id INT auto_increment primary key,
                first_name VARCHAR(30) NOT NULL,
                last_name VARCHAR(30) NOT NULL);';
        $connection->query($sql);
        $sql = 'CREATE TABLE IF NOT EXISTS projects_people (
                prj_id INT,
                pers_id INT,
                FOREIGN KEY (prj_id) REFERENCES projects(id) ON UPDATE CASCADE ON DELETE CASCADE,
                FOREIGN KEY (pers_id) REFERENCES people(id) ON UPDATE CASCADE ON DELETE CASCADE);';
        $connection->query($sql);
}
