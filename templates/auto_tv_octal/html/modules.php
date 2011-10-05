<?php
// no direct access
defined('_JEXEC') or die('Restricted access');
function modChrome_slider($module, &$params, &$attribs)
{
	jimport('joomla.html.pane');
	// Initialize variables
	$sliders = & JPane::getInstance('sliders');
	$sliders->startPanel( JText::_( $module->title ), 'module' . $module->id );
	echo $module->content;
	$sliders->endPanel();
}

/*
 * Module chrome that allows for rounded corners by wrapping in nested div tags
 */
function modChrome_module($module, &$params, &$attribs)
{ ?>
		<div class="moduletable<?php echo $params->get('moduleclass_sfx'); ?>" id="Mod<?php echo $module->id; ?>">
			<?php echo $module->content; ?>
    </div>
	<?php
}
?>
