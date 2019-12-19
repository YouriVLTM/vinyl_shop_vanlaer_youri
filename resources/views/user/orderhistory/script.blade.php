<script>
    $(function () {

        let userid = '{{auth()->user()->id}}';
        // get orders from user
        $('#orders-table').DataTable({
            processing: true,
            serverSide: true,

            "ajax": {
                "url": "{{ url('user/history/get_orders') }}",
                "dataType": "json",
                "type": "GET",
                "data": {_token: "{{csrf_token()}}","userid":userid}
            },
            columns: [
                {data: 'id',name:'id'},
                {data: 'totalPrice', name:'totalPrice'},
                {data: 'created_at', name:'created'},
                {data: 'action', name:'action', orderable: false, searchable: false}


            ]
        })

        $(document).on('click', '.btn-view', function(){
            let id = $(this).data('id');

            // get orderlines data
            $.ajax({
                url: "{{ url('user/history/get_orderlines') }}",
                method:'get',
                data:{ _token: "{{csrf_token()}}","orderid":id },
                dataType:'html',
                success:function(data){
                   console.log(data);

                   $('.modal-body').html(data);
                    //show modal
                    $('#modal-orderline').modal('show');

                },
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    console.log("Status: " + textStatus);
                }
            })




            console.log(id);

        });




    });
</script>