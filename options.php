<?
#################################################
#        Company developer: ddelivery
#        Developers: Dmitry Kadrichev
#        Site: http://www.ddeliveryh.com
#        E-mail: om-sv2@mail.ru
#        Copyright (c) 2006-2014 ddelivery
#################################################
?>
<?
IncludeModuleLangFile(__FILE__);
IncludeModuleLangFile($_SERVER["DOCUMENT_ROOT"].BX_ROOT."/modules/main/options.php");

$module_id = "ddelivery.ddelivery2";
CModule::IncludeModule($module_id);
if(ddeliverydriver::$MODULE_ID !== $module_id)
	echo "ERROR IN MODULE ID";

CModule::IncludeModule('sale');
CJSCore::Init(array("jquery"));
// $isLogged=COption::GetOptionString($module_id,"logged",false); 
$converted = ddeliveryHelper::isConverted();

//определяем статусы заказов
$orderState=array(''=>'');
$tmpValue = CSaleStatus::GetList(array("SORT" => "ASC"), array("LID" => LANGUAGE_ID));
while($tmpVal=$tmpValue->Fetch()){
	if(!array_key_exists($tmpVal['ID'],$orderState))
		$orderState[$tmpVal['ID']]=$tmpVal['NAME']." [".$tmpVal['ID']."]";
}
//плательщики
// $tmpPayers=unserialize(COption::GetOptionString($module_id,'payers','a:0:{}'));
$payers=CSalePersonType::GetList(array('ACTIVE'=>'Y'));
$arPayers=array();
while($payer=$payers->Fetch()){
	$arPayers[$payer['ID']]=array('NAME'=>$payer['NAME']." [".$payer['LID']."]");
	// if(in_array($payer['ID'],$tmpPayers))
		$arPayers[$payer['ID']]['sel']=true;
}
//местоположения
$locProp = CSaleOrderProps::GetList(array(),array("IS_LOCATION"=>"Y"));
$locProps = array();
while($element=$locProp->Fetch())
	$locProps[$element['CODE']] = $element['NAME'];

