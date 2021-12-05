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
                <h6 id="message">Successfully save new updates</h6>
                <br>
            </div>
            <button class="btn btn-success" data-bs-dismiss="modal">OK</button>
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
                <h6 id="message">Successfully create new user</h6>
                <br>
            </div>
            <button class="btn btn-primary" data-bs-dismiss="modal">OK</button>
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
                <h6 id="message">Successfully create new activity</h6>
                <br>
            </div>
            <button class="btn btn-primary" data-bs-dismiss="modal">OK</button>
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
                <h6 id="message">You can not remove this project because it's have subprojects!</h6>
                <br>

            </div>
            <button class="btn btn-warning" data-bs-dismiss="modal">OK</button>
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
                <h6 id="message">You can not remove this <strong>subproject</strong> because it's have <strong>activities!</strong></h6>
                <br>

            </div>
            <button class="btn btn-warning" data-bs-dismiss="modal">OK</button>
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
                <h6 id="message">Successfully removed the item</h6>
                <br>
            </div>
            <button class="btn btn-info" data-bs-dismiss="modal">OK</button>
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
                <h6 id="message">Are you sure you want to remove all questions?</h6>
                <br>
            </div>
            <button id="confirm-remove" class="selector btn btn-danger" data-bs-dismiss="modal">Yes, Clear All</button>
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
                <h6 id="message">Are you sure you want to remove this questions?</h6>
                <br>
            </div>
            <button id="confirm-remove-question" class="selector btn btn-danger" data-bs-dismiss="modal">Yes, Clear All</button>
        </div>
    </div>
</div>

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
                <h6 id="message">Something wrong! <strong>Please try again.</strong></h6>
                <br>
            </div>
            <button class="btn btn-warning" data-bs-dismiss="modal">OK</button>
            {{--<div class="modal-footer">
                <button id="close" class="btn" type="button" data-bs-dismiss="modal">Close</button>
            </div>--}}
        </div>
    </div>
</div>
