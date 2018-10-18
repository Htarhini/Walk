<?php
/**
* Customizer validation functions
*
* @package Theme Palace
* @subpackage Chrisporate
* @since Chrisporate 1.0.0
*/

if ( ! function_exists( 'chrisporate_validate_long_excerpt' ) ) :
  function chrisporate_validate_long_excerpt( $validity, $value ){
         $value = intval( $value );
     if ( empty( $value ) || ! is_numeric( $value ) ) {
         $validity->add( 'required', esc_html__( 'You must supply a valid number.', 'chrisporate' ) );
     } elseif ( $value < 5 ) {
         $validity->add( 'min_no_of_words', esc_html__( 'Minimum no of words is 5', 'chrisporate' ) );
     } elseif ( $value > 100 ) {
         $validity->add( 'max_no_of_words', esc_html__( 'Maximum no of words is 100', 'chrisporate' ) );
     }
     return $validity;
  }
endif;

if ( ! function_exists( 'chrisporate_validate_post_id' ) ) :
    function chrisporate_validate_post_id( $validity, $value ){
        $value = intval( $value );
        if ( empty( $value ) || ! is_numeric( $value ) ) {
            $validity->add( 'required', esc_html__( 'You must supply a valid number.', 'chrisporate' ) );
        } elseif ( $value < 1 ) {
            $validity->add( 'min_value', esc_html__( 'Minimum value is 1', 'chrisporate' ) );
        } 
        return $validity;
    }
endif;
