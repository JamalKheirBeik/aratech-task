$(document).ready(function () {
    // handle likes
    $(document).on("submit", "form.likeForm", function (e) {
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('input[name="_token"]').val(),
            },
        });

        $.ajax({
            url: "http://127.0.0.1:8000/book/like",
            type: "post",
            data: {
                id: e.target.children[2].value,
            },
            success: function (_response) {
                console.log("book liked");
                const res = JSON.parse(_response);
                // update the UI
                e.target.children[1].innerText = res.likes;
            },
            error: function (_response) {
                console.log("sorry cannot like the book");
            },
        });
    });
});
