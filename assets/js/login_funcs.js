$(function() {
    $('#fb_login').facebook_login({
          appId: '381563401983454',  
          permissions: 'read_stream'      
   });
   $('#fb_login_two').facebook_login({
          appId: '381563401983454',  
          permissions: 'read_stream'      
   });
   $("#ca_link").click(function() {
       $("#ca_tab").addClass("active");
       $("#login_tab").removeClass("active");  
   });
   $("#login_with_us").click(function() {
       $("#fp_login").toggleClass("hidden");
   });
   $("#logout").click(function() { 
       $.ajax({ 
             type: "POST"
           , url:  "/user/logout"
           , success: function(msg) { window.location.replace("http://fantasy.kevinfenger.com/"); }
       }); 
   });
   $("#first_name").keyup(function(){
           $.ajax({
                 type: "POST"
               , url: "/user/check_name"
               , data: "name="+$("#first_name").val()
               , success: function(msg) 
                          {
                              if(msg == 'success')
                              {
                                  $("#first_name").addClass('valid'); 
                                  $("#first_name").removeClass('invalid'); 
                                  $("#first_name_verify_txt").html(''); 
                              }
                              else
                              {
                                  $("#first_name").addClass('invalid'); 
                                  $("#first_name").removeClass('valid'); 
                                  $("#first_name_verify_txt").css({ "color": "red", "font-weight":"normal","font-style":"italic","font-size":"14px"}); 
                                  $("#first_name_verify_txt").html(msg); 
                              }
                          }
           });
   });
   $("#last_name").keyup(function(){
           $.ajax({
                 type: "POST"
               , url: "/user/check_name"
               , data: "name="+$("#last_name").val()
               , success: function(msg) 
                          {
                              if(msg == 'success')
                              {
                                  $("#last_name").addClass('valid'); 
                                  $("#last_name").removeClass('invalid'); 
                                  $("#last_name_verify_txt").html(''); 
                              }
                              else
                              {
                                  $("#last_name").addClass('invalid'); 
                                  $("#last_name").removeClass('valid'); 
                                  $("#last_name_verify_txt").css({ "color": "red", "font-weight":"normal","font-style":"italic","font-size":"14px"}); 
                                  $("#last_name_verify_txt").html(msg); 
                              }
                          }
           });
   });
   $("#email").keyup(function(){
           $.ajax({
                 type: "POST"
               , url: "/user/check_email"
               , data: "email="+$("#email").val()
               , success: function(msg) 
                          {
                              if(msg == 'success')
                              {
                                  $("#email").addClass('valid'); 
                                  $("#email").removeClass('invalid'); 
                                  $("#email_verify_txt").html(''); 
                              }
                              else
                              {
                                  $("#email").addClass('invalid'); 
                                  $("#email").removeClass('valid'); 
                                  $("#email_verify_txt").css({ "color": "red", "font-weight":"normal","font-style":"italic","font-size":"14px"}); 
                                  $("#email_verify_txt").html(msg); 
                              }
                          }
           });
   });
});
