<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

if(!cmodule::includeModule('ddelivery.ddelivery2'))
	return false;
if(!cmodule::includeModule('sale'))
	return false;

// $arResult["DDELIVERY_CITY"] = CDeliveryddelivery::$ddeliveryLocationTo;//==backTown

$arAdrFields = array(
	"street" => COption::GetOptionString(CDeliveryddelivery::$MODULE_ID, "street", "STREET"),
	"house" => COption::GetOptionString(CDeliveryddelivery::$MODULE_ID, "house", "HOUSE"),
	"flat" => COption::GetOptionString(CDeliveryddelivery::$MODULE_ID, "flat", "FLAT"),
	"address" => COption::GetOptionString(CDeliveryddelivery::$MODULE_ID, "address", "ADDRESS")
);

$arProps = CSaleOrderProps::GetList(
	array(),
	array()
);

while ($arProp = $arProps->Fetch())
{
	foreach ($arAdrFields as $code => $field)
		if ($arProp["CODE"] == $field)
			$arResult["ADDRESS_FIELDS"][$arProp["PERSON_TYPE_ID"]][$code] = $arProp["ID"];
		
	if ("Y" == $arProp["IS_LOCATION"])
		$arResult["LOCATION_FIELD"][$arProp["PERSON_TYPE_ID"]] = $arProp["ID"];
}

$arResult["PERSON_TYPE_ID"] = CDeliveryddelivery::$personType;
$arResult["DELIVERY_ID"] = CDeliveryddelivery::$selectedDelivery;


$this->IncludeComponentTemplate();
?>