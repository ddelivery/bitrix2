<?
IncludeModuleLangFile(__FILE__);

use DDelivery\Business\Business;

class ddeliverydriver{
	static $MODULE_ID = "ddelivery.ddelivery2";
	static $arStatusMap = array();
	static $PayDeliveredOrder = "";
	
	static $errors = array();
	
	// получение корзины пользовател€
	function getUserCart($OrderID = false)
	{
		if (!cmodule::includeModule('sale'))
			return;
		
		if ($OrderID)
			$arFilter = array("ORDER_ID" => $OrderID);
		else
			$arFilter = array(
				"FUSER_ID" => CSaleBasket::GetBasketUserID(),
				"LID" => SITE_ID,
				"ORDER_ID" => "NULL"
			);
		
		$dbBasketItems = CSaleBasket::GetList(
			array(),
			$arFilter
		);
		
		$arBasketRet = array();
		
		$artnumberCode = COption::GetOptionString(self::$MODULE_ID, "artnumberProp", "ARTNUMBER");
		
		while ($arBasket = $dbBasketItems->Fetch())
		{
			$arDim = unserialize($arBasket["DIMENSIONS"]);
			
			$arBasketProp = CSaleBasket::GetPropsList(
				array(),
				array("BASKET_ID" => $arBasket["ID"], "CODE" => $artnumberCode)
			)->Fetch();
			
			$arBasketRet[] = array(
				"id"       =>  $arBasket["PRODUCT_ID"],
				"name"     =>  self::zajsonit($arBasket["NAME"]),
				"width"    =>  $arDim["WIDTH"]/10,// в см
				"height"   =>  $arDim["HEIGHT"]/10,
				"length"   =>  $arDim["LENGTH"]/10,
				"weight"   =>  $arBasket["WEIGHT"]/1000,// в кг
				"price"    =>  $arBasket["PRICE"],
				"quantity" =>  $arBasket["QUANTITY"],
				"sku"      =>  empty($arBasketProp["VALUE"])?"":$arBasketProp["VALUE"]
			);
		}
		
		return $arBasketRet;
	}
	
	// получение вариантов статусов заказов
	function GetOrderStatus()
	{
		if (!cmodule::includeModule('sale'))
			return;
		
		$dbStatuses = CSaleStatus::GetList(
			array(),
			array("LID" => LANGUAGE_ID)
		);
		
		$arReturn = array();
		while ($arStatus = $dbStatuses->Fetch())
			// preDDK($arStatus);
			$arReturn[$arStatus["ID"]] = self::zajsonit($arStatus["NAME"]);
		
		return $arReturn;
	}
	
	// получение платежных систем
	function GetPaySystems()
	{
		if (!cmodule::includeModule('sale'))
			return;
		
		$dbPaySystem = CSalePaySystem::GetList(
			array(),
			array()
			// array("LID" => LANGUAGE_ID)
		);
		
		$arReturn = array();
		while ($arPaySystem = $dbPaySystem->Fetch())
			// preDDK($arStatus);
			$arReturn[$arPaySystem["ID"]] = self::zajsonit($arPaySystem["NAME"]);
		
		return $arReturn;
	}
	
