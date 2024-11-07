<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>


    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <label for="title">Title</label>
        <input type="text" name="title" required>

        <label for="content">Content</label>
        <textarea name="content" required></textarea>

        <label for="image">Upload Image</label>
        <input type="file" name="image">

        <button type="submit">Create Post</button>
    </form>


</body>

</html>
