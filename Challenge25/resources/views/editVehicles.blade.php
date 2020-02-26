@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Vehicle') }}</div>
                <div class="card-body">
                      <div class="form-group row">
                        <label for="brand" class="col-md-4 col-form-label text-md-right">{{ __('Brand') }}</label>
                            <div class="col-md-6">
                            <input id="brand" type="text" class="form-control @error('brand') is-invalid @enderror" name="brand" required autocomplete="brand" autofocus>

                                @error('brand')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="model" class="col-md-4 col-form-label text-md-right">{{ __('Model') }}</label>

                            <div class="col-md-6">
                            <input id="model" type="text" class="form-control @error('model') is-invalid @enderror" name="model" required autocomplete="model">

                                @error('model')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="plate_number" class="col-md-4 col-form-label text-md-right">{{ __('Plate Number') }}</label>

                            <div class="col-md-6">
                                <input id="plate_number" type="text" class="form-control @error('plate_number') is-invalid @enderror" name="plate_number" required autocomplete="plate_number">

                                @error('plate_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="insurance_date" class="col-md-4 col-form-label text-md-right">{{ __('Insurance Date') }}</label>

                            <div class="col-md-6">
                            <input id="insurance_date" type="date" class="form-control @error('insurance_date') is-invalid @enderror" name="insurance_date" required autocomplete="insurance_date">

                                @error('insurance_date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" id="updateVehicle" class="btn btn-primary">
                                    {{ __('Update') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $.get('/api/vehicles/{{$id}}', {
            'x-csrf-token': $('meta[name="csrf-token"]').attr('content'),
            'api_token': $('meta[name="api-token"]').attr('content')
        }, function(data){
            console.log(data);
            if(data.success == 1) {
                $('#brand').val(data['data']['brand']);
                $('#model').val(data['data']['model']);
                $('#plate_number').val(data['data']['plate_number']);
                $('#insurance_date').val(data['data']['insurance_date']);
            }
        })
    })

    $(document).on('click', '#updateVehicle', function() {
        $.post('/api/vehicles/{{$id}}/update', {
            'x-csrf-token': $('meta[name="csrf-token"]').attr('content'),
            'api_token': $('meta[name="api-token"]').attr('content'),
            'brand': $('#brand').val(),
            'model': $('#model').val(),
            'plate_number': $('#plate_number').val(),
            'insurance_date' : $('#insurance_date').val()
        }, function(data){
            if(data.success == 1) {
                    window.location = '{{route('home')}}';
            }
        })
    })
</script>
@endsection
