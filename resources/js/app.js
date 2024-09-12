import './bootstrap';

const input = document.querySelector('.search-input')
const list = document.querySelector('.search-list')
const loader = document.querySelector('.input-loader')

const debounce = (func, timeout = 300) => {
    let timer
    return (...args) => {
        clearTimeout(timer)
        timer = setTimeout(() => { func.apply(this, args); }, timeout)
    }
}

const searchingFromInput = async () => {
    const query = input.value

    return fetch(`/search?q=${query}`)
        .then(res => res.json())
        .then(res => {
            loader.classList.add('hidden')

            if (res.errors) {
                list.innerHTML = `<div class="flex items-center justify-center px-4 py-12">
                    ${res.errors.list.join(', ')}
                </div>`
                return
            }

            list.innerHTML = res.data.map(item => `
            <a href="/?s=${item.slug}&l=${item.language_code}" class="flex items-center justify-between px-4 py-2 border-b hover:bg-gray-100 last:border-none autocomplete-items">
                <span>${item.daily_text}</span>
                <span class="text-xs text-gray-500">${item.language}</span>
            </a>
        `).join('')
        })
}

const searchingFromInputJson = async () => {
    const query = input.value
    return fetch(`/search?q=${query}`).then(res => res.json())
}

const searching = debounce(() => searchingFromInput())

var currentFocus = -1;

input.addEventListener('input', () => {
    currentFocus = -1;

    if (input.value == '') {
        input.classList.add('bg-gray-100')
    } else {
        input.classList.remove('bg-gray-100')
    }

    loader.classList.remove('hidden')
    searching()
})

input.addEventListener('keydown', function (e) {
    var x = document.getElementById('autocomplete-list')
    if (x) x = x.getElementsByTagName('a')

    if (e.keyCode == 40) { // down
        currentFocus++;
        addActive(x);
    } else if (e.keyCode == 38) { // up
        currentFocus--;
        addActive(x);
    } else if (e.keyCode == 13) {
        if (currentFocus > -1) {
            if (x) x[currentFocus].click();
        }
    }
});


function addActive(x) {
    if (!x) return false;
    removeActive(x);

    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);

    x[currentFocus].classList.add('bg-gray-100');
}

function removeActive(x) {
    for (var i = 0; i < x.length; i++) {
        x[i].classList.remove('bg-gray-100');
    }
}

function closeAllLists(elmnt) {
    var x = document.getElementsByClassName('autocomplete-items');
    for (var i = 0; i < x.length; i++) {
        x[i].classList.remove('bg-gray-100');
    }
}

/*execute a function when someone clicks in the document:*/
document.addEventListener("click", function (e) {
    closeAllLists(e.target);
});
