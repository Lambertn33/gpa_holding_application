$(document).ready(function(){
	var $sent= $(".commit"), $error=$(".err_msg"), $pwd_mob=$("#password"),  $reset=$(".help"), $login_email=$("#username");
		
		$login_email.click(function(sep){
			sep.preventDefault();
			$login_email.css({ // on rend le champ gray
				borderColor : '#dcdee4'
				});
			$error.hide();
		});
		
		$pwd_mob.click(function(sepd){
			sepd.preventDefault();
			$pwd_mob.css({ // on rend le champ gray
				borderColor : '#dcdee4'
				});
			$error.hide();
		});
		
	$sent.click(function(seps){
		seps.preventDefault();
		if($login_email.val()=="")
		{
			$login_email.focus();
			$error.show();
			$error.html('Please write your email or username!'); 
			$login_email.css({ // on rend le champ rouge
			borderColor : 'red'
			});
		}
		
		else if($pwd_mob.val()=="")
		{
			$pwd_mob.focus();
			$error.show();
			$error.html('Write your Password...');
			$pwd_mob.css({ // on rend le champ rouge
			borderColor : 'red'
			}); 
			 
			 
		}
		 
		else
		{
			$error.show();
			//alert('hello');
			$error.html('Please wait...');
			$sendz = 'Log me in!';
			if($('.typeform').val() == 'admin'){$linkl = '../function/loginrate.php'}else if($('.typeform').val() == 'user'){$linkl = '../function/loginrate.php'}else{$linkl = 'function/loginrate.php'}
			
			$.post(
				$linkl,
				{commit:$sendz, email:$login_email.val(), password:$pwd_mob.val(), typeform:$('.typeform').val() },
				
				function(data){ 
						if(data == 'okadmin')
						{
							if($('.next').val() == 0  || $('.next').val() == '')
							{
								location.href = "index.php";
							}
							else
							{
								location.href = $('.next').val();
								//$error.html($('.next').val());
							}
						}
						else if(data == 'ok')
						{
							if($('.next').val() == 0  || $('.next').val() == '')
							{
								location.href = "index.php";
							}
							else
							{
								location.href = $('.next').val();
								//$error.html($('.next').val());
							}
						}
						else if(data == '0')
						{
							//location.href = ".";
							$error.show();
							$error.html('Incorrect username and password');
							$login_email.focus();
							$login_email.css({ // on rend le champ rouge
							borderColor : 'red'
							}); 
						}
						else if(data == '1')
						{
							$error.show();
							$error.html('Incorrect username and password');
							$pwd_mob.focus();
							$pwd_mob.css({ // on rend le champ rouge
							borderColor : 'red'
							}); 
						}
						else if(data == '2')
						{
							$error.show();
							$error.html('Your Account has been suspended!');
							$pwd_mob.focus();
							$pwd_mob.css({ // on rend le champ rouge
							borderColor : 'red'
							}); 
						}
						else if(data == '3')
						{
							$error.show();
							$error.html('Your Account is not yet activated! Check email inbox');
							$pwd_mob.focus();
							$pwd_mob.css({ // on rend le champ rouge
							borderColor : 'red'
							}); 
						}
						else if(data == '4')
						{
							$error.show();
							$error.html('Your Account has been suspended!');
							$pwd_mob.focus();
							$pwd_mob.css({ // on rend le champ rouge
							borderColor : 'red'
							}); 
						}
						else if(data == '5')
						{
							$error.show();
							$error.html('Your Account has been deleted!');
							$pwd_mob.focus();
							$pwd_mob.css({ // on rend le champ rouge
							borderColor : 'red'
							}); 
						}
						else{
							$error.show();
							$error.html('Incorrect Login'+ data);
							$login_email.focus();
							$login_email.css({ // on rend le champ rouge
							borderColor : 'red'
							}); 
						}
					},
					
				'text'
			);
		} 
		
	});
});