<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Team extends CI_Controller {
    public function __construct()
    {
        parent::__construct();	
	$this->load->model('team_model');
    }

    public function check_team_name() 
    { 
        $league_name = $this->input->post('league_name'); 
        if (strlen($league_name) < 5)
            echo "league names must be at least 5 characters";
        else if (preg_match('/[^0-9A-Za-z]/',$league_name))
            echo 'valid characters are all upper/lowercase letters and numbers 0-9'; 
        else 
            echo 'success'; 
    }
    public function create_team() 
    {
       $params = $this->input->post(); 
       echo json_encode($test); 
    }
    public function save_team() 
    { 
       $params = $this->input->post(); 
       echo $this->team_model->save_team($params); 
        
    } 
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */
