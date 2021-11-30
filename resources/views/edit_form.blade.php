<x-app-layout>
    <x-slot name="header">
        <h1 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit form') }}
        </h1>
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
                                <button id="text-field-button" class="selector btn btn-secondary shadow">
                                    <i class="button_icon las la-align-left float-left"></i>
                                    <span>Text Field</span>
                                </button>
                            </li>
                            <li>
                                <button id="text-area-button" class="selector btn btn-secondary shadow"><i
                                        class="button_icon las la-align-justify float-left"></i><span>Text Area</span>
                                </button>
                            </li>
                            <li>
                                <button id="number-button" class="selector btn btn-secondary shadow"><i
                                        class="button_icon las la-sort-numeric-down float-left"></i><span>Number</span>
                                </button>
                            </li>
                            <li>
                                <button id="calender-button" class="selector btn btn-secondary shadow">
                                    <i class="button_icon las la-calendar-plus float-left"></i><span>Calender</span>
                                </button>
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
                        <i class="apply-icon las la-feather-alt rounded-md btn-outline-primary float-right"
                           title="apply"></i>
                    </div>
                </div>
                <div class="card shadow">
                    <div class="card-body">
                        <input type="hidden" id="form_id" name="form_id" value="{{$form->id}}">
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
                        <button id="create_form" class="selector shadow btn btn-primary float-right"><i
                                class="las la-plus-square"></i> Save
                        </button>
                        <button id="clean_form" class="selector clear-button shadow btn btn-danger float-right">
                            <i class="las la-eraser"></i> Clear
                        </button>
                    </div>
                    <br>
                </div>
            </div>
        </div>
    </div>
    {{--model edit questions--}}
    <div>
        <div id="edit_question" class="modal">
            <div class="modal-dialog">
                <div class="modal-content model-style">
                    <div class="modal-header">
                        <strong class="col-sm-11"><i class="las la-edit"></i>Edit question</strong>
                        <button class="btn float-right" data-bs-dismiss="modal"><i class="las la-times"></i></button>
                    </div>
                    <div class="modal-body">
                        <strong>Enter question title</strong>
                        <input id="title" class="rounded-md alert col-sm-12 alert-secondary" type="text" name="title"
                               placeholder="Question title">
                        <br>
                        <p class="alert alert-warning"><i class="las la-key"></i>&nbsp;question key &nbsp; <strong id="question_key" >key</strong>
                        </p>
                    </div>
                    <button id="save_edit_question" class="selector btn btn-primary" data-bs-dismiss="modal">Save
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{--include form component questions--}}
    {{--<div id="divCheckbox" style="display: none;">
        @include('form_body')
    </div>--}}

    {{--Js--}}
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
