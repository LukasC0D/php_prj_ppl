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
            }
        }
        ?>
    </tbody>
</table>