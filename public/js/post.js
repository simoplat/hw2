const postMeta = document.querySelector('meta[name="id_post"]');
const id_post = postMeta.content;
const meta_element = document.querySelector('meta[name="csrf-token"]');
const csrf_token = meta_element.content;

if (csrf_token) console.log('valore token' + csrf_token);

function fetchPost() {
    if (!id_post) {
        console.error('ID del post mancante nella URL');
        return;
    }
    let url = BASE_URL + 'fetchPost/' + encodeURIComponent(id_post);
    fetch(url)
        .then(Onresponse)
        .then(onJson);
}

function Onresponse(response) {
    console.log('Response received');
    if (!response.ok) return null;
    return response.json();
}

function onJson(json) {
    const postContent = document.getElementById('post-content');
    const titleContainer = document.querySelector('.header-title');
    const author = document.querySelector('.author');
    const authorNameElem = document.querySelector('.author-name');
    const authorUsernameElem = document.querySelector('.author-username');
    const cover = document.querySelector('.cover');
    const preferitoBtn = document.querySelector('.preferito-btn');
    const preferitoText = preferitoBtn.querySelector('.btn-text');


    const heartIcon = document.getElementById('heart-icon');

    if (json?.preferito) {
        preferitoText.textContent = 'Rimuovi dai preferiti';
        preferitoBtn.dataset.set = 'yes';
        if (heartIcon) {
            heartIcon.src = BASE_URL + 'img/Media/heart_full.svg';
            heartIcon.alt = BASE_URL + 'img/Rimuovi dai preferiti';
        }
    } else {
        preferitoText.textContent = 'Aggiungi ai preferiti';
        preferitoBtn.dataset.set = 'no';
        if (heartIcon) {
            heartIcon.src = BASE_URL + 'img/Media/heart_empty.svg';;
            heartIcon.alt = 'Aggiungi ai preferiti';
        }
    }


    if (preferitoBtn) preferitoBtn.addEventListener('click', togglePreferito);

    if (!postContent || !titleContainer || !authorNameElem || !authorUsernameElem || !author) {
        console.error('Contenitori mancanti nel DOM');
        return;
    }


    postContent.innerHTML = '';
    titleContainer.innerHTML = '';
    cover.innerHTML = '';

    if (!json || json.error) {
        const h1 = document.createElement('h1');
        h1.textContent = 'Nessun post';
        titleContainer.appendChild(h1);
        return;
    }

    const postTitle = document.createElement('h1');
    postTitle.classList.add('post-title');
    postTitle.textContent = json.title;
    titleContainer.appendChild(postTitle);


    author.innerHTML = '';

    const authorLink = document.createElement('a');
    authorLink.href = BASE_URL + `user/${encodeURIComponent(json.autore)}`;
    authorLink.classList.add('author');


    const profileImage = document.createElement('img');
    if (json.categoria && json.categoria.toLowerCase() === 'caricamenti') {
        profileImage.src = json.immagine_profilo;
    } else {

        profileImage.src = json.immagine_profilo ? BASE_URL + 'img/' + json.immagine_profilo : BASE_URL + '/Media/Portrait_Placeholder.png';
    }

    if (json.immagine_profilo === ''){
        console.log('Immagine NOOOOOOOO');
        profileImage.src = BASE_URL + 'img/Media/Portrait_Placeholder.png';
    }

    profileImage.alt = `Foto profilo di ${json.name}`;
    profileImage.classList.add('author-img');


    const authorInfo = document.createElement('div');
    authorInfo.classList.add('author-info');

    const authorName = document.createElement('p');
    authorName.classList.add('author-name');
    authorName.textContent = `${json.name} ${json.surname}`;

    const authorUsername = document.createElement('p');
    authorUsername.classList.add('author-username');
    authorUsername.textContent = `@${json.autore}`;

    authorInfo.appendChild(authorName);
    authorInfo.appendChild(authorUsername);


    authorLink.appendChild(profileImage);
    authorLink.appendChild(authorInfo);
    author.appendChild(authorLink);


    const coverImg = document.createElement('img');
    coverImg.alt = 'Immagine copertina post';
    coverImg.classList.add('cover-img');

    const mediaPath = json.percorsoMedia && json.percorsoMedia.trim() !== '' ? json.percorsoMedia : null;


    if (mediaPath) {
        coverImg.src = BASE_URL + 'img/' + mediaPath;

        cover.appendChild(coverImg);
    }


    const postDiv = document.createElement('div');
    postDiv.classList.add('post');

    if (json.categoria) {
        const category = document.createElement('span');
        category.classList.add('category');
        category.textContent = '#' + json.categoria;
        postDiv.appendChild(category);
    }

    if(json.categoria && json.categoria.toLowerCase() === 'caricamenti') {
        coverImg.src = mediaPath;
    }

    const content = document.createElement('p');
    content.textContent = json.contenuto;
    postDiv.appendChild(content);

    postContent.appendChild(postDiv);
}


