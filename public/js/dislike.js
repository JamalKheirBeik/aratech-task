$(document).ready(function () {
    // handle dislikes
    $(document).on("submit", "form.dislikeForm", function (e) {
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('input[name="_token"]').val(),
            },
        });

        $.ajax({
            url: "http://127.0.0.1:8000/book/dislike",
            type: "post",
            data: {
                id: e.target.children[2].value,
            },
            success: function (_response) {
                console.log("book disliked");
                const res = JSON.parse(_response);
                // update the UI
                e.target.children[1].innerText = res.dislikes;
            },
            error: function (_response) {
                console.log("sorry cannot dislike the book", _response);
            },
        });
    });
});
