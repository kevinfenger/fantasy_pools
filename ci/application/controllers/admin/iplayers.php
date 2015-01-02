<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class IPlayers extends CI_Controller {

	public function __construct()
	{
		parent::__construct();	
	}
    public function index()
    {
       $this->load->model('player_model'); 
       $this->player_model->get_teams_by_user();  
    }
}
