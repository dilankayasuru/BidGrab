<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<div class="w-full border border-blue-500 rounded-xl p-4 bg-fadeWhite mb-4">
    <p>Monthly Sale</p>
    <div id="monthly-sale-chart"></div>
</div>
<script type="text/javascript">
    google.charts.load('current', {'packages': ['corechart']});
    google.charts.setOnLoadCallback(monthlySaleChart);

    function monthlySaleChart() {
        let salesData = google.visualization.arrayToDataTable([
            ['Month', 'Sales'],
            ['Jan', 1000],
            ['Feb', 1170],
            ['March', 660],
            ['April', 1030],
            ['May', 2500],
            ['June', 8456],
            ['July', 846],
            ['Aug', 9056],
            ['Sep', 805],
            ['Oct', 780],
            ['Nov', 965],
            ['Dec', 859]
        ]);

        let options = {
            curveType: 'function',
            legend: {position: 'bottom'},
            height: 320,
            backgroundColor: "#F8F9F9",
            vAxis: {
                viewWindow: {
                    min: 0
                }
            }
        };

        let salesChart = new google.visualization.LineChart(document.getElementById('monthly-sale-chart'));
        salesChart.draw(salesData, options);
    }
</script>