<?php
namespace App\Database;

use mysqli;

/*
* Mysql database connection - only single connection allowed
*/
class DatabaseConnection {

    /*
     * General connection strings
     */
    private $connection;
    private static $instance;
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $database = "xml_parser";

    /*
    * Make an instance of the DatabaseConnection class
    * Singleton implementation for only one instance of the class
    * @return Instance
    */
    public static function makeInstance() {
        // If there isn't an instance, make one
        if(!self::$instance) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Protected constructor to prevent creating a new instance of
     * DatabaseConnection via the new operator from outside of this class.
     */
    protected function __construct() {
        $this->connection = new mysqli($this->host, $this->username,
            $this->password, $this->database);

        // Error handling
        if(mysqli_connect_error()) {
            trigger_error("Database Connection Error: " . mysql_connect_error(),
                E_USER_ERROR);
        }
    }

    /**
     * Private clone method to prevent cloning of the instance of DatabaseConnection instance.
     *
     * @return void
     */
    private function __clone()
    {
    }

    /**
     * Private unserialize method to prevent unserializing of DatabaseConnection
     * instance.
     *
     * @return void
     */
    private function __wakeup()
    {
    }

    /**
     * Get mysqli connection.
     * @return mysqli
     */
    public function connect()
    {
        return $this->connection;
    }
}
?>