const table = new Tagify(document.querySelector('[name=table_id]'), {
    mode: 'select',
    whitelist: [],
    originalInputValueFormat: values => values[0].id
})

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

table.on('input', e => search({ name: e.detail.value, ...tableSearch }))
    .on('focus', e => search({ name: e.detail.tagify.value[0]?.value, ...tableSearch }))
    .on('change', e => {
        if (e.detail.value) {
            setTable(e.detail.value)
        }
    })
    .on('remove', removeTable)

window.addEventListener('load', () => {
    table.removeAllTags()
})

window.addEventListener('reset', () => {
    table.removeAllTags()
})

window.addEventListener('confirmed', (e) => {
    const url = printOrderPerTypeUrl.replace(':invoice', e.detail.invoice)

    window.open(url, '_blank')
})