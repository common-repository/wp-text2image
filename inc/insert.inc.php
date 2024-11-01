<?php
function show_insert(){
	global $wpdb;
	global $wp_t2i_db_version;
	$table_name = $wpdb->prefix . "text2image";
	$fil_font = scandir(ABSPATH.'/wp-content/plugins/'.TEXT2IMAGE.'/fonts',0);
	if ($_POST['id_t2i']){
		$id_t2i = $_POST['id_t2i'];
	}else{
		$id_t2i = $_GET['id_t2i'];
	}
	
	if($_POST['func']==__('New', 'text2image')){		
		if($_POST['nome'])		{ $nome = $_POST['nome']; } 			else 	{ $nome =  __('Write the name', 'text2image');}
		if($_POST['width_b'])	{ $width_b = $_POST['width_b']; } 		else 	{ $width_b = '100';}
		if($_POST['height_b'])	{ $height_b = $_POST['height_b'];} 		else 	{ $height_b = '40';}
		if($_POST['bkg'])		{ $bkg = strtolower($_POST['bkg']);}	else	{ $bkg = '000000';}
		if($_POST['frg'])		{ $frg = strtolower($_POST['frg']); }	else	{ $frg = 'ffffff';}
		if($_POST['theight'])	{ $theight = $_POST['theight']; }		else	{ $theight = '14';}
		if($_POST['left_tx'])	{ $left_tx = $_POST['left_tx']; }		else	{ $left_tx = '2';}
		if($_POST['top_tx'])	{ $top_tx = $_POST['top_tx']; }			else	{ $top_tx = '25';}
		if($_POST['text'])		{ $text = $_POST['text']; }				else	{ $text = 'test';}
		if($_POST['nf'])		{ $nf = $_POST['nf']; }					else	{ $nf = $fil_font[2];}
		if($_POST['tr'])		{ $tr = $_POST['tr']; }					else	{ $tr= 'no';}
		if(!$_POST['action']){$action = __('Insert', 'text2image');}else{$action = $_POST['action'];};
	}elseif($_POST['func']==__('Back', 'text2image')){
		$nome = $_POST['nome'];
		$width_b = $_POST['width_b'];
		$height_b = $_POST['height_b'];
		$bkg = strtolower($_POST['bkg']);
		$frg = strtolower($_POST['frg']);
		$theight = $_POST['theight'];
		$left_tx = $_POST['left_tx'];
		$top_tx = $_POST['top_tx'];
		$text = $_POST['text'];
		$nf = $_POST['nf'];
		$tr = $_POST['tr'];
		if(!$_POST['action']){$action = __('Insert', 'text2image');}else{$action = $_POST['action'];};
	}else{
		$selezione = 	"FROM $table_name where id='".$_POST['func']."';";
		$id_t2i = 		$wpdb->get_var("SELECT id ".$selezione);
		$nome = 		$wpdb->get_var("SELECT nome ".$selezione);
		$width_b = 		$wpdb->get_var("SELECT width ".$selezione);
		$height_b = 	$wpdb->get_var("SELECT height ".$selezione);
		$bkg = 			$wpdb->get_var("SELECT background ".$selezione);
		$frg = 			$wpdb->get_var("SELECT foreground ".$selezione);
		$theight = 		$wpdb->get_var("SELECT theight ".$selezione);
		$left_tx = 		$wpdb->get_var("SELECT left_tx ".$selezione);
		$top_tx = 		$wpdb->get_var("SELECT top_tx ".$selezione);
		$text = 		$wpdb->get_var("SELECT testo ".$selezione);
		$nf = 			$wpdb->get_var("SELECT nomefont ".$selezione);
		$tr = 			$wpdb->get_var("SELECT tr ".$selezione);
		$action = 		__('Update', 'text2image');
	}
####################################################################
?>
<div class="wrap">	
	<h2><? echo 'Text 2 Image - '.$action;  ?></h2>
	<? men_right(); ?>
	<div style="width:770px;position:relative;float:left;margin:10px 0 10px 0;">
	<form id="form" method="post" style="margin:0px">
		<table class="widefat">
			<tr class="alternate" valign="top">
				<th scope="row"><label for="nome"><? echo __('Name:', 'text2image') ?></label></th>
				<td>
					<? if($nome!='__title__'){ ?>
					<input type="text" value="<? echo $nome; ?>" name="nome" id="" />
					<? } else { ?>
					<input type="text" value="<? echo $nome; ?>" name="nome2" disabled id="" />
					<input type="hidden" value="<? echo $nome; ?>" name="nome" />
					<? } ?>
				</td>
				<input type="hidden" value="<? echo $id_t2i; ?>" name="id_t2i" />
			</tr>
			<tr class="alternate" valign="top">
				<th scope="row"><? echo __('Block:', 'text2image') ?></th>
				<td>
				
					<p>						
						<label for="width_b"><? echo __('Width (1):', 'text2image') ?></label>
						<input type="text" value="<? echo $width_b; ?>" name="width_b" size="2" />
						<label for="height_b"><? echo __('Height (2):', 'text2image') ?></label>
						<input type="text" value="<? echo $height_b; ?>" name="height_b" size="2" />
					</p>
					<p>
						<label for="tr"><? echo __('Trasparent:', 'text2image') ?></label>
						<select name="tr">
							<option value="0" <? if ($tr == "0") {print 'selected';} ?> >no</option>;
							<option value="1" <? if ($tr == '1') {print 'selected';} ?> >si</option>;
						</select>
					</p>
					<p>
						<label for="bkg"><? echo __('Background Color:', 'text2image') ?></label>
						<input type="text" value="<? echo $bkg; ?>" name="bkg" size="5" />
						<label for="frg"><? echo __('Text color:', 'text2image') ?></label>
						<input type="text" value="<? echo $frg; ?>" name="frg" size="5" />
					</p>
				</td>
			</tr>
			<tr class="alternate" valign="top">
				<th scope="row"><label for="nf"><? echo __('Font:', 'text2image') ?></label></th>
				<td>
					<p>
			<?
			print '<select name="nf">';
			$i= 0;
			while ($i<=count($fil_font)) { 
				if ($fil_font[$i]!= '.' && $fil_font[$i]!= '..' && $fil_font[$i]!= '' && $fil_font[$i]!= '.DS_Store') {
					print '
					<option value="'.$fil_font[$i].'" ';
					if ($fil_font[$i] == $nf) {print 'selected';}
					print '>'.$fil_font[$i].'</option>';
				}
				$i++;
			}
			print '
			</select>';
			?>
					</p>
					<p>
						<label for="theight"><? echo __('Text Height:', 'text2image') ?></label>
						<input type="text" value="<? echo $theight; ?>" name="theight" size="2" />
					</p>
					<p>
						<label for="left_tx"><? echo __('Left margin (3):', 'text2image') ?></label>
						<input type="text" value="<? echo $left_tx; ?>" name="left_tx" size="2" />
						<label for="top_tx"><? echo __('Top margin (4):', 'text2image') ?></label>
						<input type="text" value="<? echo $top_tx; ?>" name="top_tx" size="2" />
					</p>
				</td>
			</tr>
			<tr class="alternate" valign="top">
				<th scope="row"><label for="text"><? echo __("Example's test:", 'text2image') ?></label></th>
				<td><input type="text" value="<? echo $text; ?>" name="text" id="" /></td>
			</tr>
			<tr class="alternate" valign="top">
				<th scope="row"></th>
				<td>
					<input type="hidden" value="<? echo $action; ?>" name="action" />
					<? if($_POST['func']==__('Update', 'text2image') && $_POST['id_t2i']!=1){ ?>
					<input type="submit" name="func" value="<? echo __('Delete', 'text2image'); ?>" class="button" />
					<? } ?>
					<input type="submit" name="func" value="<? echo __('Preview', 'text2image'); ?>" class="button" />
				</td>
			</tr>
		</table>
	</form>
	</div>
</div>
<? } ?>