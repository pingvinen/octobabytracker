<?php
/** @var $this HtmlSlimView */
/** @var $model IndexViewModel */
?>

<?php $this->setBlock('body', function() use ($model) { ?>
	<?php /** @var $this HtmlSlimView */ ?>
	<div id="index">
		Track that baby!!

		<table>
			<thead>
				<tr>
					<th>id</th>
					<th>datetime</th>
					<th>left</th>
					<th>right</th>
					<th>bottle</th>
					<th>milking</th>
					<th>pee</th>
					<th>poo</th>
				</tr>
			</thead>

			<tbody>
			<?php foreach($model->getFeedings()->getIterator() as $feeding): ?>
				<?php
					$bType = '';
					$bAmount = '';
					if ($feeding->hasBottle())
					{
						$bType = $feeding->getBottle()->getType() == Bottle::TYPE_MILK ? 'milk' : 'formula';
						$bAmount = $feeding->getBottle()->getAmount() . ' mL';
					}
				?>

				<tr>
					<td><?php echo $feeding->getId() ?></td>
					<td><?php echo $feeding->getDateTime()->format('Y-m-d H:i') ?></td>
					<td><?php echo $feeding->getBreastLeft() ?> minutes</td>
					<td><?php echo $feeding->getBreastRight() ?> minutes</td>
					<td><?php echo $bType ?> <?php echo $bAmount ?></td>
					<td><?php echo $feeding->getMilking() ?> mL</td>
					<td><?php echo DiaperAmount::asString($feeding->getPee()) ?></td>
					<td><?php echo DiaperAmount::asString($feeding->getPoo()) ?></td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	</div>
<?php }) ?>