	// проверка на админские права
	function IsAdmin()
	{
		return $GLOBALS["USER"]->IsAdmin();
	}
	
	
	
	
	///////////////////////////////////////////////////////////////////////////
	///// —оздание заказа /////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////
	function orderCreate($orderID, $orderFields, $arParams)
	{
		if (preg_match("/DDelivery/", $orderFields["DELIVERY_ID"]))
		{
			if ((!cmodule::includemodule('sale')) /*|| (!self::controlProps())*/)
				return true;
			
			// запоминаем данные заказа, если доставка - ddelivery
			
			$Data = array(
				"ORDER_ID" => $orderID,
				"PARAMS" => $_REQUEST["ddelivery_sdk_container_id"]
			);
			
			sqlddeliveryOrders::Add($Data);
			
			
			$sdk_id = json_decode(ddeliveryHelper::zajsonit($Data["PARAMS"]), true);
			$sdk_id = $sdk_id["id"];
			
			$arNeedUserPropsCode = array(
				"name" => COption::GetOptionString(self::$MODULE_ID, "name", "FIO"),
				"phone" => COption::GetOptionString(self::$MODULE_ID, "phone", "PHONE"),
				"email" => COption::GetOptionString(self::$MODULE_ID, "email", "EMAIL"),
			);
			
			$dbProps = CSaleOrderProps::GetList(
				array(),
				array("PERSON_TYPE_ID" => $_REQUEST["PERSON_TYPE"]),
				false,
				false,
				array("ID", "CODE")
			);
			
			$params = array();
			while ($arProp = $dbProps->Fetch())
				foreach ($arNeedUserPropsCode as $key => $code)
					if ($arProp["CODE"] == $code)
						$params["USER_PARAMS"][$key] = $_REQUEST["ORDER_PROP_".$arProp["ID"]];
			
			$params["USER_PARAMS"]["payment_id"] = $_REQUEST["PAY_SYSTEM_ID"];
			
			$arOrder = CSaleOrder::GetList(
				array(),
				array("ID" => $orderID)
			)->Fetch();
			
			$accountNumber = $arOrder["ACCOUNT_NUMBER"];
			if (empty($accountNumber))
				$accountNumber = $orderID;
			
			$params["USER_PARAMS"]["status"] = $arOrder["STATUS_ID"];

			if ("Y" == $arOrder["PAYED"])
				$params["USER_PARAMS"]["payment"] = 0;
			else
				$params["USER_PARAMS"]["payment"] = $arOrder["PRICE"];
			
			$params = ddeliveryHelper::zajsonit($params);
			
			ob_start();
			require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/js/".self::$MODULE_ID."/ajaxSDK.php");
			ob_end_clean();
			
			if (!self::$business)
				self::$business = $business;
			else
				$business = self::$business;
			
			
			$res = $business->onCmsOrderFinish(
				$sdk_id, ddeliveryHelper::zajsonit($accountNumber),
				$params["USER_PARAMS"]['payment_id'], $params["USER_PARAMS"]['status'],
				$params["USER_PARAMS"]['name'], $params["USER_PARAMS"]['phone'],
				$params["USER_PARAMS"]['email'], $params["USER_PARAMS"]['payment']
			);
			
			if (!$res["id"])
			{
				$arReturn = array();
				$arReturn["is_error"] = true;
				$arReturn["method"] = "onCmsOrderFinish";
				$arReturn["error"] = ddeliveryHelper::zaDEjsonit($res);
				// $arReturn["params"] = print_r($params, true);
				
				$emptyParams = array();
				foreach($params["USER_PARAMS"] as $key => $param)
					if (empty($param))
						$emptyParams[] = $key;
					
				$arReturn["params"] = array(
					"sdk_id" => $sdk_id,
					"ord_num" => ddeliveryHelper::zajsonit($accountNumber),
					"EMPTY_USER_PARAMS" => $emptyParams
				);
				self::LogErr($arReturn);
				
			}
			
			return true;
		}
	}
	
