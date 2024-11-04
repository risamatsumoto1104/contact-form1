// モーダルを開く関数
function openModal(id) {
    // 非同期通信で詳細情報を取得
    fetch(`/admin`, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ id: id })
    })
        .then(response => response.json())
        .then(data => {
            // モーダル内の要素にデータを表示
            document.getElementById('modal-name').innerText = data.last_name + ' ' + data.first_name;
            document.getElementById('modal-gender').innerText = data.gender;
            document.getElementById('modal-email').innerText = data.email;
            document.getElementById('modal-tell').innerText = data.tell;
            document.getElementById('modal-address').innerText = data.address;
            document.getElementById('modal-building').innerText = data.building;
            document.getElementById('modal-category').innerText = data.category.content;
            document.getElementById('modal-detail').innerText = data.detail;
            document.getElementById('modal-id').value = data.id; // 削除用ID

            // モーダルを表示
            document.getElementById('modal').style.display = 'block';
        })
        .catch(error => {
            console.error('Error:', error);
            alert('データの取得中にエラーが発生しました。');
        });
}

// モーダルを閉じる関数
function closeModal() {
    document.getElementById('modal').style.display = 'none';
    // モーダル内容をリセット
    document.getElementById('modal-name').innerText = '';
    document.getElementById('modal-gender').innerText = '';
    document.getElementById('modal-email').innerText = '';
    document.getElementById('modal-tell').innerText = '';
    document.getElementById('modal-address').innerText = '';
    document.getElementById('modal-building').innerText = '';
    document.getElementById('modal-category').innerText = '';
    document.getElementById('modal-detail').innerText = '';
}
