<?php
/** @var $this HtmlSlimView */
/** @var $model InputViewModel */
?>

<?php $this->setBlock('scripts', function() { ?>
	<script src="/assets/js/pages/diaper.js"></script>
<?php }); ?>

<?php $this->setBlock('body', function() use ($model) { ?>
	<?php /** @var $this HtmlSlimView */ ?>
	<div id="diaper">

		<form id="diaperForm" action="/diaper">

			<div class="row">
				<div class="col-md-12">
					<h1>Diaper</h1>
				</div>
			</div>

			<div class="row">
				<?php
				/**************************************
				 * Pee
				 **************************************/
				?>
				<div class="col-md-6">
					<h2>Pee</h2>

					<?php foreach(DiaperAmount::all() as $amount): ?>

					<div class="radio">
						<label>
							<input class="js-form-trigger-submit" type="radio" name="pee" value="<?php echo $amount ?>" <?php if ($model->getFeeding()->getPee() == $amount) { echo 'checked="checked"'; } ?>>
							<?php echo DiaperAmount::asString($amount) ?>
						</label>
					</div>

					<?php endforeach; ?>
				</div>

				<?php
				/**************************************
				 * Poo
				 **************************************/
				?>
				<div class="col-md-6">
					<h2>Poo</h2>

					<?php foreach(DiaperAmount::all() as $amount): ?>

						<div class="radio">
							<label>
								<input class="js-form-trigger-submit" type="radio" name="poo" value="<?php echo $amount ?>" <?php if ($model->getFeeding()->getPoo() == $amount) { echo 'checked="checked"'; } ?>>
								<?php echo DiaperAmount::asString($amount) ?>
							</label>
						</div>

					<?php endforeach; ?>
				</div>
			</div>

			<?php $this->partial('Commit') ?>

		</form>
	</div>
<?php }) ?>
