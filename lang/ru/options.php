<?
//опции
$MESS ['ddeliveryddelivery_OPT_API_KEY'] = "API ключ магазина";
$MESS ['ddeliveryddelivery_OPT_GET_ACCESS_TOKEN'] = "Привязать ключ к магазину";
$MESS ['ddeliveryddelivery_OPT_TEST_MODE'] = "Тестовый режим";

// $MESS ['ddeliveryddelivery_OPT_termInc'] = "Увеличить срок доставки на (дн.)";

$MESS ['ddeliveryddelivery_OPT_lengthD'] = "Длина, см";
$MESS ['ddeliveryddelivery_OPT_widthD'] = "Ширина, см";
$MESS ['ddeliveryddelivery_OPT_heightD'] = "Высота, см";
$MESS ['ddeliveryddelivery_OPT_weightD'] = "Вес, граммы";
$MESS ['ddeliveryddelivery_OPT_defMode'] = "Рассчитывать средние габариты для ";
$MESS ['ddeliveryddelivery_OPT_roundDeliveryPrice'] = "Округлять цену доставки до суммы кратной<br>(0 - не округлять)";
$MESS ['ddeliveryddelivery_OPT_assessedCost'] = "Оценочная стоимость заказа<br>(0 - будет исользована стоимость заказа)";

$MESS ['ddeliveryddelivery_LBL_addingService'] = "Настройки тарифов и доп. услуг.";
$MESS ['ddeliveryddelivery_OPT_addingService'] = "Отображение дополнительных услуг";
$MESS ['ddeliveryddelivery_OPT_tarifs'] = "Управление тарифами";


$MESS['ddeliveryddelivery_OPT_pvzID'] = "ID элемента, куда привязывать ссылку \"Выбрать пункт самовывоза\" <a href='#' class='PropHint' onclick='return ddelivery_popup_virt(\"pop-pvzID\", this);'></a>";
$MESS['ddeliveryddelivery_OPT_pvzPicker'] = "Код свойства, куда будет сохранен выбранный пункт самовывоза <a href='#' class='PropHint' onclick='return ddelivery_popup_virt(\"pop-pvzPicker\", this);'></a>";
$MESS['ddeliveryddelivery_OPT_showAddress'] = "Выводить вместо названия адрес ПВЗ";
$MESS['ddeliveryddelivery_OPT_hideNal'] = "Не давать оформить заказ с наличной оплатой при невозможности оплаты наличными <a href='#' class='PropHint' onclick='return ddelivery_popup_virt(\"pop-hideNal\", this);'></a>";
$MESS['ddeliveryddelivery_OPT_showInOrders'] = "Отображать кнопку заявки в заказах <a href='#' class='PropHint' onclick='return ddelivery_popup_virt(\"pop-showInOrders\", this);'></a>";
$MESS['ddeliveryddelivery_OPT_autoSelOne'] = "Автовыбор единственного ПВЗ при закрытии виджета <a href='#' class='PropHint' onclick='return ddelivery_popup_virt(\"pop-autoSelOne\", this);'></a>";
$MESS['ddeliveryddelivery_OPT_cntExpress'] = "Расчет экспрессов при стоимости доставки больше (руб) <a href='#' class='PropHint' onclick='return ddelivery_popup_virt(\"pop-cntExpress\", this);'></a>";

$MESS ['ddeliveryddelivery_OPT_setDeliveryId'] = "Выставлять принятым заказам идентификатор отправления";
$MESS ['ddeliveryddelivery_OPT_markPayed'] = "Отмечать доставленный заказ оплаченным";
$MESS ['ddeliveryddelivery_OPT_statusSTORE'] = "Статус заказа, доставленного на склад <a href='#' class='PropHint' onclick='return ddelivery_popup_virt(\"pop-statusSTORE\", this);'></a>";
$MESS ['ddeliveryddelivery_OPT_statusTRANZT'] = "Статус заказа, находящегося в пути <a href='#' class='PropHint' onclick='return ddelivery_popup_virt(\"pop-statusTRANZT\", this);'></a>";
$MESS ['ddeliveryddelivery_OPT_statusCORIER'] = "Статус заказа, переданного курьеру <a href='#' class='PropHint' onclick='return ddelivery_popup_virt(\"pop-statusCORIER\", this);'></a>";
$MESS ['ddeliveryddelivery_OPT_statusPVZ'] = "Статус заказа, доставленного на пункт самовывоза";
$MESS ['ddeliveryddelivery_OPT_statusDELIVD'] = "Статус доставленного заказа";
$MESS ['ddeliveryddelivery_OPT_statusOTKAZ'] = "Статус заказа, от которого отказался клиент";

$MESS ['ddeliveryddelivery_OPT_isTest'] = "Работа в тестовом режиме";
$MESS ['ddeliveryddelivery_OPT_delReqOrdr'] = "Удалять запись о заявке при удалении заказа";
$MESS['ddeliveryddelivery_OPT_statCync'] = "Дата последней проверки статусов заказов: ";
$MESS['ddeliveryddelivery_OPT_strName'] = "Название магазина (для штрихкодов)";

$MESS['ddeliveryddelivery_OPT_paySystems'] = "Платежные системы, при которых курьер не берет деньги с покупателя";
$MESS['ddeliveryddelivery_OPT_addHold'] = "Дополнительные задержки (в днях)";
$MESS['ddeliveryddelivery_OPT_depature'] = "Город-отправитель <a href='#' class='PropHint' onclick='return ddelivery_popup_virt(\"pop-depature\", this);'></a>";
$MESS['ddeliveryddelivery_OPT_addJQ'] = "Подключать jquery в виджете выбора пункта самовывоза <a href='#' class='PropHint' onclick='return ddelivery_popup_virt(\"pop-addJQ\", this);'></a>";
$MESS['ddeliveryddelivery_OPT_prntActOrdr'] = "Действие при печати актов <a href='#' class='PropHint' onclick='return ddelivery_popup_virt(\"pop-prntActOrdr\", this);'></a>";
$MESS['ddeliveryddelivery_OPT_numberOfPrints'] = "Число копий одной квитанции на листе <a href='#' class='PropHint' onclick='return ddelivery_popup_virt(\"pop-numberOfPrints\", this);'></a>";
$MESS['ddeliveryddelivery_OPT_dostTimeout'] = "Таймаут рассчета доставки, сек <a href='#' class='PropHint' onclick='return ddelivery_popup_virt(\"pop-dostTimeout\", this);'></a>";

// данные магазина
$MESS["ddeliveryddelivery_storeProps"] = "Данные магазина";
$MESS["ddeliveryddelivery_Storestreet"] = "Улица";
$MESS["ddeliveryddelivery_Storehouse"] = "Дом";
$MESS["ddeliveryddelivery_Storeblock"] = "Корпус/Строение";
$MESS["ddeliveryddelivery_Storeoffice"] = "Квартира/Офис";
$MESS["ddeliveryddelivery_StorecompanyName"] = "Имя кампании";
$MESS["ddeliveryddelivery_StorecontactName"] = "Контактное лицо";
$MESS["ddeliveryddelivery_Storephone"] = "Телефон контактного лицо";
$MESS["ddeliveryddelivery_Storeemail"] = "E-mail контактного лица";

