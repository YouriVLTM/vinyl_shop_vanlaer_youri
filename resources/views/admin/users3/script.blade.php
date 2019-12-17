<script>
    $(function () {
        console.log("test");

        $('#users-table').DataTable({
            processing: true,
            serverSide: true,

            "ajax":{
                "url": "{{ url('admin/users3/get_datatable') }}",
                "dataType": "json",
                "type": "GET",
                "data":{ _token: "{{csrf_token()}}"}
            },
            columns : [
                {data: 'id'},
                {data: 'name'},
                {data: 'email'},
                {data: 'active',
                    render: function ( data, type, full, meta ) {
                        var check = (data == 1) ? 'checked' :'';
                        var disable = (full.currentuser == 'true') ? 'disabled' :'';
                        return '<div class="custom-control custom-switch" >\n' +
                            '    <input type="checkbox" class="custom-control-input switchcontrol" data-type="active" data-id="'+full.id+'" id="switchActive_'+ full.id+ '" '+ check + ' '+ disable +'>\n' +
                            '    <label class="custom-control-label" for="switchActive_'+ full.id+'"></label>\n' +
                            '</div>';
                    }},
                {data: 'admin',
                    render: function ( data, type, full, meta ) {
                        var check = (data == 1) ? 'checked' :'';
                        var disable = (full.currentuser == 'true') ? 'disabled' :'';
                        return '<div class="custom-control custom-switch" >\n' +
                            '    <input type="checkbox" class="custom-control-input switchcontrol" data-type="admin" data-id="'+full.id+'" id="switchAdmin_'+ full.id+ '" '+check+ ' '+ disable +'>\n' +
                            '    <label class="custom-control-label" for="switchAdmin_'+ full.id+'"></label>\n' +
                            '</div>';
                    }},
                {data: 'action',  orderable: false, searchable: false}


            ]
        })

        //edit row
        $(document).on('click', '.btn-edit', function(){
            let id = $(this).data('id');
            $.ajax({
                url:"http://localhost:3000/admin/users3/fetchdata",

                method:'get',
                data:{id:id},
                dataType:'json',
                success:function(data){

                    //update form
                    $('form').attr('action', `/admin/users3/${data.id}`);

                    // Update the modal
                    $('.modal-title').text(data.name);
                    $('#name').val(data.name);
                    $('#email').val(data.email);
                    $('#inlineActive').prop("checked", data.active);
                    $('#inlineAdmin').prop("checked", data.admin);

                    $('input[name="_method"]').val('put');
                    // Show the modal
                    $('#modal-users').modal('show');

                }
            })
        });



        //delete row
        $('tbody').on('click', '.btn-delete', function () {
            // Get data attributes from td tag
            let id = $(this).data('id');

            // get user name
            $.ajax({
                url:"http://localhost:3000/admin/users3/fetchdata",
                method:'get',
                data:{id:id},
                dataType:'json',
                success:function(data){

                    // Set some values for Noty
                    let text = `<p>Delete the genre <b>${data.name}</b>?</p>`;
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
                                deleteUser(id);
                                modal.close();
                            }),
                            Noty.button('Cancel', 'btn btn-secondary ml-2', function () {
                                modal.close();
                            })
                        ]
                    }).show();


                }
            })



        });

        //update row
        $('#modal-users form').submit(function (e) {
            // Don't submit the form
            e.preventDefault();
            // Get the action property (the URL to submit)
            let action = $(this).attr('action');
            // Serialize the form and send it as a parameter with the post
            let pars = $(this).serialize();
            // Post the data to the URL
            $.post(action, pars, 'json')
                .done(function (data) {
                    // Noty success message
                    new Noty({
                        type: data.type,
                        text: data.text
                    }).show();
                    // Hide the modal
                    $('#modal-users').modal('hide');

                    //reload data
                    $('#users-table').DataTable().ajax.reload();

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



        //active switch
        $(document).on('click', '.switchcontrol', function () {

            let id = $(this).data('id');
            let type = $(this).data('type');
            let checked = $(this).is(":checked");


            //get user ID

            $.ajax({
                url:"http://localhost:3000/admin/users3/fetchdata",

                method:'get',
                data:{id:id},
                dataType:'json',
                success:function(data){

                    if(type == "active"){
                        data.active = checked;

                    }
                    if (type == "admin"){
                        data.admin = checked;
                    }


                    // save into database
                    let action = "http://localhost:3000/admin/users3/" + data.id;

                    //make a parse
                    let pars = {
                        '_token': '{{ csrf_token() }}',
                        '_method': 'put',
                        'name' : data.name,
                        'email' : data.email
                    };

                    if(data.active == "1"){
                        pars.inlineActive = "active";
                    }
                    if(data.admin){
                        pars.inlineAdmin = "admin";
                    }


                    // Post the data to the URL
                    $.post(action, pars, 'json')
                        .done(function (data) {
                            // Noty success message
                            new Noty({
                                type: data.type,
                                text: data.text
                            }).show();

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


                }
            })


        });






    });


    // Delete a user
    function deleteUser(id) {
        // Delete the genre from the database
        let pars = {
            '_token': '{{ csrf_token() }}',
            '_method': 'delete'
        };
        $.post(`/admin/users2/${id}`, pars, 'json')
            .done(function (data) {
                if(data.type == "success"){
                    $('#users-table').DataTable().ajax.reload();

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
</script>