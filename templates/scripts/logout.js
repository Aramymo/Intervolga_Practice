function deauthorize() {
    $.ajax({
        url: "http://localhost:8888/deauth",
        type: "POST",
        encode: true,
        success: function () {
            window.location.reload();
        },
    });
}