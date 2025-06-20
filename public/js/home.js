// toggle menu a sinistra in alto
const buttonMenuLines = document.querySelector('#button-menu');
const layout = document.querySelector('.central-layout');
const buttonMenuMobile = document.querySelector('#button-menu-mobile');
const meta_element = document.querySelector('meta[name="csrf-token"');
const csrf_token = meta_element.content;
const BASE_ROOT_URL = '/';
const BASE_IMG_URL = 'img/';



function toggleMenuSidebar() {
    let sidebarContent = document.querySelector('.left-sidebar');

    if (sidebarContent.classList.contains('hidden')) {
        sidebarContent.classList.remove('hidden');
        layout.classList.remove('expand');

        let menu = document.querySelector('.personal-menu');

        if (!menu.classList.contains('hidden')) {
            menu.classList.add('hidden');
            console.log('A'); //debug
        }
    } else {
        console.log('B'); //motivi di debug
        sidebarContent.classList.add('hidden');
        layout.classList.add('expand');
    }
}

buttonMenuLines.addEventListener('click', toggleMenuSidebar);
buttonMenuMobile.addEventListener('click', toggleMenuSidebar);

// toggle menu profilo
const buttonProfile = document.querySelector('#button-profile');
const personalMenu = document.querySelector('.personal-menu');

const buttonProfileMobile = document.querySelector('#button-profile-mobile');
if (buttonProfileMobile) {
    buttonProfileMobile.addEventListener('click', toggleProfMenu);
}

function toggleProfMenu() {

    if (window.matchMedia('(max-width: 750px)').matches) {
        let sidebarContent = document.querySelector('.left-sidebar');
        if (!sidebarContent.classList.contains('hidden')) {
            sidebarContent.classList.add('hidden');
        }
    }

    if (personalMenu.classList.contains('hidden')) {
        if (!notifyMenu.classList.contains('hidden')) {
            notifyMenu.classList.add('hidden');
        }
        personalMenu.classList.remove('hidden');
        console.log('Setto display show');
    } else {
        personalMenu.classList.add('hidden');
        console.log("Setto display hidden")
    }
}


buttonProfile.addEventListener('click', toggleProfMenu);

const mediaQuery = window.matchMedia('(max-width: 750px)');

function MediaChange(parametro) {
    let sidebarContent = document.querySelector('.left-sidebar');
    if (parametro.matches) {
        console.log('media query');

        // Se la sidebar è visibile, fa il toggle e nasconde
        if (!sidebarContent.classList.contains('hidden')) {
            console.log('Faccio il toggle');
            toggleMenuSidebar();
        }
    }
}

MediaChange(mediaQuery);
mediaQuery.addEventListener('change', MediaChange);



const notifyButton = document.querySelector('#notify-button');
const notifyMenu = document.querySelector('.notify-menu');

function toggleNotifyMenu() {
    if (notifyMenu.classList.contains('hidden')) {
        if (!personalMenu.classList.contains('hidden')) {
            personalMenu.classList.add('hidden');
        }

        clearNotifyMenu();
        fetchNotifications();

        notifyMenu.classList.remove('hidden');
        console.log('Setto display show');
    } else {
        notifyMenu.classList.add('hidden');
        console.log("Setto display hidden");
    }
}

notifyButton.addEventListener('click', toggleNotifyMenu);

function fetchNotifications() {
    fetch('fetchNotification')
        .then(onResponse)
        .then(onJsonNotifications)
}

function onJsonNotifications(json) {
    console.log('OnJsonNotifications:', json);

    if (!json.followers || json.followers.length === 0) {
        const p = document.createElement('p');
        p.textContent = 'Nessuna notifica';
        notifyMenu.appendChild(p);
        return;
    }

    for (let i = 0; i < json.followers.length; i++) {
        createNotificationMessage(json.followers[i]);
    }
}

function createNotificationMessage(username) {
    const p = document.createElement('p');
    p.textContent = '@' + username + ' si è iscritto al tuo canale';
    notifyMenu.appendChild(p);
}


