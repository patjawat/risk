<?php
use risk\models\AdministrationError;
$sum = 0;
?>
<table class="table">
	<?php foreach (AdministrationError::find()->all() as $key): ?>
		<tr>
			<td><?=$x=$key->price?><?php $sum=$sum+$x;?></td>
		</tr>
	<?php endforeach; ?>
</table>

ผลรวม<?=$sum;?><br>
