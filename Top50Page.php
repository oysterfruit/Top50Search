<?php
/*
Template Name: Top50Page
*/


  get_header();
  define('DOCROOT', realpath(dirname(__FILE__)));
  //echo DOCROOT;


//set up jquery, javascript and enqueue required files

require DOCROOT . '/Top50Search/Top50SearchFunctions.php';

?>

 <!-- <div class="first-background"> around the selection area -->

  <div id="bootstyle" class="container">

  <div class="well semi-transparent-well add-small-gap">

  <h1 id="topBlurb">Hello there!</h1> <!--change this to say good morning/afternoon/evening depending on timezone-->
  <h3>
    A good day for shopping insert weather blurb have weather pic.<br>Create a list of your favourites and get notifed when the price goes down!
    </h3>
  <p>Step 1: Browse top selling items. <br>Step 2: Save them in your list. <br> Step 3: Select how you'd like to be notified of any price changes.  </p>

  </div> <!-- end first well -->


<?php

    include DOCROOT . '/Top50Search/Top50SearchGrid.php';

?>

<?php get_footer(); ?>
