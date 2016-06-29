<?php

  //Load the jquery datepicker
  wp_enqueue_script('jquery-ui-datepicker');
  wp_enqueue_style('jquery-style', 'http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.2/themes/smoothness/jquery-ui.css');
  //wp_enqueue_style('jquery-style', get_template_directory_uri() . '/Top50Search/css/jquery-ui-1.10.4.min.css');

  // Load the bootstrap stylesheet
  //this bootstrap file has been modified to allow the theme to control font etc
  wp_enqueue_style( 'Top50Search-bootstrap', get_template_directory_uri() . '/Top50Search/css/flatly/bootstrap.css' );
  wp_style_add_data( 'Top50Search-bootstrap', 'title', 'bootstrap' );

   // Load the animate stylesheet
  wp_enqueue_style( 'Top50Search-Animate', 'https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.2.3/animate.min.css' );
  //wp_enqueue_style( 'Top50Search-Animate', get_template_directory_uri() . '/Top50Search/css/animate.css' );


//load font-awesome stylesheet
 wp_enqueue_style( 'Top50Search-fontawesomestyle', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css');

  // Load the PriceCompare Stylesheet
	wp_enqueue_style( 'Top50Search-style', get_template_directory_uri() . '/Top50Search/css/Top50Search.css', array(), null, 'screen' );
	//wp_style_add_data( 'Top50Search-style', 'title3', 'pricetable' );


  if (!is_admin()) {
		wp_enqueue_script('jquery');
    wp_enqueue_script('javascript');
    //wp_enqueue_script( 'Top50Search-bootstrapscript', 'https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js', array(), true );
	}

//Load JQuery JSON script
wp_enqueue_script( 'Top50SearchJSON-script', 'http://jquery-json.googlecode.com/files/jquery.json-2.2.min.js');


//Load the Top50Search js file
  wp_enqueue_script( 'Top50Search-script', get_template_directory_uri() . '/Top50Search/js/Top50SearchPage.js');


//PHP function get current year season start date
function getSeasonStartDate() {
    $date = DateTime::createFromFormat("Y-m-d", Date("Y-m-d"));
    $date = $date->format("Y");
    $date_str = $date . "-06-01";
    return $date_str;
}
//get current year season end date
function getSeasonEndDate() {
    $date = DateTime::createFromFormat("Y-m-d", Date("Y-m-d"));
    $date = $date->format("Y");
    $date_str = $date . "-09-30";
    return $date_str;
}

?>
