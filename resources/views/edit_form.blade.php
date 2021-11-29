<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit form') }}
        </h2>
    </x-slot>
    <br>
    <br>
    <br>
    <div class="container">
        <div class="row">
            {{--Section element component form--}}
            <div class="col-md-3">
                <div class="card shadow">
                    <div class="card-header alert-secondary">
                        <i class="las la-border-style shadow"></i> <strong>Components</strong>
                    </div>
                    <div class="card-body">
                        <ul class="component-list list-group-item">
                            <li>
                                <button id="text-field-button" class="btn btn-outline-secondary shadow">
                                    <i class="button_icon las la-align-left float-left"></i>
                                    <span>Text Field</span>
                                </button>
                            </li>
                            <li>
                                <button id="text-area-button" class="btn btn-outline-secondary shadow"><i
                                        class="button_icon las la-align-justify float-left"></i><span>Text Area</span></button>
                            </li>
                            <li>
                                <button id="number-button" class="btn btn-outline-secondary shadow"><i
                                        class="button_icon las la-sort-numeric-down float-left"></i><span>Number</span></button>
                            </li>
                            <li>
                                <button id="calender-button" class="btn btn-outline-secondary shadow">
                                    <i class="button_icon las la-calendar-plus float-left"></i><span>Calender</span></button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            {{--Section qustions form--}}
            <div class="col-md-9">
                <div class="card shadow">
                    <div class="card-body">
                        <i class="las la-border-style shadow"></i> <strong>Form Area</strong>
                        <i class="apply-icon las la-feather-alt rounded-md btn-outline-primary float-right"></i>
                    </div>
                </div>
                <div class="card shadow">
                    <div class="card-body">
                        <ul id="form-body" class="questions-list list-group-item">
                            <li class="btn btn-light text-center">
                                <br>
                                <br>
                                <div>
                                    <i class="las la-boxes" style="font-size: 50px"></i>
                                    <p>Drag Components here!</p>
                                </div>
                                <br>
                                <br>
                            </li>
                        </ul>
                    </div>
                    <div class="card-footer alert-light">
                        <button id="create_user" class="shadow btn btn-primary float-right"><i
                                class="las la-plus-square"></i> Save
                        </button>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
    @include('modal_alert')
    @push('js')
        <script src="{{asset('js/form.js')}}" defer></script> {{--Must add defer to active js file--}}
    @endpush
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
</x-app-layout>
