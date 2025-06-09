<!DOCTYPE html>
<html lang="it">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Blog Post</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="id_post" content="{{ $id_post }}">
    <script>
        const BASE_URL = "{{ url('/') }}/";
    </script>
    <link rel="stylesheet" href="{{url('css/post.css')}}" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet" />
    <script src="{{url('js/post.js')}}" defer></script>
</head>

<body>
    <!-- Navbar -->
    <nav class="top-navbar">
        <div class="nav-content">
            <a href="{{url('home')}}" class="logo-link">
                <img src="{{ url('img/Media/home.svg')}}" alt="Home" class="logo-icon" />
                Torna alla home
            </a>
        </div>
    </nav>

    <div class="blog-container">
        <!-- Titolo sopra la copertina -->
        <div class="header-title">
            <h1 class="post-title">Titolo del Post del Blog</h1>
        </div>

        <!-- Copertina -->
        <header class="cover">
            <img src="{{url('img/Media/placeholder.jpg')}}" alt="Copertina" class="cover-img" />
        </header>

        <!-- Autore -->
        <section class="author">
            <img src="{{url('img/Media/Portrait_Placeholder.png')}}" alt="Autore" class="author-img" />
            <div class="author-info">
                <p class="author-name">Autore</p>
                <p class="author-username">@autore</p>
            </div>
        </section>

        <!-- Contenuto del post -->
        <main id="post-content" class="post-content">

            <!-- contenuto del post -->

        </main>

        <button class="preferito-btn" data-set="no">
            <span class="btn-text">Aggiungi ai preferiti</span>
            <img src="{{url('img/Media/heart_empty.svg')}}" alt="Preferito" class="icon" id="heart-icon" />
        </button>



        <section class="comments-section">
            <h2>Commenti</h2>

            <!-- Form per inviare il commento -->
            <form id="comment-form" class="comment-box" method="post">
                <textarea name="commento" placeholder="Scrivi un commento..." required></textarea>
                <button type="submit">Invia</button>
            </form>

            <!-- Commenti statici di esempio -->

        </section>


        <!-- Footer -->
        <footer class="footer">
            <p>© 2025 Simone Platania. Tutti i diritti riservati.</p>
        </footer>
    </div>
</body>

</html>