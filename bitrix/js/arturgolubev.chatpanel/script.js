(function(window){
	'use strict';
	
	if (window.AGChatpanel)
		return;
	
	window.AGChatpanel = function(arParams)
	{
		this.params = arParams;
		this.settings = {};
		this.objs = {};
		
		this.objs.chatpanel = BX(this.params.panel_id);
		if(this.objs.chatpanel)
		{			
			this.settings.linkCount = this.objs.chatpanel.getAttribute('data-count');
			this.settings.pulse = this.objs.chatpanel.getAttribute('data-pulse');
			this.settings.color = this.objs.chatpanel.getAttribute('data-color');
			this.settings.shadow = this.objs.chatpanel.getAttribute('data-shadow');
			this.settings.showtype = this.objs.chatpanel.getAttribute('data-showtype');
			
			
			this.settings.leftStyle = parseInt(this.objs.chatpanel.getAttribute('data-left'));
			this.settings.bottomStyle = parseInt(this.objs.chatpanel.getAttribute('data-bottom'));
			this.settings.mleftStyle = parseInt(this.objs.chatpanel.getAttribute('data-mleft'));
			this.settings.mbottomStyle = parseInt(this.objs.chatpanel.getAttribute('data-mbottom'));
			
			this.settings.call = this.objs.chatpanel.getAttribute('data-call');
			this.settings.calltime = parseInt(this.objs.chatpanel.getAttribute('data-calltime'));
			this.settings.callrepeat = parseInt(this.objs.chatpanel.getAttribute('data-callrepeat'));
			
			this.objs.chatpanel_button = BX.findChild(this.objs.chatpanel, {"class" : "js-agchatpanel-button"}, true);
			this.objs.chatpanel_href = BX.findChild(this.objs.chatpanel, {"class" : "js-agchatpanel-href"}, true);
			this.objs.chatpanel_panel = BX.findChild(this.objs.chatpanel, {"class" : "js-agchatpanel-panel"}, true);
			
			if(this.objs.chatpanel_button){
				this.objs.animation = BX.findChild(this.objs.chatpanel_button, {"class" : "ag_chatpanel_animation"}, true);
			}else{
				this.objs.animation = BX.findChild(this.objs.chatpanel_href, {"class" : "ag_chatpanel_animation"}, true);
			}
			
			if(this.settings.shadow == 'Y')
				this.objs.chatpanel_shadow = BX("ag-chatpanel-shadow");
			
			
			if(this.settings.call)
			{
				var closeCookieValue = "N";
				var value = "; " + document.cookie;
				var parts = value.split("; " + "ag_cp_ch" + "=");
				if (parts.length == 2) { closeCookieValue = parts.pop().split(";").shift(); };
				
				if(closeCookieValue == 'Y'){
					this.settings.call = 0;
				}
			}
			
			if(this.settings.call)
			{
				this.objs.chatpanel_call = BX.findChild(this.objs.chatpanel, {"class" : "js-agchatpanel-call"}, true);
				this.objs.chatpanel_callclose = BX.findChild(this.objs.chatpanel, {"class" : "js-agchatpanel-callclose"}, true);
				
				if(this.settings.calltime <= 0)
					this.settings.calltime = 100;
				else
					this.settings.calltime = this.settings.calltime * 1000;
			}
			
			this.init();
		}
	};
	
	
	window.AGChatpanel.prototype = {
		init: function()
		{
			// console.log(this.params);
			// console.log(this.settings);
			// console.log(this.objs);
			
			this.initEvents();
			this.setTheme();
			
			BX.style(this.objs.chatpanel, 'display', 'block');
		},
		
		setTheme: function()
		{
			if(this.settings.color)
			{
				if(this.objs.chatpanel_button){
					BX.style(this.objs.chatpanel_button, 'background-color', this.settings.color);
				}	
				
				BX.style(this.objs.animation, 'border-color', this.settings.color);
			}
			
			if(this.settings.call)
			{
				BX.style(this.objs.chatpanel_call, 'border-color', this.settings.color);
				setTimeout(BX.delegate(this.showCall, this), this.settings.calltime);
			}
			
			if(document.body.clientWidth > 768){
				if(this.settings.bottomStyle > 0){
					BX.style(this.objs.chatpanel, 'bottom', this.settings.bottomStyle+'px');
				}
				
				if(this.settings.leftStyle > 0)
				{					
					if(BX.hasClass(this.objs.chatpanel, "desctop_position_right")){
						BX.style(this.objs.chatpanel, 'right', this.settings.leftStyle+'px');
					}
					else if(BX.hasClass(this.objs.chatpanel, "desctop_position_left")){
						BX.style(this.objs.chatpanel, 'left', this.settings.leftStyle+'px');
					}
				}
				
			}else{
				if(this.settings.mbottomStyle > 0){
					BX.style(this.objs.chatpanel, 'bottom', this.settings.mbottomStyle+'px');
				}
				
				if(this.settings.mleftStyle > 0)
				{					
					if(BX.hasClass(this.objs.chatpanel, "mobile_position_right")){
						BX.style(this.objs.chatpanel, 'right', this.settings.mleftStyle+'px');
					}
					else if(BX.hasClass(this.objs.chatpanel, "mobile_position_left")){
						BX.style(this.objs.chatpanel, 'left', this.settings.mleftStyle+'px');
					}
				}
			}
			
			
		},
		
		initEvents: function()
		{
			if(this.settings.showtype != 'open')
				BX.bind(this.objs.chatpanel_button, 'click', BX.proxy(this.clickChatpanelButton, this));
			
			if(this.settings.shadow == 'Y')
				BX.bind(this.objs.chatpanel_shadow, 'click', BX.proxy(this.clickShadow, this));
			
			if(this.settings.call)
				BX.bind(this.objs.chatpanel_callclose, 'click', BX.proxy(this.hideCall, this));
		},
		
		clickShadow: function(){
			if(BX.hasClass(this.objs.chatpanel_panel, "showed"))
				this.hideChatpanel();
		},
		
		clickChatpanelButton: function(){
			if(BX.hasClass(this.objs.chatpanel_panel, "showed"))
				this.hideChatpanel();
			else
				this.showChatpanel();
		},
		
		beforeShowCall: function(){
			BX.style(this.objs.chatpanel_call, 'display', 'block');
			
			if(this.objs.chatpanel_button){
				var h1 = BX.height(this.objs.chatpanel_button);
			}else{
				var h1 = BX.height(this.objs.chatpanel_href);
			}
			
			var h2 = BX.height(this.objs.chatpanel_call), h3 = (h1-h2) / 2;
			
			// console.log(h1);
			// console.log(h2);
			// console.log(h3);
			
			BX.style(this.objs.chatpanel_call, 'top', h3 + 'px');
		},
		
		showCall: function(){
			if(this.settings.call)
			{
				this.beforeShowCall();
				
				var easing = new BX.easing({
					duration: this.params.duration,
					start: { opacity : 0 },
					finish: { opacity: 100 },
					transition: BX.easing.transitions.quart,
					step: BX.delegate(function(state){ this.objs.chatpanel_call.style.opacity = state.opacity/100; }, this),
					complete: function(){}
				});
				easing.animate();
			}
		},
		
		hideCall: function(){
			if(this.settings.call)
			{
				if(this.settings.callrepeat)
				{
					var expires = new Date((new Date).getTime() + (1000 * 60 * this.settings.callrepeat));
					document.cookie = "ag_cp_ch = Y; expires=" + expires.toUTCString() + "; path=" + escape ("/");
				}
				
				BX.style(this.objs.chatpanel_call, 'display', 'none');
				BX.style(this.objs.chatpanel_call, 'opacity', '0');
			}
		},
		
		hideChatpanel: function(){
			if(this.settings.pulse){
				BX.removeClass(this.objs.animation, "stoppulseanim");
			}
			
			if(this.settings.shadow == 'Y')
			{
				var easing = new BX.easing({
					duration: this.params.duration,
					start: {opacity: 100},
					finish: {opacity: 0},
					transition: BX.easing.transitions.quart,
					step: BX.delegate(function(state){ this.objs.chatpanel_shadow.style.opacity = state.opacity/100; }, this),
					complete: BX.delegate(function(){ BX.style(this.objs.chatpanel_shadow, 'display', 'none'); }, this),
				});
				easing.animate();
			}
			
			BX.removeClass(this.objs.chatpanel_panel, "showed");
			BX.removeClass(this.objs.chatpanel_button, "panel_showed");
			
			BX.style(this.objs.chatpanel_panel, 'height', '0px');
		},
		
		showChatpanel: function(){
			this.hideCall();
			this.settings.call = 0;
			
			if(this.settings.pulse){
				BX.addClass(this.objs.animation, "stoppulseanim");
			}
			
			if(this.settings.shadow == 'Y')
			{
				BX.style(this.objs.chatpanel_shadow, 'display', 'block');
				
				var easing = new BX.easing({
					duration: this.params.duration,
					start: { opacity : 0 },
					finish: { opacity: 100 },
					transition: BX.easing.transitions.quart,
					step: BX.delegate(function(state){ this.objs.chatpanel_shadow.style.opacity = state.opacity/100; }, this),
					complete: function(){}
				});
				easing.animate();
			}
			
			BX.addClass(this.objs.chatpanel_panel, "showed");
			BX.addClass(this.objs.chatpanel_button, "panel_showed");
			
			BX.style(this.objs.chatpanel_panel, 'height', (this.settings.linkCount*51+42)+'px');
		},
	};
})(window);

BX.ready(function(){
	var chatpanelObj = new AGChatpanel({
		"duration": 400,
		"panel_id": 'ag-chatpanel-wrap',
	});
});