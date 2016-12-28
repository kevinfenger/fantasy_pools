<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Player extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->model('player_model'); 	
    }
    public function players_by_position() 
    { 
        $params = $this->input->get();
        echo json_encode($this->player_model->get_players_by_position($params['position']));  
    } 

}

/* End of file home.php */
/* Location: ./application/controllers/home.php */
