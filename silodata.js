
function removeSpace(entry) {
    return entry != "";
}

function add(x, y){
    return (x+y);
}

function drawChart(data) {
    var siloText = data;
    if(siloText.search("(ddmmyyyy)")) {
        var siloData = siloText.slice(siloText.search("(ddmmyyyy)")+10);
    }
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

    var ctx = document.getElementById("dataChart");
    var dataChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: siloDate,
            datasets: [{
                label: 'Minimum Temp',
                data: siloMinTemps,
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
                data: siloMaxTemps,
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

function downloadCanvas(link, canvasId, filename) {
    link.href = document.getElementById(canvasId).toDataURL();
    link.download = filename;
}