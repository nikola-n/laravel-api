@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create New Vehicles') }}</div>
                <div class="card-body">

                        <div class="form-group row">
                            <label for="brand" class="col-md-4 col-form-label text-md-right">{{ __('Brand') }}</label>

                            <div class="col-md-6">
                                <input id="brand" type="text" class="form-control @error('brand') is-invalid @enderror" name="brand" value="{{ old('brand') }}" required autocomplete="brand" autofocus>

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
                                <button type="submit" id="saveVehicle" class="btn btn-primary">
                                    {{ __('Save') }}
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

<Script>

    $(document).ready(function(){
        $('#saveVehicle').on('click',function(){
            $.post('api/vehicles/store', {
                'x-csrf-token': $('meta[name="csrf-token"]').attr('content'),
            'api_token': $('meta[name="api-token"]').attr('content'),
            'brand': $('#brand').val(),
            'model': $('#model').val(),
            'plate_number': $('#plate_number').val(),
            'insurance_date' : $('#insurance_date').val()
            },
            function(data){
                    if(data.success = 1){
                    window.location ='{{route('home')}}';
                    }
                    })
            })
        })

</Script>
@endsection
