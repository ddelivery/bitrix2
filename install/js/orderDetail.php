<?
$OrderID = $_REQUEST['ID'];
$orderinfo = CSaleOrder::GetByID($OrderID);//параметры заказа

if (!empty($orderinfo["ACCOUNT_NUMBER"]))
	$accountNumber = $orderinfo["ACCOUNT_NUMBER"];
else
	$accountNumber = $orderinfo["ID"];

if(
	COption::GetOptionString(self::$MODULE_ID,'showInOrders','Y') == 'N' &&
	!preg_match('/ddelivery:/', $orderinfo['DELIVERY_ID'])
)
	return;
	
CJSCore::Init(array("jquery"));

$prot = (
	strpos(ddeliveryHelper::toUpper($_SERVER['SERVER_PROTOCOL']),'HTTPS')!==false || 
	strpos(ddeliveryHelper::toUpper($_SERVER['HTTP_X_FORWARDED_PROTO']),'HTTPS')!==false || 
	$_SERVER['HTTPS'] == 'on')?'https':'http';
	
$GLOBALS["APPLICATION"]->AddHeadScript($prot."://sdk.ddelivery.ru/assets/js/ddelivery_v2.js");
$JSDir = "/bitrix/js/".CDeliveryddelivery::$MODULE_ID;

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
			$userProps[$key] = $arProps["VALUE"];
}

$arOrder = CSaleOrder::GetList(
	array(),
	array("ID" => $OrderID),
	false,
	false,
	array()
)->Fetch();

$userProps["payment_id"] = $arOrder["PAY_SYSTEM_ID"];
$userProps["status"] = $arOrder["STATUS_ID"];

if ("Y" == $arOrder["PAYED"])
	$userProps["payment"] = 0;
else
	$userProps["payment"] = $arOrder["PRICE"];


$dbOrderParams = sqlddeliveryOrders::select(
	array(),
	array("ORDER_ID" => $OrderID)
)->Fetch();


$arProp = ddeliveryHelper::zaDEjsonit(json_decode(ddeliveryHelper::zajsonit($dbOrderParams["PARAMS"]), true));

$ddID = $dbOrderParams["ddelivery_ID"];
if (empty($ddID))
	$ddID = "";

$accountNumber = $arOrder["ACCOUNT_NUMBER"];
if (empty($accountNumber))
	$accountNumber = $params['ORDER_ID'];
?>
<style>
	#ddelivery_mask{
		width            : 100%;
		height           : 100%;
		opacity          : 0.8;
		position         : fixed;
		z-index          : 2000;
		background-color : black;
		display          : none;
		top              : 0px;
		padding          : 5px
	}
	#ddelivery_DDelivery_widget{
		position         : absolute;
		z-index          : 2100;
		background       : white;
		display: none;
	}
	#ddelivery_container_place{
		margin: 0 20px;
		min-height: 200px;
	}
	
	#ddelivery_DDelivery_widget_top{
		height: 60px;
		background: url("/bitrix/images/ddelivery.ddelivery2/head-bg.png") repeat;
		margin-bottom: 20px;
		padding-left: 30px;
	}

	#ddelivery_DDelivery_widget_top p{
		font-size: 24px !important;
		color: #fff !important;
		line-height: 12px !important;
		padding-right: 25px !important;
		float: left !important;
	}
	
	#ddelivery_DDelivery_widget_bottom {
		padding-bottom: 10px;
	}
	
	#ddelivery_DDelivery_widget_bottom input[type='button']{
		margin-right: 15px;
	}
	#ddelivery_DDelivery_widget_info{
		color: red;
		margin-left: 15px;
	}
	
</style>
<script>
// console.log("123");

$(document).ready(function(){
	// console.log("123");
	$('.adm-detail-toolbar').find('.adm-detail-toolbar-right').prepend("<a href='javascript:void(0)' onclick='ddelivery_DDeliveryObj.selectPVZ()' class='adm-btn'><?=GetMessage('ddeliveryddelivery_JSC_SOD_BTNAME')?></a>");
	// var btn = $('[onclick="ddelivery_DDeliveryObj.selectPVZ()"]');
	// switch(ddeliveryapiship_status){
		// case 'NEW'    : break;
		// case 'uploadingError'  : btn.css('color','#F13939'); break;
		// default       : btn.css('color','#3A9640'); break;
	// }
});

