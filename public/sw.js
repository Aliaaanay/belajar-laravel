// Service Worker Auto-Cleanup
self.addEventListener('install', () => {
    self.skipWaiting();
});

self.addEventListener('activate', (event) => {
    self.registration.unregister().then(() => {
        return self.clients.matchAll();
    }).then((clients) => {
        clients.forEach(client => client.navigate(client.url));
    });
});
