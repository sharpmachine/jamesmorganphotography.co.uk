<?php
/*
  Plugin Name: DZS Video Gallery
  Plugin URI: http://digitalzoomstudio.net/
  Description: Creates and manages cool videogallery galleries.
  Version: 4.0.4
  Author: Digital Zoom Studio
  Author URI: http://digitalzoomstudio.net/
 */





$zsvg = new DZSVideoGallery();
class DZSVideoGallery{
    public $the_path;
    public $sliders_index = 0;
    public $the_shortcode = 'videogallery';
    public $admin_capability = 'manage_options';
    public $dbitemsname = 'zsvg_items';
    public $dboptionsname = 'zsvg_options';
    public $mainitems;
    public $mainoptions;
    public $pluginmode = "plugin";
    public $alwaysembed = "on";
    function __construct(){
        if($this->pluginmode=='theme'){
            $this->the_path = THEME_URL . 'plugins/dzs-videogallery/';
        }else{
            $this->the_path = plugins_url('', __FILE__) . '/';
        }
        
        
        $this->mainitems = get_option($this->dbitemsname);
        if($this->mainitems==''){
            $this->mainitems=array();
            update_option($this->dbitemsname, $this->mainitems);
        }
        $this->mainoptions = get_option($this->dboptionsname);
        if($this->mainoptions==''){
            $this->mainoptions=array(
                'usewordpressuploader' => 'on',
                'embed_prettyphoto' => 'on',
                'embed_masonry' => 'on',
            );
            update_option($this->dboptionsname, $this->mainoptions);
        }
        
        
        
        $this->post_options();
        
        
        $uploadbtnstring='<button class="button-secondary action upload_file zs2-main-upload">Upload</button>';
    
        if($this->mainoptions['usewordpressuploader']!='on'){
            $uploadbtnstring='<form name="upload" class="dzs-upload" action="#" method="POST" enctype="multipart/form-data">
            <input type="button" value="Upload" class="btn_upl button-secondary"/>
            <input type="file" name="file_field" class="file_field"/>
            <input type="submit" class="btn_submit"/>
    </form>';
        }
        
        
        $this->sliderstructure='<div class="slider-con" style="display:none;">
        <div class="settings-con">
        <h4>General Options</h4>
        <div class="setting type_all">
            <div class="setting-label">ID</div>
            <input type="text" class="textinput main-id" name="0-settings-id" value="default"/>
        </div>
        <div class="setting type_all">
            <div class="setting-label">Width</div>
            <input type="text" class="textinput" name="0-settings-width" value="900"/>
        </div>
        <div class="setting type_all">
            <div class="setting-label">Height</div>
            <input type="text" class="textinput" name="0-settings-height" value="300"/>
        </div>
        <div class="setting type_all">
            <div class="setting-label">HTML5 Gallery Inits on
                <div class="info-con">
                <div class="info-icon"></div>
                <div class="sidenote">Select window.load if you want the slider to init when all the images are loaded, or the other when the document is ready</div>
            </div></div>
            <select class="textinput styleme" name="0-settings-jqcall">
            <option>window.load</option>
            <option>document.ready</option>
            </select>
        </div>
        <div class="setting styleme">
            <div class="setting-label">Video Gallery Skin</div>
            <select class="textinput styleme" name="0-settings-videogalleryskin">
                <option>normal</option>
                <option>light</option>
                <option>all characters</option>
                <option>custom</option>
            </select>
        </div>
        <div class="setting styleme">
            <div class="setting-label">Display Mode</div>
            <select class="textinput styleme" name="0-settings-displaymode">
                <option>normal</option>
                <option>wall</option>
                <option>alternatemenu</option>
            </select>
        </div>
        <div class="setting type_all">
            <div class="setting-label">Menu Position</div>
            <select class="textinput styleme" name="0-settings-menuposition">
                <option>right</option>
                <option>down</option>
                <option>left</option>
                <option>up</option>
                <option>none</option>
            </select>
        </div>
        <div class="setting type_all">
            <div class="setting-label">Autoplay</div>
            <select class="textinput styleme" name="0-settings-autoplay">
                <option>on</option>
                <option>off</option>
            </select>
        </div>
        <div class="setting type_all">
            <div class="setting-label">Autoplay Next</div>
            <select class="textinput styleme" name="0-settings-autoplaynext">
                <option>on</option>
                <option>off</option>
            </select>
        </div>
        <div class="setting type_all">
            <div class="setting-label">Feed From</div>
            <select class="textinput styleme" name="0-settings-feedfrom">
                <option>normal</option>
                <option>youtube user channel</option>
                <option>youtube playlist</option>
                <option>vimeo user channel</option>
            </select>
        </div>
        <div class="setting type_all">
            <div class="setting-label">Autoplay Next</div>
            <select class="textinput styleme" name="0-settings-autoplaynext">
                <option>on</option>
                <option>off</option>
            </select>
        </div>
        <div class="setting type_all">
            <div class="setting-label">Scrollbar</div>
            <div class="sidenote">Only for the flash version.</div>
            <select class="textinput styleme" name="0-settings-scrollbar">
                <option>off</option>
                <option>on</option>
            </select>
        </div>
        <div class="setting type_all">
            <div class="setting-label">Default Gallery</div>
            <select class="textinput styleme" name="0-settings-defaultvg">
                <option>flash</option>
                <option>html5</option>
            </select>
        </div>
        <div class="setting">
            <div class="setting-label">Background</div>
            <input type="text" class="textinput with_colorpicker" name="0-settings-bgcolor" value="#111111"/><div class="picker-con"><div class="the-icon"></div><div class="picker"></div></div>
        </div>
        <div class="setting type_all">
            <div class="setting-label">Enable Shadow</div>
            <select class="textinput styleme" name="0-settings-shadow">
                <option>off</option>
                <option>on</option>
            </select>
        </div>
        <div class="setting type_all">
            <div class="setting-label">Enable Switch Button</div>
            <select class="textinput styleme" name="0-settings-enableswitch">
                <option>off</option>
                <option>on</option>
            </select>
        </div>
        <div class="setting">
            <div class="setting_label">Logo</div>
            <input type="text" class="textinput" name="0-settings-logo" value=""/>'.$uploadbtnstring.'
        </div>
        <hr/>
        <h4>YouTube Options</h4>
        <div class="setting">
            <div class="setting_label">YouTube User</div>
            <input type="text" class="short textinput" name="0-settings-youtubefeed_user" value=""/>
        </div>
	<div class="setting">
            <div class="setting_label">YouTube Playlist
                <div class="info-con">
                <div class="info-icon"></div>
                <div class="sidenote">You need to set the playlist ID there not the playlist Name. For example for this playlist http:'.'/'.''.'/'.'www.youtube.com/my_playlists?p=PL08BACDB761A0C52A the id is 08BACDB761A0C52A. Remember that if you have the characters PL at the beggining of the ID they should not be included here.</div>
        </div>
        </div>
            <input type="text" class="short textinput" name="0-settings-youtubefeed_playlist" value=""/>
            </div>
        <div class="setting type_all">
            <div class="setting-label">YouTube Max Videos</div>
            <input type="text" class="textinput" name="0-settings-youtubefeed_maxvideos" value="50"/>
        </div>
        <div class="setting type_all">
            <div class="setting-label">SD Quality</div>
            <input type="text" class="textinput" name="0-settings-sdquality" value="small"/>
        </div>
        <div class="setting type_all">
            <div class="setting-label">HD Quality</div>
            <input type="text" class="textinput" name="0-settings-hdquality" value="hd720"/>
        </div>
        <div class="setting type_all">
            <div class="setting-label">Default Quality</div>
            <select class="textinput styleme" name="0-settings-defaultquality">
                <option>HD</option>
                <option>SD</option>
            </select>
        </div>
        <hr/>
        <h4>Vimeo Options</h4>
        <div class="setting type_all">
            <div class="setting_label">Vimeo User ID</div>
            <input type="text" class="textinput" name="0-settings-vimeofeed_user" value=""/>
        </div>
        <hr/>
        <h4>HTML5 Gallery Options</h4>
        <div class="setting type_all">
            <div class="setting-label">Transition</div>
            <select class="textinput styleme" name="0-settings-html5transition">
                <option>slideup</option>
                <option>fade</option>
            </select>
        </div>
        <div class="setting type_all">
            <div class="setting-label">Design Menu Item Width</div>
            <input type="text" class="textinput" name="0-settings-html5designmiw" value="275"/>
        </div>
        <div class="setting type_all">
            <div class="setting-label">Design Menu Item Height</div>
            <input type="text" class="textinput" name="0-settings-html5designmih" value="76"/>
        </div>
        <hr/>
        <h4>Flash Player Options</h4>
        <div class="setting type_all">
            <div class="setting-label">Default Volume</div>
            <input type="text" class="textinput" name="0-settings-defaultvolume" value=""/>
        </div>
        <div class="setting">
            <div class="setting_label">Thumbnail</div>
            <input type="text" class="textinput" name="0-settings-thumbnail" value=""/>'.$uploadbtnstring.'
        </div>
        <div class="setting type_all">
            <div class="setting-label">Window Mode</div>
            <div class="sidenote">Only for the flash version.</div>
            <select class="textinput styleme" name="0-settings-windowmode">
                <option>opaque</option>
                <option>transparent</option>
            </select>
        </div>
        <div class="setting type_all">
            <div class="setting-label">Disable Description</div>
            <div class="sidenote">Only for the flash version.</div>
            <select class="textinput styleme" name="0-settings-disabledescription">
                <option>off</option>
                <option>on</option>
            </select>
        </div>
        <div class="setting type_all">
            <div class="setting-label">Enable Deeplinking</div>
            <div class="sidenote">Only for the flash version.</div>
            <select class="textinput styleme" name="0-settings-enabledeeplinking">
                <option>off</option>
                <option>on</option>
            </select>
        </div>
        <div class="setting type_all">
            <div class="setting-label">Share Button</div>
            <div class="sidenote">Only for the flash version.</div>
            <select class="textinput styleme" name="0-settings-sharebutton">
                <option>off</option>
                <option>on</option>
            </select>
        </div>
        <div class="setting type_all">
            <div class="setting_label">Facebook Link</div>
            <input type="text" class="textinput" name="0-settings-facebooklink" value=""/>
        </div>
        <div class="setting type_all">
            <div class="setting_label">Twitter Link</div>
            <input type="text" class="textinput" name="0-settings-twitterlink" value=""/>
        </div>
        <div class="setting type_all">
            <div class="setting_label">Google Plus Link</div>
            <input type="text" class="textinput" name="0-settings-googlepluslink" value=""/>
        </div>
        <div class="setting type_all">
            <div class="setting-label">Embed Button</div>
            <div class="sidenote">Only for the flash version.</div>
            <select class="textinput styleme" name="0-settings-embedbutton">
                <option>off</option>
                <option>on</option>
            </select>
        </div>
        <div class="setting type_all">
            <div class="setting-label">HD Button</div>
            <div class="sidenote">Only for the flash version.</div>
            <select class="textinput styleme" name="0-settings-hdButton">
                <option>off</option>
                <option>on</option>
            </select>
        </div>
        <div class="setting type_all">
            <div class="setting-label">Disable Big Play Button</div>
            <div class="sidenote">Only for the flash version.</div>
            <select class="textinput styleme" name="0-settings-disablebigplaybutton">
                <option>off</option>
                <option>on</option>
            </select>
        </div>
        <div class="setting type_all">
            <div class="setting-label">Leave Only Big Play Button</div>
            <div class="sidenote">Only for the flash version.</div>
            <select class="textinput styleme" name="0-settings-playerdesignonlybigplay">
                <option>off</option>
                <option>on</option>
            </select>
        </div>
        <div class="setting type_all">
            <div class="setting-label">Let Flash handle feeds</div>
            <div class="sidenote">Deprecated. Only for the flash version.</div>
            <select class="textinput styleme" name="0-settings-directurlaccess">
                <option>off</option>
                <option>on</option>
            </select>
        </div>
        </div><!--end settings con-->
        <div class="master-items-con">
        <div class="items-con"></div>
        <a href="#" class="add-item"></a>
        </div><!--end master-items-con-->
        </div>';
        $this->itemstructure='<div class="item-con">
            <div class="item-delete">x</div>
            <div class="item-duplicate"></div>
        <div class="item-preview" style="">
        </div>
        <div class="item-settings-con">
        <div class="setting">
            <div class="setting-label">Source
                <div class="info-con">
                <div class="info-icon"></div>
                <div class="sidenote">Below you will enter your video address. If it is a video from YouTube or Vimeo you just need to enter the id of the video in the "Video:" field. The ID is the bolded part http://www.youtube.com/watch?v=<strong>j_w4Bi0sq_w</strong>. If it is a local video you just need to write its location there or upload it through the Upload button ( .mp4 / .flv format ).</div>
                </div>
            </div>
<textarea class="textinput main-source  type_all" name="0-0-source" style="width:160px; height:23px;">Hv7Jxi_wMq4</textarea>'.$uploadbtnstring.'
        </div>
        <div class="setting">
            <div class="setting-label">Thumbnail</div>
            <input class="textinput upload-prev main-thumb" name="0-0-thethumb" style="width:160px; height:23px;" value="'.$this->the_path.'admin/img/defaultthumb.png"/>'.$uploadbtnstring.'
        </div>
        <div class="setting">
            <div class="setting-label">Type:</div>
            <select class="textinput item-type styleme type_all" name="0-0-type">
            <option>youtube</option>
            <option>video</option>
            <option>vimeo</option>
            <option>audio</option>
            <option>image</option>
            <option>link</option>
            </select>
        </div>
        <div class="setting">
            <div class="setting-label">Title</div>
            <input type="text" class="textinput" name="0-0-title"/>
        </div>
        <div class="setting">
            <div class="setting-label">Description:</div>
            <textarea class="textinput" name="0-0-description"></textarea>
        </div>
        <div class="setting">
            <div class="setting-label">Menu Description</div>
            <textarea class="textinput" name="0-0-menuDescription"></textarea>
        </div>
        <div class="setting">
            <div class="setting-label">HTML5 OGG Format</div>
            <div class="sidenote">Optional ogg / ogv file </div>
            <input class="textinput upload-prev" name="0-0-html5sourceogg" value=""/>'.$uploadbtnstring.'
        </div>
        </div><!--end item-settings-con-->
        </div>';
        
        
        
        add_shortcode($this->the_shortcode, array($this, 'show_shortcode'));
        add_shortcode('dzs_' . $this->the_shortcode, array($this, 'show_shortcode'));
        
        
        add_shortcode('vimeo', array($this, 'vimeo_func'));
        add_shortcode('youtube', array($this, 'youtube_func'));
        add_shortcode('video', array($this, 'video_func'));
        
        add_action('init', array($this, 'handle_init'));
        add_action('wp_ajax_zsvg_ajax', array($this, 'post_save'));
        
        add_action('admin_menu', array($this, 'handle_admin_menu'));
        
        if($this->pluginmode=='theme'){
            $this->mainoptions['embed_prettyphoto'] = 'off';
        }
        if($this->pluginmode!='theme'){
            add_action('admin_init', array($this, 'admin_init'));
            //add_action('save_post', array($this, 'admin_meta_save'));
        }
        
    }
    function vimeo_func($atts) {
        $func_output='';
        $w=400;
        if(isset($atts['width'])) $w=$atts['width'];
        $h=300;
        if(isset($atts['height'])) $h=$atts['height'];
        $func_output.='<iframe src="http://player.vimeo.com/video/'.$atts['id'].'?title=0&amp;byline=0&amp;portrait=0" width="'.$w.'" height="'.$h.'" frameborder="0"></iframe>';
        return $func_output;
    }
    
