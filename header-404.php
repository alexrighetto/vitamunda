<?php
/**
 * The header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> <?php body_class(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body id="pagebody" <?php body_class(); ?> <?php understrap_body_attributes(); ?>>
	
<?php do_action( 'wp_body_open' ); ?>


	 <div class="cover-container d-flex h-100 p-3 mx-auto flex-column">
	
	<header class="masthead mb-auto">
        <div class="inner">
          
          <nav class="nav nav-masthead justify-content-center">
            <a class="nav-link active" href="http://localhost:3000/vitamunda/">Home</a>
            <a class="nav-link" href="http://localhost:3000/vitamunda/negozio/">Negozio</a>
          </nav>
        </div>
	</header>
	
