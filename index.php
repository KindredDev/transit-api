<?php

require 'includes/flight/Flight.php';
require 'includes/Config.php';
require 'includes/Connections.php';
require 'includes/Log.php';
require 'includes/Helper.php';
require 'includes/Data.php';

$finalize = function($response) {
  header('Content-Type: application/json');
  die( json_encode($response) );
};

Flight::route('GET /', function() use ($finalize) {
  $finalize(array(
    "status"  => "success",
    "message" => "Hello world!"
  ));
});

Flight::route('POST /ping/@id/@location', function($id, $location) use ($finalize) {
  $coords = explode(',', $location);
  Data::insert('location', array("id" => Helper::getUID(16), "device_id" => $id, "lat" => $coords[0], "long" => $coords[1]));
  $finalize(array(
    "status"  => "success",
    "message" => "Location for device $id updated to $location"
  ));
});

Flight::start();

?>
