<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">

    <title>Common Ajax Form Code</title>
    <style>
        * {
            margin: 0px;
            padding: 0px;
            box-sizing: border-box;
        }

        table td,
        table th,
        table tr {
            background-color: transparent !important;
            text-align: center;
            border: 2px groove black !important;
        }

        table thead {
            text-align: center;
            background-color: #f5b7b1;
        }

        table thead td,
        table thead th {
            border: 2px groove black !important;

        }

        .pagination-container {

            scrollbar-width: none;
            max-height: 70vh;
            overflow-y: auto;
            /* Firefox */
        }

        #pagination-container::-webkit-scrollbar {
            display: none;
            /* Chrome, Safari, Edge */
        }

        .headingTh {
            position: sticky;
            top: -2px;
            background: white !important;
            z-index: 1;
            border: 2px solid black !important;
        }
    </style>
</head>

<body>
    <div class="container-fluid d-flex" style="background: #fcf3cf;min-height:100vh;">
        <div class="container ">

            <div class="row justify-content-center p-2 ">
                <div class="col-lg-8">
                    <div class="card"
                        style="background: #f5b7b1;box-shadow: rgba(50, 50, 93, 0.25) 0px 2px 5px -1px, rgba(0, 0, 0, 0.3) 0px 1px 3px -1px;">
                        <div class="card-body p-0">
                            <div class="mb-2 p-2 d-flex flex-col justify-content-between"
                                style="border-bottom:3px groove #fcf3cf;">
                                <h5 class="card-title">Common Ajax Modal
                                </h5>
                                <div>
                                    <button class="btn btn-primary btn-sm modalOpen"
                                        data-modal-url="{{ route('modalOpen') }}">Add</button>
                                    <a href="{{ route('home') }}" class="btn btn-primary btn-sm">Ajax Form Code</a>
                                    <a href="{{ route('list') }}" class="btn btn-primary btn-sm">Simple
                                        List</a>


                                </div>
                            </div>
                            <div class="row p-3">
                                <div class="col-lg-12">
                                    <div class="pagination-container pb-5">

                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="headingTh">ID</th>
                                                    <th class="headingTh">Name</th>
                                                    <th class="headingTh">Email</th>
                                                    <th class="headingTh">Action</th>
                                                </tr>

                                            </thead>
                                            <tbody class="pagination-content">
                                                @include('partialPageData', ['users' => $users])
                                            </tbody>
                                        </table>
                                        <div class="pagination-loder justify-content-center">
                                            <div class="spinner-border text-dark" role="status">
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
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
    let currentPage = 1;
    let loder = false;
    let lastPage = null;
    $(".pagination-container").scroll(function() {
        // console.log($(".pagination-container").scrollTop() + $(".pagination-container").height(), $(
        //     ".pagination-container table").height() - 10)
        if ($(".pagination-container").scrollTop() + $(".pagination-container").height() >= ($(
                ".pagination-container table").height() + 15) && !loder) {

            loadMoreData(currentPage + 1);
            currentPage++;
            console.log(lastPage);
        }
    });
    let ajaxCall = null;

    function loadMoreData(page) {
        if (ajaxCall) ajaxCall.abort();
        ajaxCall = $.ajax({
                url: '?page=' + page,
                type: 'get',
                beforeSend: function() {
                    // $('.pagination-loder').show();
                    $('.pagination-loder').css('display', 'flex');
                    loder = true;
                }
            })
            .done(function(data) {
                $('.pagination-loder').hide();
                console.log(data, page, data == "", $('.pagination-loder'))
                if (data == "") {
                    $('.pagination-loder').html("");
                    // $('.pagination-loder').css('visibility', 'hidden');

                    currentPage = lastPage + 1;
                    loder = false;

                    // return;
                } else {
                    lastPage = page;
                    $(".pagination-content").append(data);
                    loder = false;
                }

            })
            .fail(function() {
                // $('.pagination-loder').hide();
                $('.pagination-loder').css('display', 'none');


                // alert('Something went wrong');
            });
    }
</script>

<script src="{{ asset('ajaxDelete.js') }}" lang="text/javascript"></script>

<script src="{{ asset('ajaxForm.js') }}" lang="text/javascript"></script>
<script src="{{ asset('ajaxModal.js') }}" lang="text/javascript"></script>


</html>
