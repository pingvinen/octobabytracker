<?php
/** @var $this HtmlSlimView */
/** @var $model IndexViewModel */
?>

<?php $this->setBlock('body', function() use ($model) { ?>
	<?php /** @var $this HtmlSlimView */ ?>
	<div id="index">

		<div class="row">
			<div class="col-sm-6">
				<a href="/milking" class="btn btn-primary btn-lg btn-block">Milking</a>
			</div>

			<div class="col-sm-6">
				<a href="/bottle" class="btn btn-primary btn-lg btn-block">Bottle</a>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-6">
				<a href="/diaper" class="btn btn-primary btn-lg btn-block">Diaper</a>
			</div>

			<div class="col-sm-6">
				<a href="/breast" class="btn btn-primary btn-lg btn-block">Breast</a>
			</div>
		</div>

	</div>
<?php }) ?>
