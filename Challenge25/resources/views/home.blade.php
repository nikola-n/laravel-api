@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Vehicles</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a href="{{ route('create') }}" class="btn btn-success" style="float:right">Create new Vehicle</a>

                    <table class="table" id="vehicles-table">
                        <thead>
                            <tr>
                                <th>Brand</th>
                                <th>Model</th>
                                <th>Plate Number</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<script>


function getVehicles() {
        $.get('api/vehicles',
            {
                'x-csrf-token': $('meta[name="csrf-token"]').attr('content'),
                'api_token': $('meta[name="api-token"]').attr('content'),
            },
            function(data){
                $('#vehicles-table tbody').html('');
                $.each(data.data, function(index, value) {
                    $('#vehicles-table tbody').append(
                        '<tr>'+
                            '<td>'+value.brand+'</td>'+
                            '<td>'+value.model+'</td>'+
                            '<td>'+value.plate_number+'</td>'+
                            '<td>'+
                                '<a href="vehicles/'+value.id+'/edit" class="btn btn-warning editBtn" style="padding: 2px 10px; margin: 0px 3px;">Edit</a>'+
                                '<button id="deleteVehicle" class="btn btn-danger" style="padding: 2px 10px; margin: 0px 3px;" data-id="'+value.id+'">Delete</button>'+
                            '</td>'+
                        '</tr>');
                });
            }
        );
    };
    $(document).on('click', '#deleteVehicle', function(){
        $.post('api/vehicles/'+$(this).attr('data-id')+'/delete', {
            'x-csrf-token': $('meta[name="csrf-token"]').attr('content'),
            'api_token': $('meta[name="api-token"]').attr('content')
        }, function(data){
                getVehicles();
        })
    });

$(document).ready(function(){

getVehicles();

});
</script>
@endsection
