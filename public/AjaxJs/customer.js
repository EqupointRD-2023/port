$(function () {
    // add new customer ajax request
    $("#add_customer_form").submit(function (e) {
        e.preventDefault();
        const fd = new FormData(this);
        $("#add_customer_btn").text('Adding...');
        $.ajax({
            url: 'register_customer',
            method: 'post',
            data: fd,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (response) {
                if (response.status == 200) {
                    Swal.fire(
                        'Added!',
                        'Customer Added Successfully!',
                        'success'
                    )
                    fetchAllCustomers();
                }
                $("#add_customer_btn").text('Add Customer');
                $("#add_customer_form")[0].reset();
                $("#addCustomerModal").modal('hide');
            }
        });
    });

    // edit customer ajax request
    $(document).on('click', '.editIcon', function (e) {
        e.preventDefault();
        let id = $(this).attr('id');
        $.ajax({
            url: 'update_customer',
            method: 'get',
            data: {
                id: id,
                _token: '{{ csrf_token() }}'
            },
            success: function (response) {
                $("#fname").val(response.first_name);
                $("#lname").val(response.last_name);
                $("#email").val(response.email);
                $("#phone").val(response.phone);
                $("#post").val(response.post);
                $("#emp_id").val(response.id);
                $("#emp_avatar").val(response.avatar);
            }
        });
    });

    // update customer ajax request
    $("#edit_customer_form").submit(function (e) {
        e.preventDefault();
        const fd = new FormData(this);
        $("#edit_customer_btn").text('Updating...');
        $.ajax({
            url: 'update_customer',
            method: 'post',
            data: fd,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (response) {
                if (response.status == 200) {
                    Swal.fire(
                        'Updated!',
                        'Customer Updated Successfully!',
                        'success'
                    )
                    fetchAllCustomers();
                }
                $("#edit_customer_btn").text('Update Customer');
                $("#edit_customer_form")[0].reset();
                $("#editCustomerModal").modal('hide');
            }
        });
    });

    // delete customer ajax request
    $(document).on('click', '.deleteIcon', function (e) {
        e.preventDefault();
        let id = $(this).attr('id');
        let csrf = '{{ csrf_token() }}';
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
                    url: 'delete_customer',
                    method: 'delete',
                    data: {
                        id: id,
                        _token: csrf
                    },
                    success: function (response) {
                        console.log(response);
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        )
                        fetchAllCustomers();
                    }
                });
            }
        })
    });

    // fetch all customers ajax request
    fetchAllCustomers();

    function fetchAllCustomers() {
        $.ajax({
            url: "customerList",
            method: "get",
            success: function (response) {
                $("#show_all_customers").html(response);
                $("table").DataTable({
                    order: [0, "desc"],
                });
            },
        });
    }
});
