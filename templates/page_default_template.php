<?php
/*
* Clarity template Default template
*/
?>
<?php get_component('c-global-header'); ?>
  <div id="maincontent" class="u-wrapper l-main l-reverse-order t-default">
    <h1 class="o-title o-title--page">Generic page</h1>
    <div class="l-secondary">
      <?php get_component('c-left-hand-menu'); ?>
    </div>
    <div class="l-primary js-tabbed-content-container" role="main">
      <?php get_component('c-rich-text-block'); ?>
    </div>
  </div>
<?php get_component('c-global-footer'); ?>
