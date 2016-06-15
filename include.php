<?
$module_id = 'ddelivery.ddelivery2';

CModule::AddAutoloadClasses(
    $module_id,
    array(
        'ddeliverydriver'				 => '/classes/general/ddeliveryclass.php',
        'CDeliveryddelivery'				 => '/classes/general/ddeliverydelivery.php',
        'ddeliveryHelper'				 => '/classes/general/ddeliveryhelper.php',
		'sqlddeliveryOrders'				 => '/classes/mysql/sqlddeliveryOrders.php',
		'sqlddeliveryCities'				 => '/classes/mysql/sqlddeliveryCities.php'
        )
);
?>