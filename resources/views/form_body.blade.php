<ul id="form-body" class="questions-list list-group-item">

    <li id="text_field_li"><p class='questions-title'>Text Field</p>
        <div class="col-sm-1 float-right alert alert-secondary">
            <button id="edit" class="selector rounded-md btn-outline-danger" title="edit"><i class="las la-edit"></i>
            </button>
            <button id="delete" class="selector rounded-md btn-outline-primary" title="delete"><i
                    class="bx bx-trash"></i></button>
        </div>
        <input id='input_question_key' type='hidden' name='input_question_key' value='key'>
        <input class="rounded-md col-sm-11 alert alert-secondary" type="text" name="field" placeholder="Text Field">
    </li>

    <li>
        <div class=" float-right alert alert-dark">
            <button id="edit" class="rounded-md btn-outline-danger" title="edit"><i
                    class="las la-edit"></i></button>
            <button id="delete" class="rounded-md btn-outline-primary" title="delete"><i
                    class="bx bx-trash"></i></button>
        </div>
        <textarea class="rounded-md col-sm-11 alert alert-secondary" name="area"
                  placeholder="Text Area"></textarea>
    </li>
    <li>
        <div class=" float-right alert alert-dark">
            <button id="edit" class="rounded-md btn-outline-danger" title="edit"><i
                    class="las la-edit"></i></button>
            <button id="delete" class="rounded-md btn-outline-primary" title="delete"><i
                    class="bx bx-trash"></i></button>
        </div>
        <input class="rounded-md col-sm-11 alert alert-secondary" type="number" name="number"
               placeholder="Number">
    </li>
    <li>
        <div class=" float-right alert alert-dark">
            <button id="edit" class="rounded-md btn-outline-danger" title="edit"><i
                    class="las la-edit"></i></button>
            <button id="delete" class="rounded-md btn-outline-primary" title="delete"><i
                    class="bx bx-trash"></i></button>
        </div>
        <input class="rounded-md col-sm-11 alert alert-secondary" type="date" name="calender"
               placeholder="calender">
    </li>

</ul>


{{-- Js
Array.from(document.querySelectorAll('#text-field-button')).forEach(bttn => {
            bttn.addEventListener('click', (e) => {
                e.preventDefault();
                let button_id = e.target.parentNode.querySelector('#text-field-button');

            });
        });
--}}
