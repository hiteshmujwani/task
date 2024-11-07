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

    <h1>All Posts</h1>
    <table border="1" cellspacing="0" cellpadding="10" style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th>Title</th>
                <th>Content</th>
                <th>Author</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->content }}</td>
                    <td>
                        <!-- Show the image if available -->
                        @if ($post->postImage)
                            <img src="{{ asset('storage/' . $post->postImage->image_path) }}" alt="Post Image"
                                style="max-width: 100px;">
                        @else
                            No Image
                        @endif
                    </td>
                    <td>{{ $post->user->name }}</td>
                    <td>
                        <!-- Edit Button -->
                        @can('edit-post', $post)
                            <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary">Edit</a>
                        @endcan

                        <!-- Delete Button -->
                        @can('delete-post', $post)
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        @endcan
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>


</body>

</html>
