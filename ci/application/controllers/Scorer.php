<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class player
{
    public $name;
    public $points;
    public $team;
    public $isQB;
    public $isK;
    public $teamQBStr; 
}

class Scorer extends CI_Controller {
    public function __construct()
    {
        parent::__construct();	
	$this->load->model('player_model');
    }
    
    public function index() 
    {
        $ch = curl_init("http://www.nfl.com/scores/2016/REG16");
        $options = array(
            CURLOPT_RETURNTRANSFER => true,
        );
        curl_setopt_array($ch, $options);
        $scores_page = curl_exec($ch);
        
        $pattern = '/gamecenter\/[0-9]*/';
        $game_ids = array(); 

        preg_match_all($pattern, $scores_page, $matches);
        
        foreach($matches[0] as $match)
        {
            $match = explode('/', $match);
            $match = $match[1];
            if (!isset($game_ids[$match]))
                $game_ids[$match] = $match;
        }
        foreach ($game_ids as $game_id)
        {
            $url = "http://www.nfl.com/liveupdate/game-center/$game_id/{$game_id}_gtd.json";
            echo "<br />$url <br />";
            $ch = curl_init($url);
            $options = array(
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER => array('Content-type: application/json') ,
            );
            curl_setopt_array($ch, $options);
            
            $json_results = curl_exec($ch);
            $game_object = json_decode($json_results);
        
            $defense_td_points = array();
            if ($game_object && $game_object->$game_id)
            {
                foreach($game_object->$game_id->scrsummary as $item)
                {
                    if ($item->type == 'TD' && (strstr($item->desc, "interception return") || strstr($item->desc, "interception return"))) { 
                        if (!isset($defense_td_points[$item->team])) 
                            $defense_td_points[$item->team] = 0; 

                        $defense_td_points[$item->team] += 6;
                    } 
                }
        
                $home_team_object = $game_object->$game_id->home->stats;
                $away_team_object = $game_object->$game_id->away->stats;
                $home_team_object->team_name = $game_object->$game_id->home->abbr;
                $away_team_object->team_name = $game_object->$game_id->away->abbr;
        
                // TODO readd
                $this->calc_by_team($home_team_object, $defense_td_points);
                $this->calc_by_team($away_team_object, $defense_td_points);
            }
        }
    }
    function is_player_qb($player_name, $player_team) 
    { 
        $name_part = explode('.', $player_name);
        $name_part =  "{$name_part[0]}%{$name_part[1]}";
        //$query = "SELECT position, full_name FROM players WHERE players.full_name LIKE '$name_part' AND players.pro_team = '$player_team'";
        //$result = mysql_query($query);
        //if (!$result)
        //    return false; 
        //$row = mysql_fetch_row($result);
        $row = $this->player_model->get_player_by_name_and_team($name_part, $player_team);
        echo 'test'; 
        echo $row; 
        print_r($row); 
        return $row['position'] == 'QB';
    }
    function add_passing_points(&$player_array, $player_object, $team_name, $name_str, $is_qb=false) 
    { 
        if (!isset($player_array[$name_str]))
        {
            $player_array[$name_str] = new player();
            $player_array[$name_str]->name = $name_str;
            $player_array[$name_str]->team = $team_name;
            $player_array[$name_str]->isQB = $is_qb;
        }
        $player_array[$name_str]->points += $this->calc_passing_points($player_object);       
    }
    function calc_by_team($team_object, $defense_td_points)
    {
        $week = "one";
        $player_array = array();
        $defense = 0; 
        if (isset($defense_td_points[$team_object->team_name])) 
            $defense = $defense_td_points[$team_object->team_name];
        $defense_fumble_points = 0;
        foreach ($team_object as $stat_type => $value)
        {
            if ($stat_type === 'passing')
            {
                foreach ($team_object->$stat_type as $player_object)
                {
                    if ($this->is_player_qb($player_object->name, $team_object->team_name))  { 
                        $name_str = $team_object->team_name . 'TQB'; 
                        $this->add_passing_points($player_array, $player_object, $team_object->team_name, $name_str, true); 
                    } 
                    else { 
                        $name_str = $player_object->name; 
                        $this->add_passing_points($player_array, $player_object, $team_object->team_name, $name_str); 
                        $name_str = $team_object->team_name . 'TQB'; 
                        $this->add_passing_points($player_array, $player_object, $team_object->team_name, $name_str); 
                    } 
                }
            }
            if ($stat_type === 'rushing' || $stat_type === 'receiving')
            {
                foreach ($team_object->$stat_type as $player_object)
                {
                    if ($this->is_player_qb($player_object->name, $team_object->team_name)) 
                        $name_str = $team_object->team_name . 'TQB'; 
                    else 
                        $name_str = $player_object->name; 
      
                    if (!isset($player_array[$name_str]))
                    {
                        $player_array[$name_str] = new player();
                        $player_array[$name_str]->name = $player_object->name;
                        $player_array[$name_str]->team = $team_object->team_name;
                    }
                    $player_array[$name_str]->points += $this->calc_rushing_receiving_points($player_object);       
                }
            }
            if ($stat_type === 'fumbles')
            {
                foreach ($team_object->$stat_type as $player_object)
                {
                    if ($this->is_player_qb($player_object->name, $team_object->team_name)) 
                        $name_str = $team_object->team_name . 'TQB'; 
                    else 
                        $name_str = $player_object->name;
     
                    if (!isset($player_array[$name_str]))
                    {
                        $player_array[$name_str] = new player();
                        $player_array[$name_str]->name = $player_object->name;
                        $player_array[$name_str]->team = $team_object->team_name;
                    }
                    $fpoints = $this->calc_fumble_points($player_object);
                    $player_array[$name_str]->points += $fpoints;      
                    if ($fpoints > 0)
                    {
                        $defense_fumble_points += $fpoints;
                    }
                }
            }
            if ($stat_type === 'kicking')
            {
                foreach ($team_object->$stat_type as $player_object)
                {
                    if (!isset($player_array["{$player_object->name}"]))
                    {
                        $player_array["{$player_object->name}"] = new player();
                        $player_array["{$player_object->name}"]->name = $player_object->name;
                        $player_array["{$player_object->name}"]->team = $team_object->team_name;
                        $player_array["{$player_object->name}"]->isK = true;
                    }
                    $player_array["{$player_object->name}"]->points += $this->calc_kicking_points($player_object);       
                }
            }
            //DEF-ST stats
            if ($stat_type === 'puntret' || $stat_type === 'kickret')
            {
                foreach ($team_object->$stat_type as $player_object)
                {
                    if (!isset($player_array["{$player_object->name}"]))
                    {
                        $player_array["{$player_object->name}"] = new player();
                        $player_array["{$player_object->name}"]->name = $player_object->name;
                        $player_array["{$player_object->name}"]->team = $team_object->team_name;
                    }
                    $return_points = $this->calc_return_points($player_object);
                    $player_array["{$player_object->name}"]->points += $return_points;      
                    $defense += $return_points; 
                }
            }
            if ($stat_type === 'defense')
            {
                foreach ($team_object->$stat_type as $player_object)
                {
                    $player_array["{$player_object->name}"] = new player();
                    $defense += $this->calc_defense_points($player_object);
                    $player_array["{$player_object->name}"]->points += $this->calc_defense_points($player_object);       
                }
            }
        }
        foreach ($player_array as $player)
        {
            $name_part = explode('.', $player->name);
            if (count($name_part) == 2) { 
                $name_part =  "{$name_part[0]}%{$name_part[1]}";
            }
            else{ 
                $name_part =  "{$name_part[0]}%";
            }
            if (strlen($name_part) > 1)
            {
                if ($player->isK)
                    //$query = "UPDATE players SET week_{$week}_points = {$player->points} WHERE players.position='K' AND players.pro_team = '{$player->team}'";
                    $this->player_model->update_points_by_week_position_and_team($player->points, $week, 'K', $player->team); 
                else if($player->isQB)
                    //$query = "UPDATE players SET week_{$week}_points = {$player->points} WHERE players.position='TQB' AND players.pro_team = '{$player->team}'";
                    $this->player_model->update_points_by_week_position_and_team($player->points, $week, 'TQB', $player->team); 
                else
                    $this->player_model->update_points_by_week_name_and_team($player->points, $week, $name_part, $player->team); 
                    //$query = "UPDATE players SET week_{$week}_points = {$player->points} WHERE players.full_name LIKE '$name_part' AND players.pro_team = '{$player->team}'";
    
                //mysql_query($query); 
    
                //echo $query;
                //echo "<br />";
            }
        }
        $defense += $defense_fumble_points;
        echo 'defense : ' . $defense; 
        $this->player_model->update_points_by_week_position_and_team($defense, $week, 'DST', $player->team); 
        //$defense_query = "UPDATE players SET week_{$week}_points = $defense WHERE players.position = 'DST' AND players.pro_team = '{$team_object->team_name}'";
        //mysql_query($defense_query); 
    
        //echo $defense_query;
        //echo "<br />";
    }
    
