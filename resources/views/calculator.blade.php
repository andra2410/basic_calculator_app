<!DOCTYPE html>
<html>

<head>
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<script src=
"https://cdnjs.cloudflare.com/ajax/libs/mathjs/10.6.4/math.js"
		integrity=
"sha512-BbVEDjbqdN3Eow8+empLMrJlxXRj5nEitiCAK5A1pUr66+jLVejo3PmjIaucRnjlB0P9R3rBUs3g5jXc8ti+fQ=="
		crossorigin="anonymous"
		referrerpolicy="no-referrer"></script>
	<script src=
"https://cdnjs.cloudflare.com/ajax/libs/mathjs/10.6.4/math.min.js"
		integrity=
"sha512-iphNRh6dPbeuPGIrQbCdbBF/qcqadKWLa35YPVfMZMHBSI6PLJh1om2xCTWhpVpmUyb4IvVS9iYnnYMkleVXLA=="
		crossorigin="anonymous"
		referrerpolicy="no-referrer"></script>
	<!-- for styling -->
	<style>
		table {
			border: 1px solid rgb(171, 111, 150); 
			margin-left: auto;
			margin-right: auto;
		}

		input[type="button"] {
			width: 100%;
			padding: 20px 40px;
			background-color: pink;
			color: white;
			font-size: 24px;
			font-weight: bold;
			border: none;
			border-radius: 5px;
		}

		input[type="text"] {
			padding: 20px 30px;
			font-size: 24px;
			font-weight: bold;
			border: none;
			border-radius: 5px;
			border: 2px solid rgb(171, 111, 150);
		}

		.history-button {
			width: 100%;
			max-width: 200px;
			padding: 15px 30px;
			background-color:rgb(255, 0, 166);
			color: white;
			font-size: 18px;
			font-weight: bold;
			border: none;
			border-radius: 5px;
			margin: 20px auto;
			display: block;
			cursor: pointer;
		}

		.history-button:hover {
			background-color:rgb(157, 255, 0);
		}

		/* Dropdown menu styles */
		.dropdown-container {
			position: fixed;
			top: 20px;
			right: 20px;
			z-index: 1000;
		}

		.dropdown-button {
			background-color: rgb(255, 0, 166);
			color: white;
			padding: 12px 20px;
			font-size: 16px;
			font-weight: bold;
			border: none;
			border-radius: 5px;
			cursor: pointer;
		}

		.dropdown-button:hover {
			background-color: rgb(157, 255, 0);
		}

		.dropdown-menu {
			display: none;
			position: absolute;
			right: 0;
			top: 100%;
			background-color: white;
			min-width: 200px;
			box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
			border-radius: 5px;
			margin-top: 5px;
			overflow: hidden;
		}

		.dropdown-menu.show {
			display: block;
		}

		.dropdown-item {
			display: block;
			padding: 12px 20px;
			text-decoration: none;
			color: #333;
			border: none;
			width: 100%;
			text-align: left;
			background: none;
			cursor: pointer;
			font-size: 16px;
		}

		.dropdown-item:hover {
			background-color: #f1f1f1;
		}

		.dropdown-item.logout {
			color: #f44336;
		}

		.dropdown-item.logout:hover {
			background-color: #ffebee;
		}

		/* User list styles */
		.user-item {
			display: flex;
			justify-content: space-between;
			align-items: center;
			padding: 12px;
			border-bottom: 1px solid #e0e0e0;
		}

		.user-item:last-child {
			border-bottom: none;
		}

		.user-username {
			font-size: 16px;
			font-weight: bold;
			color: #333;
		}

		.add-friend-btn {
			background-color: rgb(255, 0, 166);
			color: white;
			padding: 8px 16px;
			border: none;
			border-radius: 5px;
			cursor: pointer;
			font-size: 14px;
			font-weight: bold;
		}

		.add-friend-btn:hover {
			background-color: rgb(157, 255, 0);
		}

		.add-friend-btn:disabled {
			background-color: #ccc;
			cursor: not-allowed;
		}

		/* Modal styles */
		body {
			font-family: Arial, Helvetica, sans-serif;
		}

		/* Full-width input fields */
		input[type=text], input[type=password] {
			width: 100%;
			padding: 12px 20px;
			margin: 8px 0;
			display: inline-block;
			border: 1px solid #ccc;
			box-sizing: border-box;
		}

		/* Set a style for all buttons */
		.modal button {
			background-color:rgb(198, 144, 182);
			color: white;
			padding: 14px 20px;
			margin: 8px 0;
			border: none;
			cursor: pointer;
			width: 100%;
			
		
		}

		.modal button:hover {
			opacity: 0.8;
		}

		/* Extra styles for the cancel button */
		.cancelbtn {
			width: auto;
			padding: 10px 18px;
			background-color: #f44336;
		}

		/* Center the image and position the close button */
		.imgcontainer {
			text-align: center;
			margin: 24px 0 12px 0;
			position: relative;
		}

		img.avatar {
			width: 40%;
			border-radius: 50%;
		}

		.modal-container {
			padding: 16px;
		}

		span.psw {
			float: right;
			padding-top: 16px;
		}

		/* The Modal (background) */
		.modal {
			display: none; /* Hidden by default */
			position: fixed; /* Stay in place */
			z-index: 1; /* Sit on top */
			left: 0;
			top: 0;
			width: 100%; /* Full width */
			height: 100%; /* Full height */
			overflow: auto; /* Enable scroll if needed */
			background-color: rgb(0,0,0); /* Fallback color */
			background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
			padding-top: 60px;
		}

		/* Modal Content/Box */
		.modal-content {
			background-color: #fefefe;
			margin: 5% auto 15% auto; /* 5% from the top, 15% from the bottom and centered */
			border: 1px solid #888;
			width: 80%; /* Could be more or less, depending on screen size */
		}

		/* The Close Button (x) */
		.close {
			position: absolute;
			right: 25px;
			top: 0;
			color: #000;
			font-size: 35px;
			font-weight: bold;
		}

		.close:hover,
		.close:focus {
			color: red;
			cursor: pointer;
		}

		/* Add Zoom Animation */
		.animate {
			-webkit-animation: animatezoom 0.6s;
			animation: animatezoom 0.6s
		}

		@-webkit-keyframes animatezoom {
			from {-webkit-transform: scale(0)} 
			to {-webkit-transform: scale(1)}
		}
		
		@keyframes animatezoom {
			from {transform: scale(0)} 
			to {transform: scale(1)}
		}

		/* Change styles for span and cancel button on extra small screens */
		@media screen and (max-width: 300px) {
			span.psw {
				display: block;
				float: none;
			}
			.cancelbtn {
				width: 100%;
			}
		}
	</style>
