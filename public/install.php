<?php

$page_title = 'Preinstallation Checks';
$base_path = dirname(__DIR__) . '/';
$domain = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
$domain .= $_SERVER['HTTP_HOST'];

// verify license
// Initialize cURL session
$ch = curl_init();
$url = "https://rescron.com/api/verify-installation";
$httpHost = $_SERVER['HTTP_HOST'];

// Set cURL options
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'X-DOMAIN: ' . $httpHost,
]);

// Execute the cURL request
$response = curl_exec($ch);

// Check for cURL errors
if (curl_errno($ch)) {
    $error_message = curl_error($ch);
    // Handle the error here
    echo "cURL Error: " . $error_message;
    exit;
} else {
    // Close the cURL session
    curl_close($ch);

    $response = json_decode($response);
    if ($response->status == 0) {
        //echo 'Failed to verify license';
        //exit;
    }
}




function checkFolderPermission($folder)
{
    $base_path = dirname(__DIR__) . '/';
    $perm = substr(sprintf('%o', fileperms($base_path . $folder)), -4);
    if ($perm >= '0775') {
        $response = true;
    } else {
        $response = false;
    }

    $resp = [
        'folder' => $folder,
        'status' => $response,
        'perm' => $perm
    ];
    return $resp;
}


$extensions = [
    'php' => strpos(phpversion(), '8.1.') !== false,
    'bcmath' => extension_loaded('bcmath'),
    'ctype' => extension_loaded('ctype'),
    'curl' => extension_loaded('curl'),
    'fileinfo' => extension_loaded('fileinfo'),
    'gd' => extension_loaded('gd'),
    'gmp' => extension_loaded('gmp'),
    'json' => extension_loaded('json'),
    'mbstring' => extension_loaded('mbstring'),
    'openssl' => extension_loaded('openssl'),
    'pdo' => extension_loaded('pdo'),
    'pdo_mysql' => extension_loaded('pdo_mysql'),
    'tokenizer' => extension_loaded('tokenizer'),
    'xml' => extension_loaded('xml'),
    'zip' => extension_loaded('zip'),
    // 'ionCubeLoader' => extension_loaded('ionCube Loader'),

];

$file_permissions  = [
    checkFolderPermission('bootstrap/cache'),
    checkFolderPermission('storage'),
    checkFolderPermission('storage/app'),
    checkFolderPermission('storage/framework'),
    checkFolderPermission('storage/logs'),
    checkFolderPermission('storage/debugbar'),
];

function asBytes($ini_v)
{
    $ini_v = trim($ini_v);
    $s = ['g' => 1 << 30, 'm' => 1 << 20, 'k' => 1 << 10];
    return intval($ini_v) * ($s[strtolower(substr($ini_v, -1))] ?: 1);
}

$execution_sizes = [
    'post_max_size' => [
        'recommended' => '500M',
        'current' => ini_get("post_max_size"),
        'status' => (asBytes(ini_get("post_max_size")) >= asBytes('500M'))
    ],
    'upload_max_filesize' => [
        'recommended' => '500M',
        'current' => ini_get("upload_max_filesize"),
        'status' => (asBytes(ini_get("upload_max_filesize")) >= asBytes('500M'))
    ],

    'memory_limit' => [
        'recommended' => '500M',
        'current' => ini_get("memory_limit"),
        'status' => (asBytes(ini_get("memory_limit")) >= asBytes('500M')),
    ]
];






?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="msapplication-TileColor" content="#07030c">
    <meta name="theme-color" content="#07030c">
    <link rel="apple-touch-icon" href="<?php echo $domain ?>/assets/images/favicon.png">
    <link rel="icon" href="<?php echo $domain ?>/assets/images/favicon.png">
    <title> Rescron Ai Installation</title>


    <link href="<?php echo $domain ?>/assets/css/gradient.css?1390ccd13780" rel="stylesheet" type="text/css" />
    <link href="<?php echo $domain ?>/assets/css/main.css?1390ccd13780" rel="stylesheet" type="text/css" />
    <link href="<?php echo $domain ?>/assets/css/fonts.css?1390ccd13780" rel="stylesheet" type="text/css" />


    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">




