$(function() {
    $('#fb_login').facebook_login({
          appId: '381563401983454',  
          endpoint: '/sessions/new',      
          onSuccess: function(data) {},   
          onError: function(data) {},      
          permissions: 'read_stream'      
   });
   $('#fb_login_two').facebook_login({
          appId: '381563401983454',  
          endpoint: '/sessions/new',      
          onSuccess: function(data) {},   
          onError: function(data) {},      
          permissions: 'read_stream'      
   });
   $("#ca_link").click(function() {
       $("#ca_tab").addClass("active");
       $("#login_tab").removeClass("active");  
   });
   $("#login_with_us").click(function() {
       $("#fp_login").toggleClass("hidden");
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
                                  $("#first_name_verify").css({ "background-image": "url('/assets/img/yes.png')", "background-repeat": "no-repeat" });
                                  $("#first_name_verify").html(''); 
                              }
                              else
                              {
                                  $("#first_name_verify").css({ "background-image": "url('/assets/img/no.png')", "background-repeat": "no-repeat" });
                                  $("#first_name_verify").html(msg); 
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
                                  $("#email_verify").css({ "background-image": "url('/assets/img/yes.png')", "background-repeat": "no-repeat" });
                                  $("#email_verify").html(''); 
                              }
                              else
                              {
                                  $("#email_verify").css({ "background-image": "url('/assets/img/no.png')", "background-repeat": "no-repeat" });
                                  $("#email_verify").html(msg); 
                              }
                          }
           });
   });
});
