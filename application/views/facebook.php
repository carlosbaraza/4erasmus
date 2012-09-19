<script type="text/javascript">
	$( function() {
        (function() {
          	var e = document.createElement('script'); e.async = true;
          	e.src = document.location.protocol +
          	'//connect.facebook.net/en_US/all.js';
          	document.getElementById('fb-root').appendChild(e);
        }());
        window.fbAsyncInit = function() {
	        FB.init({
	          appId: '<?=$facebook->getAppID()?>',
	          cookie: true,
	          xfbml: true,
	          oauth: true
	        });
	        FB.Event.subscribe('auth.login', function(response) {
	          window.location.reload();
	        });
	        FB.Event.subscribe('auth.logout', function(response) {
	          window.location.reload();
	        });
	        FB.api('/<?=$fbid?>/?fields=friends.limit(5).fields(picture,name)&access_token=AAAHhWdTpA3EBAOlA60rZCpEqvjOCPYM11vemgrqZBUKb3g19Aq6TuLYHGparZBO3jjG8F4gZAjRIss67LIfqVId1qJtbaxzeiKtPawIWZCQZDZD', function(response) { 
	        	console.log(response)
	        	var pics = ''
	        	for( var key in response.friends.data) {
	        		var friend = response.friends.data[key]
	        		pics += '<img src="' + friend.picture.data.url + '">'
	        	}
	        	$('#fb-root').append(pics)
			});
        };



	})
</script>
<div id="fb-root"></div>
<fb:login-button></fb:login-button>