	// кнопка "—охранить и отправить" в редакторе заказа
	function saveOrder(Business $business, $params)
	{
		$arFilter = array(
			"ORDER_ID" => $params["ORDER_ID"]
		);
		
		if (!empty($params["PARAMS"]))
			$arFields["PARAMS"] = ddeliveryHelper::zaDEjsonit($params["PARAMS"]);
		
		$params["PARAMS"] = json_decode($params["PARAMS"], true);
		
		$arRet = array();
		
		// обновляем стоимость доставки и стоимость заказа
		CModule::IncludeModule("sale");
		
		$arOrder = CSaleOrder::GetList(
			array(),
			array("ID" => $params["ORDER_ID"])
		)->Fetch();
		
		$arDeliveryPrice = array(
			"calculate" => floatval($params["PARAMS"]["client_price"]),// доставка из виджета
			"order" => floatval($arOrder["PRICE_DELIVERY"])// доставка в битрикс
		);
		
		if ($arDeliveryPrice["calculate"] != $arDeliveryPrice["order"])
		{
			$orderPrice = floatval($arOrder["PRICE"]) - floatval($arOrder["PRICE_DELIVERY"]);
			
			if (CSaleOrder::Update(
				$params["ORDER_ID"],
				array(
					"PRICE_DELIVERY" => $arDeliveryPrice["calculate"],
					"PRICE" => $orderPrice + $arDeliveryPrice["calculate"]
				)
			))
				$arRet["result"] = true;
			else
				$arRet["error"] = true;
		}
		
		// если заказ сделан из публички
		if (sqlddeliveryOrders::CheckRecord($params["ORDER_ID"]))
			if (sqlddeliveryOrders::update($arFilter, $arFields))
				$arRet["result"] = true;
			else
				$arRet["error"] = true;
		else
		{// если заказ делается из админки, надо его создать в ddelivery, потом отправлять
	
			sqlddeliveryOrders::Add(array(
				"ORDER_ID" => $params["ORDER_ID"], 
				"PARAMS" => $arFields["PARAMS"]
			));
			
			// $sdk_id = json_decode($params["PARAMS"], true);
			$sdk_id = $params["PARAMS"]["id"];
			
			$accountNumber = $arOrder["ACCOUNT_NUMBER"];
			if (empty($accountNumber))
				$accountNumber = $orderID;
			
			$params["payment_id"] = $arOrder["PAY_SYSTEM_ID"];
			$params["status"] = $arOrder["STATUS_ID"];
			
			$arNeedUserPropsCode = array(
				"name" => COption::GetOptionString(self::$MODULE_ID, "name", "FIO"),
				"phone" => COption::GetOptionString(self::$MODULE_ID, "phone", "PHONE"),
				"email" => COption::GetOptionString(self::$MODULE_ID, "email", "EMAIL"),
			);
			
			$dbProps = CSaleOrderPropsValue::GetList(
				array(),
				array("ORDER_ID" => $params["ORDER_ID"])
			);
			
			while ($arProp = $dbProps->Fetch())
				foreach ($arNeedUserPropsCode as $key => $code)
					if ($arProp["CODE"] == $code)
						$params[$key] = ddeliveryHelper::zajsonit($arProp["VALUE"]);
			
			if ("Y" == $arOrder["PAYED"])
				$params["payment"] = 0;
			else
				$params["payment"] = $arOrder["PRICE"];
			
			
			$res = $business->onCmsOrderFinish(
				$sdk_id, ddeliveryHelper::zajsonit($accountNumber),
				$params['payment_id'], $params['status'],
				$params['name'], $params['phone'],
				$params['email'], $params['payment']
			);
			
			if ($res["id"])
			{
				$arRet["result"] = true;
				
				$arRet["res"] = $res;
			}
			else
			{
				$arRet["error"] = true;
				
				$arRet["data"] = array(
					$sdk_id, ddeliveryHelper::zajsonit($accountNumber),
					$params['payment_id'], $params['status'],
					$params['name'], $params['phone'],
					$params['email'], $params['payment']
				);
				
				$arRet["msg"] = $res;
			}
		}
		
		return $arRet;
	}
	
