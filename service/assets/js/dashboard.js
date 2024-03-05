$(function () {
  // ดึงข้อมูล JSON จากไฟล์ PHP
  function convertToThaiMonth(month) {
    const monthNames = [
      "มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน",
      "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"
    ];
  
    const [year, monthNumber] = month.split("-");
    const thaiMonth = monthNames[parseInt(monthNumber, 10) - 1];
    return `${thaiMonth} ${parseInt(year, 10) + 543}`;
  }
  
  $.ajax({
    url: 'conf/condata.php', // แทนที่ชื่อไฟล์ตามที่คุณตั้งไว้
    method: 'GET',
    dataType: 'json',
    success: function (jsonData) {
      var profitChartOptions = {
        series: [
          { name: "121205", data: jsonData.map(item => parseFloat(item.total_amount_121205)) },
          { name: "121206", data: jsonData.map(item => parseFloat(item.total_amount_121206)) },
          { name: "121207", data: jsonData.map(item => parseFloat(item.total_amount_121207)) },
          { name: "121208", data: jsonData.map(item => parseFloat(item.total_amount_121208)) }
        ],
        chart: {
          type: "bar",
          height: 345,
          offsetX: -15,
          toolbar: { show: true },
          foreColor: "#adb0bb",
          fontFamily: "inherit",
          sparkline: { enabled: false },
        },
        colors: ["#5D87FF", "#2A3547", "#13DEB9", "#FA896B"],
        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: "35%",
            borderRadius: [6],
            borderRadiusApplication: "end",
            borderRadiusWhenStacked: "all",
          },
        },
        markers: { size: 0 },
        dataLabels: { enabled: false },
        legend: { show: false },
        grid: {
          borderColor: "rgba(0,0,0,0.1)",
          strokeDashArray: 3,
          xaxis: { lines: { show: false } },
        },
        xaxis: {
          type: "category",
          categories: jsonData.map(item => convertToThaiMonth(item.month)),
          labels: { style: { cssClass: "grey--text lighten-2--text fill-color" } },
        },
        
        yaxis: {
          show: true,
          min: 0,
          tickAmount: 4,
          labels: { style: { cssClass: "grey--text lighten-2--text fill-color" } },
        },
        stroke: { show: true, width: 3, lineCap: "butt", colors: ["transparent"] },
        tooltip: { theme: "light" },
        responsive: [
          {
            breakpoint: 600,
            options: {
              plotOptions: { bar: { borderRadius: 3 } },
            },
          },
        ],
      };

      var profitChart = new ApexCharts(document.querySelector("#chart"), profitChartOptions);
      profitChart.render();
    },
    error: function (jqXHR, textStatus, errorThrown) {
      console.log('Error: ' + textStatus, errorThrown);
    }
    
  });
  var breakup = {
    color: "#adb5bd",
    series: [38, 40, 25],
    labels: ["2022", "2021", "2020"],
    chart: {
      width: 180,
      type: "donut",
      fontFamily: "Plus Jakarta Sans', sans-serif",
      foreColor: "#adb0bb",
    },
    plotOptions: {
      pie: {
        startAngle: 0,
        endAngle: 360,
        donut: {
          size: '75%',
        },
      },
    },
    stroke: {
      show: false,
    },

    dataLabels: {
      enabled: false,
    },

    legend: {
      show: false,
    },
    colors: ["#5D87FF", "#ecf2ff", "#F9F9FD"],

    responsive: [
      {
        breakpoint: 991,
        options: {
          chart: {
            width: 150,
          },
        },
      },
    ],
    tooltip: {
      theme: "dark",
      fillSeriesColor: false,
    },
  };

  var chart = new ApexCharts(document.querySelector("#breakup"), breakup);
  chart.render();
});
