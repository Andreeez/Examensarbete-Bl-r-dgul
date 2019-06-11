<?php

add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
 
}


// ************************************************************************************************ //
//   Funktion för att kolla om produkten finns i lager, om produkten har Kategori "Kurser". Då skriver funktionen ut antalet platser kvar.
//   Har produkten inte kategori "Kurser" står ordinarie meddelandet "I lager" kvar.

add_filter( 'woocommerce_get_availability', 'wcs_custom_get_availability', 1, 2);
function wcs_custom_get_availability( $availability, $_product ) {
    $terms = get_the_terms ( $product_id, 'product_cat' );
    foreach ( $terms as $term ) {
         $cat_name = $term->name;
         if($cat_name == 'Kurser'){
            if ($_product->is_in_stock()) {
                $availability['availability'] = '<p>'. $_product->get_Stock_quantity() . __(' Platser kvar', 'woocommerce') . '</p>' ;
            }          
        } 
    }
    return $availability;
}

// ************************************************************************************************ //
//   Funktioner för att lägga produktens pris under produktens beskrivning.

remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
add_action('woocommerce_single_product_summary','woocommerce_template_single_price', 25);


// ************************************************************************************************ //
//   Funktion för särskilja på produkter och kursers policy. 
//   Om produkten har kategori "Tavla" hänvisar den till "Villkor/Policy för produkter".
//   Om produkten har kategori "Kurser" hänvisar den till "Villkor/Policy för kurser".

add_action( 'woocommerce_single_product_summary', 'print_policy_products', 40);

function print_policy_products(){

    $terms = get_the_terms ( $product_id, 'product_cat' );
    foreach ( $terms as $term ) {
         $cat_name = $term->name;
         if($cat_name == 'Mariona Baudach' || $cat_name == 'Morla Rosel'){
            echo '<a href="https://xn--blrdgul-fxa8m.se/kopvillkor/">Köpvillkor</a><br>';
            
        } 
        if($cat_name == 'Kurser'){
            echo '<a href="https://xn--blrdgul-fxa8m.se/privacy-policy-kurser/">Avbokning/Ombokning Kurser</a>';

        } 
        
    }

}

// ************************************************************************************************ //
//   Funktion för att lägga till länk till Tavlor som är gjorda av Morla Rosel


add_action('woocommerce_single_product_summary', 'print_link_maria', 42);

function print_link_maria(){
    $terms = get_the_terms ( $product_id, 'product_cat' );
    foreach ( $terms as $term ) {
         $cat_name = $term->name;
         if($cat_name == 'Morla Rosel'){
            echo '<a href="/maria-jose/">Se Morla Rosel Artist-CV</a>';
            
        } 
        if($cat_name == 'Mariona Baudach'){
            echo '<a href="/mariona-baudach/">Se Mariona Baudachs Artist-CV </a>';
            
        } 

}
}

remove_action('woocommerce_before_shipping_calculator' , 'remove_shipping_label');
    function remove_shipping_label(){
    $terms = get_the_terms ( $product_id, 'product_cat' );
            foreach ( $terms as $term ) {
                $cat_name = $term->name;
                if($cat_name == 'Kurser'){
                    echo 'FRAKT RÄKNARE ÄR BORTA';
                    
                } 
            }
        }




//Funktion för att ta bort zoom på produkter
add_action( 'after_setup_theme', 'remove_wc_gallery_lightbox', 100 );
function remove_wc_gallery_lightbox() {
remove_theme_support( 'wc-product-gallery-lightbox' );
}

//Funktion för att ta bort siffor på Kategori. Tex T-shirt(2).
add_filter( 'woocommerce_subcategory_count_html', '__return_empty_string' );


// Funktion för att ta bort Beskrivning tab på produktsida
function woo_remove_product_tabs( $tabs ) 
{
   unset( $tabs['additional_information'] );
   return $tabs;
}
add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );




function thenga_single_add_to_cart_text( $text ) {
    return __( 'Download', 'textdomain' );
}

function changeAddToCartButtonText(){
    $terms = get_the_terms ( $product_id, 'product_cat' );
        foreach ( $terms as $term ) {
            $cat_name = $term->name;
            if($cat_name == 'Kurser'){
                return __( 'Boka Kurs', 'textdomain' );   
            } else {
                return __( 'Köp Konst', 'textdomain' );
            }
                    
        }
}
        

// add_filter( 'woocommerce_product_add_to_cart_text', 'changeAddToCartButtonText', 10, 1 );
add_filter( 'woocommerce_product_single_add_to_cart_text', 'changeAddToCartButtonText', 10, 1 );

add_filter('woocommerce_product_add_to_cart_text', 'change_Add_To_Cart_Button_Text_StorePage');   // 2.1 +

function change_Add_To_Cart_Button_Text_StorePage()
{
    return __('Köp Konst', 'woocommerce');
}




function display_acf_on_product_page() {
    global $product;
    $fields = get_field_objects();
    $terms = get_the_terms ( $product_id, 'product_cat' );
    $cat_name = $term->name;

    foreach ( $terms as $term ) {
        $cat_name = $term->name;
        if($cat_name == 'Mariona Baudach' || $cat_name == 'Morla Rosel'){
            if(isset($fields)){

                echo '<div class="acf_productDescription">';
                echo '<h1>' .  $product->get_name() . '</h1><br>';
                echo '<b>Tillverkning:</b> ' . get_field("tillverkning") . '<br>';
                echo '<b>Tillverkningsår:</b> ' . get_field("tillverknings_ar") . '<br>';
                echo '<b>Mått:</b> ' . get_field("measures") . '<br>';
                echo '<b>Teknik:</b> ' . get_field("technique") . '<br>';
                echo '<b>Papper:</b> ' . get_field("papper") . '<br>';
                echo '<b>Upplagor:</b> ' . get_field("editions") . '<br>';
                echo '<b>Gjord i:</b> ' . get_field("made_in") . '<br>';
                echo '</div>';

            }
        }
    }
}

add_action( 'woocommerce_single_product_summary', 'display_acf_on_product_page', 24 );

function blarodgul_widgets_init() {

	register_sidebar( array(
		'name'          => 'Shop Left widget Bar',
		'id'            => 'shop_left_widget_bar',
		'before_widget' => '<div>',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="rounded">',
		'after_title'   => '</h2>',
	) );

}
add_action( 'widgets_init', 'blarodgul_widgets_init' );

function addingWidgetShop(){

if(is_active_sidebar( 'shop_left_widget_bar' )){
    dynamic_sidebar('shop_left_widget_bar');

}
}
add_action( 'woocommerce_before_shop_loop', 'addingWidgetShop', 20 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );


//  if( !is_shop()) {  
//   #secondary{display:none};

//   add_filter('secondary_id', function (array $classes) {
//     if (in_array('class-to-remove', $classes)) {
//       unset( $classes[array_search('class-to-remove', $classes)] );
//     }
//   return $classes;
// });
 
//  } 



?>