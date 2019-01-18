<?php 

// To add styles ******************************************************************************
// ********************************************************************************************
function zgame_styles() {
    wp_register_style( 'style', get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'style' );  
    wp_register_style( 'main', get_template_directory_uri() . '/build/css/main.css' );
    wp_enqueue_style( 'main' );
    wp_register_style( 'libs.min', get_template_directory_uri() . '/build/css/libs.min.css' );
    wp_enqueue_style( 'libs.min' );
}
add_action( 'wp_enqueue_scripts', 'zgame_styles' );


// To add scripts ******************************************************************************
    // *****************************************************************************************
function zgame_scripts() {  
    wp_register_script( 'libs-js', get_template_directory_uri() . '/build/js/libs.min.js', array( 'jquery' ) );
    wp_enqueue_script( 'libs-js' );
    wp_register_script( 'custom', get_template_directory_uri() . '/build/js/custom.js', array( 'jquery' ) );
    wp_enqueue_script( 'custom' );
}
add_action( 'wp_enqueue_scripts', 'zgame_scripts' );

// Theme support functions***********************************************************************
// **********************************************************************************************
// thumbnails
add_theme_support( 'post-thumbnails' );

// woocommerce
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

// Menu *****************************************************************************************
// **********************************************************************************************
register_nav_menu('header_menu', 'Основное меню');
register_nav_menu('header_menu_top', 'Верхнее меню в шапке');
register_nav_menu('footer_menu', 'Меню в футере');


// Sidebars registration  ********************************************************************** 
// *********************************************************************************************
function register_my_widgets(){
    register_sidebar( array(
        'name' => "Поиск",
        'id' => 'search-sidebar',
        'description' => 'Поиск товаров',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ) );
    register_sidebar( array(
        'name' => "Фильтр товаров",
        'id' => 'filter-woocommerce',
        'description' => 'Фильтр товаров по атрибутам',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ) );
}
add_action( 'widgets_init', 'register_my_widgets' );

//Ajax Обновление кратких данных из корзины *************************************
// *******************************************************************************
add_filter('woocommerce_add_to_cart_fragments', 'cpp_header_add_to_cart_fragment');
function cpp_header_add_to_cart_fragment( $fragments ) {
    $cart_icon = get_field('icon_cart_header', 'option');
    global $woocommerce;
    ob_start(); ?>
    
    <a class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>">
        
        <i class="<?php echo $cart_icon; ?>"></i>
        <span class="basket-btn__counter">
            <?php echo WC()->cart->get_cart_contents_count(); ?> 
        </span>
    </a>

    <?php
    $fragments['a.cart-contents'] = ob_get_clean();
    return $fragments;
}

// To add stock/outofstock ******************************************************
// *******************************************************************************
function action_woocommerce_after_shop_loop_item() {
    global $product;
    if ($product->stock_status == 'instock') {
        echo '<div class="instock_inner">В наличии ' . $product->stock . '</div>';
    } else {
        echo '<div class="instock_inner not_instock">' . 'Нет в наличии' . '</div>';
    }
};
add_action( 'woocommerce_after_shop_loop_item_title', 'action_woocommerce_after_shop_loop_item', 10 );


/** подключаем  ЛАЙТБОКС-lightbox - галерею **/
function garment_setup() {
add_theme_support( 'wc-product-gallery-zoom' );
add_theme_support( 'wc-product-gallery-lightbox' );
add_theme_support( 'wc-product-gallery-slider' );
}
add_action( 'after_setup_theme', 'garment_setup' );


// Удаление строк формы на странице оформления заказа
add_filter( 'woocommerce_checkout_fields' , 'custom_override_checkout_fields' );
function custom_override_checkout_fields( $fields ) {
        unset($fields['billing']['billing_company']);
        // unset($fields['billing']['billing_address_1']); 
        unset($fields['billing']['billing_address_2']); 
        unset($fields['billing']['billing_city']);
        unset($fields['billing']['billing_postcode']);
        // unset($fields['billing']['billing_email']);
        // unset($fields['billing']['billing_country']); - without this - doesnt work
        unset($fields['billing']['billing_state']);
        unset($fields['order']['order_comments']);
        unset($fields['account']['account_username']);
        unset($fields['account']['account_password']);
        unset($fields['account']['account_password-2']);
    return $fields;
}
 
// Automatic update cart
add_action( 'wp_footer', 'cart_update_qty_script' );
 
function cart_update_qty_script() {
    if (is_cart()) :
    ?>
    <script>
        jQuery('div.woocommerce').on('change', '.qty', function(){
            jQuery("[name='update_cart']").removeAttr("disabled").trigger("click");
        });
    </script>
    <?php
    endif;
}

// Добавление грн
add_filter( 'woocommerce_currencies', 'add_my_currency' );
function add_my_currency( $currencies ) {
     $currencies['UAH'] = __( 'Українська гривня', 'woocommerce' );
     return $currencies;
}

add_filter('woocommerce_currency_symbol', 'add_my_currency_symbol', 10, 2);
function add_my_currency_symbol( $currency_symbol, $currency ) {
     switch( $currency ) {
         case 'UAH': $currency_symbol = '  грн'; break;
     }
     return $currency_symbol;
}