// Service worker minimal : requis pour l'installation sur Android.
// Il ne met rien en cache pour l'instant (l'application a besoin d'internet).
self.addEventListener('install', () => self.skipWaiting());
self.addEventListener('activate', (event) => event.waitUntil(self.clients.claim()));
self.addEventListener('fetch', () => {});
