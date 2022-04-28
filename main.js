const grantPermission = () => {
    if (!('Notification' in window)) {
        alert('This browser does not support system notifications');
        return;
    }

    if (Notification.permission === 'granted') {
        new Notification('You are already subscribed to web notifications');
        return;
    }

    if (
        Notification.permission !== 'denied' ||
        Notification.permission === 'default'
    ) {
        Notification.requestPermission().then(result => {
            if (result === 'granted') {
                const notification = new Notification(
                    'Awesome! You will start receiving notifications shortly'
                );
            }
        });
    }
};

const x = 1 ;
let wax = "zarga" ;




const showNotification = wax => {
    const title = 'ok'

    new Notification(title);
};

const pusher = new Pusher('d6140180bb29bb63f0bb', {
    cluster: 'eu',
    encrypted: true,
});

const channel = pusher.subscribe('github');
channel.bind('push', x => {
    showNotification(x.payload);
});

const subscribe = document.getElementById('subscribe');
subscribe.addEventListener('click', event => {
    grantPermission();
    subscribe.parentNode.removeChild(subscribe);
});


