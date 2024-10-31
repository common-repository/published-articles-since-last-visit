<style>
.norilsk_box { width:44%; float:left; display:block; padding:0px 10px; border:1px solid #CCC; margin:10px; background:#fff; }
.head_little {padding-left:10px;}
</style>
	<?php	
	global $wpdb;
	$sql="SELECT * FROM $wpdb->options WHERE option_name='norilskadm_display_plugin'";
	$displayplg = $wpdb->get_results($sql, OBJECT);
	if (get_option('norilskadm_title') == NULL) 
	{
			$title = "Welcome back. Recent articles you might of have missed";
			update_option('norilskadm_title', $title);
			
			$articlesno = "5";
			update_option('norilskadm_articlesno', $articlesno);
			
			$orderby = "date";
			update_option('norilskadm_orderby', $orderby);
			
			$displayauthors = "no";
			update_option('norilskadm_displayauthors', $displayauthors);
	
			$displayrss = "1";
			update_option('norilskadm_displayrss', $displayrss);
			
			$display_plugin = "3";
			update_option('norilskadm_display_plugin', $display_plugin);
			
			$monitor_plugin = "1";
			update_option('norilskadm_monitorplugin', $monitor_plugin);	
			
			$footertext = "<p>You may want to subscribe to my <a href=\"".get_bloginfo('rss2_url')."\">RSS Feed</a>. Thanks for visiting!</p>";
			update_option('norilskadm_footertext', $footertext);
			
	}
		if($_POST['norilskadm_hidden'] == 'Y') {
			//Form data sent
			$title = $_POST['norilskadm_title'];
			update_option('norilskadm_title', $title);
			
			$articlesno = $_POST['norilskadm_articlesno'];
			update_option('norilskadm_articlesno', $articlesno);
			
			$orderby = $_POST['norilskadm_orderby'];
			update_option('norilskadm_orderby', $orderby);
			
			$displayauthors = $_POST['norilskadm_displayauthors'];
			update_option('norilskadm_displayauthors', $displayauthors);
	
			$displayrss = $_POST['norilskadm_displayrss'];
			update_option('norilskadm_displayrss', $displayrss);
			
			$display_plugin = $_POST['norilskadm_display_plugin'];
			update_option('norilskadm_display_plugin', $display_plugin);
			
			$monitor_plugin = $_POST['norilskadm_monitorplugin'];
			update_option('norilskadm_monitorplugin', $monitor_plugin);	
			
			$footertext = $_POST['norilskadm_footertext'];
			update_option('norilskadm_footertext', $footertext);				
			?>
            
			<div class="updated"><p><strong><?php _e('Options saved.' ); ?></strong></p></div>
			<?php	
		} else { 
			//Normal page display
			$title = get_option('norilskadm_title');
			$articlesno = get_option('norilskadm_articlesno');
			$orderby = get_option('norilskadm_orderby');
			$displayauthors = get_option('norilskadm_displayauthors');
			$displayrss = get_option('norilskadm_displayrss');	
			$display_plugin = $displayplg[0]->option_value;
			$monitor_plugin = get_option('norilskadm_monitorplugin');	
			$footertext = get_option('norilskadm_footertext');
		}
		if($_POST['norilskadm_hidden2'] == 'Y') {
			if($_POST['norilskadm_gauser']!='') {
            $gauser = $_POST['norilskadm_gauser'];
			update_option('norilskadm_gauser', $gauser);	
			} else { 				
				$gauser = get_option('norilskadm_gauser');
			}
			if($_POST['norilskadm_gapass']!='') {
			$gapass = $_POST['norilskadm_gapass'];
			update_option('norilskadm_gapass', $gapass);
			} else {
				$gapass = get_option('norilskadm_gapass');
			}
			if($_POST['norilskadm_gaprofile']!='') {
			$gaprofile = $_POST['norilskadm_gaprofile'];
			update_option('norilskadm_gaprofile', $gaprofile);	
			} else { 
				$gaprofile = get_option('norilskadm_gaprofile');
			} 

		?>
		<div class="updated"><p><strong><?php _e('Options saved.' ); ?></strong></p></div>
		<? } else { 
			if(!isset($_POST['modify_ga'])) {
			$gauser = get_option('norilskadm_gauser');
			$gapass = get_option('norilskadm_gapass');
			$gaprofile = get_option('norilskadm_gaprofile');
			}			
		}
		if($_POST['modify_ga']=='1') {
			$gauser = '';
			update_option('norilskadm_gauser',$gauser);
			$gapass = '';
			update_option('norilskadm_gapass',$gapass);
			$gaprofile = '';
			update_option('norilskadm_gaprofile',$gaprofile);
		}
	?>
	
<div class="wrap">
     <!-- added by display_plugin -->
     <div class="head_little">
	<?php  echo "<h2>" . __( 'Published Articles Since Last Visit Settings', 'norilskadm_trdom' ) . "</h2>"; ?>
   
    <p>Display articles that have been published since the user's last visit based on Google Analytics data.</p>
    </div>
    <!-- /added by display_plugin -->
<form name="norilskadm_form" id="norilskadm_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">    
    <div class="norilsk_box">  
        <input type="hidden" name="norilskadm_hidden" value="Y">
        <?php    echo "<h4>" . __( 'Plugin Setup', 'norilskadm_trdom' ) . "</h4>"; ?>
      <p><?php _e("Title of Article List: " ); ?><input type="text" name="norilskadm_title" value="<?php if($title!='') { echo $title; } else {?><? } ?>" size="40"></p>
            <p><?php _e("Footer text: " ); ?></p><textarea id="norilskadm_footertext" style="width:100%;" name="norilskadm_footertext" rows="3"><?php echo  stripslashes($footertext); ?></textarea>
  <p><a href="#" id="advanced_link" onclick="javascript: document.getElementById('advanced_options').style.display='block'; document.getElementById('advanced_link').style.display='none'; document.getElementById('fewer_link').style.display='block';"><?php _e("Click here for Advanced Options" ); ?></a><a href="#" id="fewer_link" style="display:none;" onclick="javascript: document.getElementById('advanced_options').style.display='none';document.getElementById('advanced_link').style.display='block'; document.getElementById('fewer_link').style.display='none';">Hide Advanced options</a></p>
  
  <div id="advanced_options" style="display:none;">
  <p><?php _e("Number of articles to show: " ); ?><select name="norilskadm_articlesno" value="<?php echo $articlesno; ?>">
			<option value="3" <? if($articlesno == '3') { echo 'selected="selected"'; } ?>>3</option>
        	<option value="5" <? if(($articlesno == '5') or ($articlesno=='')) { echo 'selected="selected"'; } ?>>5</option>
            <option value="10" <? if($articlesno == '10') { echo 'selected="selected"'; } ?>>10</option>
            
    </select></p>
  <p><?php _e("Order articles by: " ); ?><select name="norilskadm_orderby" value="<?php echo $orderby; ?>">
        	<option value="date" <? if(($orderby == 'date') or ($orderby == '')) { echo 'selected="selected"'; } ?>>Publish date</option>
            <option value="comment_count" <? if($orderby == 'comment_count') { echo 'selected="selected"'; } ?>>Comment count</option>
    </select></p>
        <p><?php _e("Display author names" ); ?><select name="norilskadm_displayauthors" value="<?php echo $displayauthors; ?>">
        <option value="yes" <? if($displayauthors == 'yes') { echo 'selected="selected"'; } ?>>Yes</option>
        <option value="no" <? if(($displayauthors == 'no') or ($displayauthors == '')) { echo 'selected="selected"'; } ?>>No</option>
    </select></p>
        <p><input type="checkbox" name="norilskadm_displayrss" value="1" <? if(($displayrss == '1') or ($displayrss=='')) { echo 'checked="checked"'; } ?>> <?php _e("Don't display plugin to people coming from RSS feed links (works only if you use <a href=\"http://feedburner.google.com\" target=\"_blank\">FeedBurner</a>)" ); ?></p>
	 </div>
        <h4><?php _e("Where do you want the plugin to be displayed?" ); ?></h4>
        <p>
          <label>
            <input type="radio" name="norilskadm_display_plugin" <? if($display_plugin =='1') { echo 'checked="checked"'; } ?> value="1" id="display_plugin_0" />
            After each post</label>
          <br />
          <label>
            <input type="radio" name="norilskadm_display_plugin" <? if($display_plugin=='2') { echo 'checked="checked"'; } ?> value="2" id="display_plugin_1" />
            Where I use the <code>&lt;?php norilsk_filter($content); ?&gt;</code> template tag <sup>1</sup></label> 
          <br />
          <label>
            <input type="radio" name="norilskadm_display_plugin" <? if(($display_plugin=='3') or ($display_plugin=='')) { echo 'checked="checked"'; } ?> value="3" id="display_plugin_2" />
            Both</label>
          <br />
        </p>
<hr />
     <div style="display:none;">   <?php echo "<h4>" . __( 'Monitor Plugin impact', 'norilskadm_trdom' ) . "</h4>"; ?>     
    <p><input name="norilskadm_monitorplugin" <? if(($monitor_plugin == '1') or ($monitor_plugin=='')) { echo 'checked="checked"'; } ?> type="checkbox" value="1" /> Please check this if you want to monitor Returning visitors in your Google Analytics data.</p></div>
    
      <p class="submit">
        <input class="button-primary" type="submit" name="Submit" style="font-weight:bold; font-size:16px;" value="<?php _e('Save Settings', 'norilskadm_trdom' ) ?>" />
        </p>
   
      <p>
      <b><em>Tips & Tricks</em></b>
      <br/>
     <ol> <li>We recommend adding <code>&lt;?php norilsk_filter($content); ?&gt;</code> just before  the following line: <code>&lt;?php if (have_posts()) : ?&gt;</code>, in the <b>Main Index File</b> (index.php) of your theme. You can edit it manually under <a href="theme-editor.php">Appearance / Editor</a></li>
      <li>To preview how your old visitors are going to see the suggested articles just add "?date_prev=1971" to the URL in the pages where you have set up to isplay published articles since last visit.</li>
     </ol>
      </p>  

 </form>
 </div>
  	<div class="norilsk_box" <? if($monitor_plugin!='1') { ?>style="display:none;" <? } ?>>
    <div id="ga"> 
    <?php if((($gauser!="") and ($gapass!="") and ($gaprofile=="")) or (($_POST['norilskadm_gapass']!="") and ($_POST['norilskadm_gauser']!=""))) {
			// include the Google Analytics PHP class
			include_once('googleanalytics.class.php'); 
				try {			
					$ga = new GoogleAnalytics($gauser,$gapass);
					$profiles=$ga->getWebsiteProfiles();  
				
					if(sizeof($profiles)>0)   
					 { 
					 ?>
                    <div class="updated"><p><strong><?php _e('You are now authenticated with Google Analytics.' ); ?></strong></p></div>
   					 <form name="norilskadm_form2" id="norilskadm_form2" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
    				 <input type="hidden" name="norilskadm_hidden2" value="Y">   
                    <?php echo "<h4>" . __( 'Select a Google Analytics profile to use', 'norilskadm_trdom' ) . "</h4>";	 ?>  
                    Please select from the list below which profile from your Google Analytics account is of your blog.
                    <div id="dataControls" >
					 <table border="0" cellpadding="2" width="100%">
					  <tr>
                          <td><strong>Title</strong></td>
                          <td><strong>Account Name</strong></td>
                          <td><strong>Select a profile</strong></td>
					  </tr>
					 <? foreach($profiles as $profile)
						  { ?>
					  <tr>
                          <td><? echo $profile['title']?></td>
                          <td><? echo $profile['accountName']?></td>
                          <td><input type="radio" name="norilskadm_gaprofile" id="gaprofile_<?  echo $profile['profileId']; ?>" value="<?  echo $profile['profileId']; ?>" onclick="document.getElementById('norilskadm_form2').submit()" /></td>
					  </tr>
						 <?
						  }
						   ?>
					 </table>
					</div>
                   </form>
                   <?  modifyThis(); ?>
				<?	 }
				} catch (Exception $e) { 
				if($e->getMessage()=='Failed to authenticate, please check your email and password.') { ?>
                <form name="norilskadm_form2" id="norilskadm_form2" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
    			<input type="hidden" name="norilskadm_hidden2" value="Y">   
				<?php echo "<h4>" . __( 'Authenticate with Google Analytics', 'norilskadm_trdom' ) . "</h4>";	 ?>  
                <? print '<p style=\'color:red !important;\'>Error: ' . $e->getMessage() . '</p>'; ?>
                 <p><?php _e("GA E-mail: " ); ?><input type="text" name="norilskadm_gauser" value="" size="32"></p>
        	 	 <p><?php _e("Password: " ); ?><input type="password" name="norilskadm_gapass" value="" size="20"></p>
           		 <hr />
				  <p class="submit">
        		  <input class="button-primary" type="submit" name="Submit" style="font-weight:bold; font-size:16px;" value="<?php _e('Login to Google Analytics', 'norilskadm_trdom' ) ?>" /></p> 
                   </form>
        			<? } else {  
                    print '<div class=\"updated\"><p><strong>Error: ' . $e->getMessage() . '</stong></p></div>'; 
					} ?>
				<? }
			} //end if 
			else if(($gaprofile!='') or ($_POST['norilskadm_gaprofile']!='')) { 
			include_once('googleanalytics.class.php'); 
			/// Display REPORT
			 $curr=date("Y-m-d");
			 $q="SELECT DATE_SUB('".$curr."', INTERVAL 30 DAYS)";
			 $pastdate = $wpdb->get_results($q, OBJECT);
			try {			
           
				$ga = new GoogleAnalytics($gauser,$gapass);
				$ga->setProfile('ga:'.$gaprofile);
				$ga->setDateRange(date('Y-m-d', strtotime('-4 week')),date('Y-m-d'));

				$report = $ga->getReport(
					array('metrics'=>urlencode('ga:visits'),
						'filters'=>urlencode('ga:eventAction=@Display'),
						'max-results'=>urlencode('50'),
						'sort'=>'-ga:visits'						
						)
					);
				$report2 = $ga->getReport(
					array('metrics'=>urlencode('ga:visits'),
						'filters'=>urlencode('ga:eventAction=@Clickthrough'),
						'max-results'=>urlencode('50'),
						'sort'=>'-ga:visits'			
						)
					);
				if(sizeof($report)>0)
				 foreach($report as $key=>$value) 
				 {  
		
					foreach($value as $k =>$v){
					 $r1=$v;
					}
				 }
				if(sizeof($report2)>0)
				 foreach($report2 as $key=>$value) 
				 {  
		
					foreach($value as $k =>$v){
					 $r2=$v;
					}
				 } 
	 		?>
            <?php echo "<h4>" . __( 'Reports for the last 30 days', 'norilskadm_trdom' ) . "</h4>";	 ?>  
            <p>For the last 30 days here is how many people viewed the list of articles they missed and how many clicked on them:</p>
			 <p>Old visitor visits: <strong><? if (sizeof($r1)>0) { echo $r1; } else { echo "0"; } ?></strong></p>
             <p>Old visitor clicks: <strong><? if (sizeof($r2)>0) { echo $r2; } else { echo "0"; }?></strong></p>
             <? modifyThis(); ?>
			<?	
			} catch (Exception $e) { 
					print '<div class=\"updated\"><p><strong>Error: ' . $e->getMessage() . '</stong></p></div>'; 
			}
			?>            		
			<? } else { 
			?>
   			 <form name="norilskadm_form2" id="norilskadm_form2" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
   			 <input type="hidden" name="norilskadm_hidden2" value="Y">               
            <?php echo "<h4>" . __( 'Monitor Plugin impact', 'norilskadm_trdom' ) . "</h4>";	 ?>
            Each time a user views the suggested links of articles from your blog and each time he clicks on a link we send data to your Google Analytics account. Login now to Google Analytics and get the reports directly here.  
       		 <p><?php _e("GA E-mail: " ); ?><input type="text" name="norilskadm_gauser" value="" size="32"></p>
        	 <p><?php _e("Password: " ); ?><input type="password" name="norilskadm_gapass" value="" size="32"></p>
            <hr />
     	 <p class="submit">
        <input class="button-primary" type="submit" name="Submit" style="font-weight:bold; font-size:16px;" value="<?php _e('Login to Google Analytics', 'norilskadm_trdom' ) ?>" /></p>
         </form>
        
        <? } ?>
   
<? function modifyThis() { ?>
    <hr />
    <form action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>" method="post" id="modify" name="modify" />
    <input type="hidden" name="modify_ga" id="modify_ga" value="1" />
     <p class="submit">
    <a id="modify_link" href="#" onclick="javascript: document.getElementById('modify').submit();">Modify Google Analytics Login/Profile</a>
    </p>
    </form>
<? } ?>
    </div>
    </div>

    
  
    
    <div class="norilsk_box">
    <?php echo "<h4>" . __( 'Plugin Details', 'norilskadm_trdom' ) . "</h4>"; ?>	
    <!-- added by display_plugin -->
   <p><b>Published Articles Since Last Visit</b> is a Wordpress plugin developed and maintained by <a href="http://padicode.com" title="Action Oriented Web Analytics">PadiCode</a>, an international micro-corporation developing web applications that focus attention in using web analytics for offering a better experience to website visitors. </p>
   <p>
    Check out the official page of the plugin: <a href="http://padicode.com/blog/published-articles-since-last-visit/">Official Page</a>.<br />
    For questions or feedback please contact us at <a href="mailto:wordpress@padicode.com">wordpress@padicode.com</a>.<br />
Special thanks: <a href="http://webgurus.ro/">WebGurus</a>
    </p>
    <!-- /added by display_plugin -->
    </div>  
</div>
