<?php

get_header(); 

	while(have_posts()) {

		pageBanner(array(

			'subtitle' => 'Hi this is the subtitle'

		));

		the_post(); ?>



  <div class="container container--narrow page-section">

  	<?php

  	$theParent = wp_get_post_parent_id(get_the_ID());//get the ID of the current pages parent page, if the current page is a parent page it is equal 0

	if($theParent) { ?><!-- if curent page has parent it will return the code below-->

	<div class="metabox metabox--position-up metabox--with-home-link">
      <p><a class="metabox__blog-home-link" href="<?php echo get_permalink($theParent); ?>"><i class="fa fa-home" aria-hidden="true"></i>
      	<!-- get_the_title & get_the_permalink take the page title passed into parentheseese-->
		Back to <?php echo get_the_title($theParent);?></a> <span class="metabox__main"><?php  the_title(); ?></span></p>
    </div>

	<?php }

  	?>

    <?php 
    $testArray = get_pages(array(
    	'child_of' => get_the_ID()//if the current page has children get_pages function will return collection of any children pages
    ));
    if($theParent or $testArray) { ?><!-- check if page has childs -->
    <div class="page-links">
      <h2 class="page-links__title"><a href="<?php echo get_permalink($theParent); ?>"><?php echo get_the_title($theParent); ?></a></h2>
      <ul class="min-list">
		</ul>
			<?php

				if($theParent) { //on the child page this variable number will be gretar than 0 so it will be TRUE
					$findChildrenOf = $theParent;
				} 
				else {
					$findChildrenOf = get_the_ID();
				}
				wp_list_pages(array(
					'title_li' => NULL,
					'child_of' => $findChildrenOf
				));
				var_dump($findChildrenOf);
			?>
      	</ul>
    </div>
	<?php } ?>
    <div class="generic-content">
      <?php the_content(); ?>
    </div>

</div>

	<?php }

get_footer();

?>