import './bootstrap';
import Echo from 'laravel-echo';
window.Pusher = require('pusher-js');

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,
    forceTLS: true
});

Echo.private(`chat.${recipient_id}`)
    .listen('MessageSent', (e) => {
        console.log('New message received:', e.message);
    });
