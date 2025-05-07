let ModalAjaxCall = null;

$(document).ready(function () {
    $(document).on("click", ".modalOpen", function (e) {
        const btn = $(this);
        const ModalUrl = btn.data("modal-url");
        const DataId = btn.data("id");
        const data = {
            id: DataId,
        };
        if (ModalUrl && ModalUrl != "") {
            if (ModalAjaxCall != null) ModalAjaxCall.abort();
            setAjaxBtnLoader(btn, true);
            ModalAjaxCall = $.ajax({
                url: ModalUrl,
                data: data,
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                method: "POST",
                success: function (res) {
                    setAjaxBtnLoader(btn, false);

                    // console.log();
                    if (res.status) {
                        $(".ajaxModal").remove();
                        $("body").append(res.modal);
                        $(".ajaxModal").modal("show");
                    }
                },
                error: function (xhr, status, error) {
                    setAjaxBtnLoader(btn, false);

                    var errorRes = xhr.responseJSON;
                    var status = xhr.status;
                    if (errorRes) {
                        swalMessage({
                            title: errorRes?.message ?? "",
                            icon: "error",
                        });
                    }
                },
            });
        }
    });
});
