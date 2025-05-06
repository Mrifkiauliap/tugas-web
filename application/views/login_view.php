<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login | Inventory System</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
	<style>
        body {
            background-image: url('https://images.unsplash.com/photo-1542281286-9e0a16bb7366?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1950&q=80');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
        }
    </style>
</head>
<body class="bg-gray-50">
    <div class="max-w-md mx-auto mt-16">
        <form class="bg-white rounded px-8 pt-6 pb-8 mb-4" method="post" action="<?= base_url('user/login') ?>">
            <h1 class="text-2xl font-bold mb-4 text-center">Login</h1>

            <?php if ($this->session->flashdata('pesan')): ?>
                <div class="mb-4 p-4 <?= $this->session->flashdata('pesan')['type'] == 'success' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800'; ?> rounded-lg">
                    <?= $this->session->flashdata('pesan')['message'] ?>
                </div>
            <?php elseif (validation_errors()): ?>
                <div class="mb-4 p-4 bg-red-100 text-red-800 rounded-lg">
                    <?= validation_errors() ?>
                </div>
            <?php else: ?>
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded-lg">
                    Logged out successfully
                </div>
            <?php endif; ?>

            <div class="mb-4">
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                <input type="email" name="email" id="email" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="mb-6">
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                <input type="password" name="password" id="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="flex items-center justify-between">
                <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                    Login
                </button>
                <a href="<?= base_url('user/register') ?>" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                    Belum punya akun?
                </a>
            </div>
        </form>
    </div>
</body>
</html>
