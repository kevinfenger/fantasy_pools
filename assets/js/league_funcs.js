$(function() {
   var is_private = 0;
   var position = "";
   var selected_player_row = null;  
   $("#team_info button").click(function() {
       selected_player_row = $(this).closest('tr');  
       position = ($(this).closest('tr').find('.player_position').text());
   });
   $("#modal_table tbody").on('click','tr', function() { 
                               player_full_name = $(this).find('.player_full_name').text(); 
                               player_team = $(this).find('.player_team').text(); 
                               player_id = $(this).attr('id'); 
                               selected_player_row.find('.player_name').html(player_full_name); 
                               selected_player_row.find('.player_team').html(player_team); 
                               selected_player_row.find('.sel_play').html('Change');
                               selected_player_row.attr('value',player_id); 
                               $('#choose_player_modal').modal('toggle');  
                               $.fn.save_team(); 
                          });  
   $('#choose_player_modal').on('show.bs.modal', function (event) {
			    $('#modal_table tbody tr').remove();
			    $('#choose_player_modal #loading').show(); 
       $.ajax({
               type: "GET"
             , url: "/player/players_by_position?position="+position
             , dataType: "json" 
             , success: function(json_data)
                        {
                            $('.modal-title').text('Select a '+position);
			    var table_obj = $('#modal_table');
			    $('#choose_player_modal #loading').hide(); 
			    $('#modal_table tbody tr').remove();
			    $.each(json_data, function(index, item){
				    var table_row = $('<tr style="cursor:pointer">');
                                    table_row.addClass('player_id'); 
                                    table_row.attr('id', item.player_id); 
				    var table_cell = $('<td>', {html: item.pro_team});
                                    table_cell.addClass("player_team"); 
				    table_row.append(table_cell);
				    var table_cell = $('<td>', {html: item.full_name});
                                    table_cell.addClass("player_full_name"); 
				    table_row.append(table_cell);
				    var table_cell = $('<td>', {html: item.notes});
				    table_row.append(table_cell);
				    $('#modal_table tbody').append(table_row);
			    })
                        }
       });
   });  
   $("#register_team_button").click(function() { 
       if ($(".valid").length < 1) {
           $.fn.team_name_check();
       }
       else {
          $.ajax({
               type: "POST"
             , url: "/league/add_team_to_league"
             , data: ({ league_id: $("#league_id").val(), team_name: $("#team_name").val() })
             , success: function(msg) 
                        {
                            if(msg == 'success') {
                                pathArray = window.location.href.split( '/' );
                                protocol = pathArray[0];
                                host = pathArray[2];
                                url = protocol + '//' + host;
                                window.location.replace(url+"/league?league_id="+$("#league_id").val()); 
                            } 
                            else { 
                                  $("#unable_to_register_txt").css({ "color": "red", "font-weight":"normal","font-style":"italic","font-size":"14px"}); 
                                  $("#unable_to_register_txt").html(msg); 
                            }
                        }
           });
        }
   }); 
   $("#create_league_button").click(function(){
       if (is_private && $(".valid").length < 3) { 
           $.fn.league_name_check();
           $.fn.team_name_check();
           $.fn.league_password_check();
       }
       else if ($(".valid").length < 2) {
           $.fn.league_name_check();
           $.fn.team_name_check();
       }
       else {
          $.ajax({
               type: "POST"
             , url: "/league/create_league"
             , data: ({ team_name: $("#team_name").val(), league_name: $("#league_name").val(), private_league: is_private, league_password: $("#league_password").val() })
             , dataType: "json" 
             , success: function(msg) 
                        {
                            pathArray = window.location.href.split( '/' );
                            protocol = pathArray[0];
                            host = pathArray[2];
                            url = protocol + '//' + host;
                            window.location.replace(url+"/league?league_id="+msg['league_id']); 
                        }
           });
        }
   });
   $("#join_league_by_id_button").click(function(){
       var pw_value = #("#league_password").val(); 
       var id_value = #("#league_id").val();
       pathArray = window.location.href.split('/');
       host = pathArray[2];
       url = 'https://' + host;
       window.location.replace(url+"/league/register_team?league_id="+id_value+"&league_pw="+pw_value); 
   }); 
   $("#league_password").keyup(function(){ $.fn.league_password_check(); });
   $("#league_name").keyup(function(){ $.fn.league_name_check(); });
   $("#league_password").change(function(){ $.fn.league_password_check(); });
   $("#league_name").change(function(){ $.fn.league_name_check(); });
   $("#team_name").change(function(){ $.fn.team_name_check(); });
   $("#team_name").keyup(function(){ $.fn.team_name_check(); });
   $.fn.save_team = function() {
       player_ids = []; 
       team_id_val = $("#team_id_holder").attr('value');  
       rows = $("#team_info > tbody > tr");
       rows.each(function() { 
           player_id = $(this).attr('value');
           if (player_id > 0) {  
               player_ids.push(player_id); 
           } 
       });  
       player_id_csl = player_ids.join(","); 
       $.ajax({
                 type: "POST"
               , url: "/team/save_team"
               , data: ({ team_id:team_id_val, player_ids:player_id_csl }) 
               , success: function(msg) 
                          {
                              if(msg == 'success')
                              {
                              }
                              else
                              {
                              }
                          }
       });
   } 
   $.fn.league_password_check = function() { 
           $.ajax({
                 type: "POST"
               , url: "/league/check_league_password"
               , data: "league_password="+$("#league_password").val()
               , success: function(msg) 
                          {
                              if(msg == 'success')
                              {
                                  $("#league_password").addClass('valid'); 
                                  $("#league_password").removeClass('invalid'); 
                                  $("#league_password_verify_txt").html(''); 
                              }
                              else
                              {
                                  $("#league_password").addClass('invalid'); 
                                  $("#league_password").removeClass('valid'); 
                                  $("#league_password_verify_txt").css({ "color": "red", "font-weight":"normal","font-style":"italic","font-size":"14px"}); 
                                  $("#league_password_verify_txt").html(msg); 
                              }
                          }
           });

   } 
   $.fn.league_name_check = function() { 
           $.ajax({
                 type: "POST"
               , url: "/league/check_league_name"
               , data: "league_name="+$("#league_name").val()
               , success: function(msg) 
                          {
                              if(msg == 'success')
                              {
                                  $("#league_name").addClass('valid'); 
                                  $("#league_name").removeClass('invalid'); 
                                  $("#league_name_verify_txt").html(''); 
                              }
                              else
                              {
                                  $("#league_name").addClass('invalid'); 
                                  $("#league_name").removeClass('valid'); 
                                  $("#league_name_verify_txt").css({ "color": "red", "font-weight":"normal","font-style":"italic","font-size":"14px"}); 
                                  $("#league_name_verify_txt").html(msg); 
                              }
                          }
           });

   } 
   $.fn.team_name_check = function() { 
           $.ajax({
                 type: "POST"
               , url: "/league/check_team_name"
               , data: "team_name="+$("#team_name").val()
               , success: function(msg) 
                          {
                              if(msg == 'success')
                              {
                                  $("#team_name").addClass('valid'); 
                                  $("#team_name").removeClass('invalid'); 
                                  $("#team_name_verify_txt").html(''); 
                              }
                              else
                              {
                                  $("#team_name").addClass('invalid'); 
                                  $("#team_name").removeClass('valid'); 
                                  $("#team_name_verify_txt").css({ "color": "red", "font-weight":"normal","font-style":"italic","font-size":"14px"}); 
                                  $("#team_name_verify_txt").html(msg); 
                              }
                          }
           });

   } 
   $( ":radio" ).change(function() { 
       var myRadio = $('input[name=optionsRadios]');
       var checked = myRadio.filter(':checked').val();
       if (checked == 2) {  
           is_private = 1;
           $("#league_password_control_group").toggle();  
       } 
       else { 
           is_private = 0; 
           $("#league_password_control_group").toggle();  
       }
   });  
});
