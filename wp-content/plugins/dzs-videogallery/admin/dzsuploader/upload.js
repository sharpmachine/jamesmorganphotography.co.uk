/*
 * DZS Upload
 * version: 1.0
 * author: digitalzoomstudio
 * website: http://digitalzoomstudio.net
 *
 * Dual licensed under the MIT and GPL licenses:
 *   http://www.opensource.org/licenses/mit-license.php
 *   http://www.gnu.org/licenses/gpl.html
 */
window.dzs_upload_target = "";
window.dzs_php_loc = "";
var i=0,
j=0;
var target_field;

jQuery(document).ready(function($) {
	//Firefox 4, Chrome, Safari - only select photo button
	//Opera, IE9, IE8 - only browse button
	//IE7 - browser & submit
	if(jQuery.browser.opera || jQuery.browser.msie){
		jQuery('.dzs-upload').children('.btn_upl').css('display','none');
		jQuery('.dzs-upload').children('.file_field').css('visibility','visible');
	}
	
	dzs_initUpload();
	dzs_dd_uploader();
}); 
function dzs_initUpload(){
	
            var options = {
            target: '#message', //Div tag where content info will be loaded in
            url:window.dzs_php_loc, //The php file that handles the file that is uploaded
            beforeSubmit: function() {
				//console.log('ceva');
            },
            success:  function() {
                //Here code can be included that needs to be performed if Ajax request was successful
                //alert('uploaded');
                
            }
            };
            
            jQuery('.dzs-upload').live('submit',function() {
                jQuery(this).ajaxSubmit(options);
                return false;
            });
			
            jQuery('.file_field').live('change',function() {
            	target_field = jQuery(this).parent().prev();
            	
            	var aux = jQuery(this).val();
            	if(aux.indexOf('/')>-1)
            	aux = aux.split('/');
            	else
            	aux = aux.split('\\');
            	
            	auxfinal=aux[aux.length-1];
            	//console.log(aux);
               window.dzs_upload_target= auxfinal;
               
               var aux2=window.dzs_upload_path;
               if(aux2==undefined)
               aux2='';
               
               if(target_field.attr('type')=='text')
               target_field.val(aux2 + auxfinal);
               //console.log(window.dzs_upload_target)
               jQuery(this).parent().submit();
               setTimeout(function(){
               target_field.trigger('change');
               }, 1800);
            });

            jQuery('.btn_upl').live('click',function() {
            jQuery(this).next().click();
			});
			
			
			
			
			jQuery('.dzs-multi-upload .multi-uploader').wrap('<div class="multi-uploader-wrap"></div>').css('visibility', 'hidden').parent().prepend('<input type="button" value="Upload" class="btn_upl"/>');
			
}

var $ = jQuery.noConflict();
function dzs_dd_uploader() {
    $ = jQuery.noConflict();
    var filesUpload = document.getElementById("files-upload");

            //console.log(jQuery('.droparea').eq(0))
    var droparea = jQuery('.droparea').eq(0)[0];
    var uploadlist = jQuery('.upload-list').eq(0)[0];
    var gfiles = [];

    //console.log(droparea)

    function uploadFile (file) {

            var xhr;

            // Uploading - for Firefox, Google Chrome and Safari
            xhr = new XMLHttpRequest();
            // File uploaded
            xhr.addEventListener("load", function () {
                    //console.log('ready', file)
                    for(i=0;i<$(uploadlist).children().length;i++){
                            var $cache = $(uploadlist).children().eq(i);
                            //console.log($cache.attr('rel'), file.name)
                            if($cache.attr('rel') == file.name)
                            $cache.slideUp('slow');
                    }
                    if(typeof global_dzsmultiupload == 'function') {
                            var aux = file.name;
                            aux=aux.split(' ').join('-');
                            global_dzsmultiupload(aux);
                    }

            }, false);

            xhr.open("post", window.dzs_php_loc);

            // Set appropriate headers
            xhr.setRequestHeader("Content-Type", "multipart/form-data");
            if(file.fileName==undefined){
                    xhr.setRequestHeader("X-File-Name", file.name);
            }else{
                    xhr.setRequestHeader("X-File-Name", file.fileName);
            }
            if(file.fileSize==undefined){
                    xhr.setRequestHeader("X-File-Size", file.size);
            }else{
                    xhr.setRequestHeader("X-File-Size", file.fileSize);
            }
            xhr.setRequestHeader("X-File-Type", file.type);

                    if (file.getAsBinary != undefined) {
                            xhr.sendAsBinary(file.getAsBinary(file));
                    } else {
                            xhr.send(file);
                    }
	}

	function parseFiles (files) {
            //alert(files);
            $ = jQuery.noConflict();
            if (typeof files !== "undefined") {
                    $(uploadlist).find('.dummy').remove();
                    for (i=0; i<files.length; i++) {
                            //uploadFile(files[i]);
                            $(uploadlist).append('<li class="prefile" rel="' + files[i].name + '">' + files[i].name + '</li>');
                            gfiles.push(files[i])
                    }
            }
	}

	filesUpload.addEventListener("change", function () {
		parseFiles(this.files);
	}, false);

	droparea.addEventListener("dragleave", function (e) {
		if (e.target && e.target === droparea) {
			jQuery(this).removeClass('over');
		}
		e.preventDefault();
		e.stopPropagation();
	}, false);

	droparea.addEventListener("dragenter", function (e) {
		jQuery(this).addClass('over');
		e.preventDefault();
		e.stopPropagation();
	}, false);

	droparea.addEventListener("dragover", function (e) {
		e.preventDefault();
		e.stopPropagation();
	}, false);

	droparea.addEventListener("drop", function (e) {
            jQuery(this).removeClass('over');
            //console.log(e);
            parseFiles(e.dataTransfer.files);
            e.preventDefault();
            e.stopPropagation();
	}, false);
	jQuery('.upload-button').click(function(){
		if(gfiles!==undefined){
			for (i=0; i<gfiles.length; i++) {
				uploadFile(gfiles[i]);
			}
		}
		gfiles=[];
		return false;
	})
}




