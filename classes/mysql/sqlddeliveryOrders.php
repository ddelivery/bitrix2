<?
class sqlddeliveryOrders
{
	public function ddeliveryLog($wat,$sign){ddeliverydriver::ddeliveryLog($wat,$sign);}
	private static $tableName = "ddelivery_ddelivery";
	public static function Add($Data)
    {
        // = $Data = format:
		// PARAMS - ALL INFO
		// ORDER_ID - corresponding order
		// STATUS - response from iml
		// MESSAGE - info from server
		// BARCODE && ENCBARCODE - recieved from logistics
		// OK - 0 / 1 - was confirmed
		// UPTIME - время добавления
		
		global $DB;
        
		if(!$Data['STATUS'])
			$Data['STATUS']='NEW';
		if($Data['STATUS']=='NEW')
			$Data['MESSAGE']='';
		if(is_array($Data['PARAMS'])) {
			$Data['PARAMS'] = serialize($Data['PARAMS']);
		}
		
		$Data['UPTIME']=mktime();
			
		$rec = self::CheckRecord($Data['ORDER_ID']);
		if($rec)
		{
			$strUpdate = $DB->PrepareUpdate(self::$tableName, $Data);
			$strSql = "UPDATE ".self::$tableName." SET ".$strUpdate." WHERE ID=".$rec['ID'];
			$DB->Query($strSql, false, $err_mess.__LINE__);
		}
		else
		{
			$arInsert = $DB->PrepareInsert(self::$tableName, $Data);
			$strSql =
				"INSERT INTO ".self::$tableName."(".$arInsert[0].") ".
				"VALUES(".$arInsert[1].")";
			$DB->Query($strSql, false, "File: ".__FILE__."<br>Line: ".__LINE__);
		}
		return self::CheckRecord($Data['ORDER_ID']); 
    }
	
	public static function select($arOrder=array("ID","DESC"),$arFilter=array(),$arNavStartParams=array())
	{
		global $DB;
		
		$strSql='';
		
		$where='';
		if(strpos($arFilter['>=UPTIME'],".")!==false)
			$arFilter['>=UPTIME']=strtotime($arFilter['>=UPTIME']);
		if(strpos($arFilter['<=UPTIME'],".")!==false)
			$arFilter['<=UPTIME']=strtotime($arFilter['<=UPTIME']);

	 	if(count($arFilter)>0)
			foreach($arFilter as $field => $value)
			{
				if(strpos($field,'!')!==false)
					$where.=' and '.substr($field,1).' != "'.$value.'"';
				elseif(strpos($field,'<=')!==false)
					$where.=' and '.substr($field,2).' <= "'.$value.'"';				
				elseif(strpos($field,'>=')!==false)
					$where.=' and '.substr($field,2).' >= "'.$value.'"';
				elseif(strpos($field,'>')!==false)
					$where.=' and '.substr($field,1).' > "'.$value.'"';				
				elseif(strpos($field,'<')!==false)
					$where.=' and '.substr($field,1).' < "'.$value.'"';
				else
				{
					if(is_array($value))
					{
						$where.=' and (';
						foreach($value as $val)
							$where.=$field.' = "'.$val.'" or ';
						$where=substr($where,0,strlen($where)-4).")";
					}
					else
						$where.=' and '.$field.' = "'.$value.'"';
				}
			}
			
		
		if($where) 
			$strSql.="
			WHERE ".substr($where,4);
			
		if(in_array($arOrder[0],array('ID','ORDER_ID','STATUS','UPTIME'))&&($arOrder[1]=='ASC'||$arOrder[1]=='DESC'))
			$strSql.="
			ORDER BY ".$arOrder[0]." ".$arOrder[1];
		
		$cnt=$DB->Query("SELECT COUNT(*) as C FROM ".self::$tableName." ".$strSql, false, $err_mess.__LINE__)->Fetch();
		
		if($arNavStartParams['nPageSize']==0)
			$arNavStartParams['nPageSize']=$cnt['C'];
		
		
		$strSql="SELECT * FROM ".self::$tableName." ".$strSql;
		// die(preDDK($strSql, true));
		$res = new CDBResult();
		$res->NavQuery($strSql,$cnt['C'],$arNavStartParams);

		return $res;
	}
		
