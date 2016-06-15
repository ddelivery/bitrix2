<?
// получаем возможные статусы заказов для фильтра
// $arStatuses = ddeliverydriver::GetVarStatuses();

?>
<style>
	.sortTr
	{
		cursor:pointer;
	}
	.sortTr:hover{opacity:0.7;}
	.mdTbl{overflow:hidden;}
	.ddeliveryddelivery_TblStOk td{
		background-color:#E2FCE2!important;
	}
	.ddeliveryddelivery_TblStErr td{
		background-color:#FFEDED!important;
	}
	.ddeliveryddelivery_TblStTzt td{
		background-color:#FCFCBF!important;
	}	
	.ddeliveryddelivery_TblStDel td{
		background-color:#E9E9E9!important;
	}

	.ddeliveryddelivery_TblStStr td{
		background-color:#FCFFCE!important;
	}
	.ddeliveryddelivery_TblStCor td{
		background-color:#D9FFCE!important;
	}	
	.ddeliveryddelivery_TblStPVZ td{
		background-color:#D9FFCE!important;
	}	
	.ddeliveryddelivery_TblStOtk td{
		background-color:#FFCECE!important;
	}	
	.ddeliveryddelivery_TblStDvd td{
		background-color:#ABFFAB!important;
	}

	.ddeliveryddelivery_TblStOk:hover td,.ddeliveryddelivery_TblStErr:hover td, ddeliveryddelivery_TblStTzt:hover td, ddeliveryddelivery_TblStStr:hover td, ddeliveryddelivery_TblStCor:hover td, ddeliveryddelivery_TblStPVZ:hover td, ddeliveryddelivery_TblStOtk:hover td, ddeliveryddelivery_TblStDvd:hover td{
		background-color:#E0E9EC!important;
	}
	.ddeliveryddelivery_crsPnt{
		cursor:pointer;
	}
	.mdTbl{
		border-bottom: 1px solid #DCE7ED;
		border-left: 1px solid #DCE7ED;
		border-right: 1px solid #DCE7ED;
		border-top: 1px solid #C4CED2;
	}
	#ddeliveryddelivery_flrtTbl{
		background: url("/bitrix/panel/main/images/filter-bg.gif") transparent;
		border-bottom: 1px solid #A0ABB0;
		border-radius: 5px 5px 5px;
		text-overflow: ellipsis;
		text-shadow: 0px 1px rgba(255, 255, 255, 0.702);
	}
	.ddeliveryddelivery_mrPd td{
		padding: 5px;
	}
