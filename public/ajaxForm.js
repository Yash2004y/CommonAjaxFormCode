function setAjaxFormLoder(form, state) {
    // console.log(formClass)
    if (form) {
        var submitBtn = form.find("button[type='submit']");
        var oldText = submitBtn.text();
        var spinner = `
                <div class="spinner-border" role="status" style="width: 1.3rem;height:1.3rem;">
                    <span class="visually-hidden">Loading...</span>
                </div>

`;
        spinner = $(spinner);
        submitBtn.prop("disabled", state);
        if (state) {
            submitBtn.append(spinner);
        } else {
            submitBtn.children(spinner).remove();
        }
    }
}

function afterSuccessForm(res, swalAction) {
    //res is response of ajax (when status true and status  code 200)
    //swalAction is a event obj of swal dismiss
    // console.log(res, swalAction);

    if (res.redirect && res.redirect != "") {
        window.location.href = res.redirect;
    }
}

$(document).ready(function () {
    // setLoder(form, true);
    $(document).on("submit", ".ajaxForm", function (e) {
        e.preventDefault();
        const URL = $(this).prop("action");
        const form = $(this);
        const LoderFunctionName =
            $(this).data("loder-function-name") ?? "setAjaxFormLoder";
        const METHOD = $(this).prop("method").toUpperCase();
        const CommonErrorClass = $(this).data("common-error-class");
        const AfterSuccessForm =
            $(this).data("after-success-function-name") ?? "afterSuccessForm";

        form.find(`.${CommonErrorClass}`).html("");
        // console.log(`.${CommonErrorClass}`)
        // const submitter = e.originalEvent?.submitter;
        var formData = new FormData(this);
        if (METHOD == "GET") {
            formData = $(this).serialize();
        }
        //run loder
        if (typeof window[LoderFunctionName] === "function") {
            window[LoderFunctionName](form, true);
        }

        // Optional: debug log
        console.log("method =>", METHOD);
        console.log("Form Data =>");
        if (METHOD != "GET") {
            for (let pair of formData.entries()) {
                console.log(pair[0] + ": " + pair[1]);
            }
        }

        if (URL && URL != "") {
            $.ajax({
                url: URL,
                data: formData,
                method: METHOD,
                success: function (res) {
                    //stop loder
                    if (typeof window[LoderFunctionName] === "function") {
                        window[LoderFunctionName](form, false);
                    }

                    // console.log(res);
                    if (res.status) {
                        Swal.fire({
                            title: res.message,
                            icon: "success",
                            confirmButtonColor: "#0d6efd",
                        }).then(function (e) {
                            if (
                                typeof window[AfterSuccessForm] === "function"
                            ) {
                                window[AfterSuccessForm](res, e);
                            }
                        });
                    } else {
                        Swal.fire({
                            title: res.message,
                            icon: "error",
                            confirmButtonColor: "#0d6efd",
                        });
                    }
                },
                dataType: "json",
                processData: false,
                contentType: false,
                error: function (xhr, status, error) {
                    //stop loder
                    if (typeof window[LoderFunctionName] === "function") {
                        window[LoderFunctionName](form, false);
                    }
                    var errorRes = xhr.responseJSON;
                    var status = xhr.status;
                    if (status == 422) {
                        var error = errorRes?.error;
                        Object.entries(error).forEach((item, index) => {
                            const [Key, Value] = item;
                            form.find(`.${Key}-error`).html(Value);
                            // console.log(item);
                        });
                    } else {
                        Swal.fire({
                            title: errorRes?.message ?? "",
                            icon: "error",
                            confirmButtonColor: "#0d6efd",
                        });
                    }
                    // console.log(xhr);
                },
            });
        }
    });
});
