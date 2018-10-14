<?php
/**
 * Reset options
 *
 * @package Theme Palace
 * @subpackage Chrisporate
 * @since Chrisporate 1.0.0
 */

/**
* Reset section
*/
// Add reset enable section
$wp_customize->add_section( 'chrisporate_reset_section', array(
	'title'             => esc_html__('Reset all settings','chrisporate'),
	'description'       => esc_html__( 'Caution: All settings will be reset to default. Refresh the page after clicking Save & Publish.', 'chrisporate' ),
) );

// Add reset enable setting and control.
$wp_customize->add_setting( 'chrisporate_theme_options[reset_options]', array(
	'default'           => $options['reset_options'],
	'sanitize_callback' => 'chrisporate_sanitize_checkbox',
	'transport'			  => 'postMessage',
) );

$wp_customize->add_control( 'chrisporate_theme_options[reset_options]', array(
	'label'             => esc_html__( 'Check to reset all settings', 'chrisporate' ),
	'section'           => 'chrisporate_reset_section',
	'type'              => 'checkbox',
) );