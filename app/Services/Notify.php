<?php

namespace App\Services;

class Notify
{
    // Created Notification
    public static function createdNotification()
    {
        return notyf()->addSuccess('Created Successfully', '👍 Success !');
    }

    public static function updatedNotification()
    {
        return notyf()->addSuccess('Updated Successfully', '👍 Success !');
    }

    public static function deletedNotification()
    {
        return notyf()->addSuccess('Deleted Successfully', '👍 Success !');
    }

    public static function errorNotification(string $error)
    {
        return notyf()->addError($error, '🚫 Error !');
    }
}
