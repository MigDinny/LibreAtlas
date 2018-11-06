<div id='api_keys_list'>
    <center>
        <div id='submit_new_key'>

            <form method='POST' action=<?= "?area=" . RequestHandler::DASHBOARD_AREA . "&action=" . RequestHandler::ADD_API_KEY ?> >

                <div class='ui input'><input type="text" name="key_owner" placeholder="API Key Owner" /></div>
                <button id="generate_api_key_button" class="ui teal button" type="submit">Generate API Key</button>

            </form>

        </div>
        <table id="api_keys_table">
        <?php

            if (isset($_GET['q'])) $apiKeysArray = Dashboard::getAPIKeysArray($_GET['q']);
            else $apiKeysArray = Dashboard::getAPIKeysArray();

            foreach ($apiKeysArray as $row) {
                echo "<tr>";
                echo "<form name='manage_key' method='POST' action='?area=" . RequestHandler::DASHBOARD_AREA . "&action=" . RequestHandler::EDIT_API_KEY . "'>";
                echo "<input style='display: none' type='hidden' name='id' value='" . $row['id'] . "' />";
                echo "<th><span style='color: green'>" . $row['id'] . "  </span></th>";
                echo "<th><span style='color: red; margin-left: 10px; width: 200px;'>" . $row['key_string'] . "   </span></th>";
                echo "<th><div class='ui input'><input type='text' placeholder='API Key Owner' name='key_owner' value='" . $row['key_owner'] . "' /></div></th>";
                echo "<th><button class='ui teal button' type='submit' name='submit_edit_owner'>Edit Key Owner</button></th>";
                echo "<th><button class='ui teal button' type='submit' name='submit_regen_key'>Regenerate API Key</button></th>";
                echo "<th><button class='ui red button' type='submit' name='submit_remove_key'>Remove</button></th>";
                echo "</form>";
                echo "</tr>";
            }

        ?>
        </table>
    </center>
</div>
