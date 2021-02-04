<html>
<head>
      <title>DTM</title>
	  <link rel="shortcut icon" href="additional/favicon.png">
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
      <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>

body{
	
	margin:0;
	padding:0;
	width : 100%;
	height : 100vh;
	
	background : linear-gradient(
	    rgba(0, 0, 0, 0.8),
        rgba(0, 0, 0, 0.8)
		),url(additional/bg.jpg) 50% 50% no-repeat;
	background-size: cover;
	display:table;
	 
}

.container{
	margin-top: 5%;
	
   }

.first{
	color:white;
	font-size:2.5vw;
	margin-bottom:0;
	text-align:center;
	text-transform : uppercase;
	letter-spacing:3px;
	font-family:Courier;
	
}
.first_small{
	color:white;
	font-size:6vw;
	margin-bottom:0;
	text-align:center;
	text-transform : uppercase;
	letter-spacing:3px;
	font-family:Courier;
	
}
.second{
	color:white;
	font-size : 2.2vw;
	font-weight:550;
	margin-bottom:0;
	text-align:center;
	text-transform : uppercase;
	letter-spacing:3px;
	font-family:"Courier New", Courier, monospace;
	
}

.second_small{
	color:white;
	font-size : 4.4vw;
	font-weight:650;
	margin-bottom:0;
	text-align:center;
	text-transform : uppercase;
	letter-spacing:1px;
	font-family:"Courier New", Courier, monospace;
	
}

.third{
	color:white;
	font-weight:550;
	letter-spacing:5px;
	font-size:2.5vw;
	text-align:center;
	text-transform : uppercase;
	font-family:"Courier New", Courier, monospace;
}

.third_small{
	color:white;
	font-weight:650;
	letter-spacing:5px;
	font-size:5.5vw;
	text-align:center;
	text-transform : uppercase;
	font-family:"Courier New", Courier, monospace;
}
.fourth{
	color:white;
	font-weight:550;
	letter-spacing:7px;
	font-size:4vw;
	text-align:center;
	margin-top:10px;
	text-transform : uppercase;
	font-family:"times new roman";
}
.footer {
   position: fixed;
   left: 0;
   bottom: 50;
   width: 100%;
   color: white;
   text-align: center;
}
.chip {
    display: inline-block;
    padding: 0 25px;
    height: 35px;
    font-size: 14px;
    line-height: 35px;
    border-radius: 25px;
    background-color: #f1f1f1;
}
.chip_small {
    display: inline-block;
    padding: 0 10px;
    height: 25px;
    font-size: 10px;
    line-height: 25px;
    border-radius: 25px;
    background-color: #f1f1f1;
}
</style>
</head>

<body>
<main>
<div class = "hidden-xs hidden-sm hidden-md ">
<br><div class="pull-right chip ">
<a href = "contact.php"><b>Contact us</b></a>
</div><br><br>
</div>
<div class = "hidden-lg">
<br><div class="pull-right chip_small ">
<a href = "contact.php"><b>Contact us</b></a>
</div><br><br>
</div>
<div class = "container">
<div id="" class = "hidden-xs hidden-sm first">Welcome<br>To</div><br>
<div id="" class = "hidden-md hidden-lg first_small">Welcome<br>To<br></div>

<div id="" class = "hidden-xs hidden-sm third">Departmental Task Manager</div>
<div id="" class = "hidden-md hidden-lg third_small"><br>Departmental Task Manager</div>

<div id = "" class= "hidden-xs hidden-sm first">
<br>
<a href = "hod/"><button type="button" class="btn btn-success"><span style="font-size:3.5vh;font-weight:550;letter-spacing:2px;">I AM HOD</span></button>  </a>
<a href = "faculty/"><button type="button" class="btn btn-primary"><span style="font-size:3.5vh;font-weight:550;letter-spacing:2px;">I AM FACULTY</span></button>  </a>
</div>

<div id = "" class= "hidden-md hidden-lg first_small">
<br><br><br>
<a href = "hod/"><button type="button" class="btn btn-success"><span style="font-size:2.2vh;font-weight:650;letter-spacing:2px;">I AM HOD</span></button>  </a>
<a href = "faculty/"><button type="button" class="btn btn-primary"><span style="font-size:2.2vh;font-weight:650;letter-spacing:2px;">I AM FACULTY</span></button>  </a>  </a>
</div>
</div>

</main>


<!--
<footer>
<div id="" class = "footer hidden-xs hidden-sm second"><span style = "font-size : 1.5vw;">Powered By</span> Team CSI</div>
<div id="" class = "footer hidden-md hidden-lg second_small"><span style = "font-size : 3vw;">Powered By</span> Team CSI</div>
</footer>
-->
</body>
</html>