//подсказки
$MESS ['ddeliveryddelivery_HELPER_depature'] = "Город-отправитель выставляется в <a href='/bitrix/admin/settings.php?lang=ru&mid=sale' target='_blank'>настройках Интернет-магазина</a> в закладке \"Адрес магазина\" -> Местоположение магазина.";
$MESS ['ddeliveryddelivery_HELPER_orderProps'] = "В поля необходимо вставить <a href='/bitrix/admin/sale_order_props.php'>коды свойств заказа</a>, которые будут переданы в службу доставки.<br>
<strong>Пояснения к полям:</strong><br>
Улица, дом и квартира - если адрес доставки разделен, в эти поля надо ввести данные об улице, доме и квартире/офисе (<i>ВНИМАНИЕ! Если адрес доставки у вас разделен на улицу, дом и квартиру и отдельного свойства для адреса доставки у вас нет, то поле 'Адрес' обязательно оставьте пустым.</i>).<br><br>
Для успешного функционирования вам так же необходимо иметь свойство заказа помеченное как 'Местоположение'. Если у вас отсутствует данное свойство, создайте его.<br><br>
";
$MESS ['ddeliveryddelivery_HELPER_address'] = "Если вы используете раздельное заполнение адреса (отдельно дом, улица и т.д.), оставьте данное поле пустым";
$MESS ['ddeliveryddelivery_HELPER_pvzID'] = "Подробнее о настройке: FAQ -> Описание модуля -> Настройка модуля и сл.доставки на странице оформления заказа -> 5. Вывести ссылку для открытия окна выбора пункта самовывоза.";
$MESS ['ddeliveryddelivery_HELPER_pvzPicker'] = "В это свойство будет сохранен выбранный пункт самовывоза. Должно использоваться текстовое свойство, например, адрес. Коды свойств берутся из <a href='/bitrix/admin/sale_order_props.php' target='_blank'>настроек свойств заказа</a>. Для всех типов плательщиков должен быть задан одинаковый код.";
$MESS ['ddeliveryddelivery_HELPER_hideNal'] = "При расчете доставки в города с невозможностью оплаты наличными или при превышении стоимости заказа лимита для города, пользователь не сможет выбрать оплату наличкой при выборе ddeliveryа или выбрать ddelivery при оплате наличными (в зависимости от режима работы компонента). Оплата наличными определяется настройкой \"Платежные системы, при которых курьер не берет деньги с покупателя\".";
$MESS ['ddeliveryddelivery_HELPER_autoSelOne'] = "Если в городе единственный ПВЗ покупатели иногда закрывают виджет без выбора пункта. При отметке этого флажка виджет будет автоматически выбирать ПВЗ при закрытии, если ПВЗ - единственный в городе.<br><br>
Плюс:<br>
Не будет заказов с невыбранным ПВЗ, если он - единственный в городе.<br>
Минус:<br>
Если пользователь хочет выбрать другую доставку - ему придется заново перезабивать адрес.";
$MESS ['ddeliveryddelivery_HELPER_cntExpress'] = "Если стоимость доставки получилась больше или равна указанной сумме - будет отдельно рассчитаны экспрессы, так как их стоимость может оказаться меньше.<br>Если указать 0 - проверка на экспрессы будет проводиться всегда, однако это повлечет более длительную работу старницы оформления заказа.";
$MESS ['ddeliveryddelivery_HELPER_AS'] = "Список дополнительных услуг, которые отображаются в форме отправления заявки.<br>Чтобы отображать эту услугу в форме, поставьте ей флажок \"Показывать\".<br>Чтобы всегда добавлять эту услугу в заявки - поставьте флажок \"По-умолчанию\".<br>Внимание! Если услуга не отображается, но отмечена для добавления по-умолчанию - она все равно будет добавлена, но не будет видна в форме отправления заявки.<br><br>В таблице приведено краткое описание услуг. За более подробной информацией необходимо обращаться к менеджерам компании. Также данная информация выложена на <a href='http://www.cdek.ru/' target='_blank'>сайте компании ddelivery</a>.";
$MESS ['ddeliveryddelivery_HELPER_numberOfPrints'] = "Форма квитанции для заказа присылается сервером ddelivery в формате pdf. Если сервер не сможет уместить указанное количество копий на одном листе А4 - они будут разбиты на несколько листов.";
$MESS ['ddeliveryddelivery_HELPER_showInOrders'] = "Когда показывать на странице информации о заказе кнопку \"ddelivery доставка\": всегда, или же только если выбрана доставка службой ddelivery.";
$MESS ['ddeliveryddelivery_HELPER_tarifs'] = "Список доступных для расчета тарифов ddeliveryа. Настройка \"Показывать\" управляет формой отправления заявки, \"Отключить\" - оформлением заказа. Нужно иметь в виду, что при выборе тарифа, отличного от расчетного, стоимость и сроки изменятся.";

$MESS ['ddeliveryddelivery_HELPER_timeSend'] = "При оформлении заказа позже указанного часа, срок доставки будет отображаться на день больше.";

$MESS ['ddeliveryddelivery_HELPER_addJQ'] = "Для работы виджета выбора пунктов самовывоза необходима библиотека jquery, которая подключается средствами Битрикса. Если на странице оформления заказа возникает ошибка, связанная с повторным подключением jquery - нужно снять этот флаг.";

$MESS ['ddeliveryddelivery_HELPER_statuses'] = "
    NEW - заявка еще не отсылалась на сервер.<br>
	ERROR - заявка не принята из-за ошибок в ее полях. Необходимо исправить ошибки и отправить ее заново.<br>
    OK - заявка принята.<br>
    TRANZIT - заказ в пути.<br>
    STORE - заказ на складе ddelivery.<br>
    CORIER - заказ у курьера.<br>
    PVZ - заказ на пункте самовывоза.<br>
    OTKAZ - клиент отказался от заказа.<br>
    DELIVD - заказ доставлен.
