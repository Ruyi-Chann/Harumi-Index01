<?php include_once('cf.php'); ?>
<!-- coded by arceus @rceus|@Harumii1 -->
<!-- for assigning badges to your api, refer to https://getbootstrap.com/docs/5.0/getting-started/introduction/-->
<!-- credits to every member in !-->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Chk</title>
</head>
<body>

    <div class="container mb-5 mt-5 content" id="container">
    <div class="row justify-content-md-center">
    <div class="col-md-12">

    <h5>Arceus</h5>
        <center>
	  		<span class="badge bg-success">CVV: <span id="cLive">0</span></span>&nbsp;&nbsp;x
	  		<span class="badge bg-warning text-dark">CCN: <span id="cWarn">0</span></span>&nbsp;&nbsp;x
	  		<span class="badge bg-danger">Dead: <span id="cDie">0</span></span>&nbsp;&nbsp;x
	  		<span class="badge bg-dark text-white">Checked: <span id="total">0</span></span>&nbsp;&nbsp;x
	  		<span class="badge bg-info text-dark">Total: <span id="carregadas">0</span></span>&nbsp;&nbsp;
	    </center><br>
	<textarea type="text" class="md-textarea form-control" style="border-color: #fff; background: transparent; color: #FFFFFF; text-align: center;" id="lista" rows="5" placeholder="xxxxxxxxxxxxxxxx|xx|xxxx|xxx" required></textarea>
        <br>
        <textarea name="sk" id="sk" rows="1" type="text" class="form-control" style="border-color: #fff;background: transparent;color: #FFFFFF; text-align: center;" placeholder="sk_live_xxxxxxxxxxxxxxxx" class="form-group"></textarea><br>
        <select name="gate" id="gate" class="form-control" style="margin-bottom: 20px;background: transparent;color: #fff;"  onchange="showDiv('hidden_div', this)">
        <?php for ($i=0; $i < count($api_file); $i++) {
		    echo '<option style="background:transparent;color:#2c2e36" value="'.$api_file[$i].'">'.$api_name[$i].'</option>';
		    }?>
		</select>
    <button type="button" class="btn btn-outline-light" style="width:100%" id="testar" onclick="enviar()">Start</button>

    <!-- -->
    <br><br><br>
        <div class="col-md-13">
        <div class="card" style="background:#2c2e36;background-color: rgba(0,0,0,0.2);">
        <div style="position: absolute;top: 0;right: 0;">
        <button id="mostra1" class="btn btn-outline-light btn-block btn-sm">SHOW/HIDE</button><br>
        </div>
        <div class="card-body ">
        <h6><p style="text-align:left; color: #fff;margin-bottom:5px" class="card-title" ><span id="cLive2" class="badge bg-success" style="margin-top: 9px;margin-bottom:5px">0</span> - CVV</p></h6>
        <div id="bode1"><span id=".aprovadas" class="aprovadas"></span>
        </div>
        </div>
        </div>
        </div><br>

        <div class="col-md-13">
        <div class="card"style="background:#2c2e36;background-color: rgba(0,0,0,0.2);">
        <div style="position: absolute;top: 0;right: 0;">
        <button id="mostra2" class="btn btn-outline-light btn-block btn-sm">SHOW/HIDE</button><br>
        </div>
        <div class="card-body ">
        <h6><p style="text-align:left; color: #fff;margin-bottom:5px" class="card-title" ><span id="cLive2" class="badge bg-warning text-dark" style="margin-top: 9px;margin-bottom:5px">0</span> - CCN</p></h6>
        <div id="bode2"><span id=".edrovadas" class="edrovadas"></span>
        </div>
        </div>
        </div>
        </div><br>

        <div class="col-md-13">
        <div class="card"style="background:#2c2e36;background-color: rgba(0,0,0,0.2);">
        <div style="position: absolute;top: 0;right: 0;">
        <button id="mostra3" class="btn btn-outline-light btn-block btn-sm">SHOW/HIDE</button><br>
        </div>
        <div class="card-body ">
        <h6><p style="text-align:left; color: #fff;margin-bottom:5px" class="card-title" ><span id="cLive2" class="badge bg-danger" style="margin-top: 9px;margin-bottom:5px">0</span> - DEAD</p></h6>
        <div id="bode3"><span id=".reprovadas" class="reprovadas"></span>
        </div>
        </div>
        </div>
        </div><br>

        <hr>
        <center>&copy;Arceus</center>

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.js" type="text/javascript"></script>
   	<script src="assets/js/arceus.js" type="text/javascript"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.4/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    
    </div>
    </div>
    
</body>
</html>

<!-- coded by arceus @rceus|@Harumii1 -->