    function youtube_func($atts) {
        $func_output='';
        $w=400;
        if(isset($atts['width'])) $w=$atts['width'];
        $h=300;
        if(isset($atts['height'])) $h=$atts['height'];
        $func_output.='<object width="'.$w.'" height="'.$h.'"><param name="movie" value="http://www.youtube.com/v/'.$atts['id'].'?version=3&amp;hl=en_US"></param><param name="wmode" value="transparent"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/'.$atts['id'].'?version=3&amp;hl=en_US" type="application/x-shockwave-flash" width="'.$w.'" height="'.$h.'" allowscriptaccess="always" wmode="transparent" allowfullscreen="true"></embed></object>';
        return $func_output;
    }
    function video_func($atts) {
        global $zs2_path;
        $func_output='';
        $w=400;
        if(isset($atts['width'])) $w=$atts['width'];
        $h=300;
        if(isset($atts['height'])) $h=$atts['height'];
        $source=$zs2_path.'deploy/preview.swf?video='.$atts['source'];
        if(isset($atts['type'])) $source.='&types='.$atts['type'];
        if(isset($atts['audioimage'])) $source.='&audioImages='.$atts['audioimage'];
        $func_output.='<object width="'.$w.'" height="'.$h.'">
            <param name="movie" value="'.$source.'"></param>
            <param name="allowFullScreen" value="true"></param>
            <param name="allowscriptaccess" value="always"></param>
            <param name="wmode" value="opaque"></param>
            <embed src="'.$source.'" type="application/x-shockwave-flash" width="'.$w.'" height="'.$h.'" allowscriptaccess="always" allowfullscreen="true" wmode="opaque">
            </embed></object>';

        return $func_output;
    }
    function show_shortcode($atts){
        $fout='';
        

    if ($this->mainitems == '')
        return;
    
    $this->sliders_index++;

    
    $i = 0;
    $k = 0;
    $id = 'default';
    if (isset($atts['id'])){
        $id = $atts['id'];
    }

    //echo 'ceva' . $id;
    for ($i = 0; $i < count($this->mainitems); $i++) {
        if ((isset($id)) && ($id == $this->mainitems[$i]['settings']['id']))
            $k = $i;
    }
    
        //print_r($this->mainitems);
    $w = $this->mainitems[$k]['settings']['width'] . 'px';
    $h = $this->mainitems[$k]['settings']['height'] . 'px';
    $fullscreenclass = '';
    $theclass = 'videogallery';

    //echo $id;
    $its = $this->mainitems[$k];
        
    //$fout.='<div class="videogallery-con" style="width:'.$w.'; height:'.$h.'; opacity:0;">';
        

    $user_feed = '';
    $yt_playlist_feed = '';
    
    
    
    //print_r($its);
    $html5vgskin='skin_default';
    $skin = 'deploy/preview.swf';
    if ($its['settings']['videogalleryskin'] == 'light'){
        $skin = "deploy/preview_skin_overlay.swf";
        $html5vgskin='skin_white';
    }
    if ($its['settings']['videogalleryskin'] == 'all characters'){
        $skin = "deploy/preview_allchars.swf";
    }
    if($its['settings']['videogalleryskin']=='custom'){
        $skin = 'deploy/preview_allchars.swf';
    }
    $swfloc = $this->the_path . $skin;
    
    $wmode = 'opaque';
    $wmode = $its['settings']['windowmode'];
    
    
    if(($its['settings']['feedfrom']=='youtube user channel') && $its['settings']['youtubefeed_user']!=''){
        $user_feed = $its['settings']['youtubefeed_user'];
        if($its['settings']['youtubefeed_playlist']=='')
        $its['settings']['youtubefeed']='off';
    }
    if(($its['settings']['feedfrom']=='youtube playlist') && $its['settings']['youtubefeed_playlist']!=''){
        $yt_playlist_feed = $its['settings']['youtubefeed_playlist'];
        $its['settings']['youtubefeed']='on';
        $user_feed='';
    }
    
    //..youtube user feed..
    if($user_feed!=''){
        for($i=0;$i<count($its);$i++){
            unset($its[$i]);
        }
        $target_file ="http://gdata.youtube.com/feeds/api/users/".$user_feed."/uploads?v=2&alt=jsonc";
        //echo $target_file;
        $ida = dzs_get_contents($target_file);
        $idar = json_decode($ida);
        //print_r($idar);
        //print_r($idar);
        //print_r(count($idar->data->items));
        $i=0;
        if($its['settings']['youtubefeed_maxvideos']=='') $its['settings']['youtubefeed_maxvideos']=100;
        $yf_maxi = $its['settings']['youtubefeed_maxvideos'];
        
        foreach ($idar->data->items as $ytitem){
            //print_r($ytitem);
            $its[$i]['source'] = $ytitem->id;
            $its[$i]['thethumb'] = "";
            $its[$i]['type'] = "youtube";

            $aux = $ytitem->title;
            $lb   = array('"' ,"\r\n", "\n", "\r", "&" ,"-", "`", '�', "'", '-');
            $aux = str_replace($lb, ' ', $aux);
            $its[$i]['title'] = $aux;

            $aux = $ytitem->description;
            $lb   = array('"' ,"\r\n", "\n", "\r", "&" ,"-", "`", '�', "'", '-');
            $aux = str_replace($lb, ' ', $aux);
            $its[$i]['description'] = $aux;

            $i++;
            if($i>$yf_maxi+1)
                break;
        }
        
            $its[$i]['source'] = " ";
            $its[$i]['thethumb'] = " ";
            //$its[$i]['type'] = " ";
    }
    
    
    //http://vimeo.com/api/v2/blakewhitman/videos.json
    if(($its['settings']['feedfrom']=='vimeo user channel') && $its['settings']['vimeofeed_user']!=''){
        for($i=0;$i<count($its)-1;$i++){
            unset($its[$i]);
        }
        $target_file ="http://vimeo.com/api/v2/".$its['settings']['vimeofeed_user']."/videos.json";
        $ida = dzs_get_contents($target_file);
        $idar = json_decode($ida);
        $i=0;
        foreach ($idar as $item){
            $its[$i]['source'] = $item->id;
            $its[$i]['thethumb'] = $item->thumbnail_small;
            if($its['settings']['directurlaccess']=='on'){
                $its[$i]['thethumb'] = '';
            }
            $its[$i]['type'] = "vimeo";
            
            $aux = $item->title;
            $lb   = array('"' ,"\r\n", "\n", "\r", "&" ,"-", "`", '�', "'", '-');
            $aux = str_replace($lb, ' ', $aux);
            $its[$i]['title'] = $aux;

            $aux = $item->description;
            $lb   = array('"' ,"\r\n", "\n", "\r", "&" ,"-", "`", '�', "'", '-');
            $aux = str_replace($lb, ' ', $aux);
            $its[$i]['description'] = $aux;
            $i++;
        }
    }
    if(($its['settings']['feedfrom']=='youtube playlist') && $its['settings']['youtubefeed_playlist']!=''){
        for($i=0;$i<count($its)-1;$i++){
            unset($its[$i]);
        }
        $target_file ="http://gdata.youtube.com/feeds/api/playlists/".$yt_playlist_feed."?alt=json&start-index=1&max-results=40";
        $ida = dzs_get_contents($target_file);
        //echo 'ceva';
        $idar = json_decode($ida);
       // print_r($idar);
        //print_r(count($idar->data->items));
        $i=0;
        if($its['settings']['youtubefeed_maxvideos']=='') {
            $its['settings']['youtubefeed_maxvideos']=100;
        }
        $yf_maxi = $its['settings']['youtubefeed_maxvideos'];
        
        foreach ($idar->feed->entry as $ytitem){
            $cache = $ytitem;
            $aux = array();
            $auxtitle;
            $auxcontent;
            //print_r($cache);
            //print_r(get_object_vars($cache->title));
            foreach($cache->title as $hmm){
                $auxtitle = $hmm;
                break;
            }
            foreach($cache->content as $hmm){
                $auxcontent = $hmm;
                break;
            }
            //print_r($aux2);
            //print_r(parse_str($cache->title));
            parse_str($ytitem->link[0]->href, $aux);
            //print_r($aux['http://www_youtube_com/watch?v']);
        
            $its[$i]['source'] = $aux['http://www_youtube_com/watch?v'];
            $its[$i]['thethumb'] = "";
            $its[$i]['type'] = "youtube";
            $its[$i]['title'] = $auxtitle;
            $its[$i]['menuDescription'] = $auxcontent;
            $its[$i]['description'] = $auxcontent;
            
            //print_r($ytitem);
            $aux2 = get_object_vars($ytitem->title);
            $aux = ($aux2['$t']);
            $lb   = array("\r\n", "\n", "\r", "&" ,"-", "`", '�', "'", '-');
            $aux = str_replace($lb, ' ', $aux);

            /*
            $aux = $ytitem->description;
            $lb   = array("\r\n", "\n", "\r", "&" ,"-", "`", '�', "'", '-');
            $aux = str_replace($lb, ' ', $aux);
            $its['settings']['description'] = $aux;
            */
            $i++;
            if($i>$yf_maxi)
                break;
        }
        
    }
    
    
    
    
    
    
    
    $fout.='<div class="gallery-precon gp'.$this->sliders_index.'" style="width:'.$its['settings']['width'].'px;">
        ';
    $fout.='<div class="flashgallery-con" style="height:'.$h.';">
        ';
    
    
    
    
    $tw = $its['settings']['width'];
    $th = $its['settings']['height'];
    $etw = $tw;
    $eth = $th;
    if($its['settings']['scrollbar']=='on'){
        if($its['settings']['menuposition']=='right'){
            $etw+=15;
        }
    }
    
    $fout.='<object type="application/x-shockwave-flash" data="'.$swfloc.'" width="'.$etw.'" height="'.$eth.'" id="flashcontent'.$this->sliders_index.'" style="visibility: visible;">
<param name="movie" value="'.$swfloc.'"><param name="menu" value="false"><param name="allowScriptAccess" value="always"><param name="bgcolor" value="'.$its['settings']['bgcolor'].'">
<param name="scale" value="noscale"><param name="allowFullScreen" value="true"><param name="wmode" value="'.$wmode.'">
<param name="flashvars" value="';
    //print_r($its[$k]);
    
    
    
    
    
    
    
    
    $videos='';
    $thumbs='';
    $titles='';
    $descriptions='';
    $menuDescriptions='';
    $types='';
    for($i=0;$i<count($its)-1;$i++){
        $videos .= $its[$i]['source'];
        if($i != count($its) - 2){
            $videos.=';';
        }
        
        if($its[$i]['thethumb']=='' && $its[$i]['type']=='vimeo'){
            $imgid = $its[$i]['source'];
            $url = "http://vimeo.com/api/v2/video/$imgid.php";
            $cache = dzs_get_contents($url);
            $imga = unserialize($cache);
            $img = ($imga[0]['thumbnail_small']);
            $its[$i]['thethumb']=$img;
        }
        $thumbs .= $its[$i]['thethumb'];
        
        if($i != count($its) - 2){
            $thumbs.=';';
        }
        
        
        if(isset($its[$i]['type'])){
            $types .= $its[$i]['type'];
        }
        
        if($i != count($its) - 2){
            $types.=';';
        }
        if(isset($its[$i]['title'])){
            $titles .= $its[$i]['title'];
        }
        if($i != count($its) - 2){
            $titles.=';';
        }
        if(isset($its[$i]['description'])){
            $descriptions .= $its[$i]['description'];
        }
        if($i != count($its) - 2){
            $descriptions.=';';
        }
        if(isset($its[$i]['menuDescription'])){
            $menuDescriptions .= $its[$i]['menuDescription'];
        }
        if($i != count($its) - 2){
            $menuDescriptions.=';';
        }
    }
    $shareIcons = '';
    $shareLinks = '';
    $shareTooltips = '';
    if($its['settings']['sharebutton'] == 'on'){
        if($its['settings']['facebooklink']!=''){
            $shareIcons.=$this->the_path . 'icons/1.png';
            $shareLinks.=$its['settings']['facebooklink'];
            $shareTooltips.=__('Share on Facebook');
        }
        if($its['settings']['twitterlink']!=''){
            $shareIcons.=';';
            $shareLinks.=';';
            $shareTooltips.=';';
            $shareIcons.=$this->the_path . 'icons/3.png';
            $shareLinks.=$its['settings']['twitterlink'];
            $shareTooltips.=__('Share on Twitter');
        }
        if($its['settings']['googlepluslink']!=''){
            $shareIcons.=';';
            $shareLinks.=';';
            $shareTooltips.=';';
            $shareIcons.=$this->the_path . 'icons/2.png';
            $shareLinks.=$its['settings']['googlepluslink'];
            $shareTooltips.=__('Share on Google Plus');
        }
        
    }
    //echo $videos;
    //print_r($its);
    
    
    
    
    
    
    //echo $this->abspath;
    $fout.=dzs_addSwfAttr('video', $videos, true);
    $fout.=dzs_addSwfAttr('totalWidth', $its['settings']['width']);
    $fout.=dzs_addSwfAttr('totalHeight', $its['settings']['height']);
    $fout.=dzs_addSwfAttr('thumbs', $thumbs);
    $fout.=dzs_addSwfAttr('types', $types);
    $fout.=dzs_addSwfAttr('titles', $titles);
    $fout.=dzs_addSwfAttr('descriptions', $descriptions);
    $fout.=dzs_addSwfAttr('menuDescriptions', $menuDescriptions);
    $fout.=dzs_addSwfAttr('menuPosition', $its['settings']['menuposition']);
    $fout.=dzs_addSwfAttr('autoplay', $its['settings']['autoplay']);
    
    
    if($its['settings']['directurlaccess']=='on'){
        if(($its['settings']['feedfrom']=='youtube user channel') && $its['settings']['youtubefeed_user']!=''){
            $fout.=dzs_addSwfAttr('youtubeFeed', 'on');
            $fout.=dzs_addSwfAttr('youtubeFeed_user', $its['settings']['youtubefeed_user']);
        }
        if(($its['settings']['feedfrom']=='youtube playlist') && $its['settings']['youtubefeed_playlist']!=''){
            $fout.=dzs_addSwfAttr('youtubeFeed', 'on');
            $fout.=dzs_addSwfAttr('youtubeFeed_playlistId', $its['settings']['youtubefeed_playlist']);
        }
    }
    
        //$fout.=dzs_addSwfAttr('shareIcons', $this->abspath . 'img/twitter.png;' . $this->abspath . 'img/facebook.png');
        //$fout.=dzs_addSwfAttr('shareTooltips', "Tweet It;Share on Facebook");
        //$fout.=dzs_addSwfAttr('shareLinks', "http://twitter.com/sharecr63urlcr61".dzs_curr_url()."cr38textcr61Awesome%20VideoGallery;http://www.facebook.com/sharer.phpcr63ucr61".dzs_curr_url()."cr38tcr61Awesome%20VideoGallery");
    if($its['settings']['embedbutton']=='on'){
        $fout.=dzs_addSwfAttr('embedButton', "on");
        $fout.=dzs_addSwfAttr('htmlEmbedCode', "cr60iframe src=cr34".$this->the_path . 'bridge.phpcr63actioncr61viewcr38idcr61'.$its['settings']['id']."cr34 width=cr34".$its['settings']['width']."cr34 height=cr34".$its['settings']['height']."cr34 style=cr34overflow:hidden;cr34 cr62cr60/iframecr62");
    }
    if (isset($its['settings']['thumbnail']) && $its['settings']['thumbnail'] != '') {
        $fout.=dzs_addSwfAttr('cueFirstVideo', "off");
	$fout.=dzs_addSwfAttr('thumb', $its['settings']['thumbnail']);
    }
    if (isset($its['settings']['logo']) && $its['settings']['logo'] != ''){
	$fout.=dzs_addSwfAttr('logo', $its['settings']['logo']);
    }
    if($its['settings']['videogalleryskin']=='custom'){
	$fout.=dzs_addSwfAttr('designXML', $this->abspath . 'deploy/xml/design.xml');
    }
    //print_r($its);
    if($its['settings']['sharebutton'] == 'on'){
        $fout.=dzs_addSwfAttr('shareButton', 'on');
        $fout.=dzs_addSwfAttr('shareIcons', $shareIcons);
        $fout.=dzs_addSwfAttr('shareLinks', $shareLinks);
        $fout.=dzs_addSwfAttr('shareTooltips', $shareTooltips);
    }
    if($its['settings']['embedbutton'] == 'on'){
        $fout.=dzs_addSwfAttr('embedButton', 'on');
    }
    if($its['settings']['hdButton'] == 'on'){
        $fout.=dzs_addSwfAttr('hdButton', 'on');
    }
    if($its['settings']['scrollbar'] == 'on'){
        $fout.=dzs_addSwfAttr('scrollbar', 'on');
    }
    if($its['settings']['disablebigplaybutton'] == 'on'){
        $fout.=dzs_addSwfAttr('player_design_disable_bigplay', 'on');
    }
    if($its['settings']['playerdesignonlybigplay'] == 'on'){
        $fout.=dzs_addSwfAttr('player_design_only_bigplay', 'on');
    }
    if($its['settings']['defaultquality'] == 'HD'){
        $fout.=dzs_addSwfAttr('defaultQuality', 'hd');
    }
    
    
    $fout.='">';
    $fout.='</object>';
    
    
    $fout.='</div>'; //end flashgallery-con
    
    
    
    $menuitem_w = $its['settings']['html5designmiw'];
    $menuitem_h = $its['settings']['html5designmih'];
    $menuposition = ($its['settings']['menuposition']);
    $html5mp = $menuposition;
    $tw = $its['settings']['width'];
    $th = $its['settings']['height'];
    if($menuposition=='right' || $menuposition=='left'){
        $tw -= $menuitem_w;
    }
    if($menuposition=='down' || $menuposition=='up'){
        $th -= $menuitem_h;
    }
    if($menuposition=='down'){
        $html5mp = 'bottom';
    }
    if($menuposition=='up'){
        $html5mp = 'top';
    }
    
    
    
    $jreadycall = 'jQuery(document).ready(function($)';
    $fout.='
<div class="videogallery-con" style="width:' . $tw . 'px; height:' . $th . 'px; display:none;"><div class="preloader"></div>
<div id="vg'.$this->sliders_index.'" class="videogallery" style="width:' . $tw . 'px; height:' . $th . 'px; background-color:'.$its['settings']['bgcolor'].'">';
//<div class="vplayer-tobe" data-videoTitle="Pages"  data-description="<img src=thumbs/pages1.jpg class='imgblock'/><div class='the-title'>Pages</div>AE Project by Generator" data-sourcemp4="video/pages.mp4" data-sourceogg="video/pages.ogv" ><div class="videoDescription">You can have a description here if you choose to.</div></div>

        for($i=0;$i<count($its)-1;$i++){
            //print_r($its[$i]);
            $che = $its[$i];
            $fout.='<div class="vplayer-tobe"';
            if(isset($che['title']) && $che['title']){
                $fout.=' data-videoTitle="'.$che['title'].'"';
            }
            if (isset($che['type']) && $che['type'] == 'video') {
                $fout.=' data-sourcemp4="'.$che['source'].'"';
                if(isset($che['html5sourceogg']) && $che['html5sourceogg']!=''){
                     $fout.=' data-sourceogg="'.$$che['html5sourceogg'].'"';
                }
            }
            if (isset($che['type']) && $che['type'] == 'youtube') {
                $fout.=' data-type="youtube"';
                $fout.=' data-src="'.$che['source'].'"';
            }
            $fout.='>';
            if(isset($che['description']) && $che['description']){
                $fout.='<div class="videoDescription">'.$che['description'].'</div>';
            }
            
            $fout.='<div class="menuDescription">';
            if(isset($che['thethumb']) && $che['thethumb']){
                $fout.='<img src='.$che['thethumb'].' class=\'imgblock\'/>';
            }else{
                if ($che['type'] == 'youtube') {
                    $fout.='{ytthumb}';
                }
            }
            if(isset($che['title']) && $che['title']){
                $fout.='<div class=\'the-title\'>'.$che['title'].'</div>';
            }
            if(isset($che['menuDescription']) && $che['menuDescription']){
                $fout.=$che['menuDescription'];
            }
            $fout.='</div>';
            $fout.='</div>';
        }
        $html5vgautoplay = 'off';
        if($its['settings']['autoplay']=='on' && $its['settings']['defaultvg']=='html5'){
            $html5vgautoplay = 'on';
        }
    $fout.='</div>
</div>
<script>
var flashhtml5main'.$this->sliders_index.' = {
    defaultis : "'.$its['settings']['defaultvg'].'", //flash or html5
    target : "gp'.$this->sliders_index.'"
}
var videoplayersettings = {
autoplay : "off",
videoWidth : 500,
videoHeight : 300,
constrols_out_opacity : 0.9,
constrols_normal_opacity : 0.9,
design_scrubbarWidth:-201
}
'.$jreadycall.'{
$("#vg'.$this->sliders_index.'").vGallery({
menuSpace:0,
randomise:"off",
autoplay :"'.$html5vgautoplay.'",
autoplayNext : "on",
menuitem_width:'.$menuitem_w.',
menuitem_height:'.$menuitem_h.',
menuitem_space:1,
menu_position:"'.$html5mp.'",
transition_type:"'.$its['settings']['html5transition'].'",
design_skin: "'.$html5vgskin.'",
videoplayersettings : videoplayersettings
})	
flashhtml5(flashhtml5main'.$this->sliders_index.');
})
</script>';
    if($its['settings']['shadow']=='on'){
        $fout.='<div class="shadow" style="width:'.$w.';"></div>';
    }
    
