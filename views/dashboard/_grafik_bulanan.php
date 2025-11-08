<?php

use yii\helpers\Url;
?>
<script>
    var domMonth = document.getElementById("chart-container");
    var myChartMonth = echarts.init(domMonth, null, {
        renderer: "canvas",
        useDirtyRect: false
    });

    async function loadChartDataMonth() {
        try {
            const response = await fetch("<?= Url::base() ?>/rest/grafik/get-data-grafik");
            const data = await response.json();

            var option = {
                tooltip: {
                    trigger: "axis",
                    axisPointer: { type: "shadow" }
                },
                xAxis: {
                    type: "category",
                    data: data.month || [],
                    axisLabel: {
                        rotate: 45,
                        fontSize: 11
                    }
                },
                yAxis: {
                    type: "value",
                    axisLabel: {
                        formatter: "{value}%" // tampilkan sumbu Y dalam persen
                    }
                },
                series: [{
                    name: "Total Achievements",
                    data: data.total_ach || [],
                    type: "bar",
                    itemStyle: {
                        borderRadius: [5, 5, 0, 0],
                        color: function(params) {
                            const value = params.value;
                            if (value > 95) {
                                return "#28a745"; // bg-success (green)
                            } else if (value > 60) {
                                return "#007bff"; // bg-primary (blue)
                            } else if (value > 50) {
                                return "#ffc107"; // bg-warning (yellow)
                            } else {
                                return "#dc3545"; // bg-danger (red)
                            }
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
