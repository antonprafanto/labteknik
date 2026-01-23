<?php
$url = 'https://upload.wikimedia.org/wikipedia/commons/e/e6/Logo_Universitas_Mulawarman.png';
$file = 'public/logo.png';
$options = [
    'ssl' => [
        'verify_peer' => false,
        'verify_peer_name' => false,
    ],
    'http' => [
        'header' => "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64)\r\n"
    ]
];
$context = stream_context_create($options);
if (copy($url, $file, $context)) {
    echo "Logo successfully downloaded to $file\n";
} else {
    echo "Failed to download logo\n";
}
?>