	public static function Delete($orderId)
    {
		global $DB;
		$orderId = $DB->ForSql($orderId);
		$strSql =
            "DELETE FROM ".self::$tableName." 
            WHERE ORDER_ID='".$orderId."'";
		$DB->Query($strSql, true);
        
        return true; 
    }
	
	public static function GetByOI($orderId)
	{
		global $DB;
		$orderId=$DB->ForSql($orderId);
		$strSql =
            "SELECT PARAMS, STATUS, ddelivery_ID, MESSAGE, OK, MESS_ID ".
            "FROM ".self::$tableName." ".
			"WHERE ORDER_ID = '".$orderId."'";
		$res = $DB->Query($strSql, false, "File: ".__FILE__."<br>Line: ".__LINE__);
		$arReturn=array();
		if($arr = $res->Fetch())
			return $arr;
		else return false;
	}
	
	public static function CheckRecord($orderId)
	{
		global $DB;
		
		$orderId = $DB->ForSql($orderId);
        $strSql =
            "SELECT ID, STATUS ".
            "FROM ".self::$tableName." ".
			"WHERE ORDER_ID = '".$orderId."'";
	
		$res = $DB->Query($strSql, false, "File: ".__FILE__."<br>Line: ".__LINE__);
		if($res)
		{
			if($arr = $res->Fetch())
				return $arr;
		}
		return false;
	}
	
	public static function update($arFilter, $arFields)
	{
		$strSql = "UPDATE ". self::$tableName. " ";
		
		$set = "";
		foreach ($arFields as $key => $field)
		{
			if (!$set)
				$set .= "SET ";
			else
				$set .= ", ";
			
			$set .= $key."=";
			if (is_numeric($field))
				$set .= $field;
			else
				$set .= "'".$field."'";
		}
		
		$where = "";
		foreach ($arFilter as $key => $field)
		{
			if (!$where)
				$where .= "WHERE ";
			
			$where .= $key."=".$field;
		}
		
		if ($set)
		{
			$strSql .= $set." ".$where;
			
			global $DB;
			
			$DB->Query($strSql, false, "SQL error: ". __FILE__ . __LINE__);
			return true;
		}
		
		return false;
	}
	
	public static function updateStatus($arParams){
		global $DB;
		foreach($arParams as $key => $val)
			$arParams[$key] = $DB->ForSql($val);

		$okStat='';
		if($arParams["STATUS"]=='OK')
			$okStat=" OK='1',";
		elseif($arParams["STATUS"]=='DELETE')
			$okStat=" OK='',";

		$setStr = "STATUS ='".$arParams["STATUS"]."', MESSAGE = '".$arParams["MESSAGE"]."',";
		if($arParams["ddelivery_ID"])
			$setStr.="ddelivery_ID = '".$arParams["ddelivery_ID"]."',";
		if($arParams["MESS_ID"])
			$setStr.="MESS_ID = '".$arParams["MESS_ID"]."',";

		$setStr.=$okStat." UPTIME= '".mktime()."'";
		
		$strSql =
            "UPDATE ".self::$tableName." 
			SET ".$setStr."
			WHERE ORDER_ID = '".$arParams["ORDER_ID"]."'";
		
		if($DB->Query($strSql, true))
			return true;
		else 
			return false;
	}
	
	// возвращает какие статусы есть в таблице
	public static function getStatuses($arParams)
	{
		global $DB;
		
		$strSql = "SELECT STATUS FROM ".self::$tableName." GROUP BY STATUS";
		if($res = $DB->Query($strSql, true))
			return $res;
		else 
			return false;
	}
}
?>