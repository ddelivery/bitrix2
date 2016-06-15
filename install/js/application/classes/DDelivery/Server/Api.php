<?php
/**
 * Created by PhpStorm.
 * User: mrozk
 * Date: 4/10/15
 * Time: 8:05 PM
 */

namespace DDelivery\Server;


use DDelivery\Adapter\Adapter;

class Api
{

    public $apiKey;

    public $apiServer;

    /**
     * @var CurlProvider
     */
    public $curlProvider;

    public function __construct($apiKey, $apiServer, $curlProvider)
    {
        $this->apiKey = $apiKey;
        $this->apiServer = $apiServer;
        $this->curlProvider = $curlProvider;
    }

    /**
     * @param $token
     * @return array
     */
    public function checkHandshakeToken($token)
    {
        $params = array(
            'token' => $token
        );
        return (array)$this->curlProvider->processGet($this->getUrl('passport', 'handshake'), $params);
    }


    /**
     *
     * ���������� ����� �� ������ DDelivery.ru
     *
     * @param $sdkId - ������������� �� ������� ���������� ��� ���������� ������
     * @param $cmsId - ������������� ������ � CMS
     * @param $payment_variant - ������� ������(�������������)
     * @param $status - ������ ������(�������������)
     * @param $payment_price - ���������� ������ [0,1](���, ��)
     * @param $to_name - ��� ����������
     * @param $to_phone - ������� ����������
     * @param $to_email - email ����������
     *
     * @param string $comment
     * @param float|int $payment_price_value
     * @return array
     */
    public function sendOrder(
        $sdkId, $cmsId, $payment_variant, $status,
        $payment_price, $to_name, $to_phone, $to_email,
        $comment = '', $payment_price_value = 0
    ) {
        $params = array(
            'id' => $sdkId,
            'shop_refnum' => $cmsId,
            'payment_variant' => $payment_variant,
            'local_status' => $status,
            'payment_price' => $payment_price,
            'payment_price_value' => $payment_price_value,
            Adapter::USER_FIELD_NAME => $to_name,
            Adapter::USER_FIELD_PHONE => $to_phone,
            Adapter::USER_FIELD_EMAIL => $to_email,
            Adapter::USER_FIELD_COMMENT => $comment
        );

        return (array)$this->curlProvider->processPost($this->getUrl('order', 'send'), $params);
    }


    /**
     *
     * ����������� ����� �� ������� DDelivery.ru(���� ������ ����������)
     *
     * @param $sdkId - ������������� �� ������� ���������� ��� ���������� ������
     * @param $cmsId - ������������� ������ � CMS
     * @param $payment_variant - ������� ������(�������������)
     * @param $status - ������ ������(�������������)
     * @param $payment_price - ���������� ������ [0,1](���, ��)
     * @param $to_name - ��� ����������
     * @param $to_phone - ������� ����������
     * @param $to_email - email ����������
     *
     * @param string $comment
     * @param float|int $payment_price_value
     * @return array
     */
    public function changeOrder(
        $sdkId, $cmsId, $payment_variant, $status,
        $payment_price, $to_name, $to_phone, $to_email,
        $comment = '', $payment_price_value = 0
    ) {
        $params = array(
            'id' => $sdkId,
            'shop_refnum' => $cmsId,
            'payment_variant' => $payment_variant,
            'local_status' => $status,
            'payment_price' => $payment_price,
            'payment_price_value' => $payment_price_value,
            Adapter::USER_FIELD_NAME => $to_name,
            Adapter::USER_FIELD_PHONE => $to_phone,
            Adapter::USER_FIELD_EMAIL => $to_email,
            Adapter::USER_FIELD_COMMENT => $comment
        );

        return (array)$this->curlProvider->processPost($this->getUrl('order', 'change'), $params);
    }


    /**
     * �������� ���������� � ������
     *
     * @param $sdkId
     * @return array
     */
    public function viewOrder($sdkId)
    {
        $params = array(
            'id' => $sdkId
        );
        return (array)$this->curlProvider->processPost($this->getUrl('order', 'view'), $params);
    }


    /**
     *
     * ����������� ����� �� ������� ���
     *
     * @param $sdkId - ������������� �� ������� ���������� ��� ���������� ������
     * @param $cmsId - ������������� ������ � CMS
     * @param $payment_variant - ������� ������(�������������)
     * @param $status - ������ ������(�������������)
     * @param $to_name - ��� ����������
     * @param $to_phone - ������� ����������
     * @param $to_email - email ����������
     *
     * @param $payment_price
     * @param string $comment
     * @return array
     */
    public function editOrder(
        $sdkId, $cmsId, $payment_variant, $status,
        $to_name, $to_phone, $to_email,
        $payment_price, $comment = ''
    ) {
        $params = array(
            'id' => $sdkId,
            'shop_refnum' => $cmsId,
            'payment_variant' => $payment_variant,
            'local_status' => $status,
            Adapter::USER_FIELD_NAME => $to_name,
            Adapter::USER_FIELD_PHONE => $to_phone,
            Adapter::USER_FIELD_EMAIL => $to_email,
            Adapter::USER_FIELD_COMMENT => $comment
        );
        return (array)$this->curlProvider->processPost($this->getUrl('order', 'edit'), $params);
    }

    /**
     *
     * �������� ������ � ���
     *
     * @param $token
     * @param string $realUrl
     * @return array
     */
    public function accessAdmin($token, $realUrl = '')
    {
        $params = array(
            'token' => $token,
            'real_url' => $realUrl
        );
        return (array)$this->curlProvider->processGet($this->getUrl('passport', 'auth'), $params);
    }

    public function pushCart(array $cart)
    {
        return (array)$this->curlProvider->processJson($this->getUrl('passport', 'shop'), $cart);
    }

    public function pushOrderEditCart(array $cart, $id)
    {
        $cart['id'] = $id;
        return (array)$this->curlProvider->processPost($this->getUrl('passport', 'order'), $cart);
    }


    public function getUrl($controller, $method)
    {
        return $this->apiServer . $controller . '/' . $this->apiKey . '/' . $method . '.json';
    }
} 