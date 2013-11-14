<?php
/*
Template Name: Tag Index
*/
 
get_header(); ?>
 
    <div id="primary">
        <div id="content" role="main">
        
            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
            
                <header class="entry-header grid-container">
                    <h1 class="entry-title"><?php the_title(); ?></h1>
                </header><!-- .entry-header -->
 
                <div class="entry-content grid-container">
                
                	<div id="tag-index">


					<?php 
						/* Begin Tag Index */ 
					
						// Make an array from A to Z.
					    $characters = range('A','Z');
					    
					    // Retrieve all tags
						$getTags = get_tags( array( 'order' => 'ASC') );
						
						// Retrieve first letter from tag name
						$isFirstCharLetter = ctype_alpha(substr($getTags[0]->name, 0, 1));
						
						
												
						// Special Character and Number Loop
						// Run a check to see if the first tag starts with a letter
						// If it does not, run this
						if ( $isFirstCharLetter == false ){
						
							// Print a number container	
							$html .= "<div class='tag-group grid-25'>";					
							$html .= "<h3 class='tag-title'>#</h3>";
							$html .= "<ul class='tag-list'>";
							
							// Special Character/Number Loop
							while( $isFirstCharLetter == false ){
							
								// Get the current tag
								$tag = array_shift($getTags);
								
								// Get the current tag link 
								$tag_link = get_tag_link($tag->term_id);
								
								// Print List Item
								$html .= "<li class='tag-item'>";
								
								// Check to see how many tags exist for the current letter then print appropriate code
			                    if ( $tag->count > 1 ) {
			                        $html .= "<p><a href='{$tag_link}' title='View all {$tag->count} articles with the tag of {$tag->name}' class='{$tag->slug}'>";
			                    } else {
			                        $html .= "<p><a href='{$tag_link}' title='View the article tagged {$tag->name}' class='{$tag->slug}'>";
			                    }
			                    
			                    // Print tag name and count then close the list item
								$html .= "<span class='tag-name'>{$tag->name}</span></a><span class='tag-count'>#{$tag->count}</span></p>";								
								$html .= "</li>";
								
								// Retrieve first letter from tag name
								// Need to redefine the global variable since we are shifting the array
								$isFirstCharLetter = ctype_alpha(substr($getTags[0]->name, 0, 1));
								
							}
							
							// Close the containers
							$html .= "</ul>";
							$html .= "</div>";	
						}
						
						// Letter Loop
						do {
							
							// Get the right letter
							$currentLetter = array_shift($characters);
						
							// Print stuff	
							$html .= "<div class='tag-group grid-25'>";					
							$html .= "<h3 class='tag-title'>{$currentLetter}</h3>";
							$html .= "<ul class='tag-list'>";
							
							// While we have tags, run this loop
							while($getTags){
							
								// Retrieve first letter from tag name
								$firstChar = substr($getTags[0]->name, 0, 1);
							
								//if ( $currentLetter == $firstChar ){
								if ( strcasecmp($currentLetter, $firstChar) == 0 ){	
															
									// Get the current tag
									$tag = array_shift($getTags);
									
									// Get the current tag link 
									$tag_link = get_tag_link($tag->term_id);
									
									// Print stuff
									$html .= "<li class='tag-item'>";
									
									// Check to see how many tags exist for the current letter then print appropriate code
				                    if ( $tag->count > 1 ) {
				                        $html .= "<p><a href='{$tag_link}' title='View all {$tag->count} articles with the tag of {$tag->name}' class='{$tag->slug}'>";
				                    } else {
				                        $html .= "<p><a href='{$tag_link}' title='View the article tagged {$tag->name}' class='{$tag->slug}'>";
				                    }
				                    
				                    // Print more stuff
									$html .= "<span class='tag-name'>{$tag->name}</span></a><span class='tag-count'>#{$tag->count}</span></p>";								
									$html .= "</li>";
									
								} else {
									break 1;
								}
							}								

							$html .= "</ul>";
							$html .= "</div>";
						} while ( $characters ); // Will loop over each character in the array
						
						// Let's see what we got:
						echo($html);
					
					?>
					
                	</div><!-- #tag-index -->


                </div><!-- .entry-content -->
                
                <footer class="entry-meta">
                    <!-- The footer for your tag index page -->
                </footer><!-- .entry-meta -->
            
            </article><!-- #post-<?php the_ID(); ?> -->
        
        </div><!-- #content -->
    </div><!-- #primary -->
        
<?php get_footer(); ?>