<html>
<head>
<title>Published Articles Since last visit - Uninstall Script</title>
</head>
<body>
<?php
global $wpdb;
 
	if ( in_array( 'published-articles-since-last-visit/norilsk.php', get_option( 'active_plugins' ) ) ) 
	wp_die( 'Published Articles Since Last Visit is still active. Please disable it on your plugins page first.' );	
	$plugins = (array)get_option( 'active_plugins' );
	$key = array_search( 'published-articles-since-last-visit/norilsk.php', $plugins );
	if ( $key !== false ) {
		unset( $plugins[ $key ] );
		update_option( 'active_plugins', $plugins );
		echo "Disabled Published Articles Since Last Visit plugin : <strong>DONE</strong><br />";
	}		
	echo "Removing database entries: ";
	delete_option('norilskadm_articlesno');
	delete_option('norilskadm_orderby');
	delete_option('norilskadm_displayauthors');
	delete_option('norilskadm_displayrss');
	delete_option('norilskadm_display_plugin');
	delete_option('norilskadm_monitorplugin');
	delete_option('norilskadm_footertext');
	delete_option('norilskadm_gauser');
	delete_option('norilskadm_gaprofile');
	delete_option('norilskadm_gapass');
	delete_option('norilskadm_title');
	if ((get_option('norilskadm_title') != "") or (get_option('norilskadm_articlesno') != "") or (get_option('norilskadm_orderby') != "") or (get_option('norilskadm_displayauthors') != "") or (get_option('norilskadm_displayrss') != "") or (get_option('norilskadm_display_plugin') != "") or (get_option('norilskadm_monitorplugin') != "") or (get_option('norilskadm_footertext') != "") or (get_option('norilskadm_gauser') != "") or (get_option('norilskadm_gaprofile') != "") or (get_option('norilskadm_gapass') != "")) { echo "<strong style='color:red;'>Something went wrong...</strong><br><br><a href='plugins.php'>go back and try again</a>"; die; } else { echo "<strong style='color:green;'>DONE...</strong>"; } ; 	
	echo " <strong>DONE</strong><br />";
	
?>
<?php
?>
</body>
</html>