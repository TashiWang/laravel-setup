<x-app-layout>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex">
                            <span class="mt-1 table-header">Permission Management</span>
                            @can('permission.refresh')
                                <span class="ml-auto">
                                    <form action="{{ route('permission.refresh') }}" method="POST">
                                        @csrf
                                        <x-reload-button type="submit">
                                            Reload permissions</x-reload-button>
                                    </form>
                                </span>
                            @endcan
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-bordered" id="permissions-table" style="width:100%">
                            <thead class="table-head">
                                <tr>
                                    <th>Name</th>
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
