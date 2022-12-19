	<div class="container">

		<div class="row">
			<div class="col-md-12">
				<div class="text-center">
					<h1 class="text-blue pb-2 fw-bold">EJERCICIO 3</h1>
				</div>
			</div>
		</div>

		<div class="row mt-2">

			<div class="col-md-4">
				<form id="farreglo" method="post">
					<label class="form-label">Generando arreglo de numeros aleatorios hasta el 100</label>
					<textarea id="numeros" name="numeros[]" class="form-control" aria-describedby="anioHelpInline" required="true" rows="5" cols="2"></textarea>
				</form>

				<button class="btn btn-primary mt-2" onclick="ejercicio3()">Enviar</button>
				<br/>
				<a href="<?= base_url(); ?>" class="btn btn-primary mt-2">Volver</a>
			</div>

		</div>

	</div>

	<!-- JS pagina 	-->
	<script src="<?= base_url(); ?>/public/assets/js/paginas/ejercicio3.js"></script>