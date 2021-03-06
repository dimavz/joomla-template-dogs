<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_breadcrumbs
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('bootstrap.tooltip');
?>

<p>
	<?php if ($params->get('showHere', 1)) : ?>

			<?php echo JText::_('MOD_BREADCRUMBS_HERE'); ?>&#160;

	<?php else : ?>

			<span class="divider icon-location"></span>

	<?php endif; ?>

	<?php
	// Get rid of duplicated entries on trail including home page when using multilanguage
	for ($i = 0; $i < $count; $i++)
	{
		if ($i === 1 && !empty($list[$i]->link) && !empty($list[$i - 1]->link) && $list[$i]->link === $list[$i - 1]->link)
		{
			unset($list[$i]);
		}
	}

	// Find last and penultimate items in breadcrumbs list
	end($list);
	$last_item_key   = key($list);
	prev($list);
	$penult_item_key = key($list);

	// Make a link if not the last item in the breadcrumbs
	$show_last = $params->get('showLast', 1);

	// Generate the trail
	foreach ($list as $key => $item) :
		if ($key !== $last_item_key) :
			// Render all but last item - along with separator ?>
				<?php if (!empty($item->link)) : ?>
					<a  href="<?php echo $item->link; ?>"><?php echo $item->name; ?></a>
				<?php else : ?>
					
						<?php echo $item->name; ?>
					
				<?php endif; ?>

				<?php if (($key !== $penult_item_key) || $show_last) : ?>
					
						<?php echo $separator; ?>
					
				<?php endif; ?>

		<?php elseif ($show_last) :
			// Render last item if reqd. ?>
			
					<?php echo $item->name; ?>
		<?php endif;
	endforeach; ?>
</p>
