const tagify = {
    mode: 'select',
    whitelist: [],
    originalInputValueFormat: values => values[0].id
}

const table = new Tagify(document.querySelector('[name=table_id]'), {...tagify})
const user = new Tagify(document.querySelector('[name=user_id]'), {...tagify})

let controller

const search = ({ name = '', el, url, transform }) => {
    el.whitelist = null

    controller && controller.abort()
    controller = new AbortController

    el.loading(true).dropdown.hide()

    fetch(`${url}?name=${name}`, { signal: controller.signal })
        .then(res => res.json())
        .then(transform)
        .then(data => {
            el.whitelist = data
            el.loading(false).dropdown.show(name)
        })
}

const tableSearch = {
    el: table,
    url: getTableUrl,
    transform: res => res.map(({ id, no: value }) => ({ id, value }))
}

const userSearch = {
    el: user,
    url: getUserUrl,
    transform: res => res.map(({ id, name: value }) => ({ id, value }))
}

table.on('input', e => search({ name: e.detail.value, ...tableSearch }))
    .on('focus', e => search({ name: e.detail.tagify.value[0]?.value, ...tableSearch }))
    .on('change', e => {
        if (e.detail.value) {
            setTable(e.detail.value)
        }
    })
    .on('remove', removeTable)

user.on('input', e => search({ name: e.detail.value, ...userSearch }))
    .on('focus', e => search({ name: e.detail.tagify.value[0]?.value, ...userSearch }))
    .on('change', e => {
        if (e.detail.value) {
            setUser(e.detail.value)
        }
    })
    .on('remove', removeUser)

window.addEventListener('load', () => {
    table.removeAllTags()
    user.removeAllTags()
})

window.addEventListener('saved', (e) => {
    const invoice = e.detail.invoice
    const redirectDetailUrl = detailUrl.replace(':invoice', invoice)
    
    if (e.detail.withPrint) {
        if (e.detail.update) {
            const redirectPrintUpdateUrl = printUpdateUrl.replace(':invoice', invoice)

            window.open(redirectPrintUpdateUrl, '_blank')
        }

        const redirectPrintUrl = printUrl.replace(':invoice', invoice)

        window.open(redirectPrintUrl, '_blank')
    }
    
    setTimeout(() => window.open(redirectDetailUrl, '_self'))
})

window.addEventListener('updated-user-id', e => {
    user.removeAllTags()

    if (e.detail.user) {
        user.addTags([ { id: e.detail.user.id, value: e.detail.user.name } ])
    }
})