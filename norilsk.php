<?php 
/*
Plugin Name: Published Articles Since Last Visit
Plugin URI: http://padicode.com/blog/published-articles-since-last-visit/
Description: Plugin for displaying top articles to visitors from their last visit.
Author: PadiCode
Version: 1.1
Author URI: http://padicode.com/
*/
?>
<?php
//function the_permalink_rss_custom() {
//	echo apply_filters('the_permalink_rss_custom', get_permalink()."&rss=1 ");
//}
function norilsk_admin() {
			include('norilsk_admin.php');
}	
function norilsk_admin_actions() {
			add_options_page("Published Articles Since Last Visit", "Published Articles Since Last Visit", 1, "norilsk_admin", "norilsk_admin");
}
//--------------------------------------- OPTION DECLARATIONS

//--------------------------------------- GOOGLE ANALYTICS CLASS 
 	require("class.gaparse.php");
	$aux = new GA_Parse($_COOKIE);

//--------------------------------------- RSS VISITORS
	$displayrss = get_option('norilskadm_displayrss');
	if ($displayrss=='1' and ($_GET['utm_source']=='feedburner' or $aux->campaign_source == 'feedburner')) return false;	

//--------------------------------------- STYLE FUNCTION	
	function norilsk_style() { ?>
	<style type="text/css">
	#norilsk { /*width: 100%; border:*/ 1px solid #CCC; padding:5px 10px 10px 10px; background:#EFEFEF; margin:10px 0px;  }
	#norilsk h3 { margin-bottom:10px; }
	li.norilsk-posts {list-style-position:inside;}
	</style>
    <? 	
	}

