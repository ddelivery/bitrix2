<?
// синхронизация городов
$MESS ['ddeliveryddelivery_SYNCTY_RUSSIA'] = "Россия";
$MESS ['ddeliveryddelivery_SYNCTY_ERR_NORUSSIA'] = "Страна \"Россия\" не найдена в местоположениях";
$MESS ['ddeliveryddelivery_SYNCTY_ERR_NOFILE']   = "Невозможно загрузить файл с городами ddelivery.";

//подписи
$MESS ['ddeliveryddelivery_mm'] = "мм";
$MESS ['ddeliveryddelivery_cm'] = "см";
$MESS ['ddeliveryddelivery_g'] = "г";

//остальное
$MESS ['ddeliveryddelivery_DELCITYERROR'] = "Не удалось переопределить города, ошибка SQL: ";
$MESS ['ddeliveryddelivery_SOD_NOTGET'] = "- не передано.";
$MESS ['ddeliveryddelivery_SOD_WRONGPRM'] = "- не верный формат";
$MESS ['ddeliveryddelivery_SOD_ORDERID'] = "Код заказа";
$MESS ['ddeliveryddelivery_SOD_CANTUPDATE'] = "Не удалось обновить информацию о заказе. Повторите попытку позже или обратитесь в техподдержку, если эта ошибка возникает постоянно.";
$MESS ['ddeliveryddelivery_SOD_PROPDELETED'] = "Свойство заказа 'Logist' с кодом 'ddeliveryddelivery_LOGIST' было удалено. Без него модуль ddelivery.iml (автоматизированная отсылка заявок в IML) невозможна. Для продолжения работы переустановите модуль.";
$MESS ['ddeliveryddelivery_SOD_NOMODULE_SALE'] = "Невозможно подключить модуль Интернет-магазина";
$MESS ['ddeliveryddelivery_SOD_UPDATED'] = "Свойства заявки сохранены, номер заказа DDelivery: ";
$MESS ['ddeliveryddelivery_SOD_NOREQ_1'] = "Заявка для заказа ";
$MESS ['ddeliveryddelivery_SOD_NOREQ_2'] = " не найдена";
$MESS ['ddeliveryddelivery_SOD_REQDLTD'] = "Данные о заявке удалены";
$MESS ['ddeliveryddelivery_SOD_UNBLDLREQ'] = "Удалить данные не получилось";
$MESS ['ddeliveryddelivery_SOD_REQKLDD'] = "Заявка на удаление заявки на заказ отправлена. Статус сменится на DELETE, когда она будет подтверждена.";
$MESS ['ddeliveryddelivery_SOD_UNBLKLREQ'] = "Не получилось отозвать заявку, за подробностями обратитесь к лог-файлу.";
$MESS ['ddeliveryddelivery_SOD_UNBLKLREQBDST'] = "Невозможно удалить заявку со статусом ";

$MESS ['ddeliveryddelivery_SOD_MANYCITY'] = "Данному местоположению соответствует несколько населенных пунктов.<br>Перед отправкой заявки убедитесь, что выбран правильный населенный пункт.<br><br>Обратите внимение, что рассчитанная стоимость доставки достоверна для первого варианта в выпадающем списке.";

$MESS ['ddeliveryddelivery_DOC_SEQ_ERR'] = "Не удалось поставить документы в очередь. Повторите попытку позже.";
$MESS ['ddeliveryddelivery_DOC_SEQ_WHAIT'] = "Документы добавлены в очередь. Если ожидание превышает 1 минуту, то обновите эту страницу.";

