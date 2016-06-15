<?
if(coption::GetOptionString(CDeliveryddelivery::$MODULE_ID,'addJQ','Y')=='Y')
	CJSCore::init('jquery');

$prot = (
	strpos(ddeliveryHelper::toUpper($_SERVER['SERVER_PROTOCOL']),'HTTPS')!==false || 
	strpos(ddeliveryHelper::toUpper($_SERVER['HTTP_X_FORWARDED_PROTO']),'HTTPS')!==false || 
	$_SERVER['HTTPS'] == 'on')?'https':'http';
	
$GLOBALS["APPLICATION"]->AddHeadScript($prot."://sdk.ddelivery.ru/assets/js/ddelivery_v2.js");

$JSDir = "/bitrix/js/".CDeliveryddelivery::$MODULE_ID;
if(ddeliveryHelper::isConverted()){
	$dTS = Bitrix\Sale\Delivery\Services\Table::getList(array(
		 'order'  => array('SORT' => 'ASC', 'NAME' => 'ASC'),
		 'filter' => array('CODE' => 'ddelivery:DDelivery')
	))->Fetch();
	$htmlId = 'ID_DELIVERY_ID_'.$dTS['ID'];
}else
	$htmlId = 'ID_DELIVERY_ddelivery_DDelivery';