if (typeof ddelivery_DDeliveryObj == "undefined")
	ddelivery_DDeliveryObj = {
		
		Mask: "ddelivery_mask",// id объекта маски
		Container: "ddelivery_DDelivery_widget",// id объектa окна с виджетом
		Widjet: "ddelivery_container_place",// id объектa с самим виджетом
		
		WidjetWidth: 900,
		WidjetHeight: 300,
		WidgetMargin: 20,
		
		orderParams: <?=CUtil::PHPToJSObject($arProp)?>,
		// orderParams: <?=CUtil::PHPToJSObject(json_decode($arProp, true))?>,
		userParams: <?=CUtil::PHPToJSObject(($userProps))?>,
		
		window: false,
		
		ddeliveryID: "<?=$ddID?>",
		
		Dialog: false,
		
		init: function()
		{
			$('body').append("<div id='"+ ddelivery_DDeliveryObj.Mask +"'></div><div id = '"+ ddelivery_DDeliveryObj.Container +"'><div id = 'ddelivery_DDelivery_widget_top'><p><?=GetMessage("ddeliveryddelivery_JSC_SOD_WNDTITLE")?></p><div id = 'ddelivery_DDelivery_widget_close' onClick = 'ddelivery_DDeliveryObj.closeWidjet();'></div></div><div id = 'ddelivery_DDelivery_widget_info'></div><div id='"+ ddelivery_DDeliveryObj.Widjet +"'></div><div id = 'ddelivery_DDelivery_widget_bottom' class = 'adm-workarea'></div></div>");
			
			var buttons = "";
			buttons += "<input type = 'button' value = '<?=GetMessage("ddeliveryddelivery_JSC_SOD_SAVESEND")?>' onClick = 'ddelivery_DDeliveryObj.sendOrder();' style = 'display: none'>";
			buttons += "<input type = 'button' value = '<?=GetMessage("ddeliveryddelivery_JSC_SOD_CLOSE")?>' onClick = 'ddelivery_DDeliveryObj.closeWidjet();'>";
			
			$("#ddelivery_DDelivery_widget_bottom").html(buttons);
		},
		
		open: function()// считаем координаты виджета
		{
			$("#"+ddelivery_DDeliveryObj.Mask).css("display", "block");
			
			// console.log($(window).height());
			// console.log(ddelivery_DDeliveryObj.WidjetHeight);
			// console.log($(window).height());
			
			$("#"+ddelivery_DDeliveryObj.Container).css({
				"width"  : (ddelivery_DDeliveryObj.WidjetWidth + ddelivery_DDeliveryObj.WidgetMargin*2)+"px",
				// "height" : ddelivery_DDeliveryObj.WidjetHeight+"px",
				"left"   : ($(window).width() - ddelivery_DDeliveryObj.WidjetWidth)/2,
				"top"    : ($(window).height() - ddelivery_DDeliveryObj.WidjetHeight)/2 + $(document).scrollTop(),
				"display": "block"
			});
			
			return true;
		},
		
		resize_event: function(data)
		{
			// console.log({"resize_event": data});
		},
		
		change: function(data)// событие из которого вытаскиваем всю инфу
		{
			var id = ddelivery_DDeliveryObj.orderParams.id;
			ddelivery_DDeliveryObj.orderParams = 
			{
				city: data.city, //: "151184"  - id города доставки
				// city_name: data.city_name, //: "г. Москва" - Город доставки
				client_price: data.client_price, //: 281.49 - Цена доставки
				company_id: data.company, //: "20" - id компании доставки
				company_name: data.company_name, //: "DPD Parcel" - Название компании доставки
				id: data.id, //: 1198 - SDK ID (не путать с ID заявки на ddelivery.ru)
				info: data.info, //: "Курьерская доставка, ул. Цветаева, 15, кв. 122, ID компании:20, г. Москва" - описание в виде строки
				payment_availability: data.payment_availability, //: 1 - возможность наложенного платежа
				point_id: data.point, //: 0 - id точки
				to_flat: data.to_flat, //: "122" - квартира
				to_house: data.to_house, //: "15" - дом
				to_street: data.to_street, //: "Цветаева" - улица
				type: data.type, //: 2 - тип доставки 1 - Самовывоз, 2 - Курьерка, 3 - Почта
			};
			
			if (typeof id != "undefined")
				ddelivery_DDeliveryObj.orderParams.id = id;
			
			$("#ddelivery_DDelivery_widget_info").html(ddelivery_DDeliveryObj.orderParams.info);
			// console.log(ddelivery_DDeliveryObj.orderParams);
		},
		
		close_map: function(data)
		{
			
		},
		
		price: function(data)// запоминаем цену
		{
			$("[onClick = 'ddelivery_DDeliveryObj.sendOrder();']").css("display", "");
		},
		
		selectPVZ: function()// нажали выбрать ПВЗ
		{
			// если заказ уже отправлен
			if (ddelivery_DDeliveryObj.ddeliveryID.length > 0)
			{
				ddelivery_DDeliveryObj.showDetail();
				return;
			}
			
			var url = "<?=$JSDir?>/ajaxSDK.php";
			url += "?action=module";
			
			var ordParams = {
				"id": ddelivery_DDeliveryObj.orderParams.id,
				"city": ddelivery_DDeliveryObj.orderParams.city,
				"ddelivery_street": ddelivery_DDeliveryObj.orderParams.to_street,
				"ddelivery_house": ddelivery_DDeliveryObj.orderParams.to_house,
				"ddelivery_flat": ddelivery_DDeliveryObj.orderParams.to_flat,
				
				"type": ddelivery_DDeliveryObj.orderParams.type,
				"company_id": ddelivery_DDeliveryObj.orderParams.company_id,
				"point_id": ddelivery_DDeliveryObj.orderParams.point_id,
				
				"info": ddelivery_DDeliveryObj.orderParams.info,
				"payment_availability": ddelivery_DDeliveryObj.orderParams.payment_availability,
			};
			
			for (var i in ordParams)
				if (typeof ordParams[i] != "undefined")
					if (ordParams[i] != "null" && ordParams[i] != "")
						url += "&"+i+"="+ordParams[i];
			
			url += "&ORDER_ID=<?=$OrderID?>";
			url += "&ACCOUNT_NUMBER=<?=$accountNumber?>";
			
			// console.log(url);
			
			var params = {
				url: url,
				width: ddelivery_DDeliveryObj.WidjetWidth,
				height: ddelivery_DDeliveryObj.WidjetHeight
			},
			callbacks = {
				resize_event:function(data){ddelivery_DDeliveryObj.resize_event(data);},
				open: function(){ddelivery_DDeliveryObj.open();return true;},
				change: function(data){ddelivery_DDeliveryObj.change(data);},
				close_map: function(data){ddelivery_DDeliveryObj.close_map();},
				price: function(data){ddelivery_DDeliveryObj.price(data);}
			}
			
			$("#"+ddelivery_DDeliveryObj.Container).css("display", "block");
			
			DDeliveryModule.init(params, callbacks, ddelivery_DDeliveryObj.Widjet);// вызываем виджет
			
			$("#ddelivery_DDelivery_widget_info").html(ddelivery_DDeliveryObj.orderParams.info);
		},
		
		sendOrder: function ()
		{
			var sendOrderButton = "[onclick='ddelivery_DDeliveryObj.sendOrder();']";
			$(sendOrderButton).val("<?=GetMessage("ddeliveryddelivery_JSC_SOD_SAVESEND_PROCESS")?>");
			$(sendOrderButton).attr("disabled", true);
			
			DDeliveryModule.sendForm({
				success:function(){
					
					// var params = ddelivery_DDeliveryObj.orderParams;
					// console.log("AJAX_SAVE");
					// console.log(ddelivery_DDeliveryObj.orderParams);
					var AJAX_data = {
						"action": "saveOrder",
						"ORDER_ID": <?=$OrderID?>,
						"PARAMS": JSON.stringify(ddelivery_DDeliveryObj.orderParams),
						"disableJSON": true // говорим, чтобы не переводилось в json в точке входа, кодировка уже будет UTF-8
						// "PARAMS": ddelivery_DDeliveryObj.orderParams
					};
					// console.log(AJAX_data);
					// return;
					$.when($.ajax({
						url: '<?=$JSDir?>/ajaxSDK.php',
						type: 'POST',
						data: AJAX_data,
						dataType: 'json',
						success : function(data){
							// console.log({"saveOrder": data});
							if (!data.success)
							{
								alert('<?=GetMessage("ddeliveryddelivery_JSC_SOD_DB_UPDATE_ERR")?>');
								console.log(data);
							}
						},
						error: function(a,b)
						{
							alert('<?=GetMessage("ddeliveryddelivery_JSC_SOD_DB_UPDATE_ERR")?>');
							console.log(a);
							console.log(b);
							
							$(sendOrderButton).val("<?=GetMessage("ddeliveryddelivery_JSC_SOD_SAVESEND")?>");
							$(sendOrderButton).attr("disabled", false);
						}
					})).done(function(){
						AJAX_data["action"] = "sendOrder";
						AJAX_data["USER_PARAMS"] = ddelivery_DDeliveryObj.userParams;
						AJAX_data["ACCOUNT_NUMBER"] = "<?=$accountNumber?>";
						$.ajax({
							url: '<?=$JSDir?>/ajaxSDK.php',
							type: 'POST',
							data: AJAX_data,
							dataType: 'json',
							success : function(data){
								// console.log({"sendOrder": data});
								if (!data.success)
								{
									alert('<?=GetMessage("ddeliveryddelivery_JSC_SOD_DB_UPDATE_ERR")?>');
									console.log(data);
									
									$("#ddelivery_DDelivery_widget_bottom").append("<br><br>" + data.data.message);
									
									return;
								}
								
								if (!data.data.is_error)
								{
									$(sendOrderButton).css("display", "none");
									alert('<?=GetMessage("ddeliveryddelivery_SOD_UPDATED")?>'+data.data.DDelivery_ID);
								}
								else
								{
									$(sendOrderButton).val("<?=GetMessage("ddeliveryddelivery_JSC_SOD_SAVESEND")?>");
									$(sendOrderButton).attr("disabled", false);
									
									console.log(data);
							
									alert('<?=GetMessage("ddeliveryddelivery_JSC_SOD_DB_UPDATE_ERR")?>');
									$("#ddelivery_DDelivery_widget_bottom").append("<br><br>" + data.data.method);
									$("#ddelivery_DDelivery_widget_bottom").append("<br><br>sdk_id:" + data.data.sdk_id);
									$("#ddelivery_DDelivery_widget_bottom").append("<br><br>" + data.data.error.error_description);
									$("#ddelivery_DDelivery_widget_bottom").append("<br><br><pre>" + data.data.params + "</pre>");
								}
							},
							error: function(a,b)
							{
								$(sendOrderButton).val("<?=GetMessage("ddeliveryddelivery_JSC_SOD_SAVESEND")?>");
								$(sendOrderButton).attr("disabled", false);
								
								alert('<?=GetMessage("ddeliveryddelivery_JSC_SOD_DB_UPDATE_ERR")?>');
								console.log(a);
								console.log(b);
								$("#ddelivery_DDelivery_widget_bottom").append("<br><br>" + a.responseText);
							}
						});
					});
				},
				error:function(){
					alert(DDeliveryModule.getErrorMsg());
					
					$(sendOrderButton).val("<?=GetMessage("ddeliveryddelivery_JSC_SOD_SAVESEND")?>");
					$(sendOrderButton).attr("disabled", false);
					
					return false;
				}
			});
		},
		
		closeWidjet: function()// закрытие виджета
		{
			$("#"+ddelivery_DDeliveryObj.Mask).css("display", "none");
			$("#"+ddelivery_DDeliveryObj.Container).css("display", "none");
			
		},
		
		showDetail: function()
		{
			if (ddelivery_DDeliveryObj.Dialog == false)
				$.when($.ajax({
					url: '<?=$JSDir?>/ajaxSDK.php',
					type: 'POST',
					data: {
						'action' : 'showDetail',
						'ORDER_ID': <?=$OrderID?> 
					},
					dataType: 'json',
					success : function(data){
						// console.log(data);
						if (data.success)
							ddelivery_DDeliveryObj.DialogHTML = data.data;
						else
						{
							console.log(data);
							ddelivery_DDeliveryObj.DialogHTML = "Order info get error";
						}
					},
					error: function(a,b)
					{
						console.log(a);
						console.log(b);
					}
				})).done(function(){
					
					ddelivery_DDeliveryObj.Dialog = new BX.CDialog({
						title: "<?=GetMessage('ddeliveryapiship_JSC_SOD_WNDTITLE')?>",
						content: ddelivery_DDeliveryObj.DialogHTML,
						icon: 'head-block',
						resizable: true,
						draggable: true,
						height: '200',
						width: '475',
						buttons: [
							'<input type=\"button\" value=\"<?=GetMessage('ddeliveryddelivery_JSC_SOD_PRNTSH')?>\"  onclick=\"ddelivery_DDeliveryObj.printDocs('+ <?=$OrderID?> +');\"/>',
						]
					});
					
					ddelivery_DDeliveryObj.Dialog.Show();
				});
			
			else
				ddelivery_DDeliveryObj.Dialog.Show();
		},
		
		printDocs: function(orderID)
		{
			var AJAX_data = {
				"action": "getOrderInvoiceAJAX",
				"orderID": orderID
			};
			
			$.ajax({
				url: '<?=$JSDir?>/ajaxSDK.php',
				type: 'POST',
				data: AJAX_data,
				dataType: 'json',
				success : function(data){
					console.log(data);
					
					if (!data.success)
					{
						console.log(data);
						alert("Get doc's sequense number error");
						return;
					}
					
					if (typeof data.data.error != "undefined")
						alert(data.data.error);
					else
						if (typeof data.data.seqID != "undefined")
							window.open('/bitrix/js/ddelivery.ddelivery2/documentPrint.php?doc_seq_id='+data.data.seqID, '_blank');
						else
							alert("Doc's sequense number is empty");
				},
				error: function(a,b)
				{
					console.log(a);
					console.log(b);
				}
			});
		}
	}
	
$(document).ready(function(){
	ddelivery_DDeliveryObj.init();
});
</script>