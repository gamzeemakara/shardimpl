<?php
	include("db-details.php");

	class Database {
	
        public $connection;
        
        /**
         * Opens a connection to the DB
         */
        
        public function __construct() {
			$this->connection = mysql_connect(DATABASE_ADDRESS, DATABASE_USERNAME, DATABASE_PASSWORD) or die(mysql_connect_error());
			mysql_select_db(DATABASE_NAME,$this->connection);
        }
        
        /**
         * Clsoes the connection to the DB
         */
        
        public function __destruct() {
            mysql_close($this->connection);
        }
        
	}
?>