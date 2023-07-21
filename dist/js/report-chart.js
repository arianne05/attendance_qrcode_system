google.charts.load("current", { packages: ["bar"] });
google.charts.setOnLoadCallback(drawChart);

function drawChart() {
  var data = google.visualization.arrayToDataTable([
    ["Year", "Sales", "Expenses", "Profit"],
    ["2014", 1000, 400, 200],
    ["2015", 1170, 460, 250],
    ["2016", 660, 1120, 300],
    ["2017", 1030, 540, 350],
  ]);

  var options = {
    chart: {
      title: "Company Performance",
      subtitle: "Sales, Expenses, and Profit: 2014-2017",
    },
    colors: ["#9ae2c7", "#fc7777", "#6dabc6"], // Set the desired colors here
  };

  var chartContainer = document.getElementById("columnchart_material");

  var chart = new google.charts.Bar(chartContainer);

  chart.draw(data, google.charts.Bar.convertOptions(options));
}
