<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0"/>
  <title>SILO</title>

  <!-- CSS  -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link href="css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  <link href="css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
  
	<style>
		 table, th, td {border: 2px solid gray; border-collapse: collapse;}
		 th, td {width: auto;}
	</style>
	
	<?php
        $startdate = "20070101";
        $enddate = "20070128";
        $station = "40221";
        
        $title = "Station 40221 - 01/2007";
        
        if(isset($_POST['submit'])){

			$startdate = $_POST['start-date'];
            $enddate = $_POST['end-date'];
            $station = $_POST['stat'];
            
            $title = "Station ".$_POST['stat']." - ".$startdate." - ".$enddate;
        }
        
        
        
        $sd = explode(" ",$startdate);

		if (strlen($sd[0]) == 1){
			$sd[0]="0".$sd[0];
		}
		$sd[1] = monthchange(rtrim($sd[1],","));
		
		
		$ed = explode(" ",$enddate);

		if (strlen($ed[0]) == 1){
			$ed[0]="0".$ed[0];
		}
		$ed[1] = monthchange(rtrim($ed[1],","));
		

		function monthchange($mon){
			if ($mon == "January"){
				return "01";
			} else if ($mon == "February"){
				return "02";
			} else if ($mon == "March"){
				return "03";
			} else if ($mon == "April"){
				return "04";
			} else if ($mon == "May"){
				return "05";
			} else if ($mon == "June"){
				return "06";
			} else if ($mon == "July"){
				return "07";
			} else if ($mon == "August"){
				return "08";
			} else if ($mon == "September"){
				return "09";
			} else if ($mon == "October"){
				return "10";
			} else if ($mon == "November"){
				return "11";
			} else if ($mon == "Desember"){
				return "12";
			}
		}	
		
		$startdate = $sd[2].$sd[1].$sd[0];
		
		$enddate = $ed[2].$ed[1].$ed[0];
        
        
        $url = "https://www.longpaddock.qld.gov.au/cgi-bin/silo/PatchedPointDataset.php?format=standard&station=".$station."&start=".$startdate."&finish=".$enddate."&username=DECO3800&password=UQ3800";
            
        $testfile = file_get_contents($url);
           
        $separators = array("\"", "\n");
 
        $returntext = str_replace($separators, " ", $testfile);

    ?>
    
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.bundle.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
	<script type="text/javascript" src="js/silodata.js"></script>
    <script>
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);
        
            window.onload = function(){
                document.getElementById('downloadBtn').addEventListener('click', function() {
                    var d = new Date();
                    var filename = "silo_chart_" + d.getFullYear() + "_" + (d.getMonth()+1) + "_" + d.getDate() + "_" + Math.floor((Math.random() * 1000) + 1) + ".png"
                    downloadCanvas(this, 'dataChart', filename);
                }, false);

                var siloText = "<?php echo $returntext ?>";
                console.log("<?php echo $returntext ?>");
                console.log("<?php echo $url ?>");
                drawChart(siloText);
            }
    
    </script>
	
  
</head>
<body>
  <div class="container outside">
	  
	<nav class="nav-extended grey lighten-4">
		
	    <div class="nav-wrapper">
		  
	      	<a href="#" class="brand-logo"> 
		    	<img src="images/logo.png" width="40px"> 
				<span class="logo-text"> 
					<strong>Queensland</strong> Government
				</span>
			</a>
	      
	    </div>
	    
	    <div class="nav-content blue darken-2">
		    <div class="row">
			    <div class="col s12">
				    <span class="nav-title">Science Information for Land Owner</span>
			    </div>
				<div class="col s12 light-blue darken-4 navi">

					<ul>
						<li><a href="index.php">Home</a></li>
						<li><a href="#test2">About</a></li>
						<li><a href="#test3">Request Data</a></li>
						<li><a href="#test4">API</a></li>
						<li><a href="#test5">FAQ</a></li>
						<li><a href="create_graph.php">Visualise Data</a></li>
						<li><a href="#test6">Contact Us</a></li>
					</ul>
				</div>
		    </div>
	      
	    </div>
	</nav>
	
	<div class="section row">
		<div class="col s12 l3 card setting">
			
			
			<div class="col m12">
					
						<form action="#" method="post">
						
							
							<div class="col s12">
								<label class="label"> Start Date </label>
							</div>
							
							<div class="col s12">
								<div class="input-field col s12">
						            <input type="date" class="datepicker" name="start-date">
								</div>
							</div>
							
							<div class="col s12">
								<label class="label"> End Date </label>
							</div>
							
							<div class="col s12">
								<div class="input-field col s12">
						            <input type="date" class="datepicker" name="end-date">
								</div>
							</div>
				            
				            <div class="col s12">
								<label class="label"> Pick a Station </label>
							</div>
							
							<div class="col s12">
								<div class="input-field col s12">
						            <select name="stat">
						                <option value=40221>Dutton Park</option>
						                <option value=40332>Taringa</option>
						                <option value=40767>PA Hospital</option>
						                <option value=40359>Highgate Hill</option>
						                <option value=40214>Botanic Gardens</option>
						                <option value=40913>Brisbane</option>
						                <option value=40233>Milton</option>
						            </select>
						            
								</div>
								
							</div>
				            
				            <div class="col s12 button">
					            
					            <button class="btn waves-effect waves-light" type="submit" name="submit">
					                Update Graph
								</button>
								
				            </div>
                            
                            <div class="col s12 button">
                                <p id="error_pane" style="margin-top: 20px; color: red;"></p>
				            </div>
						           
				        </form>
					</div>

		</div>
		
		<div class="col s12 l9">
			
			<canvas id="dataChart" style="height: 500px"></canvas>
            <form>
            <a class="btn waves-effect waves-light" id="downloadBtn">Download This Graph</a>
            </form>
		</div>
		
		<div>
		</div>
		<div>
		</div>	
		
		
	</div>
  
	<footer class="page-footer blue darken-2">
	
		<div class="row blue darken-2">
			<div class="col s2 offset-s10 share">
				<strong>Share: </strong>
				<img class="share-pic" src="images/fb-logo.png" height="30px"> 
				<img class="share-pic" src="images/twit-logo.png" height="30px"> </div>
		</div>
		
		<div class="col s12 light-blue darken-4">
		    <div class="container">
		      <div class="row">
		        <div class="col l6 s12">
		          <h5 class="white-text">Company Bio</h5>
		          <p class="grey-text text-lighten-4">We are a team of college students working on this project like it's our full time job. Any amount would help support and continue development on this project and is greatly appreciated.</p>
		
		
		        </div>
		        <div class="col l3 s12">
		          <h5 class="white-text">Settings</h5>
		          <ul>
		            <li><a class="white-text" href="#!">Link 1</a></li>
		            <li><a class="white-text" href="#!">Link 2</a></li>
		            <li><a class="white-text" href="#!">Link 3</a></li>
		            <li><a class="white-text" href="#!">Link 4</a></li>
		          </ul>
		        </div>
		        <div class="col l3 s12">
		          <h5 class="white-text">Connect</h5>
		          <ul>
		            <li><a class="white-text" href="#!">Link 1</a></li>
		            <li><a class="white-text" href="#!">Link 2</a></li>
		            <li><a class="white-text" href="#!">Link 3</a></li>
		            <li><a class="white-text" href="#!">Link 4</a></li>
		          </ul>
		        </div>
		      </div>
		    </div>
		</div>
	
	
	</footer>

  </div>

  <!--  Scripts-->
  <script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
  <script src="js/materialize.js"></script>
  <script src="js/init.js"></script>

  </body>
</html>