";
$MESS ['ddeliveryddelivery_HELPER_prntActOrdr'] = "Определяет, что будет отправлено на печать при выборе заказов и применении пункта \"Печать ddelivery\": только акт приема-передачи, или акт и заказы. Подробнее - FAQ => Включение функционала => 1. Настройки -> Общие.";
$MESS ['ddeliveryddelivery_HELPER_statusSTORE']  = "Заказы, которые были доставлены на склад ddelivery для распределения, переводятся в этот статус.";
$MESS ['ddeliveryddelivery_HELPER_statusCORIER'] = "Заказы, выданные курьеру для доставки со склада города-получателя до двери получателя.";
$MESS ['ddeliveryddelivery_HELPER_statusTRANZT'] = "Заказы, находящиеся в транспортировке между складом города-отправителя и города-получателя или ожидающие выдачи курьеру.";
$MESS ['ddeliveryddelivery_HELPER_dostTimeout'] = "Максимальное время расчета стоимости и сроков доставки на странице оформления заказа.";
$MESS ['ddeliveryddelivery_HELPER_TURNOFF'] = "Тариф будет отключен для расчета на странице оформления заказа. При оформлении заявки его все равно можно рассчитать и выбрать.";
$MESS ['ddeliveryddelivery_HELPER_TARSHOW'] = "Тариф не будет отображаться в форме оформления заявки и в таблице тарифов. Это НЕ отключит его для расчета при оформлении заказа.";
//заголовки
$MESS ['ddeliveryddelivery_HDR_common'] = "Общие";
$MESS ['ddeliveryddelivery_HDR_status'] = "Обратная связь";
$MESS ['ddeliveryddelivery_HDR_orderProps'] = "Свойства заявки <a href='#' class='PropHint' onclick='return ddelivery_popup_virt(\"pop-orderProps\", this);'></a>";
$MESS ['ddeliveryddelivery_HDR_basket'] = "Оформление заказа и настройки виджета";
$MESS ['ddeliveryddelivery_HDR_extended'] = "Расширенные настройки";
$MESS ['ddeliveryddelivery_HDR_service'] = "Сервисные свойства";
$MESS ['ddeliveryddelivery_HDR_delivery'] = "Настройки доставки";
$MESS ['ddeliveryddelivery_HDR_termDeliv'] = "Вычисление времени доставки";
$MESS ['ddeliveryddelivery_HDR_MEASUREMENT_DEF'] = "Размеры по умолчанию";
$MESS ['ddeliveryddelivery_HDR_success']  = "Обработанные";
$MESS ['ddeliveryddelivery_HDR_many']     = "Конфликтующие";
$MESS ['ddeliveryddelivery_HDR_notFound'] = "Не найденные";
$MESS ['ddeliveryddelivery_HDR_BITRIXID'] = "ID Битрикса";
$MESS ['ddeliveryddelivery_HDR_ddeliveryID']   = "ID ddeliveryа";
$MESS ['ddeliveryddelivery_HDR_REGION']   = "Регион";
$MESS ['ddeliveryddelivery_HDR_CITY']     = "Город";
$MESS ['ddeliveryddelivery_HDR_BITRIXNM'] = "Местоположение Битрикса";
$MESS ['ddeliveryddelivery_HDR_ddeliveryNM']   = "Местоположение ddeliveryа";
$MESS ['ddeliveryddelivery_HDR_VARIANTS'] = "Претенденты";
//Подписи
$MESS ['ddeliveryddelivery_LABEL_noPr'] = "Свойство не задано";
$MESS ['ddeliveryddelivery_LABEL_Sign_noPr'] = "Свойство с этим кодом не задано у типов плательщиков:";
$MESS ['ddeliveryddelivery_LABEL_unAct'] = "Свойство не активно";
$MESS ['ddeliveryddelivery_LABEL_Sign_unAct'] = "Свойство с этим кодом не активно у типов плательщиков:";
$MESS ['ddeliveryddelivery_LABEL_shPr'] = "Укажите код свойства";

$MESS ['ddeliveryddelivery_LABEL_GOODPARAMS'] = "Габариты товаров берутся из настроек торгового каталога. Если габариты у товара не заданы - берутся габариты по умолчанию.";
$MESS ['ddeliveryddelivery_LABEL_NOCITY'] = "<span style='color:red'>Внимание!</span> Не задан город-отправитель! Небходимо выбрать местоположение магазина в <a href='/bitrix/admin/settings.php?mid=sale' target='_blank'>настройках Интернет-магазина</a>. После выбора, перезагрузите эту страницу.";
$MESS ['ddeliveryddelivery_LABEL_NOddeliveryCITY'] = "<span style='color:red'>Внимание!</span> Не удается определить id города-отправителя в системе ddelivery! Проверьте местоположение магазина в <a href='/bitrix/admin/settings.php?mid=sale' target='_blank'>настройках Интернет-магазина</a> или уточните, обслуживается ли ваш город компанией ddelivery.";
$MESS ['ddeliveryddelivery_LABEL_NOddeliveryCITYSHORT'] = "Не удается определить id города-отправителя в системе ddelivery!";
$MESS ['ddeliveryddelivery_LABEL_forOrder'] = "заказа";
$MESS ['ddeliveryddelivery_LABEL_forGood'] = "1 товара";

$MESS ['ddeliveryddelivery_LABEL_noLoc'] = "Отсутствует свойство заказа типа \"Местоположение\"";

// Дополнительные услуги
$MESS ['ddeliveryddelivery_AS_TABLE_NAME'] = "Название услуги";
$MESS ['ddeliveryddelivery_AS_TABLE_SHOW'] = "Показывать";
$MESS ['ddeliveryddelivery_AS_TABLE_DEF'] = "По-умолчанию";

$MESS ['ddeliveryddelivery_TARIF_TABLE_NAME'] = "Название тарифа (код)";
$MESS ['ddeliveryddelivery_TARIF_TABLE_SHOW'] = "Показывать <a href='#' class='PropHint' onclick='return ddelivery_popup_virt(\"pop-TARSHOW\", this);'></a>";
$MESS ['ddeliveryddelivery_TARIF_TABLE_TURNOFF'] = "Отключить <a href='#' class='PropHint' onclick='return ddelivery_popup_virt(\"pop-TURNOFF\", this);'></a>";
$MESS ['ddeliveryddelivery_TARIF_TABLE_HINT'] = "Описание";

//таблица заявок
$MESS['ddeliveryddelivery_TABLE_ORDN'] = "ID заказа";
$MESS['ddeliveryddelivery_TABLE_PARAM'] = "Параметры";
$MESS['ddeliveryddelivery_TABLE_MESS'] = "Сообщение";
$MESS['ddeliveryddelivery_TABLE_COLS'] = "Записи";
$MESS['ddeliveryddelivery_TABLE_FRM'] = "из";
$MESS['ddeliveryddelivery_TABLE_SHTRC'] = "Штрихкод";
$MESS['ddeliveryddelivery_TABLE_UPTIME'] = "Дата изменения";
//табы
$MESS['ddeliveryddelivery_TAB_LIST'] = "Заявки";
$MESS['ddeliveryddelivery_TAB_TITLE_LIST'] = "Отслеживание состояний заявок на заказ.";
$MESS['ddeliveryddelivery_TAB_FAQ'] = "FAQ";
$MESS['ddeliveryddelivery_TAB_TITLE_FAQ'] = "Помощь в настройке и работе с модулем";
$MESS['ddeliveryddelivery_TAB_LOGIN'] = "Авторизация";
$MESS['ddeliveryddelivery_TAB_TITLE_LOGIN'] = "Для начала работы с модулем введите доступы к учетной записи";
$MESS['ddeliveryddelivery_TAB_CITIES'] = "Города";
$MESS['ddeliveryddelivery_TAB_CITIES_LOGIN'] = "Соответствие местоположений Битрикса с городами ddeliveryа.";
//авторизация
$MESS['ddeliveryddelivery_LBL_AUTHORIZE'] = "Авторизоваться";
$MESS['ddeliveryddelivery_ALRT_NOLOGIN'] = "Введите Account";
$MESS['ddeliveryddelivery_ALRT_NOPASS'] = "Введите Secure_password";

$MESS['ddeliveryddelivery_LBL_YLOGIN'] = "Ваш Account";
$MESS['ddeliveryddelivery_LBL_DOLOGOFF'] = "Разлогиниться";
$MESS['ddeliveryddelivery_LBL_ISLOGOFF'] = "Функционал модуля будет отключен: синхронизация, отсылание и проверка статусов заявок, службы доставки - все будет отключено. Продолжить?";
$MESS['ddeliveryddelivery_LBL_CLRCACHE'] = "&nbsp;Сбросить кэш&nbsp;";
$MESS['ddeliveryddelivery_LBL_CACHEKILLED'] = "Кэш модуля очищен.";
$MESS['ddeliveryddelivery_LBL_SURETOREWRITE'] = "Все города Битрикса будут заново синхронизированы со ddeliveryом. После синхронизации не забудьте перепроверить 'Город-отправитель' и нажать 'Сохранить'. Продолжить?";
//прочее
$MESS['ddeliveryddelivery_OTHR_schet'] = "Отправлено заявок:";
$MESS['ddeliveryddelivery_OTHR_schet_BUTTON'] = "Сбросить счетчик";
$MESS['ddeliveryddelivery_OTHR_schet_ALERT'] = "Счетчик используется для синхронизации заявок и ответов. Все равно сбросить?";
$MESS['ddeliveryddelivery_OTHR_schet_DONE'] = "Счетчик сброшен";
$MESS['ddeliveryddelivery_OTHR_schet_NONE'] = "Ошибка сброса счетчика ";

