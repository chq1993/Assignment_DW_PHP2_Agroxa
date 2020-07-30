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

    /**
     * 
     * @return array
     */
    public static function groupWorks()
    {
        return self::$groupWorks;
    }

    /**
     * 
     * @return array
     */
    public static function groupRequests()
    {
        return self::$groupRequests;
    }
}
