<?php /* Template Name: Past Events*/ ?>

<?php get_header(); 

pageBanner(array(

    'title' => 'Past Events',
    'subtitle' => 'A recap of past events'

));

?>

<div class="container container--narrow page-section">
<?php

$today = date('Ymd');
    $pastEvents = new WP_Query(array(
    'post_type' => 'event',
    'paged' => get_query_var('paged', 1),
    //sort events by 'event_date'//
    'meta_key' => 'event_date',
    'orderby' => 'meta_value_num',
    'order' => 'DES',
    'meta_query' => [
        [
        'key' => 'event_date',
        'compare' => '<=',
        'value' => $today,
        'type' => 'numeric'
        ]
    ]
));

while($pastEvents->have_posts()) {
	$pastEvents->the_post(); 
	
    get_template_part('template_parts/content', 'event');

 }

echo paginate_links([
'total' => $pastEvents -> max_num_pages
]);

?>
</div>

<?php get_footer(); ?>