$MESS ['ddeliveryddelivery_JSC_SOD_BTNAME'] = "ddelivery доставка";
$MESS ['ddeliveryddelivery_JSC_SOD_WNDTITLE'] = "Редактирование данных для ddelivery";
$MESS ['ddeliveryddelivery_JSC_SOD_SAVE'] = "Сохранить";
$MESS ['ddeliveryddelivery_JSC_SOD_CLOSE'] = "Закрыть";
$MESS ['ddeliveryddelivery_JSC_SOD_SAVESEND'] = "Сохранить и отправить";
$MESS ['ddeliveryddelivery_JSC_SOD_SAVESEND_PROCESS'] = "Отправка заявки...";
$MESS ['ddeliveryddelivery_JSC_SOD_ALLTARIFS'] = "Таблица тарифов";
$MESS ['ddeliveryddelivery_JS_SOD_NOSVREG'] = "В выбранном регионе нет пункта самовывоза";
$MESS ['ddeliveryddelivery_JS_SOD_DELIVERY_COST'] = "Стоимость доставки";
$MESS ['ddeliveryddelivery_JS_SOD_DELIVERY_COST_CURRENT'] = "Текущая стоимость доставки";
$MESS ['ddeliveryddelivery_JS_SOD_BADPVZ'] = "Доставка на этот ПВЗ заказа будет отклонена (весовые ограничения).";
$MESS ['ddeliveryddelivery_JSC_SOD_ZAPOLNI'] = "Заполните поле";
$MESS ['ddeliveryddelivery_JSC_SOD_SAMVIV'] = "Самовывоз";
$MESS ['ddeliveryddelivery_JSC_SOD_S'] = "С";
$MESS ['ddeliveryddelivery_JSC_SOD_DELETE'] = "Удалить";
$MESS ['ddeliveryddelivery_JSC_SOD_DB_UPDATE_ERR'] = "Ошибка обновления базы данных.";
$MESS ['ddeliveryddelivery_JSC_SOD_DELETE_STATUS'] = "Помечен удаленным";
$MESS ['ddeliveryddelivery_JSC_SOD_DELETE_SUCCESS'] = "Заказ успешно помечен удаленным";
$MESS ['ddeliveryddelivery_JSC_SOD_DELETE_ERROR'] = "Не удалось пометить удаленным";
$MESS ['ddeliveryddelivery_JSC_SOD_DESTROY'] = "Отозвать заявку";
$MESS ['ddeliveryddelivery_JSC_SOD_UNLOCK'] = "Разблокировать";
$MESS ['ddeliveryddelivery_JSC_SOD_IFDELETE'] = "Вы уверены, что хотите удалить данные о заявке? Восстановить их будет невозможно!";
$MESS ['ddeliveryddelivery_JSC_SOD_IFKILL'] = "Вы уверены, что хотите отозвать заявку из ddeliveryа?";
$MESS ['ddeliveryddelivery_JSC_SOD_PRNTSH'] = "Печать квитанции";
$MESS ['ddeliveryddelivery_JSC_SOD_LOADING'] = "Обработка запроса...";
$MESS ['ddeliveryddelivery_JSC_SOD_FOLLOW'] = "Отследить";
$MESS ['ddeliveryddelivery_JSC_SOD_STATCHECK'] = "Проверить статус";
$MESS ['ddeliveryddelivery_JSC_SOD_timeWarn18'] = "Скорей всего заявки, отосланные после 18 часов будут обработаны на следующий будний день. Учтите это при выставлении даты доставки.";
$MESS ['ddeliveryddelivery_JSC_SOD_timeWarnSmall'] = "Скорей всего выбранная дата доставки будет отклонена. Минимальная рассчитанная дата доставки - ";
$MESS ['ddeliveryddelivery_JSC_SOD_nightTimeWarning'] = "Указанное время соответствует вечерней доставке, за вечернюю доставку взимается двойной тариф.";
$MESS ['ddeliveryddelivery_JSC_SOD_BADINTERVAL'] = "Указано некорректное время доставки.";
$MESS ['ddeliveryddelivery_JSC_SOD_NODELONSUNDAY'] = "В воскресенье доставка не осуществляется.";
$MESS ['ddeliveryddelivery_JSC_SOD_NODELONSATURDAY'] = "В указанный город в субботу доставка не осуществляется.";
$MESS ['ddeliveryddelivery_JSC_SOD_MAXHOURSATURDAY'] = "В указанный город максимальный час начала интервала доставки - ";
$MESS ['ddeliveryddelivery_JSC_SOD_NOCITY'] = "Невозможно определить населенный пункт доставки.";
$MESS ['ddeliveryddelivery_JSC_SOD_NOTARIF'] = "Невозможно определить выбранный тариф.";
$MESS ['ddeliveryddelivery_JSC_SOD_NEWCONDITIONS_1'] = "Новые параметры для доставки.\\n\\nСрок доставки: ";
$MESS ['ddeliveryddelivery_JSC_SOD_NEWCONDITIONS_2'] = "\\nСтоимость: ";

