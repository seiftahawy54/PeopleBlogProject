<?php
    /*
        Base controller
        loads the models and views.
    */

    class Controller {
        // Load Model
        public function model ($model)
        {
            // Requie model file.
            require_once '../app/models/' . $model . '.php';

            // Instantiate model
            return new $model();
        }

        // Load view
        public function view($view, $data = [])
        {
            // Check for view file.
            if (file_exists('../app/views/' . $view . '.php'))
            {
                require_once '../app/views/' . $view . '.php';
            }
            else
            {
                // View doesn't exists.
                die("view doesn't exist!");
            }
        }
    }