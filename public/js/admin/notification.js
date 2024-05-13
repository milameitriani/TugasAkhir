const notificationCountEl = document.querySelector('#notification-count')
const notificationItemsEl = document.querySelector('#notification-items')

async function fetchNotifications() {
    const res = await fetch(getNotificationsUrl)
    const notification = await res.json()

    const { count, role, pendingOrder, pendingDrink, pendingCooking, finishCooking, finishDrink } = notification

    notificationItemsEl.innerHTML = ''

    createNotificationCount(count)

    if (['pelayanan'].includes(role)) {
        createNotificationItem('pendingOrder', pendingOrder)
    }

    if (['bar'].includes(role)) {
        createNotificationItem('pendingDrink', pendingDrink)
    }

    if (['koki'].includes(role)) {
        createNotificationItem('pendingCooking', pendingCooking)
    }

    if (['pelayanan'].includes(role)) {
        createNotificationItem('finishDrink', finishDrink)
        createNotificationItem('finishCooking', finishCooking)
    }
}

function createNotificationCount(count) {
    notificationCountEl.innerHTML = count
}

function createNotificationItem(type, count) {
    const url = {
        'pendingOrder': `${ordersUrl}?status=pending`,
        'pendingDrink': `${ordersUrl}?drink=0`,
        'pendingCooking': `${ordersUrl}?cooking=0`,
        'finishDrink': `${ordersUrl}?drink=1&status=active`,
        'finishCooking': `${ordersUrl}?cooking=1&status=active`,
    }[type]
    const message = {
        'pendingOrder': 'pesanan menunggu dikonfirmasi',
        'pendingDrink': 'pesanan minuman menunggu diproses',
        'pendingCooking': 'pesanan makanan menunggu diproses',
        'finishCooking': 'pesanan makanan sudah jadi',
        'finishDrink': 'pesanan minuman sudah jadi',
    }[type]

    const a = document.createElement('a')
    a.setAttribute('href', url)
    a.classList.add('dropdown-item')
    a.innerHTML = `${count} ${message}`

    notificationItemsEl.appendChild(a)
}

fetchNotifications()

setInterval(() => {
    fetchNotifications()
}, 5000)