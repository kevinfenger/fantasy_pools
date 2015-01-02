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
    public function get_teams_by_user() 
    {
$ch = curl_init();

// set URL and other appropriate options
curl_setopt($ch, CURLOPT_URL, "http://api.cbssports.com/fantasy/players/list?version=3.0&SPORT=football&response_format=json");
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
// grab URL and pass it to the browser
$result = curl_exec($ch);

$players = json_decode($result);
$players = $players->body->players;
//print_r($players); 
foreach ($players as $player) { 
    if (isset($player->icons->headline)) 
        $headline = $player->icons->headline;
    else 
        $headline = "";
    if (!empty($player->firstname)) 
        $first_name = $player->firstname; 
    else 
        $first_name = $player->lastname; 
    $sql = "INSERT INTO players (position,full_name,first_name,last_name,pro_team, notes)  VALUES(?,?,?,?,?,?)"; 
    $this->db->query($sql, array($player->position, $player->fullname, $first_name, $player->lastname, $player->pro_team, $headline));  
} 
//print_r($players); 
// close cURL resource, and free up system resources
curl_close($ch); 
    } 
}