function clearNotifyMenu() {
    while (notifyMenu.querySelector('p')) {
        notifyMenu.querySelector('p').remove();
    }
}

function onResponse(response) {
    return response.json();
}





function nascontiContenuti(dataType) {
    const images = document.querySelectorAll('h1[data-type="' + dataType + '"] img');

    for (let i = 0; i < images.length; i++) {
        const img = images[i];
        img.addEventListener('click', function () {
            toggleSidebars(dataType, img);
        });
    }
}

function toggleSidebars(dataType, img) {
    const sidebars = document.querySelectorAll('.sidebar-h[data-type="' + dataType + '"]');

    for (let j = 0; j < sidebars.length; j++) {
        const sidebar = sidebars[j];

        if (sidebar.classList.contains('hidden')) {
            sidebar.classList.remove('hidden');
            img.dataset.type = 'up';
            console.log('A');
        } else {
            sidebar.classList.add('hidden');
            img.dataset.type = 'down';
            console.log('B');
        }
    }
}


// Example usage:
nascontiContenuti('Tu');
nascontiContenuti('channel');


//API N1




function onJsonYoutube(json) {
    console.log('JSON ricevuto');

    const contentVIDEOLAYOUT = document.querySelector('.video-layout');
    const navCentral = document.querySelector('.nav-central');
    navCentral.classList.add('hidden');
    contentVIDEOLAYOUT.innerHTML = '';
    const categorie = document.querySelector('.categorie');
    while (categorie.querySelector('h1')) {
        categorie.querySelector('h1').remove();
    }

    if (json.items.length === 0) {
        let noResult = document.createElement('h1');
        noResult.textContent = 'Nessun risultato trovato';
        contentVIDEOLAYOUT.appendChild(noResult);
    }
    for (let i = 0; i < json.items.length; i++) {

        let item = json.items[i];



        let imgSource = item.snippet.thumbnails.medium.url;
        let imgElement = document.createElement('img');
        imgElement.src = imgSource;


        let divVideoContent = document.createElement('div');
        divVideoContent.classList.add('video-content');
        divVideoContent.classList.add('cursor-pointer');
        let title = item.snippet.title;
        let channel = item.snippet.channelTitle;
        let wallpaper = item.snippet.thumbnails.medium.url;
        let description = item.snippet.description;
        divVideoContent.setAttribute('data-title', title);
        divVideoContent.setAttribute('data-channel', channel);
        divVideoContent.setAttribute('data-wallpaper', wallpaper);
        divVideoContent.setAttribute('data-description', description);
        divVideoContent.addEventListener('click', function() {
            dataBaseAction(title, channel, wallpaper, description);
        });


        let divThumbnail = document.createElement('div');
        divThumbnail.classList.add('video-thumbnail');

        let divText = document.createElement('div');
        divText.classList.add('video-info');


        let divVideoInfoChannel = document.createElement('div');
        divVideoInfoChannel.classList.add('video-info-channel');


        let h1 = document.createElement('h1');
        h1.textContent = item.snippet.title;

        let p = document.createElement('p');
        p.textContent = item.snippet.channelTitle;


        divVideoInfoChannel.appendChild(h1);
        divVideoInfoChannel.appendChild(p);

        divText.appendChild(divVideoInfoChannel);
        divThumbnail.appendChild(imgElement);
        divVideoContent.appendChild(divThumbnail);
        divVideoContent.appendChild(divText);

        contentVIDEOLAYOUT.appendChild(divVideoContent);
        if (contentVIDEOLAYOUT.classList.contains('column')) {
            contentVIDEOLAYOUT.classList.remove('column');
        }
    }
}


function dataBaseAction(title, channel, wallpaper, description) {
    console.log('Azione del database con i seguenti dati:' + title + ', ' + channel + ', ' + wallpaper + ', ' + description);
    const data = new FormData();
    data.append('title', title);
    data.append('channel', channel);
    data.append('wallpaper', wallpaper);
    data.append('description', description);
    data.append('_token', csrf_token);
    fetch('dataBaseAction',
        {
            method: 'POST',
            body: data
        })
        .then(onResponse).then(onJsonDBAction);

}

