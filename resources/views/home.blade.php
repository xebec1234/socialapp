<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     @vite('resources/css/app.css')
     <script src="//unpkg.com/alpinejs" defer></script>
    <title>SocioApp</title>
</head>
<body class="min-h-screen font-sans bg-gray-100 text-gray-800">
    @auth
        <div class="flex min-h-screen">

            <!-- Sidebar -->
            <aside class="w-64 bg-white shadow-md p-6 flex flex-col justify-between">
                <div>
                    <h2 class="text-2xl font-bold text-green-600 mb-6">Hello, {{ auth()->user()->name }} 👋</h2>
                </div>
                <form action="/logout" method="POST">
                    @csrf
                    <button class="w-full text-center bg-red-100 text-red-600 font-medium px-4 py-2 rounded-lg hover:bg-red-200 transition">
                    Logout
                    </button>
                </form>
            </aside>

            <!-- Main Content -->
            <main class="flex-1 p-10 space-y-10">

                <!-- Create Post -->
                <section class="bg-white p-6 rounded-xl shadow-md">
                    <h2 class="text-xl font-bold text-green-600 mb-4">Create a Post</h2>
                    <form action="/create-post" method="POST" class="space-y-4">
                    @csrf
                    <input type="text" name="title" placeholder="Title of your post" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-300" />
                    <textarea name="body" placeholder="What's on your mind?" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-300 h-28"></textarea>
                    <button type="submit"
                            class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg font-semibold transition">
                        Create Post
                    </button>
                    </form>
                </section>

                <!-- All Posts -->
                <section class="bg-white p-6 rounded-xl shadow-md">
                    <h2 class="text-xl font-bold text-green-600 mb-6">All Posts</h2>
                    @forelse($posts as $post)
                    <div class="border border-gray-200 rounded-lg p-4 mb-4">
                        <div class="flex justify-between items-center">
                        <h3 class="text-lg font-bold text-gray-900">{{ $post->title }}</h3>
                        <span class="text-sm text-gray-500">by {{ $post->user->name }}</span>
                        </div>
                        <p class="mt-2 text-gray-700">{{ $post->body }}</p>
                        <div class="flex gap-4 mt-4">
                        <a href="/edit-post/{{ $post->id }}" class="text-blue-600 hover:underline font-medium">✏️ Edit</a>
                        <form action="/delete-post/{{ $post->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:underline font-medium">🗑️ Delete</button>
                        </form>
                        </div>
                    </div>
                    @empty
                    <p class="text-gray-500">No posts yet.</p>
                    @endforelse
                </section>

            </main>
        </div>
    @else
        <div class="flex items-center justify-center min-h-screen bg-gradient-to-br from-green-100 via-green-400 to-green-600 py-10 px-4 text-white font-sans">

    <div x-data="{ showLogin: true }"
         class="relative w-full max-w-xl h-[450px] bg-white/10 backdrop-blur-lg rounded-3xl overflow-hidden shadow-2xl border border-white/20">

            <div class="relative flex z-20">
            <button @click="showLogin = true"
                    class="w-1/2 text-center py-3 transition-all duration-500 font-semibold text-white"
                    :class="showLogin ? 'bg-white/20 rounded-bl-3xl text-white shadow-inner' : 'text-white/70'">
                Login
            </button>
            <button @click="showLogin = false"
                    class="w-1/2 text-center py-3 transition-all duration-500 font-semibold text-white"
                    :class="!showLogin ? 'bg-white/20 rounded-br-3xl text-white shadow-inner' : 'text-white/70'">
                Register
            </button>
            </div>

            <div class="relative h-[450px] overflow-hidden">

            <div x-show="showLogin"
                x-transition:enter="transition-all ease-in-out duration-700 transform"
                x-transition:enter-start="opacity-0 scale-90 translate-x-10"
                x-transition:enter-end="opacity-100 scale-100 translate-x-0"
                x-transition:leave="transition-all ease-in-out duration-500 transform"
                x-transition:leave-start="opacity-100 scale-100 translate-x-0"
                x-transition:leave-end="opacity-0 scale-90 -translate-x-10"
                class="absolute inset-0 px-10 py-10 text-white w-full h-full"
                x-cloak>
                <h2 class="text-4xl font-bold mb-6">Welcome Back</h2>
                <form action="/login" method="POST" class="space-y-6">
                @csrf
                <input type="text" name="username" placeholder="Username" required
                        class="w-full px-4 py-3 rounded-xl bg-white text-green-500 placeholder-green-300 outline-none focus:ring-2 focus:ring-green-300" />
                <input type="password" name="userpassword" placeholder="Password" required
                        class="w-full px-4 py-3 rounded-xl bg-white text-green-500 placeholder-green-300 outline-none focus:ring-2 focus:ring-green-300" />
                <button type="submit"
                        class="w-full bg-green-500 hover:bg-green-600 text-white py-3 rounded-xl font-semibold shadow-md transition">
                    Login
                </button>
                </form>
            </div>

            <div x-show="!showLogin"
                x-transition:enter="transition-all ease-in-out duration-700 transform"
                x-transition:enter-start="opacity-0 scale-90 -translate-x-10"
                x-transition:enter-end="opacity-100 scale-100 translate-x-0"
                x-transition:leave="transition-all ease-in-out duration-500 transform"
                x-transition:leave-start="opacity-100 scale-100 translate-x-0"
                x-transition:leave-end="opacity-0 scale-90 translate-x-10"
                class="absolute inset-0 px-10 py-10 text-white w-full h-full"
                x-cloak>
                <h2 class="text-4xl font-bold mb-6">Create Account</h2>
                <form action="/register" method="POST" class="space-y-4">
                @csrf
                <input type="text" name="name" placeholder="Username" required
                        class="w-full px-4 py-3 rounded-xl bg-white text-green-500 placeholder-green-300 outline-none focus:ring-2 focus:ring-green-300" />
                <input type="email" name="email" placeholder="Email" required
                        class="w-full px-4 py-3 rounded-xl bg-white text-green-500 placeholder-green-300 outline-none focus:ring-2 focus:ring-green-300" />
                <input type="password" name="password" placeholder="Password" required
                        class="w-full px-4 py-3 rounded-xl bg-white text-green-500 placeholder-green-300 outline-none focus:ring-2 focus:ring-green-300" />
                <button type="submit"
                        class="w-full bg-green-500 hover:bg-green-600 text-white py-3 rounded-xl font-semibold shadow-md transition">
                    Register
                </button>
                </form>
            </div>

            </div>
        </div>
        </div>
    @endauth

</body>
</html>