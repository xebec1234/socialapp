<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Edit Post</h1>
    <form action="/edit-post/{{$post->id}}" method="POST">
        @csrf
        @method('PUT')
        <label for="title">Title:</label>
        <input type="text" name="title" value="{{$post->title}}" require>
        <label for="body">Body:</label>
        <textarea name="body" id="body" require>{{$post->body}}</textarea>
        <button>Save Changes</button>
    </form>
</body>
</html>