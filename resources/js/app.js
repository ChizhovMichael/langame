require('./bootstrap');

async function rubrics() {
    let elems = document.getElementsByClassName('js-rubrics');

    if (elems.length === 0)
        return;

    try {
        const response = await axios.get(`/api/rubrics`);
        const data = response.data.data;

        data.sort(function(a, b) {
            return parseFloat(a.parent_id) - parseFloat(b.parent_id)
        });

        for (let i = 0; i < elems.length; i++) {
            if (elems[i].hasAttribute('data-default')) {
                elems[i].add(new Option('none', ''), undefined);
            }
            data.forEach((rubric) => {
                let parent = data.find(x => x.id === rubric.parent_id);
                let option = new Option(rubric.name, rubric.id);

                if (parent) {
                    option = new Option(`${parent.name} | ${rubric.name}`, rubric.id);
                }
                elems[i].add(option, undefined);
            });
        }
    } catch (error) {
        console.error(error)
    }
}

function card(title, description, rubrics, state) {
    return `
        <div class="col-md-6 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">
                        ${title}` +
                        (state ? '<span class="badge bg-primary ms-2">New</span>' : '') +
                    `</h5>
                    <p class="card-text">${description ?? ''}</p>
                    ${rubrics.join('')}
                </div>
            </div>
        </div>
    `;
}

function render(data) {
    let container = document.getElementById('posts-container');

    if (!container)
        return;
    container.innerHTML = "";

    data.forEach((post) => {
        let rubrics = post.rubrics.map((rubric) => {
            return `<span class="badge bg-light text-dark me-1">${rubric.name}</span>`
        })
        container.insertAdjacentHTML('beforeend', card(
            post.title,
            post.description,
            rubrics
        ));
    })
}

async function posts() {
    try {
        const response = await axios.get(`/api/posts`);

        render(response.data.data);
    } catch (error) {
        console.error(error)
    }
}

function getSelectValues(select) {
    let result = [];
    let options = select && select.options;
    let opt;

    for (let i = 0, len = options.length; i < len; i++) {
        opt = options[i];

        if (opt.selected) {
            result.push(opt.value);
        }
    }
    return result;
}

function create() {
    let container = document.getElementById('posts-container');

    document.getElementById('js-async').addEventListener('click', async function (e) {
        e.preventDefault();

        let request = {
            title: document.getElementById('async-title').value,
            description: document.getElementById('async-description').value,
            content: document.getElementById('async-content').value,
            category: getSelectValues(document.getElementById('async-category')),
        }

        if (!request.title.length) {
            alert('Title required');
            return false;
        }

        try {
            const response = await axios.post(`/api/posts`, request);
            const data = response.data.data;

            let rubrics = data.rubrics.map((rubric) => {
                return `<span class="badge bg-light text-dark me-1">${rubric.name}</span>`
            })

            container.insertAdjacentHTML('afterbegin', card(
                data.title,
                data.description,
                rubrics,
                true
            ));
        } catch (error) {
            console.error(error)
        }
    })
}

// search
function search() {
    let search = document.getElementById('search');
    let delay;

    search.addEventListener('input', function () {
        clearTimeout(delay);
        delay = setTimeout(async function() {
            try {
                const response = await axios.post(`/api/search`, {
                    search: search.value
                });
                render(response.data.data);
            } catch (error) {
                console.log(error);
            }
        }, 1000);
    })
}

rubrics();
posts();
create();
search();
