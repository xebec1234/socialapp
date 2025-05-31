<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    @auth
        <p>login successfully</p>
        <form action="logout" method="POST">
            @csrf
            <button>logout</button>
        </form>
    @else
        <div style="border: 3px solid black">
            <h1>Welcome</h1>
            <h2>Register</h2>
            <form action="/register" method="POST">
                @csrf
                <label for="name">name: </label>
                <input type="text" placeholder="Full name" name="name">
                <label for="email">email: </label>
                <input type="email" placeholder="Email" name="email">
                <label for="password">password: </label>
                <input type="password" placeholder="password" name="password">
                <button>Register</button>
            </form>
        </div>
         <div style="border: 3px solid black">
            <h2>Log in</h2>
            <form action="/login" method="POST">
                @csrf
                <label for="name">username: </label>
                <input type="text" placeholder="Full name" name="username">
                <label for="password">password: </label>
                <input type="password" placeholder="password" name="password">
                <button>login</button>
            </form>
        </div>
    @endauth
    
</body>
</html>