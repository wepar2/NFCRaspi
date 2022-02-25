<!DOCTYPE html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css">
	<script src="<?php echo base_url(); ?>js/jquery.js"></script>
	<script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>js/script.js"></script>
	<title>Revisa tu correo</title>
</head>
<html>
	<body>
		<main>
			<div class="container">
				<div class="row">
					<div class="col-md-offset-3 col-md-6">
						<div class="contenform">
							<img class="file" src="<?php echo base_url(); ?>img/emailOK.svg">
							<p class="textoCorreo">Gracias por validar el Correo electronico.</p>
							<?php

								echo $message;

							?>
						</div>	
					</div>
				</div>	
			</div>
		</main>	
	</body>
</html>