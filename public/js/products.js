document.addEventListener('DOMContentLoaded', function () {
    function toNumberOrNull(value) {
        return value === "" ? null : Number(value);
    }

    function reloadProducts(sortColumn = null, sortOrder = 'asc') {
        let keyword = $('input[name="keyword"]').val();
        let companyId = $('select[name="company_id"]').val();
        let priceMin = $('input[name="price_min"]').val();
        let priceMax = $('input[name="price_max"]').val();
        let stockMin = $('input[name="stock_min"]').val();
        let stockMax = $('input[name="stock_max"]').val();
    
        // 現在のソート条件が指定されてなければ、テーブルから取得
        sortColumn = sortColumn || $('th[data-sort].sorted').data('sort') || 'id';
        sortOrder = sortOrder || ($('th[data-sort].sorted').hasClass('asc') ? 'asc' : 'desc');
    
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
                sort_order: sortOrder,
            },
            success: function (response) {
                if (response) {
                    $('#product-list').html(response);
                    
                    
                    // 再度tablesorter適用
                    setTimeout(() => {
                        $("#fav-table").trigger("update");
                    }, 200);
                }
            },
            error: function (xhr) {
                console.error("検索エラー:", xhr.responseText);
            }
        });
    }
    

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
                
                        // 該当行を削除
                        document.querySelector(`tr[data-id="${productId}"]`).remove();
                
                        // 再検索してリスト更新
                        reloadProducts();
                
                        // tablesorterの再適用（再描画後に必要）
                        setTimeout(() => {
                            $("#fav-table").trigger("update");
                        }, 200);
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

    // 検索ボタンのクリックイベント
    $('#search-btn').on("click", function (event) {
        event.preventDefault();
        reloadProducts();
    });

    $(document).on('click', 'th[data-sort]', function () {
        const $th = $(this);
        const sortColumn = $th.data('sort');
        let sortOrder = 'asc';
    
        if ($th.hasClass('sorted') && $th.hasClass('asc')) {
            sortOrder = 'desc';
        }
    
        // 全てのヘッダーから sorted, asc, desc を外す
        $('th[data-sort]').removeClass('sorted asc desc');
    
        // 今クリックした列に付与
        $th.addClass('sorted ' + sortOrder);
    
        // 検索条件を保持したままソート実行
        reloadProducts(sortColumn, sortOrder);
    });
    

    
});


