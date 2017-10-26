<?php
/*
Plugin Name: Cute Cat
Plugin URI:
Description: カテゴリーの複数選択を制限する
Version: 1.0
Author: Hiroki Nakashima
Author URI:
License: GPL2
*/


// [カテゴリー追加] [よく使うもの]を非表示にする
function hide_category_tabs_adder() {
	global $pagenow;
	global $post_type;
	if (is_admin() && ($pagenow=='post-new.php' || $pagenow=='post.php')){
		echo '<style type="text/css">
		#category-tabs, #category-adder {display:none;}
		.add-menu-item-tabs, .category-tabs, .wp-tab-bar, .taxonomy-add-new {display:none;}

		.categorydiv .tabs-panel {padding: 0 !important; background: none; border: none !important;}
		</style>';
	}
}
add_action( 'admin_head', 'hide_category_tabs_adder' );

// カテゴリー選択を1つまでに制限
add_action( 'admin_print_footer_scripts', 'limit_category_select' );
function limit_category_select() {
	?>
	<script type="text/javascript">
		jQuery(function($) {
			// 投稿画面のカテゴリー選択を制限
			var cat_checklist = $('.categorychecklist input[type=checkbox]');
			cat_checklist.click( function() {
				$(this).parents('.categorychecklist').find('input[type=checkbox]').attr('checked', false);
				$(this).attr('checked', true);
			});

			// クイック編集のカテゴリー選択を制限
			var quickedit_cat_checklist = $('.cat-checklist input[type=checkbox]');
			quickedit_cat_checklist.click( function() {
				$(this).parents('.cat-checklist').find('input[type=checkbox]').attr('checked', false);
				$(this).attr('checked', true);
			});

			$('.categorychecklist>li:first-child, .cat-checklist>li:first-child').before('<p style="padding-top:5px;">カテゴリーは1つしか選択できません</p>');
		});
	</script>
	<?php
}
