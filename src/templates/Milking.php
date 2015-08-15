<?php
/** @var $this HtmlSlimView */
/** @var $model InputViewModel */
?>

<?php $this->setBlock('scripts', function() { ?>
	<script src="/assets/js/pages/milking.js"></script>
<?php }); ?>

<?php $this->setBlock('body', function() use ($model) { ?>
	<?php /** @var $this HtmlSlimView */ ?>

	<?php
	$amount = 50;

	if ($model->getFeeding()->hasMilking())
	{
		$amount = $model->getFeeding()->getMilking();
	}
	?>

	<div id="milking">
		<div class="row">
			<div class="col-md-12">
				<h1>Milking</h1>
			</div>
		</div>

		<form id="milkingForm" action="/milking">

			<div class="row largeCenteredInput">
				<div class="col-md-12">
					<div class="form-group">
						<label>
							Amount [mL]<br>
							<input type="number" min="0" step="10" class="form-control js-form-trigger-submit" name="amount" value="<?php echo $amount ?>">
						</label>
					</div>
				</div>
			</div>

			<?php $this->partial('Commit') ?>

		</form>
	</div>
<?php }) ?>
