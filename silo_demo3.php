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
			 th, td {width: 100px;}
		</style>
        <?php
        $startdate = "20070101";
        $enddate = "20070128";
        $station = "40221";
        
        $title = "Station 40221 - 01/2007";
        
        if(isset($_POST['submit'])){
            $startdate = $_POST['year'].$_POST['month']."01";
            $enddate = $_POST['year'].$_POST['month']."28";
            $station = $_POST['station'];
            
            $title = "Station ".$_POST['station']." - ".$_POST['month']."/".$_POST['year'];
        }
        
        $url = "https://www.longpaddock.qld.gov.au/cgi-bin/silo/PatchedPointDataset.php?format=standard&station=".$station."&start=".$startdate."&finish=".$enddate."&username=DECO3800&password=UQ3800";
            
        $testfile = file_get_contents($url);
           
        $separators = array("\"", "\n");
 
        $returntext = str_replace($separators, " ", $testfile);

        ?>
		<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
		<script type="text/javascript">
            google.charts.load('current', {'packages':['corechart']});
            google.charts.setOnLoadCallback(drawChart);

            drawChart();
            
            function removeSpace(entry) {
                return entry != "";
            }
            
            function drawChart() {
               
                var siloText = "<?php echo $returntext ?>";
                console.log("<?php echo $url ?>");
                if(siloText.search("(ddmmyyyy)")) {
                    var siloData = siloText.slice(siloText.search("(ddmmyyyy)")+10);
                }
                var siloDump = siloData.split(/[\r\s]/);
                var siloArray = siloDump.filter(removeSpace);
                var siloTemps = [['Date', 'Min Temp', 'Max Temp']];
                var datePos = 16;
                var minTPos = 4;
                var maxTPos = 2;
                for(var k=0; k<=27; k++) {
                    var newEntry = [];
                    newEntry.push(siloArray[datePos]);
                    newEntry.push(parseFloat(siloArray[minTPos]));
                    newEntry.push(parseFloat(siloArray[maxTPos])); 
                    siloTemps.push(newEntry);
                    datePos += 17;
                    minTPos += 17;
                    maxTPos += 17;
                }
                var data = google.visualization.arrayToDataTable(siloTemps);

                var options = {
                  title: "<?php echo $title ?>",
                  legend: { position: 'bottom' }
                };

                var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

                chart.draw(data, options);
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
								<li><a id="thispage" href="create_graph.php">Visualise Data</a></li>
								<li><a href="#test6">Contact Us</a></li>
							</ul>
			
			
						</div>
				    </div>
			    </div>
			</nav>
		
			<div class="col s12 content">		
				
				<div class="section">
					<span class="title"> Demo Test page For SILO Database </span>
				</div>
			
			
				<div class="row">
					
					<div class="col m12">
						<div id="curve_chart" style="height: 500px"></div>
					</div>
					
					<div class="section"></div>
					
					<div class="col m12">
					
						<form action="#" method="post">
						
							<div class="col s12">
								<div class="col s6">
									<label class="label"> Start Date </label>
								</div>
								<div class="col s6">
									<label class="label"> End Date </label>
								</div>
							</div>
							
							<div class="col s6">
								<div class="input-field col m6">
						            <select name="month">
						                <option value=01>Jan</option>
						                <option value=02>Feb</option>
						                <option value=03>Mar</option>
						                <option value=04>May</option>
						                <option value=06>Jun</option>
						                <option value=07>Jul</option>
						                <option value=08>Aug</option>
						                <option value=09>Sep</option>
						                <option value=10>Oct</option>
						                <option value=11>Nov</option>
						                <option value=12>Dec</option>
						            </select>
						            <label>Month</label>
								</div>
								
								<div class="input-field col m6">
						            <select name="year">
						                <option value=2007>2007</option>
						                <option value=2008>2008</option>
						                <option value=2009>2009</option>
						                <option value=2010>2010</option>
						                <option value=2011>2011</option>
						                <option value=2012>2012</option>
						                <option value=2013>2013</option>
						                <option value=2014>2014</option>
						                <option value=2015>2015</option>
						                <option value=2016>2016</option>
						            </select>
									<label>Year</label>	
					            </div>
							</div>
							
							<div class="col s6">
								<div class="input-field col m6">
						            <select name="end-month">
						                <option value=01>Jan</option>
						                <option value=02>Feb</option>
						                <option value=03>Mar</option>
						                <option value=04>May</option>
						                <option value=06>Jun</option>
						                <option value=07>Jul</option>
						                <option value=08>Aug</option>
						                <option value=09>Sep</option>
						                <option value=10>Oct</option>
						                <option value=11>Nov</option>
						                <option value=12>Dec</option>
						            </select>
						            <label>Month</label>
								</div>
								
								<div class="input-field col m6">
						            <select name="end-year">
						                <option value=2007>2007</option>
						                <option value=2008>2008</option>
						                <option value=2009>2009</option>
						                <option value=2010>2010</option>
						                <option value=2011>2011</option>
						                <option value=2012>2012</option>
						                <option value=2013>2013</option>
						                <option value=2014>2014</option>
						                <option value=2015>2015</option>
						                <option value=2016>2016</option>
						            </select>
									<label>Year</label>	
					            </div>
							</div>
				            
				            <div class="col s12">
								<label class="label"> Pick a Station </label>
							</div>
							
							<div class="col s12">
								<div class="input-field col m12">
						            <select name="station">
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
					            <input type="submit" name="submit" value="Update Graph"/>
				            </div>
						           
				        </form>
					</div>
				</div>
			</div>
			
			<div class="section"></div>
			
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