<?php
/**
 * @package     Joomla.Administrator
 * @subpackage  com_media
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$folderName = JFactory::getApplication()->input->get('folder', 'images', 'path');

JHtml::_('stylesheet', 'media/popup-imagelist.css', array(), true);

if (JFactory::getLanguage()->isRtl())
{
	JHtml::_('stylesheet', 'media/popup-imagelist_rtl.css', array(), true);
}

//JFactory::getDocument()->addScriptDeclaration("var ImageManager = window.parent.ImageManager;");
JFactory::getDocument()
	->addStyleDeclaration("
		@media (max-width: 767px) {
			li.imgOutline.thumbnail.height-80.width-80.center {
				float: left;
				margin-left: 15px;
			}
		}
	");
?>
<div>
	<h3><?php echo JText::sprintf('COM_MEDIA_DISPLAY_CONTENT_OF', '/images/' . $folderName); ?></h3>
</div>
<?php if (count($this->files) > 0 || count($this->folders) > 0) : ?>
	<ul class="manager thumbnails">
		<?php if (isset($this->folders['children'])) : ?>
			<?php foreach ($this->folders['children'] as $folderName => $folderStructure) : ?>
				<?php $this->setFolderByName($folderName); ?>
				<?php echo $this->loadTemplate('folder'); ?>
			<?php endforeach; ?>
		<?php endif; ?>

		<?php /*for ($i = 0, $n = count($this->folders); $i < $n; $i++) :
			$this->setFolder($i);
			// @TODO for Dimitris: Lazyload the layout of each media type (?)
			echo $this->loadTemplate('folder');
		endfor;*/ ?>

		<?php for ($i = 0, $n = count($this->files); $i < $n; $i++) : ?>
			<?php $this->setFile($i); ?>
			<?php echo $this->loadTemplate('file'); ?>
		<?php endfor; ?>
	</ul>
<?php else : ?>
	<div id="media-noimages">
		<div class="alert alert-info"><?php echo JText::_('COM_MEDIA_NO_IMAGES_FOUND'); ?></div>
	</div>
<?php endif; ?>
