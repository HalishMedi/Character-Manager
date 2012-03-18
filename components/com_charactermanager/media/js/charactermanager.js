window.addEvent('domready',function(){
	
	$$('.com-cm-avatar').addEvents({
		'mouseenter':function(){
			this.getElement('img').setStyle('display','block');
		},
		'mouseleave':function(){
			this.getElement('img').setStyle('display','none');
		}	
	});

});
