<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
// header('Content-Type: text/html; charset=utf-8');

/**
 * Created by PhpStorm.
 * User: mrozk
 * Date: 4/9/15
 * Time: 11:06 PM
 */


use Bitrix\Sale;
use DDelivery\Adapter\Container;
// error_reporting(E_ALL);
// ini_set('display_errors', '1');
require(implode(DIRECTORY_SEPARATOR, array(__DIR__, 'application','bootstrap.php')));
require('IntegratorAdapter.php');

$adapter = new IntegratorAdapter();
CModule::IncludeModule("ddelivery.ddelivery2");
$container = new Container(array('adapter' => $adapter));
//$container->getBusiness()->initStorage();
$business = $container->getBusiness();

if (!$_REQUEST["disableJSON"])// война с кодировкой, не надо переводить в ddeliverydriver::saveOrder
	$_REQUEST = ddeliveryHelper::zajsonit($_REQUEST);

$keys = array_keys($adapter->getModuleActions());
$action = (isset($_REQUEST['action'])) ? $_REQUEST['action'] : '';

if(in_array($action, $keys)){
    echo ($adapter->performModuleAction($action, $_REQUEST, $business));
}else{
    ddeliveryHelper::zaDEjsonit($container->getUi()->render($_REQUEST));
}
?>