$(document).ready(function() {
    let debounceTimer;

    function debounce(func, wait) {
        return function(...args) {
            clearTimeout(debounceTimer);
            debounceTimer = setTimeout(() => func.apply(this, args), wait);
        };
    }

    function performSearch() {
        $.ajax({
            url: searchRoute,
            method: 'GET',
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                category: $('#category').val(),
                search: $('#search').val()
            },
            dataType: 'JSON',
            success: function(response) {
                console.log(response)
                $('#search-results').empty();
                if (response.data && response.data.length) {
                    $('#search-results').show();
                    response.data.forEach(product => {
                        $('#search-results').append(
                            `<div class="search-item">
                                <a href="/product-details/${product.slug}" class="search-item-link">                                                  
                                    <div class="search-item-details">
                                        <h4 class="search-item-title">${product.product_name}</h4>
                                        <p class="search-item-price">${product.price}</p>
                                    </div>
                                </a>
                            </div>`
                        );
                    });
                } else {
                    $('#search-results').hide();
                }
            },
            error: function() {
                $('#search-results').empty().append(
                    '<p>An error occurred. Please try again.</p>'
                ).show();
            }
        });
    }

    function positionSearchResults() {
        const searchInput = $('#search');
        const searchResults = $('#search-results');
        const offset = searchInput.offset();
        searchResults.css({
            top: offset.top + searchInput.outerHeight(),
            left: offset.left,
            width: searchInput.outerWidth()
        });
    }

    const debouncedSearch = debounce(performSearch, 300);

    $('#search, #category').on('input change', function() {
        debouncedSearch();
        positionSearchResults();
    });

    $(window).on('resize', positionSearchResults);
});
