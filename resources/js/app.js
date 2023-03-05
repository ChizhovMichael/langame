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

rubrics();
