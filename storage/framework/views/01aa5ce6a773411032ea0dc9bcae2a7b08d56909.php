<!DOCTYPE html>
<html>
<head>
	<title>Verify Your Account</title>
	<meta charset="utf-8">
	<style type="text/css" media="screen">
		body { background: #fff; font: normal 10pt Verdana, Arial, sans-serif; }
		th { background: #7599b3; color: #fff; font-size: 18pt; font-weight: bold; padding: 10px; }
		a { color: #7599b3; font-weight: bold; }
	</style>
</head>
<body>
	<table width="600" cellpadding="0" cellspacing="0" style="border:1px solid #7599b3; padding:10px;">
		<tr><td><img src="<?php echo e(config( 'app.url')); ?>/images/logoemail.jpg" alt="Logo" style="width:600px;height:auto;"></td></tr>
		<tr><th>Please Activate Your Account</th></tr>
		<tr>
			<td style="">
				<p>Hello, <strong><?php echo e($user['first_name']); ?>!</strong></p>
				<p>We have created an account for you under the email address <strong><?php echo e($user['email']); ?></strong></p>
				<p>Before you can begin using your account, we need you to verify your identity. In order to do that, <a href="<?php echo e(route('user.activate', $user['activation_code'] )); ?>">please click here to activate your account</a>.</p>
				<p>If the link above does not work, please paste the following address into your browser's address bar:</p>
				<p><em><?php echo e(route('user.activate', $user['activation_code'] )); ?></em></p>
			</td>
		</tr>
	</table>
</body>
</html>