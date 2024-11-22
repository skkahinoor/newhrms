<script src="{{ asset('assets/vendor/js/core/popper.min.js') }}"></script>
<script src="{{ asset('assets/vendor/js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/vendor/js/plugins/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/vendor/js/plugins/smooth-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/vendor/js/plugins/chartjs.min.js') }}"></script>

<script>
    // Fetch the data dynamically (optional)
    async function fetchChartData() {
        const response = await fetch('api/quotations/combined-chart-data'); // Adjust the URL to your endpoint
        return await response.json();
    }

    async function renderChart() {
        const chartData = await fetchChartData(); // Fetch data dynamically

        // Line Chart
        const ctxLine = document.getElementById('chart-line').getContext('2d');
        new Chart(ctxLine, {
            type: 'line',
            data: {
                labels: chartData.line_labels,
                datasets: [{
                    label: 'Daily Sales',
                    data: chartData.line_data,
                    borderColor: '#c9c9c9',
                    backgroundColor: '#ffffff',
                    tension: 0.4, // Smooth curves
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            color: 'white',
                            font: {
                                weight: 'bold',
                                size: '17px'
                            }
                        }
                    },
                },
                scales: {
                    x: {
                        ticks: {
                            color: 'white',
                            font: {
                                weight: 'bold'
                            }
                        },
                        grid: {
                            color: 'rgba(255, 255, 255, 0.2)',
                        }
                    },
                    y: {
                        ticks: {
                            color: 'white',
                            font: {
                                weight: 'bold'
                            }
                        }
                    }
                },
                layout: {
                    padding: {
                        top: 10,
                        bottom: 10
                    }
                }
            }
        });

        // Monthly Bar Chart
        const ctxMonthly = document.getElementById('chart-bars').getContext('2d');
        new Chart(ctxMonthly, {
            type: 'bar',
            data: {
                labels: chartData.monthly_labels,
                datasets: [{
                    label: 'Completed Orders (Monthly)',
                    data: chartData.monthly_data,
                    backgroundColor: '#ffffff80',
                    borderColor: '#ffffff',
                    borderWidth: 1,
                    tension: 0.4,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            color: 'white',
                            font: {
                                weight: 'bold',
                                size: '17px'
                            }
                        }
                    },
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        ticks: {
                            color: 'white',
                            font: {
                                weight: 'bold'
                            }
                        },
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: 'white',
                            font: {
                                weight: 'bold'
                            }
                        },
                    }
                }
            }
        });

        // Weekly Bar Chart
        // Weekly Bar Chart
        const ctxWeekly = document.getElementById('chart-bars-weekly').getContext('2d');
        new Chart(ctxWeekly, {
            type: 'bar',
            data: {
                labels: chartData.weekly_labels, // Days of the week (Monday, Tuesday, ...)
                datasets: [{
                    label: 'Completed Orders (Weekly)',
                    data: chartData.weekly_data, // Weekly data (total orders)
                    backgroundColor: '#ffffff80',
                    borderColor: '#ffffff',
                    borderWidth: 1,
                    tension: 0.4, // Smooth curves (if applicable for bar charts)
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: {
                            color: 'white',
                            font: {
                                weight: 'bold',
                                size: '17px'
                            }
                        }
                    },
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        ticks: {
                            color: 'white',
                            font: {
                                weight: 'bold'
                            }
                        },
                    },
                    y: {
                        beginAtZero: true,
                        ticks: {
                            color: 'white',
                            font: {
                                weight: 'bold'
                            }
                        },
                    }
                }
            }
        });

    }

    // Initialize the chart
    renderChart();
</script>

<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{ asset('assets/vendor/js/material-dashboard.min.js?v=3.0.0') }}"></script>
