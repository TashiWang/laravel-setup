<x-app-layout>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex">
                            <span class="mt-1 table-header">User Management</span>
                            <x-create-button href="{{ route('user.create') }}"> Create</x-create-button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover table-bordered" id="users-table" style="width:100%">
                            <thead class="table-head">
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Member since</th>
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
