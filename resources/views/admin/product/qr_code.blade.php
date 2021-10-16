@extends('layouts.app')
@section('title', 'Show Product')

@section('content')


    <button class="btn btn-success" onclick="printDiv('printMe')">Print</button>
    <br>

    <div class="col-md-6 mx-auto" id='printMe'>
        <div class="card">
            <div class="card-body">
                <center>
                    {!! QrCode::/*format('png')->merge('https://pngimg.com/uploads/google/google_PNG19642.png', .3, true)->*/size(300)->generate($qr_code) !!}

                    <hr>
                    <p>{{$qr_code}}</p>
                </center>

            </div>
        </div>

    </div>

    <script>
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;

        }
    </script>

@stop