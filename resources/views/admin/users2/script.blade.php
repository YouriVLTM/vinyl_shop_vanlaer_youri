<script>
    $(function () {

        $('tbody').on('click', '.btn-delete', function () {
            // Get data attributes from td tag
            let id = $(this).closest('td').data('id');
            let name = $(this).closest('td').data('name');
            let row = $(this).closest('td').closest('tr');
            // Set some values for Noty
            let text = `<p>Delete the genre <b>${name}</b>?</p>`;
            let type = 'warning';
            let btnText = 'Delete genre';
            let btnClass = 'btn-success';

            // Show Noty
            let modal = new Noty({
                timeout: false,
                layout: 'center',
                modal: true,
                type: type,
                text: text,
                buttons: [
                    Noty.button(btnText, `btn ${btnClass}`, function () {
                        // Delete genre and close modal
                        deleteUser(id,row);
                        modal.close();
                    }),
                    Noty.button('Cancel', 'btn btn-secondary ml-2', function () {
                        modal.close();
                    })
                ]
            }).show();
        });

        $('tbody').on('click', '.btn-edit', function () {
            // Get data attributes from td tag
            let id = $(this).closest('td').data('id');
            let name = $(this).closest('td').data('name');
            let email = $(this).closest('td').data('email');
            let active = $(this).closest('td').data('active');
            let admin = $(this).closest('td').data('admin');

            // Update the modal
            $('form').attr('action', `/admin/users2/${id}`);

            // Update the modal
            $('.modal-title').text(`Edit ${name}`);
            $('#name').val(name);
            $('#email').val(email);
            $('#inlineActive').prop("checked", active);
            $('#inlineAdmin').prop("checked", admin);

            $('input[name="_method"]').val('put');
            // Show the modal
            $('#modal-users').modal('show');
        });


        $('#modal-users form').submit(function (e) {
            // Don't submit the form
            e.preventDefault();
            // Get the action property (the URL to submit)
            let action = $(this).attr('action');
            // Serialize the form and send it as a parameter with the post
            let pars = $(this).serialize();
            console.log(pars);
            // Post the data to the URL
            $.post(action, pars, 'json')
                .done(function (data) {
                    console.log(data);
                    // Noty success message
                    new Noty({
                        type: data.type,
                        text: data.text
                    }).show();
                    // Hide the modal
                    $('#modal-users').modal('hide');
                    //update row
                    updateUser(data.user);

                })
                .fail(function (e) {
                    console.log('error', e);
                    // e.responseJSON.errors contains an array of all the validation errors
                    console.log('error message', e.responseJSON.errors);
                    // Loop over the e.responseJSON.errors array and create an ul list with all the error messages
                    let msg = '<ul>';
                    $.each(e.responseJSON.errors, function (key, value) {
                        msg += `<li>${value}</li>`;
                    });
                    msg += '</ul>';
                    // Noty the errors
                    new Noty({
                        type: 'error',
                        text: msg
                    }).show();
                });
        });


    });

    // Delete a user
    function deleteUser(id,row) {
        // Delete the genre from the database
        let pars = {
            '_token': '{{ csrf_token() }}',
            '_method': 'delete'
        };
        $.post(`/admin/users2/${id}`, pars, 'json')
            .done(function (data) {
                console.log('data', data);
                if(data.type == "success"){
                    row.remove();
                }

                // Show toast
                new Noty({
                    type: data.type,
                    text: data.text
                }).show();
            })
            .fail(function (e) {
                console.log('error', e);
            });
    }

    function updateUser(user){
        //console.log("id" + user.id);
        let row = $("#userid_"+user.id);

        // update row
        row.children('td:nth-child(1)').text(user.id);
        row.children('td:nth-child(2)').text(user.name);
        row.children('td:nth-child(3)').text(user.email);

        row.children('td:nth-child(4)').html((user.active ? '<i class="fas fa-check"></i>' : ''));
        row.children('td:nth-child(5)').html((user.admin ? '<i class="fas fa-check"></i>' : ''));

        // update data set
        row.children('td:nth-child(6)').data('id', user.id);
        row.children('td:nth-child(6)').data('name',  user.name);
        row.children('td:nth-child(6)').data('email',  user.email);
        row.children('td:nth-child(6)').data('active',  user.active);
        row.children('td:nth-child(6)').data('admin',  user.admin);




    }
</script>