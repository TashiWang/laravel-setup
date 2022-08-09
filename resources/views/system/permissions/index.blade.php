<x-app-layout>
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex">
                            <span class="mt-1">Permission Management</span>
                            <x-create-button href="/setting/permissions/create"> Create Permission</x-create-button>
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table table-hover" id="permissions-table" style="width:100%">
                            <thead class="table-head">
                                <tr>
                                    <th>Name</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </div>
</x-app-layout>
