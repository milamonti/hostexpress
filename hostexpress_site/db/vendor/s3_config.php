<?php
require 'vendor/autoload.php';

use Aws\S3\S3Client;

$s3 = new S3Client([
    'version' => 'latest',
    'region'  => 'us-east-1', // Altere para sua região
    'credentials' => [
        'key'    => 'SEU_ACCESS_KEY',
        'secret' => 'SEU_SECRET_KEY',
    ],
]);

?>