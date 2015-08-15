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
		$minutes = 0;
		$which = '';

		if ($model->getFeeding()->getBreastLeft() > 0) {
			$minutes = $model->getFeeding()->getBreastLeft();
			$which = 'left';
		}

		else if ($model->getFeeding()->getBreastRight() > 0) {
			$minutes = $model->getFeeding()->getBreastRight();
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

			<div class="col-md-12">
				<button id="play" class="btn btn-block btn-primary btn-lg"><span class="glyphicon glyphicon-play"></span></button>
			</div>
		</div>

		<form id="breastForm" action="/breast">

			<div class="row" id="totalMinutesRow">
				<div class="col-md-12">
					<div class="form-group">
						<label>
							Minutes<br>
							<input type="number" class="form-control js-form-trigger-submit" name="totalMinutes" value="<?php echo $minutes ?>">
						</label>
					</div>
				</div>
			</div>

			<input type="hidden" name="whichBoob" value="<?php echo $which ?>">

			<?php $this->partial('Commit') ?>

		</form>
	</div>
<?php }) ?>
