<?php
$filePath = 'cvcjkcuuzrx.zip';

$za = new ZipArchive();
if ($za->open($filePath) !== true) { // check for the zip archive
    echo "archive doesn't exist or it's on Read-only mode ";
} else {

    $Tree = $pathArray = array(); //empty arrays

    for ($i = 0; $i < $za->numFiles; $i++) {

        $path = $za->getNameIndex($i);
        $pathBySlash = array_values(explode('/', $path));
        $c = count($pathBySlash);

        $temp = &$Tree;
        for ($j = 0; $j < $c - 1; $j++)
            if (isset($temp[$pathBySlash[$j]]))
                $temp = &$temp[$pathBySlash[$j]];
            else {
                $temp[$pathBySlash[$j]] = array();
                $temp = &$temp[$pathBySlash[$j]];
            }
        if (substr($path, -1) == '/')
            $temp[$pathBySlash[$c - 1]] = array();
        else
            $temp[] = $pathBySlash[$c - 1];
    }

    $array = $Tree;

    // First style of Displaying 
    echo "<pre>";
    print_r($c);

    }

    echo "</pre>";
