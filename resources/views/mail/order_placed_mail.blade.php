<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Placed</title>
</head>
<body>
<h3>You placed a order in {!! env('APP_NAME') !!}</h3>
<h5>OrderID: #{!! $order->order_id !!}</h5>
</body>
</html>