<?php
/**
 * Dashboard.class.php
 *
 * This class handles Dashboard features.
 *
 * @author MigDinny (https://github.com/MigDinny)
 */

class Dashboard {

    /**
     * Returns an array with all existing API Keys' entries
     * @param query A query from search field to filter the results
     */
    public static function getAPIKeysArray($query=null) {
        if ($query == null) return DB::query("SELECT * FROM api_keys ORDER BY id DESC");
        else {
            $query = '"' . $query . '"';

            $queryDatabase = '
            SELECT * FROM api_keys WHERE
            lower(key_string) LIKE lower(concat("%", ' . $query . ', "%")) OR
            lower(key_owner) LIKE lower(concat("%", ' . $query . ', "%"))
            ORDER BY id DESC
            ';

            return DB::query($queryDatabase);
        }
    }

    /**
     * Returns an array with all existing Markers' entries
     * @param query A query from search field to filter the results
     */
    public static function getMarkersArray($query=null) {
        if ($query == null) return DB::query('SELECT * FROM markers ORDER BY last_updated DESC');
        else {
            $query = '"' . $query . '"';

            $queryDatabase = '
            SELECT * FROM markers WHERE
            lower(distribution) LIKE lower(concat("%", ' . $query . ', "%")) OR
            lower(facility) LIKE lower(concat("%", ' . $query . ', "%")) OR
            lower(event) LIKE lower(concat("%", ' . $query . ', "%")) OR
            lower(website) LIKE lower(concat("%", ' . $query . ', "%")) OR
            lower(contacts) LIKE lower(concat("%", ' . $query . ', "%"))
            ORDER BY last_updated DESC
            ';

            return DB::query($queryDatabase);
        }
    }

    /**
     * Adds an API Key to database. Hash is calculated using an MD5 random number
     * @param owner The owner of the API Key
     */
    public static function addAPIKey($owner) {
        do {
            $randomNumber = rand() * rand();
            $hash = md5($randomNumber);
        } while (self::checkAlreadyExists($hash));

        return DB::insert('api_keys', array(
            'key_owner' => $owner,
            'key_string' => $hash
        ));
    }

    /**
     * Regenerates an API Key using the same method
     * @param id The id of the API Key
     */
    public static function regenerateAPIKey($id) {
        do {
            $randomNumber = rand() * rand();
            $hash = md5($randomNumber);
        } while (self::checkAlreadyExists($hash));

        return DB::update('api_keys', array(
            'key_string' => $hash
        ), 'id=%s', $id);
    }
    /**
     * Changes the API Key owner
     * @param id The id of the API Key
     */
    public static function editAPIKeyOwner($id, $key_owner) {
        return DB::update('api_keys', array(
            'key_owner' => $key_owner
        ), 'id=%s', $id);
    }

    /**
     * Removes an API Key from database
     * @param id The id of the API Key
     */
    public static function removeAPIKey($id) {
        return DB::delete('api_keys', "id=%s", $id);
    }

    /**
     * Disables a marker
     * @param id The id of the marker
     */
    public static function disableMarker($id) {
        return DB::update('markers', array(
            'disabled' => 1
        ), 'id=%s', $id);
    }

    /**
     * Enables a marker
     * @param id The id of the marker
     */
    public static function enableMarker($id) {
        return DB::update('markers', array(
            'disabled' => 0
        ), 'id=%s', $id);
    }

    /**
     * Checks if API Key already exists in database
     * @param hash The hash to be searched on
     */
    private static function checkAlreadyExists($hash) {
        $query = DB::query("SELECT * FROM api_keys WHERE key_string=%s", $hash);
        if ($query == null) return false;
        else return true;
    }

}

?>
