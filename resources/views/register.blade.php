<html>

<head>
    <link rel='stylesheet' href="{{ url('css/signup.css')}}">
    <script src='{{ url('js/signup.js')}}' defer></script>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">

    <title>Iscrizione</title>
</head>

<body>
    <div id="logo">
        <img src="img/Media/YouTube-logo.png">
        <h1>Inserisci i tuoi dati</h1>
    </div>
    <main>
        <section class="main_right">
            <form name='signup' method='post'>
                @csrf
                @if ($error == 'empty-fields')
                <section class="error"> Compila tutti i campi</section>
                @elseif ($error == 'bad_passwords')
                <section class="error">Le password non corrispondono</section>

                @elseif ( $error == 'username_existing')
                <section class="error">L'username che hai scelto non è disponibile</section>

                @elseif ( $error == 'email_existing')
                <section class="error">L'email è già stata usata</section>
                @endif

                <div class="names">
                    <div class="name">
                        <label for='name'>Nome</label>
                        <input type='text' name='name' value='{{ old("name") }}'>
                        <div><img src="{{ url('img/Media/close.svg')}}" /><span>Devi inserire il tuo nome</span></div>
                    </div>
                    <div class="surname">
                        <label for='surname'>Cognome</label>
                        <input type='text' name='surname' value='{{ old("surname") }}'>
                        <div><img src="{{ url('img/Media/close.svg')}}" /><span>Devi inserire il tuo cognome</span>
                        </div>
                    </div>
                </div>
                <div class="username">
                    <label for='username'>Nome utente</label>
                    <input type='text' name='username' value='{{ old("username") }}'>
                    <div><img src="{{ url('img/Media/close.svg')}}" /><span>Nome utente non disponibile</span></div>
                </div>
                <div class="email">
                    <label for='email'>Email</label>
                    <input type='text' name='email' value='{{ old("email") }}'>
                    <div><img src="{{ url('img/Media/close.svg')}}" /><span>Indirizzo email non valido</span></div>
                </div>
                <div class="password">
                    <label for='password'>Password</label>
                    <input type='password' name='password' value='{{ old("password") }}'>
                    <div><img src="{{ url('img/Media/close.svg')}}" /><span>Inserisci almeno 8 caratteri</span></div>
                </div>
                <div class="confirm_password">
                    <label for='confirm_password'>Conferma Password</label>
                    <input type='password' name='confirm_password' value='{{ old("confirm_password") }}'>
                    <div><img src="{{ url('img/Media/close.svg')}}" /><span>Le password non coincidono</span></div>
                </div>
                <div class="allow">
                    <input type='checkbox' name='allow'>
                    <label for='allow'>Accetto i termini e condizioni d'uso.</label>
                </div>
                <div class="submit">
                    <input type='submit' value="Registrati" id="submit">
                </div>
            </form>
            <div class="signup">Hai un account? <a href="{{ url('login') }}">Accedi</a>
        </section>
    </main>
</body>

</html>