	// вывод информации о заказе
	function showDetail(Business $business, $params)
	{
		$res = sqlddeliveryOrders::select(
			array(),
			array("ORDER_ID" => $params["ORDER_ID"])
		)->Fetch();
		
		$res["PARAMS"] = ddeliveryHelper::zaDEjsonit(json_decode(ddeliveryHelper::zajsonit($res["PARAMS"]), true));
		$sdk_id = $res["PARAMS"]["id"];
		
		$info = ddeliveryHelper::zaDEjsonit($business->viewOrder($sdk_id));
		
		ob_start();
		
		?>
		<table style = "width: 100%;">
			<tr>
				<td><?=GetMessage("ddeliveryddelivery_JS_SOD_ddelivery_ID")?></td>
				<td><?=$info["ddelivery_id"]?></td>
			</tr>
			
			<tr>
				<td><?=GetMessage("ddeliveryddelivery_JS_SOD_location")?></td>
				<td><?=$info["city_name"]?></td>
			</tr>
			
			<tr>
				<td><?=GetMessage("ddeliveryddelivery_JS_SOD_HD_ADDRESS")?></td>
				<td><?=$info["info"]?></td>
			</tr>
		</table>
		<?
		
		$str = ob_get_contents();
		ob_end_clean();
		
		return ddeliveryHelper::zajsonit($str);
	}
	
	// static $sendDeliveredOrder = array();
	// собираем id заказов при простановке флагов доставки
	// установка доставки в 16 версии битрикс не вызывает это событие, смысла в нем теперь нет
	function BeforeDeliveryOrder($OrderID, $value, $recurringID, $arAdditionalFields)
	{
		// CModule::IncludeModule("sale");
	
// prefile(array("onBeforeDeliv", $OrderID, $value), "sdkDebug");
// return false;
	
		// $res = CSaleOrder::GetList(
			// array(),
			// array("ID" => $OrderID),
			// false,
			// false,
			// array("ID", "ALLOW_DELIVERY", "DELIVERY_ID")
		// )->Fetch();
		
		// if ($res["DELIVERY_ID"] == "ddelivery:DDelivery" && $value == "Y" && $value != $res["ALLOW_DELIVERY"])
			// self::$sendDeliveredOrder[$OrderID] = $OrderID;
		
		return true;
	}
	
	static $business = false;
	// после разрешени€ доставки отправл€ем заказ
	function DeliveryOrder($OrderID, $value)
	{
// prefile(array("onDeliv", $OrderID, $value), "sdkDebug");
		CModule::IncludeModule("sale");
		
		ob_start();
		require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/js/".self::$MODULE_ID."/ajaxSDK.php");
		ob_end_clean();
		
		if (!self::$business)
			self::$business = $business;
		else
			$business = self::$business;
		
		if ("Y" == $value /*&& in_array($OrderID, self::$sendDeliveredOrder)*/)
		{
			$res = sqlddeliveryOrders::select(
				array(),
				array("ORDER_ID" => $OrderID)
			)->Fetch();
			
			if (!empty($res["ddelivery_ID"]))
				return true;
				
			
			$dbOrderProp = CSaleOrderPropsValue::GetList(
				array(),
				array("ORDER_ID" => $OrderID),
				false,
				false,
				array()
			);

			$arNeedUserPropsCode = array(
				"name" => COption::GetOptionString(self::$MODULE_ID, "name", "FIO"),
				"phone" => COption::GetOptionString(self::$MODULE_ID, "phone", "PHONE"),
				"email" => COption::GetOptionString(self::$MODULE_ID, "email", "EMAIL"),
			);

			$userProps = array();
			while ($arProps = $dbOrderProp->Fetch())
			{
				foreach ($arNeedUserPropsCode as $key => $code)
					if ($arProps["CODE"] == $code)
						$userProps[$key] = ddeliveryHelper::zajsonit($arProps["VALUE"]);
			}
			
			
			$arOrder = CSaleOrder::GetList(
				array(),
				array("ID" => $OrderID)
			)->Fetch();

			$userProps["payment_id"] = $arOrder["PAY_SYSTEM_ID"];
			$userProps["status"] = $arOrder["STATUS_ID"];

			if ("Y" == $arOrder["PAYED"])
				$userProps["payment"] = 0;
			else
				$userProps["payment"] = $arOrder["PRICE"];
			
			
			$data = array(
				"ORDER_ID" => $OrderID,
				"USER_PARAMS" => $userProps
			);
			
			if (!empty($arOrder["ACCOUNT_NUMBER"]))
				$data['ACCOUNT_NUMBER'] = $arOrder["ACCOUNT_NUMBER"];
			else
				$data['ACCOUNT_NUMBER'] = $arOrder["ID"];
			
			self::sendOrder($business, $data);
			
			// unset(self::$sendDeliveredOrder[$OrderID]);
		}
	}
	
