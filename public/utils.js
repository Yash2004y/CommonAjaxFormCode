function swalMessage(obj) {
    // obj =      {
    //     title: "Title",
    //     text: "Text",
    //     icon: "success",
    //     confirmButtonColor: "#0d6efd",
    //     action: (res) => {
    //         console.log(res)
    //     }
    // } // argument object
    Swal.fire({
        title: obj.title,
        text: obj?.text ?? "",
        icon: obj?.icon ?? "success",
        confirmButtonColor: obj.confirmButtonColor,
        allowOutsideClick: false, // prevent click outside
        allowEscapeKey: false, // prevent ESC key
        allowEnterKey: true, // allow Enter key to confirm
        showConfirmButton: true,
    }).then(function (res) {
        if (typeof obj.action == "function") obj.action(res);
    });
}

//call way
/*
swalMessage({
    title: "Title",
    text: "Text",
    icon: "success",
    confirmButtonColor: "#0d6efd",
    action: (res) => {
        console.log(res)
    }
});
*/

function setAjaxBtnLoader(submitBtn, state) {
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
