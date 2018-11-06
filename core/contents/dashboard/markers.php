<div id='markers_list'>

    <center>

        <table id="markers_table" class="ui celled table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Coordinates</th>
                    <th>Facility</th>
                    <th>Distribution</th>
                    <th>Event</th>
                    <th># Patients</th>
                    <th>Website</th>
                    <th>Contacts</th>
                    <th>Last Updated</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
            <?php

                if (isset($_GET['q'])) $markersArray = Dashboard::getMarkersArray($_GET['q']);
                else $markersArray = Dashboard::getMarkersArray();

                foreach ($markersArray as $row) {
                    $disabled = $row['disabled'];
                    echo "<tr>";
                    echo "<td " . ($disabled ? "class='disabled'" : "") .  " data-label='ID'>" . $row['id'] . "</td>";
                    echo "<td " . ($disabled ? "class='disabled'" : "") .  " data-label='Coordinates'>" . $row['latlng'] . "</td>";
                    echo "<td " . ($disabled ? "class='disabled'" : "") .  " data-label='Facility'>" . $row['facility'] . "</td>";
                    echo "<td " . ($disabled ? "class='disabled'" : "") .  " data-label='Distribution'>" . $row['distribution'] . "</td>";
                    echo "<td " . ($disabled ? "class='disabled'" : "") .  " data-label='Event'>" . $row['event'] . "</td>";
                    echo "<td " . ($disabled ? "class='disabled'" : "") .  " data-label='# Patients'>" . $row['number_patients'] . "</td>";
                    echo "<td " . ($disabled ? "class='disabled'" : "") .  " data-label='Website'>" . $row['website'] . "</td>";
                    echo "<td " . ($disabled ? "class='disabled'" : "") .  " data-label='Contacts'>" . $row['contacts'] . "</td>";
                    echo "<td " . ($disabled ? "class='disabled'" : "") .  " data-label='Last Updated'>" . $row['last_updated'] . "</td>";
                    echo "<td data-label='Status'>" .
                    ( ($disabled) ?
                    ("<a href='?area=" . RequestHandler::DASHBOARD_AREA . "&action=" . RequestHandler::ENABLE_MARKER . "&id=" . $row['id'] . "'>Enable</a>")
                    :
                    ("<a href='?area=" . RequestHandler::DASHBOARD_AREA . "&action=" . RequestHandler::DISABLE_MARKER . "&id=" . $row['id'] . "'>Disable</a>")
                    ) . "</td>";
                    //echo "<td><button class='ui red button' type='submit'>Disable</button></td>";
                    echo "</tr>";
                }

            ?>
            </tbody>
        </table>
    </center>
</div>
