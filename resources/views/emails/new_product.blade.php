<!DOCTYPE html>
<html>
<head>
    <title>New Product Created</title>
</head>

<body>
    <h2>New Product Created</h2>
<br/>
    <p>Category Name : {{ $product->category->name }}</p>
    <p>Product Name :{{ $product->category->name }} </p>
    <p>Created By : {{ auth()->user()->fullname }}</p>
    <p>Created Date : {{ $product->created_at }}</p>
   
   
</body>

</html>