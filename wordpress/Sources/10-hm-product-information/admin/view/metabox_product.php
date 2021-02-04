<?php
$hmpi_product_sizes = get_post_meta( $post->ID, '_hmpi_product_sizes', true );
$hmpi_product_weight = get_post_meta( $post->ID, '_hmpi_product_weight', true );
$hmpi_product_cpu_manufucture = get_post_meta( $post->ID, '_hmpi_product_cpu_manufucture', true );
$hmpi_product_cpu_serie = get_post_meta( $post->ID, '_hmpi_product_cpu_serie', true );
$hmpi_product_cpu_model = get_post_meta( $post->ID, '_hmpi_product_cpu_model', true );
$hmpi_product_frequence = get_post_meta( $post->ID, '_hmpi_product_frequence', true );
//$hmpi_product_cpu_cache = ($hmpiCache = get_post_meta( $post->ID, '_hmpi_product_cpu_cache', true ) ) == '' ? 1 : $hmpiCache;
$hmpi_product_gpu_manufucture = get_post_meta( $post->ID, '_hmpi_product_gpu_manufucture', true );
$hmpi_product_gpu_model = get_post_meta( $post->ID, '_hmpi_product_gpu_model', true );
$hmpi_product_gpu_specific_memory = get_post_meta( $post->ID, '_hmpi_product_gpu_specific_memory', true );
$hmpi_product_gpu_total_memory = get_post_meta( $post->ID, '_hmpi_product_gpu_total_memory', true );
$hmpi_product_gallery_image = get_post_meta( $post->ID, '_hmpi_product_gallery_image', true );
$hmpi_product_discussion = get_post_meta( $post->ID, '_hmpi_product_discussion', true );
?>

<div id="hmpi-product-tab">
    <ul class="category-tabs hmpi-tabs">
        <li><a href="#frag1">مشخصات فیزیکی</a></li>
        <li><a href="#frag2">پردازنده مرکزی</a></li>
        <li><a href="#frag3">پردازنده گرافیکی</a></li>
        <li><a href="#frag4">تصاویر</a></li>
        <li><a href="#frag5">نقد فنی</a></li>
    </ul>
    <br class="clear" />
    <div id="frag1">
        <table class="widefat">
        	<tr>
        		<td>
        			<label for="hmpi_product_sizes">ابعاد: </label>
        			<input type="text" name="hmpi_product_sizes" value="<?php echo esc_attr($hmpi_product_sizes);?>" id="hmpi_product_sizes">
        			<span class="description">29.2 × 256 × 382 میلی‌متر</span>
        		</td>
        		<td>
        			<label for="hmpi_product_weight">وزن</label>
        			<input type="text" name="hmpi_product_weight" value="<?php echo esc_attr($hmpi_product_weight);?>" id="hmpi_product_weight">
        			<span class="description">2.39 کیلوگرم</span>
        		</td>
        	</tr>
        </table>
    </div>
    <div class="hidden" id="frag2">
        <table class="widefat">
        	<tr>
        		<td>
        			<label for="hmpi_product_cpu_manufucture">سازنده: </label>
        			<select name="hmpi_product_cpu_manufucture">
        				<option value="intel" <?php selected($hmpi_product_cpu_manufucture, 'intel');?>>Intel</option>
        				<option value="amd" <?php selected($hmpi_product_cpu_manufucture, 'amd');?>>AMD</option>
        			</select>
        		</td>
        		<td>
        			<label for="hmpi_product_cpu_serie">سری:</label>
        			<select name="hmpi_product_cpu_serie">
        				<option value="corei3" <?php selected($hmpi_product_cpu_serie, 'corei3');?>>core i3</option>
        				<option value="corei5" <?php selected($hmpi_product_cpu_serie, 'corei5');?>>core i5</option>
        				<option value="corei7" <?php selected($hmpi_product_cpu_serie, 'corei7');?>>core i7</option>
        			</select>
        		</td>
        	</tr>
        	<tr>
        		<td>
        			<label for="hmpi_product_cpu_model">سازنده: </label>
        			<input type="text" name="hmpi_product_cpu_model" value="<?php echo esc_attr($hmpi_product_cpu_model );?>" id="hmpi_product_cpu_model">
        			<span class="description">5500U</span>
        		</td>
        		<td>
        			<label for="hmpi_product_frequence">فرکانس: </label>
        			<input type="text" value="<?php echo esc_attr($hmpi_product_frequence );?>" name="hmpi_product_frequence" id="hmpi_product_frequence">
        			<span class="description">2.40GHz up to 3.00 GHz</span>
        		</td>
        	</tr>
<!--        	<tr>
        		<td colspan="2">
        			حافظه کش:
        			<div id="hmpi_product_cpu_cache_slider"></div>
                    <span id="hmpi_product_cpu_cache_preview"><?php echo $hmpi_product_cpu_cache;?> MB</span>
        			<input type="hidden" id="hmpi_product_cpu_cache" name="hmpi_product_cpu_cache" value="<?php echo $hmpi_product_cpu_cache;?>">
        		</td>
        	</tr>-->
        </table>
    </div>
    <div class="hidden" id="frag3">
    <table class="widefat">
        <tr>
    		<td>
    			<label for="hmpi_product_gpu_manufucture">سازنده: </label>
    			<select name="hmpi_product_gpu_manufucture">
    				<option value="nvidia" <?php selected($hmpi_product_gpu_manufucture, 'nvidia');?>>NVidia</option>
    				<option value="intel" <?php selected($hmpi_product_gpu_manufucture, 'intel');?>>Intel</option>
    				<option value="amd" <?php selected($hmpi_product_gpu_manufucture, 'amd');?>>AMD Radeo</option>
    			</select>
    		</td>
    		<td>
    			<label for="hmpi_product_gpu_model">مدل: </label>
    			<input type="text" value="<?php echo esc_attr($hmpi_product_gpu_model );?>" name="hmpi_product_gpu_model" id="hmpi_product_gpu_model">
    			<span class="description">GeForce GT 940M</span>
    		</td>
    	</tr>
    	<tr>
    		<td>
    			<label for="hmpi_product_gpu_specific_memory">حافظه  اختصاصی: </label>
    			<input type="text" value="<?php echo esc_attr($hmpi_product_gpu_specific_memory );?>" name="hmpi_product_gpu_specific_memory" id="hmpi_product_gpu_specific_memory">
    			<span class="description">4GB</span>
    		</td>
    		<td>
    			<label for="hmpi_product_gpu_total_memory">کل حافظه گرافیکی: </label>
    			<input type="text" value="<?php echo esc_attr($hmpi_product_gpu_total_memory );?>" name="hmpi_product_gpu_total_memory" id="hmpi_product_gpu_total_memory">
    			<span class="description">6144 MB</span>
    		</td>
    	</tr>
    </table>
    </div>
    <div class="hidden" id="frag4">
    <?php foreach($hmpi_product_gallery_image as $image):?>
        <p>
            <input type="text" class="ltr" value="<?php echo esc_url( $image );?>" name="hmpi_product_gallery_image[]" style="width: 85%">
            <input type="button" value="افزودن تصویر" class="button-secondary hmpi-upload_image_button">
        </p>
    <?php endforeach;?>
    	<p>
			<input type="text" class="ltr" value="" name="hmpi_product_gallery_image[]" style="width: 85%">
        	<input type="button" value="افزودن تصویر" class="button-secondary hmpi-upload_image_button">
        </p>
    </div>
    <div class="hidden" id="frag5">
    	<?php wp_editor( $hmpi_product_discussion, 'hmpi_product_discussion', array('rows' => 80) );?>
    </div>
</div>
