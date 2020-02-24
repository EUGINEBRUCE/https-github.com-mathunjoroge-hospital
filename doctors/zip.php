<?php // Get real path for our folder
session_start();
$path=$_GET['zip'];
$patient=$_GET['name'];
$path2="../lab/imageloader/tests/data/";
$rootPath = realpath($path2.$path);

// Initialize archive object
$zip = new ZipArchive();
$zip->open($path.'.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);

// Create recursive directory iterator
/** @var SplFileInfo[] $files */
$files = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($rootPath),
    RecursiveIteratorIterator::LEAVES_ONLY
);

foreach ($files as $name => $file)
{
    // Skip directories (they would be added automatically)
    if (!$file->isDir())
    {
        // Get real and relative path for current file
        $filePath = $file->getRealPath();
        $relativePath = substr($filePath, strlen($rootPath) + 1);

        // Add current file to archive
        $zip->addFile($filePath, $relativePath);
    }
}

// Zip archive will be created only after closing object
$zip->close();
header("location: history.php?search=$patient&response=0")
?>