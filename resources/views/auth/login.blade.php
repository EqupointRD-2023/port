<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>EMS</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #30363b;
        }

        .login-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            width: 300px;
            margin: 50px;
        }

        h2 {
            text-align: center;
        }

        .input-container {
            margin-bottom: 10px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        .button-container {
            text-align: center;
            margin-top: 15px;
        }

        button {
            padding: 10px 20px;
            background-color: #df3978;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        .logo-container {
            text-align: center;
            margin-bottom: 10px;
        }

        .logo-image {
            width: 90px;
            /* Adjust the width as needed */
            height: 90px;
            /* Adjust the height as needed */
            border-radius: 50%;
            /* border: 2px solid #007bff; */
            border: 4px dotted #007bff;
        }
    </style>



</head>

<body>
    <div class="login-container">
        <div class="logo-container">
            <img class="logo-image" src="{{ asset('assets/logo.png.jpg') }}" alt="Logo">
        </div>
        <h2>Sign In</h2>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="input-container">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="input-container">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>



            <div class="button-container">
                <button type="submit" class="submit">
                    {{ __('Login') }}
                </button>
            </div>
        </form>
    </div>
</body>

</html>
