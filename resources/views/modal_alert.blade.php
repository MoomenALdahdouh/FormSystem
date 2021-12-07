<div id="successfully-save" class="modal">
    <div class="modal-dialog">
        <div class="modal-content model-style">
            {{-- <div class="modal-header"><button class="btn float-right"><i class="las la-times"></i></button></div>--}}
            <div class="modal-body text-center">
                <button class="btn float-right" data-bs-dismiss="modal"><i class="las la-times"></i></button>
                <br>
                <br>
                <p><i class="alert-icon text-success las la-check-circle"></i></p>
                <br>
                <h6 id="message">{{__('strings.saved')}}</h6>
                <br>
            </div>
            <button class="btn btn-success" data-bs-dismiss="modal">{{__('strings.ok')}}</button>
            {{--<div class="modal-footer">
                <button id="close" class="btn" type="button" data-bs-dismiss="modal">Close</button>
            </div>--}}
        </div>
    </div>
</div>

<div id="successfully-creat" class="modal">
    <div class="modal-dialog">
        <div class="modal-content model-style">
            {{-- <div class="modal-header"><button class="btn float-right"><i class="las la-times"></i></button></div>--}}
            <div class="modal-body text-center">
                <button class="btn float-right" data-bs-dismiss="modal"><i class="las la-times"></i></button>
                <br>
                <br>
                <p><i class="alert-icon text-primary las la-check-circle"></i></p>
                <br>
                <h6 id="message">{{__('strings.created_user')}}</h6>
                <br>
            </div>
            <button class="btn btn-primary" data-bs-dismiss="modal">{{__('strings.ok')}}</button>
            {{--<div class="modal-footer">
                <button id="close" class="btn" type="button" data-bs-dismiss="modal">Close</button>
            </div>--}}
        </div>
    </div>
</div>

<div id="successfully-creat-activity" class="modal">
    <div class="modal-dialog">
        <div class="modal-content model-style">
            {{-- <div class="modal-header"><button class="btn float-right"><i class="las la-times"></i></button></div>--}}
            <div class="modal-body text-center">
                <button class="btn float-right" data-bs-dismiss="modal"><i class="las la-times"></i></button>
                <br>
                <br>
                <p><i class="alert-icon text-primary las la-check-circle"></i></p>
                <br>
                <h6 id="message">{{__('strings.created_activity')}}</h6>
                <br>
            </div>
            <button class="btn btn-primary" data-bs-dismiss="modal">{{__('strings.ok')}}</button>
            {{--<div class="modal-footer">
                <button id="close" class="btn" type="button" data-bs-dismiss="modal">Close</button>
            </div>--}}
        </div>
    </div>
</div>

<div id="can-not-remove" class="modal">
    <div class="modal-dialog">
        <div class="modal-content model-style">
            {{-- <div class="modal-header"><button class="btn float-right"><i class="las la-times"></i></button></div>--}}
            <div class="modal-body text-center">
                <button class="btn float-right" data-bs-dismiss="modal"><i class="las la-times"></i></button>
                <br>
                <br>
                <p><i class="alert-icon text-warning las la-exclamation-triangle"></i></p>
                <br>
                <h6 id="message">{{__('strings.can_not_remove_project')}}</h6>
                <br>

            </div>
            <button class="btn btn-warning" data-bs-dismiss="modal">{{__('strings.ok')}}</button>
            {{--<div class="modal-footer">
                <button id="close" class="btn" type="button" data-bs-dismiss="modal">Close</button>
            </div>--}}
        </div>
    </div>
