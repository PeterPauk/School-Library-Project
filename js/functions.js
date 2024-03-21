function truncateText(selector, maxLength) {
    var elements = document.querySelectorAll(selector);
    elements.forEach(function(element) {
        var text = element.textContent.trim();
        if (text.length > maxLength) {
            element.textContent = text.slice(0, maxLength) + '...';
        }
    });
}
truncateText('.book-desc', 120);