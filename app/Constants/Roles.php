<?php
namespace App\Constants;
class Roles {
    public const ADMIN = 1;
    public const USER = 2;
    public const EDITOR = 3;

    public static function roles(): array
    {
        return [
            self::ADMIN => "Admin",
            self::USER => "USER",
            self::EDITOR => "EDITOR"
        ];
    }

}
