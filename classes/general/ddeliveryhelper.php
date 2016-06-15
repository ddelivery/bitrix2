<?
IncludeModuleLangFile(__FILE__);

class ddeliveryHelper{
	
	// чистка кеша
	public static function clearCache($param)
	{
		$obCache = new CPHPCache();
		$obCache->CleanDir('/ddeliveryddelivery/');
		return "Y";
	}
	
	function getDelivery(){
		if(!cmodule::includeModule("sale")) return false;
		if(self::isConverted()){
			$dS = Bitrix\Sale\Delivery\Services\Table::getList(array(
				 'order'  => array('SORT' => 'ASC', 'NAME' => 'ASC'),
				 'filter' => array('CODE' => 'ddelivery')
			))->Fetch();
		}else
			$dS = CSaleDeliveryHandler::GetBySID('ddelivery')->Fetch();
		return $dS;
	}
	
	// Проверка активности СД
	function isActive(){
		// $dS = CSaleDeliveryHandler::GetBySID('ddelivery')->Fetch();
		$dS = self::getDelivery();
		
		return ($dS && $dS['ACTIVE'] == 'Y');
	}
	
	/*
	//==backTown
	function getRegionName($region)
	{
		// $region = explode(" ", $region);
		$arExc = array();
		for ($i = 1; $i <= 7; $i++)
			$arExc[] = self::zaDEjsonit(GetMessage("ddeliveryddelivery_EXCEP_REGION_".$i));
		
		foreach ($arExc as $exc)
		// {
			// preDDK(array("reg" => $region, "exc" => $exc));
			$region = preg_replace("/". $exc ."/", "", $region);
		// }
		// preDDK(array("reg" => $region));
		return trim($region);
	}
	
	
	function getDDleiveryCityID($location)
	{
		CModule::IncludeModule("sale");
		
		if(method_exists("CSaleLocation","isLocationProMigrated") && CSaleLocation::isLocationProMigrated() && strlen($location) > 8)
		{
			$arCity = CSaleLocation::getLocationIDbyCODE($location);
			$arCity = CSaleLocation::GetByID($arCity);
		}
		else
			$arCity = CSaleLocation::GetByID($location);
		
		// preDDK($arCity);
		
		$arFilter = array();
		$arFilter["NAME"] = $arCity["CITY_NAME"];
		
		$dbRes = sqlddeliveryCities::select(array(), $arFilter);
		$arResult = array();
		
		while ($res = $dbRes->Fetch())
			$arResult[] = $res;
		// preDDK($arResult);
		$count =count($arResult);
		
		if ($count == 1)
			return $arResult[0]["ID"];
		elseif ($count > 1)
		{
			$region = self::getRegionName($arCity["REGION_NAME"]);
			// preDDK($region);
			foreach($arResult as $key => $city)
			{
				if (preg_match("/". $region ."/", $city["REGION"]))
					return $city["ID"];
			}
			
			return $arResult[0]["ID"];
		}
		elseif ($count == 0)
			return 151184;// это Москва
	}
	
	function GetBitrixCity($params)
	{
		if (!is_numeric($params["ddID"]))
			return false;
		return (self::zajsonit(array("ID" => self::GetBitrixCityID($params["ddID"]))));
	}
	
	function GetBitrixCityID($ddeliveryID)
	{
		CModule::IncludeModule("sale");
		
		$arFilter = array("ID" => $ddeliveryID);
		$ddCity = sqlddeliveryCities::select(array(), $arFilter)->Fetch();
		// preDDK($ddCity);
		
		$arFilter = array(
			"CITY_NAME" => $ddCity["NAME"], 
			"CITY_LID" => LANGUAGE_ID,
			"REGION_LID" => LANGUAGE_ID,
			"COUNTRY_LID" => LANGUAGE_ID
		);
		// preDDK($arFilter);
		
		$dbCity = CSaleLocation::GetList(
			array(),
			$arFilter,
			false,
			false,
			array()
		);
		
		$arCities = array();
		while ($arCity = $dbCity->Fetch())
			$arCities[] = $arCity;
		
		$count = count($arCities);
		
		if ($count > 0)
			foreach ($arCities as $key => $arCity)
				if (preg_match("/". $ddCity["REGION"] ."/", $arCity["REGION_NAME"]))
					return $arCity["CITY_ID"];
		
		global $DB;
		
		// $str_sql = "SELECT * FROM b_sale_loc_name WHERE NAME LIKE '"."%".self::getRegionName($ddCity["REGION"])."%'";
		$str_sql = "SELECT * FROM b_sale_loc_name WHERE NAME REGEXP '"."(^|[ ])".self::getRegionName($ddCity["REGION"])."([ ]|$)'";
		
		// preDDK($str_sql);
		
		$res = $DB->Query($str_sql, false, "SQL Error".__FILE__." ".__LINE__);
		
		$arLoc = array();
		while ($arRes = $res->Fetch())
			$arLoc[] = $arRes;
		
		$count = count($arLoc);
		if ($count == 0)
		{
			return 1;
		}
		else
			return $arLoc[0]["LOCATION_ID"];
		
	}
	
	/*
	//==backTown
	function updateCities($data)
	{
		$curPos = IntVal($data["curPos"]);
		
		$list = 24; // количество строк в одном листе
		$list_count = 400; // количество листов за одну итерацию
		
		
		$file = fopen($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".ddeliverydriver::$MODULE_ID."/install/db/mysql/install_cities.sql", "r");
		
		$str = "";
		
		if ($curPos)
			fseek($file, $curPos);
		
		$count = 0;
		while(!feof($file) && ($count < $list*$list_count))
		{
			$f_str = self::zaDEjsonit(fgets($file));
			
			if ($count > 0)
			{
				$f_str = preg_replace("/INSERT INTO `ddelivery_ddelivery_cities` VALUES/", "", $f_str);
				
				if (($count != ($list*$list_count - 1)) && !feof($file))
					$f_str = preg_replace("/;/", ",", $f_str);
			}
			
			$str .= $f_str;
			
			$count++;
		}
		$cur_pos = ftell($file);
		
		fclose($file);
		
		$arRet = array(
			// "str" => $str,
			"curPos" => $cur_pos,
			"finish" => false,
			"curCount" => $count
		);
		
		if (empty($str))
			$arRet["finish"] = true;
		else
		{
			global $DB;
			if (!$DB->Query($str, false, "File: ".__FILE__."<br>Line: ".__LINE__))
				$arRet["err"] = true;
		}
		return (self::zajsonit($arRet));
	}
	*/
	
