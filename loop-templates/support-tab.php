<div class="col-md-12 content-area" id="tabs">
	
<ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
					  <li class="nav-item">
						<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home"
						  aria-selected="true">Ordini e consegne</a>
					  </li>
					  <li class="nav-item">
						<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile"
						  aria-selected="false">Generali</a>
					  </li>
					  <li class="nav-item">
						<a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact"
						  aria-selected="false">Gestione account</a>
					  </li>
					</ul>
					<div class="tab-content" id="myTabContent">
					  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab"> 
						
						
						<?php echo do_shortcode( '[sp_faq category="40"]' ); ?>
						
	
						
					</div>
					  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
						<?php echo do_shortcode( '[sp_faq category="41"]' ); ?>
						</div>
						
						
					  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
						
						  <?php echo do_shortcode( '[sp_faq category="42"]' ); ?>
						
						</div>
					</div>
	</div><!-- #tabs -->