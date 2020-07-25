<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package UnderStrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header('404');

$container = get_theme_mod( 'understrap_container_type' );
?>



	<main role="main" class="inner cover">
		
		<h2 class="number404">404</h2>
		
		<div class="infobox">
        
		<h1 class="cover-heading">Ooops...</h1>
        <p class="lead"><quote>Sembra che la pagina che hai cercato non sia più disponibile...</quote></p>
		</div>	
        <p class="lead">
          <nav class="navlinks nav flex-column">
		  <a class="nav-link" href="http://localhost:3000/vitamunda/negozio/">Torna al negozio</a>
		  <a class="nav-link" href="#">Consulta l'assistenza</a>
		  <a class="nav-link" href="http://localhost:3000/vitamunda/">Vai alla prima pagina</a>
		  
			</nav>
        </p>
	</main>



<?php
get_footer('404');
