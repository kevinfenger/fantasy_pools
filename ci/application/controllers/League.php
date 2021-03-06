<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class League extends CI_Controller {
    public function __construct()
    {
        parent::__construct();	
	$this->load->model('league_model');
    }
    
    public function index() 
    { 
	$this->stencil->slice('head');
	$this->stencil->slice('header');
        $params = $this->input->get(); 
        if (!($params) || !array_key_exists('league_id', $params)) { 
 	    $this->stencil->title('League Viewing Issues');
   	    $this->stencil->paint('issues_view', array('heading' => 'League Does Not Exist', 'content' => 'The league you are trying to view does not exist.'));
            return; 
        }
        $league_id = $params['league_id'];
 
	$this->stencil->layout('league_layout');
	$this->stencil->css('font-awesome');

        if (!($this->league_model->does_league_exist($league_id))) { 
 	    $this->stencil->title('League Viewing Issues');
   	    $this->stencil->paint('issues_view', array('heading' => 'League Does Not Exist', 'content' => 'The league you are trying to view does not exist.'));
            return; 
        }
        $user_id = $this->session->userdata('id') ? $this->session->userdata('id') : 0;
        $is_public_league = $this->league_model->is_league_public($params['league_id']);
        if (!$user_id) { 
            if (!$is_public_league) {
 	        $this->stencil->title('League Viewing Issues');
   	        $this->stencil->paint(
                  'issues_view', array('heading' => 'League Is Private', 'content' => 'The league you are trying to view is private. 
                                                                                                                          You are not currently logged in. If you are a 
                                                                                                                          member of this league -- please log in to view the page. '));
                return; 
            } 
            $league_details = $this->league_model->get_league_details($league_id); 
            $data['name'] = $league_details['name']; 
            $data['teams'] = $this->league_model->get_teams_in_league($league_id);
            $this->stencil->slice(array('sidebar' => 'sidebar_no_team'));
            $this->stencil->paint('league_view', $data);
            return; 
        }
        else { 
            $is_league_member = $this->league_model->is_league_member($league_id, $user_id);
            if (!$is_league_member && !$is_public_league) { 
 	        $this->stencil->title('League Viewing Issues');
   	        $this->stencil->paint('issues_view', array('heading' => 'League Is Private', 'content' => 'The league you are trying to view is private.'));
                return; 
            }
            if (!$is_league_member && $is_public_league) { 
                // Load up the page, but do not load up the sidebar with team information
		$league_details = $this->league_model->get_league_details($league_id); 
		$data['name'] = $league_details['name']; 
		$data['teams'] = $this->league_model->get_teams_in_league($league_id);
		$this->stencil->slice(array('sidebar' => 'sidebar_no_team'));
		$this->stencil->paint('league_view', $data);
                return;  
            } 
            if ($is_league_member) { 
                // Load up the page, and load up team info
                $this->stencil->slice('header_league_nav');
                $league_details = $this->league_model->get_league_details($league_id); 
                $this->stencil->js('league_funcs');
                $data['league_details'] = $league_details; 
                $data['name'] = $league_details['name']; 
                $data['teams'] = $this->league_model->get_teams_in_league($league_id);
                $this->stencil->data('my_team', $this->league_model->get_team($user_id, $league_id)); 
                $this->stencil->data('team_id', $this->league_model->get_team_id_by_user_and_league($user_id, $league_id));  
                $this->stencil->slice(array('sidebar' => 'sidebar_team_info'));
                $this->stencil->paint('league_view', $data);
                return; 
            }  
        }   
    }
    public function edit_settings() { 
        $params = $this->input->get(); 
        $league_id = $params['league_id']; 
        $user_id = $this->session->userdata('id') ? $this->session->userdata('id') : 0;
        if (!($this->league_model->does_league_exist($league_id))) { 
 	    $this->stencil->title('League Viewing Issues');
   	    $this->stencil->paint('issues_view', array('heading' => 'League Does Not Exist', 'content' => 'The league you are trying to view does not exist.'));
            return; 
        }
        $is_commish = $this->league_model->is_league_comish($league_id, $user_id);
        if (!$is_commish) { 
 	    $this->stencil->title('League Viewing Issues');
   	    $this->stencil->paint('issues_view', array('heading' => 'Invalid Privileges!', 'content' => 'Only commissioners can edit league settings.'));
            return; 
        } 
	$this->stencil->slice('head');
	$this->stencil->slice('header');
        $this->stencil->slice('header_league_nav');
	$this->stencil->layout('league_layout');
        $this->stencil->js('league_funcs');
	$this->stencil->css('font-awesome');
        $league_details = $this->league_model->get_league_details($league_id); 
	$data['league_details'] = $league_details; 
	$data['teams'] = $this->league_model->get_teams_in_league($league_id);
        $this->stencil->paint('edit_league_settings_view', $data);
    } 
    public function add_team_to_league() 
    { 
        $team_name = $this->input->post('team_name'); 
        $league_id = $this->input->post('league_id'); 
        $params = $this->input->post(); 
        $team_id = $this->league_model->add_team_to_league($params); 
        
        if ($team_id) 
           echo 'success';
        else 
           echo 'something went wrong in team creation, please try again';  
    }  
    public function check_league_name() 
    { 
        $league_name = $this->input->post('league_name'); 
        if (strlen($league_name) < 5)
            echo "league names must be at least 5 characters";
        else if (preg_match('/[^0-9A-Za-z\s]/',$league_name))
            echo 'valid characters are all upper/lowercase letters and numbers 0-9'; 
        else 
            echo 'success'; 
    }
    public function check_league_password() 
    { 
        $league_password = $this->input->post('league_password'); 
        if (strlen($league_password) < 3)
            echo "league passwords must be at least 3 characters";
        else if (preg_match('/[^0-9A-Za-z]/',$league_password))
            echo 'valid characters are all upper/lowercase letters and numbers 0-9'; 
        else 
            echo 'success'; 
    }
    public function check_team_name() 
    { 
        $team_name = $this->input->post('team_name'); 
        if (strlen($team_name) < 5)
            echo "team names must be at least 5 characters";
        else if (preg_match('/[^0-9A-Za-z]/',$team_name))
            echo 'valid characters are all upper/lowercase letters and numbers 0-9'; 
        else 
            echo 'success'; 
    }
    public function create_league() 
    {
       $params = $this->input->post(); 
       $league_id = $this->league_model->create_league($params);  
       $rv = array('league_id' => $league_id); 
       echo json_encode($rv); 
    } 
    public function update_league() 
    {
       $params = $this->input->post(); 
       $success = $this->league_model->update_league($params); 
       if ($success) { 
           echo json_encode(array('message' => 'success')); 
       } 
       else { 
           // TODO function this  
           header('HTTP/1.1 500 Internal Server Something went wrong'); 
           die(json_encode(array('message' => 'ERROR', 'code' => 500)));
       }
    } 
    public function join() 
    { 
	$this->stencil->slice('head');
	$this->stencil->slice('header');
	$this->stencil->layout('standard_layout');
	$this->stencil->css('font-awesome');
        $this->stencil->js('join_league_funcs');
        if ($this->session->userdata('id')) {  
 	    $this->stencil->title('Join League');
            $leagues = $this->league_model->get_public_leagues(); 
            $data['leagues'] = $leagues; 
            $this->stencil->paint('join_league_view', $data);
        }
        else { 
 	    $this->stencil->title('Not Logged In');
   	    $this->stencil->paint('not_logged_in_view');
        } 
    }
    public function create_pff_league()
    {
	$this->stencil->slice('head');
	$this->stencil->slice('header');
	$this->stencil->layout('standard_layout');
	$this->stencil->css('font-awesome');
        $this->stencil->js('league_funcs');
        
        if ($this->session->userdata('id')) {  
           $this->stencil->title('Playoff Fantasy Football League Creator');
   	   $this->stencil->paint('create_pff_view');
        } 
        else { 
           $this->stencil->title('Not Logged In');
   	   $this->stencil->paint('not_logged_in_view');
        }
    }
    public function register_team() 
    { 
        $params = $this->input->get(); 
        $this->stencil->slice('head');
        $this->stencil->slice('header');
        $this->stencil->layout('standard_layout');
        $this->stencil->css('font-awesome');
        $this->stencil->js('league_funcs');
        $user_id = $this->session->userdata('id'); 
        $league_id = $params['league_id']; 
        $entered_password = null; 
        if (array_key_exists('league_pw', $params)) { 
            $entered_password = $params['league_pw'];  
        }
        if ($user_id) {  
           if ($this->league_model->is_league_member($league_id, $user_id)) { 
 	        $this->stencil->title('Already Joined the League');
   	        $this->stencil->paint('issues_view', array('heading' => 'Already Joined the League', 'content' => 'You currently can not register two teams under the same owner for a league.'));
                return; 
           }
           $league_info = $this->league_model->get_league_details($league_id);
           if ($league_info == null) { 
 	       $this->stencil->title('League Does Not Exist');
               $this->stencil->paint('issues_view', array('heading' => 'League Does Not Exist', 'content' => 'Could not find league, <a href="/league/join">try again</a>'));
               return; 
           } 
           $league_password = $league_info['league_password'];
           if ($league_password && strlen($league_password) > 0) { 
               if ($league_password != $entered_password) { 
 	           $this->stencil->title('Invalid Password');
                   $this->stencil->paint('issues_view', array('heading' => 'Invalid Password', 'content' => 'Invalid Password, <a href="/league/join">try again</a>'));
                   return; 
               } 
           }
           if ($league_info['number_of_members'] >= $league_info['max_members']) { 
 	       $this->stencil->title('League is full');
               $this->stencil->paint(
                 'issues_view', 
                 array('heading' => 'League Is Full', 
                       'content' => 'Try a different league, <a href="/league/join">here</a>. Or ask your commissioner to raise the limit.')
               );
               return; 
           }  
           $data['league_name'] = $league_info['name']; 
           $data['league_id'] = $league_info['league_id'];  
           $this->stencil->title('Register Team');
   	   $this->stencil->paint('register_team_view', $data);
        } 
        else {  
           $this->stencil->title('Not Logged In');
   	   $this->stencil->paint('not_logged_in_view');
        }
    }
        
}

/* End of file home.php */
/* Location: ./application/controllers/home.php */
