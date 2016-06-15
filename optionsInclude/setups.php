<?$JSDir = "/bitrix/js/".$module_id;?>
<?//$GLOBALS["APPLICATION"]->AddHeadScript($prot."://sdk.ddelivery.ru/assets/js/ddelivery_v2.js");?>

<style>
	.PropHint { 
		background: url("/bitrix/images/ddelivery.ddelivery2/hint.gif") no-repeat transparent;
		display: inline-block;
		height: 12px;
		position: relative;
		width: 12px;
	}
	.b-popup { 
		background-color: #FEFEFE;
		border: 1px solid #9A9B9B;
		box-shadow: 0px 0px 10px #B9B9B9;
		display: none;
		font-size: 12px;
		padding: 19px 13px 15px;
		position: absolute;
		top: 38px;
		width: 300px;
		z-index: 50;
	}
	.b-popup .pop-text { 
		margin-bottom: 10px;
		color:#000;
	}
	.pop-text i {color:#AC12B1;}
	.b-popup .close { 
		background: url("/bitrix/images/ddelivery.ddelivery2/popup_close.gif") no-repeat transparent;
		cursor: pointer;
		height: 10px;
		position: absolute;
		right: 4px;
		top: 4px;
		width: 10px;
	}
	.ddeliveryddelivery_clz{
		background:url(/bitrix/panel/main/images/bx-admin-sprite-small.png) 0px -2989px no-repeat; 
		width:18px; 
		height:18px;
		cursor: pointer;
		margin-left:100%;
	}
	.ddeliveryddelivery_clz:hover{
		background-position: -0px -3016px;
	}
	.errorText{
		color:red;
		font-size:11px;
	}
	.ddeliveryddelivery_getAccessToken_block{
		align: center;
	}
</style>
<script>	
	function ddelivery_popup_virt(code, info){
		var offset = $(info).position().top;
		var LEFT = $(info).offset().left;		
		
		var obj;
		if(code == 'next') 	obj = $(info).next();
		else  				obj = $('#'+code);
		
		LEFT -= parseInt( parseInt(obj.css('width'))/2 );
		
		obj.css({
			top: (offset+15)+'px',
			left: LEFT,
			display: 'block'
		});	
		return false;
	}
	
	function ddeliveryddelivery_serverShow(){
		$('.ddeliveryddelivery_service').each(function(){
			$(this).css('display','table-row');
		});
		$('[onclick^="ddeliveryddelivery_serverShow("]').css('cursor','auto');
		$('[onclick^="ddeliveryddelivery_serverShow("]').css('textDecoration','none');
	}
	
	function ddeliveryddelivery_clearCache(){
		$.post(
			"/bitrix/js/<?=$module_id?>/ajaxSDK.php",
			{'action':'clearCache'},
			function(data){
				alert("<?=GetMessage('ddeliveryddelivery_LBL_CACHEKILLED')?>")
			}
		);
	}
	
	function ddeliveryddelivery_getAccessToken()
	{
		var iframe = $("#ddeliveryddelivery_getAccessToken");
		
		// console.log(iframe);
		iframe.attr("src", "<?=$JSDir?>/ajaxSDK.php?action=admin");
		iframe.load(function(){
			iframe.css("width", "100%");
			iframe.css("height", "600px");
			iframe.css("display", "block");
		});
	}
	
	function ddeliveryddelivery_addConvertedDelivery()
	{
		var params = {
			"action": "AddProfilesList",
		};
		
		$.ajax({
			url:'/bitrix/js/<?=$module_id?>/ajaxSDK.php',
			data:params,
			type:"POST",
			dataType: "json",
			error: function(XMLHttpRequest, textStatus){
				console.log(XMLHttpRequest);
				console.log(textStatus);
			},
			success: function(data){
				if (typeof data == "undefined")
				{
					alert('<?=GetMessage("ddeliveryddelivery_NOT_CRTD_UNKNOWN_ERROR")?>');
					return;
				}
				
				if (data.is_error)
					alert(data.error);
				else 
				{
					alert('<?=GetMessage("ddeliveryddelivery_NOT_CRTD_SUCCESS")?>');
					window.location.reload();
				}
				return;
			}
		});
	}
	
</script>

<tr><td colspan = "2" id = "ddeliveryddelivery_getAccessToken_block" align = "center">
<input type = "button" onClick = "ddeliveryddelivery_getAccessToken();" value = "<?=GetMessage("ddeliveryddelivery_OPT_GET_ACCESS_TOKEN")?>" id = "ddeliveryddelivery_getAccessToken_button">
<br>
<iframe style = "display:none;" id = "ddeliveryddelivery_getAccessToken"></iframe>
</td></tr>

<?
foreach(array("depature","prntActOrdr","numberOfPrints","showInOrders","orderProps","address","pvzID","pvzPicker","hideNal","autoSelOne","cntExpress","AS","statusSTORE","statusTRANZT","statusCORIER","tarifs","dostTimeout","TURNOFF","TARSHOW") as $code){?>
<div id="pop-<?=$code?>" class="b-popup" style="display: none; ">
	<div class="pop-text"><?=GetMessage("ddeliveryddelivery_HELPER_".$code)?></div>
	<div class="close" onclick="$(this).closest('.b-popup').hide();"></div>
</div>
<?}
if(file_exists($_SERVER["DOCUMENT_ROOT"]."/bitrix/js/".$module_id."/errorLog.php")){
	$errorStr=file_get_contents($_SERVER["DOCUMENT_ROOT"]."/bitrix/js/".$module_id."/errorLog.php");
	if(strlen($errorStr)>0){?>
		<tr id='ddeliveryddelivery_updtPlc'><td colspan='2'>
			<div class="adm-info-message-wrap adm-info-message-red">
			  <div class="adm-info-message">
				<div class="adm-info-message-title"><?=GetMessage('ddeliveryddelivery_FNDD_ERR_HEADER')?></div>
					<?=GetMessage('ddeliveryddelivery_FNDD_ERR_TITLE')?>
				<div class="adm-info-message-icon"></div>
			  </div>
			</div>
		</td></tr>
	<?}
}
/*
if(file_exists($_SERVER["DOCUMENT_ROOT"]."/bitrix/js/".$module_id."/hint.txt")){
	$updateStr=file_get_contents($_SERVER["DOCUMENT_ROOT"]."/bitrix/js/".$module_id."/hint.txt");
	if(strlen($updateStr)>0){?>
		<tr id='ddeliveryddelivery_updtPlc'><td colspan='2'>
			<div class="adm-info-message-wrap">
				<div class="adm-info-message" style='color: #000000'>
					<div class='ddeliveryddelivery_clz' onclick='ddeliveryddelivery_clrUpdt()'></div>
					<?=$updateStr?>
				</div>
			</div>
		</td></tr>
	<?}
}*/

// $dost = CSaleDeliveryHandler::GetBySID('ddelivery');
$dost = ddeliveryHelper::getDelivery();
// if($dost=$dost->Fetch()){
if($dost){
	if($dost['ACTIVE'] != 'Y'){?>
	<tr><td colspan='2'>
		<div class="adm-info-message-wrap adm-info-message-red">
		  <div class="adm-info-message">
			<div class="adm-info-message-title"><?=GetMessage('ddeliveryddelivery_NO_ADOST_HEADER')?></div>
				<?=GetMessage('ddeliveryddelivery_NO_ADOST_TITLE')?>
			<div class="adm-info-message-icon"></div>
		  </div>
		</div>
	</td></tr>
	<?}
}else{?>
	<tr><td colspan='2'>
		<div class="adm-info-message-wrap adm-info-message-red">
		  <div class="adm-info-message">
			<?if($converted){?>
			<div class="adm-info-message-title"><?=GetMessage('ddeliveryddelivery_NOT_CRTD_HEADER')?></div>
					<?=GetMessage('ddeliveryddelivery_NOT_CRTD_TITLE')?>	
		  <?}else{?>
			<div class="adm-info-message-title"><?=GetMessage('ddeliveryddelivery_NO_DOST_HEADER')?></div>
				<?=GetMessage('ddeliveryddelivery_NO_DOST_TITLE')?>
		  <?}?>
			<div class="adm-info-message-icon"></div>
		  </div>
		</div>
	</td></tr>
	
	<?if($converted){?>
		<tr><td>
			<input type="button" onclick="ddeliveryddelivery_addConvertedDelivery()" value="<?=GetMessage("ddeliveryddelivery_NOT_CRTD_TITLE_BUTTON")?>">
		</td></tr>
	<?}?>
<?}?>


<?ShowParamsHTMLByArray($arAllOptions["logData"]);?>

<?//Ћбщие?>
<tr class="heading"><td colspan="2" valign="top" align="center"><?=GetMessage("ddeliveryddelivery_HDR_common")?></td></tr>
<?ShowParamsHTMLByArray($arAllOptions["common"]);?>
<tr><td colspan="2" ><span><?=GetMessage("ddeliveryddelivery_LABEL_GOODPARAMS")?></span></td></tr>
<?//‘войства заказа?>
<tr class="heading">
	<td colspan="2" valign="top" align="center"><?=GetMessage('ddeliveryddelivery_HDR_orderProps')?></td>
</tr>
<?showOrderOptions();?>
<tr><td style="color:#555; " colspan="2" >
	<a class="moduleHeader" onclick="$(this).next().toggle(); return false;"><?=GetMessage('MLSP_ADDPROPS_TITLE')?></a>
	<div class="moduleInst" ><?=GetMessage('MLSP_ADDPROPS_DESCR')?></div>					
</td></tr>
	
<?//Ћформление заказа?>
<tr class="heading"><td colspan="2" valign="top" align="center"><?=GetMessage("ddeliveryddelivery_HDR_basket")?></td></tr>
<?ShowParamsHTMLByArray($arAllOptions["basket"]);?>

<tr><td colspan="2"><?=GetMessage("ddeliveryddelivery_FAQ_DELIVERY")?></td></tr>