	// отправка заказа в ddelivery
	function sendOrder(Business $business, $params)
	{	
		if (!CModule::IncludeModule("sale"))
			return;
		
		$params["ORDER_ID"] = IntVal($params["ORDER_ID"]);
		
		$res = sqlddeliveryOrders::select(
			array(),
			array("ORDER_ID" => $params["ORDER_ID"])
		)->Fetch();
		
		if(!empty($res["ddelivery_ID"]))
			return;
		
		$res["PARAMS"] = json_decode(ddeliveryHelper::zajsonit($res["PARAMS"]), true);
		
		$sdk_id = $res["PARAMS"]["id"];
		
		$params = ddeliveryHelper::zajsonit(ddeliveryHelper::zaDEjsonit($params));
		
		$params["USER_PARAMS"]['payment'] = null;
		
		$res = $business->cmsSendOrder(
                            $sdk_id, $params["ACCOUNT_NUMBER"],
                            $params["USER_PARAMS"]['payment_id'], $params["USER_PARAMS"]['status'],
                            $params["USER_PARAMS"]['name'], $params["USER_PARAMS"]['phone'],
			$params["USER_PARAMS"]['email'], $params["USER_PARAMS"]['payment']
        );
		
		if (!is_numeric($res))
		{
			$arReturn = array();
			$arReturn["is_error"] = true;
			$arReturn["method"] = "cmsSendOrder";
			$arReturn["error"] = $res;
			
			$emptyParams = array();
			foreach($params["USER_PARAMS"] as $key => $param)
				if (empty($param))
					$emptyParams[] = $key;
				
			$arReturn["params"] = array(
				"sdk_id" => $sdk_id,
				"ord_num" => ddeliveryHelper::zajsonit($params["ACCOUNT_NUMBER"]),
				"EMPTY_USER_PARAMS" => $emptyParams
			);
			self::LogErr($arReturn);
			
			return ($arReturn);
		}
		
		$arReturn["DDelivery_ID"] = $res;

		$arFilter = array(
			"ORDER_ID" => $params["ORDER_ID"]
		);
		
		$arFields = array(
			"ddelivery_ID" => $arReturn["DDelivery_ID"]
		);
		
		if (!sqlddeliveryOrders::update($arFilter, $arFields))
			$arReturn["is_error"] = true;
		
		return ($arReturn);
	}
	
	///////////////////////////////////////////////////////////////////////////
	///// ¬изуальное оформление(оформление заказа + таблица) //////////////////
	///////////////////////////////////////////////////////////////////////////
	
	function onEpilog(){//ќтображение формы
		if(
			(
				!(preg_match("/\/bitrix\/admin\/sale_order_detail.php/", $_SERVER['PHP_SELF']) ||
				preg_match("/\/bitrix\/admin\/sale_order_view.php/", $_SERVER['PHP_SELF'])
				)
			) || 
			!cmodule::includeModule('sale')
		)
			return false;
		include_once($_SERVER['DOCUMENT_ROOT']."/bitrix/js/".ddeliverydriver::$MODULE_ID."/orderDetail.php");
	}
	
