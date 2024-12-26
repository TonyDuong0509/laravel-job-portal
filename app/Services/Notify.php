<?php

namespace App\Services;

class Notify
{
    // Created Notification
    public static function createdNotification()
    {
        return notify()->success('Created Successfully', '👍 Success !');
    }

    public static function updatedNotification()
    {
        return notify()->success('Updated Successfully', '👍 Success !');
    }

    public static function deletedNotification()
    {
        return notify()->success('Deleted Successfully', '👍 Success !');
    }
}
