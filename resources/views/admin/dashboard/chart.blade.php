<script>
    $(function(){

        // get data
        $.ajax({
            url:"{{ url('admin/dashboard/getOrders') }}",

            method:'get',
            data:{},
            dataType:'json',
            success:function(data){
               console.log(data);

                var ctx = document.getElementById('ordersChart').getContext('2d');
                var chart = new Chart(ctx, {
                    // The type of chart we want to create
                    type: 'line',

                    // The data for our dataset
                    data: {
                        labels: data.month,
                        datasets: [{
                            label: 'Orders',
                            backgroundColor: 'rgb(94, 180, 236)',
                            borderColor: 'rgb(100, 154, 187)',
                            data: data.data
                        }]
                    },

                    // Configuration options go here
                    options: {
                        scales: {
                            yAxes: [{
                                ticks: {
                                    suggestedMin: 0,
                                    suggestedMax: 10
                                }
                            }]
                        }
                    }

                });


            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                console.log("Status: " + textStatus);
                console.log("Error: " + errorThrown);
            }
        })



        //get pie
        $.ajax({
            url:"{{ url('admin/dashboard/getUsersFunctionCount') }}",

            method:'get',
            data:{},
            dataType:'json',
            success:function(data){
                console.log(data);

                var ctx = document.getElementById('myChart').getContext('2d');
                var myPieChart = new Chart(ctx, {
                    type: 'pie',

                    data: {
                        labels: data.functions,
                        datasets: [{
                            label: "Population (millions)",
                            backgroundColor: ["#3e95cd", "#0FA548","#EB3A2A"],
                            data: data.usercount
                        }]
                    },

                    options: {
                        title: {
                            display: true,
                            text: 'Aantal Users'
                        }
                    }
                });


            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                console.log("Status: " + textStatus);
                console.log("Error: " + errorThrown);
            }
        })


    });
</script>