	<div class="container">

		<div class="row">
			<div class="col-md-12">
				<div class="text-center">
					<h1 class="text-blue pb-2 fw-bold">EJERCICIO 1</h1>
				</div>
			</div>
		</div>

		<div class="row mt-2">

			<div class="col-md-4">
				<form id="fbisiesto" method="post">
					<label class="form-label">Ingrese el Año a consultar</label>
					<input type="text" id="anio" name="anio" class="form-control" aria-describedby="anioHelpInline" required="true">
				</form>

				<button class="btn btn-primary mt-2" onclick="ejercicio1()">Enviar</button>
				<br/>
				<a href="<?= base_url(); ?>" class="btn btn-primary mt-2">Volver</a>
			</div>

		</div>

	</div>

	<!-- JS pagina 	-->
	<script src="<?= base_url(); ?>/public/assets/js/paginas/ejercicio1.js"></script>