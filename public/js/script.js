function doughnutChart() {

    let doughnutChart = document.getElementById('doughnutChart')

    new Chart(doughnutChart, {
        "type": "doughnut",
        "data": {
            "labels": ["Giải quyết vấn đề", "Làm việc nhóm", "Giáo tiếp", "Trách nhiệm", "Ra quyết định", "lãnh đạo", "Lập kế hoạch"],
            "datasets": [{
                "label": "My First Dataset",
                // thang điểm = 5
                "data": [5, 3, 4, 4, 3, 2, 5],
                "backgroundColor": ["rgb(255, 99, 132)", "rgb(255, 159, 64)", "rgb(255, 205, 86)", "rgb(75, 192, 192)", "rgb(54, 162, 235)", "rgb(153, 102, 255)", "rgb(201, 203, 207)"]
            }]
        }
    });
}

function doughnutChartUser() {

    let doughnutChartUser = document.getElementById('doughnutChartUser')

    new Chart(doughnutChartUser, {
        "type": "pie",
        "data": {
            "labels": ["Công việc hoàn thành", "Công việc chưa hoàn thành"],
            "datasets": [{
                "label": "Biểu đồ đánh giá tiến độ công việc",
                // thang điểm = 5
                "data": [70, 30],
                "backgroundColor": ["rgb(255, 99, 132)", "rgb(255, 159, 64)"]
            }]
        }
    });
}

function lineChart() {

    let lineChart = document.getElementById('lineChart')

    new Chart(lineChart, {
        type: 'radar',
        data: {
            labels: ["Quán lý", "Drinking", "Sleeping", "Designing", "Coding", "Cycling", "Running"],
            datasets: [
                {
                    "label": "My First Dataset",
                    "data": [65, 59, 90, 81, 56, 55, 40],
                    "fill": true,
                    "backgroundColor": "rgba(255, 99, 132, 0.2)",
                    "borderColor": "rgb(255, 99, 132)",
                    "pointBackgroundColor": "rgb(255, 99, 132)",
                    "pointBorderColor": "#fff",
                    "pointHoverBackgroundColor": "#fff",
                    "pointHoverBorderColor": "rgb(255, 99, 132)"
                },
                {
                    "label": "My Second Dataset",
                    "data": [28, 48, 40, 19, 96, 27, 100],
                    "fill": true,
                    "backgroundColor": "rgba(54, 162, 235, 0.2)",
                    "borderColor": "rgb(54, 162, 235)",
                    "pointBackgroundColor": "rgb(54, 162, 235)",
                    "pointBorderColor": "#fff",
                    "pointHoverBackgroundColor": "#fff",
                    "pointHoverBorderColor": "rgb(54, 162, 235)"
                }
            ]
        },
        options: {
            responsive: true,
            legend: {
                position: 'top',
            },
            title: {
                display: true,
                // text: 'Chart.js Doughnut Chart'
            },
            animation: {
                animateScale: true,
                animateRotate: true
            }
        }
    });
}