$MESS['ddeliveryddelivery_OTHR_lastModList'] = "Последняя синхронизация:";
$MESS['ddeliveryddelivery_OTHR_lastModList_BUTTON'] = "Синхронизировать";

$MESS['ddeliveryddelivery_OTHR_getOutLst_BUTTON'] = "Проверить сейчас";
$MESS['ddeliveryddelivery_OTHR_getOutLst_BUTTON_OT'] = 'Проверить статусы';
$MESS['ddeliveryddelivery_OTHR_rewriteCities_BUTTON'] = 'Переопределить города';

$MESS['ddeliveryddelivery_OTHR_NOTCOMMITED'] = 'не проводилась.';

$MESS['ddeliveryddelivery_OTHR_killReq_BUTTON'] = "Отозвать заявку";
$MESS['ddeliveryddelivery_OTHR_killReq_TITLE'] = "Отзыв заявки";
$MESS['ddeliveryddelivery_OTHR_killReq_DESCR'] = "Функционал предназначен для отзыва заявок со статусом \'ERROR\' и сообщением \'Заказ с номером # уже загружен\'. Такая ситуация может возникнуть в случае, если необходимо отозвать заявку к заказу, который был подтвержден, но впоследствии по каким-то причинам отослан заново и получил вместо статуса OK статус ERROR.";
$MESS['ddeliveryddelivery_OTHR_killReq_LABEL'] = "Номер заказа: ";
$MESS['ddeliveryddelivery_OTHR_killReq_HINT'] = "Имейте ввиду, что попытка отозвать заявку со статусами кроме ERROR и OK потерпит крах.";

$MESS['ddeliveryddelivery_OTHR_NO_REQ'] = "Заявки еще не создавались";

$MESS['ddeliveryddelivery_OTHR_ADDCITY'] = "Еще город";

$MESS['ddeliveryddelivery_OTHR_ACTSONLY']  = "Только акты";
$MESS['ddeliveryddelivery_OTHR_ACTSORDRS'] = "Акты и заказы";

$MESS['ddeliveryddelivery_OTHR_ALWAYS'] = "Всегда";
$MESS['ddeliveryddelivery_OTHR_DELIVERY'] = "Доставка ddelivery";

$MESS['ddeliveryddelivery_OPT_clrUpdt_ALERT'] = "Очистить информацию об обновлении? Она будет удалена для всех пользователей!";
$MESS['ddeliveryddelivery_OPT_clrUpdt_ERR'] = "Не получилось удалить информацию об обновлении.";

$MESS['ddeliveryddelivery_FNDD_ERR_HEADER'] = "В процессе работы возникали ошибки";
$MESS['ddeliveryddelivery_FNDD_ERR_TITLE'] = "за подробностями обратитесь к <a href='/bitrix/js/ddelivery.ddelivery2/errorLog.php' target='blank'>лог-файлу</a>.<br><small>Чтобы убрать это оповещение - очистите лог-файл.</small>";

$MESS['ddeliveryddelivery_NO_ADOST_HEADER'] = "Служба доставки ddelivery отключена";
$MESS['ddeliveryddelivery_NO_ADOST_TITLE'] = "Чтобы служба доставки отображалась на странице оформления заказа - <a href='/bitrix/admin/sale_delivery_handler_edit.php?SID=ddelivery' target='_blank'>поставьте ей активность</a>.";

$MESS['ddeliveryddelivery_NO_DOST_HEADER'] = "Служба доставки ddelivery удалена";
$MESS['ddeliveryddelivery_NO_DOST_TITLE'] = "Служба доставки была удалена. Чтобы вернуть ее - переустановите модуль.";

$MESS['ddeliveryddelivery_NOT_CRTD_HEADER'] = "Служба доставки ddelivery не найдена";
$MESS['ddeliveryddelivery_NOT_CRTD_TITLE'] = "Служба доставки не найдена. Необходимо добавить службу доставки.<br> Для добавления доставки ddelivery воспользуйтесь кнопкой \"Добавить службу доставки ddelivery\". В случае, когда по нажатию кнопки служба доставки не добавляется, необходимо обновить платформу Битрикс, если по неким причинам сделать это нет возможности, добавьте службу доставки самостоятельно: Магазин - Настройки - Служб доставки, нажать кнопку \"Добавить\", в меню выбрать \"Автоматизированная служба доставки\", во вкладке \"Настройки обработчика\" в настройке \"Служба доставки\" указать обработчик ddelivery.";
$MESS['ddeliveryddelivery_NOT_CRTD_TITLE_BUTTON'] = "Добавить службу доставки ddelivery";
$MESS['ddeliveryddelivery_NOT_CRTD_UNKNOWN_ERROR'] = "Произошла неизвестная ошибка.";
$MESS['ddeliveryddelivery_NOT_CRTD_SUCCESS'] = "Служба доставки ddelivery успешно добавлена.";

$MESS['ddeliveryddelivery_NO_PROFILE_HEADER_pickup'] = "Отключены все тарифы самовывоза";
$MESS['ddeliveryddelivery_NO_PROFILE_HEADER_courier'] = "Отключены все курьерские тарифы";
$MESS['ddeliveryddelivery_NO_PROFILE_TITLE'] = "Профиль не будет отображаться на странице оформления заказа, пока не будет включен хотя бы один соответствующий тариф (опция \"Управление тарифами\").";

