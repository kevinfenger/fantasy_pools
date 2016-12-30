$(function() {
   $("#join_league_by_id_button").click(function(){
       var pw_value = #("#league_password").val(); 
       var id_value = #("#league_id").val();
       pathArray = window.location.href.split('/');
       host = pathArray[2];
       url = 'https://' + host;
       window.location.replace(url+"/league/register_team?league_id="+id_value+"&league_pw="+pw_value); 
   }); 

}); 
