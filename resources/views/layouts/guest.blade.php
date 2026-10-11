<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Product Inventory') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #f5f0ff, #ddd0ff, #c4b5fd);
            color: #312e45;
        }

        .auth-page {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 35px 16px;
        }

        .auth-heading {
            text-align: center;
            margin-bottom: 24px;
        }

        .auth-logo {
            width: 65px;
            height: 65px;
            margin: 0 auto 14px;
            border-radius: 20px;
            background: linear-gradient(135deg, #7c3aed, #a78bfa);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            font-weight: bold;
            box-shadow: 0 8px 20px #7c3aed35;
        }

        .auth-heading h1 {
            font-size: 27px;
            font-weight: bold;
            color: #4c1d95;
            margin: 0 0 8px;
        }

        .auth-heading p {
            margin: 0;
            color: #6b6280;
            font-size: 14px;
        }

        .auth-card {
            width: 100%;
            max-width: 430px;
            padding: 32px;
            background: white;
            border: 1px solid #eee5ff;
            border-radius: 20px;
            box-shadow: 0 18px 45px #4c1d951c;
        }

        .auth-card input[type="email"],
        .auth-card input[type="password"],
        .auth-card input[type="text"] {
            width: 100%;
            padding: 11px 13px;
            border: 1px solid #ddd6fe;
            border-radius: 9px;
            margin-top: 6px;
            outline: none;
        }

        .auth-card input:focus {
            border-color: #8b5cf6;
            box-shadow: 0 0 0 3px #8b5cf620;
        }

        .auth-card label {
            color: #4b4260;
        }

        .auth-card button[type="submit"] {
            background: #7c3aed !important;
            color: white !important;
            border: none;
            border-radius: 9px;
            padding: 10px 20px;
            font-weight: bold;
            cursor: pointer;
        }

        .auth-card button[type="submit"]:hover {
            background: #5b21b6 !important;
        }

        .auth-card a {
            color: #7c3aed;
        }

        .auth-footer {
            margin-top: 22px;
            text-align: center;
            font-size: 12px;
            color: #766b8b;
        }

        @media (max-width: 480px) {
            .auth-card {
                padding: 24px 20px;
            }

            .auth-heading h1 {
                font-size: 23px;
            }
        }
    </style>
</head>

<body>
    <main class="auth-page">
        <div class="auth-heading">
            <div class="auth-logo">P</div>
            <h1>Product Inventory</h1>
            <p>Manage your products with ease.</p>
        </div>

        <section class="auth-card">
            {{ $slot }}
        </section>

        <div class="auth-footer">
            Product Inventory System
        </div>
    </main>
</body>
</html>