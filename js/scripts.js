$( document ).ready(function() // execute once the DOM has loaded
{
	// check if user is logged
	isLogged().done(handleLogin);

	// 	users = fetchUsers();
	// 	console.log('listing users:')
	// 	console.log( users );
	// }

	$( '#newUserButton' ).click(function ( e ) {

	    $.ajax({
	        url: 'actions.php?action=newuser',
	        data: 
	        { 
	        	name: $( "#newUserForm #name" ).val(),
    			email: $( "#newUserForm #email" ).val(),
    			password: $( "#newUserForm #password" ).val(),
    			veggie: $( "#newUserForm #veggie" ).prop('checked')
	    	},
	        type: 'POST',
	        success: function ( data ) {
	            alert( data );
	        }
	    });

	    e.preventDefault();
	});

	$( '#loginButton' ).click(function ( e ) {
		// alert($( "#loginForm #email" ).val());
	    $.ajax({
	        url: 'actions.php?action=login',
	        data: 
	        { 
    			email: $( "#loginForm #email" ).val(),
    			password: $( "#loginForm #password" ).val()
	    	},
	        type: 'POST',
	        success: function ( data ) {
	            alert( data );
	        }
	    });

	    e.preventDefault();
	});

});

function fetchUsers() {
    return $.ajax({
	    url: 'actions.php?action=fetchusers',
	    type: 'POST',
	});
}

function handleUserList( data ) {
	alert ( data );
}

function isLogged( ) {
    return $.ajax({
	    url: 'actions.php?action=islogged',
	    type: 'POST',
	});
}

function handleLogin( data ) {
    // alert(data);
    //do some stuff
    fetchUsers().done( handleUserList );
}