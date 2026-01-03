<!DOCTYPE html>
<html>

<head>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<style>
		body {
			font-family: Arial, Helvetica, sans-serif;
			margin: 20px;
		}

		.history-button {
			width: 100%;
			max-width: 400px;
			padding: 15px 30px;
			background-color: rgb(255, 0, 166);
			color: white;
			font-size: 18px;
			font-weight: bold;
			border: none;
			border-radius: 5px;
			margin: 20px auto;
			display: block;
			cursor: pointer;
			text-decoration: none;
			text-align: center;
		}

		.history-button:hover {
			background-color: rgb(157, 255, 0);
		}

		table {
			width: 100%;
			max-width: 800px;
			margin: 20px auto;
			border-collapse: collapse;
			border: 2px solid rgb(171, 111, 150);
		}

		th, td {
			padding: 12px;
			text-align: left;
			border-bottom: 1px solid rgb(171, 111, 150);
		}

		th {
			background-color: rgb(171, 111, 150);
			color: white;
			font-weight: bold;
		}

		tr:hover {
			background-color: #f5f5f5;
		}

		.empty-message {
			text-align: center;
			padding: 40px;
			color: #666;
			font-size: 18px;
		}

		.button-container {
			display: flex;
			gap: 10px;
			justify-content: center;
			margin: 20px auto;
			max-width: 800px;
		}

		.button-container form {
			display: inline;
		}
	</style>
</head>

<body>
	<h1 style="text-align: center; color: rgb(171, 111, 150);">Calculation History</h1>

	@if($calculations->isEmpty())
		<div class="empty-message">
			<p>No calculations found. Start calculating to see your history!</p>
		</div>
	@else
		<table>
			<thead>
				<tr>
					<th>Expression</th>
					<th>Result</th>
					<th>Date</th>
				</tr>
			</thead>
			<tbody>
				@foreach($calculations as $calculation)
					<tr>
						<td>{{ $calculation->expression }}</td>
						<td><strong>{{ $calculation->result }}</strong></td>
						<td>{{ $calculation->created_at->format('Y-m-d H:i:s') }}</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	@endif

	<div class="button-container">
		<a href="/" class="history-button" style="max-width: 200px;">Back to Calculator</a>
		<form action="/logout" method="POST" style="display: inline;">
			@csrf
			<button class="history-button" type="submit" style="max-width: 200px;">Log out</button>
		</form>
	</div>
</body>

</html>