</style>
<script type='text/javascript'>
	function ddeliveryddelivery_getTable(params)
	{
		if(typeof params == 'undefined')
			params={};
		
		var fltObj=ddeliveryddelivery_setFilter();
		
		for(var i in fltObj)
			params[i]=fltObj[i];
		
		params['pgCnt']=(typeof params['pgCnt'] == 'undefined')?$('#ddeliveryddelivery_tblPgr').val():params['pgCnt'];
		params['page']=(typeof params['page'] == 'undefined')?$('#ddeliveryddelivery_crPg').html():params['page'];
		params['by']=(typeof params['by'] == 'undefined')?'ID':params['by'];
		params['sort']=(typeof params['sort'] == 'undefined')?'DESC':params['sort'];
		params['action']='tableHandler';

		$('#ddeliveryddelivery_tblPls').find('td').css('opacity','0.4');
		
		$.ajax({
			url:"/bitrix/js/<?=$module_id?>/ajaxSDK.php",
			data:params,
			type:'POST',
			dataType: 'json',
			success:function(data){
				if (data.success)
					data = data.data;
				else
				{
					data = false;
					console.log(data);
				}
				
				if(data['ttl']==0)
					$('#ddeliveryddelivery_flrtTbl').parent().html('<?=GetMessage('ddeliveryddelivery_OTHR_NO_REQ')?>');
				else
				{
					$('[onclick="ddeliveryddelivery_nxtPg(-1)"]').css('visibility','visible');
					$('[onclick="ddeliveryddelivery_nxtPg(1)"]').css('visibility','visible');
					if(data.cP==1)
						$('[onclick="ddeliveryddelivery_nxtPg(-1)"]').css('visibility','hidden');
					if(data.cP>=data.mP)
						$('[onclick="ddeliveryddelivery_nxtPg(1)"]').css('visibility','hidden');
					$('#ddeliveryddelivery_crPg').html(data.cP);
					
					$('#ddeliveryddelivery_ttlCls').html('<?=GetMessage('ddeliveryddelivery_TABLE_COLS')?> '+((parseInt(data.cP)-1)*data.pC+1)+' - '+Math.min(parseInt(data.ttl),parseInt(data.cP)*data.pC)+' <?=GetMessage('ddeliveryddelivery_TABLE_FRM')?> '+data.ttl);
					$('#ddeliveryddelivery_tblPls').html(data.html);
				}
			},
			error: function(XMLHttpRequest, textStatus){
				console.log(XMLHttpRequest.responseText);
				console.log(textStatus);
			},
		});
	}
	
	function ddeliveryddelivery_clrCls()
	{
		$('.adm-list-table-cell-sort-up').removeClass('adm-list-table-cell-sort-up');
		$('.adm-list-table-cell-sort-down').removeClass('adm-list-table-cell-sort-down');
	}
	
	function ddeliveryddelivery_sort(wat,handle)
	{
		if(handle.hasClass("adm-list-table-cell-sort-down"))
		{
			ddeliveryddelivery_clrCls();
			handle.addClass("adm-list-table-cell-sort-up");
			ddeliveryddelivery_getTable({'by':wat,'sort':'ASC'});
		}
		else
		{
			if(handle.hasClass("adm-list-table-cell-sort-up"))
			{
				ddeliveryddelivery_clrCls();
				ddeliveryddelivery_getTable();
			}
			else
			{
				ddeliveryddelivery_clrCls();
				handle.addClass("adm-list-table-cell-sort-down");
				ddeliveryddelivery_getTable({'by':wat,'sort':'DESC'});
			}
		}
	}
	
	function ddeliveryddelivery_nxtPg(cntr)
	{
		var page=parseInt($("#ddeliveryddelivery_crPg").html())+cntr;
		if(page<1)
			page=1;
			
		if(page!=parseInt($("#ddeliveryddelivery_crPg").html()))
		{
			ddeliveryddelivery_getTable({"page":page});
			$("#ddeliveryddelivery_crPg").html(page);
		}
	}
	
	function ddeliveryddelivery_shwPrms(handle)
	{
		handle.siblings('a').hide();
		handle.css('height','auto');
		var height=handle.height();
		handle.css('height','0px');
		handle.animate({'height':height},500);
	}
	
	function ddeliveryddelivery_setFilter()
	{
		var params={};
		$('[id^="ddeliveryddelivery_Fltr_"]').each(function(){
			var crVal=$(this).val();
			if(crVal)
				params['F'+$(this).attr('id').substr(26)]=crVal;
		});
		return params;
	}

	function ddeliveryddelivery_resFilter()
	{
		$('[id^="ddeliveryddelivery_Fltr_"]').each(function(){
			$(this).val('');
		});
	}

	$(document).ready(function(){
		ddeliveryddelivery_getTable();
	});
	
</script>

<div id="pop-statuses" class="b-popup" style="display: none; ">
	<div class="pop-text"><?=GetMessage("ddeliveryddelivery_HELPER_statuses")?></div>
	<div class="close" onclick="$(this).closest('.b-popup').hide();"></div>
</div>

