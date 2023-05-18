<?php
function Get_Files()
{

    $dir = "pending";
    $init = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));

    $files = array();

    foreach ($init as $file) {
        if ($file->isDir()) {
            continue;
        }
        if (str_contains($file, ".php")) {
            $files[] = $file->getPathname();
        }
    }

    return $files;
}

echo "<h1>Unprocessed Quotes</h1>";

foreach (Get_Files() as $file) {
    $data = file_get_contents($file);
    $testing = json_decode($data, true);
    echo "<tr>";
    echo "<a href=\"$file\">$file</a>";
    echo "<br>";
}