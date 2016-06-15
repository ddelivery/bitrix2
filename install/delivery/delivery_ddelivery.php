<?
$module_id="ddelivery.ddelivery2";
CModule::IncludeModule($module_id);

// установим метод CDeliveryddelivery::Init в качестве обработчика события
if(file_exists($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.$module_id.'/classes/general/ddeliverydelivery.php'))
	AddEventHandler("sale", "onSaleDeliveryHandlersBuildList", array('CDeliveryddelivery', 'Init')); 
?>