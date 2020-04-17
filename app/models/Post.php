<?php

    class Post
    {
        private $db;

        public function __construct()
        {
            $this->db = new Database;
        }

        public function getPosts()
        {
            $this->db->query('SELECT *,
            posts.id AS postId,
            user.id AS userId,
            posts.created_at AS createdDate
            FROM posts
            INNER JOIN user
            ON posts.user_id = user.id
            ORDER BY posts.created_at DESC
            ');
            $results = $this->db->result_set();
            return $results;
        }

        public function addPost($data)
        {
            // Query to execute.
            $this->db->query('INSERT INTO posts (`title`, `user_id`, `body`) VALUES (:title, :user_id, :body)');
            // Bind the values.
            $this->db->bind(":title", $data['title']);
            $this->db->bind(":user_id", $data['user_id']);
            $this->db->bind(":body", $data['body']);
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

        public function getPostById($id)
        {
            $this->db->query('SELECT * FROM posts WHERE id = :id');
            $this->db->bind(':id', $id);
            $row = $this->db->single();
            return $row;
        }

        public function updatePost($data)
        {
            // Query to execute.
            $this->db->query('UPDATE posts SET `title` = :title, `body` = :body WHERE id = :id');
            // Bind the values.
            $this->db->bind(":id", $data['id']);
            $this->db->bind(":title", $data['title']);
            $this->db->bind(":body", $data['body']);
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

        public function deletePost($id)
        {
            // Query to execute.
            $this->db->query('DELETE FROM posts WHERE id = :id');
            // Bind the values.
            $this->db->bind(":id", $id);
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

    }