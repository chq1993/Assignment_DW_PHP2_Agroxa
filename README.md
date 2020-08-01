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

    
