	<div class="container">

		<div class="row">
			<div class="col-md-12">
				<div class="text-center">
					<h1 class="text-blue pb-2 fw-bold">EJERCICIO 4</h1>
				</div>
			</div>
		</div>

		<div class="row mt-2">

			<div class="col-md-12">
				<form id="farreglo" method="post">
					<label class="form-label">Letras Aleatorias grupo A</label>
					<textarea id="g1" name="g1[]" class="form-control" aria-describedby="anioHelpInline" required="true" rows="5" cols="2"></textarea>
					<label class="form-label">Letras Aleatorias grupo B</label>
					<textarea id="g2" name="g2[]" class="form-control" aria-describedby="anioHelpInline" required="true" rows="5" cols="2"></textarea>
				</form>

				<button class="btn btn-primary mt-2" onclick="ejercicio4()">Enviar</button>
				<br/>
				<a href="<?= base_url(); ?>" class="btn btn-primary mt-2">Volver</a>
			</div>

		</div>

	</div>

	<!-- JS pagina 	-->
	<script src="<?= base_url(); ?>/public/assets/js/paginas/ejercicio4.js"></script>