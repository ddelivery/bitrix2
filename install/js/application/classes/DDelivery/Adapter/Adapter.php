<?php
/**
 * Created by PhpStorm.
 * User: mrozk
 * Date: 4/9/15
 * Time: 11:55 PM
 */

namespace DDelivery\Adapter;


use DDelivery\DB\ConnectInterface;
use DDelivery\DDeliveryException;
use DDelivery\Utils;
use PDO;

abstract class Adapter
{

    public $params;

    const SDK_VERSION = '0.9';

    const SDK_SERVER_SDK = 'http://sdk.ddelivery.ru/api/v1/';

    const SDK_SERVER_STAGE_SDK = 'http://stagesdk.ddelivery.ru/api/v1/';

    const SDK_SERVER_DEV_SDK = 'http://devsdk.ddelivery.ru/api/v1/';

    const SDK_SERVER_DEV_SDK1 = 'http://devsdk1.ddelivery.ru/api/v1/';

    const SDK_SERVER_DEV_SDK2 = 'http://devsdk2.ddelivery.ru/api/v1/';

    const FIELD_TYPE_LIST = 'list';

    const FIELD_TYPE_TEXT = 'text';

    const FIELD_TYPE_CHECKBOX = 'checkbox';

    const PARAM_PAYMENT_LIST = 'payment_list';

    const PARAM_STATUS_LIST = 'status_list';

    const DB_MYSQL = 1;

    const DB_SQLITE = 2;

    /**
     * ���� ���
     */
    const USER_FIELD_NAME = 'to_name';
    /**
     * ���� email
     */
    const USER_FIELD_EMAIL = 'to_email';
    /**
     * ���� �������
     */
    const USER_FIELD_PHONE = 'to_phone';
    /**
     * ���� �����
     */
    const USER_FIELD_STREET = 'to_street';
    /**
     * ���� ���
     */
    const USER_FIELD_HOUSE = 'to_house';
    /**
     * ���� ��������
     */
    const USER_FIELD_FLAT = 'to_flat';
    /**
     * ���� ������
     */
    const USER_FIELD_ZIP = 'to_zip';

    /**
     * ���� �����������
     */
    const USER_FIELD_COMMENT = 'comment';

    public function __construct($params = array())
    {
        $this->params = $params;
    }

    public function getEnterPoint()
    {
        return Utils::fullUrl($_SERVER, false);
    }

    public function getPathByDB()
    {
        return '../db/db.sqlite';
    }


