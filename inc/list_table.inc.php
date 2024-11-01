<?php
function show_list(){

global $wpdb;
global $wp_t2i_db_version;
$table_name = $wpdb->prefix . "text2image";
$result = $wpdb->get_results("SELECT * FROM $table_name ORDER BY nome;",ARRAY_A);
if(is_array($result)) { 
echo '
<div class="wrap">	
	<h2>'.__("Text 2 Image - List", 'text2image').'</h2>';
	men_right();	
echo '
	<div style="width:770px;position:relative;float:left;margin:10px 0 10px 0;">
	<form id="form" method="post" style="margin:0px">
	<input type="hidden" value="" name="nome" />
	<table class="widefat">
		<thead>
			<tr>
				<th scope="col"><input type="submit" name="func" value="'.__("New", 'text2image').'" class="button" /></th>				
				<th scope="col">'.__('ID', 'text2image').'</th>
				<th scope="col">'.__('Name', 'text2image').'</th>
				<th scope="col">'.__('Dimension', 'text2image').'</th>
				<th scope="col">'.__('Font', 'text2image').'</th>
			</tr>
		</thead>
		<tbody>';
	foreach ($result as $m) { 
		print'
			<tr class="alternate" valign="top">';
		foreach ($m as $k => $v) { 
			$array[$m['id']][$k] = $v;
		}
		if ($array[$m['id']]['width'] > 300) { $wid = 300; } else { $wid = $array[$m['id']]['width'];}
		if ($array[$m['id']]['height'] > 150) { $heg = 150; } else { $heg = $array[$m['id']]['height'];}
		$dimostration = 'bkg='.$array[$m['id']]['background'].'&frg='.$array[$m['id']]['foreground'];
		$dimostration.= '&w='.$wid.'&h='.$heg.'&nf='.$array[$m['id']]['nomefont'];
		$dimostration.= '&th='.$array[$m['id']]['theight'].'&ltx='.$array[$m['id']]['left_tx'].'&ttx='.$array[$m['id']]['top_tx'].'&tr='.$array[$m['id']]['tr'].'&text='.$array[$m['id']]['testo'];
		if ($array[$m['id']]['tr']==1){		
		print '				
				<td>
					<div id="t2i-b-image" style="width:'.$wid.'px;height:'.$heg.'px;background-image:url('.T2I_SITEPATH.'/images/bg.jpg);margin:0px;padding:0px;">
						<input type="image" name="func" value="'.$array[$m['id']]['id'].'" src="'.T2I_SITEPATH.'/image.php?'.$dimostration.'">
					</div>
				</td>';
		} else {
		print '	
				<td>
						<input type="image" name="func" value="'.$array[$m['id']]['id'].'" src="'.T2I_SITEPATH.'/image.php?'.$dimostration.'">
				</td>';
		} 
		print '
				<td>
					<p>'.$array[$m['id']]['id'].'</p>
				</td>
				<td>
					<p>'.$array[$m['id']]['nome'].'</p>
				</td>
				<td>
					<p>'.$array[$m['id']]['width'].'px/'.$array[$m['id']]['height'].'px</p>
				</td>
				<td>
					<p>'.$array[$m['id']]['nomefont'].'</p>
				</td>
			';
	}
	print'
			</tr>
		</tbody>';
}
print'
	</table>
	</form>
	</div>
</div>';
}
?>