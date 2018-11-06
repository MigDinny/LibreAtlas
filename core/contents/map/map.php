<html>
	<head>
		<title><?= Wizard::getHeadTitle(Wizard::MAP_AREA); ?></title>
		<?= Wizard::callAssets(array(Wizard::LIBRARY_JQUERY, Wizard::DARK_MAP_STYLE)); ?>
		<style>
			body {
				margin: 0px;
			}

			#map {
				height: 100%;
				width: 100%;
			}

			#dock {
				position: absolute;
				height: 100%;
				width: 75px;
				background-color: white;
				opacity: 0.5;
				z-index: 100;
				display: none;
			}

			#footer {
				position: absolute;
				/*background-color: white;*/
				z-index: 1000;
				bottom: 0px;
			}

			#centerFooter {
				display: flex;
				justify-content: center;
			}

			#footerLogo {
				height: 80px;
				width: 321px;
			}
		</style>
	</head>
	<body>
		<div id="container">
			<div id="dock"></div>
			<div id="centerFooter">
				<div id="footer">
					<!-- Transparent footer containing LibreHealth's logo -->
					<img id="footerLogo" src="http://librehealth.io/img/logo.png"/>
				</div>
			</div>
			<div id="map"></div>

			<?= Wizard::callMapScript(); ?>

    		<script async defer src="https://maps.googleapis.com/maps/api/js?key=<?= Wizard::getMapsAPIKey(); ?>&callback=initMap"></script>
		</div>
	</body>
</html>
