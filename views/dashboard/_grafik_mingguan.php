<?php

use yii\helpers\Url;
?>
<script>
    var dom = document.getElementById("chart-container-week");
    var myChart = echarts.init(dom, null, {
        renderer: "canvas",
        useDirtyRect: false
    });

    async function loadChartData() {
        try {
            const response = await fetch("<?= Url::base() ?>/rest/grafik/get-data-grafik-weekly");
            const data = await response.json();
            console.log("Data dari API:", data); // 🟢 Debug untuk cek struktur API

            // Sesuaikan key sesuai data API kamu
            const weeks = data.week || data.weeks || data.month || [];
            const totals = data.total_ach || data.total || data.values || [];

            var option = {
                tooltip: {
                    trigger: "item",
                    backgroundColor: "#fff",
                    borderColor: "#ccc",
                    borderWidth: 1,
                    textStyle: { color: "#000" },
                    formatter: function(params) {
                        return `
                            <strong>${params.name}</strong><br/>
                            Total Achievement: ${params.value}%
                        `;
                    }
                },
                xAxis: {
                    type: "category",
                    data: weeks,
                    axisLabel: {
                        rotate: 30,
                        fontSize: 11,
                        color: "#333"
                    },
                    axisTick: { alignWithLabel: true }
                },
                yAxis: {
                    type: "value",
                    axisLabel: {
                        formatter: "{value}%" // tampilkan sumbu Y dalam persen
                    }
                },
                series: [{
                    name: "Total Achievements",
                    data: totals,
                    type: "bar",
                    barWidth: "50%",
                    itemStyle: {
                        borderRadius: [5, 5, 0, 0],
                        color: function(params) {
                            const value = params.value;
                            if (value > 95) return "#28a745"; // hijau
                            if (value > 60) return "#007bff"; // biru
                            if (value > 50) return "#ffc107"; // kuning
                            return "#dc3545"; // merah
                        }
                    },
                    label: {
                        show: true,
                        position: "top",
                        color: "#000",
                        fontWeight: "bold",
                        fontSize: 12,
                        formatter: "{c}%" // tambahkan tanda persen di atas batang
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
