var src_collap_1 = tmplurl + "/images/icon-min.gif";	
var src_collap_2 = tmplurl + "/images/icon-max.gif";
new Asset.images ([src_collap_1, src_collap_2]);
function testfunc () {
	alert('fdsf');
}
var DragDrop = new Class({

	options: {
		handles: false,
		containers: false,
		onStart: Class.empty,
		onComplete: Class.empty,
		ghost: true,
		snap: 3,
		title: 'h3',
		src_collap_1:'',
		src_collap_2:'',
		
		onDragStart: function(element, ghost){
			ghost.setStyles({'opacity':0.7, 'z-index':100});
			element.getChildren().setStyles({'opacity':0.3, 'z-index':1});
			element.addClass('moving');
		},
		onDragComplete: function(element, ghost){
			element.getChildren().setStyle('opacity', 1);
			element.removeClass('moving');
			ghost.remove();
			this.trash.remove();
		}
	},

	initialize: function(lists, options){			
			//console.log(encodeURIComponent("h%E1%BB%93ng%20c%C3%B4ng"));
		this.setOptions(options);
		this.lists = $$(lists);
		this.lists.sort(function(a,b){return a.getCoordinates().left - b.getCoordinates().left;});
		this.elements = [];
		this.handles = [];				
		
		/*	Get cookies	*/
		this.hc = '';
		if(Cookie.get('ordercolumn')){
			this.hc = Cookie.get('ordercolumn').split(',');
			if(this.hc!=''){
				this.hc.each(function(cc,k){
					this.hc[k] = this.hc[k].split("_");
				},this);
			}			
		}
		
		this.lists.each(function(list){			
			var elements = list.getChildren();
			elements.each(function(el,i){
				el._p = list;	
				if(this.options.title){
					el._h = $E(this.options.title, el);
					if (!el._h) return;
					tmp = el._h.getParent();
					el._h.remove();
					tmp.innerHTML = "<div class=\"mod-content\">"+tmp.innerHTML+"</div>";
					el._innerdiv = tmp.getFirst(); 
					el._h.injectTop (tmp);										
					//el._h._el = el;	
					
					el._pos = i;
					
					if(this.hc){
						//element property: position, container, ...
						this.hc.each(function(val){
							if (val[1] == el._h.innerHTML.trim().substr(0,20)) {
								el._p 			= $(val[0]);
								el._pos 		= parseInt(val[2]);
								el._h.className	= val[3];				
							}
						},this);
					}					
					
					if(el._h.className=="hide"){						
						src_collap = this.options.src_collap_1;
					}
					else{
						el._h.className = 'show';
						src_collap = this.options.src_collap_2;
					}
					
					//create handler for moveable and collapsible hotspot	
					divmd = new Element('span',{'class':'mdtool'});
					divmd.inject(el._h);	
					chdl = new Element('img',{'src':src_collap});
					chdl.setStyle('cursor','pointer');
					chdl.injectBefore(divmd);
					el._h._chdl = chdl;
					
					this.handles.push(el._h);
				}
			},this);

			this.elements.merge(elements);
			
			this.lists.setStyle('visibility','visible');
			
		},this);
		
		
		
		this.elements.each (function (el){
			
			el.remove();
			p = $(el._p);
			if(!p) return ;
			tmp = p.getChildren().length > el._pos ? p.getChildren()[el._pos]:null;
			if (tmp) {
				if (tmp._pos > el._pos) el.injectBefore(tmp);
				else el.injectAfter(tmp);
			}
			else el.inject (p);
			
		});
		
		//this.elements = $$(list);
		this.handles = (this.options.handles) ? $$(this.options.handles) : (this.handles.length?this.handles:this.elements);
		//this.handles.setStyle('cursor', 'move');
		this.bound = {
			'start': [],
			'moveGhost': this.moveGhost.bindWithEvent(this)
		};
		for (var i = 0, l = this.handles.length; i < l; i++){
			this.bound.start[i] = this.start.bindWithEvent(this, this.elements[i]);
		}	
									
		this.attach();
		this.collap();
		
		if (this.options.initialize) this.options.initialize.call(this);
		this.bound.move = this.move.bindWithEvent(this);
		this.bound.end = this.end.bind(this);			
									
		if (window.opera) window.addEvent("unload", this.saveCookies.bind(this));
		else window.addEvent("beforeunload", this.saveCookies.bind(this));

	},

	collap: function(){
		this.lists.each(function(list){
			var elements = list.getChildren();
			elements.each(function(el,i){
				/*	For collap		*/
						
				el.elmain = $E('.mod-content',el);				
				if(!el._h) return;

				el.maxH = el.elmain.getStyle('height').toInt();							
									
				el.elmain.setStyle ('overflow','hidden');
						
				el._h._chdl.addEvent('mousedown', function(e){
					e = new Event(e).stop();
				});
				el._h._chdl.addEvent('click', function(e){
					e = new Event(e).stop();
					el.toggle();
				});	
			
				el.toggle = function(){
					if (el._h.className=='hide'){
						el.show();
					}
					else el.hide();
				}	
				
				el.show = function() {
					el._h.className='show';									
					el._h._chdl.src = src_collap_2;					
					new Fx.Style(el.elmain,'height',{onComplete:el.toggleStatuss}).start(el.elmain.offsetHeight,el.elmain.scrollHeight);
				}	
				el.hide = function() {
					el._h.className='hide';		
					el._h._chdl.src = src_collap_1;
					new Fx.Style(el.elmain,'height',{onComplete:el.toggleStatuss}).start(el.elmain.offsetHeight,0);				
				}
				el.toggleStatuss = function () {					
					el._status=(el._status=='hide')?'show':'hide';										
				}				
								
				if(el._h.className=='hide') {
					el.hide();
				}
				else{
					el.show();
				}
				
			}, this);
		}, this);
	},
	
	
	attach: function(){
		this.handles.each(function(handle, i){
			//handle.addEvent('mousedown', this.bound.start[i]);
			handle.addEvent('mousedown', this.bound.start[i]);
			handle.setStyle('cursor','move');
		}, this);
	},

	detach: function(){
		this.handles.each(function(handle, i){
			handle.removeEvent('mousedown', this.bound.start[i]);
		}, this);
	},

	start: function(event, el){
		this.active = el;
		//this.coordinates = this.list.getCoordinates();
		if (this.options.ghost){
			this.previous = 0;
			var position = el.getPosition();
			this.offsetX = event.page.x - position.x;
			this.offsetY = event.page.y - position.y;
			this.trash = new Element('div').inject(document.body);
			
			this.ghost = el.clone().inject(this.trash).setStyles({
				'position': 'absolute',
				'left': event.page.x - this.offsetX,
				'top': event.page.y - this.offsetY,
				'background':'url(../images/box-br.gif) no-repeat bottom right #ffffff',
				'width': el.offsetWidth
			});			

			document.addListener('mousemove', this.bound.moveGhost);
			this.fireEvent('onDragStart', [el, this.ghost]);
		}
		document.addListener('mousemove', this.bound.move);
		document.addListener('mouseup', this.bound.end);
		this.fireEvent('onStart', el);
		event.stop();
	},

	moveGhost: function(event){
		this.ghost.setStyles({'left': event.page.x-this.offsetX,
													'top': event.page.y-this.offsetY
													});
		event.stop();
	},

	move: function(event){
		var cor = this.active.getCoordinates();
		if(cor.left < event.page.x && event.page.x < cor.right && event.page.y > cor.top && event.page.y < cor.bottom) return;
		/*Find out the hover element*/
		var now = event.page.x;
		var clist = this.lists[0];
		this.lists.each(function(list){
			if (now > list.getCoordinates().left) clist = list;
		}, this);
		
		if(clist == this.active._p) {
			var now = event.page.y;
			this.previous = this.previous || now;
			var up = ((this.previous - now) > 0);
			var prev = this.active.getPrevious();
			var next = this.active.getNext();
			if (prev && up && now < prev._h.getCoordinates().bottom) this.active.injectBefore(prev);
			if (next && !up && now > next._h.getCoordinates().top) this.active.injectAfter(next);
			this.previous = now;
		}else{
			var now = event.page.y;
			
			//Get correct position
			var els = clist.getChildren();
			if(els.length) {
				var cel = els[0];
				els.each(function(el, idx){
					if (now > el._h.getCoordinates().bottom)
					{
						if(idx < els.length - 1) cel = els[idx+1];
						else cel = null;
					}
				},this);

				if(cel) this.active.injectBefore(cel);
				else this.active.inject(clist);
			} else {
				this.active.inject(clist);
			}
			this.active._p = clist;
			this.previous = now;
		}

	},

	serialize: function(converter){
		return this.list.getChildren().map(converter || function(el){
			return this.elements.indexOf(el);
		}, this);
	},

	end: function(){
		this.previous = null;
		document.removeListener('mousemove', this.bound.move);
		document.removeListener('mouseup', this.bound.end);
		if (this.options.ghost){
			document.removeListener('mousemove', this.bound.moveGhost);
			this.fireEvent('onDragComplete', [this.active, this.ghost]);
		}
		this.fireEvent('onComplete', this.active);
	},
	
	saveCookies: function() {
		if (Cookie.get("ordercolumn") == '-') {
			Cookie.set("ordercolumn", '',{path:'/'});
			return;
		}
		c = '';
		this.lists.each(function(list){			
			var elements = list.getChildren();			
			if (!elements){
				return;
			}
			elements.each(function(el,i){
				c += el._p.id + "_" + el._h.innerHTML.trim().substr(0,20) + "_" + i + "_" + el._h.className+",";
			},this);
		},this);
		if (this.hc) {
			this.hc.each(function(value, k){
				if (!c.test ('_' + value[1] + '_')) {
					c += value[0] + "_" + value[1] + "_" + value[2] + "_" + value[3]+",";
				}
			},this);
		}		
		c = c.substr(0, (c.length-1));
		Cookie.set("ordercolumn", c, {duration: 365,path:'/'});
	}
});