</div>
<div id="can-not-remove-subproject" class="modal">
    <div class="modal-dialog">
        <div class="modal-content model-style">
            {{-- <div class="modal-header"><button class="btn float-right"><i class="las la-times"></i></button></div>--}}
            <div class="modal-body text-center">
                <button class="btn float-right" data-bs-dismiss="modal"><i class="las la-times"></i></button>
                <br>
                <br>
                <p><i class="alert-icon text-warning las la-exclamation-triangle"></i></p>
                <br>
                <h6 id="message">{{__('strings.can_not')}}
                    <strong>{{__('strings.subproject')}}</strong> {{__('strings.have')}}
                    <strong>{{__('strings.activities')}}</strong></h6>
                <br>

            </div>
            <button class="btn btn-warning" data-bs-dismiss="modal">{{__('strings.ok')}}</button>
            {{--<div class="modal-footer">
                <button id="close" class="btn" type="button" data-bs-dismiss="modal">Close</button>
            </div>--}}
        </div>
    </div>
</div>


<div id="successfully-remove" class="modal">
    <div class="modal-dialog">
        <div class="modal-content model-style">
            {{-- <div class="modal-header"><button class="btn float-right"><i class="las la-times"></i></button></div>--}}
            <div class="modal-body text-center">
                <button class="btn float-right" data-bs-dismiss="modal"><i class="las la-times"></i></button>
                <br>
                <br>
                <p><i class="alert-icon text-info las la-check-circle"></i></p>
                <br>
                <h6 id="message">{{__('strings.successfully_removed')}}</h6>
                <br>
            </div>
            <button class="btn btn-info" data-bs-dismiss="modal">{{__('strings.ok')}}</button>
            {{--<div class="modal-footer">
                <button id="close" class="btn" type="button" data-bs-dismiss="modal">Close</button>
            </div>--}}
        </div>
    </div>
</div>

<div id="ask-remove" class="modal">
    <div class="modal-dialog">
        <div class="modal-content model-style">
            {{-- <div class="modal-header"><button class="btn float-right"><i class="las la-times"></i></button></div>--}}
            <div class="modal-body text-center">
                <button class="btn float-right" data-bs-dismiss="modal"><i class="las la-times"></i></button>
                <br>
                <br>
                <p><i class="alert-icon text-danger las la-question"></i></p>
                <br>
                <h6 id="message">{{__('strings.are_you_sure_remove_all')}}</h6>
                <br>
            </div>
            <button id="confirm-remove" class="selector btn btn-danger"
                    data-bs-dismiss="modal">{{__('strings.yes_clear_all')}}</button>
        </div>
    </div>
</div>
<div id="ask-remove-question" class="modal">
    <div class="modal-dialog">
        <div class="modal-content model-style">
            {{-- <div class="modal-header"><button class="btn float-right"><i class="las la-times"></i></button></div>--}}
            <div class="modal-body text-center">
                <button class="btn float-right" data-bs-dismiss="modal"><i class="las la-times"></i></button>
                <br>
                <br>
                <p><i class="alert-icon text-danger las la-question"></i></p>
                <br>
                <h6 id="message">{{__('strings.are_you_sure_remove_this')}}</h6>
                <br>
            </div>
            <button id="confirm-remove-question" class="selector btn btn-danger"
                    data-bs-dismiss="modal">{{__('strings.yes_remove')}}</button>
        </div>
    </div>
</div>
{{--//TODO:: MOOMEN S. ALDAHDOUH 11/26/2021--}}
<div id="something-wrong" class="modal">
    <div class="modal-dialog">
        <div class="modal-content model-style">
            {{-- <div class="modal-header"><button class="btn float-right"><i class="las la-times"></i></button></div>--}}
            <div class="modal-body text-center">
                <button class="btn float-right" data-bs-dismiss="modal"><i class="las la-times"></i></button>
                <br>
                <br>
                <p><i class="alert-icon text-warning las la-exclamation-triangle"></i></p>
                <br>
                <h6 id="message">{{__('strings.wrong')}}<strong>{{__('strings.try_again')}}</strong></h6>
                <br>
            </div>
            <button class="btn btn-warning" data-bs-dismiss="modal">{{__('strings.ok')}}</button>
            {{--<div class="modal-footer">
                <button id="close" class="btn" type="button" data-bs-dismiss="modal">Close</button>
            </div>--}}
        </div>
    </div>
</div>
