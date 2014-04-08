<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    }

    function facebook_login($user) 
    { 
        if ($user) {  
            $this->session->set_userdata(array('id'         => $user['id'], 
                                               'avatar_url' => $user['picture']['data']['url'], 
                                               'first_name' => $user['first_name'],
                                               'last_name'  => $user['last_name']));  
        }
        else { 
           //TODO throw exception
        }

    }
}
