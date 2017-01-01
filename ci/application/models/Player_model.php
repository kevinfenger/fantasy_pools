<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Player_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    }
    public function get_players_by_position($position) 
    {
       $this->db->where_in('pro_team', array('IND','DEN','CIN','PIT','NE','BAL','GB','SEA','ARI','CAR','DET','DAL'));  
       $this->db->order_by('pro_team'); 
       $query = $this->db->get_where('players', array('position' => $position));
       return $query->result_array(); 

    }
    public function get_player_by_name_and_team($name, $team) 
    { 
       $this->db->select('*');
       $this->db->from('players'); 
       $this->db->like('full_name', $name); 
       $this->db->where('pro_team', $team); 
       return $this->db->get()->row_array();
    }  
    public function update_points_by_week_position_and_team($points, $week, $position, $team) 
    {
        $sql = "UPDATE players SET week_{$week}_points = {$points} WHERE players.position='{$position}' AND players.pro_team = '{$team}'"; 
        $this->db->query($sql);
    } 
    public function update_points_by_week_name_and_team($points, $week, $name, $team) 
    { 
        $sql = "UPDATE players SET week_{$week}_points = {$points} WHERE players.full_name LIKE '$name' AND players.pro_team = '{$team}'"; 
        $this->db->query($sql);
    }  
}
