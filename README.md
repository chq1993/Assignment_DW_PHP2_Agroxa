<p align="center"><img src="https://res.cloudinary.com/dtfbvvkyp/image/upload/v1566331377/laravel-logolockup-cmyk-red.svg" width="400"></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
</p>

## Lưu ý Team khi chạy project

Sau khi pull code từ master về, luôn chạy các lệnh sau để chánh gặp lỗi thiếu thư viện:

1. npm install
2. npm run dev
3. composer install
4. php artisan serve

## Về đẩy code lên github
1. Ae nhớ kiểm tra nhánh - nếu đang ở 'master' thì phải tạo 1 nhánh khác và di chuyển sang nhánh đó rồi mới đưa code lên github.
    - cách tạo nhánh: git branch -b "feature/tên-chức-năng"
    - di chuyển sang nhánh khác: git checkout tên-nhánh-vừa-tạo
    - lưu ý: không đặt tên có ký tự & % # @! ?| \ /
2. Thứ tự lệnh đẩy lên github khi đã checkout sang nhánh khác:
    - git status (xem thay đổi)
    - git add .  (đẩy tất cả thay đổi)
    - git commit -m "nội dung đã thay đổi(ngắn gọn)"
    - git pull origin master (lấy code mới nhất từ master về, tránh trường hợp lỗi conflict)
    - git push origin tên-nhánh-đã-tạo

chartjs
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
    
