<x-app-layout>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex">
                            <span class="mt-1 table-header">Role Management</span>
                            @can('role.update')
                                <x-create-button href="{{ route('role.create') }}"> Create</x-create-button>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-bordered" id="roles-table" style="width:100%">
                            <thead class="table-head">
                                <tr>
                                    <th>Name</th>
                                    <th>Number of Users</th>
                                    <th><i class="nav-icon fas fa-cogs"></i></th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-app-layout>
