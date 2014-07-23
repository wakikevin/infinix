
function shareOnFacebook(){

    FB.getLoginStatus(function(response) {
        if (response.status === 'connected') {
            // the user is logged in and has authenticated your
            // app, and response.authResponse supplies
            // the user's ID, a valid access token, a signed
            // request, and the time the access token
            // and signed request each expire
            var uid = response.authResponse.userID;
            var accessToken = response.authResponse.accessToken;

            console.log(response.authResponse);

            //save the user if they have an id
            if(uid){
               saveFbUser(uid);

            }

        } else if (response.status === 'not_authorized') {
            // the user is logged in to Facebook,
            // but has not authenticated your app
            //login the user
            FB.login(function(response) {
                if (response.authResponse) {
                    console.log('Welcome!  Fetching your information.... ');
                    FB.api('/me', function(response) {
                        console.log( response);
                        //save the user if they have an id
                        if(response.id){

                            saveFbUser(response.id);

                        }
                    });
                } else {
                    console.log('User cancelled login or did not fully authorize.');
                }
            });


        } else {
            //login the user
            FB.login(function(response) {
                if (response.authResponse) {
                    console.log('Welcome!  Fetching your information.... ');
                    FB.api('/me', function(response) {
                        console.log( response);
                        //save the user if they have an id
                        if(response.id){

                            saveFbUser(response.id);

                        }

                    });
                } else {
                    console.log('User cancelled login or did not fully authorize.');
                }
            });

        }
    });

}

function saveFbUser(uid){
    console.log('Your user id is :'+uid);
    var result = false;
    $.ajax({
        url:BASE_URL+'/ajax.php',
        type:'post',
        data:{'uid':uid,'task':'fbuser'},
        beforeSend:function(){
            console.log('Saving user in data base');
        }
    }).success(function(response){

        if(parseInt(response) == 1){
            //share dialog
            fbShare(uid);
        }else{
            console.error("Cannot Share at this time");
        }
    }).error(function(response){
        console.error(response);

    })


}

function fbShare(uid){

    console.log('Share Dialog');

    FB.ui({
        method: 'feed',
        link: 'https://developers.facebook.com/docs/',
        caption: 'An example caption'
    }, function(response){

        if(response){
            console.log(response.post_id);
            var post_id = response.post_id;
            $.ajax({
                url:BASE_URL+'/ajax.php',
                type:'post',
                data:{'uid':uid,'post_id':post_id,'task':'fbshare'},
                beforeSend:function(){
                    console.log('Syncing share count' + uid);
                }
            }).success(function(response){
                var data = JSON.parse(response);
                if(data.code == '000'){
                    $('#counter').empty().html(data.desc);
                }else{
                    console.error(data.desc);
                }
                console.log(response);
            }).error(function(response){
                console.error(response);

            })
        }else{
            console.error("Could Not share the page at this time");
        }

    });
}


//twitter
// Wait for the asynchronous resources to load

twttr.ready(function (twttr) {

    // Now bind our custom intent events

    twttr.events.bind('tweet', function(intentEvent){
			
			//log results
        console.log(intentEvent);
        
        //increase tweet count in database
        if (intentEvent) {
        		$.ajax({
                url:BASE_URL+'/ajax.php',
                type:'post',
                data:{'task':'twitterShare'},
                beforeSend:function(){
                    console.log('Syncing share count');
                }
            }).success(function(response){
                var data = JSON.parse(response);
                if(data.code == '000'){
                    $('#counter').empty().html(data.desc);
                }else{
                    console.error(data.desc);
                }
                console.log(response);
            }).error(function(response){
                console.error(response);

            })
        	}else {
        		console.error('Could not create tweet');
        		}
        

    });


});