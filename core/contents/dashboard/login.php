<html>
	<head>
		<title><?= Wizard::getHeadTitle(Wizard::LOGIN_AREA); ?></title>
		<?= Wizard::callAssets(array(Wizard::LIBRARY_SEMANTIC_UI, Wizard::LOGIN_STYLE)); ?>
	</head>
	<body>
		<!--<form method="POST" action=<?= "?area=" . RequestHandler::DASHBOARD_AREA . "&action=" . RequestHandler::LOGIN_ACTION ?>>
			<input type="text" name="username" placeholder="Username" />
			<input type="password" name="password" placeholder="Password" />
			<input type="submit" value="Login" />
		</form>-->

		<form method="POST" class='ui large form' id='login_form' action=<?= "?area=" . RequestHandler::DASHBOARD_AREA . "&action=" . RequestHandler::LOGIN_ACTION ?>>
			<center><h1 class='ui header'>Admin Dashboard</h1></center>
			<div class="ui stacked segment">
				<div class="field <?= $_GET['error'] == 'login' ? 'error' : '' ?>">
					<div class="ui left icon input">
						<i class="user icon"></i>
						<input type="text" name="username" placeholder="Administrator Credential">
					</div>
				</div>
				<div class="field <?= $_GET['error'] == 'login' ? 'error' : '' ?>">
					<div class="ui left icon input">
						<i class="lock icon"></i>
						<input type="password" name="password" placeholder="Password / PIN">
					</div>
				</div>
				<div onClick="document.getElementById('login_form').submit();" class="ui fluid large teal submit button">Login</div>

			</div>
		</form>


	</body>
</html>
