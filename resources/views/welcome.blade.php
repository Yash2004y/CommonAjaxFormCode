<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
    <title>Common Ajax Form Code</title>
    <style>
        * {
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
        }
    </style>
</head>

<body>
    <div class="container-fluid d-flex align-items-center" style="background: #fcf3cf;min-height:100vh;">
        <div class="container ">

            <div class="row justify-content-center p-2 ">
                <div class="col-lg-7">
                    <div class="card"
                        style="background: #f5b7b1;box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;">
                        <div class="card-body p-0">
                            <div class="mb-2 p-2 d-flex flex-col justify-content-between"
                                style="border-bottom:3px groove #fcf3cf;">
                                <h5 class="card-title">Common Ajax Form
                                </h5>
                                <a href="{{ route('list') }}" class="btn btn-primary btn-sm">List</a>

                            </div>
                            <form class="row p-3 ajaxForm" method="post" action="{{ route('store') }}"
                                data-before-ajax-call-function="beforeAjax">
                                {{-- data-loder-function-name="setAjaxBtnLoader" --}}
                                {{-- data-after-success-function-name="afterSuccessForm" --}}
                                {{-- data-before-ajax-call-function (optional) -> function name which is call before call ajax this method which must return boolean value. this method has following two parameter
                                    1.form => object of form
                                    2.formData => formData object base on form method
                                --}}
                                {{-- data-loder-function-name (optional) -> default is setAjaxBtnLoader function. function name for set loder when process this function has two argument class name of form and state for loader by default display loader in submit btn of form --}}
                                {{-- data-common-error-class (optional) -> default is error-common class. set class name which available in each error display span or small (use for clear error) --}}
                                {{-- data-after-success-function-name  (optional) => default is afterSuccessForm function. function name which is call after response status true and status code 200 it has two argument
                                        1. res -> response of ajax
                                        2. form => current form object
                                        2. swalEventObj => swal dissmiss event obj
                                        ->in this method you set action that perform after submit form or success

                                --}}
                                {{--
                                    data-common-error-class this class and error class must be inside form tag
                                --}}
                                {{-- ->all override method defind after utils.js --}}
                                @csrf
                                <div class="col-md-6">
                                    <label for="inputEmail4" class="form-label">Email</label>
                                    <input type="email" name="email" class="form-control" id="inputEmail4">
                                    <small class="text-danger error-common email-error"></small>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputPassword4" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control" id="inputPassword4">
                                    <small class="text-danger error-common password-error"></small>

                                </div>
                                <div class="col-12">
                                    <label for="inputAddress" class="form-label">Address</label>
                                    <input type="text" name="address1" class="form-control" id="inputAddress"
                                        placeholder="1234 Main St">
                                    <small class="text-danger error-common address1-error"></small>

                                </div>
                                <div class="col-12">
                                    <label for="inputAddress2" class="form-label">Address 2</label>
                                    <input type="text" name="address2" class="form-control" id="inputAddress2"
                                        placeholder="Apartment, studio, or floor">
                                    <small class="text-danger error-common address2-error"></small>

                                </div>
                                <div class="col-md-6">
                                    <label for="inputCity" class="form-label">City</label>
                                    <input type="text" name="city" class="form-control" id="inputCity">
                                    <small class="text-danger error-common city-error"></small>
                                </div>
                                <div class="col-md-4">
                                    <label for="inputState" class="form-label">State</label>
                                    <select id="inputState" name="state" class="form-select">
                                        <option selected value="">Choose...</option>
                                        <option>Gujrat</option>
                                        <option>Mharastra</option>
                                        <option>Rajsthan</option>
                                    </select>
                                    <small class="text-danger error-common state-error"></small>

                                </div>
                                <div class="col-md-2">
                                    <label for="inputZip" class="form-label">Zip</label>
                                    <input type="text" class="form-control" name="zip" id="inputZip">
                                    <small class="text-danger error-common zip-error"></small>
                                </div>
                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" name="check_me_out" type="checkbox"
                                            id="gridCheck">
                                        <label class="form-check-label" for="gridCheck">
                                            Check me out
                                        </label><br>
                                        <small class="text-danger error-common check_me_out-error"></small>

                                    </div>
                                </div>
                                <div class="col-lg-12 mt-2">
                                    <button type="submit" class="btn btn-primary">Submit

                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

</body>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.min.js"
    integrity="sha384-VQqxDN0EQCkWoxt/0vsQvZswzTHUVOImccYmSyhJTp7kGtPed0Qcx8rK9h9YEgx+" crossorigin="anonymous">
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
    integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script src="{{ asset('utils.js') }}" lang="text/javascript"></script>
{{-- you can write your custom function after utils.js --}}

<script>
    function beforeAjax(form, formData) {
        console.log(formData);
        return true;
    }
</script>
<script src="{{ asset('ajaxForm.js') }}" lang="text/javascript"></script>

</html>