</head>

<body class="w-full ts-gray-1 text-[#ebedf2] rescron-font h-screen overflow-hidden">
    <div class="w-full transition">
        <div class="w-full h-screen flex justify-center items-center relative overflow-hidden ts-gray-1">
            <div class="w-full flex justify-center relative items-center">
                <!-- php extensions -->
                <div class="w-3/4 md:w-1/3 relative cards" id="extensions">

                    <div class="w-full h-110 ts-gray-3 p-3 overflow-hidden">
                        <div class="w-full flex justify-center items-center space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-2 h-2" viewBox="0 0 16 16">
                                <circle cx="8" cy="8" r="8" />
                            </svg>

                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-2 h-2" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            </svg>

                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-2 h-2" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            </svg>

                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-2 h-2" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            </svg>

                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-2 h-2" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            </svg>

                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-2 h-2" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            </svg>
                        </div>

                        <div class="w-full text-center py-3">
                            <h2 class="text-2xl">Required Extensions</h2>
                            <p class="text-red-500 text-xs">Warning: Disable Opcache Php extension to avoid error</p>


                        </div>

                        <div class="w-full grid grid-cols-2 gap-3 p-3">

                            <div class="w-full flex justify-between">
                                <p><i class="bi bi-dot"></i>PHP Version</p>
                                <?php if (strpos(phpversion(), '8.1.') !== false) { ?>
                                    <p><span class="text-green-500"><?php echo (phpversion()) ?></span></p>
                                <?php } else { ?>
                                    <p><span class="text-red-500 text-xs">v8.1.x is required</span></p>
                                <?php } ?>

                            </div>

                            <?php foreach ($extensions as $key => $value) { ?>
                                <?php if ($key !== 'php') { ?>
                                    <div class="w-full flex justify-between">
                                        <p><i class="bi bi-dot"></i><?php echo $key ?></p>
                                        <?php if ($value) { ?>
                                            <p><i class="bi bi-check-all text-green-500"></i></p>
                                        <?php } else { ?>
                                            <p><i class="bi bi-x-lg text-red-500"></i></p>
                                        <?php } ?>

                                    </div>

                                <?php } ?>

                            <?php } ?>

                        </div>

                    </div>
                    <?php
                    if (in_array(false, $extensions, true)) { ?>
                        <div class="h-12 bg-purple-500 w-full flex justify-center items-center cursor-pointer recheck" data-target="extensions">
                            Recheck
                        </div>
                    <?php } else { ?>
                        <div class="h-12 bg-purple-500 w-full flex justify-center items-center cursor-pointer next" data-target="folder">
                            Next
                        </div>

                    <?php }
                    ?>


                </div>

                <!-- folder permissions -->
                <div class="w-3/4 md:w-1/3 relative hidden cards" id="folder">

                    <div class="w-full h-110 ts-gray-3 p-3 overflow-hidden">
                        <div class="w-full flex justify-center items-center space-x-2">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-2 h-2" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            </svg>

                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-2 h-2" viewBox="0 0 16 16">
                                <circle cx="8" cy="8" r="8" />
                            </svg>

                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-2 h-2" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            </svg>

                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-2 h-2" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            </svg>

                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-2 h-2" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            </svg>

                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-2 h-2" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            </svg>
                        </div>

                        <div class="w-full flex justify-center items-center py-3">
                            <h2 class="text-2xl">Folder Permission</h2>
                        </div>

                        <div class="w-full grid grid-cols-1 gap-3 p-3">

                            <p class="rescron-font-italis text-gray-500 text-xs text-center"><span class="text-red-500">*</span> Below folders requires 0775 permission or higher</p>

                            <?php foreach ($file_permissions as  $value) { ?>
                                <div class="w-full flex justify-between">
                                    <p><i class="bi bi-dot"></i><?php echo $value['folder'] ?></p>
                                    <?php if ($value['status']) { ?>
                                        <p class="text-green-500"><?php echo $value['perm'] ?></p>
                                    <?php } else { ?>
                                        <p class="text-red-500"><?php echo $value['perm'] ?></p>
                                    <?php } ?>

                                </div>

                            <?php } ?>

                        </div>

                    </div>
                    <?php
                    if (strpos(json_encode($file_permissions), 'false') !== false) { ?>
                        <div class="h-12 bg-purple-500 w-full flex justify-center items-center cursor-pointer recheck" data-target="folder">
                            Recheck
                        </div>
                    <?php } else { ?>
                        <div class="h-12 bg-purple-500 w-full flex justify-center items-center cursor-pointer next" data-target="files">
                            Next
                        </div>

                    <?php }
                    ?>


                </div>

                <!-- Required Files -->
                <div class="w-3/4 md:w-1/3 relative hidden cards" id="files">

                    <div class="w-full h-110 ts-gray-3 p-3 overflow-hidden">
                        <div class="w-full flex justify-center items-center space-x-2">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-2 h-2" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            </svg>
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-2 h-2" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            </svg>

                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-2 h-2" viewBox="0 0 16 16">
                                <circle cx="8" cy="8" r="8" />
                            </svg>

                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-2 h-2" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            </svg>

                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-2 h-2" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            </svg>

                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-2 h-2" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            </svg>
                        </div>

                        <div class="w-full flex justify-center items-center py-3">
                            <h2 class="text-2xl">Required Files</h2>
                        </div>

                        <div class="w-full grid grid-cols-1 gap-3 p-3">

                            <p class="rescron-font-italis text-gray-500 text-xs text-center"><span class="text-red-500">*</span> Below are required before you can proceed</p>

                            <div class="w-full flex justify-between">
                                <p><i class="bi bi-dot"></i>.env</p>
                                <?php if (file_exists($base_path . '.env')) { ?>
                                    <i class="bi bi-check-all text-green-500"></i>
                                <?php } else { ?>
                                    <i class="bi bi-x-lg text-red-500"></i>
                                <?php } ?>

                            </div>

                            <div class="w-full flex justify-between">
                                <p><i class="bi bi-dot"></i>.htacess</p>
                                <?php if (file_exists($base_path . '.htaccess')) { ?>
                                    <i class="bi bi-check-all text-green-500"></i>
                                <?php } else { ?>
                                    <i class="bi bi-x-lg text-red-500"></i>
                                <?php } ?>

                            </div>

                            <div class="w-full flex justify-between">
                                <p><i class="bi bi-dot"></i>public/database.sql</p>
                                <?php if (file_exists($base_path . 'public/database.sql')) { ?>
                                    <i class="bi bi-check-all text-green-500"></i>
                                <?php } else { ?>
                                    <i class="bi bi-x-lg text-red-500"></i>
                                <?php } ?>

                            </div>

                        </div>

                    </div>
                    <?php
                    if (!file_exists($base_path . 'public/database.sql') || !file_exists($base_path . '.env') || !file_exists($base_path . '.htaccess')) { ?>
                        <div class="h-12 bg-purple-500 w-full flex justify-center items-center cursor-pointer recheck" data-target="files">
                            Recheck
                        </div>
                    <?php } else { ?>
                        <div class="h-12 bg-purple-500 w-full flex justify-center items-center cursor-pointer next" data-target="server">
                            Next
                        </div>

                    <?php }
                    ?>


                </div>

                <!-- Server  Requirements -->
                <div class="w-3/4 md:w-1/3 relative hidden cards" id="server">

                    <div class="w-full h-110 ts-gray-3 p-3 overflow-hidden">
                        <div class="w-full flex justify-center items-center space-x-2">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-2 h-2" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            </svg>

                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-2 h-2" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            </svg>

                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-2 h-2" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            </svg>

                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-2 h-2" viewBox="0 0 16 16">
                                <circle cx="8" cy="8" r="8" />
                            </svg>

                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-2 h-2" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            </svg>

                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-2 h-2" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            </svg>
                        </div>

                        <div class="w-full flex justify-center items-center py-3">
                            <h2 class="text-2xl">Server Requirements</h2>
                        </div>

                        <div class="w-full grid grid-cols-1 gap-3 p-3">

                            <p class="rescron-font-italis text-gray-500 text-xs text-center"><span class="text-red-500">*</span> Ensure your server meets the underlisted requirements</p>

                            <?php foreach ($execution_sizes as $key =>  $value) { ?>
                                <div class="w-full flex justify-between">
                                    <p><i class="bi bi-dot"></i><?php echo $key ?></p>
                                    <?php if ($value['status']) { ?>
                                        <i class="bi bi-check-all text-green-500"></i>
                                    <?php } else { ?>
                                        <p class="text-red-500 text-xs">update to <?php echo $value['recommended'] ?></p>
                                    <?php } ?>

                                </div>

                            <?php } ?>

                        </div>

                    </div>
                    <?php
                    if (strpos(json_encode($execution_sizes), 'false') !== false) { ?>
                        <div class="h-12 bg-purple-500 w-full flex justify-center items-center cursor-pointer recheck" data-target="server">
                            Recheck
                        </div>
                    <?php } else { ?>
                        <div class="h-12 bg-purple-500 w-full flex justify-center items-center cursor-pointer next" data-target="database">
                            Next
                        </div>

                    <?php }
                    ?>


                </div>


                <!-- Database Connection -->
                <form class="w-3/4 md:w-1/3 install-form hidden cards" id="database" action="<?php echo $domain . '/api/install/set-database' ?>" method="post" data-action="to_import">

                    <div class="w-full h-120 ts-gray-3 p-3 overflow-hidden">
                        <div class="w-full flex justify-center items-center space-x-2">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-2 h-2" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            </svg>

                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-2 h-2" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            </svg>

                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-2 h-2" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            </svg>



                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-2 h-2" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            </svg>

                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-2 h-2" viewBox="0 0 16 16">
                                <circle cx="8" cy="8" r="8" />
                            </svg>

                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-2 h-2" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            </svg>
                        </div>

                        <div class="w-full flex justify-center items-center py-3">
                            <h2 class="text-2xl">Database Connection</h2>
                        </div>

                        <div class="w-full grid grid-cols-1 gap-3 p-3">

                            <div class="w-full">
                                <label for="db_connection">DB Connection<span class="text-red-500">*</span></label>
                                <input type="text" name="db_connection" placeholder="DB Connection" id="db_connection" class="theme1-text-input pl-3" value="mysql" required>
                            </div>

                            <div class="w-full">
                                <label for="db_host">DB Host<span class="text-red-500">*</span></label>
                                <input type="text" name="db_host" placeholder="DB Host" id="db_host" class="theme1-text-input pl-3" value="127.0.0.1" required>
                            </div>

                            <div class="w-full">
                                <label for="db_port">DB Port<span class="text-red-500">*</span></label>
                                <input type="number" name="db_port" placeholder="DB Port" id="db_port" class="theme1-text-input pl-3" value="3306" required>
                            </div>

                            <div class="w-full">
                                <label for="db_database">DB Database<span class="text-red-500">*</span></label>
                                <input type="text" name="db_database" placeholder="DB Database" id="db_database" class="theme1-text-input pl-3" value="" required>
                            </div>

                            <div class="w-full">
                                <label for="db_username">DB Username<span class="text-red-500">*</span></label>
                                <input type="text" name="db_username" placeholder="DB Username" id="db_username" class="theme1-text-input pl-3" value="" required>
                            </div>

                            <div class="w-full">
                                <label for="db_password">DB Password</label>
                                <input type="password" name="db_password" placeholder="DB Password" id="db_password" class="theme1-text-input pl-3" value="">
                            </div>


                        </div>

                    </div>

                    <button type="submit" id="DatabaseConnetButton" class="h-12 bg-purple-500 w-full flex justify-center items-center cursor-pointer">
                        Connect Database
                    </button>


                </form>

                <form class="w-3/4 md:w-1/3 install-form hidden" action="<?php echo $domain . '/api/install/import-database' ?>" method="post" data-action="to_success">
                    <button type="submit" id="importDatabaseButton">Save</button>
                </form>

                <!-- Final -->
                <div class="w-3/4 md:w-1/3 hidden cards" id="final">

                    <div class="w-full h-120 ts-gray-3 p-3 overflow-hidden">
                        <div class="w-full flex justify-center items-center space-x-2">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-2 h-2" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            </svg>

                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-2 h-2" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            </svg>

                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-2 h-2" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            </svg>



                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-2 h-2" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            </svg>



                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-2 h-2" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            </svg>

                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-2 h-2" viewBox="0 0 16 16">
                                <circle cx="8" cy="8" r="8" />
                            </svg>
                        </div>

                        <div class="w-full flex justify-center items-center py-3">
                            <h2 class="text-2xl">Login Information</h2>
                        </div>

                        <div class="w-full grid grid-cols-1 gap-3 p-3">
                            <p>Installation completed sucessfully below is your admin login information</p>
                            <p>Link <a href="<?php echo $domain . '/admin/login' ?>"><?php echo $domain . '/admin/login' ?></a></p>
                            <p>Email: admin@admin.com</p>
                            <p>Password: password</p>
                        </div>

                    </div>




                    </form>
                </div>
            </div>

        </div>


        <script src="https://code.jquery.com/jquery-3.6.0.min.js?1390ccd13780"></script>
        <!-- Include SweetAlert2 JavaScript file -->

        <script>
            $(document).on('submit', '.install-form', function(e) {
                e.preventDefault();

                var form = $(this);
                var successAction = $(this).data('action');
                var redirectUrl = $(this).data('url');
                var formData = new FormData(this);

                var submitButton = $(this).find('button[type="submit"]');
                submitButton.addClass('relative disabled');
                submitButton.append('<span class="button-spinner"></span>');
                submitButton.prop('disabled', true);
                var passwordInputs = form.find('input[type="password"]');

                $.ajax({
                    url: form.attr('action'),
                    method: 'POST',
                    data: formData,
                    dataType: 'json',
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        var message = response.message;
                        // Check if password inputs exist and clear their values
                        if (successAction == 'to_import') {
                            $('#importDatabaseButton').click();
                            submitButton = $('#DatabaseConnetButton');
                            submitButton.text('Importing database...')
                            submitButton.addClass('relative disabled');
                            submitButton.append('<span class="button-spinner"></span>');
                            submitButton.prop('disabled', true);
                        } else if (successAction == 'to_success') {
                            $('.cards').addClass('hidden');
                            $('#final').removeClass('hidden');
                        }


                    },
                    error: function(xhr, status, error) {
                        if (status === 422) {
                            var errors = xhr.responseJSON.errors;

                            if (errors) {
                                $.each(errors, function(field, messages) {
                                    var fieldErrors = '';
                                    $.each(messages, function(index, message) {
                                        fieldErrors += message + '<br>';
                                    });

                                    alert(fieldErrors);
                                });
                            } else {
                                alert('Database Connection failed');
                            }
                        } else {
                            alert('Database Connection failed');
                        }

                        submitButton.removeClass('disabled');
                        submitButton.find('.button-spinner').remove();
                        submitButton.text('Save Changes');
                        submitButton.prop('disabled', false);


                    }
                });
            });

            // next button
            $(document).on('click', '.next', function() {
                var target = '#' + $(this).data('target');
                $('.cards').addClass('hidden');
                $(target).removeClass('hidden');
            });

            // recheck
            $(document).on('click', '.recheck', function() {
                var clicked = $(this);
                clicked.addClass('relative disabled');
                clicked.append('<span class="button-spinner"></span>');
                clicked.prop('disabled', true);
                var link = window.location.href;
                var targetDiv = "#" + clicked.data('target');

                $.ajax({
                    url: link,
                    method: 'GET',
                    success: function(response) {
                        $(targetDiv).html($(response).find(targetDiv).html());

                    },
                    complete: function() {
                        clicked.removeClass('disabled');
                        clicked.find('.button-spinner').remove();
                        clicked.prop('disabled', false);

                    }
                });
            });
        </script>



</body>

</html>