function onJsonDBAction(json) {
    if(json.success) {
        window.location.href= 'post/' + encodeURIComponent(json.id_post);
        console.log('Redirecting to: ', 'post/' + encodeURIComponent(json.id_post));

        console.log('Tutto ok');
    }

    console.log(json);
}

function onResponse(response) {
    console.log('Risposta ricevuta');
    return response.json();
}



function search(event) {
    event.preventDefault();

    const form = document.querySelector('#search-form');
    const data = new FormData(form);

    fetch('youtubeAPI', {
        method: 'POST',
        body: data
    })
        .then(onResponse)
        .then(onJsonYoutube);
}



const form = document.querySelector('#search-form');
form.addEventListener('submit', search);

////API SPOTIFY N.2 oauth 2.0


function onJsonSpotifyPlaylist(json) {
    const contentVIDEOLAYOUT = document.querySelector('.video-layout');
    contentVIDEOLAYOUT.innerHTML = '';

    const navCentral = document.querySelector('.nav-central');
    navCentral.classList.add('hidden');

    const h1sInNavCentral = navCentral.querySelectorAll('h1');
    for (let i = 0; i < h1sInNavCentral.length; i++) {
        h1sInNavCentral[i].remove();
    }


    const categorie = document.querySelector('.categorie');

    const existingH1 = categorie.querySelector('h1');
    if (existingH1) {
        existingH1.remove();
    }


    const newTitle = document.createElement('h1');
    newTitle.textContent = 'Playlists:';
    categorie.appendChild(newTitle);
    const h1Username = document.querySelector('header h1.hidden');
    console.log('Username:', h1Username.textContent);

    for (let i = 0; i < json.items.length; i++) {
        const item = json.items[i];
        if (item && item.name) {
            console.log(item.name);

            let playlistName = document.createElement('h2');
            playlistName.textContent = item.name;

            let videoContent = document.createElement('div');
            videoContent.classList.add('video-content');

            let imgElement = document.createElement('img');
            imgElement.src = item.images[0]?.url || '';

            let divThumbnail = document.createElement('div');
            divThumbnail.classList.add('video-thumbnail');
            divThumbnail.appendChild(imgElement);

            let divVideoInfo = document.createElement('div');
            divVideoInfo.classList.add('video-info');
            divVideoInfo.appendChild(playlistName);

            videoContent.appendChild(divThumbnail);
            videoContent.appendChild(divVideoInfo);


            contentVIDEOLAYOUT.appendChild(videoContent);

            videoContent.addEventListener('click', function() {
                dataBaseAction(
                    item.name,
                    h1Username.textContent,
                    item.images[0]?.url || '',
                    item.description || ('Ecco la mia playlist ' + item.name + ' su Spotify')
                );
            });
        }
    }


}



function playlistSpotify(event) {
    event.preventDefault();
    console.log('Ho ricevuto il click sul bottone playlist');
    fetch('spotify').then(searchResponse).then(onJsonSpotifyPlaylist);

}


function searchResponse(response) {

    console.log('Risposta ricevuta da spotify.php');
    return response.json();


}




const playlistButton = document.querySelector('#buttonPlaylist');
playlistButton.addEventListener('click', playlistSpotify);



// API CHANNELS

const channelDivCreator = document.querySelector('.createChannels');

function onJsonChannels(json) {
    console.log('Json ricevuto, creo i canali');
    console.log(json);

    channelDivCreator.innerHTML = '';

    for (let i = 0; i < json.length; i++) {
        createChannelElement(json[i]);
    }
}