fetchPost();
aggiornaCommenti();

const commentForm = document.getElementById('comment-form');
commentForm.addEventListener('submit', handleCommentSubmit);

const commentSection = document.querySelector('.comments-section');

function aggiornaCommenti() {
    if (!id_post) {
        console.error('ID del post mancante nella URL');
        return;
    }
    let url = BASE_URL + 'fetchCommenti/' + + encodeURIComponent(id_post);

    fetch(url).
        then(Onresponse).
        then(onJsonCommenti);
}


function onJsonCommenti(json) {
    if (!json) return;

    const oldComments = document.querySelectorAll('.comment');
    for (let i = 0; i < oldComments.length; i++) {
        oldComments[i].remove();
    }

    // Aggiungi commenti
    for (let i = 0; i < json.length; i++) {
        let commento = json[i];

        const commentDiv = document.createElement('div');
        commentDiv.classList.add('comment');

        const p = document.createElement('p');

        const author = document.createElement('a');
        author.classList.add('username');
        author.href = BASE_URL + 'user/' + encodeURIComponent(commento.username);
        author.textContent = '@' + commento.username + ':';

        p.appendChild(author);
        p.append(' ' + commento.testo);

        commentDiv.appendChild(p);
        commentSection.appendChild(commentDiv);
    }
}



function responseAggiungiCommento(response) {
    if (!response) return;
    console.log('Response received for comment:', response);
    if (commentForm) commentForm.reset();
    aggiornaCommenti();
}


function handleCommentSubmit(event) {
    event.preventDefault();

    const formData = new FormData(commentForm);


    if (id_post) {
        formData.append('id_post', id_post);
        formData.append('_token', csrf_token);
        let url = BASE_URL + 'aggiungiCommento';
        fetch(url, {
            method: 'POST',
            body: formData
        })
            .then(Onresponse)
            .then(responseAggiungiCommento)
    } else {
        console.error("ID post non trovato nell'URL");
    }
}


function togglePreferito() {
    console.log('TOGGLE id_POST: ' + id_post);

    if (id_post) {
        const formDataPreferito = new FormData();
        formDataPreferito.append('id_post', id_post);
        formDataPreferito.append('_token', csrf_token);

        let Prefurl = BASE_URL + 'togglePreferito';

        fetch(Prefurl, {
            method: 'POST',
            body: formDataPreferito
        })
            .then(Onresponse).then(updatePreferitoUI)
    } else {
        console.error("ID post non trovato nell'URL");
    }

}




function updatePreferitoUI(json) {
    console.log('Preferito aggiornato:', json);
    const preferitoBtn = document.querySelector('.preferito-btn');
    const spanPref = document.querySelector('.btn-text');
    const preferitoIcon = document.getElementById('heart-icon');

    console.log('Preferito Button:', preferitoBtn);
    if (!preferitoBtn || !spanPref) {
        console.error('Preferito non trovato nel DOM');
        return;
    }

    if (json.preferito === true) {
        spanPref.textContent = 'Rimuovi dai preferiti';
        preferitoBtn.dataset.set = 'yes';
        preferitoIcon.src = BASE_URL + 'img/Media/heart_full.svg';
    } else if (json.preferito === false) {
        spanPref.textContent = 'Aggiungi ai preferiti';
        preferitoBtn.dataset.set = 'no';
        preferitoIcon.src = BASE_URL + 'img/Media/heart_empty.svg';
    }

}
