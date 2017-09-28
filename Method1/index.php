<!DOCTYPE html>
<html lang="en">
  <head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <title>Schreenshot of webpage</title>
  </head>
  <body>
    <div class="container">
      <h2>Input Url(Uniform Resource Locator)</h2>
      <form action="" method="post">
        <div class="form-group">
          <input type="text" class="form-control" id="url" placeholder="Enter url" name="url">
        </div>
        <button type="submit" class="btn btn-default" id="btn">Submit</button>
      </form>
    </div>
      <?php
      	if (isset($_POST["url"]) && !empty($_POST["url"])) {
			//get website url
			$url = $_POST["url"];
			//validate url 
			if(filter_var($url, FILTER_VALIDATE_URL) == true){
			
	?>
        <div class="container">
      	<h2>Schreenshot of webpage(Extension : PNG)</h2>
	<?php      

		//call Google PageSpeed Insights API
		//This api give us output in json format
		$pagedata = file_get_contents("https://www.googleapis.com/pagespeedonline/v2/runPagespeed?url=$url&screenshot=true");
		//decode json data
		$pagedatadecode = json_decode($pagedata, true);
		//screenshot data of json file
		$screenshot = $pagedatadecode['screenshot']['data'];
		//echo $screenshot;
		$screenshot = str_replace(array('_','-'),array('/','+'),$screenshot);
		//echo $screenshot;
		//display screenshot image
		echo "<img src=\"data:image/png;base64,".$screenshot."\" />";
		}else{
				echo"Please Enter Valid Url";
			}
		}else{
		}
	?> 
    </div>
<script type="text/javascript">
  $(document).ready(function(){
    $('.btn').attr('disabled',true);
    $('#url').keyup(function(){
        if($(this).val.length !=0){
            $('.btn').attr('disabled', false);
        }
    })
});
</script>
  </body>
</html>