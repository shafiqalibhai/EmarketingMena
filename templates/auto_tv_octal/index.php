<?php
defined( '_JEXEC' ) or die( 'Restricted access' );
include_once (dirname(__FILE__).DS.'params.php');
include_once (dirname(__FILE__).DS.'/tools.php');
$mainframe =& JFactory::getApplication('site');
$tools = new Tools($this, array());
$left = $this->countModules( 'left' );
$right = $this->countModules( 'right' );

if ( ( $right || $this->countModules('right_top')) ) {
	$divid = '-c';
} else {
	$divid = '';
}

$user4 = $this->countModules('user4');
$user5 = $this->countModules('user5');

if ( $user4 && $user5 ) {
	$divid_c = '';
} elseif ( ($user4 || $user5) ) {
	$divid_c = '-c';
} else {
	$divid_c = '-f';
}
?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>">
<head>
<jdoc:include type="head" />
<?php JHTML::_('behavior.mootools'); ?>
<link rel="stylesheet" href="<?php echo $tools->baseurl(); ?>templates/system/css/system.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $tools->baseurl(); ?>templates/system/css/general.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $tools->templateurl(); ?>/css/template.css" type="text/css" />
<link rel="stylesheet" href="<?php echo $tools->templateurl(); ?>/css/menu.css" type="text/css" />
<script language="javascript" type="text/javascript">
	var siteurl = '<?php echo $tools->baseurl();?>';
	var tmplurl = '<?php echo $tools->templateurl();?>';
</script>
<script language="javascript" type="text/javascript" src="<?php echo $tools->templateurl(); ?>/js/js.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $tools->templateurl(); ?>/js/mod.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $tools->templateurl(); ?>/js/menu.js"></script>
<!--[if lte IE 6]>

<link href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/ieonly.css" rel="stylesheet" type="text/css" />

<style type="text/css">
.clearfix {height: 1%;}
img {border: none;}
div.wrapper .wrapper-br {
	height: 470px;
}
</style>
<![endif]-->
<!--[if gte IE 7.0]>
<style type="text/css">
.clearfix {display: inline-block;}
</style>
<![endif]-->
</head>
<body id="bd" >


	<div id ="outer">
	
	
		<div id="headerOuter">
		
			<div id="headerTop">
				
				<div id="flash">
					<jdoc:include type="modules" name="header" style="raw" />
				</div>
				<?php if ($this->countModules('menu')): ?>
				<div id="mosttopmenu" >
					<jdoc:include type="modules" name="menu" />
				</div>
				<?php endif; ?>
			</div>
				
		</div><!-- headerOuter ID Div closed-->
	
		<div id="containerwrap" >
			<div id="container" class="clearfix">
			
				
				<div id="contentwrap<?php echo $divid; ?>">
					
					<?php if($tools->isFrontPage()) : ?>
						<div >
							<jdoc:include type="modules" name="featured" style="rounded" />
						</div>
						
						<div class="clearfix"></div>
						<?php 
							if($user4): 
						?>
						<div class="contentcol1<?php echo $divid_c;?>" id="col1">
							<div id="col1">
								<div class="innerpad clearfix movable-container" id="movable1">
									<jdoc:include type="modules" name="user4" style="rounded" />
								</div>
							</div>
						</div>
						<?php 
						endif;
						?>
						<?php 
							if($user5): 
						?>
						<div class="contentcol2<?php echo $divid_c;?>">
							<div id="col2">
								<div class="innerpad clearfix movable-container" id="movable2">
									<jdoc:include type="modules" name="user5" style="rounded" />
								</div>
							</div>
						</div>
						<?php 
						endif;
					else:
					?>
					<div id="content" class="box-br">
						<div class="box-bl">
							<div class="box-tr">
								<div class="box-tl">
									<jdoc:include type="message" />
									<div id="current-content" class="clearfix">
										<jdoc:include type="component" />
				    				</div>
								</div>
							</div>
						</div>
					</div>
					<?php
					endif;
					?>
					
				
				</div><!-- contentwrap ID Div closed-->
				<?php 
				if($right || $this->countModules('right_top')):
				?>
				<div id="rightwrap">
					<div id="col3">
					<jdoc:include type="modules" name="right_top" style="rounded" />
					<div class="innerpad clearfix movable-container" id="movable3">
						<jdoc:include type="modules" name="right" style="rounded" />
					</div>
					</div>
					
					
				</div><!-- rightwrap ID Div closed-->
				<?php
				endif;
				?>
				
			</div>
			<div class="bgspacer">&nbsp;</div>
		</div>
		
		<?php
		$spotlight = array ('bottom1','bottom2','bottom3');
		$bottom = $tools->calSpotlight ($spotlight,99);
		if( $bottom ) :
		?>
		<div id="bottomwrapper"><div id="bottom" ><div class="wrapper"><div class="wrapper-t"><div class="wrapper-b"><div class="wrapper-l"><div class="wrapper-r"><div class="wrapper-tl"><div class="wrapper-tr"><div class="wrapper-bl"><div class="wrapper-br"><div class="inside_wrapper">
			  <?php if( $this->countModules('bottom1') ): ?>
			  <div class="box<?php echo $bottom['bottom1']['class']; ?>" style="width: <?php echo $bottom['bottom1']['width']; ?>;">
					<jdoc:include type="modules" name="bottom1" style="xhtml" />
			  </div>
			  <?php endif; ?>
			  <?php if( $this->countModules('bottom2') ): ?>
			  <div class="box<?php echo $bottom['bottom2']['class']; ?>" style="width: <?php echo $bottom['bottom2']['width']; ?>;">
					<jdoc:include type="modules" name="bottom2" style="xhtml" />
			  </div>
			  <?php endif; ?>
			  <?php if( $this->countModules('bottom3') ): ?>
			  <div class="box<?php echo $bottom['bottom3']['class']; ?>" style="width: <?php echo $bottom['bottom3']['width']; ?>;">
					<jdoc:include type="modules" name="bottom3" style="xhtml" />
			  </div>
			  <?php endif; ?>
			
			</div>
		</div></div></div></div></div></div></div></div></div></div></div>
		<?php endif; ?>
		
		<div id="footerwrap">
			<div id="footer" >
				<div id="footer_copyrights">
					<jdoc:include type="modules" name="copyright" />
				</div>
				<div id="footermenu">
					<jdoc:include type="modules" name="footer" />
				</div>
			</div>
		</div>
	</div> <!-- Outer ID Div closed-->

<jdoc:include type="modules" name="debug" />

</body>
</html>