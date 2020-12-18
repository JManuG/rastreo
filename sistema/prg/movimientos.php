<?php
class movimientos
{

public function consulta_qr($ref,$gui)
{
?>
<table align="center" width="1024" border="0" cellspacing="0" cellpadding="1" bgcolor='white' bordercolor='#C0C0C0'>

<tr>
	<td align="left" valign="top"  bgcolor='#231F20'><p align="left" class="textogris1">Bienvenido a la secci&oacute;n de Consulta de Detalles de Entrega.<br />
			<span class="textogris_bold">Click en Consultar para ver el estado de su env&iacute;o </span></p>
		<table width="100%" border="0" cellspacing="0" cellpadding="1">
			<tr>
				<td align="center"><table width="100%" border="0" cellpadding="1" cellspacing="1" >
				<tr>
				<td width="30%" align="center" bgcolor='white' height='135'>
				<form id='formulario' method="post" name="tt">
				<table width="100%" border="0" cellspacing="0" cellpadding="5" >
				<tr>
				<td align="left" valign="top" class="textogris_bold2"></td>
				<td colspan="2" align="left" valign="top" class="textogris_bold">
				<table cellspacing="1" bgcolor="#CCCCCC" cellpadding="2">
				<tr bgcolor="#FFFFFF">
					<td class="textogris_bold">Referencia :</td>
				<td><input name="ref" type="text" id="ref" value="<?php echo $ref; ?>" class='input' readonly='true' size='12'/></td>
				</tr>
				<tr bgcolor="#FFFFFF">
					<td class="textogris_bold">Guia :</td>
					<td><input name="gui" type="text" id="gui" value="<?php echo $gui; ?>" class='input' readonly='true' size='12'/></td>
				</tr>
				<tr bgcolor="#FFFFFF">
					<td colspan="2" align="center"><input type="button" value='Consultar' class='boton_submit' id='consultar' onClick="xajax_mov(xajax.getFormValues('formulario'))" height="16" id="Image1" border="0"/>
										</a></td>
								</tr>
							</table>										</td>
					</table>
				</form>
				
				
 			</td><td bgcolor='white'>
				<div id='detalle_envio'>
				<a class='textorojo_bold'>Saber llegar es encontrar la solucion justa, para cada uno de tus env&iacute;os.</br></a>
				<a class='textogris2'>Apoyese en urbano y su amplia red de distribuci&oacute;n, acostumbrada a manejar eficazmente los desaf&iacute;os log&iacute;sticos m&aacute;s complejos.</a>
				</div>
				</td>
			</tr>
			<tr>
				<td colspan='2' bgcolor='F1F1F1'>
					
					<table border='0' cellpadding="1" width='100%' bgcolor='#ffffff' >
						<tr>
							<td height='400' bgcolor='#ffffff'>
								
								<div id='div_mov'>
									<img src='track/sistema/vista/imgs/smile.png' >
									</div>
									
									
									<!--<div id="map" style="width: 470px; height: 370px"></div>-->
								</td>
							</tr>
						</table>
						
						
					</td>
				</tr><tr>
					<td height='500' cellpadding="1" width='100%' bgcolor='#808080' valign='top' colspan='2' >
<div id='img'>
</div>


</td></tr>
</table>
<?php
}


public function consulta_qr2($gui)
{
?>
<table align="center" width="100%" border="1" cellspacing="0" cellpadding="0" bgcolor='#231F20' bordercolor='#6F7073'>

<tr>
	<td align="left" valign="top"  bgcolor='#231F20' ><p align="left" class="Texblanco_Bold22">Bienvenido a la secci&oacute;n de Consulta de Detalles de Entrega.<br />
			<span class="Texblanco_Bold">Click en Consultar para ver el estado de su env&iacute;o </span></p>
		<table width="100%" border="0" cellspacing="0" cellpadding="1">
			<tr>
				<td align="center"><table width="100%" border="0" cellpadding="1" cellspacing="1" >
				<tr>
				<td width="30%" align="center" bgcolor='white' height='135'>
				<form id='formulario' method="post" name="tt">
				<table width="100%" border="0" cellspacing="0" cellpadding="5" >
				<tr>
				<td align="left" valign="top" class="textogris_bold2"></td>
				<td colspan="2" align="left" valign="top" class="textogris_bold">
				<table cellspacing="1" bgcolor="#CCCCCC" cellpadding="2">
				<tr bgcolor="#FFFFFF">
					<td class="textogris_bold">Guia :</td>
					<td><input name="gui" type="text" id="gui" value="<?php echo $gui; ?>" class='input' readonly='true' size='12'/></td>
				</tr>
				<tr bgcolor="#FFFFFF">
					<td colspan="2" align="center"><input type="button" value='Consultar' class='boton_submit' id='consultar' onClick="xajax_mov2(xajax.getFormValues('formulario'))" height="16" id="Image1" border="0"/>
										</a></td>
								</tr>
							</table>										</td>
					</table>
				</form>
				
				
 			</td><td bgcolor='white'>
				<div id='detalle_envio'>
				<a class='textorojo_bold'>Saber llegar es encontrar la solucion justa, para cada uno de tus env&iacute;os.</br></a>
				<a class='textogris2'>Apoyese en urbano y su amplia red de distribuci&oacute;n, acostumbrada a manejar eficazmente los desaf&iacute;os log&iacute;sticos m&aacute;s complejos.</a>
				</div>
				</td>
			</tr>
			<tr>
				<td colspan='2' bgcolor='F1F1F1'>
					
					<table border='0' cellpadding="1" width='100%' bgcolor='#ffffff' >
						<tr>
							<td height='400' bgcolor='#ffffff'>
								
								<div id='div_mov'>
									<img src='track/sistema/vista/imgs/smile.png' >
									</div>
									
									
									<!--<div id="map" style="width: 470px; height: 370px"></div>-->
								</td>
							</tr>
						</table>
						
						
					</td>
				</tr><tr>
					<td height='500' cellpadding="1" width='100%' bgcolor='#6f7073' valign='top' colspan='2' >
<div id='img'>
</div>


</td></tr>
</table>
<?php
}












public function consulta_cli($ref,$gui)
{
?>

<table align="center" width="1024" border="0" cellspacing="0" cellpadding="1" bgcolor='white' bordercolor='#C0C0C0'>
	
	<tr>
		<td align="left" valign="top"  bgcolor='#F1F1F1'><p align="left" class="textogris1">Bienvenido a la secci&oacute;n de Consulta de Detalles de Entrega.<br />
				<span class="textogris_bold">Click en Consultar para ver el estado de su env&iacute;o </span></p>
		<table width="100%" border="0" cellspacing="0" cellpadding="1">
		<tr>
			<td align="center"><table width="100%" border="0" cellpadding="1" cellspacing="1" >
			<tr>
			<td width="30%" align="center" bgcolor='white' height='135'>
			<form id='formulario' method="post" name="tt">
			<table width="100%" border="0" cellspacing="0" cellpadding="5" >
			<tr>
			<td align="left" valign="top" class="textogris_bold2"></td>
			<td colspan="2" align="left" valign="top" class="textogris_bold">
			<table cellspacing="1" bgcolor="#CCCCCC" cellpadding="2">
			<tr bgcolor="#FFFFFF">
			<td class="textogris_bold">Referencia :</td>
			<td><input name="ref" type="text" id="ref" value="<?php echo $ref; ?>" class='input' readonly='true' size='12'/></td>
			</tr>
			<tr bgcolor="#FFFFFF">
			<td class="textogris_bold">Guia :</td>
			<td><input name="gui" type="text" id="gui" value="<?php echo $gui; ?>" class='input' readonly='true' size='12'/>
			<input name="pre" type="hidden" id="pre" value="1" class='input' readonly='true' size='12'/>
			</td>
			</tr>
			<tr bgcolor="#FFFFFF">
			<td colspan="2" align="center"><div id='boton' class='boton_submit' onClick="xajax_mov(xajax.getFormValues('formulario'))">Consultar</div>
			</a></td>
			</tr>
			</table></td>
			</table>
			</form>
			</td><td bgcolor='white'>
			<div id='detalle_envio'>
			<a class='textorojo_bold'>Saber llegar es encontrar la solucion justa, para cada uno de tus env&iacute;os.</br></a>
			<a class='textogris2'>Apoyese en urbano y su amplia red de distribuci&oacute;n, acostumbrada a manejar eficazmente los desaf&iacute;os log&iacute;sticos m&aacute;s complejos.</a>
			</div>
		</td>
	</tr>
	<tr>
		<td colspan='2' bgcolor='F1F1F1'>
			
			<table border='0' cellpadding="1" width='100%' bgcolor='#ffffff' >
				<tr>
					<td height='400' bgcolor='#ffffff'>
						
						<div id='div_mov'>
							<img src='vista/imgs/smile.png' >
							</div>
							
							
							<!--<div id="map" style="width: 470px; height: 370px"></div>-->
						</td>
					</tr>
				</table>
				
				
			</td>
		</tr><tr>
			<td height='500' cellpadding="1" width='100%' bgcolor='#808080' valign='top' colspan='2' >
				<div id='img'>
				</div>
				
				
			</td></tr>
	</table>

<?php

}
}
?>