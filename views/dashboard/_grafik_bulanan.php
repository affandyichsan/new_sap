<?php

use yii\helpers\Url;
?>
<!-- <div id="chart-container"></div> -->
<script>
    var domMonth = document.getElementById("chart-container");
    var myChartMonth = echarts.init(domMonth, null, {
        renderer: "canvas",
        useDirtyRect: false
    });

    // Fungsi ambil data dari REST API
    async function loadChartDataMonth() {
        try {
            const response = await fetch("<?= Url::base() ?>/rest/grafik/get-data-grafik");
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

            myChartMonth.setOption(option);
        } catch (error) {
            console.error("Gagal memuat data grafik:", error);
        }
    }

    loadChartDataMonth();

    window.addEventListener("resize", function() {
        myChartMonth.resize();
    });
</script>