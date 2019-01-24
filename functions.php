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
            echo '<a href="https://xn--blrdgul-fxa8m.se/kopvillkor/">Köpvillkor</a>';
            
        } 
        if($cat_name == 'Kurser'){
            echo '<a href="https://xn--blrdgul-fxa8m.se/privacy-policy-kurser/">Avbokning/Ombokning Kurser</a>';

        }
        
    }

}

// ************************************************************************************************ //
//   Funktion för att lägga till länk till Tavlor som är gjorda av Morla Rosel


add_action('woocommerce_single_product_summary', 'print_link_maria', 41);

function print_link_maria(){
    $terms = get_the_terms ( $product_id, 'product_cat' );
    foreach ( $terms as $term ) {
         $cat_name = $term->name;
         if($cat_name == 'Morla Rosel'){
            echo '<a href="https://xn--blrdgul-fxa8m.se/maria-jose/">Läs mer om Morla Rosel </a>';
            
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

?>