$arAllOptions = array(
	"logData" => array(
		// array("logddelivery",GetMessage("ddeliveryddelivery_OPT_logddelivery"),false,array("text")),
		// array("pasddelivery",GetMessage("ddeliveryddelivery_OPT_pasddelivery"),false,array("password")),
		array("token", GetMessage("ddeliveryddelivery_OPT_API_KEY"), false,array('text')),// токен залогининого юзера
		array("testMode", GetMessage("ddeliveryddelivery_OPT_TEST_MODE"), "Y", array("checkbox")),// токен залогининого юзера
	),
	"common" => Array(
		array("addJQ",GetMessage("ddeliveryddelivery_OPT_addJQ"),"N",array("checkbox")),
		// array("departure",GetMessage("ddeliveryddelivery_OPT_depature"),'',array("text")),
		array("prntActOrdr",GetMessage("ddeliveryddelivery_OPT_prntActOrdr"),"O",array("selectbox"),		array(
				"O" => GetMessage('ddeliveryddelivery_OTHR_ACTSORDRS'),
				"A" => GetMessage('ddeliveryddelivery_OTHR_ACTSONLY')
			)
		),
		array("showInOrders",GetMessage("ddeliveryddelivery_OPT_showInOrders"),"Y",array("selectbox"),	
			array(
				"Y" => GetMessage('ddeliveryddelivery_OTHR_ALWAYS'),
				"N" => GetMessage('ddeliveryddelivery_OTHR_DELIVERY')
			)
		),
	),
	// "dimensionsDef" => array(//ѓабариты товаров (дефолтные)
		// Array("lengthD", GetMessage("ddeliveryddelivery_OPT_lengthD"), '10', Array("text")),
		// Array("widthD", GetMessage("ddeliveryddelivery_OPT_widthD"), '10', Array("text")),
		// Array("heightD", GetMessage("ddeliveryddelivery_OPT_heightD"), '10', Array("text")),
		// Array("weightD", GetMessage("ddeliveryddelivery_OPT_weightD"), '100', Array("text")),
		// Array("defMode", GetMessage("ddeliveryddelivery_OPT_defMode"), 'O', array("selectbox"), array('O'=>GetMessage("ddeliveryddelivery_LABEL_forOrder"),'G'=>GetMessage("ddeliveryddelivery_LABEL_forGood"))),
	// ),
	// "extendedOpt" => array(
		// Array("roundDP", GetMessage("ddeliveryddelivery_OPT_roundDeliveryPrice"), '0', Array("text")),
		// Array("assessedCost", GetMessage("ddeliveryddelivery_OPT_assessedCost"), '0', Array("text")),
	// ),
	// "status" => Array(
		// array("setDeliveryId", GetMessage("ddeliveryddelivery_OPT_setDeliveryId"),"Y",array("checkbox")),
		// array("markPayed", GetMessage("ddeliveryddelivery_OPT_markPayed"),"N",array("checkbox")),
		// array("statusSTORE", GetMessage("ddeliveryddelivery_OPT_statusSTORE"),false,array("selectbox"),$orderState),
		// array("statusTRANZT", GetMessage("ddeliveryddelivery_OPT_statusTRANZT"),false,array("selectbox"),$orderState),
		// array("statusCORIER", GetMessage("ddeliveryddelivery_OPT_statusCORIER"),false,array("selectbox"),$orderState),
		// array("statusPVZ", GetMessage("ddeliveryddelivery_OPT_statusPVZ"),false,array("selectbox"),$orderState),
		// array("statusDELIVD", GetMessage("ddeliveryddelivery_OPT_statusDELIVD"),false,array("selectbox"),$orderState),
		// array("statusOTKAZ", GetMessage("ddeliveryddelivery_OPT_statusOTKAZ"),false,array("selectbox"),$orderState),
	// ),
	/*"storeProps" => Array(// адрес магазина откуда отправляется заказ
		Array("Storestreet", GetMessage("ddeliveryddelivery_Storestreet"), '', Array("text")),
		Array("Storehouse", GetMessage("ddeliveryddelivery_Storehouse"), '', Array("text")),
		Array("Storeblock", GetMessage("ddeliveryddelivery_Storeblock"), '', Array("text")),
		Array("Storeoffice", GetMessage("ddeliveryddelivery_Storeoffice"), '', Array("text")),
		Array("StorecompanyName", GetMessage("ddeliveryddelivery_StorecompanyName"), '', Array("text")),
		Array("StorecontactName", GetMessage("ddeliveryddelivery_StorecontactName"), '', Array("text")),
		Array("Storephone", GetMessage("ddeliveryddelivery_Storephone"), '', Array("text")),
		Array("Storeemail", GetMessage("ddeliveryddelivery_Storeemail"), '', Array("text"))
	),*/
	"orderProps" => Array(//свойства заказа откуда брать
		Array("location", GetMessage("ddeliveryddelivery_JS_SOD_location"), 'LOCATION', Array("text")),
		Array("zip", GetMessage("ddeliveryddelivery_JS_SOD_zip"), 'ZIP', Array("text")),
		Array("name", GetMessage("ddeliveryddelivery_JS_SOD_name"), 'FIO', Array("text")),
		Array("email", GetMessage("ddeliveryddelivery_JS_SOD_email"), 'EMAIL', Array("text")),
		Array("phone", GetMessage("ddeliveryddelivery_JS_SOD_phone"), 'PHONE', Array("text")),
		Array("address", GetMessage("ddeliveryddelivery_JS_SOD_line"), 'ADDRESS', Array("text")),
		Array("street", GetMessage("ddeliveryddelivery_JS_SOD_street"), 'STREET', Array("text")),
		Array("house", GetMessage("ddeliveryddelivery_JS_SOD_house"), 'HOUSE', Array("text")),
		Array("flat", GetMessage("ddeliveryddelivery_JS_SOD_flat"), 'FLAT', Array("text")),
		
		
		Array("artnumberProp", GetMessage("ddeliveryddelivery_JS_SOD_artnumber"), 'ARTNUMBER', Array("text")),
	),
	"basket" => array(
		// array("hideNal",GetMessage("ddeliveryddelivery_OPT_hideNal"),"Y",array("checkbox")),
		array("pvzID",GetMessage("ddeliveryddelivery_OPT_pvzID"),"",array("text")),
		// array("pvzPicker",GetMessage("ddeliveryddelivery_OPT_pvzPicker"),"ADDRESS",array("text")),
		// array("showAddress",GetMessage("ddeliveryddelivery_OPT_showAddress"),"N",array("checkbox")),
	),
	// "paySystems" => array(
		// array("paySystems",GetMessage("ddeliveryddelivery_OPT_paySystems"),"",array("text")),
	// ),
	// "service"=>array(
		// array("last",GetMessage("ddeliveryddelivery_JS_SOD_last"),false,array("text")),//последня заявка
		// array("schet",GetMessage("ddeliveryddelivery_JS_SOD_schet"),'0',array("text")),//количество заявок
		// array("statCync",GetMessage("ddeliveryddelivery_OPT_statCync"),'0',array("text")),//дата последнего опроса статусов заказов
		// array("dostTimeout",GetMessage("ddeliveryddelivery_OPT_dostTimeout"),'6',array("text")),//таймаут запроса доставки
	// ),
);

