	<div class="container">

		<div class="row">
			<div class="col-md-12">
				<div class="text-center">
					<h1 class="text-blue pb-2 fw-bold">EJERCICIO 2</h1>
				</div>
			</div>
		</div>

		<div class="row mt-2">

			<div class="col-md-4">
				<form id="" method="">
					<label class="form-label">Ingrese la cantidad de filas</label>
					<input type="text" id="filas" name="filas" class="form-control" aria-describedby="anioHelpInline" required="true">
					<label class="form-label">Ingrese la cantidad de conlumnas</label>
					<input type="text" id="columnas" name="columnas" class="form-control" aria-describedby="anioHelpInline" required="true">
				</form>

				<button class="btn btn-primary mt-2" onclick="ejercicio2()">crear tabla</button>
				<br/>
				<a href="<?= base_url(); ?>" class="btn btn-primary mt-2">Volver</a>
			</div>

		</div>
		<div class="row mt-2">

			<div class="col-md-12">

				<table id="datadina" class="table-primary">

				</table>

			</div>
		</div>



	</div>

	<!-- JS pagina 	-->
	<script src="<?= base_url(); ?>/public/assets/js/paginas/ejercicio2.js"></script>