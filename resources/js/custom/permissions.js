window._ = require('lodash');

$(function () {
    $('#permissions-table').DataTable({
        processing: true,
        serverSide: true,
        language: {
            search: "",
            searchPlaceholder: "Search records",
            lengthMenu: "Show _MENU_ entries",
            paginate: {
                previous: "« Previous",
                next: "Next »",
            },
        },
        ajax: 'http://127.0.0.1:8000/setting/permissions',
        columns: [
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }

        ]
    });
});

$(document).on('click', ".delete-btn", function (e) {
    e.preventDefault();
    var id = $(this).attr('id');
    var url = $(this).attr('href');
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: url,
                type: 'DELETE',
                dataType: 'JSON',
                data: {
                    "id": id,
                    "_token": $("meta[name='csrf-token']").attr("content"),
                },
                success: function () {
                    location.reload();
                    Toast.fire({
                        icon: "success",
                        title: "Office has been deleted successfully!",
                    });
                }
            });
        }
    })
})
