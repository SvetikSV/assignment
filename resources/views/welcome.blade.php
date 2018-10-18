<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Assignment</title>
    </head>
    <body>
        <h2>Products <a href='/add_product'>Add product</a></h2>
	<table border="2" align="center" width="60%">
		<tr>
		<th>Name</th>
		<th>Price by days</th>
		<th>Price by latest</th>
		</tr>
		@foreach($productsWrapper as $product)
		<tr>
			<td>
			{{$product['name']}}
			</td>
			<td>
			{{$product['price_by_days']}}
			</td>
			<td>
			{{$product['price_by_latest']}}
			</td>
		</tr>
		@endforeach
	</table>
    </body>
</html>
