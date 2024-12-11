<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use App\Models\User; 
use App\Models\CronJob; 

class BackupDatabase extends Command
{
    protected $signature = 'backup:database';
    protected $description = 'Backup the entire database to db-backup.sql';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        
        // Specify the path to the backup file
        $file_name = 'db_bk_' . date('Y_m_d_') . time() . '.sql';
        $backupFilePath = storage_path('app/backups/' . $file_name);
        $backupFolderPath = storage_path('app/backups');

        if (!File::isDirectory($backupFolderPath)) {
            File::copyDirectory(storage_path('profiles'), $backupFolderPath);
            File::chmod($backupFolderPath, 0775);
        }

        // Get the database connection configuration
        $connection = config('database.default');
        $host = config("database.connections.$connection.host");
        $port = config("database.connections.$connection.port");
        $database = config("database.connections.$connection.database");
        $username = config("database.connections.$connection.username");
        $password = config("database.connections.$connection.password");

        // Use mysqldump to backup all tables
        $command = "mysqldump -h $host -P $port -u $username -p$password $database > $backupFilePath";
        exec($command);

        // // prevent database bloating for demo
        // $currentHour = date('G'); 
        // if ($currentHour >= 2 && $currentHour < 4) { 
        //     if (domain() != 'demo.rescron.com' || domain() != 'staging.rescron.com') {
        //         //delete test users //users below 3;
        //         User::where('id', '>', 3)->delete();
                
        //     }
        // }
        

        

        $this->info('Database backup completed and saved');
        return;
    }
}
