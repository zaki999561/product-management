document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.delete-button');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            const productId = this.dataset.id;
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            if (confirm('削除しますか？')) {
                fetch(`/products/${productId}`, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json', // JSON データとして送信
                        'X-CSRF-TOKEN': csrfToken,
                        'X-Requested-With': 'XMLHttpRequest',
                    },
                    body: JSON.stringify({ _token: csrfToken }) // CSRF トークンを送信
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert(data.message);
                        document.querySelector(`tr[data-id="${productId}"]`).remove(); // tr を削除
                    } else {
                        alert('削除に失敗しました。');
                    }
                })
                .catch(error => {
                    console.error('削除エラー:', error);
                    alert('削除処理中にエラーが発生しました。');
                });
            }
        });
    });
});

$(document).ready(function () {
    $('#search-btn').on("click", function (event) {
        event.preventDefault();
        let keyword = $('input[name="keyword"]').val();
        let companyId = $('select[name="company_id"]').val();
        let priceMin = $('input[name="price_min"]').val();
        let priceMax = $('input[name="price_max"]').val();
        let stockMin = $('input[name="stock_min"]').val();
        let stockMax = $('input[name="stock_max"]').val();
        let csrfToken = $('meta[name="csrf-token"]').attr('content');
        
        // 検索パラメータをまとめる
        let data = {
            keyword: keyword,
            company_id: companyId,
            price_min: priceMin || "",
            price_max: priceMax || "",
            stock_min: stockMin || "",
            stock_max: stockMax || "",
            _token: csrfToken
        };
    
        $.ajax({
            url: '/products/search',
            type: 'GET',
            data: data,
            success: function (response) {
                if (response.html) {
                    $('#product-list').html(response.html);
                    $('#pagination-links').html(response.pagination || "");
                } else {
                    alert('検索結果が見つかりませんでした。');
                }
            },
            error: function (xhr) {
                console.error("検索エラー:", xhr.responseText);
                alert('検索処理中にエラーが発生しました。');
            }
        });
    });
});
