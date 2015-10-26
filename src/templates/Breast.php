<?php
/** @var $this HtmlSlimView */
/** @var $model InputViewModel */
?>

<?php $this->setBlock('scripts', function() { ?>
	<script src="/assets/js/pages/breast.js"></script>
<?php }); ?>

<?php $this->setBlock('body', function() use ($model) { ?>
	<?php /** @var $this HtmlSlimView */ ?>
	<?php
		$seconds = 0;
		$which = '';

		if (!is_null($model->getFeeding()->getBreastLeft())) {
			$seconds = $model->getFeeding()->getBreastLeft();
			$which = 'left';
		}

		else if (!is_null($model->getFeeding()->getBreastRight())) {
			$seconds = $model->getFeeding()->getBreastRight();
			$which = 'right';
		}
	?>
	<div id="breast">
		<div class="row">
			<div class="col-md-12">
				<h1>Breast</h1>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<button id="beginLeft" class="btn btn-block btn-primary">L</button>
			</div>

			<div class="col-md-6">
				<button id="beginRight" class="btn btn-block btn-primary">R</button>
			</div>
		</div>



		<div class="row">
			<div id="counter" class="col-md-12">0:00</div>
		</div>




		<div class="row">
			<div class="col-md-12">
				<button id="pause" class="btn btn-block btn-primary btn-lg"><span class="glyphicon glyphicon-pause"></span></button>
			</div>

			<div class="col-md-12 hidden">
				<button id="play" class="btn btn-block btn-primary btn-lg"><span class="glyphicon glyphicon-play"></span></button>
			</div>
		</div>

		<form id="breastForm" action="/breast">

			<div class="row largeCenteredInput">
				<div class="col-md-12">
					<div class="form-group">
						<label>
							Minutes<br>
							<input type="number" class="form-control js-form-trigger-submit" name="totalMinutes" value="<?php echo floor(bcdiv($seconds, 60)) ?>">
							<input type="hidden" name="totalSeconds" value="<?php echo $seconds ?>">
						</label>
					</div>
				</div>
			</div>

			<input type="hidden" name="whichBoob" value="<?php echo $which ?>">

			<?php $this->partial('Commit') ?>

		</form>
	</div>
<?php }) ?>
