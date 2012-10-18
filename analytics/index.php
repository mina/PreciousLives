<?php
$pageTitle = "Penyolitics";
?>
<!DOCTYPE>
<html>
  <?php
  	include_once("head.php");
  ?>
  <body>
  	<div class="page-header">
  		<h1>Penyolitics</h1>
  	</div>
    <!-- The 2 Buttons for the user to interact with -->
    <button class="btn" onclick="chartRefresher.load(); progressBar.show();">Load Chart (click again if it doesn't work :))</button>
    <div id="progress-bar"  class="hidden progress progress-striped active">
      <div class="bar" style="width: 40%;">
	      
      </div>
    </div>
    <div id="chart_div"></div>
    
    <!-- These JavaScript files will be created later on in the tutorial -->
    <script src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
    <script src="chartRefresher.js"></script>
    <script src="chartData.js"></script>

    <!-- Load the Client Library. Use the onload parameter to specify a callback function -->
    <script id="gapi" src="https://apis.google.com/js/client.js"></script>
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script src="chart.js"></script>
    <script src="progressBar.js"></script>
    </body>
</html>