	////////////////////////////////////////////////////////////////////////////////////////
	//////////////////////////////////// Вспомогательные ///////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////
	
	function toUpper($str){
		$str = str_replace( //H8 ANSI
			array(
				GetMessage('ddeliveryddelivery_LANG_YO_S'),
				GetMessage('ddeliveryddelivery_LANG_CH_S'),
				GetMessage('ddeliveryddelivery_LANG_YA_S')
			),
			array(
				GetMessage('ddeliveryddelivery_LANG_YO_B'),
				GetMessage('ddeliveryddelivery_LANG_CH_B'),
				GetMessage('ddeliveryddelivery_LANG_YA_B')
			),
			$str
		);
		if(function_exists('mb_strtoupper'))
			return mb_strtoupper($str,LANG_CHARSET);
		else
			return strtoupper($str);
	}
	
	//кодировки
	function zajsonit($handle){
		if(LANG_CHARSET !== 'UTF-8'){
			if(is_array($handle))
				foreach($handle as $key => $val){
					unset($handle[$key]);
					$key=self::zajsonit($key);
					$handle[$key]=self::zajsonit($val);
				}
			else
				$handle=$GLOBALS['APPLICATION']->ConvertCharset($handle,LANG_CHARSET,'UTF-8');
		}
		return $handle;
	}
	
	function zaDEjsonit($handle){
		if(LANG_CHARSET !== 'UTF-8'){
			if(is_array($handle))
				foreach($handle as $key => $val){
					unset($handle[$key]);
					$key=self::zaDEjsonit($key);
					$handle[$key]=self::zaDEjsonit($val);
				}
			else
				$handle=$GLOBALS['APPLICATION']->ConvertCharset($handle,'UTF-8',LANG_CHARSET);
		}
		return $handle;
	}
	
	function isConverted(){
		return (COption::GetOptionString("main","~sale_converted_15",'N') == 'Y');
	}
	
	function AddProfilesList()
	{
		$currency = COption::GetOptionString("sale", "default_currency", "RUB");
		
		// задаем поля родительского профиля
		$fields["CODE"] = "ddelivery";
		$fields["NAME"] = GetMessage("ddeliveryddelivery_DELIV_NAME");
		$fields["CURRENCY"] = $currency;
		$fields["PARENT_ID"] = 0;
		$fields["CLASS_NAME"] = "\Bitrix\Sale\Delivery\Services\Automatic";
		$fields["DESCRIPTION"] = GetMessage('ddeliveryddelivery_DELIV_DESCR');
		$fields["TRACKING_PARAMS"] = array();
		$fields["ACTIVE"] = "Y";
		$fields["ALLOW_EDIT_SHIPMENT"] = "Y";
		$fields["CONFIG"] = array(
            "MAIN" => array(
				"SID" => $fields["CODE"],
				"DESCRIPTION_INNER" => "",
				"MARGIN_VALUE" => 0,
				"MARGIN_TYPE" => "%",
				"OLD_SETTINGS" => ""
			)
        );
		
		// переводим поля в необходимую форму
		try
		{
			$service = \Bitrix\Sale\Delivery\Services\Manager::createObject($fields);

			if($service)
				$fields = $service->prepareFieldsForSaving($fields);
		}
		catch(\Bitrix\Main\SystemException $e)
		{
			$srvStrError = $e->getMessage();
		}
		
		if ($srvStrError != "")
		{
			$arRet = array(
				"is_error" => true,
				"error" => $srvStrError
			);
			return (ddeliveryHelper::zajsonit($arRet));
		}
		
		// добавляем род профиль, дочерние профили добавятся сами в соответсвтии с Init
		$res = \Bitrix\Sale\Delivery\Services\Manager::add($fields);
		
		$arRet = array();
		if ($res->isSuccess())
		{
			$PARENT_ID = $res->getId();
			
			$arRet = array(
				"success" => true,
				"ID" => $PARENT_ID
			);

			if(!$fields["CLASS_NAME"]::isInstalled())
				$fields["CLASS_NAME"]::install();
		}
		else
			$arRet = array(
				"is_error" => true,
				"error" => implode("<br>",$res->getErrorMessages())
			);
			
		return (ddeliveryHelper::zajsonit($arRet));
	}
}