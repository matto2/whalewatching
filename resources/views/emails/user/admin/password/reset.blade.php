<!DOCTYPE html>
<html>
<head>
	<title>Reset Your Password</title>
	<meta charset="utf-8">
	<style type="text/css" media="screen">
		body { background: #fff; font: normal 10pt Verdana, Arial, sans-serif; }
		h1 { font-size: 16pt; margin: 0; padding: 0 0 1rem 0; }
		a { color: #7599b3; font-weight: bold; }
	</style>
</head>
<body>
	<table width="600" cellpadding="0" cellspacing="0">
		<tr><td><img src="{{ config( 'app.url') }}/images/logoemail.jpg" alt="Logo" style="width:600px;height:auto;"></td></tr>
		<tr>
			<td style="">
				<h1>Reset Your Password</h1>
				<p>Hello, {{ $user['first_name'] }}!</p>
				<p>An administrator has reset your password.</p>
				<p>To reset your password, <a href="{{ route('user.reset', $user['reset_password_code'] ) }}">please click here</a>.</p>
				<p>If the link above does not work, please paste the following address into your browser's address bar:</p>
				<p><em>{{ route('user.reset', $user['reset_password_code'] ) }}</em></p>
			</td>
		</tr>
	</table>
</body>
</html>