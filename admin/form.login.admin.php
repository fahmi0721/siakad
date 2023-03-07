	<!-- HEADER -->
	<div id="header">
		
		<div class="page-full-width cf">
	
			<div id="login-intro" class="fl">
			
				<h1>Login to Sistem Informasi Akademik - STIA Al Gazali Barru</h1>
				<h5>Enter your credentials below</h5>
			
			</div> <!-- login-intro -->
			
			<!-- Change this image to your own company's logo -->
			<!-- The logo will automatically be resized to 39px height. -->
			
		</div> <!-- end full-width -->	

	</div> <!-- end header -->
	
	
	
	<!-- MAIN CONTENT -->
	<div id="content">
	<br>
	<br>
		<form action="login.php" method="POST" id="login-form">
		
			<fieldset>

				<p>
					<label for="login-username">username</label>
					<input type="text" name="username" id="login-username" class="round full-width-input" autofocus placeholder="Input Your Username" required/>
				</p>

				<p>
					<label for="login-password">password</label>
					<input type="password" name="password" id="login-password" class="round full-width-input" placeholder="Input Your Password" required/>
				</p>
				
				<input type="submit" class="button round blue image-right ic-right-arrow" value="LOG IN">

			</fieldset>

			<br/><div class="information-box round">Just click on the "LOG IN" button to continue, no login information required.</div>

		</form>
		<br>
		<br>
		<br>
		<br>
	</div> <!-- end content -->
	
	
	
	<!-- FOOTER -->
	<div id="footer">
	<?php
	$thn=date("Y");
	?>
		<p>&copy; Copyright <?php echo $thn; ?> <a href="#">Siakad STIA Al Gazali</a>. All rights reserved.</p>
		<p><strong>SimpleAdmin</strong> theme by <a href="#">Admin STIA Al Gazali</a></p>
	
	</div> <!-- end footer -->