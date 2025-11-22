<!DOCTYPE html>
<html>
<head>
	<title>Your E-Mail Address Was Changed</title>
	<meta charset="utf-8">
	<style type="text/css" media="screen">
		body { background: #fff; font: normal 10pt Verdana, Arial, sans-serif; }
		th { background: #7599b3; color: #fff; font-size: 18pt; font-weight: bold; padding: 10px; 0px }
		a { color: #7599b3; font-weight: bold; }
	</style>
</head>
<body>
	<table width="600" cellpadding="0" cellspacing="0" style="border:1px solid #7599b3; padding:10px;">
		<tr><td><img src="{{ config( 'app.url') }}/images/logoemail.jpg" alt="Logo" style="width:600px;height:auto;"></td></tr>
		<tr><th>Your E-Mail Address Was Changed</th></tr>
		<tr>
			<td style="">
				<p>Hello, <strong>{{ $user['first_name'] }}!</strong></p>
				<p>We just change your e-mail address. Your old e-mail address of '{{ $old }}' was changed to '{{ $new }}'. This message has been sent to both email accounts.</p>
				<p>If you did not want us to change your e-mail address, please click below to change your e-mail address.</p>
				<a href="{{ route('user.reset' ) }}">Click here to change your password</a>
			</td>
		</tr>
	</table>
</body>
</html>