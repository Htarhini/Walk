<?php
/**
 * Contact section
 *
 * This is the template for the content of contact section
 *
 * @package Theme Palace
 * @subpackage Chrisporate
 * @since Chrisporate 1.0.0
 */
if ( ! function_exists( 'chrisporate_add_contact_section' ) ) :
    /**
    * Add contact section
    *
    *@since Chrisporate 1.0.0
    */
    function chrisporate_add_contact_section() {
    	$options = chrisporate_get_theme_options();
        // Check if contact is enabled on frontpage
        $contact_enable = apply_filters( 'chrisporate_section_status', true, 'contact_section_enable' );

        if ( true !== $contact_enable ) {
            return false;
        }

        // Render contact section now.
        chrisporate_render_contact_section();
    }
endif;
add_action( 'chrisporate_footer_content', 'chrisporate_add_contact_section', 10 );

if ( ! function_exists( 'chrisporate_render_contact_section' ) ) :
  /**
   * Start contact section
   *
   * @return string contact content
   * @since Chrisporate 1.0.0
   *
   */
   function chrisporate_render_contact_section() {
        $options = chrisporate_get_theme_options();
        $title = ! empty( $options['contact_title'] ) ? $options['contact_title'] : '';
        $address = ! empty( $options['contact_address'] ) ? $options['contact_address'] : '';
        $phones = ! empty( $options['contact_phone'] ) ? explode( '|', $options['contact_phone'] ) : array();
        $emails = ! empty( $options['contact_email'] ) ? explode( '|', $options['contact_email'] ) : array();
        ?>
        <div id="contact-form" class="page-section relative">
            <div class="container">
                <?php if ( ! empty( $title ) ) : ?>
                    <div class="find-us-content-title clear">
                        <header class="entry-header section-title">
                            <h2 class="entry-title"><?php echo esc_html( $title ); ?></h2>
                        </header><!-- .entry-header -->
                    </div><!-- team-content -->
                    <?php endif; ?>
                <div class="entry-content">
                    <div class="contact-information-wrapper col-2">
                        <div class="hentry">
                            <ul class="address-block">
                                <?php if ( ! empty( $address ) ) : ?>
                                    <li class="address"><label><?php esc_html_e( 'Address:', 'chrisporate' ); ?></label>
                                        <span><?php echo esc_html( $address ); ?></span>
                                    </li>
                                <?php endif; 
                                
                                if ( ! empty( $phones ) ) : ?>
                                    <li class="phone"><label><?php esc_html_e( 'Call Us:', 'chrisporate' ); ?></label>
                                        <span>
                                            <?php foreach ( $phones as $phone ) : ?>
                                                <a href="tel:<?php echo esc_attr( $phone ); ?>"><?php echo esc_html( $phone ); ?></a>
                                            <?php endforeach; ?>
                                        </span>
                                    </li>
                                <?php endif; 

                                if ( ! empty( $emails ) ) : ?>
                                    <li class="email"><label><?php esc_html_e( 'Email:', 'chrisporate' ); ?></label>
                                        <span>
                                            <?php foreach ( $emails as $email ) : ?>
                                                <a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a>
                                            <?php endforeach; ?>
                                        </span>
                                    </li>
                                <?php endif; ?>
                            </ul><!-- .address-block -->
                        </div><!-- .hentry -->

                        <?php if ( ! empty( $options['contact_form'] ) ) : ?>
                            <div class="hentry">
                                <?php echo do_shortcode( wp_kses_post( $options['contact_form'] ) ); ?>
                            </div>
                        <?php endif; ?>
                    </div><!-- .contact-information-wrapper -->
                </div><!-- .entry-content -->
            </div><!-- .container -->
        </div><!-- #contact-form -->
    <?php
    }
endif;