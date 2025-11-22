<!DOCTYPE html>
<html>
<head>
	<title>New User Accounts Created</title>
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
		<tr><th>New User Accounts Created</th></tr>
		<tr>
			<td style="">
				<p>The following new user accounts were created yesterday:</p>
				<table>
					<thead>
						<tr>
							<th>First Name</th>
							<th>Last Name</th>
							<th>E-Mail Address</th>
						</tr>
					</thead>
					<tbody>
						@foreach ( $users as $user )
							<tr>
								<td>{{ $user->first_name}}</td>
								<td>{{ $user->last_name}}</td>
								<td>{{ $user->email}}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</td>
		</tr>
	</table>
</body>
</html>