$aTabs = array(
	array("DIV" => "edit1", "TAB" => GetMessage("ddeliveryddelivery_TAB_FAQ"), "TITLE" => GetMessage("ddeliveryddelivery_TAB_TITLE_FAQ")),
	array("DIV" => "edit2", "TAB" => GetMessage("MAIN_TAB_SET"), "TITLE" => GetMessage("MAIN_TAB_TITLE_SET")),
	array("DIV" => "edit3", "TAB" => GetMessage("ddeliveryddelivery_TAB_LIST"), "TITLE" => GetMessage("ddeliveryddelivery_TAB_TITLE_LIST")),
);


//Restore defaults
if ($USER->IsAdmin() && $_SERVER["REQUEST_METHOD"]=="GET" && strlen($RestoreDefaults)>0 && check_bitrix_sessid())
    COption::RemoveOption($module_id);

//Save options
if($REQUEST_METHOD=="POST" && strlen($Update.$Apply.$RestoreDefaults)>0 && check_bitrix_sessid())
{
	if(strlen($RestoreDefaults)>0)
		COption::RemoveOption($module_id);
	else{
		$_REQUEST['paySystems']    = ($_REQUEST['paySystems'])    ? serialize($_REQUEST['paySystems'])    : 'a:0:{}';
		$_REQUEST['addingService'] = ($_REQUEST['addingService']) ? serialize($_REQUEST['addingService']) : 'a:0:{}';
		$_REQUEST['tarifs']        = ($_REQUEST['tarifs'])        ? serialize($_REQUEST['tarifs'])        : 'a:0:{}';
		$_REQUEST['dostTimeout']   = (floatval($_REQUEST['dostTimeout']) > 0) ? $_REQUEST['dostTimeout']  : 6;
		$_REQUEST['cntExpress']   = (floatval($_REQUEST['cntExpress']) > 0) ? $_REQUEST['cntExpress']  : 0;
		
		$arNumReq = array('numberOfPrints','termInc','lengthD','widthD','heightD','weightD');
		foreach($arNumReq as $key){
			$_REQUEST[$key] = intval($_REQUEST[$key]);
			if($_REQUEST[$key] <= 0)
				unset($_REQUEST[$key]);
		}
		
		foreach($arAllOptions as $aOptGroup){
			foreach($aOptGroup as $option){
				__AdmSettingsSaveOption($module_id, $option);
			}
		}
		
		if(COption::GetOptionString($module_id,'delReqOrdr','')=='Y')
			RegisterModuleDependences("sale","OnOrderDelete",$module_id,"imldriver","delReqOD");
		else
			UnRegisterModuleDependences("sale","OnOrderDelete",$module_id,"imldriver","delReqOD");
	}

	if($_REQUEST["back_url_settings"] <> "" && $_REQUEST["Apply"] == "")
		 echo '<script type="text/javascript">window.location="'.CUtil::addslashes($_REQUEST["back_url_settings"]).'";</script>';				
}

