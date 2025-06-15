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
        confirmButtonColor: obj?.confirmButtonColor ?? "#3085d6",
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
function swalConfirmMessage(obj) {
    Swal.fire({
        title: obj.title,
        text: obj.text,
        icon: obj?.icon ?? "warning",
        showCancelButton: obj?.showCancelButton ?? true,
        confirmButtonColor: obj?.confirmButtonColor ?? "#3085d6",
        cancelButtonColor: obj?.cancelButtonColor ?? "#d33",
        confirmButtonText: obj?.confirmButtonText ?? "Yes, delete it!",
    }).then((result) => {
        if (typeof obj.action == "function") obj.action(result);
    });
}
function setAjaxBtnLoader(submitBtn, state) {
        var ButtonClass = "d-inline-flex justify-content-center align-items-center gap-3";
    if (submitBtn) {
        var spinner = `
                <div class="spinner-border" role="status" style="width: ${
                    submitBtn.innerHeight() - 11
                }px;height:${submitBtn.innerHeight() - 11}px;">
                    <span class="visually-hidden">Loading...</span>
                </div>

                `;
        if (!submitBtn.hasClass(ButtonClass)) {
            submitBtn.addClass(ButtonClass);
        }
        spinner = $(spinner);
        submitBtn.prop("disabled", state);
        if (state) {
            submitBtn.append(spinner);
        } else {
            submitBtn.removeClass(ButtonClass);
            submitBtn.find('.spinner-border').remove();
        }
    }
}
