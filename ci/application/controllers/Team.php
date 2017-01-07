<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Team extends CI_Controller {
    public function __construct()
    {
        parent::__construct();	
	$this->load->model('team_model');
    }
    public function index() 
    { 
	$this->stencil->slice('head');
	$this->stencil->slice('header');
	$this->stencil->layout('standard_layout');
	$this->stencil->css('font-awesome');
        $params = $this->input->get(); 
        if (!($params) || !array_key_exists('team_id', $params)) { 
 	    $this->stencil->title('Team Viewing Issues');
   	    $this->stencil->paint('issues_view', array('heading' => 'Team Does Not Exist', 'content' => 'The team you are trying to view does not exist.'));
            return; 
        }
        $team_id = $params['team_id']; 
        if (!($this->team_model->does_team_exist($team_id))) { 
 	    $this->stencil->title('Team Viewing Issues');
   	    $this->stencil->paint('issues_view', array('heading' => 'Team Does Not Exist', 'content' => 'The team you are trying to view does not exist.'));
            return; 
        }

	$this->load->model('league_model');
        $user_id = $this->session->userdata('id') ? $this->session->userdata('id') : 0;
        $league_id = $this->team_model->get_league_id($team_id); 
        $is_public_league = $this->league_model->is_league_public($league_id);
        $is_league_member = $this->league_model->is_league_member($league_id, $user_id); 
        $is_team_owner = $this->team_model->is_team_owner($user_id, $team_id);
        $team_details = $this->team_model->get_team_details($team_id); 
        $league_details = $this->league_model->get_league_details($league_id); 
        // TODO this code is shit, it needs a cleanup  
        if ($is_public_league) {
            if ($is_team_owner) {
                $this->stencil->js('league_funcs');
                $this->_paint_team($user_id, $team_details, $league_details, 'team_owner_view');
            } 
            else {
                if (strtotime(PLAYERS_VIEWABLE_DATETIME) < time(null)) {  
                    $team_user_id = $this->team_model->get_team_user_id($team_details->team_id); 
                    $this->_paint_team($team_user_id, $team_details, $league_details, 'team_nonowner_view');
                }
                else { 
 	            $this->stencil->title('Team Viewing Issues');
   	            $this->stencil->paint('issues_view', array(
                      'heading' => 'Team Is Not Yet Viewable', 
                      'content' => "Teams in this league will not be viewable until : " . PLAYERS_VIEWABLE_DATETIME)); 
                    return; 
                }
            }  
        }
        else {
           if ($is_league_member) { 
               if ($is_team_owner) { 
                   $this->stencil->js('league_funcs');
                   $this->_paint_team($user_id, $team_details, $league_details, 'team_owner_view');
               }
               else { 
                   if (strtotime(PLAYERS_VIEWABLE_DATETIME) < time(null)) {  
                        $team_user_id = $this->team_model->get_team_user_id($team_details->team_id); 
                        $this->_paint_team($team_user_id, $team_details, $league_details, 'team_nonowner_view');
                   }
                   else { 
 	               $this->stencil->title('Team Viewing Issues');
   	               $this->stencil->paint('issues_view', array(
                         'heading' => 'Team Is Not Yet Viewable', 
                         'content' => "Teams in this league will not be viewable until : " . PLAYERS_VIEWABLE_DATETIME)); 
                       return;
                   } 
               }
           }
           else { 
 	        $this->stencil->title('Team Viewing Issues');
   	        $this->stencil->paint('issues_view', array(
                  'heading' => 'Team Is Private', 
                  'content' => 'The team you are trying to view is in a league that is private. 
                                You are not currently logged in. If you are a 
                                member of this league -- please log in to view the page. '));
                return; 
           } 
        }   
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
       if (strtotime(PLAYERS_VIEWABLE_DATETIME) <= time(null)) {  
           echo $this->team_model->save_team($params); 
       } 
       else { 
           echo 'failure';  
       } 
    }
    private function _paint_team($user_id, $team_details, $league_details, $view) { 
        $this->stencil->js('league_funcs');
        $data['league_name'] = $league_details['name']; 
        $data['league_id'] = $league_details['league_id']; 
        $data['team_details'] = $team_details; 
        $data['team_id'] = $team_details->team_id; 
        $data['team_name'] = $team_details->team_name; 
        $data['team_players'] = $this->league_model->get_team($user_id, $league_details['league_id']); 
        $this->stencil->paint($view,$data);
    } 
     
}
