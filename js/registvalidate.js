<script>
			function regvalidate(){
				//define email
				var email = document.getElementById("email"); 
				var passwordone = document.getElementById("password"); 
				var passwordtwo = document.getElementById("passwordd"); 
				if(document.signupform.username.value==""){
				alert("Please enter your username.");
				return false;	
		    	}
				if(document.signupform.firstname.value==""){
				alert("Please enter your lastname.");
				return false;	
		    	}
				if(document.signupform.lastname.value==""){
				alert("Please enter your lastname.");
				return false;	
		    	}
				if(document.signupform.password.value==""){
				alert("Please enter your password.");
				return false;	
				}
				if(document.signupform.password.value!=document.signupform.passwordd.value){
				alert("The two passwords don't match.");
				return false;	
			    }
				
				var passwordRegexp= new RegExp(/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[~#$!]).{8,12}$/); 
				if(!passwordRegexp.test(passwordone.value)){ 
                alert("Your passowrd should inclued!"); 
                 return false; 
                } 
				
				if(email.value==""){
					alert("Please enter your password.");
					return false;
				}
				
				var emailRegexp= new RegExp(/\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*/); 
				if(!emailRegexp.test(email.value)){ 
                alert("Your E-mail address is not correct!"); 
                 return false; 
                } 
			
			}
		
</script>
	