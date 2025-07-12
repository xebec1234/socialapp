<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Post</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-100 flex items-center justify-center font-sans">

  <div class="w-full max-w-xl bg-white p-8 rounded-xl shadow-md">
    <h1 class="text-2xl font-bold text-green-600 mb-6">Edit Post</h1>
    <form action="/edit-post/{{ $post->id }}" method="POST" class="space-y-4">
      @csrf
      @method('PUT')

      <div>
        <label for="title" class="block mb-1 text-gray-700 font-semibold">Title</label>
        <input type="text" name="title" id="title" value="{{ $post->title }}" required
               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-300" />
      </div>

      <div>
        <label for="body" class="block mb-1 text-gray-700 font-semibold">Body</label>
        <textarea name="body" id="body" rows="5" required
                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-300">{{ $post->body }}</textarea>
      </div>

      <div class="flex justify-between items-center">
        <a href="/" class="text-sm text-gray-500 hover:underline">← Cancel</a>
        <button class="bg-green-500 hover:bg-green-600 text-white font-semibold px-6 py-2 rounded-lg transition">
          Save Changes
        </button>
      </div>
    </form>
  </div>

</body>
</html>