function createChannelElement(channel) {

    const link = document.createElement('a');
    link.href = `user/${encodeURIComponent(channel.channelname)}`;


    const sidebarDiv = document.createElement('div');
    sidebarDiv.classList.add('sidebar-h');
    sidebarDiv.setAttribute('data-type', 'channel');

    const button = document.createElement('button');
    const sidebarInside = document.createElement('div');
    sidebarInside.classList.add('sidebar-inside');

    const imgDiv = document.createElement('div');
    imgDiv.classList.add('sdbar-ins-img');

    const img = document.createElement('img');
    img.classList.add('channel-pic');

    if (channel.immagine_profilo && channel.immagine_profilo.startsWith('https')) {
        img.src = channel.immagine_profilo;
    } else if (channel.immagine_profilo) {
        img.src = BASE_IMG_URL + channel.immagine_profilo;
    } else {
        img.src = BASE_IMG_URL + 'Media/Portrait_Placeholder.png';
    }
    imgDiv.appendChild(img);

    const txtDiv = document.createElement('div');
    txtDiv.classList.add('sdbar-ins-txt');

    const p = document.createElement('p');
    p.textContent = channel.channelname;
    txtDiv.appendChild(p);

    sidebarInside.appendChild(imgDiv);
    sidebarInside.appendChild(txtDiv);

    button.appendChild(sidebarInside);
    sidebarDiv.appendChild(button);


    link.appendChild(sidebarDiv);


    channelDivCreator.appendChild(link);
}



function loadchannels() {
    console.log('Carico i canali');
    fetch('fetchChannels').then(onResponse).then(onJsonChannels);
};

loadchannels();



function onJsonHomeFeed(json) {
    console.log('JSON ricevuto per home feed:', json);

    const contentVIDEOLAYOUT = document.querySelector('.video-layout');
    const categorie = document.querySelector('.categorie');

    contentVIDEOLAYOUT.innerHTML = '';
    while (categorie.querySelector('h1')) {
        categorie.querySelector('h1').remove();
    }

    if (json.length === 0) {
        const noResult = document.createElement('h1');
        noResult.textContent = 'Nessun contenuto dai canali seguiti.';
        contentVIDEOLAYOUT.appendChild(noResult);
        return;
    }

    for (let post of json) {
        const divPost = document.createElement('div');
        divPost.classList.add('video-content');
        divPost.setAttribute('data-categories', post.categoria.toLowerCase());

        const divThumbnail = document.createElement('div');
        divThumbnail.classList.add('video-thumbnail');

        const aThumbnail = document.createElement('a');
        aThumbnail.href = `post/${encodeURIComponent(post.id_post)}`;
        aThumbnail.dataset.id = post.id_post;

        const imgThumbnail = document.createElement('img');
        imgThumbnail.alt = 'Immagine copertina post';


        if (divPost.getAttribute('data-categories') === 'caricamenti') {
           imgThumbnail.src = post.percorsoMedia;

        } else {
            imgThumbnail.src = (post.percorsoMedia && post.percorsoMedia.trim() !== '')
                ? BASE_IMG_URL + post.percorsoMedia
                : 'img/Media/placeholder.jpg';

        }




        aThumbnail.appendChild(imgThumbnail);
        divThumbnail.appendChild(aThumbnail);

        const divInfo = document.createElement('div');
        divInfo.classList.add('video-info');

        const aProfile = document.createElement('a');
        aProfile.href = `user/${encodeURIComponent(post.canale)}`;
        aProfile.dataset.channel = post.canale;

        const imgProfile = document.createElement('img');
        imgProfile.alt = 'Immagine';
        if (post.immagine_profilo && post.immagine_profilo.startsWith('https')) {
            imgProfile.src = post.immagine_profilo;
        } else {
            imgProfile.src = (post.immagine_profilo && post.immagine_profilo.trim() !== '')
                ? BASE_IMG_URL + post.immagine_profilo
                : 'img/Media/Portrait_Placeholder.png';
        }


        imgProfile.classList.add('channel-pic');
        aProfile.appendChild(imgProfile);
        divInfo.appendChild(aProfile);

        const divChannelInfo = document.createElement('div');
        divChannelInfo.classList.add('video-info-channel');

        const aTitle = document.createElement('a');
        aTitle.href = `post/${encodeURIComponent(post.id_post)}`;
        aTitle.dataset.id = post.id_post;

        const h1 = document.createElement('h1');
        h1.textContent = post.title || 'Senza titolo';
        aTitle.appendChild(h1);

        const aChannelName = document.createElement('a');
        aChannelName.href = `user/${encodeURIComponent(post.canale)}`;
        aChannelName.dataset.channel = post.canale;

        const p = document.createElement('p');
        p.textContent = post.canale || 'Canale sconosciuto';
        aChannelName.appendChild(p);

        divChannelInfo.appendChild(aTitle);
        divChannelInfo.appendChild(aChannelName);

        divInfo.appendChild(divChannelInfo);

        divPost.appendChild(divThumbnail);
        divPost.appendChild(divInfo);

        contentVIDEOLAYOUT.appendChild(divPost);
    }

    if (contentVIDEOLAYOUT.classList.contains('column')) {
        contentVIDEOLAYOUT.classList.remove('column');
    }

    let categorieLinks = document.querySelectorAll('.categorie a');
    
    for (let i = 0; i < categorieLinks.length; i++) {
        if (categorieLinks[i].getAttribute('data-categories') === 'tutti') {
            categorieLinks[i].classList.add('active-button');
        } else {
            categorieLinks[i].classList.remove('active-button');
        }
    }

}



