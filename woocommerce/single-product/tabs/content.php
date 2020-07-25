<?php
/**
 * WooCommerce Tab Manager
 *
 * This source file is subject to the GNU General Public License v3.0
 * that is bundled with this package in the file license.txt.
 * It is also available through the world-wide-web at this URL:
 * http://www.gnu.org/licenses/gpl-3.0.html
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@skyverge.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade WooCommerce Tab Manager to newer
 * versions in the future. If you wish to customize WooCommerce Tab Manager for your
 * needs please refer to http://docs.woocommerce.com/document/tab-manager/
 *
 * @author      SkyVerge
 * @copyright   Copyright (c) 2012-2020, SkyVerge, Inc. (info@skyverge.com)
 * @license     http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License v3.0
 */

defined( 'ABSPATH' ) or exit;

/**
 * Tab Manager tab content template.
 *
 * @type array $tab tab data in array form
 *
 * @since 1.0.5
 * @version 1.10.0
 */
global $product;
$container = get_theme_mod( 'understrap_container_type' );
?>

<div class="<?php echo esc_attr( $container ); ?>" >
	
	<div class="row tab-entry-wrapper">		
			
		<div class="main-col">
		
			<header class="tab-entry-header">
				<h5 class="tab-entry-title"><?php echo $tab['title'] ; ?></h5>
			</header>
			<div class="tab-entry-content">
<?php echo apply_filters( 'woocommerce_tab_manager_tab_panel_content', $tab['content'], $tab, $product ); ?>
			</div>	
		
		</div><!-- .col -->
		
		<div class="side-col tab-sidebar">
				<aside class="sidebar__outer">
					<div class="inner-wrapper">
						
						<?php
	echo '<figure>' .$product->get_image(array( 500, 800 )) . '</figure>' ;// Get Product ID ?>
						<header class="tab-entry-header">
						<h5  class="tab-entry-title"><?php echo $product->get_name(); ?></h5>
							
						</header>	
					</div>
				</aside>
				
		</div><!-- .col -->
		
	</div><!-- .row.tab-entry-wrapper -->
</div><!-- .container -->		
