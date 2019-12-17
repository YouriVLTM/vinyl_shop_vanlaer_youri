<script>
    $(function () {

        let id = $('#orders-table').data("id");
        console.log(id);

        $('#orders-table').DataTable({
            processing: true,
            serverSide: true,

            "ajax": {
                "url": "{{ url('admin/orders/get_orderlines') }}",
                "dataType": "json",
                "type": "GET",
                "data": {_token: "{{csrf_token()}}" , 'id':id}
            },
            columns: [
                {data: 'id',name:'id'},
                {data: 'artist', name:'artist'},
                {data: 'title', name:'title'},
                {data: 'cover', name:'cover'},
                {data: 'totalPrice', name:'totalPrice'},
                {data: 'quantity', name:'quantity'},
                {data: 'created_at', name:'created'},
                {data: 'action', name:'action', orderable: false, searchable: false}


            ]
        })

    });
</script>