document.write('<style type="text/css">.movable-container{visibility: hidden;}</style>');
window.addEvent('load', function(){	
	new DragDrop($$(".movable-container"), {src_collap_1:src_collap_1, src_collap_2:src_collap_2});					
});

DragDrop.implement(new Events, new Options);

Resizer = new Class({
	initialize: function(els, options){
		this.options = Object.extend({
			min: 100,
			max: 0
		}, options || {});
		$$(els).each(function(el){
			el.onmouseover = function(){
				this.addClass('colresizehover');
			};
			
			resizemouseout = function(){
				//console.log('call mouse out event for ' + this);
				this.removeClass('colresizehover');
			}
			el.onmouseout = resizemouseout;

			var prev = el.getPrevious();
			var next = el.getNext();
			prev.makeResizableNew ({handle: el, modifiers:{y:false}, limit:{width:[100]}});
			next.makeResizableNew ({handle: el, modifiers:{y:false}, dir: -1, limit:{width:[100]}});
			var eld = el.makeDraggable({modifiers:{y:false}});

			eld.addEvent('onStart', function (el) {
				//console.log('Remove mouse out for ' + eld.element);
				el.onmouseout = null;
				this._next = el.getNext();
				this._prev = el.getPrevious();
				this._w = this._prev.getStyle('width').toFloat() + this._next.getStyle('width').toFloat();
			});

			eld.addEvent('onComplete', function (el) {
				el.onmouseout = resizemouseout;

				var w1 = this._prev.offsetWidth;
				var w2 = this._next.offsetWidth;
				var w1p = w1/(w1+w2)*this._w;
				var w2p = w2/(w1+w2)*this._w;
				var elwp = el.offsetLeft * this._w / (w1+w2);
				this._prev.setStyle('width', w1p + '%');
				this._next.setStyle('width', w2p + '%');
				el.setStyle ('left', elwp + '%');

				el = el.getCoordinates(this.options.overflown);
				var now = this.mouse.now;
				if (!(now.x > el.left && now.x < el.right && now.y < el.bottom && now.y > el.top)) resizemouseout.call(this.element);

			});
		}.bind( this));
	}
});


