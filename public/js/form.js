$(function () {
    let form_size = 0;
    let form_input_id = $('#form_id');
    let form_id = form_input_id.val();
    let question_id = form_size;
    let form_body_ul = $('#form-body');
    let form_body = form_body_ul.html();
    let input_field_num = 0;
    let input_area_num = 0;
    let input_number_num = 0;
    let input_calender_num = 0;
    let question_title = '';
    let tag_question_key_in_model = $('#question_key');
    let question_key = 'key';
    let que_key;
    //let tag_question_key = $('#input_question_key');

    /*Questions Model array list*/
    let questionsList = [];

    /*Create Question model*/
    function Question(form_fk_id, questions_key, title, body, type) {
        this.form_fk_id = form_fk_id;
        this.questions_key = questions_key;
        this.title = title;
        this.body = body;
        this.type = type;
    }

    /*Main function*/
    $(document).ready(function () {

        /*Button on click*/
        //TODO:: Add Selector in class each tag you need to click it or you can use button tag type in the selector
        $(document).on('click', 'button', function () {
            const button_id = $(this).attr('id');
            switch (button_id) {
                case 'text-field-button':
                    add_input_field();
                    break;
                case 'text-area-button':
                    add_input_area();
                    break;
                case 'number-button':
                    add_input_number();
                    break;
                case 'calender-button':
                    add_calender_field();
                    break;
                case 'delete':
                    $(this).closest('li').remove();
                    delete_question();
                    break;
                case 'clean_form':
                    $('#ask-remove').modal('show');
                    break;
                case 'confirm-remove':
                    clear_form();
                    break;
                /*case 'edit':
                    $('#edit_question').modal('show');
                    break;
                case 'save_edit_question':
                    save_edit_question();
                    break;*/

            }
        });

        /*Input change*/
        $(document).on("input", 'input', function () {
            const input_name = $(this).attr('name');
            //console.log(input_name);
            //console.log($(this).val());
            switch (input_name) {
                case 'title':
                    question_title = $(this).val();
                    edit_question(question_title);
                    console.log(question_title);
                    break;
                case 'field':
                    question_title = $(this).val();
                    que_key = $(this).attr('data-question_key');
                    edit_question(question_title, que_key);
                    //console.log(que_key);
                    break;
                case 'area':
                    question_title = $(this).val();
                    que_key = $(this).attr('data-question_key');
                    edit_question(question_title, que_key);
                    //console.log(que_key);
                    break;
                case 'number':
                    question_title = $(this).val();
                    que_key = $(this).attr('data-question_key');
                    edit_question(question_title, que_key);
                    break;
                case 'calender':
                    question_title = $(this).val();
                    que_key = $(this).attr('data-question_key');
                    edit_question(question_title, que_key);
                    break;
            }
        });

        /*Text area input change*/
        $(document).on("input", "textarea", function () {
            question_title = $(this).val();
            que_key = $(this).attr('data-question_key');
            edit_question(question_title, que_key);
            //const input_name = $(this).attr('name');
            //console.log(input_name);
            //console.log($(this).val());
        });
    });

    function add_input_field() {
        check_form_size();
        question_key = 'key'
        form_body = form_body + input_field_component(form_size);
        form_body_ul.html(form_body);
        question_key = form_id + form_size + question_key;
        let question = new Question(form_id, question_key, "Field", input_field_component(form_size), 0);
        questionsList.push(question);
        //console.log(questionsList);
    }

    function add_input_area() {
        check_form_size();
        question_key = 'key'
        form_body = form_body + input_area_component(form_size);
        form_body_ul.html(form_body);
        question_key = form_id + form_size + question_key;
        let question = new Question(form_id, question_key, "Area", input_area_component(form_size), 1);
        questionsList.push(question);
    }

    function add_input_number() {
        check_form_size();
        question_key = 'key'
        form_body = form_body + input_number_component(form_size);
        form_body_ul.html(form_body);
        question_key = form_id + form_size + question_key;
        let question = new Question(form_id, question_key, "Number", input_number_component(form_size), 2);
        questionsList.push(question);
    }

    function add_calender_field() {
        check_form_size();
        question_key = 'key'
        form_body = form_body + input_calender_component(form_size);
        form_body_ul.html(form_body);
        question_key = form_id + form_size + question_key;
        let question = new Question(form_id, question_key, "Calender", input_calender_component(form_size), 3);
        questionsList.push(question);
        //console.log(questionsList);
    }

    function clear_form() {
        form_body = "";
        form_body_ul.html("");
        questionsList = [];
        if_empty_body();
    }

    function delete_question() {
        if_empty_body();
    }

    function check_form_size() {
        if (form_size == 0) {
            form_body = "";
            form_size++;
        } else {
            form_body = form_body_ul.html();
            form_size++;
            console.log(form_size);
        }
    }

    function if_empty_body() {
        form_body = form_body_ul.html();
        if (form_body.trim() === "") {
            form_body_ul.html(empty_body_component());
            reset_values();
        }
    }

    function reset_values() {
        form_size = 0;
        question_key = 'key'
        questionsList = [];
        input_field_num = 0;
        input_area_num = 0;
        input_number_num = 0;
        input_calender_num = 0;
    }

    function edit_question(question_title, que_key) {
        question_key = form_id + form_size + question_title;
        tag_question_key_in_model.html(question_key);
        const question = questionsList[que_key - 1];
        question['title'] = question_title;
        question['questions_key'] = question_key;
        questionsList[que_key - 1] = question;
        console.log(questionsList)
        //console.log(question['title'] = question_title);
    }

    function save_edit_question() {

    }

    function delete_project(id) {
        $.ajax({
            type: "DELETE",
            url: "/projects/delete/" + id,
            data: {
                _token: $("input[name=_token]").val()
            },
            success: function (response) {

            }
        });
    }

    /*Default component questions (Model)*/
    function input_field_component(form_size) {
        return "<li>" +
            "                                <div class=\"questions-title input-group input-group-sm mb-1   \">" +
            "                                       <span class=\"input-group-text\" id=\"inputGroup-sizing-sm\">Title</span>" +
            "                                       <input data-question_key='" + form_size + "' name='field' value='Text Field' type=\"text\" class=\"form-control\" aria-label=\"Sizing example input\" aria-describedby=\"inputGroup-sizing-sm\">" +
            "                                </div> <div class=\" float-right alert alert-secondary\">" +
            "                                    <button id=\"delete\" class=\"selector rounded-md btn-outline-primary\" title=\"delete\"><i" +
            "                                            class=\"bx bx-trash\"></i></button>" +
            "                                </div>" +
            "                                <input id='input_number_count' type='hidden' name='input_number_count' value='" + form_size + "'> " +
            "                                <input class=\"rounded-md col-md-11 alert alert-secondary\" type=\"text\"" +
            "                                       placeholder=\"Text Field\">" +
            "                            </li>";
    }

    function input_area_component(form_size) {
        return " <li>" +
            "                                <div class=\"questions-title input-group input-group-sm mb-1   \">" +
            "                                       <span class=\"input-group-text\" id=\"inputGroup-sizing-sm\">Title</span>" +
            "                                       <input data-question_key='" + form_size + "' name='area' value='Text Area' type=\"text\" class=\"form-control\" aria-label=\"Sizing example input\" aria-describedby=\"inputGroup-sizing-sm\">" +
            "                                </div> <div class=\" float-right alert alert-secondary\">" +
            "                                    <button id=\"delete\" class=\"selector rounded-md btn-outline-primary\" title=\"delete\"><i" +
            "                                            class=\"bx bx-trash\"></i></button>" +
            "                                </div>" +
            "                                <input id='input_number_count' type='hidden' name='input_number_count' value='" + form_size + "'> " +
            "                                <textarea class=\"rounded-md col-md-11 alert alert-secondary\"" +
            "                                          placeholder=\"Text Area\"></textarea>" +
            "                            </li>";
    }

    function input_number_component(form_size) {
        return "<li>" +
            "                                <div class=\"questions-title input-group input-group-sm mb-1   \">" +
            "                                       <span class=\"input-group-text\" id=\"inputGroup-sizing-sm\">Title</span>" +
            "                                       <input data-question_key='" + form_size + "' name='number'  value='Number' type=\"text\" class=\"form-control\" aria-label=\"Sizing example input\" aria-describedby=\"inputGroup-sizing-sm\">" +
            "                                </div> <div class=\" float-right alert alert-secondary\">" +
            "                                    <button id=\"delete\" class=\"selector rounded-md btn-outline-primary\" title=\"delete\"><i" +
            "                                            class=\"bx bx-trash\"></i></button>" +
            "                                </div> " +
            "                                <input id='input_number_count' type='hidden' name='input_number_count' value='" + form_size + "'> " +
            "                                <input class=\"rounded-md col-md-11 alert alert-secondary\" type=\"number\"" +
            "                                       placeholder=\"Number\">" +
            "                            </li>";
    }

    function input_calender_component(form_size) {
        return "<li>" +
            "                                <div class=\"questions-title input-group input-group-sm mb-1   \">" +
            "                                       <span class=\"input-group-text\" id=\"inputGroup-sizing-sm\">Title</span>" +
            "                                       <input data-question_key='" + form_size + "' name='calender' value='Calender' type=\"text\" class=\"form-control\" aria-label=\"Sizing example input\" aria-describedby=\"inputGroup-sizing-sm\">" +
            "                                </div><div class=\" float-right alert alert-secondary\">" +
            "                                    <button id=\"delete\" class=\"selector rounded-md btn-outline-primary\" title=\"delete\"><i" +
            "                                            class=\"bx bx-trash\"></i></button>" +
            "                                </div>" +
            "                                <input id='input_number_count' type='hidden' name='input_number_count' value='" + form_size + "'> " +
            "                                <input class=\"rounded-md col-md-11 alert alert-secondary\" type=\"date\"" +
            "                                       placeholder=\"Calender\">" +
            "                            </li>";
    }

    function empty_body_component() {
        return "<li class=\"btn btn-light text-center\">" +
            "                                <br>" +
            "                                <br>" +
            "                                <div>" +
            "                                    <i class=\"las la-boxes\" style=\"font-size: 50px\"></i>" +
            "                                    <p>Drag Components here!</p>" +
            "                                </div>" +
            "                                <br>" +
            "                                <br>" +
            "                            </li>";
    }
});


//TODO: question type: 0:text field, 1:text area, 2: number, 3:calender
