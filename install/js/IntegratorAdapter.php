<?php
use DDelivery\Adapter\Adapter;
use DDelivery\DDeliveryException;
/**
 * Created by PhpStorm.
 * User: mrozk
 * Date: 4/11/15
 * Time: 2:53 PM
 */
class IntegratorAdapter extends Adapter  {
    static $test_mode = -1;
	static $MODULE_ID = "ddelivery.ddelivery2";
	static $api_key = "";
	
	static $orderID = false;
	
	public function checkTestMode()
	{
		if (self::$test_mode == -1)
		{
			$opt = COption::GetOptionString(self::$MODULE_ID, "testMode", "Y");
			if ("Y" == $opt)
				self::$test_mode = true;
			else
				self::$test_mode = false;
		}
		return;
	}
	/**
     *
     * �������� ��� ����
     *
     * @throws DDeliveryException
     * @return string
     */ 
    public function getApiKey(){
		if (self::$api_key)
			return self::$api_key;
		
		self::checkTestMode();
		
		if (self::$test_mode)
			self::$api_key = '852af44bafef22e96d8277f3227f0998';
		else
			self::$api_key = COption::GetOptionString(self::$MODULE_ID, "token", "");
		
		return self::$api_key;
    }
    public function getPathByDB(){
        return $_SERVER["DOCUMENT_ROOT"].'/bitrix/modules/'.self::$MODULE_ID.'/private/db.sqlite';
    }
    /**
     * ��������� ���� ������
     * @return array
     */
    public function getDbConfig(){
        return array(
            'type' => self::DB_SQLITE,
            'dbPath' => $this->getPathByDB(),
            'prefix' => '',
        );
        return array(
            'pdo' => new \PDO('mysql:host=localhost;dbname=ddelivery', 'root', '0', array(\PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")),
            'prefix' => '',
        );
        return array(
            'type' => self::DB_MYSQL,
            'dsn' => 'mysql:host=localhost;dbname=ddelivery',
            'user' => 'root',
            'pass' => '0',
            'prefix' => '',
        );
    }
    /**
     *
     * ��� ������������� �������� ������� ����������
     * array(
     *      'id' => 'status',
     *      'id2' => 'status2',
     * )
     *
     * @param array $orders
     * @return bool
     */
    public function changeStatus(array $orders){
        // TODO: Implement changeStatus() method.
		CModule::IncludeModule(self::$MODULE_ID);
		
		return ddeliverydriver::updateStatuses($orders);
    }
    /**
     * �������� ��� ��� �������
     *
     * @return string
     */
    public function getSdkServer(){
		self::checkTestMode();
		
		if (self::$test_mode)
			return self::SDK_SERVER_DEV_SDK;
		else
			return self::SDK_SERVER_SDK;
    }
    public function getCmsName(){
        return 'Bitrix';
    }
    public function getCmsVersion(){
        return '1.1';
    }
    /**
     * ��������  ����� �� id
     * ['city' => ����� ����������, 'payment' => ��� ������, 'status' => ������ ������,
     * 'sum' => ����� ������, 'delivery' => ��������� ��������]
     *
     * ����� ����������, ��� ������, ����� ������, ��������� ��������
     *
     * @param $id
     * @return array
     */
    public function getOrder($id){
        return array(
            'city' => '��������',
            'payment_id' => 22,
            'payment_name' => "���������",
            'status_id' => 11,
            'status' => '������',
            'date' => '2015.12.12',
            'sum' => 2200,
            'delivery' => 220,
        );
    }
    /**
     * �������� ������ ������� �� ������
     * ['city' => ����� ����������, 'payment' => ��� ������, 'status' => '������ ������'
     * 'sum' => ����� ������, 'delivery' => ��������� ��������]
     *
     * ����� ����������, ��� ������, ����� ������, ��������� ��������
     *
     * @param $from
     * @param $to
     * @return array
     */
    public function getOrders($from, $to){
        return array(
            array(
                'city' => '��������',
                'payment_id' => 22,
                'payment_name' => "���������",
                'status_id' => 11,
                'status' => '������',
                'date' => '2015.12.12',
                'sum' => 2200,
                'delivery' => 220,
            ),
            array(
                'city' => '�. ������, ���������� �������',
                'payment_id' => 22,
                'payment_name' => "���������",
                'status_id' => 11,
                'status' => '��������',
                'date' => '2015.13.14',
                'sum' => 2100,
                'delivery' => 120,
            ),
            array(
                'city' => '���� �����',
                'payment_id' => 42,
                'payment_name' => "�����",
                'status_id' => 11,
                'status' => '��������',
                'date' => '2015.11.17',
                'sum' => 2100,
                'delivery' => 120,
            )
        );
    }
    /**
     *
     * �������� ���� ������������ ��� �������� �� ��������� ���
     *
     * @param $request
     * @return array
     */
    public function getUserParams($request){
		$params = parent::getUserParams($request);
		
		if ($request["ddelivery_street"])
			$params[self::USER_FIELD_STREET] = $request["ddelivery_street"];
		
		if ($request["ddelivery_house"])
			$params[self::USER_FIELD_HOUSE] = $request["ddelivery_house"];
		
		if ($request["ddelivery_flat"])
			$params[self::USER_FIELD_FLAT] = $request["ddelivery_flat"];
		
		if ($request["ddelivery_zip"])
			$params[self::USER_FIELD_ZIP] = $request["ddelivery_zip"];
		
		if ($request["ddelivery_comment"])
			$params[self::USER_FIELD_COMMENT] = $request["ddelivery_comment"];
		
        return $params;
    }
	
    /**
     * �������� ������ � ������
     *
     * @return float
     */
    public function getDiscount(){
        return 0;
    }
    /**
     *
     * �������� ���������� �������
     *
     * @return array
     */
    public function getProductCart()
	{
		CModule::IncludeModule(self::$MODULE_ID);
		
		$orderID = false;
		if ($_REQUEST["ORDER_ID"])
			$orderID = $_REQUEST["ORDER_ID"];
		
		return ddeliverydriver::getUserCart($orderID);
		// return array(
			// array(
				// "id"    =>  12,
				// "name"  =>  "������� �����",
				// "width" =>  10,
				// "height"=>10,
				// "length"=>10,
				// "weight"=>1,
				// "price"=>1110,
				// "quantity"=>2,
				// "sku"=>"app2"
			// )
		// );
    }
    /**
     * �������� ������ � ������������� �������� DDelivery
     * @return array
     */
    public function getCmsOrderStatusList(){
		
		CModule::IncludeModule(self::$MODULE_ID);
		
		return ddeliverydriver::GetOrderStatus();
        // return array('10' => '��������', '11' => '������');
    }
    /**
     * �������� ������ �� ��������� ������
     * @return array
     */
    public function getCmsPaymentList(){
		CModule::IncludeModule(self::$MODULE_ID);
		
		return ddeliverydriver::GetPaySystems();
        // return array('14' => '���������', '17' => '���������');
    }
    /***
     *
     * � ���� ������� ���������� Cms ��������� ����� ������� �������� ������������,
     * ��� ����� ��� ��� �� ���� �����  ������ ���������� ����
     * �� ��������� ���������
     *
     * @return bool
     */
    public function isAdmin(){
		CModule::IncludeModule(self::$MODULE_ID);
        
		return ddeliverydriver::IsAdmin();
		// return true;
    }
    /**
     * �������� ������ ��������� ����� � CAP
     *
     * @return array
     */
    public function getCustomSettingsFields(){
        // return array(
            // array(
                // "title" => "�������� (������ ���������� ����)",
                // "type" => self::FIELD_TYPE_TEXT,
                // "name" => "name",
                // // "items" => getStatusList(),
                // "default" => 0,
                // "data_type" => array("string"),
                // "required" => 1
            // ),
            // array(
                // "title" => "�������� ������ ��������(������ ���������� ����)",
                // "type" => self::FIELD_TYPE_CHECKBOX,
                // "name" => "checker",
                // "default" => true,
                // "data_type" => array("int"),
                // "required" => 1
            // )
        // );
		return array();
    }
	
	public function getModuleActions()
	{
		return array(
			/////////////////////////
			// ������� ����� ����� //
			/////////////////////////
			// ������ �������� � ���������� ������
			// "updateCities" => array("class" => "ddeliveryHelper", "admin" => true),//�������� �������������� ��� ���������//==backTown
			"AddProfilesList" => array("class" => "ddeliveryHelper", "admin" => true),//��������� ������ �������� � ���������������� ��������
			
			// ������ �������� �� ������ � �������
			"saveOrder" => array("class" => "ddeliverydriver", "admin" => true, "needBussines" => true),//��������� ��������� ������ � ������ ����� ������� "��������� � ���������"
			"sendOrder" => array("class" => "ddeliverydriver", "admin" => true, "needBussines" => true),//����� ���������� ������ saveOrder ���������� ����� � DDelivery
			"showDetail" => array("class" => "ddeliverydriver", "admin" => true, "needBussines" => true),//����� ������ ����������, ���������� �� ������, � ������ � ������
			
			"tableHandler" => array("class" => "ddeliverydriver", "admin" => true),//��������� ������� ������� � ���������� ������
			
			"getOrderInvoiceAJAX" => array("class" => "ddeliverydriver", "admin" => true),//��������� sequense_id ������� ����������
			"AJAXDocSeq" => array("class" => "ddeliverydriver", "admin" => true),//�������� ������� ���������� ����������, ������������ � documentPrint.php
			
			
			/////////////////////////////////////////////////////
			// �� ������� ����� �����, ������������ � �������� //
			/////////////////////////////////////////////////////
			// "GetBitrixCity" => array("class" => "ddeliveryHelper", "admin" => false),//�������� ����� ������� ��� ����������� �� �������� �� ������//==backTown
		);
	}
	
	// ��������� �������� �� ������
	public function performModuleAction($action, $params, $bussiness)
	{
		$success = 1;
        $data = array();
        try {
			
            $methods = $this->getModuleActions();
			
            if (empty($methods[$action])) {
                throw new \Exception('Method not found, method:'.$action);
            }
            if ($methods[$action]['admin'] && !$this->isAdmin()) {
                throw new \Exception('Access denied');
            }

            CModule::IncludeModule(self::$MODULE_ID);
			
            if (method_exists($methods[$action]["class"], $action)) {
                if (array_key_exists('needBussines', $methods[$action])) {
                    $data = $methods[$action]["class"]::$action($bussiness, $params);
                } else {
                    $data = $methods[$action]["class"]::$action($params);
                }
            } else {
                throw new \Exception('Handler not fount in class:'.$methods[$action]["class"]."::".$action);
            }


        } catch (\Exception $e) {
            $success = 0;
            $data = array(
                'message' => $e->getMessage()
            );
        }

        return json_encode(array(
            'success' => $success,
            'data' => $data
        ));
	}
}