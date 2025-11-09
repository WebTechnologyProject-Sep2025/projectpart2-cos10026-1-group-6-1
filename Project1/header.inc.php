<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="header">
    <meta name="keywords" content="header, SwinVN, Project2">
    <meta name="author" content="COS10026.1 Group 6">
</head>
<?php
// Gives the full path of the currently executing script
$current_page = basename($_SERVER['PHP_SELF']); 
?>
<?php if ($current_page === 'index.php') : ?>
  <!-- Header for the index.php -->
  <header>

    <div class="header_homepage">

      <div class="header_homepage_content anim">
        <h1 id="the_css">The</h1>
        <h1 id="dataflow_css">DataFlow</h1>

        <p><strong>The DataFlow</strong> serves as your comprehensive partner in the digital era.
          We specialize in developing seamless, <strong>AI-powered solutions</strong> that transform
          complex data streams into clear, actionable intelligence,
          ensuring your business operates with <strong>unmatched efficiency and precision.</strong></p>
        <div class="read_more_button anim">
          <a href="apply.html">Read More</a>
        </div>
      </div>

      <div class="robot_with_light anim">
        <img src="images/robot_with_light.png" alt="Robot With Yellow Shadow">
      </div>

      <div id="logo_background">
        <img src="images/logo_dataflow.png" alt="Logo Background">
      </div>



    </div>

    <div class="hashtags">
      <span>#WebDevelopment</span>
      <span>#ComputerScience</span>
      <span>#COS10026</span>
      <span>#SwinburneHCMC</span>
      <span>#Group6</span>
    </div>
  </header>

<?php else: ?>
    <!-- Header for all other pages -->
<header>

    <h1 id="application"><?php echo $pageTitle; ?></h1>

    <div class="hashtags">
      <span>#WebDevelopment</span>
      <span>#ComputerScience</span>
      <span>#COS10026</span>
      <span>#SwinburneHCMC</span>
      <span>#Group6</span>
    </div>

  </header>
<?php endif; ?>