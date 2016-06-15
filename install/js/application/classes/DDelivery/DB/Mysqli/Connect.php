<?php
/**
 * User: dnap
 * Date: 01.10.14
 * Time: 22:04
 */

namespace DDelivery\DB\Mysqli;

class Connect extends \DDelivery\DB\Abstr\Connect {

    public function __construct(\mysqli $mysqli)
    {
        parent::__construct($mysqli);
    }

    /**
     * �������������� ������ � ���������� � ���������� ��������������� � ���� �������� ������
     * @param string $statement
     * @return Statement
     */
    public function prepare($statement)
    {
        return new Statement($statement, $this->linkIdentifier);
    }


    /**
     * ��������� SQL ������ � ���������� resource
     * @param string $query
     * @return resource
     */
    protected function _query($query)
    {
        return mysqli_query($this->linkIdentifier, $query);
    }

    /**
     * ���������� ID ��������� ����������� ������ ��� ���������������� ��������
     * @return string
     */
    public function lastInsertId()
    {
        return mysqli_insert_id($this->linkIdentifier);
    }

    /**
     * ��������� SQL ������ �� ���������� � ���������� ���������� �����, �������������� � ���� ��� ����������
     * @param string $query
     * @return int
     */
    public function exec($query)
    {
        if(!$this->_query($query)){
            return false;
        }
        return mysqli_affected_rows($this->linkIdentifier);
    }


}