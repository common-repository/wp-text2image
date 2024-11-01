<?
function show_preview(){
	$nome		 = stringa($_POST['nome']);
	$id_t2i		 = $_POST['id_t2i'];
	$width_b	 = $_POST['width_b'];
	$height_b	 = $_POST['height_b'];
	$nf			 = stringa($_POST['nf']);
	$tr			 = $_POST['tr'];
	$bkg		 = $_POST['bkg'];
	$frg		 = $_POST['frg'];
	$height_b	 = $_POST['height_b'];
	$theight	 = $_POST['theight']; 
	$left_tx	 = $_POST['left_tx'];
	$top_tx		 = $_POST['top_tx'];
	$text		 = stringa($_POST['text']);
	$action		 = $_POST['action'];
	
	if ($id_t2i==1){
		$t2i_script = __('Replace &#60;&#63; the_title(); &#63;&#62; into the pages of your theme with this script:', 'text2image').'<br><br><strong>&#60;&#63; t2i('.$id_t2i.'); &#63;&#62;</strong>';
	} else {
		$t2i_script = __('Insert this script into your pages or posts (VERY IMPORTANT: EXEC-PHP must installed and active):', 'text2image').'<br><br><strong>&#60;&#63; t2i('.$id_t2i.'); &#63;&#62;</strong>';
	}	
	$testing = 'bkg='.$bkg.'&frg='.$frg;
	$testing.= '&w='.$width_b.'&h='.$height_b.'&nf='.$nf;
	$testing.= '&th='.$theight.'&ltx='.$left_tx.'&ttx='.$top_tx.'&tr='.$tr.'&text='.$text;
?>
<div class="wrap">	
	<h2><? echo __('Text 2 Image - Preview', 'text2image') ?></h2>
	<? men_right(); ?>
	<div style="width:770px;position:relative;float:left;margin:10px 0 10px 0;">
		<form id="form" method="post" style="margin:0px">

			<table class="widefat">
				<tr class="alternate" valign="top">
					<td>
						<div id='t2i-b-image' style='margin:20px;width:<? echo $width_b; ?>px;height:<? echo $height_b; ?>px;background-image:url(<? echo T2I_SITEPATH; ?>/images/bg.jpg); '>
							<img src='<? echo T2I_SITEPATH; ?>/image.php?<? echo $testing; ?>' />
						</div>
					</td>
				</tr>
				<tr class="alternate" valign="top">
					<td>
						<div id='t2i-script' style='margin:20px;' >
							<? echo $t2i_script; ?>
						</div>
					</td>
				</tr>
				<tr class="alternate" valign="top">
					<input type="hidden" value="<? echo $nome; ?>" name="nome" />
					<input type="hidden" value="<? echo $id_t2i; ?>" name="id_t2i" />
					<input type="hidden" value="<? echo $width_b; ?>" name="width_b" />
					<input type="hidden" value="<? echo $height_b; ?>" name="height_b" />
					<input type="hidden" value="<? echo $tr; ?>" name="tr">
					<input type="hidden" value="<? echo $bkg; ?>" name="bkg" />
					<input type="hidden" value="<? echo $frg; ?>" name="frg" />
					<input type="hidden" value="<? echo $nf; ?>" name="nf">			
					<input type="hidden" value="<? echo $theight; ?>" name="theight" />
					<input type="hidden" value="<? echo $left_tx; ?>" name="left_tx" />
					<input type="hidden" value="<? echo $top_tx; ?>" name="top_tx" />
					<input type="hidden" value="<? echo $text; ?>" name="text" />
					<input type="hidden" value="<? echo $action; ?>" name="action" />
					<div id='back-image'>
					<td>
						<input type="submit" name="func" value="<? echo __('Back', 'text2image'); ?>" class="button" />				
						<input type="submit" name="func" value="<? echo $_POST['action'];?>" class="button" />	
					</td>
			</table>
		</form>
	</div>
</div>
<? } ?>