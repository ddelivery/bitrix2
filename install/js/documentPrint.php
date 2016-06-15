<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

if (!$GLOBALS["USER"]->IsAdmin())
	die("Access denied!");

$seqID = $_GET["doc_seq_id"];

CModule::IncludeModule("ddelivery.ddelivery2");

$GLOBALS["APPLICATION"]->ShowHead();
CJSCore::Init(array("jquery"));
echo GetMessage("ddeliveryddelivery_DOC_SEQ_WHAIT");
echo "<img id = 'preloader' src = '/bitrix/images/".ddeliveryDriver::$MODULE_ID."/ajax.gif' style = 'width:10px;' >";

?>
<div id = "result"></div>
<script>
	function CheckDocSequense(seqID)
	{
		var params = {
			"action": "AJAXDocSeq",
			"seqID": seqID
		};
		$.ajax({
			url:'/bitrix/js/<?=ddeliveryDriver::$MODULE_ID?>/ajaxSDK.php',
			data:params,
			type:"GET",
			dataType: "json",
			error: function(XMLHttpRequest, textStatus){
				console.log(XMLHttpRequest);
				console.log(textStatus);
			},
			success: function(data){
				if (!data.success)
				{
					console.log(data);
					$("#preloader").css("display", "none");
					$("#result").append("Get doc's request fail. Renew current page");
					return;
				}
				
				if (data.data != false)
				{
					$("#preloader").css("display", "none");
					for (var i in data.data)
						window.open(data.data[i].url, '_blank');
				}
				else
					setTimeout(function(){CheckDocSequense(seqID)}, 20000);
			}
		});
	}
	
	CheckDocSequense("<?=$seqID?>");
</script>
