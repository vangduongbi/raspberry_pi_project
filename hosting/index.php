<?php
    // load file and get data in file
    $data = file_get_contents("./data/data.json");
    // decode json to array PHP
    $data_decoded = json_decode($data, true);

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="bootstrap/bootstrap.min.css">
  
        
    <script src="js/jquery-3.1.1.min.js"></script>
    <script src="js/js.js"></script>
    

<style>
    *{
        padding:0;
        margin:0;
    }
</style>
<script>
</script>
	<title>Document</title>
</head>
<body>
	<div class="container-fluid">
	<div class="container">
		<header class="bg-light" >
			<img src="img/header.png" alt="tdm" class="img-fluid d-block mx-auto pl-4">
		</header>
        <div class="jumbotron jumbotron-fluid" style="padding:10px">
            <div class="container text-center">
                <h1 class="display-5">Đồ An Tốt Nghiệp</h1>
                <p class="lead">Điều khiển thiết bị và giám sát nhiệt độ.</p>
            </div>
        </div>
        <div class="row border border-primary py-5">
        <?php
        foreach ($data_decoded as $data) {
            foreach ($data as $id => $value) { ?>
        
            <div class="col-md-6" style="border-right:1px solid #007bff">
                <h2 class="text-center py-5">Bật tắt <?=$value['name'] ?></h2>
                <!-- <img src="" alt="" class="img-fluid"> -->
                <h3 id="dv-<?=$value['id']?>" class="text-center d-block text-success">OFF</h3>
                <div class="wraper d-block text-center" >
                    <button data-id="<?=$value['id']?>" data-value="1" class="btn btn-lg btn-danger mx-3 control" >Bật đèn</button>
                    <button data-id="<?=$value['id']?>" data-value="0" class="btn btn-default btn-lg mx-3 control" >Tắt đèn</button>
                </div>
            </div>
            <?php       
            }
        }
        ?>
            <div class="col-md-6">
                <h2 class="text-center py-5">Bật Auto</h2>
                <h3 id="dv-5" class="text-center d-block text-success">OFF AUTO</h3>
                <div class="wraper d-block text-center">
                    <button class="btn btn-lg btn-danger mx-3" id="on-btn5">Bật Auto</button>
                    <button class="btn btn-default btn-lg mx-3" id="off-btn5">Tắt Auto</button>
                </div>
            </div>
        </div>
        <div class="alert alert-success text-center px-5 mt-1" role="alert">Nhiệt độ hiện tại :
        <div id="temp_txt"></div>
        </div>

	</div>
</div>
<footer class="bg-secondary text-center text-white" >
    <p>Trường đại học THU DAU MOT</p>
    <p> Email:phonghaohoa63@gmail.com </p>
    <p>GVHD: LE TRUONG AN </p>
    <p>Sv thực hiện: Hồ Sỹ VI PHONG</p>
</footer>
<!-- <script src="js/main.js"></script> -->

</body>
</html>