$MESS ['ddeliveryddelivery_JSC_SOD_HELPER_date'] = "Стандартное время доставки по Москве (МО) с 9 до 18 часов.<br>
Стандартное время доставки по Санкт-Петербургу (ЛО) с 10 до 18 часов.<br>
Стандартное время доставки по Регионам с 11 до 18 часов.<br>
Промежуток времени доставки – 3 часа.<br>
Доставка после 18 до 21 часа осуществляется только по Москве и Санкт-Петербургу в пределах МКАД (КАД).<br>
Доставка в интервале с 18 до 21 часа (вечернее время, двойной тариф) осуществляется в городах: Нижний Новгород, Калуга, Тверь, Ярославль, Орел, Екатеринбург, Тюмень, Челябинск.<br>
В субботу, в регионы и в декабре служба не может гарантировать доставку в указанное время";
$MESS ['ddeliveryddelivery_JSC_SOD_HELPER_time'] = "Чтобы указать время, щелкните на значек календаря в поле \"Дата доставки\" и выберите \"Установить время\". Указывается час, с которого возможна доставка, интервал доставки всегда трехчасовой.";

$MESS ['ddeliveryddelivery_JS_SOD_location']  = "Город доставки";
$MESS ['ddeliveryddelivery_JS_SOD_zip']  = "Индекс";
$MESS ['ddeliveryddelivery_JS_SOD_street']    = "Улица";
$MESS ['ddeliveryddelivery_JS_SOD_house']     = "Дом";
$MESS ['ddeliveryddelivery_JS_SOD_block']     = "Блок";
$MESS ['ddeliveryddelivery_JS_SOD_flat']      = "Квартира";
$MESS ['ddeliveryddelivery_JS_SOD_service']   = "Тариф";
$MESS ['ddeliveryddelivery_JS_SOD_isBeznal']  = "Курьер не получает деньги за заказ";
$MESS ['ddeliveryddelivery_JS_SOD_tariffName']  = "Тариф";
$MESS ['ddeliveryddelivery_JS_SOD_AS']        = "Дополнительные услуги";
$MESS ['ddeliveryddelivery_JS_SOD_GABS']      = "Габариты";
$MESS ['ddeliveryddelivery_JS_SOD_VWEIGHT']   = "Объемный вес";
$MESS ['ddeliveryddelivery_JS_SOD_issue']       = "Дата доставки";
$MESS ['ddeliveryddelivery_JS_SOD_TD']          = "Время доставки";
$MESS ['ddeliveryddelivery_JS_SOD_name']        = "Контактное лицо";
$MESS ['ddeliveryddelivery_JS_SOD_comment']     = "Комментарий";
$MESS ['ddeliveryddelivery_JS_SOD_line']        = "Адрес доставки";
$MESS ['ddeliveryddelivery_JS_SOD_email']       = "E-mail";

$MESS ['ddeliveryddelivery_JS_SOD_phone']       = "Контактный телефон";
$MESS ['ddeliveryddelivery_JS_SOD_PVZ']         = "Пункт самовывоза";
$MESS ['ddeliveryddelivery_JS_SOD_last']        = "Последняя заявка отправлена ";
$MESS ['ddeliveryddelivery_JS_SOD_timeFrom']    = "Доставка с";
$MESS ['ddeliveryddelivery_JS_SOD_timeTo']      = "Доставка до";
$MESS ['ddeliveryddelivery_JS_SOD_STATUS']      = "Статус";
$MESS ['ddeliveryddelivery_JS_SOD_number']      = "Номер заказа";
$MESS ['ddeliveryddelivery_JS_SOD_email']       = "E-mail";
$MESS ['ddeliveryddelivery_JS_SOD_address']      = "Адрес";
$MESS ['ddeliveryddelivery_JS_SOD_street']      = "Улица";
$MESS ['ddeliveryddelivery_JS_SOD_house']       = "Дом";
$MESS ['ddeliveryddelivery_JS_SOD_flat']        = "Квартира";

