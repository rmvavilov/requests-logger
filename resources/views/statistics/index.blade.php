@extends('layouts.app')

@section('content')
    @include('parts.logger')

    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-4">
                <chart-wrap-component :is-fetching="isFetching" :type="'browser'" :data="browsers">Browsers</chart-wrap-component>
            </div>

            <div class="col-md-4">
                <chart-wrap-component :is-fetching="isFetching" :type="'device'" :data="devices">Devices</chart-wrap-component>
            </div>

            <div class="col-md-4">
                <chart-wrap-component :is-fetching="isFetching" :type="'platform'" :data="platforms">Platforms</chart-wrap-component>
            </div>

            <div class="col-md-12">
                <datatable-component></datatable-component>
            </div>
        </div>
    </div>
@endsection
