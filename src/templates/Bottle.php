<?php
/** @var $this HtmlSlimView */
/** @var $model InputViewModel */
?>

<?php $this->setBlock('scripts', function() { ?>
	<script src="/assets/js/pages/bottle.js"></script>
<?php }); ?>

<?php $this->setBlock('body', function() use ($model) { ?>
	<?php /** @var $this HtmlSlimView */ ?>

	<?php
	$amount = 50;
	$type = 'na';

	if ($model->getFeeding()->hasBottle())
	{
		$amount = $model->getFeeding()->getBottle()->getAmount();
		$type = $model->getFeeding()->getBottle()->getType();

		$type = $type == Bottle::TYPE_MILK ? 'milk' : 'formula';
	}
	?>

	<div id="bottle">
		<div class="row">
			<div class="col-md-12">
				<h1>Bottle</h1>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<button id="typeMilk" class="btn btn-block btn-primary">M</button>
			</div>

			<div class="col-md-6">
				<button id="typeFormula" class="btn btn-block btn-primary">F</button>
			</div>
		</div>


		<form id="bottleForm" action="/bottle">

			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<label>
							Amount [mL]<br>
							<input type="number" min="0" step="10" class="form-control js-form-trigger-submit" name="amount" value="<?php echo $amount ?>">
						</label>
					</div>
				</div>
			</div>

			<input type="hidden" name="type" value="<?php echo $type ?>">

			<?php $this->partial('Commit') ?>

		</form>
	</div>
<?php }) ?>
