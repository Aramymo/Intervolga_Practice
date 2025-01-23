//Выполнение функции при загрузке страницы
displayReviewList(1);
async function displayReviewList(id) {
    try {
        let elementsData = await getElements(id); // Используем await для асинхронного вызова
        document.getElementById('reviews').innerHTML = '';
        document.getElementById('pages').innerHTML = '';

        // Отображение страниц
        for (let num_of_pages = 1; num_of_pages <= elementsData[0]['number_of_pages']; num_of_pages++) {
            let pageLink = document.createElement('a');
            pageLink.id = num_of_pages;
            pageLink.className = 'page_link';
            pageLink.onclick = () => displayReviewList(num_of_pages);
            pageLink.textContent = num_of_pages;
            document.getElementById("pages").appendChild(pageLink);
        }

        // Запись отзывов
        for (const element of elementsData) { // Используем for...of для перебора массива
            let reviewBlock = document.createElement('div');
            reviewBlock.className = 'row review_block';
            reviewBlock.id = element['review_id'];
            element['satisfaction'] = element['satisfaction'] === 'true' ? 'Да' : 'Нет';
            element['comment'] = element['comment'] ? element['comment'] : 'Комментарий не оставлен';
            reviewBlock.innerHTML = `
                <div class='row-md-4'>
                    <h3>${element['username']}</h3>
                </div>
                ${addAdminPanel(element['review_id'])}
                <div class='row-md-8'>
                <p>Почта для связи: ${element['email'] || 'Не указано'}</p>
                    <h5>${element['rating']}/10</h5>
                    <p>Обозреваемый товар: ${element['reviewed_product'] || 'Не указано'}</p>
                    <p>Товаром доволен? ${element['satisfaction']}</p>
                    <p>${element['comment']}</p>
                </div>
            `;
            document.getElementById('reviews').appendChild(reviewBlock);
        }
    } catch (error) {
        console.error("Ошибка при получении данных:", error);
    }
}

async function getElements(page) {
    const response = await $.ajax({
        url: `http://localhost:8888/api/feedbacks/page=${page}`,
        type: "GET",
        dataType: "json",
        cache: false,
    });
    return response;
}

function addAdminPanel(id) {
    let adminPanel = "";

    if (typeof deleteRewiew === 'function' && typeof redirectToIdForm === 'function') {
        adminPanel = "<button class='btn btn-danger' onclick='deleteRewiew("+ id +")'> Удалить отзыв</button>" +
                "<button class='btn btn-info' onclick='redirectToIdForm("+ id +")'> Редактировать отзыв</button>";
    }

    return adminPanel;
}