<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Player_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    }
    public function get_players_by_position($position) 
    {
       //$this->db->where_in('pro_team', array('IND','DEN','CIN','PIT','NE','BAL','GB','SEA','ARI','CAR','DET','DAL'));  
       $this->db->where('selectable', 1);  
       $this->db->order_by('pro_team'); 
       $query = $this->db->get_where('players', array('position' => $position));
       return $query->result_array(); 

    }
    public function get_player_by_name_and_team($first_name, $last_name, $team) 
    { 
       $this->db->select('*');
       $this->db->like('first_name', $first_name, 'after'); 
       $this->db->like('last_name', $last_name, 'after'); 
       $this->db->where('pro_team', $team); 
       $row = $this->db->get('players')->row_array();
       return $row; 
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
