<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{ url('uploadFile') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="text" name="name" id="">
        <input type="text" name="deskripsi" id="">
        <input type="file" name="file" id="">
        <input type="submit" name="" id="">
    </form>
</body>
</html>