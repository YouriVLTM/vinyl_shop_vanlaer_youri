<script>
    $(function () {
        console.log("test");

        $('#orders-table').DataTable({
            processing: true,
            serverSide: true,

            "ajax": {
                "url": "{{ url('admin/orders/get_orders') }}",
                "dataType": "json",
                "type": "GET",
                "data": {_token: "{{csrf_token()}}"}
            },
            columns: [
                {data: 'id',name:'id'},
                {data: 'username', name:'username'},
                {data: 'totalPrice', name:'totalPrice'},
                {data: 'created_at', name:'created'},
                {data: 'action', name:'action', orderable: false, searchable: false}


            ]
        })

    });
</script>