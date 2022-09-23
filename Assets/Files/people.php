<?php
include './Assets/Files/ppl_edit.php';
?>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Project</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $sql = 'SELECT people.id, concat(first_name," ", last_name) as full_name, project_name
                    FROM people
                    LEFT JOIN projects_people
                    ON people.id = projects_people.pers_id
                    LEFT JOIN projects
                    ON projects_people.prj_id = projects.id
                    ORDER BY people.id;';
        $result = $connection->query($sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                for ($i = 0; $i < count($row); $i++) {
                    echo '<td>';
                    echo $row[array_keys($row)[$i]];
                    echo '</td>';
                }
            }
        }
        echo '<tr><td></td><td><button><a href="?path=people&action=add">ADD NEW PERSON</a></button></td></tr>'; 
        ?>
    </tbody>
</table>

<?php
if (isset($_GET['action']) and $_GET['action'] == 'add') {
    $sql = 'SELECT COUNT(*) AS count FROM projects;'; 
    $result = $connection->query($sql);
    $res = $result->fetch_assoc();
    if ($res['count'] > 0) {

        echo '<form method="POST">
                <h3>Add new person</h3>
                <label for="first_name">First name:</label>
                <input type="text" name="first_name" id="first_name" minlength="2" maxlength="20" size="10" style="text-transform: capitalize; required>
                <label for="last_name">Last name:</label>
                <input type="text" name="last_name" id="last_name" minlength="2" maxlength="20" size="10" style="text-transform: capitalize; required>
                <label for="project">Asigned project:</label>
                <select name="project_id" id="project" required>
                <option value="0"></option>';
        $sql = 'SELECT DISTINCT projects.id, project_name FROM projects;';
        $connection->query($sql);
        $result = $connection->query($sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<option value=' . $row['id'] . '>' . $row['project_name'] . '</option>';
            }
        }
        echo '</select>
                <button type="submit" name="add">Add</button>
            </form>';
    } else {
        echo '<div>Please create project first!</div>';
    }
}

?>

