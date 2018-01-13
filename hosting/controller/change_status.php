<?php
$id = $_GET['id'];
$value = $_GET['value'];

// load file and get data in file
$data = file_get_contents("./../data/data.json");
// decode json to array PHP
$data_decoded = json_decode($data, true);

//Modify the status of port gpio to 1
// print_r($data_decoded);
if ($value == 1) {
    $data_decoded['equipment'][$id]['status'] = 1;
} elseif ($value == 0) {
    $data_decoded['equipment'][$id]['status'] = 0;
}

// encode from array to json data
$data_json = json_encode($data_decoded);

//save data_json into file
file_put_contents('./../data/data.json', $data_json);
