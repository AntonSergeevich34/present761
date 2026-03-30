<?

namespace Iw;

class Main
{
	public static function canonical()
	{
		global $APPLICATION;
        $text = $_SERVER["REQUEST_URI"];

        if (!strpos($text, "PAGEN")) {
            if (stristr($text, "?", true) !== false && !strpos($_SERVER["REQUEST_URI"],"oid")) {
                $text = stristr($_SERVER["REQUEST_URI"], "?", true);
            } else if (stristr($_SERVER["REQUEST_URI"],"oid")) {
                $text = $_SERVER["REQUEST_URI"];
            }

            $APPLICATION->SetPageProperty("canonical", "https://".$_SERVER["HTTP_HOST"].$text);
        }
	}
}