						<?CMax::checkRestartBuffer();?>
						<?IncludeTemplateLangFile(__FILE__);?>
							<?if(!$isIndex):?>
								<?if($isHideLeftBlock && !$isWidePage):?>
									</div> <?// .maxwidth-theme?>
								<?endif;?>
								</div> <?// .container?>
							<?else:?>
								<?CMax::ShowPageType('indexblocks');?>
							<?endif;?>
							<?CMax::get_banners_position('CONTENT_BOTTOM');?>
						</div> <?// .middle?>
					<?//if(($isIndex && $isShowIndexLeftBlock) || (!$isIndex && !$isHideLeftBlock) && !$isBlog):?>
					<?if(($isIndex && ($isShowIndexLeftBlock || $bActiveTheme)) || (!$isIndex && !$isHideLeftBlock)):?>
						</div> <?// .right_block?>
						<?if($APPLICATION->GetProperty("HIDE_LEFT_BLOCK") != "Y" && !defined("ERROR_404")):?>
							<?CMax::ShowPageType('left_block');?>
						<?endif;?>
					<?endif;?>
					</div> <?// .container_inner?>
				<?if($isIndex):?>
					</div>
				<?elseif(!$isWidePage):?>
					</div> <?// .wrapper_inner?>
				<?endif;?>
			</div> <?// #content?>
			<?CMax::get_banners_position('FOOTER');?>
		</div><?// .wrapper?>

		<footer id="footer">
			<?include_once(str_replace('//', '/', $_SERVER['DOCUMENT_ROOT'].'/'.SITE_DIR.'include/footer_include/under_footer.php'));?>
			<?include_once(str_replace('//', '/', $_SERVER['DOCUMENT_ROOT'].'/'.SITE_DIR.'include/footer_include/top_footer.php'));?>
		</footer>
		<?include_once(str_replace('//', '/', $_SERVER['DOCUMENT_ROOT'].'/'.SITE_DIR.'include/footer_include/bottom_footer.php'));?>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const targetDate = new Date(2024, 1, 4); // Февраль: месяц нумеруется с 0
    const currentDate = new Date();

    if (currentDate >= targetDate) {
        // Функция для удаления элементов с классом "price_name"
        const removePriceName = () => {
            const elements = document.querySelectorAll('.price_name');
            elements.forEach(element => element.remove());
        };

        // Используем MutationObserver для отслеживания изменений в DOM
        const observer = new MutationObserver(() => {
            removePriceName();
        });

        // Указываем родительский элемент для отслеживания (корзина или поп-ап)
        const basketPopup = document.querySelector('.basket_hover_block');

        if (basketPopup) {
            observer.observe(basketPopup, { childList: true, subtree: true });
        }

        // Если поп-ап показывается по событию (например, клику)
        document.querySelector('.basket-link').addEventListener('click', () => {
            setTimeout(removePriceName, 100); // Удаляем через небольшой тайм-аут после показа
        });
    }
});

</script>
	</body>
</html>