<?php

authorize($_SESSION['admin'] === 1);

use Core\Validator;
use Core\Database;

$config = require base_path('config.php'); 
$db = new Database($config['database']);

$errors = [];

if (Validator::post('add_schedule')) {
  try {

    $room_id = $_POST['room_id'];
    $start_time = date('Y-m-d H:i:s', strtotime($_POST['start_time']));
    $end_time = date('Y-m-d H:i:s', strtotime($_POST['end_time']));

    $hour = date('H', strtotime($start_time));
    
    $time_period = (strtotime($end_time) - strtotime($start_time)) / 3600;

    if ($time_period <= 0) {
        $errors['time'] = "End time must be after the start time";
    }

    else if ($time_period > 2) {
        $errors['time'] = "The timeslot cannot exceed 2 hours";
    }

    else if ($hour < 8 || $hour > 18) {
        $errors['time'] = "Start time should be between 8 AM and 6 PM";
    }

    else {

        // Conflict Checking Algorithm
        $conflict = $db->query("SELECT * FROM bookings WHERE (room_id = :room_id) AND (:start_time < end_time AND :end_time > start_time)", [
            'room_id' => $room_id,
            'start_time' => $start_time,
            'end_time' => $end_time
        ]);

        if ($conflict->rowCount() > 0) {
            $errors['conflict'] = "This timeslot is already booked. Please choose a different time.";
        }
        
        else {

            $db->query("INSERT INTO bookings (email, room_id, start_time, end_time) VALUES (:email, :room_id, :start_time, :end_time)", [
                'email' => $_SESSION['email'],
                'room_id' => $room_id,
                'start_time' => $start_time,
                'end_time' => $end_time
            ]);

            // update room usage
            $usageQuery = $db->query("SELECT * FROM rooms WHERE room_id = :room_id", [
                'room_id' => $room_id
            ]);

            $usage = (int) $usageQuery->fetch()['usage'];
            $usage += 1;


            $db->query("UPDATE rooms SET `usage` = :usage WHERE room_id = :room_id", [
                'room_id' => $room_id,
                'usage' => $usage
            ]);

            $errors['message'] = "Room s40-$room_id booked successfully for the timeslot {$start_time} to {$end_time}.";

          }
      }
  }

  catch (PDOException $e) {

    $errors['error'] = $e->getMessage();
  }
}

if (Validator::post('edit_schedule')) {
  $booking_id = $_POST['schedule_id'];
  $room_id = $_POST['room_id'];

  $start_time = date('Y-m-d H:i:s', strtotime($_POST['start_time']));
  $end_time = date('Y-m-d H:i:s', strtotime($_POST['end_time']));

  $hour = date('H', strtotime($start_time));
    
  $time_period = (strtotime($end_time) - strtotime($start_time)) / 3600;

  if ($time_period <= 0) {
      $errors['edit_error'] = "End time must be after the start time";
  }

  else if ($time_period > 2) {
      $errors['edit_error'] = "The timeslot cannot exceed 2 hours";
  }

  else if ($hour < 8 || $hour > 18) {
      $errors['edit_error'] = "Start time should be between 8 AM and 6 PM";
  }

  else {

    // Conflict Checking Algorithm
    $conflict = $db->query("SELECT * FROM bookings WHERE (room_id = :room_id) AND (:start_time < end_time AND :end_time > start_time)", [
        'room_id' => $room_id,
        'start_time' => $start_time,
        'end_time' => $end_time
    ]);

    if ($conflict->rowCount() > 0) {
        $errors['edit_error'] = "This timeslot is already booked. Please choose a different time.";
    }
    
    else {

        $stmt = $db->query("UPDATE bookings SET room_id = :room_id, start_time = :start_time, end_time = :end_time WHERE id = :booking_id", [
          'booking_id' => $booking_id,
          'room_id' => $room_id,
          'start_time' => $start_time,
          'end_time' => $end_time
        ]);

        $errors['edit_message'] = "Schedule $booking_id updated successfully";

      }
  }


}

if (Validator::post('delete_schedule')) {
  $booking_id = $_POST['schedule_id'];

  $stmt = $db->query("DELETE FROM bookings WHERE id = :booking_id", [
    'booking_id' => $booking_id
  ]);

  $errors['edit_message'] = "Schedule $booking_id deleted successfully";

}


try {
  // Fetch bookings
  $bookings = $db->query('SELECT b.*, r.room_name FROM bookings b JOIN rooms r ON b.room_id = r.room_id')->fetchAll();

  // Fetch rooms
  $rooms = $db->query('SELECT * FROM rooms')->fetchAll();
}

catch (PDOException $e) {
  $errors['error'] = 'Fetch Error: ' . htmlspecialchars($e->getMessage());
}

view('admin/schedules.view.php', [
  'h1' => 'Manage Schedules',
  'p' => 'Add, edit, or delete room bookings',
  'schedules' => $bookings,
  'rooms' => $rooms,
  'errors' => $errors
]);