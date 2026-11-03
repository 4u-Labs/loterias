// Service Worker for Super Loterias PWA
const CACHE_NAME = 'super-loterias-cache-v1';
const ASSETS_TO_CACHE = [
  'manifest.json',
  'icons/icon-192.png',
  'icons/icon-512.png'
];

// Install Event
self.addEventListener('install', (event) => {
  event.waitUntil(
    caches.open(CACHE_NAME).then((cache) => {
      console.log('[Service Worker] Caching app shell assets');
      return cache.addAll(ASSETS_TO_CACHE);
    }).then(() => self.skipWaiting())
  );
});

// Activate Event
self.addEventListener('activate', (event) => {
  event.waitUntil(
    caches.keys().then((keyList) => {
      return Promise.all(keyList.map((key) => {
        if (key !== CACHE_NAME) {
          console.log('[Service Worker] Removing old cache', key);
          return caches.delete(key);
        }
      }));
    }).then(() => self.clients.claim())
  );
});

// Fetch Event (Network-First Strategy for PHP app)
self.addEventListener('fetch', (event) => {
  // Avoid caching non-GET requests
  if (event.request.method !== 'GET') return;

  // Only handle http/https requests (prevents chrome-extension://, etc. errors)
  if (!event.request.url.startsWith('http')) return;

  const url = new URL(event.request.url);

  // For app pages/APIs, try network first, fallback to cache
  event.respondWith(
    fetch(event.request)
      .then((response) => {
        // If valid response, clone and cache it for static assets
        if (response && response.status === 200 && response.type === 'basic') {
          const responseToCache = response.clone();
          caches.open(CACHE_NAME).then((cache) => {
            cache.put(event.request, responseToCache);
          });
        }
        return response;
      })
      .catch(() => {
        // Offline: try to return cache item
        return caches.match(event.request);
      })
  );
});