	function tableHandler($params){ // отображение таблицы о за€вках
		// die(preDDK($params, true));
		$arSelect[0]=($params['by'])?$params['by']:'ID';
		$arSelect[1]=($params['sort'])?$params['sort']:'DESC';
		
		$arNavStartParams['iNumPage']=($params['page'])?$params['page']:1;
		$arNavStartParams['nPageSize']=($params['pgCnt']!==false)?$params['pgCnt']:1;
		
		foreach($params as $code => $val)
			if(strpos($code,'F')===0)
				$arFilter[substr($code,1)]=$val;
		
		$requests   = sqlddeliveryOrders::select($arSelect,$arFilter,$arNavStartParams);
		
		$strHtml='';
		
		while($request=$requests->Fetch()){
			$reqParams=ddeliveryHelper::zaDEjsonit(json_decode(ddeliveryHelper::zajsonit($request['PARAMS']), true));
			$paramsSrt='';
			
			ob_start();
			
			echo preg_replace("/,/", "<br>", $reqParams["info"]);
			
			$paramsSrt .= ob_get_contents();
			ob_end_clean();
				
			
			$addClass='';
			
			$contMenu.='])"><div class="adm-list-table-popup"></div></td>';
			$strHtml.='<tr class="adm-list-table-row '.$addClass.'">';
			$strHtml.=$contMenu;
			$strHtml.='<td class="adm-list-table-cell"><div>'.$request['ID'].'</div></td>';
			// $strHtml.='<td class="adm-list-table-cell"><div>'.$request['MESS_ID'].'</div></td>';
			$strHtml.='<td class="adm-list-table-cell"><div><a href="/bitrix/admin/sale_order_detail.php?ID='.$request['ORDER_ID'].'&lang=ru" target="_blank">'.$request['ORDER_ID'].'</div></td>';
			// $strHtml.='<td class="adm-list-table-cell"><div>'.$request['STATUS'].'</div></td>';
			$strHtml.='<td class="adm-list-table-cell"><div>'.$request['ddelivery_ID'].'</div></td>';
			$strHtml.='<td class="adm-list-table-cell"><div><a href="javascript:void(0)" onclick="ddeliveryddelivery_shwPrms($(this).siblings(\'div\'))">'.GetMessage('ddeliveryddelivery_STT_SHOW').'</a><div style="height:0px; overflow:hidden">'.$paramsSrt.'</div></div></td>';
			// $strHtml.='<td class="adm-list-table-cell"><div>'.$request['MESSAGE'].'</div></td>';
			$strHtml.='<td class="adm-list-table-cell"><div>'.date("d.m.y H:i",$request['UPTIME']).'</div></td>';
			$strHtml.='</tr>';
		}
		return (
			self::zajsonit(
				array(
					'ttl'=>$requests->NavRecordCount,
					'mP'=>$requests->NavPageCount,
					'pC'=>$requests->NavPageSize,
					'cP'=>$requests->NavPageNomer,
					'sA'=>$requests->NavShowAll,
					'html'=>$strHtml
				)
			)
		);
	}
	
	////////////////////////////////////////////////////////////////////////////////////////
	/////////////////////////////////// ѕечать документов //////////////////////////////////
	////////////////////////////////////////////////////////////////////////////////////////
	static $api_key = false;
	public static function MakeRequest($arSend)
	{
		$url = "http://cabinet.ddelivery.ru:80/api/v1/";
		
		if (!self::$api_key)
			$api_key = COption::GetOptionString(self::$MODULE_ID, "token", "");
		else
			$api_key = self::$api_key;
		
		$ch = curl_init();
		
		$headers = array("Content-Type: application/json", "Accept: application/json");
		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		// curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
		
		$curl_url = $url.$api_key."/".$arSend["WHERE"].".json";
		
		if (!empty($arSend["FILTER"]))
			$curl_url .= "?".http_build_query($arSend["FILTER"]);
		
		curl_setopt($ch, CURLOPT_URL, $curl_url);
		// preDDK($curl_url);
		
		curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		
		$result = curl_exec($ch);
		// $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		$code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		
		$arRet = array(
			'code'   => $code,
			'result' => json_decode($result, true)
		);
		
		// preDDK($arRet);
		
		if ($code != 200)
		// if (1)
		{
			// $arRet["request"] = json_encode(apishipHelper::zajsonit($arSend["DATA"]));
			// $arRet["url"] = $curl_url;
			
			self::$errors[] = array(
				"url" => $curl_url,
				"code" => $code,
				"arSend" => $arSend,
				"res" => json_decode($result, true),
				"json_arSend" => json_encode($arSend["DATA"]),
				"json_ret" => $result
			);
		}
		
		return $arRet;
	}
	
