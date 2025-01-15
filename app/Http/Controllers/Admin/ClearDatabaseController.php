<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\View\View;
use Illuminate\Support\Facades\File;

class ClearDatabaseController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:database clear']);
    }

    public function index(): View
    {
        return view('admin.clear-database.index');
    }

    public function clearDatabase()
    {
        try {
            // Wipe database
            Artisan::call('migrate:fresh');

            // Seed default data
            Artisan::call('db:seed', ['--class' => 'AdminSeeder']);
            Artisan::call('db:seed', ['--class' => 'SiteSettingSeeder']);
            Artisan::call('db:seed', ['--class' => 'MenuSeeder']);

            // Delete files
            $this->deleteFiles();

            return response(['message' => 'Database wiped successfully! 💥']);
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function deleteFiles(): void
    {
        $path = public_path('uploads');
        $allFiles = File::allFiles($path);
        foreach ($allFiles as $file) {
            $filename = $file->getFilename();
            File::delete($filename);
        }
    }
}