$MESS ['ddeliveryddelivery_BGMSC'] = "МОСКВА";
$MESS ['ddeliveryddelivery_NO_CITIES_FOUND'] = "Ошибок при синхронизации городов с местоположениями Битрикс пока не обнаружено.<br>Скорей всего, эта синхронизация еще не запускалась.<br>Для запуска вручную воспользуйтесь кнопкой \"Синхронизироваьт\" в Сервисных свойствах закладки Настройки.";
//Автовыставление платежных систем, с которых курьер деньги не берет
$MESS ['ddeliveryddelivery_cashe'] = "наличны";
$MESS ['ddeliveryddelivery_cashe2'] = "наложный";
$MESS ['ddeliveryddelivery_cashe3'] = "при получении";
//FAQ города
$MESS ['ddeliveryddelivery_FAQ_HDR_CITYHINT'] = "Пояснение по таблицам";
$MESS ['ddeliveryddelivery_FAQ_CITYHINT_DESCR'] = "Чтобы отсылать заявку в ddelivery, необходимо отослать id местоположения города-получателя в системе ddelivery. Чтобы выяснить этот id, модуль регулярно проводит синхронизцию местоположений, имеющихся на сайте с местоположениями ddeliveryа. В процессе синхронизации могут произойти ситуации, когда \"город\" ddeliveryа не найден среди местоположений Битрикса (ведь у ddeliveryа их около четырех с половиной тысяч, в то время как стандартные местоположения Битрикса ограничиваются полуторами). Данные таблицы несут справочный характер для решения спорных ситуаций.<br><br>Наибольшую ценность представляет из себя группа \"Конфликтующие\" - это те местоположения Битрикса, которым соответствуют два или более местоположений ddeliveryа. Например, в Ленинградской области есть два населенных пункта с названием \"Никольское\", в то время как в Битриксе есть только одно местоположение с таким названием. В таблице указано местоположение, для которого рассчитывается доставка при оформлении заказа. Перед созданием заявки необходимо уточнить у клиента, какой именно населенный пункт имелся в виду при оформлении заказа. Если подразумевался тот, что является претендентом - его нужно выбрать в выпадающем списке.";
//FAQ
$MESS ['ddeliveryddelivery_FAQ_HDR_SETUP'] = "Установка";
$MESS ['ddeliveryddelivery_FAQ_WTF_TITLE'] = "- Для чего нужен модуль";
$MESS ['ddeliveryddelivery_FAQ_WTF_DESCR'] = "Модуль обеспечивает интеграцию Интернет-магазина со службой доставки <a href='http://ddelivery.ru/' target='_blank'>ddelivery</a>. Дает возможность отправки заявок на доставку заказов, обмен статусами заказов и выставление соответствующих им статусов в админке Битрикса. В модуле присутствует функционал печати актов и товарных накладных для заказов, возможна массовая печать заказов.<br>Вместе с модулем устанавливаются автоматизированные службы доставки ddelivery, позволяющие покупателям выбрать способ доставки. Стоимость доставки вычисляется с помощью API ddeliveryа с учетом габаритов заказа.";
$MESS ['ddeliveryddelivery_FAQ_HIW_TITLE'] = "- Как работает модуль";
$MESS ['ddeliveryddelivery_FAQ_HIW_DESCR'] = "Состав модуля:
<ul>
	<li>функционал автоматизированных служб доставки;</li>
	<li>функионал расчета стоимости доставки;</li>
	<li>функционал отображения информации о пунктах самовывоза;</li>
	<li>функционал оформления заявки на доставку;</li>
	<li>функционал оформления заявки на вызов курьера;</li>
	<li>функционал печати заказов и актов;</li>
	<li>функионал синхронизации местоположений сайта с базой городов ddelivery;</li>
	<li>база данных с отосланными заявками;</li>
	<li>прочий функционал</li>
</ul>
<p>Модуль создает новую <a href='/bitrix/admin/sale_delivery_handler_edit.php?SID=ddelivery' target='_blank'>автоматизированную службу доставки</a> с кодом ddelivery. У службы один профиль DDelivery, который отображается на странице оформления заказа.</p>
<p>Модуль использует встроенный функционал рассчета габаритов заказа и API ddeliveryа для вычисления стоимости доставки при оформлении заказа.</p>
<p>Модуль устанавливает компонент \"Пункты самовывоза ddelivery\", который отображает виджет расчета доставок, позволяющий выбрать способ доставки, указать адрес получения или выбрать пункт самовывоза на карте.</p>
<p>Заявка на доставку составляется для каждого заказа в отдельности, причем контроль за корректностью введенных данных возлагается на пользователя. При сохранении данные о заявке сохраняются в базу данных. При отсылании заявки модуль формирует запрос в ddelivery и отсылает его на сервер. Результат обработки заявки приходит сразу же, выдавая либо ошибку, либо информацию об успешном принятии заявки.</p><br><br>";

// FAQ: Начало работы
$MESS ['ddeliveryddelivery_FAQ_HDR_ABOUT'] = "Начало работы";

$MESS ['ddeliveryddelivery_FAQ_TURNON_TITLE'] = "- Включение функционала";
$MESS ['ddeliveryddelivery_FAQ_TURNON_DESCR'] = "<p>1. После установки модуля, убедитесь, что в мониторе проверки системы нет критических ошибок в работе сайта (<a href = '/bitrix/admin/site_checker.php?lang=ru'>Настройки - Инструменты - Проверка системы</a>), их наличие может привести к частичной или полной неработоспособности как модуля, так и сайта.</p>";

$MESS ['ddeliveryddelivery_FAQ_TURNON_DESCR'] .= "<p>2. Для корректной работы модуля необходимо в настройках php включить поддержку PDO и драйвера PDO для типа базы данных, которая используется на сайте. Если в процессе работы модуля на каком-либо шаге появится ошибка \"Class PDO not found in\", обратитесь к хостеру сайта.</p>";

$MESS ['ddeliveryddelivery_FAQ_TURNON_DESCR'] .= "<p>3. Обмен данными с DDelivery осуществляется посредствам API-ключа, получить его можно в личном кабинете <a href = 'http://cabinet.ddelivery.ru/user2/'>ddelivery</a>, регистрация не требует заключения договора с DDelivery.<br>После регистрации в личном кабинете необходимо добавить <b>склад</b>. Далее создать <b>магазин</b> и привязать к нему склад. После создания магазина будет создан API-ключ, его необходимо ввести в настройках модуля в соответствующее поле.<br><b>Без API-ключа модуль работать не будет!</b></p><p><b>Тестовый режим</b> использует тестовый API-ключ для демонстрации возможностей модуля, созданные и переданные заказы в этом режиме в личном кабинете не появятся.</p>";

$MESS ['ddeliveryddelivery_FAQ_TURNON_DESCR'] .= "<p>4. Внесение API-ключа в настойках модуля позволит получить доступ к настройкам на стороне DDelivery, воспользоваться ими возможно нажатием кнопки \"Привязать ключ к магазину\" в настройках модуля. В настройках проверьте корректность поля \"Ваш API-ключ\", он будет привязан к магазину после первого сохранения настроек в окне, <b>это дейтсвие является обязательным для корректной работы модуля</b>. Также в окне настроек можно указать используемые для расчета службы доставки, указать соответсвие статусов на сайте и DDelivery, настроить наценки на доставку, добавить свои варианты доставки для расчета и многое другое.</p><p>Если по нажатию кнопки \"Привязать ключ к магазину\", окно не открывается или открывается с ошибкой, то необходимо выполнить пункт 1 данного руководства либо удалить старую привязку ключа к магазину в личном кабинете DDelivery, сделать это можно в личном кабинете сервиса <a href = 'http://cabinet.ddelivery.ru/user2/'>ddelivery</a>. После удаления привязки, выполните все указанные выше действия.</p>";

$MESS ['ddeliveryddelivery_FAQ_TURNON_DESCR'] .= "<p>5. После установки модуля может не быть создана служба доставки DDelivery и создать ее потребуется самостоятельно: <a href = '/bitrix/admin/sale_delivery_handlers.php?lang=ru' target = '_blank'>Магазин - Настройки - Службы доставки</a>. В зависимости от версии ядра Битрикс, список доставок может быть разбит на настраиваемые и автоматизированные, либо представлен единым списком.<br><br>Если службы доставки представлены единым списком, то удалите службу доставки ddelivery и выполните следующие действия: Магазин - Настройки - Служб доставки, нажать кнопку \"Добавить\", в меню выбрать \"Автоматизированная служба доставки\", во вкладке \"Настройки обработчика\" в настройке \"Служба доставки\" указать обработчик ddelivery.<br><br>Если доставки разбиты на автоматизированные и настраиваемые, то необходимо <b>очистить настройки</b> обработчика службы доставки ddelivery, для этого в списке автоматизированных служб слева от ddelivey нажмите на кнопку сендвич и выберите пункт \"очистить настройки обработчика\".</p>";

