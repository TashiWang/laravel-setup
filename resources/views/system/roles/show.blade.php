<x-app-layout>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex">
                            <span class="text-capitalize mt-1 table-header">{{ $role->name }}</span>
                            <x-back-button href="{{ route('role.index') }}">Back</x-back-button>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            @forelse($permissions as $name => $values)
                                @php
                                    $symbols = ['_', '-'];
                                @endphp
                                <div class="col-md-2">
                                    <table class="table table-sm table-bordered">
                                        <thead class="thead-light">
                                            <tr>
                                                <th colspan="2">{{ ucwords(str_replace($symbols, ' ', $name)) }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($values as $value)
                                                <tr>
                                                    <td>
                                                        <input type="checkbox" name="permissions[]"
                                                            value="{{ $value['id'] }}"
                                                            {{ in_array($value['id'], $rolePermissions) ? ' checked' : '' }}
                                                            disabled />
                                                        {{ strtoupper(str_replace($symbols, ' ', $value['name'])) }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @empty
                                <div class="d-flex">
                                    <i class="text-danger">There are no permissions in the system. Click
                                    <a href="{{ route('permission.index') }}">Here</a> to refresh permissions.
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-app-layout>