function fetchHomeContent() {
    const navContainer = document.querySelector('.nav-central');
    navContainer.classList.remove('hidden');
    fetch('fetchHomeContent').
        then(onResponse).then(onJsonHomeFeed);

}

document.querySelector('#button-home').addEventListener('click', fetchHomeContent);

const buttonHomeMobile = document.getElementById('button-home-mobile');
if (buttonHomeMobile) {
    buttonHomeMobile.addEventListener('click', fetchHomeContent);
}

fetchHomeContent();

function onJsonCategories(json) {
    const navContainer = document.querySelector('.nav-central');
    navContainer.innerHTML = '';

    const tutti = document.createElement('a');
    tutti.textContent = 'Tutti';
    tutti.classList.add('button-link');
    tutti.setAttribute('data-categories', 'tutti');
    navContainer.appendChild(tutti);

    tutti.addEventListener('click', fetchHomeContent);


    console.log('Aggiunto link fisso: tutti');

    if (!json || json.length === 0) {
        return;
    }

    for (let i = 0; i < json.length; i++) {
        createCategoryLink(json[i], navContainer);
    }


}

function createCategoryLink(category, container) {
    const link = document.createElement('a');
    link.textContent = category;
    link.classList.add('button-link');
    link.setAttribute('data-categories', category.toLowerCase());
    container.appendChild(link);

    link.addEventListener('click', function () {
        filterByCategory(category.toLowerCase());
    });

    console.log('Aggiunto link dinamico:', category.toLowerCase());
}



function filterByCategory(categoria) {
    const category = categoria;
    console.log('Categoria cliccata:', category);

    const videoContent = document.querySelectorAll('.video-content');

    
    for (let i = 0; i < videoContent.length; i++) {
        const video = videoContent[i];
        const videoCategory = video.getAttribute('data-categories');

        if (videoCategory === category) {
            console.log('Mostro il video: Ho trovato corrispondenza: ' + category);
            video.classList.remove('hidden');
            video.classList.add('flex');
        } else {
            video.classList.add('hidden');
            video.classList.remove('flex');
        }
    }
    let categorieLinks = document.querySelectorAll('.categorie a');
    
    for (let i = 0; i < categorieLinks.length; i++) {
        if (categorieLinks[i].getAttribute('data-categories') === categoria) {
            console.log('Bottone :' + categoria);
            categorieLinks[i].classList.add('active-button');
        } else{
            categorieLinks[i].classList.remove('active-button');
        }
    }

}




function fetchCategories() {
    fetch('fetchCategories')
        .then(onResponse)
        .then(onJsonCategories);
}


fetchCategories();


function fetchPreferiti() {
    fetch('fetchPreferiti')
        .then(onResponse)
        .then(onJsonPreferiti);
}


