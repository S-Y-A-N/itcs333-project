<?php

authorize(isset($_SESSION['email']) && $_SESSION['admin'] === 0);

use Core\Database;

$config = require base_path('config.php');
$db = new Database($config['database']);

$room_id = (int) $_GET['id'];

$roomQuery = $db->query('SELECT * FROM rooms WHERE room_id = :id', [
  'id' => $room_id
]);

$room = $roomQuery->fetch();

// decide on room image
$room['img'] = "{$room['dept']}-{$room['type']}.jpeg";


if (file_exists(base_path("rooms_images/$room_id.jpeg"))) {
  $room['img'] = "$room_id.jpeg";
}

else {

  $files = scandir(base_path("rooms_images"));

  foreach ($files as $file) {
    if (strpos($file, $room_id) !== false) {
      $room['img'] = $file;
    }
  }

}

dump($room['img']);
copy(base_path("rooms_images/{$room['img']}"), base_path("public/{$room['img']}"));

// get image width, if width > 1500 it's a panorama image
$room['img_width'] = getimagesize($room['img'])[0];

view("rooms/show.view.php", [
  'h1' => "S40-{$room_id}",
  'p' => "Room Details",
  'room' => $room,
  'errors' => $errors ?? []
]);