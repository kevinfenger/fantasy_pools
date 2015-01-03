$(function() {
    var errors = false; 
/*    $("#password_one").addClass('invalid'); 
    $("#confirm_password").addClass('invalid'); 
    $("#email").addClass('invalid'); 
    $("#first_name").addClass('invalid'); 
    $("#last_name").addClass('invalid'); */ 

    $('#fb_login').facebook_login({
          appId: '381563401983454',  
          permissions: 'read_stream,email',
          onSuccess: function(msg) { 
              pathArray = window.location.href.split( '/' );
              protocol = pathArray[0];
              host = pathArray[2];
              url = protocol + '//' + host;
              window.location.replace(url); 
          }
   });
   $('#fb_login_two').facebook_login({
          appId: '381563401983454',  
          permissions: 'read_stream,email', 
          onSuccess: function(msg) { 
              pathArray = window.location.href.split( '/' );
              protocol = pathArray[0];
              host = pathArray[2];
              url = protocol + '//' + host;
              window.location.replace(url); 
          }
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
           , success: function(msg) { 
                 pathArray = window.location.href.split( '/' );
                 protocol = pathArray[0];
                 host = pathArray[2];
                 url = protocol + '//' + host;
                 window.location.replace(url); 
             }
       }); 
   });
   $("#local_login_button").click(function() { 
          $.ajax({
               type: "POST"
             , timeout: 30000 
             , url: "/user/login_local_user"
             , data: ({ password: $("#password_local_login").val(), email: $("#username").val() })
             , success: function(msg) 
                        {
                              if(msg == 'success')
                              {
                                  pathArray = window.location.href.split( '/' );
                                  protocol = pathArray[0];
                                  host = pathArray[2];
                                  url = protocol + '//' + host;
                                  window.location.replace(url); 
                              }
                              else
                              {
                                  $("#unable_to_login_txt").css({ "color": "red", "font-weight":"normal","font-style":"italic","font-size":"14px"}); 
                                  $("#unable_to_login_txt").html(msg); 
                              }
                          }
           });
       
   }); 
   $("#create_local_account_button").click(function() {
       if ($(".valid").length < 5) {
          $.fn.first_name_check();
          $.fn.last_name_check();
          $.fn.email_check();
          $.fn.password_check();
       } 
       else { 
          $.ajax({
               type: "POST"
             , url: "/user/create_user"
             , data: ({ password: $("#password_one").val(), first_name: $("#first_name").val(), last_name: $("#last_name").val(), email: $("#email").val() }) 
             , success: function(msg) 
                        {
                              if(msg == 'success')
                              {
                                  pathArray = window.location.href.split( '/' );
                                  protocol = pathArray[0];
                                  host = pathArray[2];
                                  url = protocol + '//' + host;
                                  window.location.replace(url); 
                              }
                              else
                              {
                                  alert(msg); 
                              }
                          }
           });
        }
   });
   
   $("#first_name").change(function(){ $.fn.first_name_check(); });
   $("#last_name").change(function(){ $.fn.last_name_check(); });
   $("#email").change(function(){ $.fn.email_check(); });
   $("#password_one").keyup(function(){ $.fn.password_check(); });
   $("#confirm_password").keyup(function(){ $.fn.password_check(); });
   $.fn.password_check = function(){ 
         $.ajax({
               type: "POST"
             , url: "/user/check_password"
             , data: ({ password_one: $("#password_one").val(), password_two: $("#confirm_password").val() }) 
             , success: function(msg) 
                        {
                              if(msg == 'success')
                              {
                                  $("#password_one").addClass('valid'); 
                                  $("#password_one").removeClass('invalid'); 
                                  $("#password_verify_txt").html(''); 
                                  
                                  $("#confirm_password").addClass('valid'); 
                                  $("#confirm_password").removeClass('invalid'); 
                                  $("#confirm_password_verify_txt").html(''); 
                              }
                              else
                              {
                                  $("#password_one").addClass('invalid'); 
                                  $("#password_one").removeClass('valid'); 
                                  $("#password_verify_txt").css({ "color": "red", "font-weight":"normal","font-style":"italic","font-size":"14px"}); 
                                  $("#password_verify_txt").html(msg); 
                                  
                                  $("#confirm_password").addClass('invalid'); 
                                  $("#confirm_password").removeClass('valid'); 
                                  $("#confirm_password_verify_txt").css({ "color": "red", "font-weight":"normal","font-style":"italic","font-size":"14px"}); 
                                  $("#confirm_password_verify_txt").html(msg); 
                              }
                          }
           });
   }
   $.fn.first_name_check = function() { 
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

   }  
   $.fn.last_name_check = function() { 
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

   }  
   $.fn.email_check = function() { 
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

   }  
});
