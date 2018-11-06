<?php
/**
 * Session.class.php
 *
 * This class handles sessions.
 *
 * @author MigDinny (https://github.com/MigDinny)
 */

class Session {

    // Checks whether there is a valid session or not
    public static function hasPermission() {
        return $_SESSION['username'] == $GLOBALS['dashboard_username'] && $_SESSION['password'] == $GLOBALS['dashboard_password'];
    }

    // Logs the user in. ONLY adds it to session
    public static function login($postData) {
        session_start();
        $username = $postData['username'];
        $password = $postData['password'];

        if ($username == $GLOBALS['dashboard_username'] && $password == $GLOBALS['dashboard_password']) return self::createSession($username, $password);
        else return false;
    }

    // Logs the user out. removes session
    public static function logout() {
        return self::nullifySession();
    }

    private static function createSession($username, $password) {
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;

        return true;
    }

    private static function nullifySession() {
        session_destroy();
        unset($_SESSION['username']);
        unset($_SESSION['password']);

        return true;
    }

}

?>
