<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Special Offer</title>
</head>
<body>
    <p>Hello,</p>
    <p>We're excited to tell you that an item you liked, {{ $product->name }}, is now on offer!</p>
    <p><a href="{{ url('/products/'.$product->id) }}">Click here to view the product.</a></p>
    <p>Thank you for using our service!</p>
</body>
</html>