</head>
<!-- create table -->

<body>
	@auth
		<div class="dropdown-container">
			<button class="dropdown-button" onclick="toggleDropdown()">☰ Menu</button>
			<div class="dropdown-menu" id="dropdownMenu">
				<button class="dropdown-item" onclick="document.getElementById('addFriendsModal').style.display='block'; closeDropdown(); loadUsers();">Add Friends</button>
				<form action="/logout" method="POST" style="margin: 0;">
					@csrf
					<button type="submit" class="dropdown-item logout">Log out</button>
				</form>
			</div>
		</div>
	@endauth

	<table id="calcu">
		<tr>
			<td colspan="3"><input type="text" id="result"></td>
			<!-- clr() function will call clr to clear all value -->
			<td><input type="button" value="c" onclick="clr()" /> </td>
		</tr>
		<tr>
			<!-- create button and assign value to each button -->
			<!-- dis("1") will call function dis to display value -->
			<td><input type="button" value="1" onclick="dis('1')"
						onkeydown="myFunction(event)"> </td>
			<td><input type="button" value="2" onclick="dis('2')"
						onkeydown="myFunction(event)"> </td>
			<td><input type="button" value="3" onclick="dis('3')"
						onkeydown="myFunction(event)"> </td>
			<td><input type="button" value="/" onclick="dis('/')"
						onkeydown="myFunction(event)"> </td>
		</tr>
		<tr>
			<td><input type="button" value="4" onclick="dis('4')"
						onkeydown="myFunction(event)"> </td>
			<td><input type="button" value="5" onclick="dis('5')"
						onkeydown="myFunction(event)"> </td>
			<td><input type="button" value="6" onclick="dis('6')"
						onkeydown="myFunction(event)"> </td>
			<td><input type="button" value="*" onclick="dis('*')"
						onkeydown="myFunction(event)"> </td>
		</tr>
		<tr>
			<td><input type="button" value="7" onclick="dis('7')"
						onkeydown="myFunction(event)"> </td>
			<td><input type="button" value="8" onclick="dis('8')"
						onkeydown="myFunction(event)"> </td>
			<td><input type="button" value="9" onclick="dis('9')"
						onkeydown="myFunction(event)"> </td>
			<td><input type="button" value="-" onclick="dis('-')"
						onkeydown="myFunction(event)"> </td>
		</tr>
		<tr>
			<td><input type="button" value="0" onclick="dis('0')"
						onkeydown="myFunction(event)"> </td>
			<td><input type="button" value="." onclick="dis('.')"
						onkeydown="myFunction(event)"> </td>
			<!-- solve function call function solve to evaluate value -->
			<td><input type="button" value="=" onclick="solve()"> </td>

			<td><input type="button" value="+" onclick="dis('+')"
						onkeydown="myFunction(event)"> </td>
		</tr>
	</table>

	@auth
		<a href="/history" class="history-button" style="text-decoration: none; display: block;">View History</a>
	@else
		<button class="history-button" type="button" onclick="document.getElementById('loginModal').style.display='block'">Login or register to view history</button>
	@endauth

	<!-- The Modal -->
	<div id="loginModal" class="modal">
		<form class="modal-content animate" action="/login" method="POST">
			@csrf
			<div class="imgcontainer">
				<span onclick="document.getElementById('loginModal').style.display='none'" class="close" title="Close Modal">&times;</span>
			</div>

			<div class="modal-container">
				@if ($errors->has('uname'))
					<div style="color: red; margin-bottom: 10px;">
						{{ $errors->first('uname') }}
					</div>
				@endif

				<label for="uname"><b>Username</b></label>
				<input type="text" placeholder="Enter Username" name="uname" value="{{ old('uname') }}" required>

				<label for="psw"><b>Password</b></label>
				<input type="password" placeholder="Enter Password" name="psw" required>
					
				<button type="submit">Login</button>
				<label>
					<input type="checkbox" checked="checked" name="remember"> Remember me
				</label>
			</div>

			<div class="modal-container" style="background-color:#f1f1f1">
				<button type="button" onclick="document.getElementById('loginModal').style.display='none'" class="cancelbtn">Cancel</button>
				<span class="psw">Forgot <a href="#">password?</a></span>
			</div>
		</form>
	</div>

	<!-- Add Friends Modal -->
	@auth
		<div id="addFriendsModal" class="modal">
			<div class="modal-content animate">
				<div class="imgcontainer">
					<span onclick="document.getElementById('addFriendsModal').style.display='none'" class="close" title="Close Modal">&times;</span>
				</div>

				<div class="modal-container">
					<h2 style="text-align: center; margin-bottom: 20px;">Add Friends</h2>
					<div id="usersList" style="max-height: 400px; overflow-y: auto;">
						<p style="text-align: center; color: #666;">Loading users...</p>
					</div>
				</div>

				<div class="modal-container" style="background-color:#f1f1f1">
					<button type="button" onclick="document.getElementById('addFriendsModal').style.display='none'" class="cancelbtn">Close</button>
				</div>
			</div>
		</div>
	@endauth

	<script>
		// Function that display value
		function dis(val) {
			document.getElementById("result").value += val
		}

		function myFunction(event) {
			if (event.key == '0' || event.key == '1'
				|| event.key == '2' || event.key == '3'
				|| event.key == '4' || event.key == '5'
				|| event.key == '6' || event.key == '7'
				|| event.key == '8' || event.key == '9'
				|| event.key == '+' || event.key == '-'
				|| event.key == '*' || event.key == '/')
				document.getElementById("result").value += event.key;
		}

		let cal = document.getElementById("calcu");
		cal.onkeyup = function (event) {
			if (event.keyCode === 13) {
				console.log("Enter");
				let x = document.getElementById("result").value
				console.log(x);
				solve();
			}
		}

		// Function that evaluates the digit and return result
		function solve() {
			let x = document.getElementById("result").value
			let y = math.evaluate(x)
			document.getElementById("result").value = y

			// Save calculation if user is authenticated
			@auth
				saveCalculation(x, y.toString());
			@endauth
		}

		// Function to save calculation to database
		function saveCalculation(expression, result) {
			const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
			
			fetch('/calculations', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json',
					'X-CSRF-TOKEN': csrfToken,
					'Accept': 'application/json'
				},
				body: JSON.stringify({
					expression: expression,
					result: result
				})
			}).catch(error => {
				console.error('Error saving calculation:', error);
			});
		}

		// Function that clear the display
		function clr() {
			document.getElementById("result").value = ""
		}

		// Modal functionality
		var modal = document.getElementById('loginModal');

		// When the user clicks anywhere outside of the modal, close it
		window.onclick = function(event) {
			if (event.target == modal) {
				modal.style.display = "none";
			}
		}

		// Show modal if there are validation errors
		@if ($errors->has('uname'))
			document.getElementById('loginModal').style.display = 'block';
		@endif

		// Dropdown menu functionality
		function toggleDropdown() {
			const dropdown = document.getElementById('dropdownMenu');
			dropdown.classList.toggle('show');
		}

		function closeDropdown() {
			const dropdown = document.getElementById('dropdownMenu');
			dropdown.classList.remove('show');
		}

		// Load users when Add Friends modal opens
		function loadUsers() {
			const usersList = document.getElementById('usersList');
			usersList.innerHTML = '<p style="text-align: center; color: #666;">Loading users...</p>';

			fetch('/users')
				.then(response => response.json())
				.then(users => {
					if (users.length === 0) {
						usersList.innerHTML = '<p style="text-align: center; color: #666;">No other users available.</p>';
						return;
					}

					let html = '';
					users.forEach(user => {
						const username = user.username.replace(/'/g, "\\'");
						html += `
							<div class="user-item">
								<span class="user-username">${user.username}</span>
								<button class="add-friend-btn" style="max-width: 200px; onclick="addFriend(${user.id}, '${username}')">Add</button>
							</div>
						`;
					});
					usersList.innerHTML = html;
				})
				.catch(error => {
					console.error('Error loading users:', error);
					usersList.innerHTML = '<p style="text-align: center; color: #f44336;">Error loading users. Please try again.</p>';
				});
		}

		// Add friend function (placeholder for now)
		function addFriend(userId, username) {
			// TODO: Implement friend request logic
			alert(`Friend request functionality for ${username} will be implemented soon!`);
		}

		// Close dropdown when clicking outside
		window.onclick = function(event) {
			const dropdown = document.getElementById('dropdownMenu');
			const dropdownButton = document.querySelector('.dropdown-button');
			
			if (dropdown && !dropdown.contains(event.target) && !dropdownButton.contains(event.target)) {
				dropdown.classList.remove('show');
			}

			// Also handle modal clicks
			const loginModal = document.getElementById('loginModal');
			if (event.target == loginModal) {
				loginModal.style.display = "none";
			}

			const addFriendsModal = document.getElementById('addFriendsModal');
			if (addFriendsModal && event.target == addFriendsModal) {
				addFriendsModal.style.display = "none";
			}
		}
	</script>
</body>
</html>