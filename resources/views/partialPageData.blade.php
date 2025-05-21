@forelse ($users as $u)
    <tr>
        <td>{{ $u->id }}</td>
        <td>{{ $u->name }}</td>
        <td>{{ $u->email }}</td>
        <td>
            <button class="btn btn-primary btn-sm modalOpen" data-modal-url="{{ route('modalOpen') }}"
                data-id="{{ $u->id }}">Edit</button>
            {{-- data-loder-function-name (optional) -> default is setAjaxBtnLoader function. function name for set loder when process this function has two argument class name of form and state for loader by default display loader in submit btn of form --}}


            <button class="btn btn-danger btn-sm item-delete-btn" data-delete-url="{{ route('deleteUser') }}"
                data-id="{{ $u->id }}" data-method="POST">Delete</button>

            {{-- for delete btn (item-delete-btn class)}}
                                                    {{-- data-loder-function-name (optional) -> default is setAjaxBtnLoader function. function name for set loder when process this function has two argument class name of form and state for loader by default display loader in submit btn of form --}}

            {{--

/* data-after-delete-function  (optional) => default is afterDeleteAction function. function name which is call after response status true and status code 200 it has two argument
        1. res -> response of ajax
        2. swalEventObj => swal dissmiss event obj
        ->in this method you set action that perform after success
*/
                                                    --}}

            {{--
                                                        data-confirm-message (optional)=>default "Are You Sure ?" message. set confirm message.
                                                    --}}
        </td>
    </tr>
@empty
@endforelse