	// получаем id за€вки на создание документов
	public function GetDocumentsRequestions($OrderID)
	{
		if (!is_array($OrderID))
			$OrderID = array($OrderID);
			
		$strID = "";
		foreach ($OrderID as $id)
		{
			if ($strID)
				$strID .= ",";
			
			$strID .= $id;
		}
		
		$toRequest = array(
			"WHERE" => "documents_request",
			"FILTER" => array(
				"order_id" => $strID
			),
		);
		
		$req_res = self::MakeRequest($toRequest);
		
		if ($req_res["code"] != 200)
			return false;
		else
			return $req_res["result"];
	}
	
	public function GetDocuments($reqID)
	{
		$toRequest = array(
			"WHERE" => "documents_status/".$reqID,
			// "FILTER" => array(
				// "request_id" => $strID
			// ),
		);
		
		$req_res = self::MakeRequest($toRequest);
		
		if ($req_res["code"] != 200)
			return false;
		else
			return $req_res["result"];
	}
	
	function getOrderInvoice($oId){ // получаем квитанцию
		if(!$oId){
			return array(
				'result' => 'error',
				'error'  => 'No order id'
			);
		}
		if(!is_array($oId))
			$oId = array($oId);

		$requests = sqlddeliveryOrders::select(array(),array("ORDER_ID"=>$oId));
		
		$ddeliveryIDs = array();
		
		while($request = $requests->Fetch())
			$ddeliveryIDs[] = IntVal($request["ddelivery_ID"]);
		
		$requestions = self::GetDocumentsRequestions($ddeliveryIDs);
		
		if ($requestions["response"]["request_id"])
			return array("result" => "ok", "seqID" => $requestions["response"]["request_id"]);
		else
			return array("error" => $requestions["response"]["message"]);
		
	}
	
	function getOrderInvoiceAJAX($params)
	{
		return (self::getOrderInvoice(ddeliveryHelper::zajsonit($params["orderID"])));
	}
	
	// добавл€ем действи€ дл€ печати актов
	function displayActPrint(&$list)
	{
		if (!empty($list->arActions))
			CJSCore::Init(array('ddeliveryddelivery_printOrderActs'));
		
		if($GLOBALS['APPLICATION']->GetCurPage() == "/bitrix/admin/sale_order.php")
			$list->arActions['ddeliveryddelivery_printOrderActs'] = GetMessage("ddeliveryddelivery_SIGN_PRNTddelivery");
	}
	
	// нажатие на печать актов
	function OnBeforePrologHandler()
	{
		if(!array_key_exists('action', $_REQUEST) || !array_key_exists('ID', $_REQUEST) || $_REQUEST['action'] != 'ddeliveryddelivery_printOrderActs')
			return;
		
		$orderIDs = $_REQUEST["ID"];
		
		$res = self::getOrderInvoice($orderIDs);
		
		if ($res["result"] == "ok")
		{
			?>
			<script type="text/javascript">
				window.open('/bitrix/js/<?=self::$MODULE_ID?>/documentPrint.php?doc_seq_id=<?=$res["seqID"]?>', '_blank');
				
			</script>
			<?
		}
		else
		{
			?>
			<script type="text/javascript">
				alert("<?=$res["error"]?>");
			</script>
			<?
		}
	}
	
