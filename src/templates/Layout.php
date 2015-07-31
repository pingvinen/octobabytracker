<?php
/** @var $this HtmlSlimView */
/** @var $model LayoutViewModel */
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>
		<?php echo $model->getTitle(); ?>
	</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="description" content="">
	<meta name="author" content="">

	<link href="/assets/css/public.css" rel="stylesheet">

	<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
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
