<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class User_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    }

    function facebook_login($user) 
    { 
        if ($user) {
 
            if ( ($id = $this->id_external_already_exists($user['id'])) == 0) { 
                $sql = 'INSERT INTO users (email, first_name, last_name, id_external, avatar_url, created) VALUES(?,?,?,?,?,NOW())';
                $this->db->query($sql, array($user['email'], $user['first_name'], $user['last_name'], $user['id'], $user['picture']['data']['url']));
                $id = $this->db->insert_id(); 
            }
            //echo print_r($user);  
            $this->session->set_userdata(array('id'         => $id, 
                                               'avatar_url' => $user['picture']['data']['url'], 
                                               'first_name' => $user['first_name'],
                                               'last_name'  => $user['last_name']));  
        }
        else { 
           //TODO throw exception
        }

    }
    function local_login($input) 
    {
       echo print_r($this->db);  
       $this->db->select('first_name, last_name, id, password, salt'); 
       $query = $this->db->get_where('users', array('email' => $input['email'])); 
       if ($query->num_rows() == 0) 
           return 'user not found'; 
       $user = $query->row_array();
       $check_password = hash('sha256', $input['password'] . $user['salt']);
       if ($check_password === $user['password']) 
       { 
           $this->session->set_userdata(array('id'         => $user['id'], 
                                              'first_name' => $user['first_name'],
                                              'last_name'  => $user['last_name']));    
           return 'success'; 
       }   
       return 'failed to log this user in';  
    }
    function create_user($input) 
    {
        $salt = dechex(mt_rand(0, 2147483647)) . dechex(mt_rand(0, 2147483647));
        $password = hash('sha256', $input['password'] . $salt);
        $sql = 'INSERT INTO users (email, first_name, last_name, password, salt, created) VALUES(?,?,?,?,?,NOW())'; 
        $this->db->query($sql, array($input['email'], $input['first_name'], $input['last_name'], $password, $salt));
        
        if ($this->db->insert_id() > 0) { 
            $this->session->set_userdata(array('id'         => $this->db->insert_id(), 
                                               'first_name' => $input['first_name'],
                                               'last_name'  => $input['last_name']));   
            return 'success'; 
        }
        return 'failed create the new user';  
    }
    function email_already_exists($email) 
    { 
       $this->db->select('id'); 
       $query = $this->db->get_where('users', array('email' => $email)); 
       return ($query->num_rows() > 0); 
    }
    function id_external_already_exists($id_external) 
    { 
       $this->db->select('id'); 
       $query = $this->db->get_where('users', array('id_external' => $id_external)); 
       if ($query->num_rows() == 0)
           return 0; 
       $user = $query->row_array(); 
       return $user['id'];  
    } 
}
