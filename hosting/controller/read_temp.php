<?php
    // $temp = file_get_contents("./../data/temp.json");

    // $temp_decoded = json_decode($temp, true);

    // $temp = $temp_decoded['temperater'];
    // echo $temp;

  


    // encode from array to json data
    // $data_json = json_encode($data_decoded);

    // //save data_json into file
    // file_put_contents('./../data/temp.json', $data_json);

    if (isset($_POST['temp'])) {
        echo $_POST['temp'];
          // load file and get data in file
        $data = file_get_contents("./../data/temp.json");
        // decode json to array PHP
        $data_decoded = json_decode($data, true);

        //Modify the status of port gpio to 1
        $data_decoded['temperater'] = $_POST['temp'];
        // encode from array to json data
        $data_json = json_encode($data_decoded);
        print_r($data_json);
        
        //save data_json into file
        file_put_contents('./../data/temp.json', $data_json);
        // echo 1;
    } 

    $temp = file_get_contents("./../data/temp.json");

    $temp_decoded = json_decode($temp, true);

    $temp = $temp_decoded['temperater'];
    echo $temp;