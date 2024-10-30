<?php

include_once "app/ProductsController.php";

$productsController = new ProductsController();

$productos = $productsController->get();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'update') {
	$id = $_POST['id'];
	$name = $_POST['name'];
	$slug = $_POST['slug'];
	$description = $_POST['description'];
	$features = $_POST['features'];


	$productsController->updateProduct($name, $slug, $description, $features, $id);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'create') {
	$name = $_POST['name'];
	$slug = $_POST['slug'];
	$description = $_POST['description'];
	$features = $_POST['features'];

	$productsController->addProduct($name, $slug, $description, $features);
}

?>
<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>


	<div class="container-fluid min-vh-100 d-flex flex-column">

		<!-- nav -->
		<div class="row">
			<nav class="navbar navbar-expand-lg bg-dark bg-body-tertiary" data-bs-theme="dark">
				<div class="container-fluid">
					<a class="navbar-brand" href="#">Navbar scroll</a>
					<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<div class="collapse navbar-collapse" id="navbarScroll">
						<ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
							<li class="nav-item">
								<a class="nav-link active" aria-current="page" href="#">Home</a>
							</li>
							<li class="nav-item">
								<a class="nav-link" href="#">Link</a>
							</li>
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
									Link
								</a>
								<ul class="dropdown-menu">
									<li><a class="dropdown-item" href="#">Action</a></li>
									<li><a class="dropdown-item" href="#">Another action</a></li>
									<li>
										<hr class="dropdown-divider">
									</li>
									<li><a class="dropdown-item" href="#">Something else here</a></li>
								</ul>
							</li>
							<li class="nav-item">
								<a class="nav-link disabled" aria-disabled="true">Link</a>
							</li>
						</ul>
						<form class="d-flex" role="search">
							<input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
							<button class="btn btn-outline-success" type="submit">Search</button>
						</form>
					</div>
				</div>
			</nav>
		</div>

		<!-- sidebar & content -->
		<div class="row ">

			<div class="col-2 flex-grow-1 g-0">
				<div class="d-flex flex-column min-vh-100 flex-shrink-0 p-3 text-white bg-dark ">
					<a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-white text-decoration-none">
						<svg class="bi me-2" width="40" height="32">
							<use xlink:href="#bootstrap"></use>
						</svg>
						<span class="fs-4">Sidebar</span>
					</a>
					<hr>
					<ul class="nav nav-pills flex-column mb-auto">
						<li class="nav-item">
							<a href="#" class="nav-link active" aria-current="page">
								<svg class="bi me-2" width="16" height="16">
									<use xlink:href="#home"></use>
								</svg>
								Home
							</a>
						</li>
						<li>
							<a href="#" class="nav-link text-white">
								<svg class="bi me-2" width="16" height="16">
									<use xlink:href="#speedometer2"></use>
								</svg>
								Dashboard
							</a>
						</li>
						<li>
							<a href="#" class="nav-link text-white">
								<svg class="bi me-2" width="16" height="16">
									<use xlink:href="#table"></use>
								</svg>
								Orders
							</a>
						</li>
						<li>
							<a href="#" class="nav-link text-white">
								<svg class="bi me-2" width="16" height="16">
									<use xlink:href="#grid"></use>
								</svg>
								Products
							</a>
						</li>
						<li>
							<a href="#" class="nav-link text-white">
								<svg class="bi me-2" width="16" height="16">
									<use xlink:href="#people-circle"></use>
								</svg>
								Customers
							</a>
						</li>
					</ul>
					<hr>
					<div class="dropdown">
						<a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
							<img src="https://github.com/mdo.png" alt="" width="32" height="32" class="rounded-circle me-2">
							<strong>mdo</strong>
						</a>
						<ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
							<li><a class="dropdown-item" href="#">New project...</a></li>
							<li><a class="dropdown-item" href="#">Settings</a></li>
							<li><a class="dropdown-item" href="#">Profile</a></li>
							<li>
								<hr class="dropdown-divider">
							</li>
							<li><a class="dropdown-item" href="#">Sign out</a></li>
						</ul>
					</div>
				</div>

			</div>

			<div class="col-10">

				<div class="main p-2">

					<nav aria-label="breadcrumb">
						<ol class="breadcrumb">
							<li class="breadcrumb-item active" aria-current="page">Home</li>
						</ol>

						<button type="button" class="btn btn-primary float-end" data-bs-toggle="modal" data-bs-target="#exampleModal">
							Añadir
						</button>

					</nav>


					<div class="row">


						<?php if (isset($productos) && count($productos)): ?>
							<?php foreach ($productos as $product): ?>

								<div class="col-3">


									<div class="card mb-3" style="width: 18rem;">
										<img src="<?= $product->cover ?>" class="card-img-top" alt="...">
										<div class="card-body">
											<h5 class="card-title">
												<?= $product->name ?>
											</h5>
											<p class="card-text">
												<?= $product->description ?>
											</p>
											<a href="product.php?slug=<?= $product->slug ?>" class="m-1 btn btn-primary">Go somewhere</a>

											<a href="product.html" class="m-1 btn btn-danger">
												Eliminar
											</a>

											<button onclick='cargarProducto(this)' data-product='<?= json_encode($product)  ?>' data-bs-toggle="modal" data-bs-target="#editModal" type="button" class="btn btn-warning">
												Editar
											</button>



										</div>
									</div>

								</div>

							<?php endforeach ?>
						<?php endif ?>

					</div>

				</div>

			</div>

		</div>
	</div>

	<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="exampleModalLabel">Añadir Producto</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">


					<form method="POST" action="">
						<input type="hidden" name="action" value="create">
						<div class="mb-3">
							<label for="name" class="form-label">Nombre</label>
							<input type="text" class="form-control" id="name" name="name" aria-describedby="name" required>
						</div>
						<div class="mb-3">
							<label for="slug" class="form-label">Slug</label>
							<input type="text" class="form-control" id="slug" name="slug" aria-describedby="slug" required>
						</div>
						<div class="mb-3">
							<label for="description" class="form-label">Descripción</label>
							<input type="text" class="form-control" id="description" name="description" aria-describedby="description" required>
						</div>
						<div class="mb-3">
							<label for="features" class="form-label">features</label>
							<input type="text" class="form-control" id="features" name="features" aria-describedby="features" required>
						</div>
						<button type="submit" class="btn btn-primary">Submit</button>
					</form>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">cancelar</button>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="editModalLabel">Editar Producto</h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">

					<form method="POST" action="">
						<input type="hidden" name="action" value="update">
						<div class="mb-3">
							<input type="hidden" id="up_id" name="id">						
						</div>
						<div class="mb-3">
							<label for="name" class="form-label">Nombre</label>
							<input type="text" class="form-control" id="up-name" name="name" aria-describedby="name" required>
						</div>
						<div class="mb-3">
							<label for="slug" class="form-label">Slug</label>
							<input type="text" class="form-control" id="up-slug" name="slug" aria-describedby="slug" required>
						</div>
						<div class="mb-3">
							<label for="description" class="form-label">Descripción</label>
							<input type="text" class="form-control" id="up-description" name="description" aria-describedby="description" required>
						</div>
						<div class="mb-3">
							<label for="features" class="form-label">features</label>
							<input type="text" class="form-control" id="up-features" name="features" aria-describedby="features" required>
						</div>
						<button type="submit" class="btn btn-primary">Submit</button>
					</form>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">cancelar</button>
				</div>
			</div>
		</div>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	<script>
		function cargarProducto(prod) {
			let producto = JSON.parse(prod.dataset.product);
			document.getElementById("up_id").value = producto.id
			document.getElementById("up-name").value = producto.name
			document.getElementById("up-slug").value = producto.slug
			document.getElementById("up-description").value = producto.description
			document.getElementById("up-features").value = producto.features
		}
	</script>
</body>

</html>