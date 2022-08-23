<x-app-layout>
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex">
                            <span class="text-capitalize mt-1 table-header">Update User</span>
                            <x-back-button href="{{ route('user.index') }}">Back</x-back-button>
                        </div>
                    </div>
                    <form method="POST" action="{{ route('user.update', $user->id) }}">
                        @method('PATCH')
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group row">
                                    <label for="name" class="col-sm-2 col-form-label">Full Name</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="name"
                                            placeholder="User name" value="{{ $user->name }}" autocomplete="name"
                                            required>

                                        @error('name')
                                            <div class="alert alert-danger mt-1 py-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email" class="col-sm-2 col-form-label">Email Address</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" name="email"
                                            placeholder="example@gmail.com" value="{{ $user->email }}"
                                            autocomplete="email" required>

                                        @error('email')
                                            <div class="alert alert-danger mt-1 py-2">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group row">
                                    <label for="role" class="col-sm-2 col-form-label">Role</label>
                                    <div class="col-sm-10">
                                        <select class="form-control custom-select" name="role">
                                            @foreach ($roles as $role)
                                                <option class="form-control" value="{{ $role->id }}"
                                                    {{ in_array($role->id, $userRole, false) ? 'selected' : '' }}>
                                                    {{ $role->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
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
