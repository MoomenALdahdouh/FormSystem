<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit form') }}
        </h2>
    </x-slot>
    <br>
    <br>
    <br>
    <br>
    <div class="container">
        <div class="row">
            {{--Section element component form--}}
            <div class="col-md-3">
                <div class="card">
                    <div class="card-header alert-secondary">
                        <i class="las la-border-style"></i> <strong>Components</strong>
                    </div>
                    <div class="card-body">
                        <ul class="component-list list-group-item">
                            <li>
                                <button class="btn btn-outline-primary">
                                    <i class="las la-align-left float-left"></i>
                                    <span>Text Field</span>
                                </button>
                            </li>
                            <li>
                                <button class="btn btn-outline-primary"><i
                                        class="las la-align-justify float-left"></i><span>Text Area</span></button>
                            </li>
                            <li>
                                <button class="btn btn-outline-primary"><i
                                        class="las la-sort-numeric-down float-left"></i><span>Number</span></button>
                            </li>
                            <li>
                                <button class="btn btn-outline-primary">
                                    <i class="las la-calendar-plus float-left"></i><span>Calender</span></button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            {{--Section qustions form--}}
            <div class="col-md-9">
                <div class="card">
                    <div class="card-body">
                        <i class="las la-border-style"></i> <strong>Form Area</strong>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <ul class="questions-list list-group-item">
                            <li>
                                <button id="delete" class="delete rounded-md alert btn-secondary float-right text-light" title="delete"><i
                                        class="bx bx-trash"></i></button>
                                <input class="rounded-md col-sm-11 alert alert-secondary" type="text" name="name"
                                       placeholder="name">
                            </li>
                        </ul>
                    </div>
                    <div class="card-footer alert-light">
                        <button id="create_user" class="btn btn-primary float-right"><i
                                class="las la-plus-square"></i> Create
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
