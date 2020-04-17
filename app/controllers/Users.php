<?php
    class Users extends Controller {
        public function __construct()
        {
            $this->userModel = $this->model('User');
        }

        public function register()
        {
            // Check for POST
            if ($_SERVER['REQUEST_METHOD'] ==  'POST')
            {
                // Process the form.

                // Sanitize post data.
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                // Init data.
                $data = [
                    'name' => trim($_POST['name']),
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'confirm_password' => trim($_POST['confirm_password']),
                    'name_err' => '',
                    'email_err' => '',
                    'password_err' => '',
                    'confirm-password_err' => ''
                ];

                // validating email
                if (empty($data['email']))
                {
                    $data['email_err'] = 'Please enter email';
                }
                else
                {
                    if ($this->userModel->findUserByEmail($data['email']))
                    {
                        $data['email_err'] = 'Email is already taken';
                    }
                }

                // validating name
                if (empty($data['name']))
                {
                    $data['name_err'] = 'Please enter name';
                }

                // validating password
                if (empty($data['password']))
                {
                    $data['password_err'] = 'Please enter password';
                }
                else if (strlen($data['password'] < '6'))
                {
                    $data['password_err'] = 'Password must be at least 6 characters.';
                }

                // validating email
                if (empty($data['confirm_password']))
                {
                    $data['confirm_password_err'] = 'Please confirm password';
                }
                else if ($data['password'] != $data['confirm_password'])
                {
                    $data['confirm_password_err'] = 'Passwords don\'t match!';
                }

                // Make sure errors are empty.
                if (empty($data['email_err']) && empty($data['name_err']) && empty($data['password_err']) && empty($data['confirm_password_err']))
                {
                    // Validated good.

                    // Hash password.
                    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                    // Register User.
                    if ($this->userModel->register($data))
                    {
                        flash('register_success', 'You are registerd and can log in');
                        redirect('users/login');
                    }
                    else 
                    {
                        die("Something went wrong");
                    }

                } else {
                    // Load view with errors.
                    $this->view('users/register', $data);
                }
                
            }
            else
            {
                // Init data.
                $data = [
                    'name' => '',
                    'email' => '',
                    'password' => '',
                    'confirm_password' => '',
                    'name_err' => '',
                    'email_err' => '',
                    'password_err' => '',
                    'confirm-password_err'
                ];

                // Load view
                $this->view('users/register', $data);
            }
        }

        public function login()
        {
            if ($_SERVER['REQUEST_METHOD'] == 'POST')
            {
                // Process the form.
                // Sanitize post data.
                $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

                // Init data.
                $data = [
                    'email' => trim($_POST['email']),
                    'password' => trim($_POST['password']),
                    'email_err' => '',
                    'password_err' => ''
                ];

                // validating email
                if (empty($data['email']))
                {
                    $data['email_err'] = 'Please enter email';
                }

                // validating password
                if (empty($data['password']))
                {
                    $data['password_err'] = 'Please enter password';
                }

                // Check for user/email.
                if ($this->userModel->findUserByEmail($data['email']))
                {
                    // User is found
                    
                }
                else
                {
                    // User not found
                    $data['email_err'] = 'No user found';
                }

                // Make sure errors empty.
                if (empty($data['email_err']) && empty($data['password_err']))
                {
                    // Validated
                    // Check and set login and user.
                    $loggedInUser = $this->userModel->login($data['email'], $data['password']);
                
                    if ($loggedInUser)
                    {
                        // Create User Session.
                        $this->createUserSession($loggedInUser);
                    }
                    else
                    {
                        // Render the view with errors.
                        $data['password_err'] = 'Password incorrect';
                        $this->view('users/login', $data);
                    }
                
                }
                else
                {
                    // load view with errors.
                    $this->view('users/login', $data);
                }

            }
            else
            {
                // Init data.
                $data = [
                    'email' => '',
                    'password' => '',
                    'email_err' => '',
                    'password_err' => ''
                ];
                // Load user view.
                $this->view('users/login', $data);
            }
        }

        public function createUserSession($user)
        {
            $_SESSION['user_id'] = $user->id;
            $_SESSION['user_email'] = $user->email;
            $_SESSION['user_name'] = $user->name;
            redirect('posts');
        }

        public function logout()
        {
            unset($_SESSION['user_id']);
            unset($_SESSION['user_email']);
            unset($_SESSION['user_name']);

            session_destroy();

            redirect('users/login');
        }


    }