Drag.Resize = Drag.Base.extend({

	options: {
		dir: 1
	},

	initialize: function(el, options){
		this.setOptions(options);
		this.parent(el);
	},


	start: function(event){
		this.fireEvent('onBeforeStart', this.element);
		this.mouse.start = event.page;
		var limit = this.options.limit;
		this.limit = {'x': [], 'y': []};
		for (var z in this.options.modifiers){
			if (!this.options.modifiers[z]) continue;
			this.value.now[z] = this.element.getCoordinates()[this.options.modifiers[z]].toInt();
			this.mouse.pos[z] = event.page[z] - this.value.now[z]*this.options.dir;
			if (limit && limit[z]){
				for (var i = 0; i < 2; i++){
					if ($chk(limit[z][i])) this.limit[z][i] = ($type(limit[z][i]) == 'function') ? limit[z][i]() : limit[z][i];
				}
			}
		}
		if ($type(this.options.grid) == 'number') this.options.grid = {'x': this.options.grid, 'y': this.options.grid};
		document.addListener('mousemove', this.bound.check);
		document.addListener('mouseup', this.bound.stop);
		this.fireEvent('onStart', this.element);
		event.stop();
	},

	drag: function(event){
		this.out = false;
		this.mouse.now = event.page;
		for (var z in this.options.modifiers){
			if (!this.options.modifiers[z]) continue;
			//this.value.now[z] = this.mouse.now[z] - this.mouse.pos[z];
			this.value.now[z] = (this.mouse.now[z] - this.mouse.pos[z])*this.options.dir;
			if (this.limit[z]){
				if ($chk(this.limit[z][1]) && (this.value.now[z] > this.limit[z][1])){
					this.value.now[z] = this.limit[z][1];
					this.out = true;
				} else if ($chk(this.limit[z][0]) && (this.value.now[z] < this.limit[z][0])){
					this.value.now[z] = this.limit[z][0];
					this.out = true;
				}
			}
			if (this.options.grid[z]) this.value.now[z] -= (this.value.now[z] % this.options.grid[z]);
			this.element.setStyle(this.options.modifiers[z], this.value.now[z] + this.options.unit);
		}
		this.fireEvent('onDrag', this.element);
		event.stop();
	}

});

/*
Class: Element
	Custom class to allow all of its methods to be used with any DOM element via the dollar function <$>.
*/

Element.extend({

	/*
	Property: makeDraggable
		Makes an element draggable with the supplied options.

	Arguments:
		options - see <Drag.Move> and <Drag.Base> for acceptable options.
	*/

	makeResizableNew: function(options){
		return new Drag.Resize(this, $merge({modifiers: {x: 'width', y: 'height'}}, options));
	}

});