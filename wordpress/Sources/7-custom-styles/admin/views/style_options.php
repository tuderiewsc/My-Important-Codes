<div class="wrap">
	<?php

	$styleKey = 'ccm_style_key';
	$scriptKey = 'ccm_script_key';

	if (isset($_POST['ccm_save'])){

		$style = trim($_POST['ccm_custom_style']);
		$script = trim($_POST['ccm_custom_script']);

		if (update_option( $styleKey, $style ) || update_option( $scriptKey, $script ) ){
			echo '<div class="updated" id="message">تنظیمات ذخیره شد</div>';
		}else {
			echo '<div class="error" id="message">خطا در عملیات</div>';
		}
	}

	$custom_style = get_option($styleKey);
	$custom_script = str_replace('\\', '', get_option($scriptKey));

	?>


	<h1>تنظیمات</h1>
	<hr>
	<!-- <input type="submit" value="ثبت" class="button-primary">
	<input type="submit" value="ثبت" class="button-secondary">
	<div class="updated" id="message">success</div>
	<div class="error" id="message">error</div>
	<hr> -->

	<form method="post" action="">
		<table class="form-table">
			<tr>
				<th scope="row"><label for="">استایل سفارشی</label></th>
				<td>
					<textarea class="ltr" name="ccm_custom_style" cols="50" rows="10"><?php echo ($custom_style) ? $custom_style : ''  ?></textarea>
				</td>
			</tr>
			<tr>
				<th scope="row"><label for="">اسکریپت سفارشی</label></th>
				<td>
					<textarea class="ltr" name="ccm_custom_script" cols="50" rows="10"><?php echo ($custom_script) ? $custom_script : ''  ?></textarea>
				</td>
			</tr>

			<tr>
				<th><input type="submit" value="ثبت" class="button-primary" name="ccm_save"></th>
			</tr>
		</table>
	</form>

<!-- 	<table class="widefat">
		<thead>
			<tr>
				<th>1</th>
				<th>2</th>
				<th>3</th>
			</tr>
		</thead>
		<tfoot>
			<tr>
				<th>1</th>
				<th>2</th>
				<th>3</th>
			</tr>
		</tfoot>
		<tbody>
			<tr>
				<td>text1</td>
				<td>text2</td>
				<td>text3</td>
			</tr>
		</tbody>
	</table>
	<hr>
	<div class="tablenav">
		<div class="tablenav-pages">
			<span class="displaying-num">صفحه 10</span>
			<span class="page-numbers current">2</span>
			<a href="#" class="page-numbers">3</a>
			<a href="#" class="page-numbers">4</a>
			<a href="#" class="page-numbers">5</a>
			<a href="#" class="next page-numbers">&raquo</a>

		</div>
	</div> -->
</div>