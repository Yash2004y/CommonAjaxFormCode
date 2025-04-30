<div class="modal fade ajaxModal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        {{ html()->modelForm($user)->method('POST')->action(route('Userstore', $user?->id ?? ''))->data('common-error-class', 'error-common')->class('modal-content ajaxForm')->open() }}

        <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">{{ !empty($user) ? 'Edit' : 'Add' }} User</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <div class="mb-2">
                {{ html()->label('Enter Name', 'name') }}
                {{ html()->text('name')->class('form-control')->placeholder('Name') }}
                {{ html()->span()->class('text-danger error-common name-error d-block') }}
            </div>

            <div class="mb-2">

                {{ html()->label('Enter Email', 'email') }}
                {{ html()->text('email')->class('form-control mb-2')->placeholder('Email') }}

                {{ html()->span()->class('text-danger error-common email-error d-block') }}
            </div>


            <div class="mb-2">
                {{ html()->label('Enter Password', 'password') }}
                {{ html()->password('password')->class('form-control mb-2')->placeholder('Password') }}

                {{ html()->span()->class('text-danger error-common password-error d-block') }}
            </div>


            <div class="mb-2">
                {{ html()->label('Enter Confirm Password', 'password_confirmation') }}
                {{ html()->password('password_confirmation')->class('form-control mb-2')->placeholder('Confirm Password') }}
                {{ html()->span()->class('text-danger error-common password_confirmation-error d-block') }}
            </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
        {{ html()->closeModelForm() }}
    </div>
</div>
