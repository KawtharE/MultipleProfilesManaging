<!DOCTYPE html>
<html lang="en" ng-app="ProfilesManaging">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Multiple Profiles Managing</title>

    <!--CSS files-->
    <link href='https://fonts.googleapis.com/css?family=Tangerine' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Times New Roman' rel='stylesheet' type='text/css'>
	<link href="AngularProject/node_modules/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="AngularProject/node_modules/angular-material/angular-material.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="AngularProject/css/main.css">

	<!--JS files-->
	<script src="AngularProject/node_modules/angular/angular.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="AngularProject/node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="AngularProject/node_modules/angular-ui-router/release/angular-ui-router.js"></script>
	<script src="AngularProject/node_modules/angular-aria/angular-aria.js"></script>
	<script src="AngularProject/node_modules/angular-animate/angular-animate.js"></script>
	<script src="AngularProject/node_modules/angular-material/angular-material.js"></script>
	<script src="AngularProject/node_modules/angular-messages/angular-messages.js"></script>
	<script src="AngularProject/node_modules/angular-smart-table/dist/smart-table.js"></script>
	<script src="AngularProject/node_modules/angular-ui-bootstrap/dist/ui-bootstrap-tpls.js"></script>


	<script src="AngularProject/js/app.js"></script>
	<script src="AngularProject/js/FormController.js"></script>
	<script src="AngularProject/js/ProfilesController.js"></script>
</head>
<body>
<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<ui-view ></ui-view>
		</div>
	</div>
</div>
</body>
</html>