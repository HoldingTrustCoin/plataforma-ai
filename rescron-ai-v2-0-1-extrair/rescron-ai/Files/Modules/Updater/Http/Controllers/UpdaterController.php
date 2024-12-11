<?php

namespace Modules\Updater\Http\Controllers;

use Illuminate\Support\Facades\File;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
// use ZipArchive;

class UpdaterController extends Controller
{
    //define variables
    private $file_path;
    private $folder_path;

    public function __construct()
    {
        $this->file_path = base_path('update.zip');
        $this->folder_path = base_path();
    }


    // get latest versions
    private function getLatestVersion()
    {
        $url = endpoint('check-update');
        $response = Http::withHeaders(['X-DOMAIN' => domain()])->timeout(5000)->get($url);
        if ($response->status() == 200) {
            $update = $response->json();

            return [
                'version' => $update['version'],
                'logs' => json_decode($update['logs']),
                'date' => $update['date'],
            ];
        }
        return [
            'version' => env('APP_VERSION'),
            'logs' => [],
            'date' => null,
        ];
    }


    public function index()
    {
        $page_title = 'Update';
        $current_version = env('APP_VERSION');
        $update = $this->getLatestVersion();
        $latest_version = $update['version'];
        $current_version_int = (int)str_replace('.', '', $current_version);
        $latest_version_int = (int)str_replace('.', '', $latest_version);

        $should_update = $latest_version_int > $current_version_int;
        return view('updater::index', compact(
            'page_title',
            'should_update',
            'latest_version',
            'current_version',
            'update'
        ));
    }

    // check for update
    public function checkUpdate()
    {
        $current_version = env('APP_VERSION');
        $update = $this->getLatestVersion();
        $latest_version = $update['version'];
        $current_version_int = (int)str_replace('.', '', $current_version);
        $latest_version_int = (int)str_replace('.', '', $latest_version);

        $should_update = $latest_version_int > $current_version_int;

        if (!$should_update) {
            return response()->json(validationError('You have the latest version ' . $latest_version . ' installed'), 422);
        }

        return response()->json(['message' => 'New Version detected. Attempting to download v' .  $latest_version . '...']);
    }

    // download update
    public function downloadUpdate()
    {
        $domain = domain();
        $url = endpoint('download-update');

        $response = Http::withHeaders(['X-DOMAIN' => domain()])->timeout(5000)->get($url);
        if ($response->status() == 200) {
            // Storage::put('updates/update.zip', $response->body());
            File::put($this->file_path, $response->body());

            // change permission
            // File::chmod($this->folder_path, 0775);
            return response()->json(['message' => 'Update downloaded successfully. Attempting to extract...']);
        }
        return response()->json(validationError('Failed to download update'), 422);
    }

    //extract the update
    public function extractUpdate()
    {

        // Check if the zip file exists
        if (file_exists($this->file_path)) {
            // Create a new ZipArchive instance
            $zip = new \ZipArchive;

            // Open the zip file
            if ($zip->open($this->file_path) === TRUE) {
                // Extract the contents to the specified folder
                $zip->extractTo($this->folder_path);

                // Close the zip file
                $zip->close();

                // delete some files first
                File::deleteDirectory(base_path('rescron-ai/Files/Modules/Updater'));
                File::deleteDirectory(base_path('rescron-ai/Files/public/storage'));
                File::delete(base_path('rescron-ai/Files/public/assets/images/cover.png'));
                File::delete(base_path('rescron-ai/Files/public/assets/images/logo_rec.png'));
                File::delete(base_path('rescron-ai/Files/public/assets/images/logo-square.png'));
                File::delete(base_path('rescron-ai/Files/public/install.php'));
                File::delete(base_path('rescron-ai/Files/.env'));
                // copy files
                File::copyDirectory(base_path('rescron-ai/Files'), base_path());

                // set envienment to local
                updateEnvValue('APP_ENV', 'local');
                return response()->json(['message' => 'Update extracted successfully. Atempting to setup...']);
            } else {
                return response()->json(validationError('Failed to extract update'), 422);
            }
        } else {
            return response()->json(validationError('Update zip file not found'), 422);
        }
    }



    // post installation actions
    public function postUpdate(Request $request)
    {
        $latest_version = $request->latest_version;


        // re-run migrations
        Artisan::call('migrate');

        // delete the extracted folder
        File::deleteDirectory(base_path('rescron-ai'));

        // delete the zip
        File::delete(base_path('update.zip'));
        // set the latest version in .env
        updateEnvValue('APP_VERSION', $latest_version);
        // set envienment to local
        updateEnvValue('APP_ENV', 'production');
        // update folder permission
        // clear cache
        Artisan::call('optimize:clear');

        return response()->json(['message' => 'Update Completed']);
    }
}
