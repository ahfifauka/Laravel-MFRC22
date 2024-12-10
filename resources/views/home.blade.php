@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card">
                <div class="card-header bg-primary text-white">
                    <h1 class="card-title text-center pt-2">TOL SOROJA</h1>
                </div>
                <div class="card-body">
                    <div class="text-center d-flex gap-2 align-items-center justify-content-center">
                        <h1 id="text"></h1>
                        <h1 id="saldo"></h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('js')
<script>
    function getRfidData() {
        $.getJSON("{{ route('rfid.showData') }}", function(data, textStatus, jqXHR) {
            console.log(data);
            if (data && data.hasOwnProperty('saldo')) {
            if (data.saldo !== null) {
                $("#text").html("Saldo : ");
                $("#saldo").html(" " + data.saldo);
                setTimeout(() => {
                    truncateData()
                }, 2000);
            } else {
                $("#saldo").html("");
            }
        } else {
            $("#saldo").html("");
            $("#text").html("Tempelkan Kartu");
            }
        });
    }

    function truncateData() {
        $.getJSON("{{ route('rfid.truncateData') }}", function(data, textStatus, jqXHR) {
            console.log(textStatus);
        });
    }

    $(document).ready(function() {
        let counter = 0; // Menghitung waktu interval

        setInterval(function() {
            getRfidData();
        }, 1000); 
    });
</script>
@endpush