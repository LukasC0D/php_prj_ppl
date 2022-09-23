
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
      
        ?>
    </tbody>
</table>