function ShowParamsHTMLByArray($arParams)
{
	global $module_id;
	// preDDK($arParams);
	foreach($arParams as $Option)
	{
		if ($Option[0] == "token")
		{
			// ob_start();
			__AdmSettingsDrawRow($module_id, $Option);
			// $str = ob_get_contents();
			// ob_end_clean();
			
			
			// $str = preg_replace("/\<\/td\>.*\<\/tr\>$/", "", $str);
			
			/*ob_start();
			?>
			<input type = "button" onClick = "ddeliveryddelivery_getAccessToken();" value = "<?=GetMessage("ddeliveryddelivery_OPT_GET_ACCESS_TOKEN")?>"></td></tr>
			<?
			$str .= ob_get_contents();
			ob_end_clean();
			
			echo $str;*/
		}
		else
		{
			if($Option[3][0]!='selectbox'){
				__AdmSettingsDrawRow($module_id, $Option);
			}
			else
			{
				$optVal=COption::GetOptionString($module_id,$Option['0'],$Option['2']);
				$str='';
				foreach($Option[4] as $key => $val)
				{
					$chkd='';
					if($optVal==$key)
						$chkd='selected';
					$str.='<option '.$chkd.' value="'.$key.'">'.$val.'</option>';
				}
				echo '<tr>
						<td width="50%" class="adm-detail-content-cell-l">'.$Option[1].'</td>  
						<td width="50%" class="adm-detail-content-cell-r"><select name="'.$Option['0'].'">'.$str.'</select></td>
					</tr>';
			}
		}
	}
}

