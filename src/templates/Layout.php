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
	<link href="/assets/css/jquery-ui.min.css" rel="stylesheet">
	<link href="/assets/css/public.css" rel="stylesheet">

	<?php $this->outputOptionalBlock('head'); ?>

	<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>

<nav class="navbar navbar-fixed-top navbar-inverse">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a class="navbar-brand" href="/">BabyTracker</a>
		</div>
		<div id="navbar" class="collapse navbar-collapse">
			<ul class="nav navbar-nav">
				<li><a href="/diaper">Diaper</a></li>
				<li><a href="/milking">Milking</a></li>
				<li><a href="/bottle">Bottle</a></li>
				<li><a href="/breast">Breast</a></li>
				<li><a href="/log">Log</a></li>
			</ul>
		</div><!-- /.nav-collapse -->
	</div><!-- /.container -->
</nav><!-- /.navbar -->

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

<script src="/assets/js/external/jquery-2.1.4.min.js"></script>
<script src="/assets/js/external/jquery-ui.min.js"></script>
<script src="/assets/js/external/bootstrap.min.js"></script>
<script src="/assets/js/fixbrowserinconsistencies.js"></script>
<script src="/assets/js/lib/pagevisibility.js"></script>
<script src="/assets/js/lib/viewport.js"></script>
<script src="/assets/js/lib/ajax.js"></script>
<script src="/assets/js/lib/form.js"></script>

<script src="/assets/js/pages/layout-before.js"></script>
<?php $this->outputOptionalBlock('scripts'); ?>
<script src="/assets/js/pages/layout-after.js"></script>
<script src="/assets/js/ajaxify-forms.js"></script>
</body>
</html>