$MESS ['ddeliveryddelivery_JS_SOD_ddelivery_ID']     = "Номер заказа в ddelivery";
$MESS ['ddeliveryddelivery_JS_SOD_MESS_ID']     = "Акт";

$MESS ['ddeliveryddelivery_JS_SOD_STAT_NEW'] = "Заявка на доставку заказа еще не отсылалась.";
$MESS ['ddeliveryddelivery_JS_SOD_STAT_OK'] = "Заявка на доставку подтверждена.";
$MESS ['ddeliveryddelivery_JS_SOD_STAT_DELIVD'] = "Заказ уже доставлен клиенту.";
$MESS ['ddeliveryddelivery_JS_SOD_STAT_OTKAZ'] = "Клиент уже отказался от заказа.";
$MESS ['ddeliveryddelivery_JS_SOD_STAT_STORE'] = "Заказ уже на складе ddelivery.";
$MESS ['ddeliveryddelivery_JS_SOD_STAT_CORIER'] = "Заказ уже у курьера ddelivery.";
$MESS ['ddeliveryddelivery_JS_SOD_STAT_PVZ'] = "Заказ уже на пункте самовывоза ddelivery.";
$MESS ['ddeliveryddelivery_JS_SOD_STAT_TRANZT'] = "Заказ в пути.";
$MESS ['ddeliveryddelivery_JS_SOD_STAT_ERROR'] = "Заявка отклонена из-за ошибок в параметрах. Исправьте ошибки и отправьте ее заново.";

$MESS ['ddeliveryddelivery_JS_SOD_HD_ADDRESS'] = "Адрес";
$MESS ['ddeliveryddelivery_JS_SOD_HD_DATE'] = "Дата";
$MESS ['ddeliveryddelivery_JS_SOD_HD_RESIEVER'] = "Получатель";
$MESS ['ddeliveryddelivery_JS_SOD_HD_PARAMS'] = "Заявка";
$MESS ['ddeliveryddelivery_JS_SOD_HD_ERRORS'] = "Ошибки";
$MESS ['ddeliveryddelivery_JS_SOD_HD_DAY'] = "дн.";
$MESS ['ddeliveryddelivery_JSC_SOD_RUB'] = "руб.";

$MESS ['ddeliveryddelivery_JS_SOD_ABOUT'] = "Детали заказа";
$MESS ['ddeliveryddelivery_JS_SOD_GABARITES'] = "Габариты заказа";

$MESS ['ddeliveryddelivery_JS_SOD_NONALPAY'] = "<span style='color:red'>Оплата наличными в указанном городе невозможна</span>";
$MESS ['ddeliveryddelivery_JS_SOD_TOOMANY']  = "<span style='color:red'>Превышен порог оплаты наличными в #VALUE# руб в указанном городе.</span>";

$MESS ['ddeliveryddelivery_JS_SOD_WRONGTARIF'] = "Eсли вы представляете магазин, то рекомендуется отправлять \"склад-склад или склад-дверь\" + отдельно вызывать курьера на консолидацию за забором товара на склад ddeliveryа";

$MESS ['ddeliveryddelivery_STT_SHOW']='показать';
$MESS ['ddeliveryddelivery_STT_CHNG']='Изменить';
$MESS ['ddeliveryddelivery_STT_TOORDR']='К заказу';

