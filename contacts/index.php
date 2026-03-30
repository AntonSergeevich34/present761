<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty("keywords_inner", "Контакты");
$APPLICATION->SetPageProperty("title", "Контакты");
$APPLICATION->SetPageProperty("keywords", "Контакты");
$APPLICATION->SetPageProperty("description", "Адреса розничных магазинов и способы связи онлайн");
$APPLICATION->SetTitle("Контакты");?>
<?CMax::ShowPageType('page_contacts');?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>