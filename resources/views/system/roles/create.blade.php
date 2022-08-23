<x-app-layout>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex">
                            <span class="text-capitalize mt-1 table-header">Create Role</span>
                            <x-back-button href="{{ route('role.index') }}">Back</x-back-button>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('role.store') }}">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" name="name" placeholder="Name"
                                        required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="permission_id" class="col-sm-2 col-form-label">Permissions</label>
                                <div class="col-sm-10">
                                    <select class="select2 select2-multiple form-control" name="permissions[]"
                                        id="permission_id" multiple="multiple">
                                        @foreach ($permissions as $permission)
                                            <option class="form-control" value="{{ $permission->id }}">
                                                {{ $permission->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="text-white btn btn-primary float-right">Create
                                Role</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
