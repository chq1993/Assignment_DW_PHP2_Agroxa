<?php

namespace App\Facade;

class Helper
{
    public static $groupWorks = [
        "Giải quyết vấn đề",
        "Làm việc nhóm",
        "Giao tiếp",
        "Trách nhiệm",
        "Ra quyết định",
        "Lãnh đạo",
        "Lập kế hoạch"
    ];
    public static $groupRequests = ["Không bắt buộc", "Bắt buộc"];

    public static $groupTypeQuestion = ["Nhập", "Lựa chọn"];

   
    public static function groupWorks()
    {
        return self::$groupWorks;
    }

    public static function groupRequests()
    {
        return self::$groupRequests;
    }

    public static function groupTypeQuestion()
    {
        return self::$groupTypeQuestion;
    }
}
