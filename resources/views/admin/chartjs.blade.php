<div class="chart-container" style="height:300px; width:580px; display:flex; margin-bottom: 50px">
    <canvas id="users-chart" style="margin-right: 10px"></canvas>
    <canvas id="tags-chart"></canvas>
</div>
<div class="chart-container" style="height:300px; width:580px; display:flex;">
    <canvas id="er-chart" style="margin-right: 10px"></canvas>
    <canvas id="question-chart"></canvas>
</div>
<script>
    $(function () {
        var ctx = document.getElementById("users-chart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($userLabels),
                datasets: [{
                    label: 'users',
                    data: @json($userData),
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                },
                title: {
                    display: true,
                    text: 'so luong user tang len 7 ngay gan nhat'
                }
            }
        });
    });
</script>
<script>
    $(function () {
        var ctx = document.getElementById("tags-chart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: @json($tagLabels),
                datasets: [{
                    label: 'My First Dataset',
                    data: @json($tagData),
                    backgroundColor: [
                        'rgb(255, 99, 132)',
                        'rgb(54, 162, 235)',
                        'rgb(255, 205, 86)',
                        '#8ddae8',
                        '#063970',
                        '#873e23',
                        '#1c100b',
                        'green',
                    ],
                    hoverOffset: 4
                }]
            },
            options: {
                title: {
                    display: true,
                    text: 'Tags Chart'
                }
            }
        });
    });
</script>
<script>
    $(function () {
        var ctx = document.getElementById("er-chart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: @json($userLabels),
                datasets: [{
                    label: 'engagement rate (%)',
                    fill: false,
                    data: @json($erData),
                    // backgroundColor: [
                    //     'rgba(75, 192, 192, 0.2)'
                    // ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                },
                title: {
                    display: true,
                    text: 'Engagement Chart'
                }
            }
        });
    });
</script>
<script>
    $(function () {
        var ctx = document.getElementById("question-chart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($userLabels),
                datasets: [
                    {
                        label: 'tongTonDong',
                        data: @json($tongTonDong),
                        backgroundColor: [
                            '#9CD0F5',
                            '#9CD0F5',
                            '#9CD0F5',
                            '#9CD0F5',
                            '#9CD0F5',
                            '#9CD0F5',
                            '#9CD0F5',
                        ],
                        borderColor: [
                            '#36A2EC',
                            '#36A2EC',
                            '#36A2EC',
                            '#36A2EC',
                            '#36A2EC',
                            '#36A2EC',
                            '#36A2EC',
                        ],
                        borderWidth: 1
                    },
                    {
                        label: 'tongCauHoiGiaiQuyetTrongNgay',
                        data: @json($tongCauHoiGiaiQuyetTrongNgay),
                        backgroundColor: [
                            '#FEE7AC',
                            '#FEE7AC',
                            '#FEE7AC',
                            '#FEE7AC',
                            '#FEE7AC',
                            '#FEE7AC',
                            '#FEE7AC',
                        ],
                        borderColor: [
                            '#FFCD57',
                            '#FFCD57',
                            '#FFCD57',
                            '#FFCD57',
                            '#FFCD57',
                            '#FFCD57',
                            '#FFCD57',
                        ],
                        borderWidth: 1
                    }
                ]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero:true
                        }
                    }]
                },
                title: {
                    display: true,
                    text: 'Engagement Chart'
                }
            }
        });
    });
</script>
