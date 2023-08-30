@extends('layouts.admin')
@section('page-title')
    {{ __('Landing Page') }}
@endsection
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item">{{ __('Landing Page') }}</li>
@endsection

@php
    $lang = \App\Models\Utility::getValByName('default_language');
    // $logo=asset(Storage::url('uploads/logo/'));
    $logo = \App\Models\Utility::get_file('uploads/logo');
    $logo_light = \App\Models\Utility::getValByName('logo_light');
    $logo_dark = \App\Models\Utility::getValByName('logo_dark');
    $company_favicon = \App\Models\Utility::getValByName('company_favicon');
    $setting = \App\Models\Utility::colorset();
    // $mode_setting = \App\Models\Utility::mode_layout();
    $color = !empty($setting['color']) ? $setting['color'] : 'theme-3';
    $SITE_RTL = isset($setting['SITE_RTL']) ? $setting['SITE_RTL'] : 'off';
    $meta_image = \App\Models\Utility::get_file('uploads/meta/');

@endphp



@push('script-page')
@endpush

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item">{{ __('Landing Page') }}</li>
@endsection

@section('action-btn')
    <ul class="nav nav-pills cust-nav   rounded  mb-3" id="pills-tab" role="tablist">
        @include('landingpage::layouts.tab')
    </ul>
@endsection

@section('content')
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                {{--  Start for all settings tab --}}
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-lg-10 col-md-10 col-sm-10">
                                <h5>{{ __('Plan Section') }}</h5>
                            </div>
                        </div>
                    </div>

                    {{ Form::open(['route' => 'pricing_plan.store', 'method' => 'post', 'enctype' => 'multipart/form-data']) }}
                    <div class="card-body">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('Title', __('Title'), ['class' => 'form-label']) }}
                                    {{ Form::text('plan_title', $settings['plan_title'], ['class' => 'form-control ', 'placeholder' => __('Enter Title')]) }}
                                    @error('mail_host')
                                        <span class="invalid-mail_driver" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    {{ Form::label('Heading', __('Heading'), ['class' => 'form-label']) }}
                                    {{ Form::text('plan_heading', $settings['plan_heading'], ['class' => 'form-control ', 'placeholder' => __('Enter Heading')]) }}
                                    @error('mail_host')
                                        <span class="invalid-mail_driver" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>


                            <div class="col-md-12">
                                <div class="form-group">
                                    {{ Form::label('Description', __('Description'), ['class' => 'form-label']) }}
                                    {{ Form::text('plan_description', $settings['plan_description'], ['class' => 'form-control', 'placeholder' => __('Enter Description')]) }}
                                    @error('mail_port')
                                        <span class="invalid-mail_port" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <input class="btn btn-print-invoice btn-primary m-r-10" type="submit"
                            value="{{ __('Save Changes') }}">
                    </div>
                    {{ Form::close() }}
                </div>
                {{--  End for all settings tab --}}
            </div>
        </div>
    </div>
@endsection
