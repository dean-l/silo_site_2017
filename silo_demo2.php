<!DOCTYPE HTML>
<html>
    <head>
    </head>
    <body>
        <select>
            <option value=40221>Dutton Park</option>
            <option value=40332>Taringa</option>
            <option value=40767>PA Hospital</option>
            <option value=40359>Highgate Hill</option>
            <option value=40214>Botanic Gardens</option>
            <option value=40913>Brisbane</option>
            <option value=40233>Milton</option>
        </select>
        
        
        <h1>Site Data</h1>
        <p>
            <?php

            $testfile = file_get_contents('https://www.longpaddock.qld.gov.au/cgi-bin/silo/PatchedPointDataset.php?format=standard&station=40221&start=20170201&finish=20170228&username=DECO3800&password=UQ3800');

            $returntext = str_replace("\"", "<p>", $testfile);
            
            echo $returntext;

            ?>
        </p>
    </body>
</html>

