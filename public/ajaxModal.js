let ModalAjaxCall = null;
function setAjaxModalLoder(submitBtn, state) {
    // var submitBtn = ;
    if (submitBtn) {
        var spinner = `
                <div class="spinner-border" role="status" style="width: ${
                    submitBtn.innerHeight() - 11
                }px;height:${submitBtn.innerHeight() - 11}px;">
                    <span class="visually-hidden">Loading...</span>
                </div>

                `;
        if (!submitBtn.hasClass("d-inline-flex align-items-center gap-3")) {
            submitBtn.addClass("d-inline-flex align-items-center gap-3");
        }
        spinner = $(spinner);
        submitBtn.prop("disabled", state);
        if (state) {
            submitBtn.append(spinner);
        } else {
            submitBtn.children(spinner).remove();
        }
    }
}

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
            setAjaxModalLoder(btn, true);
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
                    setAjaxModalLoder(btn, false);

                    // console.log();
                    if (res.status) {
                        $(".ajaxModal").remove();
                        $("body").append(res.modal);
                        $(".ajaxModal").modal("show");
                    }
                },
                error: function (xhr, status, error) {
                    setAjaxModalLoder(btn, false);

                    var errorRes = xhr.responseJSON;
                    var status = xhr.status;
                    if (errorRes) {
                        Swal.fire({
                            title: errorRes?.message ?? "",
                            icon: "error",
                            confirmButtonColor: "#0d6efd",
                        });
                    }
                },
            });
        }
    });
});
