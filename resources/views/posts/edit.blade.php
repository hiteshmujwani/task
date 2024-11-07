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

    <form action="{{ route('posts.update', $post->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- This is important to send the PUT request -->

        <label for="title">Title</label>
        <input type="text" name="title" value="{{ old('title', $post->title) }}" required>

        <label for="content">Content</label>
        <textarea name="content" required>{{ old('content', $post->content) }}</textarea>

        <label for="image">Upload New Image (optional)</label>
        <input type="file" name="image">

        @if ($post->image)
            <!-- If there is already an image, display it -->
            <div>
                <img src="{{ asset('storage/' . $post->image) }}" alt="Current Image" style="max-width: 100px;">
                <p>Current Image</p>
            </div>
        @endif

        <button type="submit">Update Post</button>
    </form>

</body>

</html>
