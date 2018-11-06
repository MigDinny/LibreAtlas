<html>
	<head>
		<title><?= Wizard::getHeadTitle(Wizard::DASHBOARD_AREA); ?></title>
		<?= Wizard::callAssets(array(Wizard::LIBRARY_JQUERY, Wizard::LIBRARY_SEMANTIC_UI, Wizard::DASHBOARD_STYLE)); ?>
	</head>
	<body>
		<div class="ui menu" STYLE="border-radius: 0">
			<a class="item <?= $_GET['tab'] == RequestHandler::MARKERS_TAB || $_GET['tab'] == '' ? 'active' : '' ?>" href="<?= '?area=' . RequestHandler::DASHBOARD_AREA . '&tab=' . RequestHandler::MARKERS_TAB ?>">
				Markers
			</a>
			<a class="item <?= $_GET['tab'] == RequestHandler::API_KEYS_TAB ? 'active' : '' ?>" href="<?= '?area=' . RequestHandler::DASHBOARD_AREA . '&tab=' . RequestHandler::API_KEYS_TAB ?>">
				API Keys
			</a>
			<a class="item" href="?area=<?= RequestHandler::MAP_AREA ?>" target="_blank">
				LibreAtlas (new tab)
			</a>
			<div class="right menu">
				<div class="item">
				<form class="ui icon input" method="GET" action="">
					<input type="hidden" name="area" value="<?= RequestHandler::DASHBOARD_AREA ?>" />
					<input type="hidden" name="tab" value="<?= $_GET['tab'] ?>" />
					<input type="text" name="q" placeholder="Search...">
					<i onclick="$(this).closest('form').submit();" class="search link icon"></i>
				</form>
				</div>
				<a class="ui item" href="<?= '?area=' . RequestHandler::DASHBOARD_AREA . '&action=' . RequestHandler::LOGOUT_ACTION ?>" >
				Logout
				</a>
			</div>
		</div>
		<div id="content">
			<?php

				switch ($_GET['tab']) {
					case RequestHandler::API_KEYS_TAB:
						include $GLOBALS['contents'] . '/dashboard/api-keys.php';
						break;

					case RequestHandler::MARKERS_TAB:
						include $GLOBALS['contents'] . '/dashboard/markers.php';
						break;

					default:
						include $GLOBALS['contents'] . '/dashboard/markers.php';
						break;
				}

			?>
		</div>
	</body>
</html>