    function calc_passing_points($player_object)
    {
        $points = floor($player_object->yds / 25);
        $points += $player_object->tds * 4;
        $points += $player_object->twoptm * 2;
        $points -= $player_object->ints;
        return $points;
    }
    
    function calc_rushing_receiving_points($player_object)
    {
        $points = floor($player_object->yds / 10);
        if ($points < 0)
            $points = 0;
    
        $points += $player_object->tds * 6;
        $points += $player_object->twoptm * 2;
        return $points;
    }
    
    function calc_fumble_points($player_object)
    {
        $points = 0;
        $points -= $player_object->lost * 2;
        if ($player_object->lost == 0 && $player_object->tot == 0 && $player_object->rcv == 0)
            $points += $player_object->trcv * 2;
        return $points;
    }
    
    function calc_kicking_points($player_object)
    {
        $points = $player_object->fgm * 3;
        $points += $player_object->xpmade;
        return $points;
    }
    
    function calc_return_points($player_object)
    {
        $points = $player_object->tds * 6;
        return $points;
    }
    
    /*
    Sack    1
    Interception    2
    Fumble Recovery 2
    Touchdown   6
    Safety  2
    Block Kick  2
    Kickoff and Punt Return Touchdowns  6
    */
    function calc_defense_points($player_object)
    {
        $points = 0; 
        if (isset($player_object->tds)) { 
            $points = $player_object->tds * 6;
        } 
        $points += $player_object->sk;
        $points += $player_object->int * 2;
    
        return $points;
    }
}
