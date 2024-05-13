const category = new Tagify(document.querySelector('[name=category_id]'), {
    mode: 'select',
    whitelist: [],
    originalInputValueFormat: values => values[0].id
})

const price = new Inputmask({ alias: 'currency' }).mask(document.querySelector('[name=price]'))

let controller

const searchCategory = (name = '') => {
    category.whitelist = null

    controller && controller.abort()
    controller = new AbortController

    category.loading(true).dropdown.hide()

    const type = getType()

    fetch(`${getCategoryUrl}?name=${name}&type=${type}`, { signal: controller.signal })
        .then(res => res.json())
        .then(res => res.map(({ id, name: value }) => ({ id, value })))
        .then(data => {
            category.whitelist = data
            category.loading(false).dropdown.show(name)
        })
}

category.on('input', e => searchCategory(e.detail.value))
    .on('focus', e => searchCategory(e.detail.tagify.value[0]?.value))
    .on('change', e => {
        if (e.detail.value) {
            setCategory(e.detail.value)
        }
    })
    .on('remove', removeCategory)

price.el.onkeyup = e => setPrice(e.target.value)

window.addEventListener('load', () => {
    category.removeAllTags()

    category.addTags([ { id: categoryVal.id, value: categoryVal.name } ])
})
window.addEventListener('updated-type', () => category.removeAllTags())