function showOrderOptions(){//должна вызываться после получения плательщиков
	global $module_id;
	global $arPayers;
	$arNomatterProps=array('street'=>true,'house'=>true,'flat'=>true,'artnumberProp' => true);
	foreach($GLOBALS['arAllOptions']['orderProps'] as $orderProp){
		$value=COption::getOptionString($module_id,$orderProp[0],$orderProp[2]);
		if(!trim($value)){
			$showErr=true;
			if($orderProp[0]=='address'&&COption::getOptionString($module_id,'street',$orderProp[2])){
				unset($arNomatterProps['street']);
				$showErr=false;
			}
		}
		else
			$showErr=false;

		$arError=array(
			'noPr'=>false,
			'unAct'=>false,
			'str'=>false,
		);

		if(!array_key_exists($orderProp[0],$arNomatterProps)&&$value){
			foreach($arPayers as $payId =>$payerInfo)
				if($payerInfo['sel']){
					if($curProp=CSaleOrderProps::GetList(array(),array('PERSON_TYPE_ID'=>$payId,'CODE'=>$value))->Fetch()){
						if($curProp['ACTIVE']!='Y')
							$arError['unAct'].="<br>".$payerInfo['NAME'];
					}
					else
						$arError['noPr'].="<br>".$payerInfo['NAME'];
				}
			if($arError['noPr']){
				$arError['str']=GetMessage('ddeliveryddelivery_LABEL_noPr')." <a href='#' class='PropHint' onclick='return ddelivery_popup_virt(\"pop-noPr_".$orderProp[0]."\",$(this));'></a> ";?>
				<div id="pop-noPr_<?=$orderProp[0]?>" class="b-popup" style="display: none; ">
					<div class="pop-text"><?=GetMessage('ddeliveryddelivery_LABEL_Sign_noPr')?><br><br><?=substr($arError['noPr'],4)?></div>
					<div class="close" onclick="$(this).closest('.b-popup').hide();"></div>
				</div>
			<?}
			if($arError['unAct']){
				$arError['str'].=GetMessage('ddeliveryddelivery_LABEL_unAct')." <a href='#' class='PropHint' onclick='return ddelivery_popup_virt(\"pop-unAct_".$orderProp[0]."\",$(this));'></a>";?>
				<div id="pop-unAct_<?=$orderProp[0]?>" class="b-popup" style="display: none; ">
					<div class="pop-text"><?=GetMessage('ddeliveryddelivery_LABEL_Sign_unAct')?><br><br><?=substr($arError['unAct'],4)?></div>
					<div class="close" onclick="$(this).closest('.b-popup').hide();"></div>
				</div>
			<?}
			
			if($arError['str'])
				$showErr=true;
		}
		elseif(array_key_exists($orderProp[0],$arNomatterProps))
			$showErr=false;
		
		$styleTdStr = ($orderProp[0] == 'street')?'style="border-top: 1px solid #BCC2C4;"':'';
	?>
		<tr>
			<td width="50%" <?=$styleTdStr?> class="adm-detail-content-cell-l"><?=$orderProp[1]?><?=($orderProp[0]=='address')?" <a href='#' class='PropHint' onclick='return ddelivery_popup_virt(\"pop-address\",$(this));'></a>":''?></td>
			<td width="50%" <?=$styleTdStr?> class="adm-detail-content-cell-r">
				<?if($orderProp[0] != 'location'){?>
					<input type="text" size="" maxlength="255" value="<?=$value?>" name="<?=$orderProp[0]?>">
				<?}else{
					global $locProps;
					if($showErr && !$arError['str']) // не выводить "выберите свойство"
						$showErr = false;
					// Местоположение выбирается автоматически из свойств типа "Местоположение"
					if(count($locProps)==0){
						$showErr = true;
						$arError['str'] = GetMessage('ddeliveryddelivery_LABEL_noLoc');
					}elseif(count($locProps)==1){
						$key = array_pop(array_keys($locProps));
					?>
						<input type='hidden' value="<?=$key?>" name="<?=$orderProp[0]?>">
						<?=array_pop($locProps)?> [<?=$key?>]
					<?}else{?>
						<select name="<?=$orderProp[0]?>">
							<?foreach($locProps as $code => $name){?>
								<option value='<?=$code?>' <?=($value==$code)?"selected":""?>><?=$name." [".$code."]"?></option>
							<?}?>
						</select>
					<?}
				}?>
				&nbsp;&nbsp;<span class='errorText' <?if(!$showErr){?>style='display:none'<?}?>><?=($arError['str'])?$arError['str']:GetMessage('ddeliveryddelivery_LABEL_shPr')?></span>
			</td>
		</tr>
	<?}
}

// function printddeliverycity($city){ // Вывод города-отправителя
	// global $module_id;
	// $ddeliverycity = ddeliveryHelper::getNormalCity($city);
	// if(!$ddeliverycity)
		// echo "<tr><td colspan='2'>".GetMessage('ddeliveryddelivery_LABEL_NOddeliveryCITY')."</td><tr>";
	// else{
		// COption::SetOptionString($module_id,'departure',$ddeliverycity['BITRIX_ID']);
		// echo "<tr><td>".GetMessage('ddeliveryddelivery_OPT_depature')."</td><td>".($ddeliverycity['NAME'])."</td><tr>";
	// }
// }


$tabControl = new CAdminTabControl("tabControl", $aTabs);
?>


<form method="post" action="<?echo $APPLICATION->GetCurPage()?>?mid=<?=htmlspecialchars($mid)?>&amp;lang=<?echo LANG?>">
	<?
	$tabControl->Begin();
	$tabControl->BeginNextTab();
	include_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/".$module_id ."/optionsInclude/faq.php");
	$tabControl->BeginNextTab();
	include_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/".$module_id ."/optionsInclude/setups.php");
	$tabControl->BeginNextTab();
	include_once($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/".$module_id ."/optionsInclude/table.php");
	$tabControl->Buttons();
	?>
	<div align="left">
		<input type="hidden" name="Update" value="Y">
		<input type="submit" <?if(!$USER->IsAdmin())echo " disabled ";?> name="Update" value="<?echo GetMessage("MAIN_SAVE")?>">
	</div>
	<?$tabControl->End();?>
	<?=bitrix_sessid_post();?>
</form>

