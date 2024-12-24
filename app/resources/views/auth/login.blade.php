<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Авторизация</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
<div class="bg-white shadow-lg rounded-lg w-full max-w-md p-6">
    <div class="text-center">
        <h1 class="text-3xl font-bold text-gray-800 mb-2">Добро пожаловать!</h1>
        <p class="text-sm text-gray-600">Войдите, чтобы продолжить</p>
    </div>
    <form action="{{ route('authenticate') }}" method="POST" class="space-y-6 mt-6">
        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mt-2" role="alert">
                <strong class="font-bold">Ошибка!</strong>
                <span class="block sm:inline">Пожалуйста, исправьте следующие проблемы:</span>
                <ul class="mt-2 list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @csrf
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
            <input
                type="email"
                id="email"
                name="email"
                value="{{ old('email') }}"
                class="w-full mt-1 p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                placeholder="Введите ваш email"
                required
            >
        </div>
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">Пароль</label>
            <input
                type="password"
                id="password"
                name="password"
                class="w-full mt-1 p-3 rounded-lg border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                placeholder="Введите ваш пароль"
                required
            >
        </div>
        <div class="flex items-center justify-between">
            <div class="flex items-center">
                <input
                    type="checkbox"
                    id="remember"
                    name="remember"
                    class="h-4 w-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500"
                >
                <label for="remember" class="ml-2 text-sm text-gray-700">Запомнить меня</label>
            </div>
        </div>
        <div>
            <button
                type="submit"
                class="w-full bg-blue-600 text-white py-3 rounded-lg font-medium hover:bg-blue-700 transition duration-200 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
            >
                Войти
            </button>
        </div>
    </form>
    <a href="{{ route('redirectToGoogle') }}"
       class="mt-4 w-full flex items-center justify-center gap-2 py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all">
        <img src="https://www.svgrepo.com/show/475656/google-color.svg" class="h-5 w-5">
        Войти с помощью Google
    </a>
</div>
</body>
</html>
