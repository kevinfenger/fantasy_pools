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
        
        if (strlen($name) > 1)
            echo 'success'; 
        else 
            echo 'Names must be at least 2 characters'; 
    }
    public function check_email() 
    { 
        $email = $this->input->post('email'); 
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {  
            //TODO call model make sure email doesn't exist yet.
            echo 'success'; 
        }
        else { 
            echo 'The email you enetered is invalid';
        } 
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
            echo print_r($user,1); 
        }
        catch (Exception $e) { 
        //echo 'true'; 
        }
    }
}
