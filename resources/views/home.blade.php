<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @auth
        <p>Welcome motherfucker</p>
        <form action="/logout" method="POST">
            @csrf
            <button>Logout</button>
        </form>

        <div style="border: 3px solid black; margin-top: 20px; padding:20px;">
            <h2>Create a Post</h2>
            <form action="create-post"method="POST" >
                @csrf
                <input type="text" name="title" id="title" placeholder="Title of your post" required>
                <textarea name="body" id="body" placeholder="What's on your mind" required></textarea>
                <button>Create Post</button>
            </form>
        </div>
        <div style="border: 3px solid black; margin-top: 20px; padding:20px;">
            <h2>All Posts</h2>
            @foreach($posts as $post)
            <div style="background-color: grey; padding: 10px;">
                <h3>{{$post['title']}} by {{$post->user->name}}</h3>
                <p></p>
                {{$post['body']}}
                <p><a href="/edit-post/{{$post->id}}">Edit</a></p>
                <form action="/delete-post/{{$post->id}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button>Delete</button>
                </form>
            </div>
            @endforeach
        </div>
    @else
        <div style="border: 3px solid black; padding:20px;">
            <h2>Register here</h2>
            <form action="/register" method="POST">
                @csrf
                <label for="name">Username:</label>
                <input type="text" name="name" id="name" placeholder="Username" required>
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" placeholder="Email" required>
                <label for="password">password:</label>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <button>Create Account</button>
            </form>
        </div>

         <div style="border: 3px solid black; margin-top:10px; padding:20px;">
            <h2>Login here</h2>
            <form action="/login" method="POST">
                @csrf
                <label for="username">Username:</label>
                <input type="text" name="username" id="username" placeholder="Username" required>
                <label for="userpassword">password:</label>
                <input type="password" name="userpassword" id="userpassword" placeholder="Password" required>
                <button>Login</button>
            </form>
        </div>
    @endauth

</body>
</html>