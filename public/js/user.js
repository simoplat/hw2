
const meta_channel = document.querySelector('meta[name="channel"]');
const user_channel = meta_channel.content;

function Onresponse(response) {
    console.log('Response received');
    if (!response.ok) return null;
    return response.json();
}

function getPostUrl(id_post) {
    return BASE_URL + 'post/' + encodeURIComponent(id_post);
}

function fetchChannelContent() {
    const channelMeta = document.querySelector('meta[name="channel"]');
    const channelUser = channelMeta.content;

    let url = BASE_URL + 'fetchChannelContent';

    if (channelUser) {
        url += '/' + encodeURIComponent(channelUser);
    }
    console.log(url);

    fetch(url)
        .then(Onresponse)
        .then(onJson);
}

function onJsonDeletePost(json) {
    if (json.error) {
        console.error('Errore durante l\'eliminazione del post:', json);
        return;
    } else console.log('Post eliminato con successo:', json);
    fetchChannelContent();
}

function eliminaPost(event) {
    const postId = event.target.dataset.postId;
    console.log('Elimina post ' + postId);
    fetch(BASE_URL + 'deletePost/' + encodeURIComponent(postId))
        .then(Onresponse)
        .then(onJsonDeletePost);
}

function renderPost(post, container) {
    let postDiv = document.createElement('div');
    postDiv.classList.add('post');

    let postLink = document.createElement('a');
    postLink.href = getPostUrl(post.id_post);
    postLink.setAttribute('data-id', post.id_post);

    let title = document.createElement('h4');
    title.textContent = post.title;

    let content = document.createElement('p');
    content.textContent = post.contenuto;

    postLink.appendChild(title);
    postLink.appendChild(content);

    
    if(post.elimina) {
        const deleteBtn = document.createElement('button');
        deleteBtn.textContent = 'Elimina Post'; 
        deleteBtn.dataset.postId = post.id_post;
        deleteBtn.addEventListener('click', eliminaPost);
        postDiv.appendChild(deleteBtn);
    }

    postDiv.appendChild(postLink);
    container.appendChild(postDiv);

}

function onJson(json) {
    let profileContent = document.getElementById('profile-content');
    profileContent.innerHTML = '';

    /* if (json.profilo && json.profilo.name && json.profilo.surname) {
        let userDetails = document.querySelector('.user-details');
        userDetails.innerHTML = '';

        let nameElem = document.createElement('h2');
        nameElem.id = 'username';
        nameElem.textContent = json.profilo.name + ' ' + json.profilo.surname;

        let usernameElem = document.createElement('p');
        usernameElem.id = 'user-tag';
        if (json.profilo.username) {
            usernameElem.textContent = '@' + json.profilo.username;
        } else {
            usernameElem.textContent = '@utente_sconosciuto';
        }

        userDetails.appendChild(nameElem);
        userDetails.appendChild(usernameElem);
    } */

    let heading = document.createElement('h3');
    heading.textContent = 'Post recenti';
    profileContent.appendChild(heading);

    let profPic = document.getElementById('profile-pic-id');

    if (json.profilo.immagine_profilo && json.profilo.immagine_profilo.startsWith('https')) {
        profPic.src = json.profilo.immagine_profilo;
    } else if (profPic && json.profilo) {
        profPic.classList.add('profile-pic');
        profPic.src = BASE_URL + 'img/' + json.profilo.immagine_profilo;
        profPic.setAttribute('data-type', 'SET');
    }

    if(json.profilo.immagine_profilo ===''){
        profPic.src = BASE_URL + 'img/Media/Portrait_Placeholder.png';
    }


    let coverPhoto = document.getElementById('cover-photo-id');
    if (coverPhoto && json.profilo) {
        coverPhoto.classList.add('cover-photo');
        coverPhoto.src = BASE_URL + 'img/' + json.profilo.immagine_copertina;
        coverPhoto.setAttribute('data-type', 'SET');
    }

    if (!json.post || json.post.length === 0) {
        let noPosts = document.createElement('p');
        noPosts.textContent = 'Nessun post trovato.';
        noPosts.id="noContent";
        profileContent.appendChild(noPosts);
        return;
    }

    for (let i = 0; i < json.post.length; i++) {
        renderPost(json.post[i], profileContent);
    }
}

fetchChannelContent();

const iscrivitiBtn = document.querySelector('.btn-iscrizione');
if (iscrivitiBtn) {
    iscrivitiBtn.addEventListener('click', toggleIscritto);
}

function toggleIscritto() {
    console.log('TOGGLE id canale: ' + user_channel);

    if (user_channel) {
        const formDataToggle = new FormData();
        formDataToggle.append('user', user_channel);
        formDataToggle.append('_token', csrf_token);
        console.log(formDataToggle);

        let url = BASE_URL + 'toggleIscritto';

        fetch(url, {
            method: 'POST',
            body: formDataToggle
        })
            .then(Onresponse).then(updateIscrittoUI)
    } else {
        console.error("ID post non trovato nell'URL");
    }

}


function updateIscrittoUI(json) {
    const iscrivitiTxt = document.querySelector('.btn-text');
    if (iscrivitiBtn) {

        if (json.iscritto) {
            iscrivitiBtn.setAttribute('data-set', 'yes');
            iscrivitiTxt.textContent = 'Disiscriviti dal canale';

        } else if (json.iscritto === false) {
            iscrivitiBtn.setAttribute('data-set', 'no');
            iscrivitiTxt.textContent = 'Iscriviti al canale';
        }

    }

}

/* checkIscritto();

function checkIscritto() {
    

    const formDataCheckIscritto = new FormData();
    console.log('CHECK id canale: ' + user_channel);
    formDataCheckIscritto.append('user', user_channel);
    formDataCheckIscritto.append('_token', csrf_token);
    let url = BASE_URL + 'checkChannel';

    fetch(url, {
        method: 'POST',
        body: formDataCheckIscritto
    }).then(Onresponse).then(handleIscritto);
} */


/* function handleIscritto(json) {
    if (json === true || json.iscritto === true) {
        console.log("Iscritto? true");
        const iscTxt = document.getElementById('isc-text');
        if (iscTxt) {
            iscTxt.textContent = 'Disiscriviti dal canale';
            iscrivitiBtn.setAttribute('data-set', 'yes');
        }
    } else if (json === false || json.iscritto === false) {
        console.log("Iscritto? false");
        const iscTxt = document.getElementById('isc-text');
        if (iscTxt) {
            iscTxt.textContent = 'Iscriviti al canale';
            iscrivitiBtn.setAttribute('data-set', 'no');
        }
    } else if (json === 'TeStesso' || json.iscritto === 'TeStesso') {
        console.log("Non puoi iscriverti al tuo stesso canale");
        iscrivitiBtn.classList.add('hidden');
    }
} */