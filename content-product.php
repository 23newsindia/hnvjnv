<?php
if (!defined('ABSPATH')) :
    exit;
endif;

global $product, $nasa_opt;

if (!is_a($product, WC_Product::class) || !$product->is_visible()) :
    return;
endif;

// Get custom fields
$product_fit = get_post_meta($product->get_id(), '_product_fit', true) ?: '';
$fabric_type = get_post_meta($product->get_id(), '_fabric_type', true) ?: '100% COTTON';
$product_rating = $product->get_average_rating();
$rating_count = $product->get_rating_count();
$product_tag = get_post_meta($product->get_id(), '_product_tag', true) ?: '';

// Get product categories using the correct function
$product_categories = wc_get_product_category_list($product->get_id(), ', ', '<span class="brand-name">', '</span>');

// Wrapper classes
$wrap_item_class = 'product-warp-item';
$wrap_item_class .= isset($wrapper_class) ? ' ' . $wrapper_class : '';
?>

<div <?php wc_product_class('product-item grid hover-zoom', $product); ?>>
    <div class="product-img-wrap">
        <!-- Badges -->
        <div class="nasa-badges-wrap">
            <?php if ($product->is_on_sale()) : ?>
                <span class="badge sale-label">Sale</span>
            <?php endif; ?>
            <?php if ($product_tag) : ?>
                <span class="badge deal-label"><?php echo esc_html($product_tag); ?></span>
            <?php endif; ?>
        </div>

        <!-- Product Image -->
        <a class="product-img" href="<?php echo esc_url($product->get_permalink()); ?>">
            <figure class="product-image-container">
                <?php echo $product->get_image('woocommerce_thumbnail', array('class' => 'main-img')); ?>
                
                <!-- Rating Badge -->
                <?php if ($product_rating > 0) : ?>
                    <div class="absolute bottom-2 left-2 z-10">
                        <div class="rating-badge">
                            <div class="rating-inner">
                                <div class="star-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 12 12">
                                        <path fill="#FFD232" d="M5.58 1.15a.5.5 0 0 1 .84 0l1.528 2.363a.5.5 0 0 0 .291.212l2.72.722a.5.5 0 0 1 .26.799L9.442 7.429a.5.5 0 0 0-.111.343l.153 2.81a.5.5 0 0 1-.68.493L6.18 10.063a.5.5 0 0 0-.36 0l-2.625 1.014a.5.5 0 0 1-.68-.494l.153-2.81a.5.5 0 0 0-.11-.343L.781 5.246a.5.5 0 0 1 .26-.799l2.719-.722a.5.5 0 0 0 .291-.212L5.58 1.149Z"/>
                                    </svg>
                                </div>
                                <span class="rating-value"><?php echo number_format($product_rating, 1); ?></span>
                            </div>
                            <?php if ($product_tag) : ?>
                                <div class="tag-label">
                                    <span class="tag-text"><?php echo esc_html($product_tag); ?></span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Product Fit Label -->
                <?php if ($product_fit) : ?>
                    <div class="product-fit-label"><?php echo esc_html($product_fit); ?></div>
                <?php endif; ?>
            </figure>
        </a>
    </div>

    <div class="product-info-wrap">
        <div class="product-info-container">
            <!-- Brand/Category -->
            <div class="product-brand">
                <?php echo $product_categories; ?>
                <button class="wishlist-button">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 20 18">
                        <path stroke="#292D35" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M10 16.561S1.5 11.753 1.5 5.915c0-1.033.354-2.033 1.002-2.83a4.412 4.412 0 0 1 2.551-1.548 4.381 4.381 0 0 1 2.944.437A4.449 4.449 0 0 1 10 4.197a4.449 4.449 0 0 1 2.002-2.223 4.381 4.381 0 0 1 2.945-.437 4.412 4.412 0 0 1 2.551 1.547 4.492 4.492 0 0 1 1.002 2.83c0 5.839-8.5 10.647-8.5 10.647Z"/>
                    </svg>
                </button>
            </div>

            <!-- Product Title -->
            <h2 class="product-title">
                <a href="<?php echo esc_url($product->get_permalink()); ?>">
                    <?php echo esc_html($product->get_name()); ?>
                </a>
            </h2>

            <!-- Price -->
            <div class="price-container">
                <?php echo $product->get_price_html(); ?>
            </div>

            <!-- Fabric Type -->
            <?php if ($fabric_type) : ?>
                <div class="fabric-tag"><?php echo esc_html($fabric_type); ?></div>
            <?php endif; ?>
        </div>
    </div>
</div>
