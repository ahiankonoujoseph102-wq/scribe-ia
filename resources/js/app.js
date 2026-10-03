if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
        navigator.serviceWorker.register('/sw.js').catch(() => {});
    });
}

// Cartes « Bientôt disponible »
const toast = document.getElementById('toast');
let timer;
document.querySelectorAll('[data-soon]').forEach((card) => {
    card.addEventListener('click', () => {
        toast.textContent = 'Bientôt disponible';
        toast.classList.remove('opacity-0', 'translate-y-4');
        clearTimeout(timer);
        timer = setTimeout(() => toast.classList.add('opacity-0', 'translate-y-4'), 2000);
    });
});
