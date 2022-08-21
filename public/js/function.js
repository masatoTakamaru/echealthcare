//フラッシュメッセージのキャンセルボタン
$('#flash-message-cancel').on('click', () => {
    $('#flash-message').slideUp()
});

//フラッシュメッセージの自動消去
window.setTimeout(() => {
    $('#flash-message').slideUp()
}, 7000);