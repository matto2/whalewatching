<!DOCTYPE html>
<html>
<head>
	<title>Welcome</title>
	<meta charset="utf-8">
	<link href="https://fonts.googleapis.com/css?family=Abel" rel="stylesheet">
	<style type="text/css" media="screen">
		body { background: #fff; font: normal 10pt Verdana, Arial, sans-serif; }
		h1 { color: #517636; font-family: Abel, "Helvetica Neue", Helvetica, Roboto, Arial, sans-serif; font-size: 24pt; }
		th { background: #7599b3; color: #fff; font-size: 18pt; font-weight: bold; padding: 10px; 0px }
		a { color: #7599b3; font-weight: bold; }
		.footer { background-color: #517636; height: 5px; }
	</style>
</head>
<body>
	<table width="600" cellpadding="0" cellspacing="0">
		<tr><td><img src="{{ config( 'app.url') }}/images/logoemail.jpg" alt="Arts Logo" style="width:600px;height:auto;"></td></tr>
		<tr><td><h1>Welcome to SCWW Admin!</h1></td></tr>
		<tr>
			<td>
				<p>Hello, {{ $user->first_name }}!</p>
				<p>Thank you for creating an account on SCWW! Your email address is <strong>{{ $user['email'] }}</strong>.</p>
			</td>
		</tr>

		<tr>
			<td>
				<div class="footer">&nbsp;</div>
			</td>
		</tr>
	</table>
</body>
</html>