	// проверка по€влени€ документов
	function AJAXDocSeq($params)
	{
		$documents = self::GetDocuments($params["seqID"]);
		
		if ($documents["response"]["completed"])
			return ($documents["response"]["documents"]);
		else
			return false;
	}
	
	///////////////////////////////////////////////////////////////////////////
	///// јгенты //////////////////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////
	// вызов обновлени€ списка городов, самовывозов и услуг
	// function agentUpdateList()
	// { 
	
	// }
	
	// вызов обновлени€ статусов заказов
	function agentOrderStates()
	{ 
		// self::UpdateStatuses();
		// return 'ddeliverydriver::agentOrderStates();';
	}
	
	function updateStatuses($inputOrders)
	{
		if (!CModule::IncludeModule("sale"))
			return;
		
		$accountTemplate = COption::GetOptionString("sale", "account_number_template");
		if (!empty($accountTemplate))
			$orderNumberKey = "ACCOUNT_NUMBER";
		else
			$orderNumberKey = "ID";
		
		$orders = array();
		$arFilter = array();
		foreach ($inputOrders as $order)
			foreach ($order as $accountNumber => $statusID)
			{
				$arFilter[$orderNumberKey][] = $accountNumber;
				$orders[$accountNumber] = $statusID;
			}
		
		$dbOrders = CSaleOrder::GetList(
			array(),
			$arFilter,
			false,
			false,
			array("ID", "ACCOUNT_NUMBER", "STATUS_ID")
		);
		
		$arExistOrder = array();
		while ($arOrder = $dbOrders->Fetch())
		{
			$arExistOrder[$arOrder[$orderNumberKey]] = $arOrder["ID"];
			
			if ($orders[$arOrder[$orderNumberKey]] == $arOrder["STATUS_ID"])
				unset($orders[$arOrder[$orderNumberKey]]);
			
		}
		
		foreach ($orders as $accountNumber => $statusID)
			if (!$arExistOrder[$accountNumber])
				unset($orders[$accountNumber]);
		
		$success = true;
		foreach ($orders as $accountNumber => $statusID)
			if (!CSaleOrder::StatusOrder($arExistOrder[$accountNumber], $statusID))
			{
				self::LogErr(array("File" => __FILE__, "Line" => __LINE__, "msg" => "UpdStatusError orderOD:$accountNumber statusID:$statusID"));
				$success = false;
			}
			
		return $success;
	}
	
	function LogErr($val)
	{
		$fileName = $_SERVER["DOCUMENT_ROOT"]."/bitrix/js/".self::$MODULE_ID."/errorLog.php";
		
		$file=fopen($fileName,"a+");
		fwrite($file,"\n\n".date("H:i:s d-m-Y")."\n");
		fwrite($file,print_r($val,true));
		fclose($file);
		
		$content = file_get_contents($fileName);
		
		if (!preg_match("/\<\?\/\*Admin ckeck\*\/\?\>/", $content))
		{
			$adminAdding = "";
			$adminAdding .= "<?/*Admin ckeck*/?>";
			$adminAdding .= '<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");?>';
			$adminAdding .= '<?if (!$GLOBALS["USER"]->IsAdmin())';
			$adminAdding .= 'die("Access denied! Only for admin!");?>';
	
			$content = $adminAdding.$content;
			file_put_contents($fileName, $content);
		}
	}
	
	
	
	///////////////////////////////////////////////////////////////////////////
	///// ќбщие функции модул€ ////////////////////////////////////////////////
	///////////////////////////////////////////////////////////////////////////
	function zajsonit($handle){
		if(class_exists('ddeliveryHelper')) return ddeliveryHelper::zajsonit($handle);
		else return false;
	}
	function zaDEjsonit($handle){
		if(class_exists('ddeliveryHelper')) return ddeliveryHelper::zaDEjsonit($handle);
		else return false;
	}
	
}
?>