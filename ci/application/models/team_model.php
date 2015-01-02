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
 
       $this->db->select('t.team_name, t.team_image, l.name, l.league_id');
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
}
