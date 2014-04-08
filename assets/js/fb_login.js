(function($) {
  $.fn.facebook_login = function(options) {
    var defaults = {
      endpoint: '/user/facebook_login',
      permissions: 'email',
      onSuccess: function(data) { console.log([200,'OK']); },
      onError: function(data) { console.log([500,'Error']); }
    };

    var settings = $.extend({}, defaults, options);

    if(settings.appId === 'undefined') {
      console.log('You must set the appId');
      return false;
    }

    (function(d, s, id){
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) {return;}
    js = d.createElement(s); js.id = id;
      js.src = "http://connect.facebook.net/en_US/all.js";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));

    window.fbAsyncInit = function() {
      FB.init({
        appId: settings.appId,
        status: true,
        xfbml: true
      });
    };

    this.bind('click', function() {
      FB.login(function(r) {
          if (r.authResponse) { 
          var response = r.authResponse;
          var user_id = response.userID;
          var token   = response.accessToken;
          FB.api('/me?fields=picture,first_name,last_name,id&access_token='+token, function(user) {
              $.ajax({
                url: settings.endpoint,
                data: {user:user,token:token},
                type: 'POST',
                success: function(msg) { window.location.replace("http://fantasy.kevinfenger.com/"); },
          //      success: function(msg) { console.log(msg); },
                error: function(msg) { window.location.replace("http://fantasy.kevinfenger.com/"); }
              });
          });
          //window.location.replace("http://fantasy.kevinfenger.com/"); 
          }
          else { 
          
          } 
      }, {scope: settings.permissions});
    });
  }
})(jQuery);
