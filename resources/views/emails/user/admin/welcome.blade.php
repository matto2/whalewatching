<!DOCTYPE html>
<html>
<head>
	<title>Welcome</title>
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
		<tr><th>Welcome!</th></tr>
		<tr>
			<td style="">
				<p>Hello, <strong>{{ $user['first_name'] }}!</strong></p>
				<p>We have created a new account for you. Your email address is <strong>{{ $user['email'] }}</strong>.</p>
			</td>
		</tr>
	</table>
</body>
</html>