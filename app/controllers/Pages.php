<?php
    class Pages extends Controller
    {
        public function __construct()
        {
        }

        public function index()
        {
            // $posts = $this->postModel->getPost();
         
            if (isLoggedIn())
            {
                redirect('posts/');
            }

            $data = [
                'title' => 'Welcome to Seif Tahawy Blog',
                // To Test the database.
                // 'posts' => $posts
                'description' => 'Simple social network built on TraversyMVC PHP framework!'
            ];

            $this->view('pages/index', $data);
        }

        public function about()
        {
            $data = [
                'title' => 'About Us',
                'description' => 'App to share posts of myself or any one can join me ❤'
            ];

            $this->view('pages/about', $data);
        }

    }