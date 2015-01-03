<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class League_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    }

    public function create_league($input) 
    {
        $is_private = (boolean)$input['private_league']; 
        if ($is_private) { 
            $sql = 'INSERT INTO leagues (name, league_password, visibility, commissioner_id, created) VALUES(?,?,?,?,NOW())'; 
            $this->db->query($sql, array($input['league_name'], 
                                         $input['league_password'], 
                                         LEAGUE_PRIVATE_VISIBILITY, 
                                         $this->session->userdata('id'))); 
        }
        else { 
            $sql = 'INSERT INTO leagues (name, visibility, commissioner_id, created) VALUES(?,?,?,NOW())'; 
            $this->db->query($sql, array($input['league_name'], 
                                         LEAGUE_PUBLIC_VISIBILITY, 
                                         $this->session->userdata('id'))); 

        }
        $league_id = $this->db->insert_id();
        $team_params['team_name'] = $input['team_name']; 
        $team_params['league_id'] = $league_id; 
        $this->add_team_to_league($team_params); 
        
        $this->db->query("INSERT INTO league2position VALUES($league_id, 1)"); 
        $this->db->query("INSERT INTO league2position VALUES($league_id, 2)"); 
        $this->db->query("INSERT INTO league2position VALUES($league_id, 2)"); 
        $this->db->query("INSERT INTO league2position VALUES($league_id, 3)"); 
        $this->db->query("INSERT INTO league2position VALUES($league_id, 3)"); 
        $this->db->query("INSERT INTO league2position VALUES($league_id, 4)"); 
        $this->db->query("INSERT INTO league2position VALUES($league_id, 5)"); 
        $this->db->query("INSERT INTO league2position VALUES($league_id, 6)"); 
 
        return $league_id;  
    }
    public function get_public_leagues() 
    { 
       $this->db->select('l.name, l.league_id, l.number_of_members, l.max_members, l.image, l.commissioner_id, l.created, u.first_name, u.last_name');
       $this->db->join('users u', 'u.id = l.commissioner_id');  
       $query = $this->db->get_where('leagues l', array('l.visibility' => LEAGUE_PUBLIC_VISIBILITY));
       
       return $query->result_array();  
    }
    public function get_league_details($league_id) 
    { 
       $this->db->select('l.name, l.league_id, l.number_of_members, l.max_members, l.image, l.commissioner_id, l.created');
       $query = $this->db->get_where('leagues l', array('l.league_id' => $league_id));

       return $query->row_array(); 
    } 
    public function get_teams_in_league($league_id) 
    { 
       $this->db->select('t.team_name, t.team_id, u.first_name, u.last_name');
       $this->db->join('users u', 't.owner_id = u.id'); 
       $query = $this->db->get_where('teams t', array('t.league_id' => $league_id));

       return $query->result_array(); 
    } 
    public function get_team($user_id, $league_id) 
    { 
//       $this->db->select('league_id');
//       $query = $this->db->get_where('teams', array('owner_id' => $user_id, 'league_id' => $league_id));
         $this->db->join('league2position l2p',"p.position_id = l2p.position_id AND l2p.league_id = $league_id");
         $query = $this->db->get_where('positions p');
         $positions = $query->result_array(); 
         
         $this->db->select('team_id'); 
         $query = $this->db->get_where('teams', array('owner_id' => $user_id, 'league_id' => $league_id));
         $row = $query->row_array(); 
         $team_id = $row['team_id']; 

         $this->db->select('p.*'); 
         $this->db->join('team2player t2p', "p.player_id = t2p.player_id AND t2p.team_id = $team_id"); 
         $query = $this->db->get_where('players p');
         $players = $query->result_array();  
         $results = array(); 
         foreach ($positions as $position) {
            $player_found = null;
            foreach ($players as $i => $player) {  
                if ($player['position'] == $position['position_short_description']) { 
                    $player_found = $player; 
                    $results[] = array('position' => $position, 'player' => $player_found); 
                    unset($players[$i]);
                    break;  
                }
            }
            if (empty($player_found)) 
                $results[] = array('position' => $position, 'player' => $player_found); 
            $player_found = null; 
         }
         return $results;  
    }
    public function get_team_id_by_user_and_league($user_id, $league_id) 
    { 
         $this->db->select('team_id'); 
         $query = $this->db->get_where('teams', array('owner_id' => $user_id, 'league_id' => $league_id));
         $row = $query->row_array(); 
         return $row['team_id']; 

    }
    public function add_team_to_league($params) 
    { 
        $team_name = $params['team_name']; 
        $league_id = $params['league_id']; 
        $owner_id  = $this->session->userdata('id');
        $sql = 'INSERT INTO teams (owner_id, league_id, team_name, created) VALUES(?,?,?,NOW())'; 
        $this->db->query($sql, array($owner_id, $league_id, $team_name)); 
        
        $team_id = $this->db->insert_id();
        $sql = "UPDATE leagues SET number_of_members = number_of_members + 1 WHERE league_id = $league_id"; 
        $this->db->query($sql);
 
        return $team_id;  
    }
    /*public function is_user_already_in_league($league_id, $user_id) 
    { 
       $this->db->select('team_id');
       $query = $this->db->get_where('teams', array('owner_id' => $user_id, 'league_id' => $league_id));
       
       return $query->num_rows() > 0; 
    } */ 
    public function is_league_public($league_id=null) 
    {
       $this->db->select('visibility');
       $query = $this->db->get_where('leagues', array('league_id' => $league_id));
       
       if ($query->num_rows() == 0) 
           return false;
  
       $row = $query->row();
       return $row->visibility == LEAGUE_PUBLIC_VISIBILITY;  
    }
    public function does_league_exist($league_id) 
    { 
       $this->db->select('league_id');
       $query = $this->db->get_where('leagues', array('league_id' => $league_id));
       
       return $query->num_rows() > 0; 
    }
    public function is_league_member($league_id, $user_id) 
    { 
       $this->db->select('team_id');
       $query = $this->db->get_where('teams', array('owner_id' => $user_id, 'league_id' => $league_id));
       
       return $query->num_rows() > 0; 
    }    
}
