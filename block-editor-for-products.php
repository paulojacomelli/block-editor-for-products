<?php
/**
 * Plugin Name: Block Editor for Products
 * Description: Enable the block editor for products. Lightweight and simple.
 * Version:     1.0.1
 * Author:      Paulo Jacomelli
 * Author URI:  https://paulojacomelli.com.br
 * Text Domain: block-editor-for-products
 * Domain Path: /languages
 * License:     GPL-2.0-or-later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 *
 * @package Block_Editor_For_Products
 */

defined( 'ABSPATH' ) || exit;

/**
 * Ensure the 'product' post type supports the editor.
 */
function befp_ensure_product_support() {
	if ( post_type_exists( 'product' ) ) {
		if ( ! post_type_supports( 'product', 'editor' ) ) {
			add_post_type_support( 'product', 'editor' );
		}
	}
}
add_action( 'init', 'befp_ensure_product_support', 20 );
add_action( 'woocommerce_init', 'befp_ensure_product_support' );

/**
 * Force block editor for the post type level.
 */
function befp_force_block_editor_for_post_type( $use_block_editor, $post_type ) {
	if ( 'product' === $post_type ) {
		return true;
	}
	return $use_block_editor;
}
add_filter( 'use_block_editor_for_post_type', 'befp_force_block_editor_for_post_type', 999, 2 );

/**
 * Force block editor for single post instances.
 */
function befp_force_block_editor_for_post( $use_block_editor, $post ) {
	if ( is_object( $post ) && 'product' === $post->post_type ) {
		return true;
	}
	return $use_block_editor;
}
add_filter( 'use_block_editor_for_post', 'befp_force_block_editor_for_post', 999, 2 );

/**
 * Notes:
 * - If a plugin like "Classic Editor" or "Disable Gutenberg" is active, it may still override this.
 * - This plugin does not store data or add settings.
 */
