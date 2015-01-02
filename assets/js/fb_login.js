(function($) {
  $.fn.facebook_login = function(options) {
    var defaults = {
      endpoint: '/user/facebook_login',
      permissions: 'email',
      js_src: '//connect.facebook.net/en_US/all.js',
      onSuccess: function(data) { console.log([200,'OK']); },
      onError: function(data) { console.log([500,'Error']); }
    };

    var settings = $.extend({}, defaults, options);

    if(settings.appId === 'undefined') {
        console.log('The Facebook Application ID must be sent in, I can not default it to anything.');
        return false;
    }
    window.fbAsyncInit = function() {
        FB.init({
            appId: settings.appId
          , cookie: true
          , status: true
          , xfbml: true
        });
    };

    // Load the SDK asynchronously
    (function(d){
       var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
       if (d.getElementById(id)) {return;}
            js = d.createElement('script'); js.id = id; js.async = true;
            js.src = settings.js_src;
            ref.parentNode.insertBefore(js, ref);
    }(document));
  
    this.bind('click', function() {
      FB.login(function(r) {
          if (r.authResponse) { 
             var token   = r.authResponse.accessToken;
             FB.api('/v2.1/me?fields=picture,first_name,last_name,id,email&access_token='+token, function(user) {
                 $.ajax({
                       url: settings.endpoint
                     , data: {user:user,token:token}
                     , type: 'POST'
                     , success: settings.onSuccess
                     , error: settings.onError
                 });
             });
          }
          else { 
            //TODO add to error dialog 
          } 
      }, {scope: settings.permissions});
    });
  }
})(jQuery);
