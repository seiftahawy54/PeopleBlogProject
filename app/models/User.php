<?php
    class User
    {
        private $db;

        public function __construct()
        {
            $this->db = new Database;
        }

        // Register User.
        public function register($data)
        {
            // Query to execute.
            $this->db->query('INSERT INTO user (`name`, `email`, `password`) VALUES (:name, :email, :password)');
            // Bind the values.
            $this->db->bind(":email", $data['email']);
            $this->db->bind(":name", $data['name']);
            $this->db->bind(":password", $data['password']);
            // Execute query.
            if ($this->db->execute())
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        // Find user by email
        public function findUserByEmail($email)
        {
            // Query to execute.
            $this->db->query('SELECT * FROM user WHERE email = :email');
            // Bind the values.
            $this->db->bind(":email", $email);

            $row = $this->db->single();
            // Check row
            if ($this->db->rowCount() > 0)
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        // Find user by id
        public function getUserById($id)
        {
            // Query to execute.
            $this->db->query('SELECT * FROM user WHERE id = :id');
            // Bind the values.
            $this->db->bind(":id", $id);

            $row = $this->db->single();
            
            return $row;
        }

        // Check login and give validation
        public function login($email, $password)
        {
            $this->db->query('SELECT * FROM user WHERE email = :email');
            $this->db->bind(':email', $email);
        
            $row = $this->db->single();
        
            $hashed_password = $row->password;
            if (password_verify($password, $hashed_password))
            {
                return $row;
            }
            else
            {
                return false;
            }
        }

    }