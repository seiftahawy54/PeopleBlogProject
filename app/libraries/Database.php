<?php

    /*
        PDO Database class.
        Connect to database.
        create prepared statments
        Bind Values
        Return rows and results.
    */

use function PHPSTORM_META\type;

class Database
    {
        private $host = DB_HOST;
        private $user = DB_USER;
        private $pass = DB_PASS;
        private $db_name = DB_NAME;

        private $dbh;
        private $stmt;
        private $error;

        public function __construct()
        {
            // Set DSN
            $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->db_name;
            $options = array(
                PDO::ATTR_PERSISTENT => true,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            );

            // Create PDO Exception.
            try {
                $this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
            } catch (PDOException $e) {
                $this->error = $e->getMessage();
                echo $this->error;
            }
        }

        // Prepare statments with queries.
        public function query($sqlQuery)
        {
            $this->stmt = $this->dbh->prepare($sqlQuery);
        }

        // Bind values.
        public function bind($param, $value, $type = null)
        {
            // Determine the type of the values inserted.
            if (is_null($type))
            {
                switch (true)
                {
                    case is_int($value):
                        $type = PDO::PARAM_INT;
                        break;
                    case is_bool($value):
                        $type = PDO::PARAM_BOOL;
                        break;
                    case is_null($value):
                        $type = PDO::PARAM_NULL;
                        break;
                    default:
                        $type = PDO::PARAM_STR;
                }
            }

            // Bind the values.
            $this->stmt->bindValue($param, $value, $type);

        }

        // Execute the prepared statment.
        public function execute()
        {
            return $this->stmt->execute();
        }

        // Get result set as array of objects.
        public function result_set()
        {
            $this->execute();
            return $this->stmt->fetchAll(PDO::FETCH_OBJ);
        }

        // Get single record as object.
        public function single()
        {
            $this->execute();
            return $this->stmt->fetch(PDO::FETCH_OBJ);
        }

        // Get row count.
        public function rowCount()
        {
            return $this->stmt->rowCount();
        }

    }