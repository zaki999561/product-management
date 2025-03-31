document.addEventListener('DOMContentLoaded', function () {
    document.addEventListener('click', function (event) {
        if (event.target.classList.contains('delete-button')) {
            const productId = event.target.dataset.id;
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            if (confirm('削除しますか？')) {
                fetch(`/products/${productId}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    body: JSON.stringify({ _token: csrfToken })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        document.querySelector(`tr[data-id="${productId}"]`).remove();
                    } else {
                        alert('削除に失敗しました。');
                    }
                })
                .catch(error => {
                    console.error('削除エラー:', error);
                    alert('削除処理中にエラーが発生しました。');
                });
            }
        }
    });
});


document.addEventListener('DOMContentLoaded', function () {
    function toNumberOrNull(value) {
        return value === "" ? null : Number(value);
    }

    function reloadProducts() {
        let keyword = $('input[name="keyword"]').val();
        let companyId = $('select[name="company_id"]').val();
        let priceMin = $('input[name="price_min"]').val();
        let priceMax = $('input[name="price_max"]').val();
        let stockMin = $('input[name="stock_min"]').val();
        let stockMax = $('input[name="stock_max"]').val();
        let sortColumn = $('th[data-sort].sorted').data('sort') || 'id';
        let sortOrder = $('th[data-sort].sorted').hasClass('asc') ? 'asc' : 'desc';

        $.ajax({
            url: '/products/search',
            type: 'GET',
            data: {
                keyword: keyword,
                company_id: companyId || null,
                price_min: toNumberOrNull(priceMin),
                price_max: toNumberOrNull(priceMax),
                stock_min: toNumberOrNull(stockMin),
                stock_max: toNumberOrNull(stockMax),
                sort_column: sortColumn,
                sort_order: sortOrder
            },
            success: function (response) {
                console.log(response)
                if (response) {
                    $('#product-list').html(response);
                    //$('#pagination-links').html(response.pagination || "");

                    let table = document.querySelector('#product-table');
                    if (table && typeof sortable === "function") {
                        sortable(table);
                    }
                }
            },
            error: function (xhr) {
                console.error("検索エラー:", xhr.responseText);
            }
        });
    }

    // 検索ボタンのクリックイベント
    $('#search-btn').on("click", function (event) {
        event.preventDefault();
        reloadProducts();
    });

    // ソート時にも検索結果を維持
    $('th[data-sort]').on("click", function () {
        $('th[data-sort]').removeClass("sorted asc desc");
        $(this).addClass("sorted " + ($(this).hasClass("asc") ? "desc" : "asc"));
        reloadProducts();
    });
});


