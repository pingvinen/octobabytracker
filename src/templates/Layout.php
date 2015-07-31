<?php
/** @var $this HtmlSlimView */
/** @var $model LayoutViewModel */
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>
		<?php echo $model->getTitle(); ?>
	</title>

	<link href="/assets/css/normalize.css" rel="stylesheet">
	<link href="/assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="/assets/css/bootstrap-theme.min.css" rel="stylesheet">
	<link href="/assets/css/public.css" rel="stylesheet">

	<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>

<div class="container-fluid">
	<div class="row-fluid">
		<div class="span12">
			<div id="alertBoxContainer"></div>
		</div>
	</div>

	<div class="row-fluid">
		<div class="span12">
			<?php $this->outputBlock('body'); ?>
		</div>
	</div>
</div>

<?php $this->outputOptionalBlock('scripts'); ?>
</body>
</html>
