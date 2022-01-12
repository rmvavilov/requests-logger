@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @include('parts.logger')

                <datatable-component></datatable-component>
            </div>
        </div>
    </div>
@endsection
