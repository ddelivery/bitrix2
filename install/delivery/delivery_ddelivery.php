<?
$module_id="ddelivery.ddelivery2";
CModule::IncludeModule($module_id);

// ��������� ����� CDeliveryddelivery::Init � �������� ����������� �������
if(file_exists($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/'.$module_id.'/classes/general/ddeliverydelivery.php'))
	AddEventHandler("sale", "onSaleDeliveryHandlersBuildList", array('CDeliveryddelivery', 'Init')); 
?>