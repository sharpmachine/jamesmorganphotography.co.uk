var ytplayer;
var $ = jQuery.noConflict();
(function($) {
	$.fn.vPlayer = function(o) {

		var defaults = {
			type : 'normal',
			autoplay : "off",
			videoWidth : 0,
			videoHeight : 0,
			constrols_out_opacity : 0,
			constrols_normal_opacity : 0.9,
			design_scrubbarWidth : -201,
			insideGallery : false,
			design_skin : 'skin_default',
			design_background_offsetw : 0
		}

		o = $.extend(defaults, o);

		this.each( function() {

			var cthis;
			var thisId;
			var controlsDiv;
			var videoWidth;
			var videoHeight;
			var totalWidth;
			var totalHeight;
			var video;
			var aux=0;
			var aux2=0;
			var full=0;
			var inter;
			var lastVolume;
			var defaultVolume;
			var infoPosX;
			var infoPosY;
			var wasPlaying=false;
			var autoplay="off";
			var volumecontrols;
			var fScreenControls;
			var playcontrols;
			var scubbar;
			var info;
			var infotext;
			var volumecontrols;
			var paused = false;
			var ie8paused = true;
			var totalDuration = 0;
			var currTime = 0;
			var dataType='';
			var dataFlash='';
			var dataSrc='';
			var dataVideoDesc = '';
                        var original_body_overflow = 'auto;'

			cthis=jQuery(this);
			thisId=$(this)[0].getAttribute('id');
                        original_body_overflow = $('body').css('overflow');
                        
			
			autoplay=o.autoplay;
			videoWidth=o.videoWidth;
			videoHeight=o.videoHeight;
			
			if(cthis.hasClass('vplayer-tobe')){
				
						//alert('ceva');
					var $c = cthis;
					$c.removeClass('vplayer-tobe');
					$c.addClass('vplayer');
					$c.addClass(o.design_skin);
					if($c.find('.videoDescription').length>0){
						dataVideoDesc = $c.find('.videoDescription').html();
						$c.find('.videoDescription').remove();
					}
					
					
					dataType = $c.attr('data-type');
					dataSrc = $c.attr('data-src');
					dataFlash = $c.attr('data-sourceflash');
					if($c.attr('data-sourceflash')==undefined){
						dataFlash=$c.attr('data-sourcemp4');
					}
					if(is_ie8()){
						$c.addClass('vplayer-ie8');
						//$c.html('<div class="vplayer"></div>')
						if(dataType!='youtube'){
		              			$c.append('<div><object type="application/x-shockwave-flash" data="preview.swf" width="'+videoWidth+'" height="'+videoHeight+'" id="flashcontent" style="visibility: visible;"><param name="movie" value="preview.swf"><param name="menu" value="false"><param name="allowScriptAccess" value="always"><param name="scale" value="noscale"><param name="allowFullScreen" value="true"><param name="wmode" value="opaque"><param name="flashvars" value="video='+dataFlash+'"></object></div>');
							
						}else{
							o.type='youtube';
							$c.children().remove();
							var aux = 'ytplayer' + dataSrc;
							$c.append('<iframe width="'+videoWidth+'" height="'+videoHeight+'" src="http://www.youtube.com/embed/'+$c.attr('data-src')+'" frameborder="0" allowfullscreen></iframe>');
							$c.attr('data-ytid', aux);
							
						}
					return;
					}
					
					if(is_ios()){
					$c.append('<video controls preload></video>');
						$c.children().eq(0).attr('width', videoWidth);
						$c.children().eq(0).attr('height', videoHeight);
						
						if($c.attr('data-type')!='youtube'){
							o.type=='ie8/flash';
							if($c.attr('data-sourcemp4')!=undefined){
		              			$c.children().eq(0).append('<source src="'+$c.attr('data-sourcemp4')+'" type="video/mp4"/>');
							}
						}else{
							o.type='youtube';
							$c.children().remove();
							var aux = 'ytplayer' + $c.attr('data-src');
							$c.append('<iframe width="'+videoWidth+'" height="'+videoHeight+'" src="http://www.youtube.com/embed/'+$c.attr('data-src')+'" frameborder="0" allowfullscreen></iframe>');
							//$c.attr('data-ytid', aux);
						}
						return;//our job on the iphone / ipad has been done, we exit the function.
					}
					if(!is_ie8() && !is_ios()){
					$c.append('<video controls preload></video>');
						if($c.attr('data-type')!='youtube'){
							if($c.attr('data-sourcemp4')!=undefined){
							//console.log($c.attr('data-sourcemp4'));
		              			$c.children().eq(0).append('<source src="'+$c.attr('data-sourcemp4')+'" type="video/mp4"/>');
		              			if(is_ie9()){
		              				$c.html('<video controls preload><source src="'+$c.attr('data-sourcemp4')+'" type="video/mp4"/></video>');
		              				//$c.children().eq(0).attr('src', $c.attr('data-sourcemp4'));
		              				//$c.children().eq(0).append('<source src="'+$c.attr('data-sourcemp4')+'"/>');
		              			}
							}
							if($c.attr('data-sourceogg')!=undefined){
	              			$c.children().eq(0).append('<source src="'+$c.attr('data-sourceogg')+'" type="video/ogg"/>');
							}
							if($c.attr('data-sourcewebm')!=undefined){
		              			$c.children().eq(0).append('<source src="'+$c.attr('data-sourcewebm')+'" type="video/webm"/>');
							}
							if($c.attr('data-sourceflash')!=undefined && !($.browser.msie && $.browser.version>8)){
		              			$c.children().eq(0).append('<object type="application/x-shockwave-flash" data="preview.swf" width="'+videoWidth+'" height="'+videoHeight+'" id="flashcontent" style="visibility: visible;"><param name="movie" value="preview.swf"><param name="menu" value="false"><param name="allowScriptAccess" value="always"><param name="scale" value="noscale"><param name="allowFullScreen" value="true"><param name="wmode" value="opaque"><param name="flashvars" value="video='+dataFlash+'"></object>');
							}
						}else{
							o.type='youtube';
							$c.children().remove();
							var aux = 'ytplayer' + $c.attr('data-src');
							$c.append('<object type="application/x-shockwave-flash" data="http://www.youtube.com/apiplayer?enablejsapi=1&version=3&playerapiid='+aux+'" width="'+videoWidth+'" height="'+videoHeight+'" id="'+aux+'" style="visibility: visible;"><param name="movie" value="http://www.youtube.com/apiplayer?enablejsapi=1&version=3"><param name="menu" value="false"><param name="allowScriptAccess" value="always"><param name="scale" value="noscale"><param name="allowFullScreen" value="true"><param name="wmode" value="opaque"><param name="flashvars" value=""></object>');
							$c.attr('data-ytid', aux);
							
							//ytplayer= document.getElementById("flashcontent");
							//ytplayer.loadVideoById('L7ANahx7aF0') 	
					
						}
						
					}
			}
			if(cthis.css('opacity') == 0){
				cthis.animate({'opacity' : 1}, 1000);
			}
			if(o.type=='normal'){
				video=cthis.children().eq(0)[0];
				video.controls=false;
			}else{
				video = cthis.children().eq(0)[0];
			}

			if(autoplay=='on'){
				wasPlaying=true;
			}
			inter = setInterval(check,50);

			function playMovie() {
				cthis.find('.preview').hide();
				playcontrols.children().eq(0).css('visibility','hidden');
				playcontrols.children().eq(1).css('visibility','hidden');
				playcontrols.children().eq(2).css('visibility','visible');
				playcontrols.children().eq(3).css('visibility','visible');
				
				if(o.type=='normal')
				video.play();
				if(o.type=='youtube')
				video.playVideo();
				
				cthis.children('.video-description').animate({'opacity': 0}, 500);
				
				wasPlaying=true;
			}

			function pauseMovie() {
				playcontrols.children().eq(0).css('visibility','visible');
				playcontrols.children().eq(1).css('visibility','visible');
				playcontrols.children().eq(2).css('visibility','hidden');
				playcontrols.children().eq(3).css('visibility','hidden');
				if(o.type=='normal')
				video.pause();
				if(o.type=='youtube'){
                                    if(video.pauseVideo)
                                    video.pauseVideo();
                                }
				
				
				cthis.children('.video-description').animate({'opacity': 1}, 500);
				
				wasPlaying=false;
			}

			function check() {
				//console.log('chec');
				if(o.type=='youtube' && video.getPlayerState){
					if(is_ie8()){
						clearInterval(inter);
						setTimeout(handleReady, 1000);
						return;
					}
					if(video.getPlayerState()>-1){
						clearInterval(inter);
						handleReady();
					}
				}
				
				if(o.type=='normal' && Number(video.readyState)>=3) {
					clearInterval(inter)
					handleReady();
				}
			}
			

			function handleReady() {
				if(localStorage!=null) {
					if(localStorage.getItem('volumeIndex')===null)
						defaultVolume=1;
					else
						defaultVolume=localStorage.getItem('volumeIndex');
				}
				cthis.append('<div class="controls"></div>')
				controlsDiv=cthis.find('.controls');
				
				
				
				controlsDiv.css('opacity', o.constrols_normal_opacity);

				if(videoWidth==0) {
					videoWidth= $(video).width();
					videoHeight= $(video).height();
				}

				totalWidth=videoWidth;
				totalHeight=videoHeight;

				cthis.css({
					'width' : videoWidth,
					'height' : videoHeight
				})
				
				if(cthis.attr('data-videoTitle')!=undefined){
					cthis.append('<div class="video-description"></div>')
					cthis.children('.video-description').append('<div class="video-title">'+cthis.attr('data-videoTitle')+'</div>');
					if(dataVideoDesc!=''){
						cthis.children('.video-description').append('<div class="video-subdescription">'+dataVideoDesc+'</div>');
					}
					cthis.find('.video-subdescription').css('width', (0.7 * videoWidth));
				}

				if(cthis.css('position')!='absolute')
					cthis.css('position', 'relative')
				
				if(o.type=='normal'){
					$(video).css({
						'position' : 'absolute',
						'background-color' : '#000000'
					})
				}
				

				controlsDiv.append('<div class="background"></div>')
				controlsDiv.append('<div class="playcontrols"></div>')
				controlsDiv.append('<div class="scrubbar"></div>')
				controlsDiv.append('<div class="timetext"></div>')
				controlsDiv.append('<div class="volumecontrols"></div>')
				controlsDiv.append('<div class="fscreencontrols"></div>')
				

				if(cthis.attr('data-img')!=undefined) {
					cthis.append('<div class="preview"><img src="'+ cthis.attr('data-img') +'"/></div>');
				}
				info=cthis.find('.info');
				infotext=cthis.find('.infoText');

				////info

				cthis.find('.info').click(handleInfo)
	

				playcontrols=cthis.find('.playcontrols');
				playcontrols.append('<div class="playSimple"></div>');
				playcontrols.append('<div class="playHover"></div>');
				playcontrols.append('<div class="stopSimple"></div>');
				playcontrols.append('<div class="stopHover"></div>');
				playcontrols.click(onPlayPause)
				playcontrols.hover( function () {
					//
					playcontrols.children().eq(1).animate({
						opacity:1
					}, {
						queue: false,
						duration: 300
					})
					playcontrols.children().eq(3).animate({
						opacity:1
					}, {
						queue: false,
						duration: 300
					})

				}, function () {

					playcontrols.children().eq(1).animate({
						opacity:0
					}, {
						queue: false,
						duration: 300
					})
					//console.log(playcontrols.children());
					playcontrols.children().eq(3).animate({
						opacity:0
					}, {
						queue: false,
						duration: 300
					})
				})

				scrubbar=cthis.find('.scrubbar');
				scrubbar.append('<div class="scrub-bg"></div>');
				scrubbar.append('<div class="scrub"></div>');
				scrubbar.click(handleScrub);


				var checkInter = setInterval(checkTime,100)



				volumecontrols=cthis.find('.volumecontrols');
				volumecontrols.append('<div class="volumeicon"></div>');
				volumecontrols.append('<div class="volume_static"></div>');
				volumecontrols.append('<div class="volume_active"></div>');
				volumecontrols.append('<div class="volume_cut"></div>');
				cthis.find('.volumecontrols').click(handleVolume)




				fScreenControls=cthis.find('.fscreencontrols');
				fScreenControls.append('<div class="full"></div>');
				fScreenControls.append('<div class="fullHover"></div>');
				fScreenControls.click(onFullScreen)
				fScreenControls.hover( function () {
					fScreenControls.children().eq(1).animate({
						opacity:1
					}, {
						queue: false,
						duration: 300
					})
				}, function () {
					fScreenControls.children().eq(1).animate({
						opacity:0
					}, {
						queue: false,
						duration: 300
					})
				})
				resizePlayer(videoWidth,videoHeight)
				setupVolume(defaultVolume)


				if(autoplay=='on'){
					playMovie();
				}
					
					
					
				cthis.mouseout( function() {

					controlsDiv.animate({
						opacity : o.constrols_out_opacity
					}, {
						queue:false,
						duration:200
					})
				})
				cthis.mouseover( function() {

					controlsDiv.animate({
						opacity : o.constrols_normal_opacity
					}, {
						queue:false,
						duration:200
					})
				})
				$(window).resize( function () {
					if(full===1) {
						totalWidth=$(window).width();
						totalHeight= $(window).height();
						resizePlayer(totalWidth,totalHeight)
					}
				})
				
				
				

				function onPlayPause() {
					paused=false;
					if(o.type=='normal' && video.paused){
						paused=true;
					}
					if(o.type=='youtube' && video.getPlayerState && video.getPlayerState()==2){
						paused=true;
					}
					if(is_ie8()){
						if (ie8paused) {
							playMovie();
							ie8paused=false;
						} else {
							pauseMovie();
							ie8paused=true;
						}
					}else{
						if (paused) {
							playMovie();
						} else {
							pauseMovie();
						}
					}
					
				}

				function resizePlayer(warg, harg) {
					cthis.css({
						'width' : warg,
						'height' : harg
					})

					$(video).css({
						width:warg,
						height:harg
					})

					cthis.find('.background').css({
						'width' : warg + parseInt(o.design_background_offsetw)
					})

					cthis.find('.preview').children().eq(0).css({
						'width' : warg,
						'height' :harg
					})

					controlsDiv.css({
						'width': warg
					})
					if(is_ie8()){
						controlsDiv.css({
							'position' : 'absolute',
							'top' : 0,
							'left' : 0
						})
					}
					scrubbar=cthis.find('.scrubbar').children();
					scrubbar.eq(0).width(warg+o.design_scrubbarWidth);
					//scrubbar.eq(0).height(12);
					//scrubbar.eq(1).height(12);

					infoPosX=parseInt(controlsDiv.find('.infoText').css('left'));
					infoPosY=parseInt(controlsDiv.find('.infoText').css('top'));
				}
				function handleInfo() {
					infotext=cthis.find('.infoText');

					if (infotext.css('opacity') == 0) {
						infotext.animate({
							'left': '0',
							'opacity': '0'
						}, {
							queue: false,
							duration: 0
						})

						infotext.animate({
							'left': infoPosX,
							'opacity': '1'
						}, {
							queue: false,
							duration: 700
						})
					} else {
						infotext.animate({
							'left': totalWidth,
							'opacity': '0'
						}, {
							queue: false,
							duration: 700
						})
					}

				}

				function handleScrub(e) {
					scrubbar=cthis.find('.scrubbar');
					if(wasPlaying==false)
						pauseMovie();
					else
						playMovie();
						
					if(o.type=='normal'){
						totalDuration = video.duration;
						video.currentTime = (e.pageX-(scrubbar.offset().left))/(scrubbar.children().eq(0).width()) * totalDuration;
					}
					if(o.type=='youtube'){
						//console.log(video.getDuration())
						totalDuration = video.getDuration();
						video.seekTo((e.pageX-(scrubbar.offset().left))/(scrubbar.children().eq(0).width()) * totalDuration);
					}
					
				}

				function checkTime() {
					scrubbar=cthis.find('.scrubbar');
					
					
					if(o.type=='normal'){
						totalDuration = video.duration;
						currTime = video.currentTime;
					}
					if(o.type=='youtube'){
						//console.log(video.getDuration())
                                                if(video.getDuration){
                                                    totalDuration = video.getDuration();
                                                    currTime = video.getCurrentTime();
                                                }
						
					}
					aux=((currTime/totalDuration)*(scrubbar.children().eq(0).width()))
					scrubbar.children().eq(1).width(aux)
					cthis.find('.timetext').html('<font color="#FFFFFF" size="1px">' + formatTime(currTime) +  '</font><font color="gray" size="1px">/' + formatTime(totalDuration) + '</font>')
				}



				function handleVolume(e) {
					volumecontrols=cthis.find('.volumecontrols').children();
					if((e.pageX-(volumecontrols.eq(1).offset().left))>=0) {
						aux = (e.pageX-(volumecontrols.eq(1).offset().left));

						//volumecontrols.eq(2).height(24)
						volumecontrols.eq(2).css('visibility','visible')
						volumecontrols.eq(3).css('visibility','hidden')

						setupVolume(aux/volumecontrols.eq(1).width())
					} else {
						if(volumecontrols.eq(3).css('visibility')=='hidden') {
							lastVolume=video.volume;
							if(o.type=='normal'){
								video.volume=0;
							}
							if(o.type=='youtube'){
								video.setVolume(0);
							}
							volumecontrols.eq(3).css('visibility','visible')
							volumecontrols.eq(2).css('visibility','hidden')
						} else {
							console.log(lastVolume);
							if(o.type=='normal'){
								video.volume=lastVolume;
							}
							if(o.type=='youtube'){
								video.setVolume(lastVolume);
							}
							volumecontrols.eq(3).css('visibility','hidden')
							volumecontrols.eq(2).css('visibility','visible')
						}
					}

				}

				function setupVolume(arg) {
					var volumeControl=cthis.find('.volumecontrols').children();
					if(arg>=0){
						if(o.type=='normal')
						video.volume=arg;
						if(o.type=='youtube'){
							var aux = arg*100;
							video.setVolume(aux);
							
						}
						
					}
					volumeControl.eq(2).width(arg*volumeControl.eq(1).width());
					if(localStorage!=null)
						localStorage.setItem('volumeIndex', arg);
				}


				function onFullScreen() {
					totalWidth= $(window).width()
					totalHeight= $(window).height()

					if(full==0) {
                                            full=1;

                                            jQuery('body').css('overflow', 'hidden');
                                            totalWidth= $(window).width()
                                            totalHeight= $(window).height()
                                            cthis.css({
                                                'position' : 'fixed',
                                                'z-index' : 9999,
                                                'left' : '0px',
                                                'top' : '0px',
                                                'width': totalWidth,
                                                'height': totalHeight
                                            })
                                            resizePlayer(totalWidth,totalHeight)
                                            if(o.insideGallery==true)
                                            jQuery(this).parent().parent().parent().parent().parent().turnFullscreen();
						
					} else {
                                            full=0;
                                            $('body').css('overflow', original_body_overflow);
                                            cthis.css({
                                                    'position' : 'relative',
                                                    'z-index' : 'auto',
                                                    'left' : '0px',
                                                    'top' : '0px',
                                                    'width': videoWidth,
                                                    'height': videoHeight
                                            })
                                            resizePlayer(videoWidth, videoHeight)
                                            if(o.insideGallery==true)
                                            jQuery(this).parent().parent().parent().parent().parent().turnNormalscreen();
					}
				}

				
				
				
				
				function formatTime(arg) {
					//formats the time
					var s = Math.round(arg);
					var m = 0;
					if (s > 0) {
						while (s > 59) {
							m++;
							s -= 60;
						}
						return String((m < 10 ? "0" : "") + m + ":" + (s < 10 ? "0" : "") + s);
					} else {
						return "00:00";
					}
				}
				
			}

			epauseMovie = function(arg) {
				if(is_ios()){
					return;
				}
				var findPlayControls= arg.find('.playcontrols').children();
				findPlayControls.eq(0).css('visibility','visible');
				findPlayControls.eq(1).css('visibility','visible');
				findPlayControls.eq(2).css('visibility','hidden');
				findPlayControls.eq(3).css('visibility','hidden');
			//	arg[0].pause();
			if(arg.find('video').length>0)
			arg.find('video')[0].pause();
			if(arg.attr('data-ytid')!=undefined){
  				var aux = document.getElementById(arg.attr('data-ytid'));
				aux.pauseVideo();
			}
  };   

		}); // end each
	
			}
			

})(jQuery);

			


		
function onYouTubePlayerReady(playerId) {
    //alert('ytready')
    //alert(playerId)
  ytplayer = document.getElementById(playerId);
  ytplayer.addEventListener("onStateChange", "onytplayerStateChange");
  var aux = playerId.substr(8);
  ytplayer.loadVideoById(aux);
  ytplayer.pauseVideo();
}

function onytplayerStateChange(newState) {
   //alert("Player's new state: " + newState);
}


function is_ios() {
    //return false;
    return (
    (navigator.platform.indexOf("iPhone") != -1) ||
    (navigator.platform.indexOf("iPod") != -1) ||
    (navigator.platform.indexOf("iPad") != -1)
    )
}
function is_ie9(){
    if($.browser.msie && parseInt($.browser.version)==9){
            return true;
    }
    return false;
}
function is_ie8(){
    if($.browser.msie && parseInt($.browser.version)<9){
            return true;
    }
    return false;
}