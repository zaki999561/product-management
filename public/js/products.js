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
