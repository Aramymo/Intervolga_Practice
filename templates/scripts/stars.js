const maxRating = 10; // Максимальное количество звёзд
const ratingContainer = document.getElementById('rating');

for (let i = 1; i <= maxRating; i++) {
    const label = document.createElement('label');

    const input = document.createElement('input');
    input.type = 'radio';
    input.name = 'rating';
    input.value = i;
    input.id = `rating${i}`;

    const span = document.createElement('span');
    span.className = 'icon';
    span.textContent = '★'.repeat(i); // Заполнение звёздочками

    label.appendChild(input);
    label.appendChild(span);
    ratingContainer.appendChild(label);
}