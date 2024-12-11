<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class BackupController extends Controller
{
    //index
    public function index()
    {
        $page_title = 'Database backups';

        // retrieve files
        $backup_path  = storage_path('app/backups');
        $backups = [];
        if (File::isDirectory($backup_path)) {
            $backups = File::allFiles($backup_path);
        }

        arsort($backups);

        // dd($backups[0]);
        return view('admin.backups.index', compact(
            'page_title',
            'backups'
        ));
    }


    // download backup
    public function downloadBackup(Request $request)
    {
        // check if the file exists
        $file_name = $request->route('file');
        $file_path = storage_path('app/backups/' .  $file_name);
        if (file_exists($file_path)) {
            return response()->download($file_path);
        }

        abort(404);
    }
}
