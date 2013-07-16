<?php
use BootstrapPHP\Helpers\View;
use BootstrapPHP\Helpers\Html;
use BootstrapPHP\Progress;
use BootstrapPHP\ProgressStack;
use BootstrapPHP\ProgressBar;
use BootstrapPHP\ProgressStackBar;

if (false) {class view_progress{}};

/** @var Progress|ProgressStack $progress */

$_progress = clone $progress;
?>
<div
	<?= Html::getId($_progress->attributes); ?>
	class="
		progress
		<?= ( ($_progress instanceof Progress) 								? $_progress->getType()	: '' ); ?>
		<?= ( ($_progress instanceof Progress && $_progress->getStriped()) 	? 'progress-striped ' 	: '' ); ?>
		<?= ( ($_progress instanceof Progress && $_progress->getAnimated()) ? 'active ' 			: '' ); ?>
		<?= Html::getClasses($_progress->attributes); ?>
	"
	<?= Html::getData($_progress->attributes); ?>
>
<?php
	/** @var ProgressBar|ProgressStackBar $bar */
	foreach((array) $_progress->getBars() as $bar):

		$id 		= '';
		$classes	= '';
		$data 		= '';
		if (
				($bar instanceof ProgressStackBar)
			&&	($attributes = $bar->getAttributes())
		)
		{
			$id 		= Html::getId($attributes);
			$classes	= Html::getClasses($attributes);
			$data 		= Html::getData($attributes);
		}
?>
		<div
			<?= $id; ?>
			class="
				bar
				<?= ( ($bar instanceof ProgressStackBar) ? $bar->getType() : '' ); ?>
				<?= $classes; ?>
			"
			<?= $data; ?>
			style="width: <?= $bar->getValue(); ?>%;"
		>
			<?= $bar->getText(); ?>
		</div>
<?php
	endforeach;
?>
</div>