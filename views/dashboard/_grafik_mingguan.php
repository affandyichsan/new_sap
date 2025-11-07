<?php

use yii\helpers\Url;
?>
  <!-- <div id="chart-container-week"></div> -->
  <script>
      var dom = document.getElementById("chart-container-week");
      var myChart = echarts.init(dom, null, {
          renderer: "canvas",
          useDirtyRect: false
      });

      // Fungsi ambil data dari REST API
      async function loadChartData() {
          try {
              const response = await fetch("<?= Url::base() ?>/rest/grafik/get-data-grafik-weekly");
              const data = await response.json();

              // Pastikan struktur data API seperti:
              // { "labels": ["Mon","Tue","Wed"], "values": [120,200,150] }

              var option = {
                  tooltip: {},
                  xAxis: {
                      type: "category",
                      data: data.month || [] // ambil label dari API
                  },
                  yAxis: {
                      type: "value"
                  },
                  series: [{
                      name: "Total Achievements",
                      data: data.total_ach || [], // ambil nilai dari API
                      type: "bar",
                      itemStyle: {
                          borderRadius: [5, 5, 0, 0]
                      }
                  }]
              };

              myChart.setOption(option);
          } catch (error) {
              console.error("Gagal memuat data grafik:", error);
          }
      }

      loadChartData();

      window.addEventListener("resize", function() {
          myChart.resize();
      });
  </script>