<?php get_header(); 

pageBanner(array(

	'title' => 'All Events',
	'subtitle' => 'See what is going on our world'
));

?>

<div class="container container--narrow page-section">
<?php

while(have_posts()) {
	the_post();
	
	get_template_part('template_parts/content', 'event');

}

echo paginate_links();

?>
<hr class="section-break">
 <p class="t-center no-margin"><a href="<?php echo site_url('/past-events'); ?>" class="btn btn--blue">Past Events</a></p>
</div>

<?php get_footer(); ?>