<!DOCTYPE html>
<html>
<head>
	<title>Your Password Was Changed</title>
	<meta charset="utf-8">
	<style type="text/css" media="screen">
		body { background: #fff; font: normal 10pt Verdana, Arial, sans-serif; }
		th { background: #7599b3; color: #fff; font-size: 18pt; font-weight: bold; padding: 10px; 0px }
		a { color: #7599b3; font-weight: bold; }
	</style>
</head>
<body>
	<table width="600" cellpadding="0" cellspacing="0" style="border:1px solid #7599b3; padding:10px;">
		<tr><td><img src="<?php echo e(config( 'app.url')); ?>/images/logoemail.jpg" alt="Logo" style="width:600px;height:auto;"></td></tr>
		<tr><th>We've Changed Your Password</th></tr>
		<tr>
			<td style="">
				<p>Hello, <?php echo e($user['first_name']); ?>!</p>
				<p>We've just changed your password.</p>
				<p>If you were not expecting us to change your password, please click below to change your password.</p>
				<a href="<?php echo e(route('user.reset' )); ?>">Click here to change your password</a>
			</td>
		</tr>
	</table>
</body>
</html>