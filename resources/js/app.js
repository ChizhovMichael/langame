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

async function posts() {
    let container = document.getElementById('posts-container');

    if (!container)
        return;

    try {
        const response = await axios.get(`/api/posts`);
        const data = response.data.data;

        data.forEach((post) => {
            let rubrics = post.rubrics.map((rubric) => {
                return `<span class="badge bg-light text-dark me-1">${rubric.name}</span>`
            })
            let card = `
                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">${post.title}</h5>
                            <p class="card-text">${post.description}</p>
                            ${rubrics.join('')}
                        </div>
                    </div>
                </div>
            `
            container.insertAdjacentHTML('beforeend', card);
        })
    } catch (error) {
        console.error(error)
    }
}

rubrics();
posts();