?>
<script>
if (typeof ddelivery_DDeliveryObj == "undefined")
	
	ddelivery_DDeliveryObj = {
		
		pvzLabel: false,// ���� ���� ������� ����� �������
		deliveryLink: '<?=$htmlId?>',
		
		button: '<a href="javascript:void(0);" id="ddelivery_selectPVZ" onclick="ddelivery_DDeliveryObj.selectPVZ(); return false;"><?=GetMessage("ddeliveryddelivery_FRNT_CHOOSEDELIVERY")?></a>',// html ������ "������� ���".
		
		Mask: "ddelivery_mask",// id ������� �����
		Container: "ddelivery_DDelivery_widget",// id ������a ���� � ��������
		Widjet: "ddelivery_container_place",// id ������a � ����� ��������
		Confirm: "ddelivery_DDelivery_widget_confirm",
		
		WidjetWidth: 600,
		WidjetHeight: 400,
		WidgetMargin: 20,
		
		sdk_id_container: false,
		
		// curCity: "<?=$arResult["DDELIVERY_CITY"]?>",//==backTown
		oldCity: "",
		
		deliveryPrice: false,
		
		locationField: <?=CUtil::PHPToJSObject($arResult["LOCATION_FIELD"])?>,
		
		personType: '<?=$arResult["PERSON_TYPE_ID"]?>',
		addressFields: <?=CUtil::PHPToJSObject($arResult["ADDRESS_FIELDS"])?>,
		
		fieldsChanged: true,
		
		street: "",
		house: "",
		flat: "",
		PVZid: false,
		
		dostav: "<?=$arResult["DELIVERY_ID"]?>",
		
		doSubmit: false,
		
		init: function()
		{
			// ==== ������������� �� ������������ �����
			if(typeof BX !== 'undefined' && BX.addCustomEvent)
				BX.addCustomEvent('onAjaxSuccess', ddelivery_DDeliveryObj.onLoad);
			
			// ��� ������� JS-����
			if (window.jsAjaxUtil) // ��������������� Ajax-����������� ������� ��� ����������� js-������� ����� ��-���
			{
				jsAjaxUtil._CloseLocalWaitWindow = jsAjaxUtil.CloseLocalWaitWindow;
				jsAjaxUtil.CloseLocalWaitWindow = function (TID, cont)
				{
					jsAjaxUtil._CloseLocalWaitWindow(TID, cont);
					ddelivery_DDeliveryObj.onLoad();
				}
			}
			// == END
			
			ddelivery_DDeliveryObj.onLoad();
			
			// html �����
			$('body').append("<div id='"+ ddelivery_DDeliveryObj.Mask +"'></div><div id = '"+ ddelivery_DDeliveryObj.Container +"'><div id = 'ddelivery_DDelivery_widget_top'><p><?=GetMessage("ddeliveryddelivery_Widjet_Title")?></p><div id = 'ddelivery_DDelivery_widget_close' onClick = 'ddelivery_DDeliveryObj.closeWidjet();'></div></div><div id='"+ ddelivery_DDeliveryObj.Widjet +"'></div><div id = '"+ ddelivery_DDeliveryObj.Confirm +"' onClick = 'ddelivery_DDeliveryObj.checkField();'><?=GetMessage("ddeliveryddelivery_Widjet_Confirm")?></div><div style = 'clear:both;'></div><div id = 'ddelivery_DDelivery_widget_bottom'><a href = 'ddelivery.ru' target = '_blank'><?=GetMessage("ddeliveryddelivery_Widjet_Link")?></a></div></div>");
			
			$("#ORDER_FORM").append("<input type = 'hidden' name = 'ddelivery_price' id = 'ddelivery_price' value>");
		},
		
		onLoad: function()
		{
			<?if(COption::GetOptionString(CDeliveryddelivery::$MODULE_ID,'pvzID',false)){?>
				tag = $('#<?=COption::GetOptionString(CDeliveryddelivery::$MODULE_ID,'pvzID','')?>');
				if(tag.hasClass('ddelivery_custom_button'))
					tag.click(function(){ ddelivery_DDeliveryObj.selectPVZ(); });
			<?}else{?>
				var parentNd=$('#'+ddelivery_DDeliveryObj.deliveryLink);
				if(parentNd.closest('td', '#ORDER_FORM').length>0)
					tag = parentNd.closest('td', '#ORDER_FORM').siblings('td:last');
				else
					tag = parentNd.siblings('label').find('.bx_result_price');
			<?}?>
			
			if(tag.length > 0 && tag.html().indexOf(ddelivery_DDeliveryObj.button)===-1)
				ddelivery_DDeliveryObj.pvzLabel = tag;
			
			
			
			//== curTown
			// var city = $("#ddelivery_city").val();
			// if (typeof city != "undefined" && city.length > 0)
			// {
				// if (city != ddelivery_DDeliveryObj.curCity)
					// ddelivery_DDeliveryObj.oldCity = ddelivery_DDeliveryObj.curCity;
				// ddelivery_DDeliveryObj.curCity = city;
			// }
			
			var personType = $("#ddelivery_personType").val();
			if (typeof personType != "undefined" && personType.length > 0)
				ddelivery_DDeliveryObj.personType = personType;
			
			var addrFields = ddelivery_DDeliveryObj.addressFields[ddelivery_DDeliveryObj.personType];
			for (var i in addrFields)
				$("[name=ORDER_PROP_" + addrFields[i] + "]").on("change", function(){
					ddelivery_DDeliveryObj.fieldsChanged = true;
				});
			
			var dostav = $("#ddelivery_dostav").val();
			if (typeof dostav != "undefined" && dostav.length > 0)
				ddelivery_DDeliveryObj.dostav = dostav;
			
			ddelivery_DDeliveryObj.ChangeLabelHTML();
		},
		
		resize_event: function(data)
		{
			// console.log("resize");
			// console.log(data);
			ddelivery_DDeliveryObj.WidjetWidth = data.width;
			ddelivery_DDeliveryObj.WidjetHeight = data.height;
			ddelivery_DDeliveryObj.resize_widjet();
			$("#"+ddelivery_DDeliveryObj.Confirm).css("display", "block");
		},
		
		open: function()// ������� ���������� �������
		{
			ddelivery_DDeliveryObj.resize_widjet();
			$("#"+ddelivery_DDeliveryObj.Mask).css("display", "block");
			$("#"+ddelivery_DDeliveryObj.Container).css("display", "block");
		},
		
		
		
		resize_widjet: function()
		{
			$("#"+ddelivery_DDeliveryObj.Container).css({
				"width"  : (ddelivery_DDeliveryObj.WidjetWidth + ddelivery_DDeliveryObj.WidgetMargin*2)+"px",
				"left"   : ($(window).width() - (ddelivery_DDeliveryObj.WidjetWidth + ddelivery_DDeliveryObj.WidgetMargin*2))/2,
				"top"    : $(document).scrollTop()
			});
		},
		
		change: function(data)// ������� �� �������� ����������� ��� ����
		{
			// console.log(data);
			//== backTown
			// if (data.city != ddelivery_DDeliveryObj.curCity)
			// {
				// ddelivery_DDeliveryObj.oldCity = ddelivery_DDeliveryObj.curCity;
				// ddelivery_DDeliveryObj.curCity = data.city;
			// }
		
			ddelivery_DDeliveryObj.street = data.to_street;
			ddelivery_DDeliveryObj.house = data.to_house;
			ddelivery_DDeliveryObj.flat = data.to_flat;
			
			var container_id = $("#ddelivery_sdk_container_id");
			if (container_id.length <= 0)
				$("#ORDER_FORM").append("<input type='hidden' value = '' name = 'ddelivery_sdk_container_id' id = 'ddelivery_sdk_container_id'>");
			
			var dataSave = 
			{
				city: data.city, //: "151184"  - id ������ ��������
				city_name: data.city_name, //: "�. ������" - ����� ��������
				client_price: data.client_price, //: 281.49 - ���� ��������
				company_id: data.company, //: "20" - id �������� ��������
				company_name: data.company_name, //: "DPD Parcel" - �������� �������� ��������
				id: data.id, //: 1198 - SDK ID (�� ������ � ID ������ �� ddelivery.ru)
				info: data.info, //: "���������� ��������, ��. ��������, 15, ��. 122, ID ��������:20, �. ������" - �������� � ���� ������
				payment_availability: data.payment_availability, //: 1 - ����������� ����������� �������
				point_id: data.point, //: 0 - id �����
				to_flat: data.to_flat, //: "122" - ��������
				to_house: data.to_house, //: "15" - ���
				to_street: decodeURIComponent(decodeURIComponent(data.to_street)), //: "��������" - �����
				type: data.type, //: 2 - ��� �������� 1 - ���������, 2 - ��������, 3 - �����
			};
			
			if (data.point != "undefined" && data.point != 0 && data.type == 1)
			{
				ddelivery_DDeliveryObj.PVZid = data.point;
				ddelivery_DDeliveryObj.street = data.info;
				ddelivery_DDeliveryObj.house = "-";
				ddelivery_DDeliveryObj.flat = "-";
			}
			
			$("#ddelivery_sdk_container_id").val(JSON.stringify(dataSave));
		},
		
		close_map: function(data)
		{
			// console.log("close_map");
			// console.log(data);
		},
		
		price: function(data)// ���������� ����
		{
			// console.log("price");
			// console.log(data);
			
			ddelivery_DDeliveryObj.deliveryPrice = data.price;
		},
		
		selectPVZ: function()// ������ ������� ���
		{
			// ���� ���� ��������� � ����� ������ ��� ������ ����������� ������, ��� - ������ ����������
			// console.log(ddelivery_DDeliveryObj.oldCity);
			// console.log(ddelivery_DDeliveryObj.curCity);
			// console.log(ddelivery_DDeliveryObj.fieldsChanged);
			// if (!ddelivery_DDeliveryObj.fieldsChanged && (ddelivery_DDeliveryObj.oldCity == ddelivery_DDeliveryObj.curCity || ddelivery_DDeliveryObj.oldCity == ""))
			// {
				// $("#"+ddelivery_DDeliveryObj.Mask).css("display", "block");
				// $("#"+ddelivery_DDeliveryObj.Container).css("display", "block");
				// $("#"+ddelivery_DDeliveryObj.Confirm).css("display", "block");
				
				// return;
			// }
			
			ddelivery_DDeliveryObj.fieldsChanged = false;
			
			// �������� ����� + ��������� ����� � ���������
			var req_str = "";
			var addrFields = ddelivery_DDeliveryObj.addressFields[ddelivery_DDeliveryObj.personType];
			
			for (var i in addrFields)
			{
				if (i != "address")
				{
					var value = $("[name=ORDER_PROP_" + addrFields[i] + "]");
					
					if (typeof value != "undefined")
						if (value.length > 0)
						{
							value = value.val();
					
							req_str += "&ddelivery_" + i + "=" + value;
							ddelivery_DDeliveryObj[i] = value;
						}
				}
			}
			// console.log(req_str);
			//== backTown
			// var url = "<?=$JSDir?>"+"/ajaxSDK.php?action=module&city="+ddelivery_DDeliveryObj.curCity+req_str;
			var url = "<?=$JSDir?>"+"/ajaxSDK.php?action=module"+req_str;
			console.log(url);
			
			var params = {
				url: url,
				width: ddelivery_DDeliveryObj.WidjetWidth,
				height: ddelivery_DDeliveryObj.WidjetHeight
			},
			callbacks = {
				resize_event:function(data){
					// ������� ��� ��������� �������� ������
					// � ������� data ����� �������
					ddelivery_DDeliveryObj.resize_event(data);
				},
				open: function(){
					// ��� �� �������� ����;

					ddelivery_DDeliveryObj.open();
					return true;
				},
				change: function(data){
					// ��� �� ��������� ���������� ������ � ��������� ����������;
					// sdk_id_container.value = data.id;
					ddelivery_DDeliveryObj.change(data);
				},
				close_map: function(data){
					// ��� �� �������� �����
					ddelivery_DDeliveryObj.close_map(data);
				},
				price: function(data){
					// ��� �� ��������� ���� ������� �������� ��� ������������
					// � ����������� ��� � ���� ������
					ddelivery_DDeliveryObj.price(data);
				}
			}
			
			$("#"+ddelivery_DDeliveryObj.Container).css("display", "block");
			// �������� ������
			DDeliveryModule.init(params, callbacks, ddelivery_DDeliveryObj.Widjet);
		},
		
		ChangeLabelHTML: function()// ����������� ������ � ����� ������� ���
		{
			var ddeliveryName = "DDelivery";
			<?if (ddeliveryHelper::isConverted()){?>
				ddeliveryName = "<?=$dTS['ID']?>";
			<?}?>
			
			var addrInputName = ddelivery_DDeliveryObj.addressFields[ddelivery_DDeliveryObj.personType].address;
			var addrInput = $("#ORDER_PROP_"+addrInputName);
					
			if (ddelivery_DDeliveryObj.dostav == ddeliveryName)
				if (ddelivery_DDeliveryObj.street != "")
					if (typeof addrInput != "undefined")
						if (addrInput.length > 0)
						{
							addressText = "";
							if (ddelivery_DDeliveryObj.house == "-" && ddelivery_DDeliveryObj.flat == "-")
								addressText += ddelivery_DDeliveryObj.street;
							else
								addressText += ddelivery_DDeliveryObj.street + ", " + ddelivery_DDeliveryObj.house + ", " + ddelivery_DDeliveryObj.flat;
							
							addrInput.html(addressText);
							addrInput.attr("readonly", true);
						}
			else
				if (typeof addrInput != "undefined")
					if (addrInput.length > 0)
						addrInput.attr("readonly", false);

			
			
			if (!ddelivery_DDeliveryObj.pvzLabel)
				return;
			
			var tmpHTML = "<div class='ddelivery_pvzLair'>"+ddelivery_DDeliveryObj.button;
			
			if (typeof ddelivery_DDeliveryObj.deliveryPrice != "undefined" && ddelivery_DDeliveryObj.deliveryPrice != 0)
			{
				tmpHTML += "<div>";
				tmpHTML += "<?=GetMessage("ddeliveryddelivery_FRNT_DELIVERY_PRICE")?>";
				tmpHTML += ddelivery_DDeliveryObj.deliveryPrice;
				tmpHTML += "<?=GetMessage("ddeliveryddelivery_FRNT_CURRENCY_RUB")?>";
				tmpHTML += "</div>";
			}
			
			tmpHTML += "</div>";
			
			ddelivery_DDeliveryObj.pvzLabel.html(tmpHTML);
		},
		
		checkField: function(field)
		{
			DDeliveryModule.sendForm({
				success:function(){
					ddelivery_DDeliveryObj.confirmWidjet();
				},
				error:function(){
					alert(DDeliveryModule.getErrorMsg());
					return false;
				}
			});
		},
		
		confirmWidjet: function()// �������� �������
		{
			// ������ � ����� ����
			$("#ddelivery_price").val(ddelivery_DDeliveryObj.deliveryPrice);
			
			/*
			//==backTown
			// ���� id ������ � ddelivery ��� ������ �� ��������
			var ajaxData = {
				"action": "GetBitrixCity",
				"ddID": ddelivery_DDeliveryObj.curCity
			};
			// console.log(ajaxData);
			// ���������� �����
			$.when($.ajax({
				url: "<?=$JSDir?>/ajaxSDK.php",
				type: "POST",
				dataType: "json",
				data: ajaxData,
				success: function(data){
					// console.log(data);
					if (data.success)
						ddelivery_DDeliveryObj.locationID = data.data.ID;
				},
				error: function(a, b)
				{
					console.log(a);
					console.log(b);
				}
			})).done(function(){
				
			*/
				// ������ �����
				$("#"+ddelivery_DDeliveryObj.Mask).css("display", "none");
				$("#"+ddelivery_DDeliveryObj.Container).css("display", "none");
				$("#"+ddelivery_DDeliveryObj.Confirm).css("display", "none");
				
				// ���������� ����� ����� //==backTown
				// $("[name=ORDER_PROP_"+ddelivery_DDeliveryObj.locationField[ddelivery_DDeliveryObj.personType]+"]").val(ddelivery_DDeliveryObj.locationID);
				
				// ������ ���� ����� ��� ��������
				var addrFields = ddelivery_DDeliveryObj.addressFields[ddelivery_DDeliveryObj.personType];
			
				for (var i in addrFields)
				{
					var value = $("[name=ORDER_PROP_" + addrFields[i] + "]").val();
					if (ddelivery_DDeliveryObj[i] != value)
						$("[name=ORDER_PROP_" + addrFields[i] + "]").val(ddelivery_DDeliveryObj[i]);
				}
			
				// ��������� �����
				if(typeof isAjax == 'undefined')
				{ // ������������� ����� (� ����������� ����� ��������� ��������)
					if(typeof ddeliveryddelivery_DeliveryChangeEvent == 'function')
						ddeliveryddelivery_DeliveryChangeEvent();
					else{
						if(typeof $.prop == 'undefined') // <3 jquery
							$('#'+ddelivery_DDeliveryObj.deliveryLink).attr('checked', 'Y');
						else
							$('#'+ddelivery_DDeliveryObj.deliveryLink).prop('checked', 'Y');
						$('#'+ddelivery_DDeliveryObj.deliveryLink).click();
					}
				}
			// });//==backTown
			
		},
		
		closeWidjet: function()
		{
			$("#"+ddelivery_DDeliveryObj.Mask).css("display", "none");
			$("#"+ddelivery_DDeliveryObj.Container).css("display", "none");
		}
		
	}
	

$(document).ready(function(){
	ddelivery_DDeliveryObj.init();
	$(window).on("resize", function(){ddelivery_DDeliveryObj.resize_widjet()});
	
	// �� ���� ��������� �����, ���� ������� ddelivery � �� ��������� ������ dataSave
	$("#ORDER_FORM").on("submit", function(e){
		var dataSave = $("#ddelivery_sdk_container_id").val(),
			confirmorder = $("#confirmorder").val();
		
		if (typeof dataSave == "undefined" && ddelivery_DDeliveryObj.dostav == "ddelivery:DDelivery" && confirmorder == "Y")
		{
			// console.log("stop");
			ddelivery_DDeliveryObj.selectPVZ();
			$("#confirmorder").val("N");
		}
	});
});


</script>