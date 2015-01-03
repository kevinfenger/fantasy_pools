<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Team_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    }
    public function get_teams_by_user() 
    { 
       $user_id  = $this->session->userdata('id');
       if (!$user_id)
           return null;
 
       $this->db->select('t.team_name, t.team_id, t.team_image, l.name, l.league_id');
       $this->db->join('leagues l', 'l.league_id = t.league_id'); 
       $query = $this->db->get_where('teams t', array('t.owner_id' => $user_id));

       return $query->result_array(); 
     
    }
    public function get_team($team_id) 
    { 
       $this->db->select('league_id');
       $query = $this->db->get_where('teams', array('t.team_id' => $team_id));
    }
    public function save_team($params) 
    { 
        $player_id_array = explode(',', $params['player_ids']);
        $team_id = $params['team_id']; 
        $this->db->query("DELETE FROM team2player WHERE team_id = $team_id"); 
        foreach ($player_id_array as $pi) 
        {
            $sql = 'INSERT IGNORE INTO team2player (team_id, player_id) VALUES(?,?)'; 
            $this->db->query($sql, array($params['team_id'], $pi)); 
        }
        return $this->db->last_query(); 
    }
    public function does_team_exist($team_id) 
    { 
       $this->db->select('team_id');
       $query = $this->db->get_where('teams', array('team_id' => $team_id));
       
       return $query->num_rows() > 0; 
    }
    public function get_league_id($team_id) 
    { 
       $this->db->select('league_id');
       $query = $this->db->get_where('teams', array('team_id' => $team_id));
       $row = $query->row();
       return $row->league_id; 
    }
    public function is_team_owner($user_id, $team_id) 
    { 
       $this->db->select('team_id');
       $query = $this->db->get_where('teams', array('team_id' => $team_id, 'owner_id' => $user_id));
       
       return $query->num_rows() > 0; 

    }  
    public function get_team_user_id($team_id) 
    { 
       $this->db->select('owner_id');
       $query = $this->db->get_where('teams', array('team_id' => $team_id));
       $row = $query->row();
       return $row->owner_id; 

    }   
    public function get_team_details($team_id) 
    { 
       $query = $this->db->get_where('teams', array('team_id' => $team_id));
       $row = $query->row();
       return $row; 

    }   
/*    public function is_league_public($team_id) 
    { 
       $this->db->select('l.visibility');
       $this->db->join('teams t', "t.team_id = $team_id AND t.u
       $query = $this->db->get_where('leagues l', array('league_id' => $league_id));
       
       $row = $query->row();
       return $row->visibility == LEAGUE_PUBLIC_VISIBILITY;  
    }*/ 
}
