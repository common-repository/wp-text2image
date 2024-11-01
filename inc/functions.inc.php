<?
####################################################################
global $wpdb;
global $wp_t2i_db_version;
$table_name = $wpdb->prefix . "text2image";
if ($_POST['func'] == __('Insert', 'text2image') 
	&& $_POST['nome']!='' && $_POST['width_b']!='' && $_POST['height_b']!=''
	&& $_POST['bkg']!='' && $_POST['frg']!='' && $_POST['text']!='' && $_POST['nf']!='' && $_POST['theight']!='' && $_POST['left_tx']!='' && $_POST['top_tx']!='') {
	insert();
} elseif ($_POST['func'] == __('Update', 'text2image') 
	&& $_POST['nome']!='' && $_POST['width_b']!='' && $_POST['height_b']!=''
	&& $_POST['bkg']!='' && $_POST['frg']!='' && $_POST['text']!='' && $_POST['nf']!='' && $_POST['theight']!='' && $_POST['left_tx']!='' && $_POST['top_tx']!='') {
	update();
} elseif ($_POST['func'] == 'Delete'){
		delete();
}
####################################################################
function insert(){	
	global $wpdb;
	global $wp_t2i_db_version;
	$table_name = $wpdb->prefix . "text2image";
	$confronto = $wpdb->get_var("SELECT COUNT(*) FROM $table_name where nome = '".$_POST['nome']."';");	
	if ($confronto == 0){
		$insert = "INSERT INTO " . $table_name .
		" (nome, width, height, background, foreground, testo, nomefont, theight, left_tx, top_tx, tr) " .
		"VALUES ('".$_POST['nome']."',".$_POST['width_b'].",".$_POST['height_b'].",'".
		$_POST['bkg']."','".$_POST['frg']."','".$_POST['text']."','".$_POST['nf']."',".$_POST['theight'].",".$_POST['left_tx'].",".$_POST['top_tx'].",'".$_POST['tr']."')";
		$results = $wpdb->query( $insert );
		add_option("wp_t2i_db_version", $wp_t2i_db_version);
	} else { print 'errore esiste';}
}
####################################################################
function update(){	
	global $wpdb;
	global $wp_t2i_db_version;
	$table_name = $wpdb->prefix . "text2image";
	$insert = "UPDATE " . $table_name .
	" SET nome='".$_POST['nome']."', width=".$_POST['width_b'].", height=".$_POST['height_b'].", background='".$_POST['bkg']."',". 
	"foreground='".$_POST['frg']."', testo='".$_POST['text']."', nomefont='".$_POST['nf']."', theight=".$_POST['theight'].",".
	" left_tx=".$_POST['left_tx'].", top_tx=".$_POST['top_tx'].", tr='".$_POST['tr']."' " .
	" where id=".$_POST['id_t2i'].";";
	$results = $wpdb->query( $insert );
	add_option("wp_t2i_db_version", $wp_t2i_db_version);
}
####################################################################
function delete(){
	global $wpdb;
	global $wp_t2i_db_version;
	$table_name = $wpdb->prefix . "text2image";
	$insert = "DELETE FROM ".$table_name." WHERE id=".$_POST['id_t2i'].";" ;
	$results = $wpdb->query( $insert );
	add_option("wp_t2i_db_version", $wp_t2i_db_version);
}
####################################################################
function stringa($la_stringa){
	$stringa = str_replace("\'", "´", $la_stringa);
	return $stringa;
}
####################################################################
?>