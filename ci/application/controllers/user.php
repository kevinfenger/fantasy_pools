<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('user_model');
    }
    
    public function check_name() 
    {
        $name = $this->input->post('name');  
        
        if (strlen($name) < 1)
            echo 'names must be at least 2 characters';
        else if (preg_match('/[^0-9A-Za-z]/',$name))
            echo 'valid characters are all upper/lowercase letters and numbers 0-9'; 
        else 
            echo 'success'; 
    }
    public function check_email() 
    { 
        $email = $this->input->post('email'); 
        if (!filter_var($email, FILTER_VALIDATE_EMAIL))   
            echo 'the email you entered is invalid';
        else if ($this->user_model->email_already_exists($email)) 
            echo 'the email you entered already exists in our system'; 
        else 
            echo 'success'; 
    }
    public function check_password() 
    { 
        $password_one = $this->input->post('password_one'); 
        $password_two = $this->input->post('password_two'); 
        
        if ($password_one != $password_two)
            echo "passwords do not match"; 
        else if (strlen($password_one) < 4 || strlen($password_two) < 4) 
            echo 'password length must be between 4 and 16 characters'; 
        else if (strlen($password_one) > 16 || strlen($password_two) > 16) 
            echo 'password length must be between 4 and 16 characters'; 
        else 
            echo 'success'; 
    }
    public function create_user() 
    {
        $post_params = $this->input->post(); 
        $rv = $this->user_model->create_user($post_params);  
        echo $rv; 
    }  
    public function login_local_user() 
    { 
        $post_params = $this->input->post(); 
        $rv = $this->user_model->local_login($post_params);
        echo $rv;  
    }
    public function logout() 
    {
        $this->session->unset_userdata(array('id'         => null, 
                                             'avatar_url' => null, 
                                             'first_name' => null,
                                             'last_name'  => null));  
        $this->session->sess_destroy();
    } 
    public function facebook_login() 
    {
        $user = $this->input->post('user'); 
        try {
            $this->user_model->facebook_login($user); 
        }
        catch (Exception $e) { 
        //echo 'true'; 
        }
    }
}
