<?php
/**
 * YOOlogin
 *
 * @author		yootheme.com
 * @copyright	Copyright (C) 2007 YOOtheme Ltd. & Co. KG. All rights reserved.
 */
 
// no direct access
defined('_JEXEC') or die('Restricted access'); ?>

<?php

$text_in = 1;        /* 0 label, 1 input (Username/Password text in label or input field) */
$auto_remember = 1;  /* 0 false, 1 true (Disable/Enable to remember automatically) */
$login_button = 1;   /* 0 false, 1 true (Login Button with Text or not) */
$logout_button = 0;  /* 0 false, 1 true (Logout Button with Text or not) */
$lost_password = 0;  /* 0 false, 1 true (Show/Hide lost password link) */
$lost_username = 0;  /* 0 false, 1 true (Show/Hide lost username link) */
$registration_enabled = 0; /* 0 false, 1 true (Show/Hide registration link) */

?>

<?php if($type == 'logout') : ?>

<div id="yoo-logout">
<form action="index.php" method="post" name="login">
<?php if ($params->get('greeting')) : ?>
	<div class="yoo-greeting"><?php echo JText::sprintf( 'HINAME', $user->get('name') ); ?></div>
<?php endif; ?>
	<div class="yoo-logout-button">
		<button value="<?php if ( !$logout_button ) { echo JText::_( 'BUTTON_LOGOUT'); } ?>" name="Submit" type="submit"><?php if ( !$logout_button ) { echo JText::_( 'BUTTON_LOGOUT'); } ?></button>
	</div>

	<input type="hidden" name="option" value="com_user" />
	<input type="hidden" name="task" value="logout" />
	<input type="hidden" name="return" value="<?php echo $return; ?>" />
</form>
</div>

<?php else : ?>

<div id="yoo-login">
<form action="<?php echo JRoute::_( 'index.php', true, $params->get('usesecure')); ?>" method="post" name="login">
	<?php echo $params->get('pretext'); ?>
	
	<div class="yoo-username">
	<?php if ( $text_in) { ?>
		<input name="username" id="mod_login_username" type="text" class="inputbox" size="10" alt="<?php echo JText::_( 'Username' ); ?>" value="<?php echo JText::_( 'Username' ); ?>" onblur="if(this.value=='') this.value='<?php echo JText::_( 'Username' ); ?>';" onfocus="if(this.value=='<?php echo JText::_( 'Username' ); ?>') this.value='';" />
	<?php } else { ?>
		<label for="mod_login_username"><?php echo JText::_( 'Username' ); ?></label>
		<br />
		<input name="username" id="mod_login_username" type="text" class="inputbox" size="10" alt="<?php echo JText::_( 'Username' ); ?>" />
	<?php } ?>
	</div>
	
	<div class="yoo-password">
	<?php if ( $text_in) { ?>
		<input type="password" id="mod_login_password" name="passwd" class="inputbox" size="10" alt="<?php echo JText::_( 'Password' ); ?>" value="<?php echo JText::_( 'Password' ); ?>" onblur="if(this.value=='') this.value='<?php echo JText::_( 'Password' ); ?>';" onfocus="if(this.value=='<?php echo JText::_( 'Password' ); ?>') this.value='';" />
	<?php } else { ?>
		<label for="mod_login_password"><?php echo JText::_( 'Password' ); ?></label>
		<br />
		<input type="password" id="mod_login_password" name="passwd" class="inputbox" size="10" alt="<?php echo JText::_( 'Password' ); ?>" />
	<?php } ?>
	</div>
	
	<?php if ( $auto_remember ) { ?>
	<input type="hidden" name="remember" value="yes" />
	<?php } else { ?>
	<div class="yoo-remember">
		<input type="checkbox" name="remember" id="mod_login_remember" class="inputbox" value="yes" alt="<?php echo JText::_( 'Remember me' ); ?>" />
		<label for="mod_login_remember"><?php echo JText::_( 'Remember me' ); ?></label>
	</div>
	<?php } ?>
	
	<div class="yoo-login-button">
		<button value="<?php if ( !$login_button ) { echo JText::_( 'BUTTON_LOGIN'); } ?>" name="Submit" type="submit"><?php if ( !$login_button ) { echo JText::_( 'BUTTON_LOGIN'); } ?></button>
	</div>
	
	<div class="yoo-break"></div>
	
	<?php if ( $lost_password ) { ?>
	<div class="yoo-lostpassword">
		<a href="<?php echo JRoute::_( 'index.php?option=com_user&view=reset' ); ?>"><?php echo JText::_('FORGOT_YOUR_PASSWORD'); ?></a>
	</div>
	<?php } ?>
	
	<?php if ( $lost_username ) { ?>
	<div class="yoo-lostusername">
		<a href="<?php echo JRoute::_( 'index.php?option=com_user&view=remind' ); ?>"><?php echo JText::_('FORGOT_YOUR_USERNAME'); ?></a>
	</div>
	<?php } ?>
	
	<?php
	$usersConfig = &JComponentHelper::getParams( 'com_users' );
	if ($usersConfig->get('allowUserRegistration') && $registration_enabled) { ?>
	<div class="yoo-registration">
		<?php echo JText::_( 'No account yet?'); ?>
		<a href="<?php echo JRoute::_( 'index.php?option=com_user&task=register' ); ?>"><?php echo JText::_( 'Register'); ?></a>
	</div>
	<?php } ?>
	
	<?php echo $params->get('posttext'); ?>
	
	<input type="hidden" name="option" value="com_user" />
	<input type="hidden" name="task" value="login" />
	<input type="hidden" name="return" value="<?php echo $return; ?>" />
	<?php echo JHTML::_( 'form.token' ); ?>
</form>
</div>

<?php endif; ?>
