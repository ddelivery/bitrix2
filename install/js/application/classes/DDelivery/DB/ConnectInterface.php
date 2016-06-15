<?php
/**
 * User: dnap
 * Date: 01.10.14
 * Time: 22:03
 */

namespace DDelivery\DB;

/**
 * ������� ��������� PDO
 * Interface MysqlInterface
 * @package DDelivery\DB
 */
interface ConnectInterface {
    /**
     * �������������� ������ � ���������� � ���������� ��������������� � ���� �������� ������
     * @param string $statement
     * @return StatementInterface
     */
    public function prepare($statement);

    /**
     * @return bool
     */
    public function beginTransaction();

    /**
     * @return bool
     */
    public function commit();

    /**
     * @return bool
     */
    public function rollBack();

    /**
     * ��������� SQL ������ �� ���������� � ���������� ���������� �����, �������������� � ���� ��� ����������
     * @param string $query
     * @return int
     */
    public function exec($query);

    /**
     * ��������� SQL ������ � ���������� �������������� ����� � ���� ������� StatementInterface
     * @param string $query
     * @return StatementInterface
     */
    public function query($query);

    /**
     * ���������� ID ��������� ����������� ������ ��� ���������������� ��������
     * @return string
     */
    public function lastInsertId();

    /**
     * ��������� ������ � ������� � ���������� ����������� �������
     * @param $string
     * @return string
     */
    //public function quote($string);
}