function onJsonPreferiti(json) {
    console.log('JSON ricevuto per home feed:', json);

    const contentVIDEOLAYOUT = document.querySelector('.video-layout');
    const categorie = document.querySelector('.categorie');
    const navCentral = document.querySelector('.nav-central');
    navCentral.classList.add('hidden');

    contentVIDEOLAYOUT.innerHTML = '';
    while (categorie.querySelector('h1')) {
        categorie.querySelector('h1').remove();
    }

    if (json.length === 0) {
        const noResult = document.createElement('h1');
        noResult.textContent = 'Nessun Preferito trovato.';
        contentVIDEOLAYOUT.appendChild(noResult);
        return;
    }
    const h1 = document.createElement('h1');
    h1.textContent = 'Preferiti:';
    categorie.appendChild(h1);

    for (let post of json) {
        const divPost = document.createElement('div');
        divPost.classList.add('video-content');
        divPost.setAttribute('data-categories', post.categoria.toLowerCase());

  
        const divThumbnail = document.createElement('div');
        divThumbnail.classList.add('video-thumbnail');

        const aThumbnail = document.createElement('a');
        aThumbnail.href = `post/${encodeURIComponent(post.id_post)}`;
        aThumbnail.dataset.id = post.id_post;

        const imgThumbnail = document.createElement('img');
        imgThumbnail.alt = 'Immagine copertina post';

        
        imgThumbnail.src = post.percorsoMedia && post.percorsoMedia.trim() !== ''
        ? BASE_IMG_URL + post.percorsoMedia
        : 'img/Media/placeholder.jpg';

        if (post.categoria.toLowerCase() === 'caricamenti') {
            imgThumbnail.src = post.percorsoMedia;
        }


        aThumbnail.appendChild(imgThumbnail);
        divThumbnail.appendChild(aThumbnail);

        
        const divInfo = document.createElement('div');
        divInfo.classList.add('video-info');


        const aProfile = document.createElement('a');
        aProfile.href = `user/${encodeURIComponent(post.autore.username)}`;
        aProfile.dataset.channel = post.autore;

        const imgProfile = document.createElement('img');
        imgProfile.alt = 'Img';

        const profilo = post.autore.immagine?.immagine_profilo?.trim();
        const isValidImage = profilo && profilo !== '';

        if (isValidImage) {
            imgProfile.src = profilo.startsWith('http') ? profilo : BASE_IMG_URL + profilo;
        } else {
            imgProfile.src = 'img/Media/Portrait_Placeholder.png';
        }


        if (post.categoria.toLowerCase() === 'caricamenti' || isValidImage) {
            console.log('CATEGORIA:', post.categoria.toLowerCase(), ',', imgProfile.src, ',', post.autore.username);
        }




        imgProfile.classList.add('channel-pic');
        aProfile.appendChild(imgProfile);
        divInfo.appendChild(aProfile);

        const divChannelInfo = document.createElement('div');
        divChannelInfo.classList.add('video-info-channel');

        const aTitle = document.createElement('a');
        aTitle.href = `post/${encodeURIComponent(post.id_post)}`;
        aTitle.dataset.id = post.id_post;

        const h1 = document.createElement('h1');
        h1.textContent = post.title || 'Senza titolo';
        aTitle.appendChild(h1);

        const aChannelName = document.createElement('a');
        aChannelName.href = `user/${encodeURIComponent(post.autore.username)}`;
        aChannelName.dataset.channel = post.autore;

        const p = document.createElement('p');
        p.textContent = post.autore.username || 'Canale sconosciuto';
        aChannelName.appendChild(p);

        divChannelInfo.appendChild(aTitle);
        divChannelInfo.appendChild(aChannelName);

        divInfo.appendChild(divChannelInfo);

        divPost.appendChild(divThumbnail);
        divPost.appendChild(divInfo);

        contentVIDEOLAYOUT.appendChild(divPost);
    }

    if (contentVIDEOLAYOUT.classList.contains('column')) {
        contentVIDEOLAYOUT.classList.remove('column');
    }
}


const buttonPreferiti = document.querySelector('#buttonPreferiti');
buttonPreferiti.addEventListener('click', fetchPreferiti);
