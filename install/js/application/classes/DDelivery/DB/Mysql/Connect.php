<?php
/**
 * User: dnap
 * Date: 01.10.14
 * Time: 22:04
 */

namespace DDelivery\DB\Mysql;

class Connect extends \DDelivery\DB\Abstr\Connect {

    /**
     * ѕодготавливает запрос к выполнению и возвращает ассоциированный с этим запросом объект
     * @param string $statement
     * @return Statement
     */
    public function prepare($statement)
    {
        return new Statement($statement, $this->linkIdentifier);
    }


    /**
     * ¬ыполн€ет SQL запрос и возвращает resource
     * @param string $query
     * @return resource
     */
    protected function _query($query)
    {
        return mysql_query($query, $this->linkIdentifier);
    }

    /**
     * ¬озвращает ID последней вставленной строки или последовательное значение
     * @return string
     */
    public function lastInsertId()
    {
        return mysql_insert_id($this->linkIdentifier);
    }

    /**
     * «апускает SQL запрос на выполнение и возвращает количество строк, задействованых в ходе его выполнени€
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