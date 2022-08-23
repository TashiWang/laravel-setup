window._ = require('lodash');

$(function () {
    $('#roles-table').DataTable({
        processing: true,
        serverSide: true,
        aLengthMenu: [[10, 30, 100, -1], [10, 30, 100, "All"]],
        language: {
            search: "",
            searchPlaceholder: "Search records",
            lengthMenu: "Show _MENU_ entries",
            paginate: {
                previous: "« Previous",
                next: "Next »",
            },
        },
        ajax: 'http://127.0.0.1:8000/setting/role',
        columns: [
            {
                data: 'name',
                render: function (data) {
                    return capitalizeFirstLetter(data)
                },
            },
            {
                data: 'userCount',
                name: 'userCount'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            }

        ]
    });

    function capitalizeFirstLetter(string) {
        return string.charAt(0).toUpperCase() + string.slice(1);
    }

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
                        title: "Role has been deleted successfully!",
                    });
                }
            });
        }
    })
})
