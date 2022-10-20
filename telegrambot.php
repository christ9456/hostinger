<?php
  $apiToken = "5392261192:AAFQnzRzOdibA60rvF8V7yyJf5-fIMzhZ0Q";
  $data = [
      'chat_id' => '5584940724',
      'text' => 'Hello from PHP!'
  ];
  $response = file_get_contents("https://api.telegram.org/bot$apiToken/sendMessage?" .
                                 http_build_query($data) );
?>
