<?php

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
         if($cat_name == 'Tavla'){
            echo '<a href="https://xn--blrdgul-fxa8m.se/">Villkor gällande produkter</a>';
            
        } 
        if($cat_name == 'Kurser'){
            echo '<a href="https://xn--blrdgul-fxa8m.se/">Villkor gällande Kurser</a>';

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

    // $terms = get_the_terms ( $product_id, 'product_cat' );
    //         foreach ( $terms as $term ) {
    //             $cat_name = $term->name;
    //             if($cat_name == 'Kurser'){
    //                 return false;
    //             }
                
    //         }
    //         return $show_shipping;
    //     } 
    // }
    


// }
// woocommerce_before_shipping_calculator
// add_filter( 'woocommerce_cart_shipping_method_full_label', 'remove_shipping_label', 10, 2 );

// function remove_shipping_label( $label, $method ) {
// 	$new_label = preg_replace( '/^.+:/', '', $label );

// 	return $new_label;
// }

// add_filter( 'woocommerce_cart_ready_to_calc_shipping','disable_shipping_calc_on_cart', 99 );
// function disable_shipping_calc_on_cart( $show_shipping ) {

//     if( is_cart() ) {
//         $terms = get_the_terms ( $product_id, 'product_cat' );
//         foreach ( $terms as $term ) {
//             $cat_name = $term->name;
//             if($cat_name == 'Kurser'){
//                 return false;
//             }
            
//         }
//         return $show_shipping;
//     } 
// }









// add_filter( 'woocommerce_checkout_fields' , 'my_override_checkout_fields' );
// function my_override_checkout_fields( $fields ) {
    
//          unset($fields['billing']['billing_phone']);
    
     
    
//          return $fields;
    
//     }
    




















//     global $wp_query;
// // get the query object
// $product_cats = wp_get_post_terms('product_cat' );

// $cat_obj = $wp_query->get_queried_object();

// $category_name = $cat_obj->name;

// print_r($cat_obj);

// $term_list = wp_get_post_terms($product_id, 'product_cat', array('fields' => 'ids'));
// print_r($term_list);


// // if($cat_obj)    {
// //     $category_name = $cat_obj->name;
// //     $category_desc = $cat_obj->description;
// //     $category_ID  = $cat_obj->term_id;
// //     echo $category_ID;

//     // with the `$category_ID`, proceed to your `if/else` statement.
//     if( $product_cats =='Tavla'){
//         echo '<a href="https://xn--blrdgul-fxa8m.se/">Villkor vid avbokning av kurser Policy</a>';
//         echo 'Syns';

//     }

//     // if( $category_ID == 2){
//     //    echo 'Cat ID is 2';
// //     // }
// global $wp_query;
//     $terms_post = get_the_terms( $post->cat_ID , 'product_cat' );
//     foreach ($terms_post as $term_cat) { 
//     $term_cat_id = $term_cat->term_id; 
//     echo $term_cat_id;
// }

// if ($term_cat_id == '2018'){
//             echo '<a href="https://xn--blrdgul-fxa8m.se/">Villkor vid avbokning av kurser Policy</a>';

// }



?>