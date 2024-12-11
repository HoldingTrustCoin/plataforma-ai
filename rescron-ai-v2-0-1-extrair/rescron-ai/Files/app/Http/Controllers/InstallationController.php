<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class InstallationController extends Controller
{
    //set database
    public function setDatabase(Request $request)
    {
        if (!file_exists(public_path('install.php'))) {
            abort(404);
        }
        $request->validate([
            'db_connection' => 'required',
            'db_host' => 'required',
            'db_port' => 'required',
            'db_database' => 'required',
            'db_username' => 'required',
            // 'db_password' => 'required' 
        ]);

        // Attempt to connect to the database
        $connection = @mysqli_connect($request->db_host, $request->db_username, $request->db_password, $request->db_database, $request->db_port);

        

        if (!$connection) {
            return response()->json(validationError(mysqli_connect_error()), 422);
        }


        $db_set = [
            'DB_CONNECTION' => $request->db_connection,
            'DB_HOST' => $request->db_host,
            'DB_PORT' => $request->db_port,
            'DB_DATABASE' => $request->db_database,
            'DB_USERNAME' => $request->db_username,
            'DB_PASSWORD' => $request->db_password,

        ];

        foreach ($db_set as $key => $value) {
            updateEnvValue($key, $value);
        }

        return response()->json(['message' => 'Connected Successfully']);
    }


    // import database
    public function importDatabase(Request $request)
    {
        if (!file_exists(public_path('install.php'))) {
            abort(404);
        }
        // re-wipe incase of a botched import
        //try wiping database
        if (Artisan::call('db:wipe') !== 0) {
            return response()->json(validationError('Check database credentials'), 422);
        }
        $path = public_path('database.sql');
        $import = DB::unprepared(file_get_contents($path));

        //check if table exists after importing: This is to abort the installatio process if database import failed
        if (!Schema::hasTable('withdrawals')) {
            return response()->json(validationError('Database could not be imported'), 422);
        }

        // run migration for future tables
        Artisan::call('migrate');

        // do some cleaning
        //delete install.php
        File::delete(public_path('install.php'));


        // delete link
        if (File::isDirectory(public_path('storage'))) {
            File::deleteDirectory(public_path('storage'));
        }

        // create symlink
        Artisan::call('storage:link');

        // create folder
        $folders = [
            'profile',
            'kyc',
            'bots',
        ];

        foreach($folders as $folder) {
            File::copyDirectory(storage_path('profiles'), storage_path('app/public/' . $folder));
            File::chmod(storage_path('app/public/' . $folder), 0775);
        }
        

        // clear caches
        Artisan::call('optimize:clear');


        // update environment
        $envs = [
            'APP_DEBUG' => 'false',
            'LOG_LEVEL' => "debug",
            'APP_URL' => url('/'),
            'DEMO_MODE' => 'false'
        ];

        foreach ($envs as $key => $value) {
            updateEnvValue($key, $value);
        }

        // truncate admin table first
        Admin::truncate();
        // update the admin login
        $admin = new  Admin();
        $admin->email = 'admin@admin.com';
        $admin->name = 'Admin';
        $admin->password = Hash::make('password');
        $admin->save();

        // regenerate key 
        Artisan::call('key:generate');
        return response()->json(['message' => 'Database Imported Successfully']);
    }
}