$MESS ['ddeliveryddelivery_UPDT_PREFIX']='Изменения в ';
$MESS ['ddeliveryddelivery_UPDT_Service']='услугах';
$MESS ['ddeliveryddelivery_UPDT_SelfDelivery']='пунктах самовывоза';
$MESS ['ddeliveryddelivery_UPDT_Region']='регионах';
$MESS ['ddeliveryddelivery_UPDT_ADDED_Region']='Добавлен регион';
$MESS ['ddeliveryddelivery_UPDT_ADDED_Service']='Добавлена услуга';
$MESS ['ddeliveryddelivery_UPDT_CHNGD_Region']='Изменен регион';
$MESS ['ddeliveryddelivery_UPDT_CHNGD_Service']='Изменена услуга';
$MESS ['ddeliveryddelivery_UPDT_DLTD_Region']='Удален регион';
$MESS ['ddeliveryddelivery_UPDT_DLTD_Service']='Удалена услуга';
$MESS ['ddeliveryddelivery_UPDT_SF_ADD_CT']='Новый город с самовывозом: ';
$MESS ['ddeliveryddelivery_UPDT_SF_DLT_CT']='Самовывоз закрыт в городе ';
$MESS ['ddeliveryddelivery_UPDT_SF_ADD']='Открыт пункт самовывоза : ';
$MESS ['ddeliveryddelivery_UPDT_SF_DLT']='Закрыт пункт самовывоза : ';
$MESS ['ddeliveryddelivery_UPDT_SF_DSRC']='Изменено описание ';
$MESS ['ddeliveryddelivery_UPDT_SF_CODE']='Изменен код пункта ';
$MESS ['ddeliveryddelivery_UPDT_SF_CITY']='Город';
$MESS ['ddeliveryddelivery_UPDT_CODE']='код';
$MESS ['ddeliveryddelivery_UPDT_OLD']='Старый';
$MESS ['ddeliveryddelivery_UPDT_OLDo']='Старое';
$MESS ['ddeliveryddelivery_UPDT_NAME']='название';
$MESS ['ddeliveryddelivery_UPDT_ERR']='При синхронизации произошли ошибки, за подробной информацией обратитесь к лог-файлу ошибок (/bitrix/js/ddelivery.iml/errorLog.txt)';
$MESS ['ddeliveryddelivery_UPDT_DONE']='Модуль синхронизирован - ';

$MESS ['ddeliveryddelivery_FILE_UNBLUPDT']='Не удалось получить с сервера информацию о пунктах самовывоза. Код ответа сервера: ';

/*
	ответы на запросы
*/
//общее
$MESS ['ddeliveryddelivery_ERRORLOG_BADRESPOND']='Код ответа сервера: ';
$MESS ['ddeliveryddelivery_ERRORLOG_ERRORCODE']='Ответ сервера: ';
$MESS ['ddeliveryddelivery_ERRLOG_NOORDER']='Не найден заказ с id=';
$MESS ['ddeliveryddelivery_ERRLOG_NOREQ']='Не найдена заявка на заказ с id=';
$MESS ['ddeliveryddelivery_ERRLOG_GOS_BADCODE'] = 'Ошибка подключения модуля Интернет-магазина при получении статусов заказов.';
$MESS ['ddeliveryddelivery_ERRLOG_NOSALEOML']   = 'Ошибка подключения модуля Интернет-магазина при составлении заявки.';
$MESS ['ddeliveryddelivery_ERRLOG_NOSALEOOS']   = 'Ошибка подключения модуля Интернет-магазина при получении статусов заказов.';
// отсылание заявок
$MESS ['ddeliveryddelivery_SEND_SENDED'] = "Заявка успешно отослана.";
$MESS ['ddeliveryddelivery_SEND_UNBLSND']="Не удалось отправить заявку.\n"; 
$MESS ['ddeliveryddelivery_SEND_NOTDENDED'] = "Заявка не отослана из-за ошибок в данных. Перезагрузите страницу для просмотра деталей.";
$MESS ['ddeliveryddelivery_SEND_BADSENDED'] = "Заявка отослана с ошибками. Перезагрузите старницу для просмотра деталей.";
//запрос статусов
$MESS ['ddeliveryddelivery_GOS_UNBLSND']="Не удалось запросить статусы заказов.\n";
$MESS ['ddeliveryddelivery_GOS_HASERROR']="Ошибка синхронизации статусов заказов. ";
$MESS ['ddeliveryddelivery_GOS_UNKNOWNSTAT']="Неопознанный статус заказа №";
$MESS ['ddeliveryddelivery_GOS_NOTUPDATED']="Заказ не обновлен.";
$MESS ['ddeliveryddelivery_GOS_STATUS']="Статус: ";
$MESS ['ddeliveryddelivery_GOS_CANTUPDATEREQ']="Не удалось обновить информацию о статусе заявки заказа №";
$MESS ['ddeliveryddelivery_GOS_CANTUPDATEORD']="Не удалось обновить статус заказа №";
$MESS ['ddeliveryddelivery_GOS_BADREQTOUPDT']="Попытка изменить статус неподтвержденной заявки на заказ №";
$MESS ['ddeliveryddelivery_GOS_CANTMARKPAYED']="Не удалось отметить оплаченным заказ №";
// удаление
$MESS ['ddeliveryddelivery_DRQ_DELETED']="Заявка удалена.";
$MESS ['ddeliveryddelivery_DRQ_UNBLDLT']="Не удалось удалить заявку на заказ.\n";
$MESS ['ddeliveryddelivery_DRQ_CNTDELREQ']="Заявка в системе ddelivery удалена, однако не удалена из базы данных модуля.";
$MESS ['ddeliveryddelivery_DRQ_GOTERRORS']="При удалении возникли ошибки:\n";
$MESS ['ddeliveryddelivery_DRQ_BADSTATUS']="Некорректный статус удаляемой заявки (заказ либо уже отгружен, либо не принят ddeliveryом): ";
// прочее
$MESS ['ddeliveryddelivery_FILEIPL_UNBLUPDT']='Не удалось запросить дополнительную информацию о пунктах самовывоза. Код ответа сервера: ';


