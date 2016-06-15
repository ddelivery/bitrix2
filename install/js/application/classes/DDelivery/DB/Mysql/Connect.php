<?php
/**
 * User: dnap
 * Date: 01.10.14
 * Time: 22:04
 */

namespace DDelivery\DB\Mysql;

class Connect extends \DDelivery\DB\Abstr\Connect {

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
        return mysql_query($query, $this->linkIdentifier);
    }

    /**
     * ���������� ID ��������� ����������� ������ ��� ���������������� ��������
     * @return string
     */
    public function lastInsertId()
    {
        return mysql_insert_id($this->linkIdentifier);
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
        return mysql_affected_rows($this->linkIdentifier);
    }



}