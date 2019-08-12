<script>
    $(document).ready(function () {
        $('.enrollment-delete').on('click', function (e) {

            var id = $(this).data('id');
            var itemref = $(this).attr('itemref');

            swal({
                title: "Are you sure?",
                text: itemref + " will be deleted!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes",
                cancelButtonText: "No, cancel please!",
                closeOnConfirm: false,
                closeOnCancel: false
            },
                    function (isConfirm) {
                        if (isConfirm) {
                            $.ajax({
                                type: 'delete',
                                url: '/admin/enrollment/delete/' + id,
                                success: function (data) {
                                    swal({
                                        text: data.message,
                                        title: 'Success!',
                                        type: "success",
                                        timer: 2000,
                                        showCancelButton: false, //There won't be any cancle button
                                        showConfirmButton: false
                                    },
                                            function () {
                                                location.reload();
                                            })
                                }
                            });
                        } else {
                            swal({
                                title: 'Cancelled!',
                                type: "info", showConfirmButton: false, timer: 1000
                            });
                            e.preventDefault();
                        }
                    });

        });
    });
</script>

<script>
    $(document).ready(function () {
        $('.enrollment-save').on('click', function (e) {

            var type = $(this).attr('itemref');
            if ('class' == type) {
                var name = $('#enrollment-class-add').find('input[name=name]').val();
                var price = $('#enrollment-class-add').find('input[name=price]').val();
                var publish_date = $('#enrollment-class-add').find('input[name=publish_date]').val();
                var assigned_id = $('#enrollment-class-add').find('select[name=assigned_id]').val();

                if (!name || !price || !publish_date) {
                    alert('Please enter all fields');
                    return false;
                }

                var start_date = null;
                var min_users = null;
                var max_users = null;
                var duration = null;
            }

            if ('group' == type) {
                var name = $('#enrollment-group-add').find('input[name=name]').val();
                var price = $('#enrollment-group-add').find('input[name=price]').val();
                var start_date = $('#enrollment-group-add').find('input[name=start_date]').val();
                var assigned_id = $('#enrollment-group-add').find('select[name=assigned_id]').val();

                var publish_date = $('#enrollment-group-add').find('input[name=publish_date]').val();
                var min_users = $('#enrollment-group-add').find('input[name=min_users]').val();
                var max_users = $('#enrollment-group-add').find('input[name=max_users]').val();
                var duration = $('#enrollment-group-add').find('select[name=duration]').val();
                
                if (!name || !price || !publish_date || !start_date || !min_users || !max_users || !duration) {
                    alert('Please enter all fields');
                    return false;
                }
            }
           
            $.ajax({
                type: 'post',
                url: '{{ route('admin.enrollment.add') }}',
                data: {
                    'type': type,

                    'name': name,
                    'assigned_id': assigned_id,
                    'publish_date': publish_date,
                    'price': price,
                    
                    'start_date': start_date,
                    'min_users': min_users,
                    'max_users': max_users,
                    'duration': duration,
                },
                success: function (data) {
                    swal({
                        text: data.message,
                        title: 'Success!',
                        type: data.status,
                        timer: 2000,
                        showCancelButton: false,
                        showConfirmButton: false
                    })
                    if (data.status == 'success') {
                        setTimeout(function () {
                            location.reload();
                        }, 1000);
                    }
                }
            })
        });
    });
</script>    