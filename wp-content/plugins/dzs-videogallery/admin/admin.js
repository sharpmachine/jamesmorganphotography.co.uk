var $ = jQuery.noConflict();
var sliderIndex = 0;
var itemIndex = [0];
var currSlider_nr=-1;
var currSlider;
var targetInput;

function sliders_ready(){
    var $ = jQuery.noConflict();
                    $('.saveconfirmer').fadeOut('slow');
	$('.add-slider').bind('click', sliders_addslider);
	
	$('.item-preview').live('click', item_open);
	//currSlider = $('.slider-con').eq(currSlider_nr);
	$('.master-save').bind('click', sliders_saveall);
	$('.main-id').live('change', sliders_change_mainid);
	$('.main-thumb').live('change', sliders_change_mainthumb);
	$('.slider-edit').live('click', sliders_click_slideredit)
	$('.slider-duplicate').live('click', sliders_click_sliderduplicate)
	$('.slider-delete').live('click', sliders_click_sliderdelete)
	$('.item-delete').live('click', sliders_click_itemdelete)
	$('.item-duplicate').live('click', sliders_click_itemduplicate)
	$('.upload_file').live('click', sliders_wpupload);
	$('.item-type').live('change', sliders_itemchangetype);
	$('.item-type').trigger('change');
	
	
	
	$('.picker-con .the-icon').live('click', function(){
		var $t = $(this);
		var $c = $t.parent().children('.picker');
		if($c.css('display')=='none'){
			$c.fadeIn('fast');
		}else{
			$c.fadeOut('fast');
		}
	})
	
	jQuery('.import-export-db-con .the-toggle').click(function(){
		var $t = jQuery(this);
		var $cont = $t.parent().children('.the-content-mask');
		/*
		if($cont.css('display')=='none')
		$cont.slideDown('slow');
		else
		$cont.slideUp('slow');
		*/
		var cont_h = $cont.children('.the-content').height() + 50;
		if($cont.css('height')=='0px')
		$cont.stop().animate({
			'height' : cont_h
		}, 200);
		else
		$cont.stop().animate({
			'height' : 0
		}, 200);
		
	});
	
	
	
}
function sliders_reinit(){
var $ = jQuery.noConflict();
	
    //$('#picker1').farbtastic('#color1');
    $('.with_colorpicker').each(function(){
    	var $t = $(this);
    	if($t.hasClass('treated')){
    		return;
    	}
    	$t.next().find('.picker').farbtastic($t);
    	$t.addClass('treated');
    })
}
function sliders_itemchangetype(){
var $ = jQuery.noConflict();
	var $t = jQuery(this);
	var selval = $t.find(':selected').val();
	//var 
	var target = $t.parent().parent().parent().find('.main-source');
	//console.log($t);
	if(selval=='inline'){
		target.css({
			'height' : 80,
			'resize' : 'vertical'
		});
	}else{
		target.css({
			'height' : 23,
			'resize' : 'none'
		});
	}
	
}
function sliders_wpupload(){
var $ = jQuery.noConflict();
    targetInput = jQuery(this).prev();
	tb_show('', 'media-upload.php?type=image&amp;TB_iframe=true&amp;post_id=1&amp;width=640&amp;height=105');

	window.send_to_editor = function (arg) {
	    var fullpath = arg;
	    var fullpathArray = fullpath.split('>');
	    //fullpath = fullpathArray[1] + '>';


	    var aux3 = jQuery(fullpath).attr('href');


	    targetInput.val(aux3);
		targetInput.trigger('change');
	    tb_remove();
	}



return false;
}
function sliders_click_slideredit(){
var $ = jQuery.noConflict();
	var index = $('.slider-edit').index(jQuery(this));
	sliders_showslider(index);
	return false;
}
function sliders_click_sliderduplicate(){
var $ = jQuery.noConflict();
	var index = $('.slider-duplicate').index(jQuery(this));
	//sliders_showslider(index);
	
	$('.main_sliders').children('tbody').append('<tr class="slider-in-table"><td>'+jQuery('.slider-con').eq(index).find('.main-id').eq(0).val()+'</td><td class="button_view"><strong><a href="#" class="slider-action slider-edit">Edit</a></strong></td><td class="button_view"><strong><a href="#" class="slider-action slider-duplicate">Duplicate</a></strong></td><td class="button_view"><strong><a href="#" class="slider-action slider-delete">Delete</a></strong></td></tr>')
	$('.master-settings').append(jQuery('.slider-con').eq(index).clone());
	for(i=0; i<$('.slider-con').eq(sliderIndex).find('.textinput').length;i++){
		var $cache = $('.slider-con').eq(sliderIndex).find('.textinput').eq(i);
		sliders_rename($cache, sliderIndex, 'same')
	}
	
	
	for(i=0;i<$('.slider-con').eq(index).find('textarea').length;i++){
		var $c = $('.slider-con').last().find('textarea').eq(i);
		//console.log($c);
		$c.val($('.slider-con').eq(index).find('textarea').eq(i).val());
	}
	
	sliders_addlisteners();
	itemIndex[sliderIndex] = 0;
	++sliderIndex;
	
	
	
	return false;
}
function sliders_click_itemdelete(){
var $ = jQuery.noConflict();
	var index = currSlider.find('.item-delete').index(jQuery(this));
	//console.log(index, itemIndex[currSlider_nr])
	currSlider.find('.item-con').eq(index).remove();
	var arg=index;
	if(arg<itemIndex[currSlider_nr]-1){
		for(i=arg;i<itemIndex[currSlider_nr]-1;i++){
			var $c = currSlider.find('.item-con').eq(i);
			for(j=0; j<$c.find('.textinput').length;j++){
			sliders_rename($c.find('.textinput').eq(j), currSlider_nr, i);
			}
		}
	}
	itemIndex[currSlider_nr]--;
	return false;
}
function sliders_click_itemduplicate(){
var $ = jQuery.noConflict();
	var index = currSlider.find('.item-duplicate').index(jQuery(this));
	var $cache = currSlider.find('.items-con').eq(0);
	$cache.append(jQuery(this).parent().clone());
	console.log($cache.children().last());
	for(i=0;i<$cache.children().last().find('.textinput').length;i++){
		sliders_rename($cache.children().last().find('.textinput').eq(i), currSlider_nr, itemIndex[currSlider_nr]);
	}
	for(i=0;i<$cache.children().last().find('textarea').length;i++){
		var $c = $cache.children().last().find('textarea').eq(i);
		$c.val($cache.children().eq(index).find('textarea').eq(i).val());
	}
	setTimeout(reskin_select, 10)
		itemIndex[currSlider_nr]++;
		
	return false;
	//sliders_showslider(index);
	
}
function sliders_click_sliderdelete(){
var $ = jQuery.noConflict();
	var index = $('.slider-delete').index(jQuery(this));
	sliders_deleteslider(index);
	return false;
}
function sliders_deleteslider(arg){
var $ = jQuery.noConflict();
	//console.log(arg, sliderIndex);
	$('.main_sliders').children('tbody').children().eq(arg).remove();
	$('.slider-con').eq(arg).remove();
	if(arg<sliderIndex-1){
		for(i=arg;i<sliderIndex-1;i++){
			$cache = $('.slider-con').eq(i);
			for(j=0; j<$cache.find('.textinput').length;j++){
				var $c2 = $cache.find('.textinput').eq(j);
				sliders_rename($c2, i, 'same')
			}
		}
	}
	
	sliderIndex--;
	if(arg==currSlider_nr){
	currSlider_nr=-1;
	sliders_showslider(arg);
	}
}
function sliders_addlisteners(){
var $ = jQuery.noConflict();
	$('.add-item').unbind();
	$('.add-item').bind('click', click_additem);
	$('.items-con').sortable({
		placeholder: "ui-state-highlight",
		update: item_onsorted
	});
}
function sliders_addslider(){
var $ = jQuery.noConflict();
	$('.main_sliders').children('tbody').append('<tr class="slider-in-table"><td>default</td><td class="button_view"><strong><a href="#" class="slider-action slider-edit">Edit</a></strong></td><td class="button_view"><strong><a href="#" class="slider-action slider-duplicate">Duplicate</a></strong></td><td class="button_view"><strong><a href="#" class="slider-action slider-delete">Delete</a></strong></td></tr>')
	$('.master-settings').append(sliderstructure);
	for(i=0; i<$('.slider-con').eq(sliderIndex).find('.textinput').length;i++){
		var $cache = $('.slider-con').eq(sliderIndex).find('.textinput').eq(i);
		sliders_rename($cache, sliderIndex, 'settings')
	}
	sliders_addlisteners();
	itemIndex[sliderIndex] = 0;
	++sliderIndex;
	sliders_reinit();
	return false;
}
function sliders_additem(arg1, arg2){
var $ = jQuery.noConflict();
	var $cache = $('.items-con').eq(arg1);
	$cache.append(itemstructure);
	for(i=0;i<$cache.children().last().find('.textinput').length;i++){
		sliders_rename($cache.children().last().find('.textinput').eq(i), arg1, itemIndex[arg1]);
	}
	if(arg2!=undefined){
		$cache.children().last().find('.textinput').eq(0).val(arg2)
		$cache.children().last().find('.textinput').eq(0).trigger('change');
	}
	setTimeout(reskin_select, 10)
		itemIndex[arg1]++;
		
	return false;
}
function sliders_showslider(arg1){
var $ = jQuery.noConflict();
	if(arg1==currSlider_nr)
	return;
	$('.slider-con').eq(currSlider_nr).fadeOut('fast');
	$('.slider-con').eq(arg1).fadeIn('fast');
	currSlider_nr = arg1;
	currSlider = $('.slider-con').eq(currSlider_nr);
}
function click_additem(){
var $ = jQuery.noConflict();
	sliders_additem(currSlider_nr)
	sliders_addlisteners();
	
	return false;
}
function sliders_change_mainid(){
var $ = jQuery.noConflict();
	var $t=jQuery(this);
	var index=jQuery('.main-id').index($t)
	jQuery('.main_sliders tbody').children().eq(index).children().eq(0).text($t.val());
}
function sliders_change_mainthumb(){
var $ = jQuery.noConflict();
	var $t=jQuery(this);
	$t.parent().parent().parent().find('.item-preview').css('background-image', "url(" + $t.val() + ")");
}
function sliders_change(arg1,arg2,arg3,arg4){
var $ = jQuery.noConflict();
	var $cache = $('.slider-con').eq(arg1);
	if(arg2=="settings"){
		for(i=0;i<$cache.find('.settings-con').find('.textinput').length;i++){
			
			var $c2 = $cache.find('.settings-con').find('.textinput').eq(i);
			var aux = arg1 + "-" + arg2 + "-" + arg3;
			if($c2.attr('name') == aux){
			$c2.val(arg4);
			if($c2[0].nodeName=='SELECT'){
				for(j=0;j<$c2.children().length;j++){
					if($c2.children().eq(j).text() == arg4)
					$c2.children().eq(j).attr('selected', 'selected');
				}
			}
			if($c2[0].nodeName=='INPUT' && $c2.attr('type')=='checkbox'){
				if(arg4=='on'){
					$c2.attr('checked', 'checked');
				}
			}
				$c2.change();
			}
		}
	}else{
		var $c2 = $cache.find('.item-con').eq(arg2);
		for(i=0;i<$c2.find('.textinput').length;i++){
			var $c3 = $c2.find('.textinput').eq(i);
			var aux = arg1 + "-" + arg2 + "-" + arg3;
			if($c3.attr('name') == aux){
			$c3.val(arg4);
			if($c3[0].nodeName=='SELECT'){
				for(j=0;j<$c3.children().length;j++){
					if($c3.children().eq(j).text() == arg4)
					$c3.children().eq(j).attr('selected', 'selected');
				}
			}
				$c3.change();
			
			}
		}
		
	}
}
function sliders_rename(arg1, arg2, arg3, arg4){
var $ = jQuery.noConflict();
		var name = arg1.attr('name');
		var aname = name.split('-');
		
		if(arg2!='same'){
		if(arg2==undefined){
		aname[0] = currSlider_nr;
		}else{
		aname[0]= arg2;
		}
		}
		if(arg3!='same'){
		if(arg3==undefined){
		aname[1] = itemIndex[currSlider_nr];
		}else{
		aname[1]= arg3;
		}
		}
		var str = aname[0] + '-' + aname[1] + '-' + aname[2];
		arg1.attr('name', str);
	
}
function item_onsorted(){
var $ = jQuery.noConflict();
	//console.log(currSlider.find('.item-con'))
	for(i=0;i<currSlider.find('.item-con').length;i++){
		var $cache = currSlider.find('.item-con').eq(i);
		for(j=0;j<$cache.find('.textinput').length;j++){
			var $cache2 = $cache.find('.textinput').eq(j);
			sliders_rename($cache2, undefined, i);
		}
	}
}
function item_open(){
var $ = jQuery.noConflict();
	var $t = jQuery(this);
	if($t.parent().children('.item-settings-con').css('display')=='none'){
		$t.parent().children('.item-settings-con').fadeIn('fast')
	}else{
		$t.parent().children('.item-settings-con').fadeOut('fast')
	}
}
function sliders_saveall(){
var $ = jQuery.noConflict();
	jQuery('#save-ajax-loading').css('visibility', 'visible');
	var mainarray = jQuery('.master-settings').serialize();
	var data = {
		action: 'zsvg_ajax',
		postdata: mainarray
	};
	jQuery.post(ajaxurl, data, function(response) {
		console.log('Got this from the server: ' + response);
		jQuery('#save-ajax-loading').css('visibility', 'hidden');
	});
        
		jQuery('.saveconfirmer').html('Options saved.');
		jQuery('.saveconfirmer').fadeIn('fast').delay(2000).fadeOut('fast');
	return false;
}
function global_dzsmultiupload(arg){
	//console.log(arg);
	sliders_additem(currSlider_nr, window.dzs_upload_path + arg);
}
function sliders_resize(){
	jQuery('.master-settings').height(currSlider.height() + 250)
}


function reskin_select(){
var $ = jQuery.noConflict();
	for(i=0;i<jQuery('select').length;i++){
		var $cache = jQuery('select').eq(i);
		//console.log($cache.parent().attr('class'));
		
		if($cache.hasClass('styleme')==false || $cache.parent().hasClass('select_wrapper') || $cache.parent().hasClass('select-wrapper')){
		continue;
		}
		var sel = ($cache.find(':selected'));
		$cache.wrap('<div class="select-wrapper"></div>')
		$cache.parent().prepend('<span>' + sel.text() + '</span>')
	}
	jQuery('.select-wrapper select').unbind();
	jQuery('.select-wrapper select').live('change',change_select);	
}

function change_select(){
var $ = jQuery.noConflict();
	var selval = (jQuery(this).find(':selected').text());
	jQuery(this).parent().children('span').text(selval);
}

