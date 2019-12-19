<ul class="list-unstyled">

    @foreach ($orderlines as $orderline)




    <li class="media">
        <div class="container">
            <h2>{{ $orderline->title }}</h2>
        <div class="row">
            <div class="col-3">

                <img src="{{ $orderline->cover }}" class="mr-3 imgcoverorderlines" alt="...">
            </div>
            <div class="col-9">

                <p>Artist :  {{ $orderline->artist }}</p>
                <p>Quantity :  {{ $orderline->quantity }}</p>
                <p>TotalPrice :  &#8364; {{ $orderline->totalPrice }}</p>

            </div>
        </div>
        </div>

    </li>
        <hr>

    @endforeach

</ul>