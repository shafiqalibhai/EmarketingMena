/**
 * YtTools
 * requires mootools version 1.1
 *
 * @author yootheme.com
 * @copyright Copyright (C) 2007 YOOtheme Ltd. & Co. KG. All rights reserved.
 */ 
var YtTools = {
		
	start: function() {
		
		/* Match height of div tags */
		YtTools.setDivHeight();

		/* Accordion menu */
		var accordionFx = new YtAccordionMenu('div#middle ul.menu li.toggler', 'ul.accordion', { accordion: 'slide' });

		/* Main menu */
		var menuFx = new SlideList($E('ul', 'menu'), { transition: Fx.Transitions.backOut, duration: 700, opacity: 0.4 });
		var menuleft = $E('#menu div.left');
		if (menuleft) menuleft.setOpacity(0.5);
		
		/* Top panel */
		var toppanelFx = new YtSlidePanel($E('#toppanel'), $E('#toppanel-wrapper'),
			YtSettings.heightToppanel, { transition: Fx.Transitions.expoOut, duration: 500 });
		toppanelFx.addTriggerEvent('#toppanel-container .trigger');
		toppanelFx.addTriggerEvent('#toppanel .close');

		/* Style switcher */
		var switcherFx = new YtStyleSwitcher($ES('.wrapper'), { 
			widthDefault: YtSettings.widthDefault,
			widthThinPx: YtSettings.widthThinPx,
			widthWidePx: YtSettings.widthWidePx,
			widthFluidPx: YtSettings.widthFluidPx,
			afterSwitch: YtTools.setDivHeight,
			transition: Fx.Transitions.expoOut,
			duration: 500
		});		

		/* Lightbox */
		YtBase.setupLightbox();		
		Lightbox.init();
				
		/* Spotlight */
		var spotlightFx = new YtSpotlight('div.spotlight, span.spotlight');

	},

	/* Match height of div tags */
	setDivHeight: function() {
		YtBase.matchDivHeight('div.topbox div div div', 0, 40);
		YtBase.matchDivHeight('div.bottombox div div div', 0, 40);
		YtBase.matchDivHeight('div.maintopbox div', 0);
		YtBase.matchDivHeight('div.mainbottombox div', 0);
		YtBase.matchDivHeight('div.contenttopbox div', 0);
		YtBase.matchDivHeight('div.contentbottombox div', 0);
	}

};

/* Add functions on window load */
window.addEvent('load', YtTools.start);
