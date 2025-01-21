let reviewBlocks = document.querySelectorAll('.row.review_block');
console.log('ТЫ ЕБАНУТЫЙ ДАЙ МНЕ ПОЛУЧИТЬ ЭЛЕМЕНТЫ');



// document.onload = showUser150(1);
// console.log('hello?');
// // Функция для удаления блока
// function showUser150(str)
// {
//     const reviewBlocks = document.querySelectorAll('.row.review_block');
//     console.log(reviewBlocks);
// // Проходим по каждому блоку
//     reviewBlocks.forEach(function(block){
//         console.log(block);
//         // Находим div с классом 'row-md-4' внутри текущего блока
//         const rowMd4 = block.querySelector('div.row-md-4');
//
//         if (rowMd4) {
//             console.log('aboba');
//             // Создаем новый div
//             const newDiv = document.createElement('div');
//
//             // Создаем кнопку
//             const button = document.createElement('button');
//             button.textContent = 'Удалить'; // Текст кнопки
//             button.onclick = () => Delete(block.id); // Устанавливаем обработчик события onclick
//
//             // Добавляем кнопку в новый div
//             newDiv.appendChild(button);
//
//             // Вставляем новый div после div с классом 'row-md-4'
//             rowMd4.parentNode.insertBefore(newDiv, rowMd4.nextSibling);
//         }
//     });
// }
// function Delete(id) {
//     console.log("Удаляем блок с ID:", id);
//     // Здесь можно добавить логику для удаления блока
// }
//
// // Получаем все div блоки с классом 'row review_block'