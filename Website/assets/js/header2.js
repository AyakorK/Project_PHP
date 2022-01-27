document.addEventListener('click', (e) => {
    if (e.target.classList.contains('logo') && !window.location.href.includes('Functions')) {
        window.location.href = 'homepage.php';
    } else if (e.target.classList.contains('logo')) {
        window.location.href = '../homepage.php'
    }

});

document.addEventListener('mouseover', (e) => {
    if (e.target.classList.contains('logo')) {
        e.target.style.cursor = 'pointer';
    }
});

document.addEventListener('dblclick', (e) => {
    if (e.target.classList.contains('user')) {
        window.location.href = 'https://www.youtube.com/watch?v=UCOpNRwJ0mQ&ab_channel=ThePeahillFarm';
    }
});