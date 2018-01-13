<?php
// connect and login to FTP server
const FTP_SERVER = "ftp.caychoivang.vn";
const FTP_USERNAME = 'caychoiv';
const FTP_USERPASS = 'T41Ht6K7knBc';
const TEMP_FILE = "./temp.json";
const REMOTE_FILE = './public_html/ftp/data/temp.json';
// $conn_id = ftp_connect(FTP_SERVER);
// $login_result = ftp_login($conn_id, FTP_USERNAME, FTP_USERPASS);

set_time_limit(0);

/**
 * Read_file : read file json and return array
 * use http to read json file on server and conver it to array 
 * 
 * @param string $file_name
 * @return array $content_array
 * 
 */
function read_file()
{
    // $file = "ftp://" . FTP_USERNAME . ":" . FTP_USERPASS . "@" . FTP_SERVER . "/public_html/ftp/data/{$file_name}";
    // if ( ! $file) { 
    //     print_r('Cant connect to server');
    //     return false;
    // }

    //read file using http 
   $file = 'http://caychoivang.vn/ftp/data/data.json';
   $contents = file_get_contents($file);

    // decode json data to array.
    $contents_array = json_decode($contents);
    return $contents_array;
}

/**
 * Up_file : up file json to ftp server;
 * 
 * This function is not use in this project, but it also can use to edit file on temperater.json on server by ftp
 * 
 * first edit file in local after that upload it to server every second,
 * 
 * did't use this method to change content of file temp.json , instead that use http method 
 * exactly is curl in php to post data to server and save it into temp.json then read this file 
 * and echo it , and front end  i use ajax to request this file and print it to browser every 3 second.
 * 
 * 
 * @param string $file_name
 * @param json $data
 */
function edit_file($file_name, $data)
{
    
    if (file_put_contents(TEMP_FILE, $data)) {
        
        // login with username and password
        global $conn_id;
        
        // // upload a file
        if ( ! ftp_put($conn_id, REMOTE_FILE, TEMP_FILE, FTP_ASCII)) {
            echo "There was a problem while uploading" . TEMP_FILE ."\n";
        return FALSE;
    
        }                   
        return TRUE;
    }
       
}

/**
 * Using http to post temperature to server
 * 
 */
function push_temp() 
{
    // Work out the data
    $data = ["temp" => read_temperater()];
    
    $posts = http_build_query($data);
    // echo $posts;
    $ch = curl_init("http://caychoivang.vn/ftp/controller/read_temp.php");
    // set URL and other appropriate options
    
    curl_setopt($ch, CURLOPT_POST, TRUE); 
    curl_setopt($ch, CURLOPT_POSTFIELDS, $posts);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    $rp = curl_exec($ch);
    curl_close($ch);
    print_r($rp);
}

/**
 * Control_gpio: from data control the gpio
 * This function read data from json file on server
 * fetch object and control gpio raspberry if status of something port is equal 1 gpio will be 1
 * status equal 0 :that port  gpio will be 0; 
 * 
 * @param array $data
 */
function control_gpio()
{
    $data = read_file();
    // fetch data from object
    foreach ($data->equipment as  $value) {
        if ($value->status == 1) {
            //execute command line using exec function
            exec("gpio -g mode {$value->port}  out");
            exec("gpio -g write {$value->port}  1");
        } else {
            exec("gpio -g write {$value->port} 0");                 
        }
    }
   
}
/**
 * Read_temperater
 * 
 * This function to read temperater from ds8b20 sensor.
 * 
 * @return float $temp
 */
function read_temperater()
{
    $path = '/sys/bus/w1/devices/28-000008e54110/w1_slave';
	$lines = file($path);
	$temp = explode('=', $lines[1]);
    $temp = number_format($temp[1] / 1000,2,'.','');
 
	return $temp;
	
}

// main 
while (1) {
   //call function control gpio
   control_gpio();
   // call function temperater
   push_temp();
   sleep(1);
    
}

