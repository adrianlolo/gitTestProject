<?php

include('exportDoPliku.php');

$downloadFileName = $filename;

if (file_exists($filename)) {
    header('Content-Description: File Transfer');
    header('Content-Type: text/sql');
    header('Content-Disposition: attachment; filename='.$downloadFileName);
    ob_clean();
    flush();
    readfile($filename);
}
exit();