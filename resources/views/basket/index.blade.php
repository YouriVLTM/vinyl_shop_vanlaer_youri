@extends('layouts.template')

@section('title', 'Basket')

@section('main')




    <h1>Basket</h1>
    <br>

    <h3>Totaal prijs: &#8364; {{$totalprice}}</h3>
    <br>

    @if($cart != null)
    <!--Table -->
    <table class="table table-hover">

        <tbody>

            <thead class="thead-dark">
            <tr>
                <th scope="col">Picture</th>
                <th scope="col">Description</th>
                <th scope="col">Price</th>
                <th scope="col">Quantity</th>
                <th scope="col">Trash</th>
            </tr>
            </thead>

            @foreach($cart as $id => $details)

                <tr>
                    <th scope="row">
                        <img src="/assets/vinyl.png" class="mr-3 imgcoverorderlines basketviewimg" data-src="{{ $details["cover"] }}">
                    </th>
                    <td>
                        <a href="{{url('shop/')}}/{{ $details["recordid"]}}">{{ $details["title"]}} - {{ $details["artist"]}}</a>

                    </td>
                    <td>&#8364; {{ $details["price"]}}</td>
                    <td>
                        <input type="number" value="{{ $details["quantity"]}}"/>
                    </td>
                    <td>
                        <a href="">
                            <i class="fas fa-trash fa-lg"></i>
                        </a>
                    </td>
                </tr>

                @endforeach

        </tbody>
    </table>
    @else
        <p>niks</p>
    @endif





@endsection

@section('script_after')
    <script>
        $(function(){
            $('.basketviewimg').each(function(){

                // Replace vinyl.png with real cover
                if( $(this).data('src')!= ''){
                    $(this).attr('src', $(this).data('src'));
                }

            })
        });
    </script>
@endsection