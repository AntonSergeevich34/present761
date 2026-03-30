<?require_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');?>
<script id="ISDEKscript" src="https://widget.cdek.ru/widget/widjet.js"></script>
<?global $arRegion;?>
<script type="text/javascript">
    const ourWidjet = new ISDEKWidjet ({
        defaultCity: '<?=$arRegion["NAME"]?>', //какой город отображается по умолчанию
        link: 'forpvz', // id элемента страницы, в который будет вписан виджет
       	choose: false, // не будем отображать кнопку выбора пункта выдачи
        path: 'https://widget.cdek.ru/widget/scripts/', //директория с библиотеками виджета
        apikey: '4bd28db6-f372-4371-a141-130aed2af1b2', // ключ для корректной работы Яндекс.Карт, получить необходимо тут
    });
</script>

<div id="forpvz"></div>