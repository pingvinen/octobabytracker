<?php
/** @var $this HtmlSlimView */
/** @var $model LogViewModel */

function bottle(Feeding $feeding)
{
	if (!$feeding->hasBottle())
	{
		return '';
	}

	$type = $feeding->getBottle()->getType() == Bottle::TYPE_MILK ? 'milk' : 'formula';
	$amount = $feeding->getBottle()->getAmount() . ' mL';

	return $amount . ' mL ' . $type;
}

function breast($value)
{
	if (empty($value))
	{
		return '';
	}

	return $value . ' minutes';
}

function milking(Feeding $feeding)
{
	if (!$feeding->hasMilking())
	{
		return '';
	}

	return $feeding->getMilking() . ' mL';
}

?>

<?php $this->setBlock('body', function() use ($model) { ?>
	<?php /** @var $this HtmlSlimView */ ?>
	<div id="log">

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
				<tr>
					<td><?php echo $feeding->getId() ?></td>
					<td><?php echo $feeding->getDateTime()->format('Y-m-d H:i') ?></td>
					<td><?php echo breast($feeding->getBreastLeft()) ?></td>
					<td><?php echo breast($feeding->getBreastRight()) ?></td>
					<td><?php echo bottle($feeding) ?></td>
					<td><?php echo milking($feeding) ?></td>
					<td><?php echo DiaperAmount::asString($feeding->getPee()) ?></td>
					<td><?php echo DiaperAmount::asString($feeding->getPoo()) ?></td>
				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	</div>
<?php }) ?>
