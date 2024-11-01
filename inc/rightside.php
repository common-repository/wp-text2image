<?
function men_right(){
	$paypal='
	<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="encrypted" value="-----BEGIN PKCS7-----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-----END PKCS7-----
">
<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_donateCC_LG_global.gif" border="0" name="submit" alt="">
<img alt="" border="0" src="https://www.paypal.com/it_IT/i/scr/pixel.gif" width="1" height="1">
</form>
';
	$commento='
';
	
	echo "
	<div style='background-color:blue;width:200px;height:100%;float:right;position:relative;margin:10px 0 10px 0;text-align:justify;'>
	<table class='widefat'>
		<tr class='alternate' valign='top'>
			<td align=center>
			<a href='http://text2image.webup.org' alt='Text2Image'>
				<img src='".T2I_SITEPATH."/images/logo.png' />
			</a>
			</td>
		</tr>
		<tr class='alternate' valign='top'>
			<td align=center>
			".$paypal."
			</td>
		</tr>
		<tr class='alternate' valign='top'>
			<td>
			".__(
"This plugin has the functionality to convert a string into an image.<br><br>If deemed valid this plugin please contribute a little tender the project. Thank you.", "text2image")."
			</td>
		</tr>		
	</table>
	</div>";
}
?>