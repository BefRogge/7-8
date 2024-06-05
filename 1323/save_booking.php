<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $guests = $_POST['guests'];

    $booking = array(
        'name' => $name,
        'email' => $email,
        'date' => $date,
        'time' => $time,
        'guests' => $guests
    );

    $file = 'save_booking.txt';

    if (file_exists($file)) {
        $current_data = json_decode(file_get_contents($file), true);
    } else {
        $current_data = array();
    }

    $current_data[] = $booking;

    if (file_put_contents($file, json_encode($current_data, JSON_PRETTY_PRINT))) {
        echo json_encode(array('status' => 'success', 'message' => 'Booking saved successfully'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Failed to save booking'));
    }
}
?>