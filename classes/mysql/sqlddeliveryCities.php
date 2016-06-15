<?
class sqlddeliveryCities
{
	private static $tableName = "ddelivery_ddelivery_cities";

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
			
		
		$strSql="SELECT * FROM ".self::$tableName." ".$strSql;
		// preDDK($strSql);
		
		$res = $DB->Query($strSql, false, "Error in ". __FILE__ ." line ".__LINE__);
		return $res;
	}
}
?>