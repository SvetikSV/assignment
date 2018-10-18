<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">


        <title>Assignment</title>
    </head>
    <body>
        <h2>Products</h2>
		<form action="add_product" method="POST">
		@csrf
			<div>
				<input type="text" name="name" placeholder="Name">
			</div>
			<div>
				<input type="text" name="price" placeholder="Price">
			</div>
			<div>
				<button type="submit" class="save btn btn-primary hover-shadow">Add product</button>
			</div>
		</form>
	</body>
</html>