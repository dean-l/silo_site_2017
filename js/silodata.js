
function removeSpace(entry) {
    return entry != "";
}

function siloParse(data){
    var siloText = data;
    if(siloText.search("(ddmmyyyy)") > 0) {
        var siloData = siloText.slice(siloText.search("(ddmmyyyy)")+10);
        var siloDump = siloData.split(/[\r\s]/);
        var siloArray = siloDump.filter(removeSpace);
        var siloMinTemps = [];
        var siloMaxTemps = [];
        var siloDate = [];
        var datePos = 16;
        var minTPos = 4;
        var maxTPos = 2;
        //for(var k=0; k<=27; k++) {
        while(siloArray[datePos]){
            var newEntry = [];
            siloDate.push(siloArray[datePos]);
            siloMinTemps.push(parseFloat(siloArray[minTPos]));
            siloMaxTemps.push(parseFloat(siloArray[maxTPos])); 
            //siloTemps.push(newEntry);
            datePos += 17;
            minTPos += 17;
            maxTPos += 17;
        }
        var dataArray = [siloDate, siloMinTemps, siloMaxTemps];
        return dataArray;
        console.log(dataArray);
    } else if(siloText.search("range") >= 0){
        var errorMsg = "Error: Date range must be from 01/01/1889 to today";
        //document.getElementById("error_pane").textContent = errorMsg;
        return errorMsg;
    } else if(siloText.search("not patched") >= 0){
        var errorMsg = "Error: Sorry, this station has not been patched";
        //document.getElementById("error_pane").textContent = errorMsg; 
        return errorMsg;
    } else if(siloText.search("valid station") >= 0){
        var errorMsg = "Error: Invalid Station";
        //document.getElementById("error_pane").textContent = errorMsg; 
        return errorMsg;
    } 
}

function drawChart(data) {
    var siloArray = siloParse(data);
    if(!Array.isArray(siloArray)) {
        if(siloArray.search("Error") >= 0) {
            document.getElementById("error_pane").textContent = siloArray;
        }
    } else {
        var ctx = document.getElementById("dataChart");
        var dataChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: siloArray[0],
                datasets: [{
                    label: 'Minimum Temp',
                    data: siloArray[1],
                    backgroundColor: 'rgba(54, 162, 235, 0)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    pointBackgroundColor: 'rgba(54, 162, 235, 0.5)',
                    pointBorderColor: 'rgba(54, 162, 235, 1)',
                    pointHoverBackgroundColor: 'rgba(54, 162, 235, 1)',
                    pointHoverBorderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Maximum Temp',
                    data: siloArray[2],
                    backgroundColor: 'rgba(255, 51, 153, 0)',
                    borderColor: 'rgba(255, 51, 153, 1)',
                    pointBackgroundColor: 'rgba(255, 51, 153, 0.5)',
                    pointBorderColor: 'rgba(255, 51, 153, 1)',
                    pointHoverBackgroundColor: 'rgba(255, 51, 153, 1)',
                    pointHoverBorderColor: 'rgba(255, 51, 153, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            suggestedMin: 10,
                            suggestedMax: 40,
                            stepSize: 5
                        }
                    }]
                },
                bezierCurve : false,
                animation: false
            }
        });
    }
}

function downloadCanvas(link, canvasId, filename) {
    link.href = document.getElementById(canvasId).toDataURL();
    link.download = filename;
}