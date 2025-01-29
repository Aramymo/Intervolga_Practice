const maxRating = 10;
const ratingContainer = document.getElementById('rating');
const ratingValue = ratingContainer.getAttribute('user-rating');

for (let i = 1; i <= maxRating; i++) {
    const label = document.createElement('label');

    const input = document.createElement('input');
    input.type = 'radio';
    input.name = 'rating';
    input.value = i;
    input.id = `rating${i}`;

    if (ratingValue !== undefined && i == ratingValue) {
        input.checked = true;
    }

    const span = document.createElement('span');
    span.className = 'icon';
    span.textContent = '★'.repeat(i);

    label.appendChild(input);
    label.appendChild(span);
    ratingContainer.appendChild(label);
}