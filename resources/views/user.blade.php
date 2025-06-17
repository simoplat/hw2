
<head>
    <title>hw1</title>
    <link rel="stylesheet" href="{{ url('css/user.css')}}" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="channel" content="{{ $channel }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
    const BASE_URL = "{{ url('/') }}/";
    const csrf_token = '{{ csrf_token() }}';
    </script>


    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <script src="{{ url('js/user.js')}}" defer></script>
</head>

<body>
    <div class="container">

        <div class="main-layout">
            <a href={{url('home')}} class="logo-link">
                <img src="{{ url('img/Media/home.svg')}}" alt="Logo" class="logo" />
                Torna alla home
            </a>
         
            <div class="central-layout">
                <div class="profile-header">
                    <img src="{{url('img/Media/placeholder.jpg')}}" alt="Copertina" id="cover-photo-id" class="cover-photo" />
                    <div class="profile-info">
                        <img src="{{url('img/Media/Portrait_Placeholder.png')}}" alt="Profilo" id="profile-pic-id" class="profile-pic" />
                        <div class="user-details">
                            
                            <!-- elementi da aggiungere dinamicamente -->
                             <h2 id="username">{{ $name . ' ' . $surname }}</h2>
                             <p id="user-tag">{{'@'. $channel }}</p>



                        </div>
                    </div>
                </div>
                        
                        @if ($isFollowing === 'TeStesso')
                            
                        @elseif ($isFollowing)
                            <button class="btn-iscrizione" data-set="no">
                                <span id="isc-text" class="btn-text">Disicriviti al canale</span>
                            </button>
                        @else
                            <button class="btn-iscrizione" data-set="no">
                                <span id="isc-text" class="btn-text">Iscriviti al canale</span>
                            </button>
                        @endif
                        

                <div id="profile-content">
                    <!-- <h3>Post recenti</h3>
                    <div class="post">
                        <h4>Titolo post 1</h4>
                        <p>Contenuto del post. Testo di esempio per mostrare il layout.</p>
                    </div>
                    <div class="post">
                        <h4>Titolo post 2</h4>
                        <p>Altro contenuto interessante pubblicato dall’utente.</p>
                    </div> -->
                    
                </div>

            </div>

        </div>

        <div class="mobile-navbar">
            <button>
                <img class="svg-white" src="{{url('img/Media/home.svg')}}" />
            </button>
            <button id="button-menu-mobile">
                <img class="svg-white" src="{{url('img/Media/library.svg')}}" />
            </button>
            <button>
                <img id="pic-nav-mobile" src="{{url('img/Media/Portrait_Placeholder.png')}}" />
            </button>
        </div>

        <footer>
            <div class="footer-container">
                <div class="footer-links">
                    <a href="#">Informazioni</a>
                    <a href="#">Privacy</a>
                    <a href="#">Termini</a>
                    <a href="#">Contatti</a>
                </div>
            </div>
            <p class="footer-copyright">© 2025 Simone Platania. Tutti i diritti riservati.</p>
        </footer>
    </div>

</body>

</html>