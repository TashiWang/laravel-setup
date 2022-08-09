<x-app-layout>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex">
                            <span class="text-capitalize mt-1">Update Role</span>
                            <x-back-button href="/roles">Back</x-back-button>
                        </div>
                    </div>
                    <form method="PUT" action="{{ url('admin/roles/' . $role->id) }}">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="name" class="col-sm-2 col-form-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" value="{{ $role->name }}" class="form-control"
                                        id="name" placeholder="Name" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="permissions" class="col-sm-2 col-form-label">Permissions</label>
                                <div class="col-sm-10">
                                    <select class="select2-multiple form-control" name="tags[]" multiple="multiple"
                                        id="select2Multiple">
                                        @foreach ($permissions as $permission)
                                            <option value="{{ $permission->id }}">{{ $permission->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="text-white btn btn-primary float-right">Update
                                User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
