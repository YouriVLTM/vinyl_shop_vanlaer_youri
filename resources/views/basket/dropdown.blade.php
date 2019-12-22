@if(session('cart'))




    <ul class="list-unstyled">

        @foreach(session('cart') as $id => $details)

            <li class="media">
                <div class="container">

                    <div class="row">
                        <div class="col-3">
                            <img src="/assets/vinyl.png" class="mr-3 imgdropdownbasket basketcovers"  data-src="{{ $details["cover"] }}">
                        </div>
                        <div class="col-9">
                            <span>{{ $details["title"]}}</span>
                            <br>
                            <span>Qty :  {{ $details["quantity"]}}</span>

                        </div>
                    </div>
                </div>

            </li>
            <hr>
        @endforeach
    </ul>

    <hr>

    <a href="{{ url('/basket') }}"  class="btn btn-secondary btn-block">View more</a>

@endif


