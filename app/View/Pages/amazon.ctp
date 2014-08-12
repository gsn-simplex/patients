<p>
	<?php
		$tock = microtime(true);
		echo '<span class="notice success">';
			$timer = $tock - $tick;
			$ms = round($timer * 1000);
			echo $ms . ' ms';
		echo '</span>';
	?>

	<?php
	pr($buckets);
	?>
</p>
