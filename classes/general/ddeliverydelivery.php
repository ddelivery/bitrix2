<?
cmodule::includeModule('sale');
IncludeModuleLangFile(__FILE__);
include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/ddelivery.ddelivery2/classes/general/ddeliveryhelper.php');


class CDeliveryddelivery{
	static $MODULE_ID    = 'ddelivery.ddelivery2';
	// static $bitrixLocationTo = false;
	// static $ddeliveryLocationTo = false;//==backTown
	
	static $personType = false;
	
	function Init(){
		// получаем поставщиков услуг и делаем из них профили
		$arProfiles = array(
			"DDelivery" => array(
				"TITLE" => GetMessage("ddeliveryddelivery_DELIV_COURIER_TITLE"),
				"DESCRIPTION" => GetMessage("ddeliveryddelivery_DELIV_COURIER_DESCR"),
				"RESTRICTIONS_WEIGHT" => array(0,75000),
				"RESTRICTIONS_SUM" => array(0),
				"RESTRICTIONS_MAX_SIZE" => "0",
				"RESTRICTIONS_DIMENSIONS_SUM" => "0"
			)
		);
		
		return array(
			/* Basic description */
			"SID" => "ddelivery",
			"NAME" => GetMessage("ddeliveryddelivery_DELIV_NAME"),
			"DESCRIPTION" => GetMessage('ddeliveryddelivery_DELIV_DESCR'),
			"DESCRIPTION_INNER" => GetMessage('ddeliveryddelivery_DELIV_DESCRINNER'),
			"BASE_CURRENCY" => COption::GetOptionString("sale", "default_currency", "RUB"),
			"HANDLER" => __FILE__,

			/* Handler methods */
			"DBGETSETTINGS" => array("CDeliveryddelivery", "GetSettings"),
			"DBSETSETTINGS" => array("CDeliveryddelivery", "SetSettings"),
			// "GETCONFIG" => array("CDeliveryddelivery", "GetConfig"),

			"COMPABILITY" => array("CDeliveryddelivery", "Compability"),      
			"CALCULATOR" => array("CDeliveryddelivery", "Calculate"),      

			/* List of delivery profiles */
			"PROFILES" => $arProfiles
		);
	}

	function SetSettings($arSettings){
		return serialize($arSettings);
	}

	function GetSettings($strSettings){
		return unserialize($strSettings);
	}
	
	// метод проверки совместимости в данном случае практически аналогичен рассчету стоимости
	function Compability($arOrder, $arConfig)
	{
		// self::$bitrixLocationTo = $arOrder["LOCATION_TO"];
		// self::$ddeliveryLocationTo = ddeliveryHelper::getDDleiveryCityID(self::$bitrixLocationTo);//==backTown
		
		return array(
			"DDelivery"
		);
	}
	
	function Calculate($profile, $arConfig, $arOrder, $STEP, $TEMP = false)//расчет стоимости
	{
		$arReturn = array(
			"RESULT" => "OK",
			"VALUE" => $_REQUEST["ddelivery_price"]?$_REQUEST["ddelivery_price"]:0
		);
		
		foreach(GetModuleEvents(self::$MODULE_ID, "onCalculate", true) as $arEvent)
			ExecuteModuleEventEx($arEvent,Array(&$arReturn,$profile,$arConfig,$arOrder));
		
		return $arReturn;
	}
	
	function loadComponent(){ // подключает компонент
		if(self::isActive() && $_REQUEST['is_ajax_post'] != 'Y' && $_REQUEST["AJAX_CALL"] != 'Y' && !$_REQUEST["ORDER_AJAX"])
			$GLOBALS['APPLICATION']->IncludeComponent("ddelivery:ddelivery.ddelivery2Pickup", "order", array(),false);
	}
	
	
	// Вызывается в компоненте bitrix:sale.order.ajax после формирования списка доступных служб доставки, может быть использовано для модификации данных.
	static $selectedDelivery = "";
	function pickupLoader($arResult, $arUserResult)
	{
		if(!self::isActive()) return;
		
		self::$selectedDelivery = $arUserResult['DELIVERY_ID'];
		self::$personType = $arUserResult['PERSON_TYPE_ID'];
		
		// prefile($arUserResult, "pick");
	}
	
	
	
	// Событие вызывается в самом конце перед отправкой HTML в браузер. Нужно: 1) Чтобы при Ajax запросах передать в JS обновленные данные.
	function onBufferContent(&$content) {
		
		if(($_REQUEST['is_ajax_post'] == 'Y' || $_REQUEST["AJAX_CALL"] == 'Y' || $_REQUEST["ORDER_AJAX"]) && self::no_json($content) && self::isActive())
		{
			//== backTown
			// $content .= '<input type="hidden" id="ddelivery_city"   name="ddelivery_city"   value=\''.self::$ddeliveryLocationTo.'\' />';//вписываем город
			
			$content .= '<input type="hidden" id="ddelivery_personType"   name="ddelivery_personType"   value=\''.self::$personType.'\' />';//вписываем тип плательщика
			
			$content .= '<input type="hidden" id="ddelivery_dostav"   name="ddelivery_dostav"   value=\''.self::$selectedDelivery.'\' />';//вписываем выбранный вариант доставки
			
		}
	}
	function no_json(&$wat){
		return is_null(json_decode(ddeliveryHelper::zajsonit($wat),true));
	}
	
	/*()()()()()()()()()()()()()()()()()()()()()()()()()()()()()()()()()()()()()()()()()()()()()()()()()()()()()()()()()()()()()()()()
													Общие функции модуля
	()()()()()()()()()()()()()()()()()()()()()()()()()()()()()()()()()()()()()()()()()()()()()()()()()()()()()()()()()()()()()()()()*/
	
	function isActive(){
		if(class_exists('ddeliveryHelper'))
			return ddeliveryHelper::isActive();
		else
			return false;
	}
}
?>