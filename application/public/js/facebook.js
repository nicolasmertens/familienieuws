jQuery(document).ready(function() {
  jQuery.ajaxSetup({cache: true});
  jQuery.getScript('//connect.facebook.net/nl_NL/all.js', function(){
    FBcustom.init();
  });
});
// ------------------------ facebook class -----------------------------
var FBcustom = (function(window, document, $, undefined)
{
    
    var FBcustom = {};
    
    FBcustom.init = function()
    {
        FB.init({
            appId: settings.app_id,
            status: true, // check login status
            cookie: true, // enable cookies to allow the server to access the session
            xfbml: true
        });
        FBcustom.events();
        return false;
    };
    
    FBcustom.events = function()
    {
        $('#fb-login').bind('click', function() {
            FB.login(function(response) {
                if (response.authResponse) {
                    window.location = settings.app_redirect + "?access_token=" + response.authResponse.accessToken;
                }
            }, {scope: settings.app_scope});
        });
        
        $('#fb-invite').bind('click', function() {
            FB.ui({
                method  : 'apprequests',
                message : 'Nodig je familie uit...'
            }, function(response) {
                if (response.to) {
                    window.location = "/invite/newspaperId/" + settings.newspaper_id + "?" + $.param(response);
                } else {
                    console.log('User cancelled login or did not fully authorize.');
                }
            })
        });
    };
    
    return {
        init: FBcustom.init
    };
    
}(window, window.document, window.jQuery));