<html>

<head>
    <link rel='stylesheet' href="{{  url('css/login.css') }}">

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <title>Accedi</title>
</head>

<body>
    <div class="logo">
        <img src="media/YouTube-logo.png">

    </div>
    <div class="login">
        <section class="main">
            <h1>Accedi al tuo account</h1>
            <p class="error"> Compilare tutti i campi</p>
            <p class="error">Username o Password errati</p>
            <form name='login' method='post' id="form-login">
                <div class="username">
                    <label for='username'>Username</label>
                    <input type='text' name='username' value=" {{ old("username") }}">
                </div>
                <div class="password">
                    <label for='password'>Password</label>
                    <input type='password' name='password'>
                </div>
                <div class="submit-container">
                    <div class="login-btn">
                        <input type='submit' value="ACCEDI">
                    </div>
                </div>
            </form>
            <div class="signup">
                <h4>Non hai un account?</h4>
            </div>
            <div class="signup-btn-container"><a class="signup-btn" href="{{ url('register')}}">ISCRIVITI</a></div>
        </section>
    </div>
</body>

</html>