    if($its['settings']['enableswitch']=='on'){
    $fout.='<div class="html5-button-con alignright"><div class="html5-button">Switch to HTML5</div></div>';
    }
    $fout.='<div class="clear"></div>';
    $fout.='</div>'; //end gallery-precon
     
        
        
    if($its['settings']['displaymode']=='wall'){
        $fout='';
        $fout.='<style>
            .dzs-gallery-container .item{ width:23%; margin-right:1%; float:left; position:relative; display:block; margin-bottom:10px; }
            .dzs-gallery-container .item-image{ width:100%; }
            .dzs-gallery-container h4{  color:#D26; }
            .dzs-gallery-container h4:hover{ background: #D26; color:#fff; }
            .last { margin-right:0!important; }
            .clear { clear:both; }
            </style>';
        $fout.='<div class="dzs-gallery-container">';
        
        for ($i = 0; $i < count($its) - 1; $i++) {
            if(!isset($its[$i]['type'])){
                continue;
            }
            $islastonrow=false;
            if($i%4 == 3){
                $islastonrow=true;
            }
            $itemclass='item';
            if($islastonrow==true){
                $itemclass.=' last';
            }
            $fout.='<div class="'.$itemclass.'">';
            $fout.='<a href="'.$this->the_path.'ajax.php?ajax=true&height='.$its['settings']['height'].'&width='.$its['settings']['width'].'&type='.$its[$i]['type'].'&source='.$its[$i]['source'].'" title="'.$its[$i]['type'].'" rel="prettyPhoto"><img class="item-image" src="';
            if($its[$i]['thethumb']!='')
                $fout.=$its[$i]['thethumb'];
            else{
                if($its[$i]['type']=="youtube"){
                  $fout.='http://img.youtube.com/vi/'.$its[$i]['source'].'/0.jpg';
                  $its[$i]['thethumb']='http://img.youtube.com/vi/'.$its[$i]['source'].'/0.jpg';
                }
            }
            $fout.='"/></a>';
            $fout.='<h4>'.$its[$i]['title'].'</h4>';
            $fout.='</div>';
            if($islastonrow){
                $fout.='<div class="clear"></div>';
            }
        }
        $fout.='<div class="clear"></div>';
        $fout.='</div>';
        $fout.='<div class="clear"></div>';
        return $fout;
    }
        
    
    
    
    if($its['settings']['displaymode']=='alternatemenu'){
    


    $i = 0;
    $k = 0;


    $current_urla = explode("?", dzs_curr_url());
    $current_url = $current_urla[0];

    $fout = '';
    $fout .= '
<style type="text/css">
.submenu{
margin:0;
padding:0;
list-style-type:none;
list-style-position:outside;
position:relative;
z-index:32;
}

.submenu a{
display:block;
padding:5px 15px;
background-color: #28211b;
color:#fff;
text-decoration:none;
}

.submenu li ul a{
display:block;
width:200px;
height:auto;
}

.submenu li{
float:left;
position:static;
width: auto;
position:relative;
}

.submenu ul, .submenu ul ul{
position:absolute;
width:200px;
top:auto;
display:none;
list-style-type:none;
list-style-position:outside;
}
.submenu > li > ul{
position:absolute;
top:auto;
left:0;
margin:0;
}

.submenu a:hover{
background-color:#555;
color:#eee;
}

.submenu li:hover ul, .submenu li li:hover ul{
display:block;
}
</style>';

    $fout .= '<ul class="submenu">';
    if (isset($this->mainitems)){
        for ($k = 0; $k < count($this->mainitems); $k++) {
            if(count($this->mainitems[$k])<2){
                continue;
            }
            $fout.='<li><a href="#">' . $this->mainitems[$k]["settings"]["id"] . '</a>';

            if (isset($this->mainitems[$k]) && count($this->mainitems[$k]) > 1) {

                $fout.='<ul>';
                for ($i = 0; $i < count($this->mainitems[$k]); $i++) {
                    if (isset($this->mainitems[$k][$i]["thethumb"]))
                        $fout.='<li><a href="' . $current_url . '?the_source=' . $this->mainitems[$k][$i]["source"] . '&the_thumb=' . $this->mainitems[$k][$i]["thethumb"] . '&the_type=' . $this->mainitems[$k][$i]["type"] . '&the_title=' . $this->mainitems[$k][$i]["title"] . '">' . $this->mainitems[$k][$i]["title"] . '</a>';
                }
                $fout.='</ul>';
            }
            $fout.='</li>';
        }
    }

    $k = 0;
    $i = 0;
    $fout .= '</ul>
<div class="clearfix"></div>
<br>';

    if (isset($_REQUEST['the_source'])) {
        $fout.='<div id="hiddenModalContent" style="display:none; width:' . $its['settings']["width"] . 'px; height:' . ($its['settings']["height"]+20) . 'px;">
<p><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" width="' . $its['settings']["width"] . '" height="' . $its['settings']["height"] . '">
        <param name="movie" value="' . $this->the_path . 'deploy/preview.swf?video=' . $_REQUEST['the_source'] . '&types=' . $_REQUEST['the_type'] . '" />
        <param name="allowFullScreen" value="true"/>
        <param name="allowScriptAccess" value="always"/>
        <param name="wmode" value="opaque"/>
        <object type="application/x-shockwave-flash" data="' . $this->the_path . 'deploy/preview.swf?video=' . $_REQUEST['the_source'] . '&types=' . $_REQUEST['the_type'] . '" width="' . $its['settings']["width"] . '" height="' . $its['settings']["height"] . '" allowFullScreen="true" allowScriptAccess="always" wmode="opaque">
        <video width="300" height="200" src="' . $this->mainitems[$k][$i]["source"] . '"></video></object>
</object></p>
</div>';
        $inline_thumb = '<img width="320" height="240" src="' . $_REQUEST['the_thumb'] . '" alt="You can set a image here via the Thumb field."/>';
        if ($_REQUEST['the_type'] == "youtube")
            $inline_thumb = '<img width="320" height="240" src="http://img.youtube.com/vi/' . $_REQUEST['the_source'] . '/0.jpg" alt="You can set a image here via the Thumb field."/>';

        $fout.='<a href="#hiddenModalContent" title="' . $_REQUEST['the_title'] . '" rel="prettyPhoto">' . $inline_thumb . '</a>
';
    }



    return $fout;
    }
    
    
    
    
    
    
        return $fout;
    
    
    
    
        
        
        
        
        //echo $k;
    }
    
    function admin_init(){
        //add_meta_box('zsvg_meta_options', __('DZS Video Gallery Settings'), array($this,'admin_meta_options'), 'post', 'normal', 'high');
        //add_meta_box('zsvg_meta_options', __('DZS Video Gallery Settings'), array($this,'admin_meta_options'), 'page', 'normal', 'high');
    }
    function post_options(){
        //// POST OPTIONS ///
        
        if(isset($_POST['zsvg_exportdb'])){
        header('Content-Type: text/plain'); 
        header('Content-Disposition: attachment; filename="' . "zsvg_backup.txt" . '"'); 
        echo serialize($this->mainitems);
        die();
        }
        
        

        if(isset ($_POST['zsvg_importdb'])){
            //print_r( $_FILES);
            $file_data = file_get_contents($_FILES['zsvg_importdbupload']['tmp_name']);
            update_option($this->dbitemsname, unserialize($file_data));
            $this->mainitems = unserialize($file_data);
        }
        if(isset ($_POST['zsvg_saveoptions'])){
            $this->mainoptions['usewordpressuploader'] = $_POST['usewordpressuploader'];
            $this->mainoptions['embed_prettyphoto'] = $_POST['embed_prettyphoto'];
            //$this->mainoptions['embed_masonry'] = $_POST['embed_masonry'];
            update_option($this->dboptionsname, $this->mainoptions);
        }
    }
    function handle_init(){
        if(is_admin()){
            if(isset ($_GET['page']) && $_GET['page'] == 'zsvg_menu'){
                $this->admin_scripts();
            }
        }else{
            $this->front_scripts();
        }
    }
    function handle_admin_menu(){
        
        if($this->pluginmode=='theme'){
            $zsvg_page = add_theme_page(__('DZS Video Gallery'), __('DZS Video Gallery'), $this->admin_capability, 'zsvg_menu', array($this, 'admin_page'));
        }else{
            $zsvg_page = add_options_page(__('DZS Video Gallery'), __('DZS Video Gallery'), $this->admin_capability, 'zsvg_menu', array($this, 'admin_page'));
        }
    }
    function admin_scripts(){
        wp_enqueue_script('media-upload');
        wp_enqueue_script('tiny_mce');
        wp_enqueue_script('thickbox');
        wp_enqueue_style('thickbox');
        wp_enqueue_script('zsvg_admin', $this->the_path . "admin/admin.js");
        wp_enqueue_style('zsvg_admin', $this->the_path . 'admin/admin.css');
        wp_enqueue_script('dzs.farbtastic', $this->the_path . "admin/colorpicker/farbtastic.js");
        wp_enqueue_style('dzs.farbtastic', $this->the_path . 'admin/colorpicker/farbtastic.css');
        wp_enqueue_script('jquery.form', $this->the_path.'admin/dzsuploader/jquery.form.js');
        wp_enqueue_style('zsvgdzsuploader', $this->the_path.'admin/dzsuploader/upload.css');
        wp_enqueue_script('zsvgdzsuploader', $this->the_path.'admin/dzsuploader/upload.js');
        wp_enqueue_script('jquery-ui-core');
        wp_enqueue_script('jquery-ui-sortable');
    }
    function front_scripts(){
        //print_r($this->mainoptions);
        $videogalleryscripts = array('jquery');
        wp_enqueue_script('jquery');
        wp_enqueue_script('dzs.vplayer', $this->the_path . "videogallery/vplayer.js", $videogalleryscripts);
        wp_enqueue_script('dzs.flashhtml5main', $this->the_path . "videogallery/flashhtml5main.js", $videogalleryscripts);
        wp_enqueue_style('dzs.vgallery.skin2', $this->the_path . 'videogallery/skin_white.css');
        wp_enqueue_style('dzs.vplayer', $this->the_path . 'videogallery/vplayer.css');

        
        if($this->mainoptions['embed_prettyphoto']=='on'){
            wp_enqueue_script('jquery.prettyphoto', $this->the_path . "prettyphoto/jquery.prettyPhoto.js");
            wp_enqueue_style('jquery.prettyphoto', $this->the_path . 'prettyphoto/prettyPhoto.css');
        }
        //if($this->mainoptions['embed_masonry']=='on'){
            //wp_enqueue_script('jquery.masonry', $this->the_path . "masonry/jquery.masonry.min.js");
        //}
        
    }
    function admin_page(){
        ?>
<div class="wrap">
    <div class="import-export-db-con">
            <div class="the-toggle"></div>
            <div class="the-content-mask" style="overflow:hidden; height: 0px; position:relative;">
                <div class="arrow-up"></div>
            <div class="the-content">
                <h3>Export Database</h3>
        <form action="" method="POST"><input type="submit" name="zsvg_exportdb" value="Export"/></form>
                <h3>Import Database</h3>
        <form enctype="multipart/form-data" action="" method="POST">
<input type="hidden" name="MAX_FILE_SIZE" value="100000" />
File Location: <input name="zsvg_importdbupload" type="file" /><br />
<input type="submit" name="zsvg_importdb" value="Import" />
</form>
                <h3>General Options</h3>
            <form enctype="multipart/form-data" action="" method="POST">
                <h5>Use WordPress Uploader ?</h5>
                <select name="usewordpressuploader">
                    <option>on</option>
                    <option>off</option>
                </select><br></br>
                <h5>Embed Prettyphoto ?</h5>
                <select name="embed_prettyphoto">
                    <option>on</option>
                    <option>off</option>
                </select><br></br>
                <input type="submit" class="button-primary" name="zsvg_saveoptions" value="Save Options" />
                
            </form>
        </div>
        </div>
    </div>
    <h2>DZS <?php _e('Video Gallery Admin'); ?> <img alt="" style="visibility: visible;" id="main-ajax-loading" src="<?php bloginfo('wpurl'); ?>/wp-admin/images/wpspin_light.gif"/></h2>
    <noscript>You need javascript for this.</noscript>
    <a href="<?php echo $this->the_path; ?>readme/index.html" class="button-secondary action">Documentation</a>
    <a href="<?php echo $this->the_path; ?>deploy/designer/index.php" target="_blank" class="button-secondary action">Go to Designer Center</a>
    <table cellspacing="0" class="wp-list-table widefat dzs_admin_table main_sliders">
            <thead> 
            <tr> 
            <th style="" class="manage-column column-name" id="name" scope="col">ID</th>
            <th class="column-edit">Edit</th> 
            <th class="column-edit">Duplicate</th> 
            <th class="column-edit">Delete</th> 
            </tr> 
            </thead> 
            <tbody>
            </tbody>
    </table>
    <a class="button-secondary add-slider">Add Slider</a>
    <form class="master-settings">
    </form>
    <div class="dzsuploader dzs-multi-upload">
        <p>
            <input id="files-upload" class="multi-uploader" name="file_field" type="file" multiple>
        </p>
        <div class="droparea">
            <div class="instructions">drag & drop files here</div>
        </div>
        <div class="upload-list-title">The Preupload List</div>
        <ul class="upload-list">
            <li class="dummy">add files here from the button or drag them above</li>
        </ul>
        <button class="primary-button upload-button">Confirm Upload</button>
    </div>
    <div class="saveconfirmer">Loading...</div>
    <a href="#" class="button-primary master-save">Save Changes</a> <img alt="" style="position:fixed; bottom:18px; right:125px; visibility: hidden;" id="save-ajax-loading" src="<?php bloginfo('wpurl'); ?>/wp-admin/images/wpspin_light.gif"/>
    
</div>
<script>
        <?php 
        //$jsnewline = '\\' + "\n";
	echo "window.dzs_upload_path = '".$this->the_path."admin/dzsuploader/upload/';
";
        echo "window.dzs_php_loc = '".$this->the_path."admin/dzsuploader/upload.php';
";
        $aux = str_replace(array("\r", "\r\n", "\n"), '', $this->sliderstructure);
        echo "var sliderstructure = '".$aux."';
";
        $aux = str_replace(array("\r", "\r\n", "\n"), '', $this->itemstructure);
        echo "var itemstructure = '".$aux."';
";
        ?>
        jQuery(document).ready(function($){
        sliders_ready();
        <?php
        $items = $this->mainitems;
        for($i=0;$i<count($items);$i++){
            echo "sliders_addslider(); 
";
        }
        if(count($items)>0)
            echo 'sliders_showslider(0);
';
        for($i=0;$i<count($items);$i++){
            
        for($j=0;$j<count($items[$i])-1;$j++){
            echo "sliders_additem(".$i."); 
";
        }
        foreach($items[$i] as $label => $value){
            if($label==='settings'){
                
                foreach($items[$i][$label] as $sublabel => $subvalue){
                    
                    $subvalue=stripslashes($subvalue);
                $subvalue = str_replace(array("\r", "\r\n", "\n", '\\', "\\"), '', $subvalue);
                $subvalue = str_replace(array("'"), '"', $subvalue);
                echo 'sliders_change('.$i.', "settings", "'.$sublabel.'", '."'".$subvalue."'".'); 
';
                }
            }else{
                
                foreach($items[$i][$label] as $sublabel => $subvalue){
                    $subvalue=stripslashes($subvalue);
                $subvalue = str_replace(array("\r", "\r\n", "\n", '\\', "\\"), '', $subvalue);
                $subvalue = str_replace(array("'"), '"', $subvalue);
                echo 'sliders_change('.$i.', '.$label.', "'.$sublabel.'", '."'".$subvalue."'".'); 
';
                }
                
            }
        }
        }
        ?>
        jQuery('#main-ajax-loading').css('visibility', 'hidden');
});     
        </script>
        <?php
    }
    function post_save(){
        //echo $_POST['postdata'];
        $auxarray = array();
        $mainarray=array();
        parse_str($_POST['postdata'], $auxarray);
        foreach($auxarray as $label => $value){
            //echo $auxarray[$label];
            $aux = explode('-', $label);
            $mainarray[$aux[0]][$aux[1]][$aux[2]] = $auxarray[$label];
        }
        update_option($this->dbitemsname, $mainarray);
        die();
    }
}

require_once('widget.php');
if($zsvg->pluginmode!='theme'){
require_once('dzs_functions.php');
}