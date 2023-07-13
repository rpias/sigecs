$(document).ready(function () {
    mostrarGrafico();

});


    function mostrarGrafico() {
    {
        var ruta = ruta_raiz + "datos_estadistica";
        $.get(ruta,
            function (data) {
                console.log(data);
                var meses_g = [];
                var totales = [];

                for (var i in data) {
                    meses_g.push(data[i].Mes);
                    totales.push(data[i].Total);
                }

                var cobranzaDatosGrafico = {
                    labels: meses_g,
                    datasets: [
                        {
                            label: 'Total por mes',
                            backgroundColor: 'rgba(60,141,188,0.9)',
                            borderColor: 'rgba(60,141,188,0.8)',
                            pointRadius: false,
                            pointColor: '#3b8bba',
                            pointStrokeColor: 'rgba(60,141,188,1)',
                            pointHighlightFill: '#fff',
                            pointHighlightStroke: 'rgba(60,141,188,1)',
                            data: totales
                        },

                    ]
                }

                var graficoCobranzaOpciones = {
                    maintainAspectRatio: false,
                    responsive: true,
                    tooltips: {
                        enabled: true,
                        mode: 'single',
                        callbacks: {
                            title: function (tooltipItem, data) {
                                return "Mes: " + data.labels[tooltipItem[0].index];
                            },
                            label: function (tooltipItems, data) {
                                return "Total: " + tooltipItems.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") + ' $U';
                            },
                            footer: function (tooltipItem, data) {

                                var f = new Date();
                                return "Datos al: " + f.getDate() + " de " + MESES[f.getMonth()] + " de " + f.getFullYear()
                            }
                        }
                    },
                    legend: {
                        display: false
                    },
                    scales: {
                        xAxes: [{
                            gridLines: {
                                display: false,
                            }
                        }],
                        yAxes: [{
                            // Formatear el Eje Y
                            ticks: {
                                beginAtZero: true,
                                callback: function (value) {
                                    if (parseInt(value) >= 1000) {
                                        return '$U' + value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
                                    } else {
                                        return '$U' + value;
                                    }
                                }
                            },

                            gridLines: {
                                display: false,
                            }
                        }]
                    }
                }


                // GRAFICO DE BARRAS
                var graficoCobranzaAreas = $('#area-chart-canvas').get(0).getContext('2d');
                var gaficoArea = new Chart(graficoCobranzaAreas, {
                    type: 'line',
                    data: cobranzaDatosGrafico,
                    options: graficoCobranzaOpciones
                });


                // GRAFICO DE BARRAS
                var graficoCobranzaBarras = $('#barras-chart-canvas').get(0).getContext('2d');
                var gaficoBarras = new Chart(graficoCobranzaBarras, {
                    type: 'bar',
                    data: cobranzaDatosGrafico,
                    options: graficoCobranzaOpciones
                });


            });
    }
}