$MESS ['ddeliveryddelivery_ERRLOG_NOLIST']='15 Невозможно создать заявку: отсутствует информация об услугах, регионах и пунктах самовывоза (файл /bitrix/js/ddelivery.iml/list.php). Для оформления заявок синхронизируйте модуль с IML в настройках модуля.';
$MESS ['ddeliveryddelivery_FILEIPL_NODELIVDATA']='21 Не удалось запросить информацию о сроках доставки. Код ответа сервера: ';
$MESS ['ddeliveryddelivery_ERRLOG_ERRSUNCCITY']='22 Не удалось синхронизировать города. Ошибка: ';

$MESS ['ddeliveryddelivery_SHTIHCOD']='Чтобы удалить штрихкод из печати - просто кликните на него.<br>Чтобы восстановить удаленные штрихкоды - перезагрузите страницу клавишей F5.';

$MESS ['ddeliveryddelivery_AUTH_NO']  = 'Не удалось авторизоваться. Проверьте введенные данные или повторите попытку позже. Ошибка: ';
$MESS ['ddeliveryddelivery_AUTH_YES'] = 'Вы успешно авторизовались.';
$MESS ['ddeliveryddelivery_AUTH_NOCURL'] = "Авторизация невозможна: отсутствует PHP-библиотека CURL. Свяжитесь с техподдержкой хостинга с просьбой подключить библиотеку.";

$MESS ['ddeliveryddelivery_LANG_YO_S'] = 'ё';
$MESS ['ddeliveryddelivery_LANG_YE_S'] = 'е';
$MESS ['ddeliveryddelivery_LANG_YO_B'] = 'Ё';
$MESS ['ddeliveryddelivery_LANG_CH_S'] = 'ч';
$MESS ['ddeliveryddelivery_LANG_CH_B'] = 'Ч';
$MESS ['ddeliveryddelivery_LANG_YA_S'] = 'я';
$MESS ['ddeliveryddelivery_LANG_YA_B'] = 'Я';

$MESS ['ddeliveryddelivery_SIGN_TESTMODE'] = 'Заказ принят в тестовом режиме';

//Печать
$MESS ['ddeliveryddelivery_SIGN_PRNTddelivery'] = "Печать ddelivery";
$MESS ['ddeliveryddelivery_PRINTERR_BADORDERS'] = "Нельзя напечатать следующие заказы: ";
$MESS ['ddeliveryddelivery_PRINTERR_TOTALERROR'] = "Выбранные заказы распечатать нельзя. Возможные причины: заявка на заказ не была отослана модулем и принята ddeliveryом.";
?>