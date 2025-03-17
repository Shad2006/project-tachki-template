function handleCategoryClick(e) {
    var li = e.target.closest('li');
    if (!li) return;
    
    var category = li.dataset.category;
    var cards = document.querySelectorAll('.card');
    

    for (var i = 0; i < cards.length; i++) {
        if (cards[i].classList.contains(category)) {
            cards[i].style.display = 'block';
        } else {
            cards[i].style.display = 'none';
        }
    }
    var items = document.querySelectorAll('.list li');
    for (var j = 0; j < items.length; j++) {
        items[j].classList.remove('active');
    }
    li.classList.add('active');
}

document.querySelector('.list ul').addEventListener('click', handleCategoryClick);
