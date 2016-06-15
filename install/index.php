<?
#################################################
#        Company developer: ddelivery
#        Developer: Dmitry Kadrichev
#        Site: http://www.ddelivery.com
#        E-mail: om-sv2@mail.ru
#        Copyright (c) 2006-2012 ddelivery
#################################################
?>
<?
IncludeModuleLangFile(__FILE__); 

if(class_exists("ddelivery_ddelivery2")) 
    return;
	
Class ddelivery_ddelivery2 extends CModule{
    var $MODULE_ID = "ddelivery.ddelivery2";
    var $MODULE_NAME;
	var $MODULE_VERSION;
	var $MODULE_VERSION_DATE;
	var $MODULE_DESCRIPTION;
	var $MODULE_CSS;
	var $MODULE_GROUP_RIGHTS = "N";
        var $errors;

	function ddelivery_ddelivery2(){
		$arModuleVersion = array();

		$path = str_replace("\\", "/", __FILE__);
		$path = substr($path, 0, strlen($path) - strlen("/index.php"));
		include($path."/version.php"); // —оздать версию!

		$this->MODULE_VERSION = $arModuleVersion["VERSION"];
		$this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];

		$this->MODULE_NAME = GetMessage("ddeliveryddelivery_INSTALL_NAME");
		$this->MODULE_DESCRIPTION = GetMessage("ddeliveryddelivery_INSTALL_DESCRIPTION");
        
        $this->PARTNER_NAME = "ddelivery";
        $this->PARTNER_URI = "http://www.ddeliveryh.com";
	}
	
	function InstallDB(){
		global $DB, $DBType, $APPLICATION;
		$this->errors = false;
		
		// if(!$DB->Query("SELECT 'x' FROM ddelivery_ddelivery_cities", true))
			// $this->errors = $DB->RunSQLBatch($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/".$this->MODULE_ID."/install/db/mysql/install_cities.sql");
		
		// if($this->errors !== false)
		// {
			// $APPLICATION->ThrowException(implode("", $this->errors));
			// return false;
		// }
		
		if(!$DB->Query("SELECT 'x' FROM ddelivery_ddelivery", true))
			$this->errors = $DB->RunSQLBatch($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/".$this->MODULE_ID."/install/db/mysql/install.sql");
		
		if($this->errors !== false)
		{
			$APPLICATION->ThrowException(implode("", $this->errors));
			return false;
		}
		
		return true;
	}


	function UnInstallDB(){
		global $DB, $DBType, $APPLICATION;
		$this->errors = false;
		
		$this->errors = $DB->RunSQLBatch($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/".$this->MODULE_ID."/install/db/mysql/uninstall.sql");
		if(!empty($this->errors)){
			$APPLICATION->ThrowException(implode("", $this->errors));
			return false;
		}
		
		// $this->errors = $DB->RunSQLBatch($_SERVER['DOCUMENT_ROOT']."/bitrix/modules/".$this->MODULE_ID."/install/db/mysql/uninstall_cities.sql");
		// if(!empty($this->errors)){
			// $APPLICATION->ThrowException(implode("", $this->errors));
			// return false;
		// }

		return true;
	}
	
	function InstallEvents(){
		RegisterModuleDependences("main", "OnEpilog", $this->MODULE_ID, "ddeliverydriver", "onEpilog");
		RegisterModuleDependences("main", "OnEndBufferContent", $this->MODULE_ID, "CDeliveryddelivery", "onBufferContent");
		RegisterModuleDependences("sale", "OnSaleComponentOrderOneStepDelivery", $this->MODULE_ID, "CDeliveryddelivery", "pickupLoader",900);
		RegisterModuleDependences("sale", "OnSaleComponentOrderOneStepProcess", $this->MODULE_ID, "CDeliveryddelivery", "loadComponent",900);
		RegisterModuleDependences("main", "OnAdminListDisplay", $this->MODULE_ID, "ddeliverydriver", "displayActPrint");
		RegisterModuleDependences("main", "OnBeforeProlog", $this->MODULE_ID, "ddeliverydriver", "OnBeforePrologHandler");
		RegisterModuleDependences("sale", "OnSaleComponentOrderOneStepComplete", $this->MODULE_ID, "ddeliverydriver", "orderCreate"); // создание заказа
		RegisterModuleDependences("sale", "OnSaleBeforeDeliveryOrder", $this->MODULE_ID, "ddeliverydriver", "BeforeDeliveryOrder");
		RegisterModuleDependences("sale", "OnSaleDeliveryOrder", $this->MODULE_ID, "ddeliverydriver", "DeliveryOrder");
		
		return true;
	}
	function UnInstallEvents() {
		UnRegisterModuleDependences("main", "OnEpilog", $this->MODULE_ID, "ddeliverydriver", "onEpilog");
		UnRegisterModuleDependences("main", "OnEndBufferContent", $this->MODULE_ID, "CDeliveryddelivery", "onBufferContent");
		UnRegisterModuleDependences("sale", "OnSaleComponentOrderOneStepDelivery", $this->MODULE_ID, "CDeliveryddelivery", "pickupLoader",900);
		UnRegisterModuleDependences("sale", "OnSaleComponentOrderOneStepProcess", $this->MODULE_ID, "CDeliveryddelivery", "loadComponent",900);
		UnRegisterModuleDependences("main", "OnAdminListDisplay", $this->MODULE_ID, "ddeliverydriver", "displayActPrint");
		UnRegisterModuleDependences("main", "OnBeforeProlog", $this->MODULE_ID, "ddeliverydriver", "OnBeforePrologHandler");
		UnRegisterModuleDependences("sale", "OnSaleComponentOrderOneStepComplete", $this->MODULE_ID, "ddeliverydriver", "orderCreate"); // создание заказа
		UnRegisterModuleDependences("sale", "OnSaleBeforeDeliveryOrder", $this->MODULE_ID, "ddeliverydriver", "BeforeDeliveryOrder");
		UnRegisterModuleDependences("sale", "OnSaleDeliveryOrder", $this->MODULE_ID, "ddeliverydriver", "DeliveryOrder");
		
		return true;
	}

	function InstallFiles(){
		CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".$this->MODULE_ID."/install/images/", $_SERVER["DOCUMENT_ROOT"]."/bitrix/images/".$this->MODULE_ID, true, true);
		
		CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".$this->MODULE_ID."/install/js/", $_SERVER["DOCUMENT_ROOT"]."/bitrix/js/".$this->MODULE_ID, true, true);
		
		CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".$this->MODULE_ID."/install/components/", $_SERVER["DOCUMENT_ROOT"]."/bitrix/components/", true, true);
		
		CopyDirFiles($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".$this->MODULE_ID."/install/delivery/", $_SERVER["DOCUMENT_ROOT"]."/bitrix/php_interface/include/sale_delivery/", true, true);
		return true;
	}
	function UnInstallFiles(){
		DeleteDirFilesEx("/bitrix/js/".$this->MODULE_ID);
		DeleteDirFilesEx("/bitrix/images/".$this->MODULE_ID);
		DeleteDirFilesEx("/bitrix/php_interface/include/sale_delivery/delivery_ddelivery.php");
		DeleteDirFilesEx("/bitrix/components/ddelivery/ddelivery.ddelivery2Pickup");
		DeleteDirFilesEx("/upload/".$this->MODULE_ID);
		$arrayOfFiles=scandir($_SERVER['DOCUMENT_ROOT'].'/bitrix/components/ddelivery');
		$flagForDelete=true;
		foreach($arrayOfFiles as $element){
			if(strlen($element)>2)
				$flagForDelete=false;
		}
		if($flagForDelete)
			DeleteDirFilesEx("/bitrix/components/ddelivery");
		return true;
	}
	
    function DoInstall(){
        global $DB, $APPLICATION, $step;
		$this->errors = false;
		
		$this->InstallDB();
		$this->InstallEvents();
		$this->InstallFiles();
		
		RegisterModule($this->MODULE_ID);
		
        $APPLICATION->IncludeAdminFile(GetMessage("ddeliveryddelivery_INSTALL"), $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".$this->MODULE_ID."/install/step1.php");
    }

    function DoUninstall(){
        global $DB, $APPLICATION, $step;
		$this->errors = false;
		
		COption::SetOptionString($this->MODULE_ID,'logddelivery','');
		COption::SetOptionString($this->MODULE_ID,'pasddelivery','');
		COption::SetOptionString($this->MODULE_ID,'logged',false);
		 
		$this->UnInstallDB();
		$this->UnInstallFiles();
		$this->UnInstallEvents();
		
		CAgent::RemoveModuleAgents('ddelivery.ddelivery2');
		
		UnRegisterModule($this->MODULE_ID);
        $APPLICATION->IncludeAdminFile(GetMessage("ddeliveryddelivery_DEL"), $_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/".$this->MODULE_ID."/install/unstep1.php");
    }
}
?>
