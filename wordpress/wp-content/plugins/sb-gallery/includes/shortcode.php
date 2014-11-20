<?php

/******    REWRITE THE GALLERIE FUNCTION FROM WORDPRESS   **********/
$hover_effect=  get_option('hover_effect');
$fancybox_setting= get_option('fancybox_setting');
add_shortcode('gallery', 'my_gallery_shortcode');  
function my_gallery_shortcode($attr) {
  $counter=0; 
  $post = get_post();
static $instance = 0;
$instance++;
if ( ! empty( $attr['ids'] ) ) {
    if ( empty( $attr['orderby'] ) )
        $attr['orderby'] = 'post__in';
    $attr['include'] = $attr['ids'];
}

// Allow plugins/themes to override the default gallery template.
$output = apply_filters('post_gallery', '', $attr);
if ( $output != '' )
    return $output;

// We're trusting author input, so let's at least make sure it looks like a valid orderby statement
if ( isset( $attr['orderby'] ) ) {
    $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
    if ( !$attr['orderby'] )
        unset( $attr['orderby'] );
}

$output = apply_filters('post_gallery', '', $attr);
if ( $output != '' )
   return $output; 

if ( isset( $attr['orderby'] ) ) {
    $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
    if ( !$attr['orderby'] )
        unset( $attr['orderby'] );
}

extract(shortcode_atts(array(

    'order'      => 'ASC',
    'orderby'    => 'menu_order ID',
    'id'         => $post->ID,
    'itemtag'    => 'dl',
    'icontag'    => 'dt',
    'captiontag' => 'dd',
	'columns'    => 3,
    'size'       => 'Full size',
    'include'    => '',
    'exclude'    => '' ), $attr));

$id = intval($id);

if ( 'RAND' == $order )

    $orderby = 'none';

if ( !empty($include) ) {

    $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

    $attachments = array();

    foreach ( $_attachments as $key => $val ) {

        $attachments[$val->ID] = $_attachments[$key];

    }



} elseif ( !empty($exclude) ) {



    $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );



} else {



    $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );



}

if ( empty($attachments) )
    return '';
	
$itemtag = 'li';
$captiontag = tag_escape($captiontag);
$icontag = tag_escape($icontag);
$valid_tags = wp_kses_allowed_html( 'post' );
if ( ! isset( $valid_tags[ $itemtag ] ) )
    $itemtag = 'li';
if ( ! isset( $valid_tags[ $captiontag ] ) )
    $captiontag = 'dd';
if ( ! isset( $valid_tags[ $icontag ] ) )
    $icontag = 'dt';

$columns = intval($columns);
$itemwidth = $columns > 0 ? floor(100/$columns) : 100;
$float = is_rtl() ? 'right' : 'left';

$gallery_div ='';
$gallery_style = "
    <style type='text/css'>
        #{$selector} {
            margin: auto;
        }
        #{$selector} .gallery-item {
            float: {$float};
            margin-top: 10px;
            text-align: center;
            width: {$itemwidth}%;
        }
        #{$selector} img {
            border: 2px solid #cfcfcf;
        }
        #{$selector} .gallery-caption {
            margin-left: 0;
        }
    </style>
    <!-- see gallery_shortcode() in wp-includes/media.php -->";
	$size_class = sanitize_html_class( $size );	 
//echo $gallery_div;  

$i = 0;
$count=0;



$gallery_div = "<div id='$selector' class='sb-grid-wrapper galleryid-{$id} gallery-columns-{$columns} gallery-size-{$size_class}'><ul class='sb-grid'>";
$output = apply_filters( 'gallery_style', $gallery_style . "\n\t\t" . $gallery_div );

$i = 0;
foreach ( $attachments as $id => $attachment ) {
$link = isset($attr['link']) && 'file' == $attr['link'] ? wp_get_attachment_link($id, $size, false, false) : wp_get_attachment_link($id, $size, true, false);

$image = $attachments[$id];
$image_path=$image->guid; 

    $output .= "<{$itemtag} class='".get_option('hover_effect')."'>";
 

if(get_option('fancybox_setting')=='on')
{
    $output .= "<a class='fancybox' href='".$image_path."' rel='".$post->ID."' title='".$caption."'>"; 
	$output .='<img src="'.$image_path.'"/>';
    $output .= "</a></{$itemtag}>";
}
else{
	 $output .= $link; 
	$output .='<img src="'.$image_path.'"/>';
    $output .= "</a></{$itemtag}>";
}
    if ( $columns > 0 && ++$i % $columns == 0 )
        $output .= '<br style="clear: both" />';
}

$output .= "
        <br style='clear: both;' />
    </div>\n";

return $output;
}

?>