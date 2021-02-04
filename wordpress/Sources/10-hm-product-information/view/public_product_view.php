<?php
$hmpi_product_sizes = get_post_meta( get_the_ID(), '_hmpi_product_sizes', true );
$hmpi_product_weight = get_post_meta( get_the_ID(), '_hmpi_product_weight', true );
$hmpi_product_cpu_manufucture = get_post_meta( get_the_ID(), '_hmpi_product_cpu_manufucture', true );
$hmpi_product_cpu_serie = get_post_meta( get_the_ID(), '_hmpi_product_cpu_serie', true );
$hmpi_product_cpu_model = get_post_meta( get_the_ID(), '_hmpi_product_cpu_model', true );
$hmpi_product_frequence = get_post_meta( get_the_ID(), '_hmpi_product_frequence', true );
//$hmpi_product_cpu_cache = get_post_meta( get_the_ID(), '_hmpi_product_cpu_cache', true );
$hmpi_product_gpu_manufucture = get_post_meta( get_the_ID(), '_hmpi_product_gpu_manufucture', true );
$hmpi_product_gpu_model = get_post_meta( get_the_ID(), '_hmpi_product_gpu_model', true );
$hmpi_product_gpu_specific_memory = get_post_meta( get_the_ID(), '_hmpi_product_gpu_specific_memory', true );
$hmpi_product_gpu_total_memory = get_post_meta( get_the_ID(), '_hmpi_product_gpu_total_memory', true );
$hmpi_product_gallery_image = get_post_meta( get_the_ID(), '_hmpi_product_gallery_image', true );
$hmpi_product_discussion = get_post_meta( get_the_ID(), '_hmpi_product_discussion', true );
?>
<div id="hmpi-public-product-information-<?php the_ID();?>" class="hmpi-product-information">
		<ul class="category-tabs hmpi-tabs">
                <li><a class="tab_a" href="#frag1">مشخصات فیزیکی</a></li>
	        <li><a class="tab_a" href="#frag2">پردازنده مرکزی</a></li>
	        <li><a class="tab_a" href="#frag3">پردازنده گرافیکی</a></li>
	        <li><a class="tab_a" href="#frag4">تصاویر</a></li>
	        <li><a class="tab_a" href="#frag5">نقد فنی</a></li>
	    </ul>
	    <!-- <br class="clear" /> -->
	    <div id="frag1">
	        <p>ابعاد:  <?php echo $hmpi_product_sizes;?></p>
	        <p>وزن: <?php echo $hmpi_product_weight;?></p>
	    </div>
	    <div id="frag2">
	        <p>سازنده: <?php echo $hmpi_product_cpu_manufucture;?></p>
	        <p>سری: <?php echo $hmpi_product_cpu_serie;?></p>
	        <p>سازنده: <?php echo $hmpi_product_cpu_model;?></p>
	        <p>فرکانس: <?php echo $hmpi_product_frequence;?></p>
	    </div>
	    <div id="frag3">
	        <p>سازنده:  <?php echo $hmpi_product_gpu_manufucture;?></p>
	        <p>مدل: <?php echo $hmpi_product_gpu_model;?></p>
	        <p>حافظه  اختصاصی: <?php echo $hmpi_product_gpu_specific_memory;?></p>
	        <p>کل حافظه گرافیکی: <?php echo $hmpi_product_gpu_total_memory;?></p>
	    </div>
	    <div id="frag4">
                <ul id="hmpi_image_gallery">
	    	<?php foreach($hmpi_product_gallery_image as $image):?>
                    
                    <li>
                        <a href="<?php echo $image;?>" class="thumbnail" title="Caption 1">
                            <img src="<?php echo $image;?>" alt="no alt">
                        </a>
                    </li>

		<?php endforeach;?>
                </ul>
	    </div>
	    <div id="frag5">
	    	<p><?php echo $hmpi_product_discussion;?></p>
	    </div>
</div>