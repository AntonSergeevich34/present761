<? 
namespace Aspro\Max\Functions;
class Extensions extends \CMax{
    public static function register(){
		$arJSCoreConfig = [
			'animation_ext' => [
				'css' => SITE_TEMPLATE_PATH.'/css/animation/animation_ext.css',
			],
			'font_awesome' => [
				'css' => SITE_TEMPLATE_PATH.'/vendor/fonts/font-awesome/css/font-awesome.min.css',
			],
			'top_tabs' => [
				'css' => SITE_TEMPLATE_PATH.'/css/top_tabs.min.css',
			],
			'fancybox' => [
				'js' => SITE_TEMPLATE_PATH.'/js/jquery.fancybox.min.js',
				'css' => SITE_TEMPLATE_PATH.'/css/jquery.fancybox.min.css',
			],
			'owl_carousel' => [
				'js' => SITE_TEMPLATE_PATH.'/vendor/js/carousel/owl/owl.carousel.min.js',
				'css' => [
					SITE_TEMPLATE_PATH.'/vendor/css/carousel/owl/owl.carousel.min.css',
					SITE_TEMPLATE_PATH.'/vendor/css/carousel/owl/owl.theme.default.min.css',
				]
			],
			'top_banner' => [
				'js' => '/bitrix/components/aspro/com.banners.max/common_files/js/script.min.js',
			],
			'video_banner' => [
				'js' => SITE_TEMPLATE_PATH.'/js/video_banner.min.js',
			],
			'swiper_main_styles' => [
				'css' => SITE_TEMPLATE_PATH.'/css/main_slider.min.css',
			],
			'swiper_init' => [
				'js' => SITE_TEMPLATE_PATH.'/js/slider.swiper.min.js',
			],
			'swiper' => [
				'js' => SITE_TEMPLATE_PATH.'/vendor/js/carousel/swiper/swiper-bundle.min.js',
				'css' => [
					SITE_TEMPLATE_PATH.'/vendor/css/carousel/swiper/swiper-bundle.min.css',
					SITE_TEMPLATE_PATH.'/css/slider.swiper.min.css'
				],
				'rel' => [self::partnerName.'_swiper_init'],
			],
			'catalog_element' => [
				'js' => SITE_TEMPLATE_PATH.'/js/catalog_element.min.js',
			],
			'notice' => [
				'js' => '/bitrix/js/'.self::moduleID.'/notice.js',
				'css' => '/bitrix/css/'.self::moduleID.'/notice.css',
				'lang' => '/bitrix/modules/'.self::moduleID.'/lang/'.LANGUAGE_ID.'/lib/notice.php',
			],
		];

		foreach ($arJSCoreConfig as $ext => $arExt) {
			\CJSCore::RegisterExt(self::partnerName.'_'.$ext, array_merge($arExt, ['skip_core' => true]));
		}
	}

	public static function init($arExtensions){
		$arExtensions = is_array($arExtensions) ? $arExtensions : (array)$arExtensions;

		if($arExtensions){
			$arExtensions = array_map(function($ext){
				return strpos($ext, self::partnerName) !== false ? $ext : self::partnerName.'_'.$ext;
			}, $arExtensions);

			\CJSCore::Init($arExtensions);
		}
	}
}
?>