$MESS ['ddeliveryddelivery_FAQ_TURNON_DESCR'] .= "<p><b>После выполнения первых 5 пунктов данного руководства модуль настроен и готов к работе.</b></p>";

$MESS ['ddeliveryddelivery_FAQ_TURNON_DESCR'] .= "<p>6. <b>Не является обязательным шагом.</b> Модуль осуществляет двухстороннюю обратную связь между страницей оформления заказа и виджетом выбора способов доставки. Чтобы со страницы оформления заказа передавать значения адресных полей в виджет должны буть созданы свойства \"Улица\", \"Дом\", \"Квартира\". <b>У каждого свойства для разных типов плательщиков необходимо указать один и тот же символьный код.</b> После создания свойств необходимо указать их коды в настройках модуля в соответсвующих полях.</p>";

$MESS ['ddeliveryddelivery_FAQ_TURNON_DESCR'] .= "<p>7. <b>Не является обязательным шагом.</b> Изменение статусов заказов в сервисе DDelivery может изменять статусы заказов на сайте, для этого необходимо настроить соответсвие статусов в окне привязки API-ключа и включить настройку \"PUSH-сообщения\", а в поле адрес ввести <b>{адрес сайта с http://}</b>/bitrix/js/ddelivery.ddelivery2/ajaxSDK.php</p>";

$MESS['ddeliveryddelivery_FAQ_DELSYS_TITLE'] = "- Настройка службы доставки";
$MESS['ddeliveryddelivery_FAQ_DELSYS_DESCR'] = "
<p>
	<strong>1. Управление службами доставки</strong> находится на <a href='/bitrix/admin/sale_delivery_handler_edit.php?SID=ddelivery' target='_blank'>странице настроек автоматизированных служб доставки</a>. Здесь можно настроить: <ul><li>Активность службы доставки и ее профилей</li><li>Название и описание службе доставки и ее профилям</li><li>Наценку на стоимость доставки</li><li>Привязку профилей к платежным системам</li><li>Ограничения по габаритам и стоимости заказа</li></ul>
</p>
<p>
	<strong>2. Привязка способа оплаты к Службе Доставок.</strong><br>
	Для того, чтобы привязать платежные системы к конкретным вариантам доставки используйте стандартный функционал Bitrix (доступен с 14-й версии) - в <a href='/bitrix/admin/sale_pay_system.php' target='_blank'>настройках платежных систем</a> откройте нужную плат.систему и во вкладке 'Службы доставки' выберите службы для которых будет доступна данная платежная система.
</p>
<p>
	<strong>3. Отображается кнопка 'расcчитать стоимость'.</strong><br>
		Для того, чтобы стоимость расчитывалась автоматом, необходимо в параметрах компонента оформления заказа (sale.order.ajax) поставить галочку 'Рассчитывать стоимость доставки сразу'.
</p>
"/*."<p>
	<strong>4. Вывести дату доставки.</strong><br>
		Если необходимо вывести ближайшую дату доставки в формате день.месяц.год - достаточно в нужном месте в шаблоне оформления заказа вставить следующую конструкцию: 
		<div style='color:#AC12B1'><pre>
&lt;?
	if(cmodule::includeModule('ddelivery.ddelivery2'))
		echo CDeliveryddelivery::\$date;
?&gt;
		</pre></div>
</p>
"*//*."
<p>
	<strong>4. Не отображается срок доставки.</strong><br>
	Если это происходит при выборе профиля доставки - это обычная ошибка шаблона оформления заказа.
</p>
*/."
<p>
	<strong>4. Не отображается ссылка \"Выбрать пункт самовывоза\".</strong><br>
	Обратитесь к настройке <strong>ID элемента, куда привязывать ссылку \"Выбрать пункт самовывоза\".</strong>
</p>
<p>
	<strong>5. Учет веса заказа.</strong><br>
		Ограничения по весу заказа учитываются самим модулем при расчете служб доставки. Данные о весе товара берутся только из торгового каталога. Если модуль некорректно обрабатывает вес заказа - проверьте в первую очередь настройки торгового каталога в товаре.
</p>
<p>
	<strong>6. Не передается артикул товара.</strong><br>
		Для передачи в заявке артикула товаров необходимо указать код свойства товара, которое используется как артикул, в настройках модуля. В настройках компонента каталога в разделе \"Добавление в корзину\" необходимо отметить, что это свойство передается в корзину.
</p>
";

$MESS['ddeliveryddelivery_FAQ_SEND_TITLE'] = "- Оформление и отправка заявки";
$MESS['ddeliveryddelivery_FAQ_SEND_DESCR'] = "<p>
	<strong>1. Заполнение полей</strong><br>
	Заполнить данные для доставки можно на странице заказа (Магазин -> Заказы -> Нужный заказ). Нужное окно вызывается кнопкой \"ddelivery доставка\".<br>
	<img src=\"/bitrix/images/ddelivery.ddelivery2/FAQ_1.png\"><br><br>
	В открывшемся окне выведется копия виджета со страницы оформления заказа. По необходимости возможно изменение полей и способа доставки.<br><br>
</p>
<p>
	<strong>2. Отправка заявки</strong><br>
	Если заявка готова к отправке - нажмите клавишу \"Сохранить и отправить\". После оповещения, что заявка сохранена, можно закрыть окно. Если при отравке возникнут ошибки, их можно просмотреть в этом же окне под виджетом.<br>
	Заявку можно отправить без открытия вмджета и редактирования полей установкой флага отгрузки заказа. Для групповой отправки заявок, в списке заказов необходимо отметить галочками нужные заказы и разрешить отгрузку.<br>
</p>
<p>
	<strong>3. Передача артикула</strong><br>
	Описание действий для корректной передачи артикула описано в разделе \"Настройка службы доставки\" в пункте 6.<br>
</p>
<p>
	<strong>4. Печать документов</strong><br>
	После удачной отправки заявки, есть возможность печати ярлыков для отправки. Существует две возможности получения документов:<br>1. На странице карточки заказа повторно нажать кнопку \"ddelivery доставка\", в окне будет отображена информация о заявке и кнопка печати документов.<br>2. В окне списка заказов отметить необходимые заказы галочками и в меню действий выбрать \"Печать ddelivery\".<br><br>Важно! После выгрузки, заказ проходит ряд проверок в службе доставки и получение документов во время этого процесса невозможна, об этом будет свидетельствовать сообщение при попытке печати документов \"Order not found\", необходимо ожидать некоторое время. Также эта ошибка может быть при групповой печати документов, если хотя бы для одного заказа документы еще недоступны, то будет выведена данная ошибка.<br>
</p>";

	// FAQ: Дополнительные возможности
$MESS['ddeliveryddelivery_FAQ_HDR_WORK'] = "Дополнительные возможности";