    /**
     * ��������� ���� ������
     * @return array
     */
    public function getDbConfig()
    {
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
     * �������� ������ PDO
     *
     * @return \PDO
     * @throws DDeliveryException
     */
    public function getDb()
    {
        $dbConfig = $this->getDbConfig();
        if (isset($dbConfig['pdo']) && ($dbConfig['pdo'] instanceof \PDO || $dbConfig['pdo'] instanceof ConnectInterface)) {
            $pdo = $dbConfig['pdo'];
        } elseif ($dbConfig['type'] == self::DB_SQLITE) {
            if (!$dbConfig['dbPath']) {
                throw new DDeliveryException('SQLite db is empty');
            }
            $dbDir = dirname($dbConfig['dbPath']);

            if ((!is_writable($dbDir)) || (!is_writable($dbConfig['dbPath'])) || (!is_dir($dbDir))) {
                throw new DDeliveryException('SQLite database does not exist or is not writable');
            }

            $pdo = new \PDO('sqlite:' . $dbConfig['dbPath']);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //$pdo->exec('PRAGMA journal_mode=WAL;');
            //$pdo->errorInfo()
        } elseif ($dbConfig['type'] == self::DB_MYSQL) {
            $pdo = new \PDO($dbConfig['dsn'], $dbConfig['user'], $dbConfig['pass']);
            $pdo->exec('SET NAMES utf8');
        } else {
            throw new DDeliveryException('Not support database type');
        }
        return $pdo;
    }

    /**
     *
     * �������� ��� ����
     *
     * @return string
     * @throws \DDelivery\DDeliveryException
     */
    abstract public function getApiKey();


    /**
     *
     * ��� ������������� �������� ������� ����������
     * [
     *      'id' => 'status',
     *      'id2' => 'status2',
     * ]
     *
     * @param array $orders
     * @return bool
     */
    abstract public function changeStatus(array $orders);

    abstract public function getCmsName();

    abstract public function getCmsVersion();


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
    abstract public function getOrder($id);


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
    abstract public function getOrders($from, $to);


    /**
     *
     * �������� ���� ������������ ��� �������� �� ��������� ���
     *
     * @param $request
     * @return array
     */
    public function getUserParams($request)
    {
        if (is_array($request) && count($request) > 0) {
            foreach ($request as $key => $item) {
                if (!is_array($item)) {
                    $request[$key] = urlencode($item);
                }
            }
        }
        return $request;
    }


    /**
     *
     * �������� ������
     *
     * @return float
     */
    abstract public function getDiscount();

    /**
     *
     * �������� �������� �� �������
     *
     * @return array
     */
    abstract public function getProductCart();


    /**
     * �������� ������
     * @return float
     */
    public function getAdminDiscount()
    {
        $this->getDiscount();
    }

    /**
     *
     * �������� ������� ������ � �������
     * @return array
     */
    public function getAdminProductCart()
    {
        $this->getProductCart();
    }

    /**
     *
     * �������� ������� � ������
     *
     * @return array
     */
    public function getCartAndDiscount()
    {
        $cart = array(
            "products" => $this->getProductCart(),
            "discount" => $this->getDiscount()
        );
        return $cart;
    }

    /**
     *
     * �������� ������� � ������ � ���������������� ������
     * ��� �������������� �������
     *
     * @return array
     */
    public function getAdminCartAndDiscount()
    {

        $cart = array(
            "products" => $this->getAdminProductCart(),
            "discount" => $this->getAdminDiscount()
        );
        return $cart;
    }


    /**
     * �������� ��� ��� �������
     *
     * @return string
     */
    public function getSdkServer()
    {
        return self::SDK_SERVER_SDK;
    }

    /**
     * �������� ������ � ������������� �������� DDelivery
     * @return array
     */
    abstract public function getCmsOrderStatusList();


    /**
     * �������� ������ �� ��������� ������
     * @return array
     */
    abstract public function getCmsPaymentList();


    /***
     *
     * � ���� ������� ���������� Cms ��������� ����� ������� �������� ������������,
     * ��� ����� ��� ��� �� ���� �����  ������ ���������� ����
     * �� ��������� ���������
     *
     * @return bool
     */
    abstract public function isAdmin();

    public function getCustomSettingsFields()
    {
        return array();
    }

    /***
     *
     * ��� ������������ �������� �� ������� ���������� ���,
     * �������� � ���� �������
     *
     * @return array
     */
    function getFieldList()
    {

        $userFields = $this->getCustomSettingsFields();
        $requiredFields = array(
            array(
                "title" => "������� ������, ������� ������������� ����������� �������",
                "type" => self::FIELD_TYPE_LIST,
                "name" => self::PARAM_PAYMENT_LIST,
                "items" => $this->getCmsPaymentList(),
                "default" => 0,
                "data_type" => array("int"),
                "required" => 1
            ),
            array(
                "title" => "������ ������ ��� �������� �� ������ DDelivery.ru ",
                "type" => self::FIELD_TYPE_LIST,
                "name" => self::PARAM_STATUS_LIST,
                "items" => $this->getCmsOrderStatusList(),
                "default" => 0,
                "data_type" => array("int"),
                "required" => 1
            )
        );

        return array_merge($userFields, $requiredFields);
    }

    public function getRealUrl()
    {
        return '';
    }
} 