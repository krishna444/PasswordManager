<!DOCTYPE html>
<html>
<head>
<style>
.animated {
	width: 700px;
	height: 800px;
	background: #346712;
	-webkit-animation: myfirst 5s; /* Chrome, Safari, Opera */
	animation: myfirst 5s;
}

/* Chrome, Safari, Opera */
@
-webkit-keyframes myfirst {
	from {background: #346712;
}

to {
	background: yellow;
}

}

/* Standard syntax */
@
keyframes myfirst {
	from {background: #346712;
}

to {
	background: yellow;
}
}
</style>
<link rel="stylesheet" type="text/css"
	href="http://kpaudel.com.np/css/bootstrap.min.css" />
<script src="http://kpaudel.com.np/css/countdown.js"></script>
</head>
<body>


	<div class="container">
		<div style="text-align: center;">
			<script>	
		
		var myCountdown1 = new Countdown({
								 	year: 2017, 
									month:1, 
									day:1									
									});
   </script>
		</div>
		<div class="animated">
			<img src="http://kpaudel.com.np/css/newyear.jpg" width="700"
				height="500" /> <font size="10" color="white"><marquee>Happy New
					Year 2016</marquee> </font> <br> <br>
			<div class="text-right">
				<font size="5" color="#ee9955">"I wish happy and prosperous new
					year."</font> <br> <br> <strong>-Krishna Paudel, Germany</strong>


			</div>

		</div>

	</div>

</body>
</html>