/*
$MESS['ddeliveryddelivery_FAQ_PELENG_TITLE'] = "- Отслеживание состояний";
$MESS['ddeliveryddelivery_FAQ_PELENG_DESCR'] = "<p>
	<strong>1. Таблица заявок</strong><br>
	Таблица заявок находится на вкладке \"Заявки\". На этой странице можно ознакомиться с состояниями всех имеющихся заявок, с возможностью их фильтрации и сортировки.<br>
	<img src=\"/bitrix/images/ddelivery.ddelivery2/FAQ_3.png\"><br>
	С помощью опций можно изменить поля неотправленной заявки, а так же стереть информацию о ней.<br>
	Принятые заявки отсюда можно отозвать и удалить, распечатать к ней квитанцию, а так же - отследить с помощью функционала сайта ddelivery.<br>
	В случае принятия заявки все эти действия можно производить и из окна оформления заявки на странице заказа.<br>
	Кнопка \"Отозвать заявку\" служит для стирания информации о заявке любой ценой, независимо от того, загрузилась он или нет (Это может помочь, если заказ был выгружен в ddelivery в тестовом режиме, и нужно отослать его в рабочем).
</p>
<p>
	<strong>2. Обновление информации о заявке</strong><br>
	Опрос статусов заказов происходит каждые 30 минут. Если статус изменился - он поменяется в таблице Заявок, а так же сменится статус заказа на выставленный в настройках модуля (или не сменится, если он не выставлялся).
</p>
<p>
	<strong>3. Статусы заказов</strong><br>
	Каждый заказ имеет свой статус, описание текущего статуса можно увидеть в таблице заявок в столбце \"Сообщение\".
</p>
<p>
	<strong>4. Печать квитанции</strong><br>
	Если заявка имеет статус доставлен - значит, ddelivery может прислать файл с квитанцией для распечатки, аналогичный получаемому в личном кабинете. Распечатать его можно либо в окне оформления заявки на странице заказа, либо в таблице заявок. Рекомендуется сохранять pdf-файл с квитанцией на компьютере, после чего - открывать его и распечатывать.
</p>";
*/

