  const header = document.getElementById('main-header');
  const images = [
    'img/Media/welcomeWallpaper.jpg',
    'img/Media/welcomeWallpaper2.jpg',
    'img/Media/welcomeWallpaper3.jpg'
  ];

  let index = 0;

  function changeBackground() {
    header.style.backgroundImage = `url('${images[index]}')`;
    index = (index + 1) % images.length;
  }

  changeBackground();
  setInterval(changeBackground, 5000);