window.addEvent('domready',function(){
	
	$('checkAll').addEvent('click',function() {
		if($('checkAll').checked){
			$$('input[type="checkbox"]').each(function(item){
				item.checked = true;
			});
		} else {
			$$('input[type="checkbox"]').each(function(item){
				item.checked = false;
			});
		}
	});
});