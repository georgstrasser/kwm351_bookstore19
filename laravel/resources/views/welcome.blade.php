<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>
<ul>
    @foreach ($books as $book)
        <li>{{$book->isbn}} {{$book->title}}</li>
    @endforeach
</ul>
</body>
</html>