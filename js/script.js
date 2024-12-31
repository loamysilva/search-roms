// Função para alternar entre temas
function toggleTheme() {
    document.body.classList.toggle('dark-mode');
    const button = document.getElementById('toggle-theme');
    button.classList.toggle('dark-mode');

    if (document.body.classList.contains('dark-mode')) {
        localStorage.setItem('theme', 'dark');
    } else {
        localStorage.setItem('theme', 'light');
    }
}

// Função para redirecionar para uma página aleatória
function surpriseMe() {
    const roms = ["pokemon", "mario", "zelda", "sonic"]; 
    const randomRom = roms[Math.floor(Math.random() * roms.length)]; // Escolhe aleatoriamente
    window.location.href = `resultados.php?q=${randomRom}`; 
}

window.onload = function() {
    if (localStorage.getItem('theme') === 'dark') {
        document.body.classList.add('dark-mode');
        document.getElementById('toggle-theme').classList.add('dark-mode');
    }
}