$MESS['ddeliveryddelivery_FAQ_SENDER_TITLE'] = "- Выбор Отправителя";
$MESS['ddeliveryddelivery_FAQ_SENDER_DESCR'] = "<p>По умолчанию адрес и контактные данные Отправителя берутся из настроек личного кабинета ddeliveryа. Если необходимо вызвать курьера в иное место - нужно выбрать тариф \"дверь-\" и оформить заявку на вызов курьера. Для этого необходимо в форме оформления заявки выбрать соответствующий тариф и нажать на кнопку \"Указать информацию об Отправителе (заказ курьера)\".<p>
<p><img src='/bitrix/images/ddelivery.ddelivery2/FAQ_5.png'></p>
<p>Все поля, кроме комментария являются обязательными к заполнению. Если предполагается забивать данные склада (то есть, регулярно использовать одного и того же Отправителя) - можно сохранить информацию о нем в настройках: Настройки -> Отправители (для тарифов \"дверь-\") и впоследствии выбирать в форме оформления заявки в графе \"Сохраненный отправитель\".</p>
<p><span style='color:red'>Внимание!</span> Функционал Интеграции ddeliveryа не предполагает возможности проверять статус заявки на вызов курьера! Чтобы проверить корректность переданных данных о курьере необходимо обращаться в Call-центр ddelivery, телефон к которому можно найти на сайте ddeliveryа. В личном кабинете эта информация НЕ отображается: отправитель у заказа все равно будет стоять тот, что указан в настройках ЛК. Техподдержка ddeliveryа, и, самое главное, техподдержка модуля НЕ может ответить, создалась заявка на курьера или нет. Только Call-центр.</p>";

$MESS['ddeliveryddelivery_FAQ_CNTDOST_TITLE'] = "- Особенности расчета стоимости доставки";
$MESS['ddeliveryddelivery_FAQ_CNTDOST_DESCR'] = "Стоимость доставки расчитывается с помощью калькулятора тарифов ddelivery, она же отображается покупателю при оформлении заказа.<br>Стоимость доставки зависит от габаритов заказа: его размеров и веса. Если в заказе несколько товаров - модуль считает их единой коробкой и выводит стоимость доставки для этой упаковки.<br>Задавать произвольную стоимость доставки, а так же изменять габариты посылки на данный момент нельзя.<br><br>
Отключать или управлять рассчитываемыми тарифами на данный момент нельзя.<br>
<span style='color:red'>Важно!</span> Стоимость и сроки доставки рассчитываются на стороне API ddelivery и могут отличаться при изменении габаритов или веса заказа.";

/*
$MESS['ddeliveryddelivery_FAQ_COMPONENT_TITLE'] = "- Компонент \"Пункты Самовывоза ddelivery\"";
$MESS['ddeliveryddelivery_FAQ_COMPONEMT_DESCR'] = "Компонент используются в первую очередь на странице оформления заказа, так же его можно использовать на странице доставки, чтобы вывести информацию о самовывозах, стоимости и сроках доставки для всех профилей. <strong>На странице оформления заказа компонент подключать не нужно!</strong> Он подключится автоматически.<br>Компонент предназначен для вывода карты с отображением на ней пунктов самовывоза и информации о них, а так же проведения различных манипуляций вроде выбора пункта для доставки. Функционал выбора пункта самовывоза на странице оформления заказа реализован с помощью этого компонента. Его так же можно использовать, чтобы отображать информацию о пунктах самовывоза в разделе \"Доставка\".<br>
Вставить компонент на страницу можно с помощью визуального редактора. Расположен он по пути \"Магазин\" -> \"Компоненты ddelivery\". Если после установки модуля компонент в визуальном редакторе не появился - попробуйте <a href='/bitrix/admin/cache.php' target='_blank'>очистить файлы кэша</a> Битрикса.<br>
<img src=\"/bitrix/images/ddelivery.ddelivery2/componentAdd.png\"><br>
Компонент так же можно вставить php-кодом:<br>
<div style='color:#AC12B1'>
&lt;?\$GLOBALS['APPLICATION']->IncludeComponent(\"ddelivery:ddelivery.ddelivery2Pickup\",\".default\",array(),false);?&gt;
</div>
Компонент имеет следующие настройки:<br>
<ul>
	<li>Не подключать Яндекс-карты - если на странице с компонентом код Яндекс-карт подключается где-либо еще (в особенности - если подключается версия не 2.1), нужно поднять этот флаг, чтобы скрипты не конфликтовали.</li>
	<li>Отображать окно выбора города - указывает отображать ли поле ввода города.</li>
	<li>Отображать рассчитанный тариф курьерской доставки - если необходимо вывести информацию о стоимости и сроках доставки курьером, необходимо отметить данную опцию.</li>
	<li>ID города для отображения - задает город получатель для компонента.</li>
	
</ul>
Вместе с компонентом поставляются два шаблона:
<ul>
	<li>.default - шаблон, предназначенный для отображения информации о пунктах самовывоза.</li>
	<li>order - шаблон, используемый для выбора пункта самовывоза при оформлении заказа.</li>
</ul>
Крайне не рекомендуется модифицировать эти шаблоны, в особенности - их скрипт. При необходимости вынесете их в отдельное пространство имен, иначе корректная работа модуля (в особенности - при оформлении заказа) не гарантируется.
";
*/

$MESS['ddeliveryddelivery_FAQ_MULTISITE_TITLE'] = "- Многосайтовость";
$MESS['ddeliveryddelivery_FAQ_MULTISITE_DESCR'] = "Для обеспечения многосайтовости (работы нескольких админок от одного аккаунта ddelivery) необходимо задать каждому сайту свой шаблон генерации номеров заказов, чтобы они не пересекались. Шаблоны задаются в <a href='/bitrix/admin/settings.php?mid=sale'>настройках Интернет-магазина</a> в опции \"Шаблон генерации номера заказа\". Самый простой вариант - задать уникальный префикс для каждого сайта.<br>Если на сайтах будет задан одинаковый шаблон - некоторые заказы не будут отсылаться в ЛК ddelivery, так как их номера будут совпадать с теми, что уже были выгружены.<br><br>";

$MESS['ddeliveryddelivery_FAQ_ERRORS_TITLE'] = "- Уведомления и обновления";
$MESS['ddeliveryddelivery_FAQ_ERRORS_DESCR'] = "<p>
	<strong>1. Ошибки</strong><br>
	В процессе работы не исключены возможности возникновения ошибок. Все они находятся в файле <a href='/bitrix/js/<?=$module_id?>/errorLog.txt' target='_blank'>логов</a>. В случае, если возникли ошибки, на странице настроек будет выведено оповещение о них.<br>
	<img src=\"/bitrix/images/ddelivery.ddelivery2/FAQ_4.png\"><br>
	Оповещение убирается путем очистки файла логов.
</p>
<p>
	<strong>2. Обновления</strong><br>
	Раз в день модуль запрашивает сервер ddelivery на наличие обновлений в пунктах самовывоза, а так же запрашивает новый файл с городами.<br>
	Чтобы вручную запросить информацию о наличии обновлений, нажмите кнопку \"Синхронизировать\" во вкладке \"Настройки\" -> \"Сервисные свойства\". \"Дата последней синхронизации\" - дата, когда в последний раз запрашивалась информация.<br>
</p>
<p>
	<strong>3. Частые проблемы</strong><br>
	<ul><li>Заказ не появляется в ЛК</li></ul>
	Скорей всего причина в том, что заявка была отправлена в тестовом режиме. Проверьте введеный Account в разделе настроек: если он соответствует тестовому, необходимо разлогиниться и авторизоваться под боевым, но прежде - отозвать те заявки, которые были отосланы. Сделать это можно на закладке \"Заявки\", выбрав в выпадающем списке пункт \"Отозвать заявку\".<br>
	Если же заказы были уже отправлены без проверки их наличия в ЛК, необходимо связаться со ddeliveryом и уточнить их статус по номеру отправления.	
	<ul><li>Не отсылается заявка из-за ошибки ERR_CASH_ON_DELIV_PAYREC_MISTAKE</li></ul>
	В городе отправления невозможен наличный платеж. Отслеживание городов с невозможностью совершить наложный платеж и последующим отключением платежной системы, связанной с наличной оплатой, будет обеспечено в ближайших обновлениях.
</p>
";

$MESS['ddeliveryddelivery_FAQ_PROBLEMS_TITLE'] = "- Частые проблемы";
$MESS['ddeliveryddelivery_FAQ_PROBLEMS_DESCR'] = "<p><strong>Служба доставки не отображается.</strong>
<ul>
	<li>Убедитесь, что вы авторизованы в модуле.</li>
	<li>Убедитесь, что в настройках модуля выбран город-отправитель.</li>
	<li>Проверьте активность у <a href='/bitrix/admin/sale_delivery_handler_edit.php?SID=maxipost' target='_blank'>службы доставки</a> и ее профилей.</li>
	<li>Проверьте доступность службы доставка в настройках <a href='/bitrix/admin/sale_pay_system.php' target='_blank'>платежных систем</a>.</li>
</ul></p>
<p><strong>Не показывается выбор ПВЗ на странице оформления заказа.</strong>
<ul>
	<li>Если используется кастомный шаблон оформления заказа - задайте настройку \"ID элемента, в котором выводить информацию о ПВЗ в оформлении заказа\". Обязательно прочитайте подсказку-пояснение.</li>
	<li>Убедитесь, что в консоли (страница оформления заказа -> F12) нет ошибок в JavaScript.</li>
	<li>Убедитесь, что задана настройка \"Код свойства, куда будет сохранен выбранный пункт самовывоза\" в Настройки -> Настройки виджета.</li>
</ul>
</p>
<p><strong>Не отображается кнопка \"ddelivery доставка\" для оформления заявки.</strong>
<ul>
	<li>Убедитесь, что вы авторизованы в модуле.</li>
	<li>Убедитесь, что вы находитесь на странице детальной информации о заказа (sale_order_detail.php), а не его редактирования.</li>
	<li>Убедитесь, что в консоли (страница оформления заказа -> F12) нет ошибок в JavaScript.</li>
	<li>Если задана настройка \"Отображать кнопку заявки в заказах\" в \"Доставка ddelivery\" - что доставкой выбрана служба доставки ddelivery модуля.</li>
</ul>
</p>
<p><strong>Не отсылается заявка.</strong>
<ul>
	<li>Убедитесь, что исправлены все возможные ошибки в полях (неверный формат телефона, заполнены все необходимые поля, определен город-получатель).</li>
	<li>Удалите (замените) из полей символы кавычек, углобые скобки, итп.</li>
	<li>Убедитесь, что на странице оформления доставок после очистки кэша (в настройках модуля) продолжают отображаться доставки. Если нет - сервер ddelivery \"лежит\".</li>
</ul>
</p>
<p><strong>Ничего не помогло.</strong>
По всем вопросам по настройке модуля можно обращаться на support@ddeliveryh.com.
При обращении укажите, пожалуйста:
<ul><li>модуль, с которым возникла проблема</li><li>подробное описание проблемы</li><li>Номер договора со ddelivery (указывать обязательно)</li><li>FAQ решить ее не помог</li></ul>
Для диагностирования проблемы нам точно потребуются доступы к админке Битрикса и, скорей всего, к ftp или ssh (так как проводить диагностику через админку черевато падением сайта).
</p>";

$MESS['ddeliveryddelivery_FAQ_CONVERT_TITLE'] = "- Интернет-магазин v 15.5 и конвертация";
$MESS['ddeliveryddelivery_FAQ_CONVERT_DESCR'] = "Модуль поддерживает работу конвертированных интернет-магазинов. Если магазин конвертирован и после установки модуля не появился профиль доставки ddelivery, то в настройках модуля необходимо добавить его нажатием на соответсвующую кнопку. Если конвертация магазина происходит на сайте с установленным модулем и не появился профиль, то действия аналогичны. После добавления профиля модуль будет функцианировать.";

$MESS['ddeliveryddelivery_FAQ_OTHER_TITLE'] = "- Прочее";
$MESS['ddeliveryddelivery_FAQ_OTHER_DESCR'] = "<p>
	<strong>1. Импорт городов ddelivery</strong><br>
	На данный момент импорт городов, в которые осуществляется доставка ddeliveryом, возможен только для Местоположений 1.0, а так же при наличии опытного программиста. Данный функционал предоставляется \"Как есть\" и корректная его работа при любых конфигурациях Битрикса не гарантируется. <span style='text-decoration:line-through'>Лучше от него воздержаться</span>.<br>
	Порядок импорта:<br>
	<ol>
		<li>Сделать резервную копию. Серьезно.</li>
		<li>Выполнить следующий код:<div style='color:#AC12B1'>
		<pre>
cmodule::includeModule('sale');
cmodule::includemodule('ddelivery.ddelivery2');
\$exportClass = new cityExport();
\$exportClass->loadCities();

echo \"&lt;pre&gt;\";
print_r(\$exportClass->result);
echo \"&lt;/pre&gt;\";
		</pre>
		</div></li>
		<li>Продолжать выполнение, пока <span style='color:#AC12B1'>\$exportClass->result['result']</span> не станет равным done.</li>
		<li>Убедиться в отсутствии необходимости восстанавливать сайт из резервной копии.</li>
	</ol>
</p>";

$MESS['ddeliveryddelivery_JS_SOD_artnumber'] = "Код свойства товара, которое будет передаваться как артикул";
?>