document.addEventListener('DOMContentLoaded', function () {
    const deleteButtons = document.querySelectorAll('.delete-button');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function () {
            const productId = this.dataset.id;
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            if (confirm('削除しますか？')) {
                $.ajax({
                    url: `/products/${productId}`,  
                    type: "DELETE",
                    data: { _token: csrfToken }, 
                    headers: {
                        "X-CSRF-TOKEN": csrfToken,
                    },
                    success: function (response) {
                        if (response.success) {
                            alert(response.message);
                            $(`tr[data-id="${productId}"]`).remove();  
                        } else {
                            alert("削除に失敗しました。");
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error("削除エラー:", error);
                        alert("削除処理中にエラーが発生しました。");
                    },
                });
            }
        });
    });

    $(document).ready(function () {
        $('#search-form').submit(function (event) {
            event.preventDefault();  // フォームの通常送信をキャンセル
    
            let keyword = $('input[name="keyword"]').val();
            let companyId = $('select[name="company_id"]').val();
            let csrfToken = $('meta[name="csrf-token"]').attr('content');
    
            $.ajax({
                url: '/products/search',
                type: 'GET',
                data: {
                    keyword: keyword,
                    company_id: companyId
                },
                success: function (response) {
                    if (response.success) {
                        $('#product-list').html(response.html);
                        $('#pagination-links').html(response.pagination);
                    } else {
                        alert('検索結果が見つかりませんでした。');
                    }
                },
                error: function () {
                    alert('検索処理中にエラーが発生しました。');
                }
            });
        });
    });
    
        
});
