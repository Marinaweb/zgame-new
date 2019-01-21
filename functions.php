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
    register_sidebar( array(
        'name' => "Категории товаров",
        'id' => 'filter-category',
        'description' => 'Фильтр товаров по категориям',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ) );
}
add_action( 'widgets_init', 'register_my_widgets' );


//Ajax Обновление кратких данных из корзины *************************************
// *******************************************************************************


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
add_action( 'woocommerce_single_product_summary', 'action_woocommerce_after_shop_loop_item', 5  );

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
        unset($fields['billing']['billing_last_name']);
        unset($fields['billing']['billing_address_1']); 
        unset($fields['billing']['billing_address_2']); 
        unset($fields['billing']['billing_city']);
        unset($fields['billing']['billing_postcode']);
        // unset($fields['billing']['billing_email']);
        unset($fields['billing']['billing_country']);
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


//  Вывод изображения категории на странице этой категории возле названия
add_action( 'woocommerce_archive_description', 'woocommerce_category_image', 1 );
function woocommerce_category_image() {
    if ( is_product_category() ){
        global $wp_query;
        $cat = $wp_query->get_queried_object();
        $thumbnail_id = get_woocommerce_term_meta( $cat->term_id, 'thumbnail_id', true );
        $image = wp_get_attachment_url( $thumbnail_id );
        if ( $image ) {
            echo '<img class="category-product-image" src="' . $image . '" alt="'.$cat->name.'" />';
        }
    }
}


// Rename add to cart ***********************************************************
// *******************************************************************************
add_filter( 'add_to_cart_text', 'woo_custom_product_add_to_cart_text' );            
add_filter( 'woocommerce_product_add_to_cart_text', 'woo_custom_product_add_to_cart_text' );  
  
function woo_custom_product_add_to_cart_text() {
  
    return __( 'Добавить в корзину', 'woocommerce' );
  
}

add_filter( 'add_to_cart_text', 'woo_custom_single_add_to_cart_text' );            
add_filter( 'woocommerce_product_single_add_to_cart_text', 'woo_custom_single_add_to_cart_text' ); 
  
function woo_custom_single_add_to_cart_text() {
  
    return __( 'Купить', 'woocommerce' );
  
}


/* выводим пользовательских свойств товара - атрибутов
*/
function devise_woo_get_pa(){
    global $product;
    echo "<div class='attr_product'>";

        echo "<div class='atribute_wrap type'>";
            echo '<p class="atribute_item">';
                echo $product->get_attribute('tip-igr'); 
            echo '</p>';
        echo "</div>";

        echo "<div class='atribute_wrap vremya-igry'>";
            echo "<span class='atribute_img'></span>";
            echo '<p class="atribute_item">';
                echo $product->get_attribute('vremya-igry');
            echo '</p>';
        echo "</div>";

        echo "<div class='atribute_wrap kolichestvo-igrokov'>";
            echo "<span class='atribute_img'></span>";
            echo '<p class="atribute_item">';
            echo '<p class="atribute_item">Ко-во игроков: ';
                echo $product->get_attribute('kolichestvo-igrokov');
            echo '</p>';
        echo "</div>";

        echo "<div class='atribute_wrap vozrast'>";
            echo "<span class='atribute_img'></span>";
            echo '<p class="atribute_item">';
                echo '<p class="atribute_item">Возраст: ';
                echo $product->get_attribute('vozrast');
            echo '</p>';
        echo "</div>";

        echo "<div class='atribute_wrap yazyk'>";
            echo "<span class='atribute_img'></span>";
            echo '<p class="atribute_item">';
                echo '<p class="atribute_item">Язык: ';
                echo $product->get_attribute('yazyk');
            echo '</p>';
        echo "</div>";

       
    echo "</div>";
}
add_action('woocommerce_single_product_summary', 'devise_woo_get_pa', 100);
add_action('woocommerce_after_shop_loop_item', 'devise_woo_get_pa', 20);

// Переименование вкладки "Дополнительная информация" в "Характеристики"
add_filter( 'woocommerce_product_tabs', 'devise_woo_rename_reviews_tab', 98);
function devise_woo_rename_reviews_tab($tabs) {
$tabs['additional_information']['title'] = 'Характеристики';
return $tabs;
}

add_action( 'woocommerce_before_single_product_summary', 'woocommerce_template_single_title', 5  );

// Подвигаем категории
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta',  100 );

// Подвигаю вниз цену и добавить в корзину
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price',  40 );
add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart',  50 );
// add_action( 'woocommerce_after_single_product_summary', 'woocommerce_template_single_meta',  5 );

// Карточка товара
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price',  10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart',  30 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta',  40 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);

// Переопределения места для rating
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 105);


// Удалить вкладку 
// function tutsplus_remove_product_attributes_tab( $tabs ) {
//     unset( $tabs['additional_information'] );
//     return $tabs;
// }
// add_filter( 'woocommerce_product_tabs', 'tutsplus_remove_product_attributes_tab', 100 );


// Удалить отзывы на стр категории
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

//Ajax Обновление кратких данных из корзины
add_filter('woocommerce_add_to_cart_fragments', 'cpp_header_add_to_cart_fragment');
function cpp_header_add_to_cart_fragment( $fragments ) {
    global $woocommerce;
    ob_start(); ?>
    
    <a class="cart-contents" href="<?php echo WC()->cart->get_cart_url(); ?>">
            <img src="<?php bloginfo('template_url') ?>/build/images/basket.png">
        <span class="basket-btn__counter">
            <?php echo WC()->cart->get_cart_contents_count(); ?> 
        </span>
    </a>

    <?php
    $fragments['a.cart-contents'] = ob_get_clean();
    return $fragments;
}