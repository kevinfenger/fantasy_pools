<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cbs_model extends CI_Model {
    public function __construct()
    {
        parent::__construct();
    }
    
    function get_headlines() 
    { 

    }
 
    function get_player_list() 
    { 
        // TODO lets store these things, and if we haven't updated in the last 5 minutes 
        // update, and store the new lines 
        try { 
        } 
        catch (Exception $e) { 

        }
    }
    public function get_headlines() 
    { 
       $ch = curl_init();
       curl_setopt($ch, CURLOPT_URL, "http://api.cbssports.com/fantasy/players/list?version=3.0&SPORT=football&response_format=json");
       curl_setopt($ch, CURLOPT_HEADER, 0);
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
       $result = curl_exec($ch);

       $headlines = json_decode($result);
       $headlines = $players->body->headlines;
       curl_close($ch); 

    }


}
