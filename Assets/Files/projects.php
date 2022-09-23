<?php
require './Assets/Files/prj_edit.php';
?>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Project</th>
            <th>People Involved</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $sql = 'SELECT projects.id, project_name, group_concat(concat(first_name, " ", last_name) SEPARATOR "<br>")
                    FROM projects
                    LEFT JOIN projects_people
                    ON projects.id = prj_id
                    LEFT JOIN people
                    ON pers_id = people.id
                    GROUP BY projects.id;';
        $result = $connection->query($sql);

        if (mysqli_num_rows($result) > 0) { 
            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                for ($i = 0; $i < count($row); $i++) {
                    echo '<td>';
                    echo $row[array_keys($row)[$i]];
                    echo '</td>';
                }
                echo '<td>';
                echo '<td><button><a href="?path=projects&action=update&id=' . $row['id'] . '">Edit</a></button>'; 
                echo '<button><a href="?path=projects&action=delete&id=' . $row['id'] . '">Delete</a></button></td>'; 
                echo '</tr>';
            }
        }
        echo '<tr><td></td><td><button><a href="?path=projects&action=add">ADD NEW PROJECT</a></button></td></tr>';
        ?>
    </tbody>
</table>
<?php
if (isset($_GET['action']) && $_GET['action'] == 'add') { 
    echo '<form method="POST">
            <h3>Add new project</h3>
            <label for="project_name">Project name:</label>
            <input type="text" name="project_name" id="project_name" minlength="2" maxlength="35" size="10" required>
            </select>
            <button type="submit" name="add">Add</button>
        </form>';
} else if (isset($_GET['action']) && $_GET['action'] == 'update') { 
    $sql = 'SELECT project_name FROM projects WHERE id = ' . $_GET['id'];
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();
    $_POST['project_name'] = $row['project_name'];
    echo '<form method="POST">
                <h3>Update project</h3>
                <label for="project_name">Project name:</label>
                <input type="text" name="project_name" id="project_name" minlength="2" maxlength="35" size="10" value="' . $row['project_name'] . '">
                <label for="people">Asigned people:</label>
                <select name="people_id[]" id="people" multiple>';
    $sql = 'SELECT DISTINCT id, first_name, last_name FROM people;';
    $connection->query($sql);
    $result = $connection->query($sql);
    if (mysqli_num_rows($result) > 0) {
        while ($row = $result->fetch_assoc()) {
            $sql = 'SELECT DISTINCT prj_id FROM projects_people WHERE pers_id = ' . $row['id'] . ';';
            $result_p = $connection->query($sql);
            $person_projects = [];
            while ($pa = $result_p->fetch_assoc()) {
                $person_projects[] = $pa['prj_id'];
            }
            $selected = in_array($_GET['id'], $person_projects) ? 'selected' : '';
            echo '<option value="' . $row['id'] . '" ' . $selected . '>' . $row['first_name'] . ' ' . $row['last_name'] .  '</option>';
        }
    }
    echo '  </select>   
                <button type="submit" name="update">Update</button>
            </form>';
}
?>