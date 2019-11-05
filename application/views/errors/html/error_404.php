<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="EVS WEB, Web-based Electronic Voting System">
    <meta name="author" content="rpbaguio, Team <01/>">
    <title><?= $heading; ?></title>
    <link rel="preconnect" href="//fonts.gstatic.com/" crossorigin>
    <link rel="icon" href="../public/assets/images/favicon.ico">
    <link rel="stylesheet" href="../public/assets/dist/css/corporate.css">
</head>

<body>
	<main class="main d-flex w-100">
		<div class="container d-flex flex-column">
			<div class="row h-100">
				<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center">
							<h1 class="display-1 font-weight-bold">404</h1>
							<p class="h1">Page Not Found</p>
							<p class="h2 font-weight-normal mt-3 mb-4"><?= $message; ?></p>
							<a href="../" class="btn btn-primary btn-lg">Return to website</a>
						</div>

					</div>
				</div>
			</div>
		</div>
	</main>
</body>
</html>