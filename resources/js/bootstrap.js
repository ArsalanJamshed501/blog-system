/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;
// window.Pusher = require("pusher-js");

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER ?? 'ap1',
    // forceTLS: true,
    // key: process.env.MIX_PUSHER_APP_KEY,
    // cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    encrypted: true,
//     wsHost: import.meta.env.VITE_PUSHER_HOST ? import.meta.env.VITE_PUSHER_HOST : `ws-${import.meta.env.VITE_PUSHER_APP_CLUSTER}.pusher.com`,
//     wsPort: import.meta.env.VITE_PUSHER_PORT ?? 80,
//     wssPort: import.meta.env.VITE_PUSHER_PORT ?? 443,
//     forceTLS: (import.meta.env.VITE_PUSHER_SCHEME ?? 'https') === 'https',
//     enabledTransports: ['ws', 'wss'],
});

window.Echo.channel("notifications")
    .listen(".new-notification", (data) => {
        const notificationList = document.getElementById("notification-list");
        const notifCount = document.getElementById("notif-count");

        // Add new notification to the dropdown
        let newNotif = document.createElement("li");
        newNotif.classList.add("border-b", "px-4", "py-2");
        newNotif.innerHTML = `<a href="/notifications/read/${data.id}" class="block text-gray-800">${data.message}</a>`;

        notificationList.prepend(newNotif);
        
        // Update unread count
        notifCount.innerText = `(${parseInt(notifCount.innerText.match(/\d+/)[0]) + 1})`;
    });
