
<!DOCTYPE html>
<html>
<head>
    <title>hw1</title>
    <script>
        const BASE_URL = "{{ url('/') }}/";
    </script>
    <link rel="stylesheet" href= "{{ url('css/home.css')}}" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
<script src="{{ url('js/home.js')}}" defer></script>
</head>
  
<body>
    <div class="container">
        <header> 
            <nav class="navbar">
                <div class="nav-left">
                    <button id="button-menu">
                        <img id="menu-img" src="{{ url('img/Media/menu.svg')}}"/>
                    </button>
                    <img id="logoimg" src="{{ url('img/Media/YouTube-logo.png')}}"/>
                </div>

                <div class="nav-center">
                   <form id="search-form">
                       <input type="text" name="q" placeholder="Cerca" id="search-bar" required>
                       <button type="submit" id="search-button">
                           <img id="search-icon" src="{{ url('img/Media/search.svg')}}" alt="Cerca"/>
                        </button>
                        <input type='hidden' name='_token' value="{{ csrf_token() }}">
                    </form>

                </div>

                <div class="nav-right">
                    <!-- <button>
                        <section>
                            <img id="cross-pic" src="media/cross.svg">
                            Crea                       
                        </section>
                    </button> -->
                    <button id="notify-button">
                        <img id="notify-pic" src="{{ url('img/Media/notifications-1.png')}}"/>
                    </button>
                    <div class="notify-menu hidden"  id="notify-btn">
                        <h1>Notifiche</h1>
                    </div>
                    <button id="button-profile">
                            @if ($immagineProfilo)
                                <img id="profpic" src="{{ url('img/' . $immagineProfilo) }}" alt="Profilo">
                            @else
                                <img id="profpic" src="{{ url('img/Media/Portrait_Placeholder.png') }}" alt="Profilo">
                            @endif

                        
                    </button>
                    <div class="personal-menu hidden" >
                        @if ($immagineProfilo)
                                <img id="profpic-menu" src="{{ url('img/' . $immagineProfilo) }}" alt="Profilo">
                            @else
                                <img id="profpic-menu" src="{{ url('img/Media/Portrait_Placeholder.png') }}" alt="Profilo">
                            @endif
                            <h1> Benvenuto {{$username}} ! </h1>

 
                        
                            <a href="user/{{$username }}">
                                <button class="menu-button" data-action="preferences">
                                    Il tuo account
                                </button>
                            </a>
                        <a href='{{url('logout')}}'>
                            <button class="menu-button" data-action="contact">
                                Log out
                            </button>
                        </a>
                    </div>
                    
                </div>

            </nav>
             
        </header>
      

        <div class="main-layout">
            <div class="left-sidebar">
                <div class="sidebar-content">
                    <div class="sidebar-h">
                        <button id="button-home">
                            <div class="sidebar-inside">
                                <div class="sdbar-ins-img">
                                <img src="{{ url('img/Media/home.svg')}}"/>
                                </div>
                                <div class="sdbar-ins-txt" data-section="home">
                                <p>Home</p>
                                </div>
                            </div>
                        </button>
                    </div>
                    
                    <!-- <div class="sidebar-h">
                        <button>
                            <div class="sidebar-inside">
                                <div class="sdbar-ins-img">
                                <img src="media/video-short.svg"/>
                                </div>
                                <div class="sdbar-ins-txt" data-section="Shorts">
                                <p>Shorts</p>
                                </div>
                            </div>
                        </button>    
                    </div> -->
                    
                    <h1 data-type="Tu">
                        <!-- TU   (old)-->
                        Sezione Personale
                        <img data-type="up" class="toggle" src="{{ url('img/Media/down-arrow.svg')}}">
                    </h1>

                    <div class="sidebar-h" data-type="Tu">
                        <button id="buttonPreferiti">
                            <div class="sidebar-inside">
                                <div class="sdbar-ins-img">
                                <img src="{{ url('img/Media/heart_full.svg')}}"/>
                                </div>
                                <div class="sdbar-ins-txt" data-section="Preferiti">
                                <p>Preferiti</p>
                                </div>
                            </div>
                        </button>
                    </div>

                    <div class="sidebar-h" data-type="Tu">
                        <button id="buttonPlaylist">
                            <div class="sidebar-inside">
                                <div class="sdbar-ins-img">
                                <img src="{{ url('img/Media/library.svg')}}"/>
                                </div>
                                <div class="sdbar-ins-txt" data-section="Playlist">
                                <p>Playlist Musicale</p>
                                </div>
                            </div>
                        </button>
                    </div>
                    <!-- <div class="sidebar-h" data-type="Tu">
                        <button>
                            <div class="sidebar-inside">
                                <div class="sdbar-ins-img">
                                <img src="media/history.svg"/>
                                </div>
                                <div class="sdbar-ins-txt" data-section="Cronologia">
                                <p>Cronologia</p>
                                </div>
                            </div>
                        </button>
                    </div> -->
                    <div class="sidebar-h" data-type="Tu">
                        <!-- <button>
                            <div class="sidebar-inside">
                                <div class="sdbar-ins-img">
                                <img src="media/like.svg"/>
                                </div>
                                    <div class="sdbar-ins-txt" data-section="Mi-piace">
                                        <p>Mi piace</p>
                                    </div>
                            </div>
                        </button> -->
                    </div>
                    <h1 data-type="channel">
                        Le tue iscrizioni
                        <img data-type="up" class="toggle" src="{{ url('img/Media/down-arrow.svg')}}">

                    </h1>
                    <div class="createChannels">
                        


                    </div>

                        
                    
                </div>
            </div>


            <div class="central-layout">

                <div class="categorie">
                    <nav class="nav-central">
                        
                    <!-- contenuto dinamico -->
                    </nav>
                </div>
                
                <div class="video-layout">
                            <!-- conteunuto dinamico -->
                                                       
                </div>

            </div>

        </div>

        <div class="mobile-navbar">
            <a href="{{ url('/home') }}">
                <button id="button-home-mobile">
                        <img class="svg-white" src="{{ url('img/Media/home.svg')}}"/>
                </button>
            </a>
                <button id="button-menu-mobile">
                    <img class="svg-white" src="{{ url('img/Media/library.svg')}}"/>
                </button>
            <button id="button-profile-mobile">
                <img id="pic-nav-mobile" src="{{ url('img/' . $immagineProfilo) }}" />
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