//--------------------------------------- BEGIN
//ini_set('display_errors',1);
//error_reporting(E_ALL|E_STRICT);
	function getArticlesFromLastVisit($singleart) { 

	global $aux;
	global $wpdb;


	$title = get_option('norilskadm_title');
	$articlesno = get_option('norilskadm_articlesno');
	$theorder = get_option('norilskadm_orderby');
	$displayauthors = get_option('norilskadm_displayauthors');	
	$footertext = get_option('norilskadm_footertext');

//--------------------------------------- DATE VARIABLES
	if ((($aux->current_visit_started=='') or ($aux->previous_visit=='') or  strstr($aux->current_visit_started,"1970")  or  strstr($aux->previous_visit,"1970")) and (!isset($_GET['date_prev']))) return false;
	$currentdate=date('Y-m-d');
	
	// preview & testing purposes
	if(!isset($_GET['date_curr'])) {  
	$started_trimmed=substr($aux->current_visit_started, 0, -6);
	} else {     
	$started_trimmed=$_GET['date_curr'];   
	}
	if(!isset($_GET['date_prev'])) {
	$previous_trimmed=substr($aux->previous_visit,0,-6);
	} else { 
	$previous_trimmed=$_GET['date_prev'];
	}  
	
	//echo $started_trimmed." - ".$previous_trimmed." - ".$currentdate; //testing dates
	// end preview & testing purposes
	
//---------------------------------------- TITLE 
 	if ($title!='') { $title="<h3>".$title."</h3>"; }

//---------------------------------------- ORDER
	if ($theorder=='comment_count') {
		$norilsk_order = "comment_count";
	} else if ($theorder=='date') {
		$norilsk_order = "post_date";
	} else {
	}
//---------------------------------------- DATE-
	if (($currentdate)>($started_trimmed))
	{ 	
	$sql="
	SELECT * 
	FROM $wpdb->posts 
	WHERE post_date>='".$started_trimmed." 00:00:00'
	AND post_type='post' 
	AND post_status='publish' 
	ORDER BY ".$norilsk_order." DESC
	LIMIT ".$articlesno;	
	}
	else if (($currentdate)==($started_trimmed) && ($started_trimmed)>($previous_trimmed)) {
	$sql="
	SELECT * 
	FROM $wpdb->posts 
	WHERE post_date>='".$previous_trimmed." 00:00:00'
	AND post_date<='".$started_trimmed." 00:00:00'
	AND post_type='post' 
	AND post_status='publish' 
	ORDER BY ".$norilsk_order." DESC
	LIMIT ".$articlesno;
	} 
	else {
		return false;
	}
	$pageposts = $wpdb->get_results($sql, OBJECT);	
	
	
	global $wp_query;
	$thePostID = $wp_query->post->ID;
	//echo $singleart." ".$thePostID;

	if(sizeOf($pageposts)>1) { //only display anything if more than one post

	$monitor_plugin = get_option('norilskadm_monitorplugin');
	if($monitor_plugin == '1') {
	add_action('wp_footer','monitor_plugin'); 
	}
		
	echo "<div id=\"norilsk\">".$title."<ul class=\"upcoming-posts\">";
		foreach ($pageposts as $post):
			$do_not_duplicate = $post->ID; 	
			if ($singleart == 1){ // don't display the name of article that the user is on
				if ($do_not_duplicate != $thePostID)
			
			{
				$titlupost=get_the_title($post->ID);
				$postlink=get_permalink($post->ID);
				//$authorname=;//$authorname=get_the_author_meta('display_name',($post->post_author));
				  ?>
					<li class="upcoming-post">
					  <span class="upcoming-post-title"><a href="<?php echo $postlink;  ?>" onclick="javascript: if(window.gaJsHost==null && window.pageTracker==null){ _gaq.push(['_trackEvent','Old visitor','Clickthrough']); } else { pageTracker._trackEvent('Old visitor','Clickthrough'); }" rel="bookmark" title="Permanent Link to <?php echo $titlupost; ?>"><?php echo $titlupost; ?></a> <small><? if ($displayauthors == 'yes') { echo "| by " ?> <? the_author();  }?></small></span>
					</li> 
				  <?php
			}
			}
			
			else 
			{
				$titlupost=get_the_title($post->ID);
				$postlink=get_permalink($post->ID);
				//$authorname=;//$authorname=get_the_author_meta('display_name',($post->post_author));
				  ?>
					<li class="upcoming-post">
					  <span class="upcoming-post-title"><a href="<?php echo $postlink;  ?>" onclick="javascript: if(window.gaJsHost==null && window.pageTracker==null){ _gaq.push(['_trackEvent','Old visitor','Clickthrough']); } else { pageTracker._trackEvent('Old visitor','Clickthrough'); }" rel="bookmark" title="Permanent Link to <?php echo $titlupost; ?>"><?php echo $titlupost; ?></a> <small><? if ($displayauthors == 'yes') { echo "| by " ?> <? the_author();  }?></small></span>
					</li> 
				  <?php
				
			}
				  endforeach;
				  echo "</ul>".stripslashes($footertext)."</div>";	
			
		}
	


	}
	
	function norilsk_filter($content) {
			if (is_single())
				return $content.getArticlesFromLastVisit(1).norilsk_style();
			else
				return $content.getArticlesFromLastVisit(0).norilsk_style();
	}
	function getTracker() {
		echo "<script>if(window.gaJsHost==null && window.pageTracker==null){ _gaq.push(['_trackEvent','Old visitor', 'Display']); } else { pageTracker._trackEvent('Old visitor', 'Display'); }</script>";
	}
	function monitor_plugin($content) {
		return $content.getTracker();
	} 
	function norilsk_uninstall_link( $links, $file ) {
		if( $file == 'published-articles-since-last-visit/uninstall.php' && function_exists( "admin_url" ) ) {
			$settings_link = '<a href="' . admin_url( 'options-general.php?page=published-articles-since-last-visit/uninstall.php' ) . '">' . __('Uninstall') . '</a>';
			array_unshift( $links, $settings_link ); // before other links
		}
		return $links;
	}	
$display_plugin = get_option('norilskadm_display_plugin');	
if($display_plugin=='1' or $display_plugin=='3') {
	add_filter('comments_template','norilsk_filter');
}
add_action('admin_menu', 'norilsk_admin_actions');
add_filter( 'plugin_action_links', 'norilsk_uninstall_link', 9, 2 );
?>