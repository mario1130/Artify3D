@extends('layouts.plantilla_dashboard')

@section('context')
    <style>
        .dashboard-charts-grid {
            display: flex;
            flex-direction: column;
            gap: 40px;
            margin-bottom: 32px;
            align-items: center;
            width: 100%;
            margin-top: 5rem;
        }

        .dashboard-charts-row {
            display: flex;
            gap: 40px;
            justify-content: center;
            width: 70%;
        }

        .dashboard-chart-card {
            width: 100%;
            max-width: 700px;
            background: #fff;
            border-radius: 14px;
            box-shadow: 0 2px 12px 0 #0001;
            padding: 32px 24px 24px 24px;
            display: flex;
            flex-direction: column;
            align-items: center;
            margin: 0 auto;
        }

        .dashboard-chart-card h3 {
            margin-bottom: 18px;
            color: #22223b;
            font-weight: 1000;
            font-size: 1.3rem;
        }

        canvas {
            width: 100% !important;
            max-width: 650px;
            height: 320px !important;
        }

        .dashboard-chart-card button {
            background: #6366f1;
            color: #fff;
            border: none;
            border-radius: 6px;
            padding: 8px 18px;
            margin-right: 8px;
            font-size: 1em;
            cursor: pointer;
            transition: background 0.2s;
        }

        .dashboard-chart-card button:last-child {
            margin-right: 0;
        }

        .dashboard-chart-card button:hover {
            background: #3730a3;
        }

        @media (max-width: 1200px) {
            .dashboard-charts-row {
                flex-direction: column;
                gap: 40px;
                align-items: center;
            }
        }
    </style>

    <div class="dashboard-charts-grid">
        <div class="dashboard-charts-row">
            <div class="dashboard-chart-card">
                <h3>Usuarios creados por mes</h3>
                <div style="margin-bottom:14px;">
                    <button onclick="changeChartType('usersChart', 'bar')">Barras</button>
                    <button onclick="changeChartType('usersChart', 'line')">Líneas</button>
                </div>
                <canvas id="usersChart" height="320"></canvas>
            </div>
            <div class="dashboard-chart-card">
                <h3>Visitas mensuales</h3>
                <div style="margin-bottom:14px;">
                    <button onclick="changeChartType('visitsChart', 'bar')">Barras</button>
                    <button onclick="changeChartType('visitsChart', 'line')">Líneas</button>
                </div>
                <canvas id="visitsChart" height="320"></canvas>
            </div>
        </div>
        <div class="dashboard-charts-row">
            <div class="dashboard-chart-card">
                <h3>Devoluciones mensuales</h3>
                <div style="margin-bottom:14px;">
                    <button onclick="changeChartType('returnsChart', 'bar')">Barras</button>
                    <button onclick="changeChartType('returnsChart', 'line')">Líneas</button>
                </div>
                <canvas id="returnsChart" height="320"></canvas>
            </div>
            <div class="dashboard-chart-card">
                <h3>Denuncias de comentarios mensuales</h3>
                <div style="margin-bottom:14px;">
                    <button onclick="changeChartType('reportsChart', 'bar')">Barras</button>
                    <button onclick="changeChartType('reportsChart', 'line')">Líneas</button>
                </div>
                <canvas id="reportsChart" height="320"></canvas>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const months = @json($months->map(fn($m) => \Carbon\Carbon::createFromFormat('Y-m', $m)->format('M Y')));
        const usersData = @json($usersData);
        const visitsData = @json($visitsData);
        const returnsData = @json($returnsData);
        const reportsData = @json($reportsData);

        let usersChart, visitsChart, returnsChart, reportsChart;

        function createChart(ctx, type, label, data, color, border) {
            return new Chart(ctx, {
                type: type,
                data: {
                    labels: months,
                    datasets: [{
                        label: label,
                        data: data,
                        backgroundColor: color,
                        borderColor: border,
                        borderWidth: 2,
                        borderRadius: 8,
                        fill: true,
                        tension: 0.3
                    }]
                },
                options: {
                    plugins: {
                        legend: {
                            display: false
                        }
                    },
                    maintainAspectRatio: false,
                    scales: {
                        y: {
                            beginAtZero: true,
                            grid: {
                                color: '#e5e7eb'
                            },
                            ticks: {
                                color: '#22223b'
                            }
                        },
                        x: {
                            grid: {
                                color: '#f3f4f6'
                            },
                            ticks: {
                                color: '#22223b'
                            }
                        }
                    }
                }
            });
        }

        // Inicialización
        usersChart = createChart(
            document.getElementById('usersChart'),
            'bar',
            'Usuarios',
            usersData,
            '#6366f1',
            '#3730a3'
        );
        visitsChart = createChart(
            document.getElementById('visitsChart'),
            'bar',
            'Visitas',
            visitsData,
            '#e11d48',
            '#be123c'
        );
        returnsChart = createChart(
            document.getElementById('returnsChart'),
            'bar',
            'Devoluciones',
            returnsData,
            '#22c55e',
            '#15803d'
        );
        reportsChart = createChart(
            document.getElementById('reportsChart'),
            'bar',
            'Denuncias',
            reportsData,
            '#f59e42',
            '#b45309'
        );

        function changeChartType(chartId, type) {
            let chart, label, data, color, border;
            if (chartId === 'usersChart') {
                chart = usersChart;
                label = 'Usuarios';
                data = usersData;
                color = '#6366f1';
                border = '#3730a3';
            } else if (chartId === 'visitsChart') {
                chart = visitsChart;
                label = 'Visitas';
                data = visitsData;
                color = '#e11d48';
                border = '#be123c';
            } else if (chartId === 'returnsChart') {
                chart = returnsChart;
                label = 'Devoluciones';
                data = returnsData;
                color = '#22c55e';
                border = '#15803d';
            } else {
                chart = reportsChart;
                label = 'Denuncias';
                data = reportsData;
                color = '#f59e42';
                border = '#b45309';
            }
            chart.destroy();
            if (chartId === 'usersChart') {
                usersChart = createChart(document.getElementById('usersChart'), type, label, data, color, border);
            } else if (chartId === 'visitsChart') {
                visitsChart = createChart(document.getElementById('visitsChart'), type, label, data, color, border);
            } else if (chartId === 'returnsChart') {
                returnsChart = createChart(document.getElementById('returnsChart'), type, label, data, color, border);
            } else {
                reportsChart = createChart(document.getElementById('reportsChart'), type, label, data, color, border);
            }
        }
    </script>
@endsection