<tr><td colspan='2'>
		<table id='ddeliveryddelivery_flrtTbl'>
		  <tbody>
			<tr class='ddeliveryddelivery_mrPd'>
			  <td><?=GetMessage('ddeliveryddelivery_JS_SOD_number')?></td><td><input type='text' class='adm-workarea' id='ddeliveryddelivery_Fltr_>=ORDER_ID'><span class="adm-filter-text-wrap" style='margin: 4px 12px 0px'>...</span><input type='text' class='adm-workarea' id='ddeliveryddelivery_Fltr_<=ORDER_ID'></td>
			</tr>
			
			<tr class='ddeliveryddelivery_mrPd'>
			  <td><?=GetMessage('ddeliveryddelivery_JS_SOD_ddelivery_ID')?></td><td><input type='text' class='adm-workarea' id='ddeliveryddelivery_Fltr_>=ddelivery_ID'><span class="adm-filter-text-wrap" style='margin: 4px 12px 0px'>...</span><input type='text' class='adm-workarea' id='ddeliveryddelivery_Fltr_<=ddelivery_ID'></td>
			</tr>
			<tr class='ddeliveryddelivery_mrPd'>
				<td><?=GetMessage('ddeliveryddelivery_TABLE_UPTIME')?></td>
				<td>
					<div class="adm-input-wrap adm-input-wrap-calendar">
						<input type='text' class='adm-workarea' id='ddeliveryddelivery_Fltr_>=UPTIME' name='ddeliveryddeliveryupF' disabled>
						<span class="adm-calendar-icon" onclick="BX.calendar({node:this, field:'ddeliveryddeliveryupF', form: '', bTime: true, bHideTime: false});"></span>
					</div>
					<span class="adm-filter-text-wrap" style='margin: 4px 12px 0px'>...</span>
					<div class="adm-input-wrap adm-input-wrap-calendar">
						<input type='text' class='adm-workarea' id='ddeliveryddelivery_Fltr_<=UPTIME' name='ddeliveryddeliveryupD' disabled>
						<span class="adm-calendar-icon" onclick="BX.calendar({node:this, field:'ddeliveryddeliveryupD', form: '', bTime: true, bHideTime: false});"></span>
					</div>
				</td>
			</tr>
			<tr>
				<td colspan='2'><div class="adm-filter-bottom-separate" style="margin-bottom:0px;"></div></td>
			</tr>
			<tr class='ddeliveryddelivery_mrPd'>
				<td colspan='2'><input class="adm-btn" type="button" value="<?=GetMessage('MAIN_FIND')?>" onclick="ddeliveryddelivery_getTable()">&nbsp;&nbsp;&nbsp;<input class="adm-btn" type="button" value="<?=GetMessage('MAIN_RESET')?>" onclick="ddeliveryddelivery_resFilter()"></td>
			</tr>
		  </tbody>
		</table>
		<br><br>
		<table class="adm-list-table mdTbl">
			<thead>
				<tr class="adm-list-table-header">
					<?/*<td class="adm-list-table-cell"><div></div></td>*/?>
					<td class="adm-list-table-cell sortTr" style='width:50px;' onclick='ddeliveryddelivery_sort("ID",$(this))'><div class='adm-list-table-cell-inner'>ID</div></td>
					<?/*<td class="adm-list-table-cell sortTr" style='width:50px;' onclick='ddeliveryddelivery_sort("MESS_ID",$(this))'><div class='adm-list-table-cell-inner'><?=GetMessage('ddeliveryddelivery_JS_SOD_MESS_ID')?></div></td>*/?>
					<td class="adm-list-table-cell sortTr" style='width:77px;' onclick='ddeliveryddelivery_sort("ORDER_ID",$(this))'><div class='adm-list-table-cell-inner'><?=GetMessage('ddeliveryddelivery_TABLE_ORDN')?></div></td>
					<?/*<td class="adm-list-table-cell sortTr" style='width:77px;' onclick='ddeliveryddelivery_sort("STATUS",$(this))'><div class='adm-list-table-cell-inner'><?=GetMessage('ddeliveryddelivery_JS_SOD_STATUS')?></div></td>*/?>
					<td class="adm-list-table-cell sortTr" style='width:77px;' onclick='ddeliveryddelivery_sort("ddelivery_ID",$(this))'><div class='adm-list-table-cell-inner'><?=GetMessage('ddeliveryddelivery_JS_SOD_ddelivery_ID')?></div></td>
					<td class="adm-list-table-cell"><div class='adm-list-table-cell-inner'><?=GetMessage('ddeliveryddelivery_TABLE_PARAM')?></div></td>
					<?/*<td class="adm-list-table-cell"><div class='adm-list-table-cell-inner'><?=GetMessage('ddeliveryddelivery_TABLE_MESS')?></div></td>*/?>
					<td class="adm-list-table-cell sortTr" style='width:50px;' onclick='ddeliveryddelivery_sort("UPTIME",$(this))'><div class='adm-list-table-cell-inner'><?=GetMessage('ddeliveryddelivery_TABLE_UPTIME')?></div></td>
				</tr>
			</thead>
			<tbody id='ddeliveryddelivery_tblPls'>
			</tbody>
		</table>
		<div class="adm-navigation">
			<div class="adm-nav-pages-block">
				<span class="adm-nav-page adm-nav-page-prev ddeliveryddelivery_crsPnt" onclick='ddeliveryddelivery_nxtPg(-1)'></span>
				<span class="adm-nav-page-active adm-nav-page" id='ddeliveryddelivery_crPg'>1</span>
				<span class="adm-nav-page adm-nav-page-next ddeliveryddelivery_crsPnt" onclick='ddeliveryddelivery_nxtPg(1)'></span>
			</div>
			<div class="adm-nav-pages-total-block" id='ddeliveryddelivery_ttlCls'><?=GetMessage('ddeliveryddelivery_TABLE_COLS?')?> 1 Ц 5 <?=GetMessage('ddeliveryddelivery_TABLE_FRM')?> 5</div>
			<div class="adm-nav-pages-number-block">
				<span class="adm-nav-pages-number">
					<span class="adm-nav-pages-number-text"><?=GetMessage('admin_lib_sett_rec')?></span>
					<select id='ddeliveryddelivery_tblPgr' onchange='ddeliveryddelivery_getTable()'>
						<option value="5">5</option>
						<option value="10">10</option>
						<option value="20" selected="selected">20</option>
						<option value="50">50</option>
						<option value="100">100</option>
						<option value="200">200</option>
						<option value="0"><?=GetMessage('MAIN_OPTION_CLEAR_CACHE_ALL')?></option>
					</select>
				</span>
			</div>
		</div>
	</td></tr>