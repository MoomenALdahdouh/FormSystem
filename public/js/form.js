$(function () {
    let form_size = $('#form_size').val();
    let form_input_id = $('#form_id');
    let form_id = form_input_id.val();
    let form_body_ul = $('#form-body');
    let form_body = form_body_ul.html();
    let input_field_num = 0;
    let input_area_num = 0;
    let input_number_num = 0;
    let input_calender_num = 0;
    let question_title = '';
    let tag_question_key_in_model = $('#question_key');
    let question_key = 'key';
    let questions_static_key = 'key';
    let que_key;
    let question_li_position;
    //let tag_question_key = $('#input_question_key');

    /*Questions Model array list*/
    let old_questions_list = [];
    get_old_questions(form_id);
    let questionsList = [];

    /*Create Question model*/
    function Question(form_fk_id, questions_static_key, questions_key, data_question_key, title, body, type) {
        this.form_fk_id = form_fk_id;
        this.questions_static_key = questions_static_key;
        this.questions_key = questions_key;
        this.data_question_key = data_question_key;
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
                case 'form-button':
                    add_image_field();
                    break;
                case 'delete':
                    const question_key = $(this).attr('data-key-question');
                    $(this).closest('li').remove();
                    delete_question(question_key);
                    break;
                case 'clean_form':
                    $('#ask-remove').modal('show');
                    break;
                case 'confirm-remove':
                    clear_form();
                    break;
                case 'save_form':
                    save_form_in_db(questionsList);
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
                    break;
                case 'field':
                    question_title = $(this).val();
                    que_key = $(this).attr('data-question_key');
                    $(this).attr('value', question_title);
                    question_li_position = $(this).closest('li').index();
                    console.log(question_li_position);
                    edit_question(question_title, question_li_position);
                    break;
                case 'area':
                    question_title = $(this).val();
                    que_key = $(this).attr('data-question_key');
                    $(this).attr('value', question_title);
                    question_li_position = $(this).closest('li').index();
                    edit_question(question_title, question_li_position);
                    break;
                case 'number':
                    question_title = $(this).val();
                    que_key = $(this).attr('data-question_key');
                    $(this).attr('value', question_title);
                    question_li_position = $(this).closest('li').index();
                    edit_question(question_title, question_li_position);
                    break;
                case 'calender':
                    question_title = $(this).val();
                    que_key = $(this).attr('data-question_key');
                    $(this).attr('value', question_title);
                    question_li_position = $(this).closest('li').index();
                    edit_question(question_title, question_li_position);
                    break;
                case 'image':
                    question_title = $(this).val();
                    que_key = $(this).attr('data-question_key');
                    $(this).attr('value', question_title);
                    question_li_position = $(this).closest('li').index();
                    edit_question(question_title, question_li_position);
                    break;
            }
        });

        /*Text area input change*/
        $(document).on("input", "textarea", function () {
            question_title = $(this).val();
            que_key = $(this).attr('data-question_key');
            question_li_position = $(this).closest('li').index();
            edit_question(question_title, question_li_position);
        });

        delete_worker();
        add_workers();
    });


    function delete_worker() {
        $('#worker_section #remove_worker').on('click', function () {
            console.log("assas");
            var id = $(this).data('id');
            $.ajax({
                method: "POST",
                url: "/form/worker/remove/" + id,
                data: {
                    _token: $("input[name=_token]").val(),
                },
                success: function (response) {
                    if (response['success']) {
                        let item_list = $('#' + id);
                        item_list.remove();
                    }
                }
            });
        });
    }

    function add_workers() {
        $('#worker').on('change', function () {
            var worker_id = $('#worker').val();
            //add on database
            $.ajax({
                method: "POST",
                url: "/form/worker/add",
                dataType: "json",
                data: {
                    _token: $("input[name=_token]").val(),
                    worker_id: worker_id,
                    form_id: form_id,
                },
                success: function (response) {
                    if (response['success']) {
                        location.reload();
                    }
                }
            });

        });
    }

    function add_input_field() {
        check_form_size();
        question_key = 'key'
        const field_title = "Text Field";
        question_key = form_id + form_size + question_key;
        questions_static_key = form_id + form_size;
        form_body = form_body + input_field_component(form_size, field_title, question_key);
        form_body_ul.html(form_body);
        console.log(form_size);
        let question = new Question(form_id, questions_static_key, question_key, form_size, field_title, input_field_component(form_size, field_title, question_key), 0);
        questionsList.push(question);
        console.log(questionsList);
    }

    function add_input_area() {
        check_form_size();
        question_key = 'key'
        const area_title = "Text Area";
        question_key = form_id + form_size + question_key;
        questions_static_key = form_id + form_size;
        form_body = form_body + input_area_component(form_size, area_title, question_key);
        form_body_ul.html(form_body);
        let question = new Question(form_id, questions_static_key, question_key, form_size, area_title, input_area_component(form_size, area_title, question_key), 1);
        questionsList.push(question);
    }

    function add_input_number() {
        check_form_size();
        question_key = 'key'
        const number_title = "Number";
        question_key = form_id + form_size + question_key;
        questions_static_key = form_id + form_size;
        form_body = form_body + input_number_component(form_size, number_title, question_key);
        form_body_ul.html(form_body);
        let question = new Question(form_id, questions_static_key, question_key, form_size, number_title, input_number_component(form_size, number_title, question_key), 2);
        questionsList.push(question);
    }

    function add_calender_field() {
        check_form_size();
        question_key = 'key'
        const calender_title = "Calender";
        question_key = form_id + form_size + question_key;
        questions_static_key = form_id + form_size;
        form_body = form_body + input_calender_component(form_size, calender_title, question_key);
        form_body_ul.html(form_body);
        let question = new Question(form_id, questions_static_key, question_key, form_size, calender_title, input_calender_component(form_size, calender_title, question_key), 3);
        questionsList.push(question);
        //console.log(questionsList);
    }

    function add_image_field() {
        check_form_size();
        question_key = 'key'
        const image_title = "Image";
        question_key = form_id + form_size + question_key;
        questions_static_key = form_id + form_size;
        form_body = form_body + input_image_component(form_size, image_title, question_key);
        form_body_ul.html(form_body);
        let question = new Question(form_id, questions_static_key, question_key, form_size, image_title, input_image_component(form_size, image_title, question_key), 4);
        questionsList.push(question);
        //console.log(questionsList);
    }

    function clear_form() {
        form_body = "";
        form_body_ul.html("");
        questionsList = [];
        if_empty_body();
    }

    function delete_question(question_key) {
        console.log(questionsList);
        $.each(questionsList, function (i) {
            var question = questionsList[i];
            if (question.questions_key.toString() === question_key.toString()) {
                console.log(questionsList);
                questionsList.splice(i, 1);
                if_empty_body();
                console.log(questionsList);
                return false;
            }
        });
    }

    function check_form_size() {
        if (form_size == 0) {
            form_body = "";
            form_size++;
        } else {
            form_body = form_body_ul.html();
            form_size++;
            //console.log(form_size);
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
        console.log(que_key);
        const dt = new Date();
        //dt.toLocaleDateString() +""+
        const time = (dt.getMonth() + 1) + "" + dt.getDay() + "" + dt.getHours() + "" + dt.getMinutes() + "" + dt.getSeconds();
        const question = questionsList[que_key];
        const data_question_key = question.data_question_key;
        question_key = question.questions_static_key + question_title;
        const question_key_splice = question_key.replace(" ", '');
        question['title'] = question_title;
        question.questions_key = question_key_splice;
        switch (question['type']) {
            case 0:
                question['body'] = input_field_edit_component(data_question_key, question_title, question_key_splice);
                break;
            case 1:
                question['body'] = input_area_edit_component(data_question_key, question_title, question_key_splice);
                break;
            case 2:
                question['body'] = input_number_edit_component(data_question_key, question_title, question_key_splice);
                break;
            case 3:
                question['body'] = input_calender_edit_component(data_question_key, question_title, question_key_splice);
                break;
            case 4:
                question['body'] = input_image_edit_component(data_question_key, question_title, question_key_splice);
                break;
        }
        questionsList[que_key] = question;
        tag_question_key_in_model.html(question_key_splice);
    }

    function save_form_in_db(questionsList) {
        $.ajax({
            method: "POST",
            url: "/questions/store",
            dataType: "json",
            data: {
                _token: $("input[name=_token]").val(),
                questionsList: questionsList,
                form_fk_id: form_id,
            },
            success: function (response) {
                $('#successfully-save').modal('show');
            },
            error: function (response) {
                $('#something-wrong').modal('show');
            }
        });
    }

    function get_old_questions(form_id) {
        $.ajax({
            method: "get",
            url: "/questions",
            dataType: "json",
            data: {
                _token: $("input[name=_token]").val(),
                form_fk_id: form_id,
            },
            success: function (response) {
                old_questions_list = response['success'];
                $.each(old_questions_list, function (i) {
                    let question = new Question(old_questions_list[i].form_fk_id, form_id + "" + (i + 1), old_questions_list[i].questions_key, old_questions_list[i].data_question_key, old_questions_list[i].title, old_questions_list[i].body, old_questions_list[i].type);
                    questionsList.push(question);
                    form_size = questionsList.length;
                });
                console.log(questionsList)
            },
        });
    }

    /*Default component questions (Model)*/
    function input_field_component(form_size, question_title, question_key) {
        //console.log(question_key)
        return "<li>" +
            "                                <div class=\"questions-title input-group input-group-sm mb-1   \">" +
            "                                       <span class=\"input-group-text\" id=\"inputGroup-sizing-sm\">Title</span>" +
            "                                       <input data-question_key='" + form_size + "' name='field' value='" + question_title + "' type=\"text\" class=\"form-control\" aria-label=\"Sizing example input\" aria-describedby=\"inputGroup-sizing-sm\">" +
            "                                </div> <div class=\" float-right alert alert-secondary\">" +
            "                                    <button data-key-question='" + question_key + "' id=\"delete\" class=\"selector rounded-md btn-outline-primary\" title=\"delete\"><i" +
            "                                            class=\"bx bx-trash\"></i></button>" +
            "                                </div>" +
            "                                <input id='input_number_count' type='hidden' name='input_number_count' value='" + form_size + "'> " +
            "                                <input class=\"rounded-md col-md-11 alert alert-secondary\" type=\"text\"" +
            "                                       placeholder=\"Text Field\">" +
            "                            </li>";
    }

    function input_area_component(form_size, question_title, question_key) {
        return " <li>" +
            "                                <div class=\"questions-title input-group input-group-sm mb-1   \">" +
            "                                       <span class=\"input-group-text\" id=\"inputGroup-sizing-sm\">Title</span>" +
            "                                       <input data-question_key='" + form_size + "' name='area' value='" + question_title + "' type=\"text\" class=\"form-control\" aria-label=\"Sizing example input\" aria-describedby=\"inputGroup-sizing-sm\">" +
            "                                </div> <div class=\" float-right alert alert-secondary\">" +
            "                                    <button data-key-question='" + question_key + "' id=\"delete\" class=\"selector rounded-md btn-outline-primary\" title=\"delete\"><i" +
            "                                            class=\"bx bx-trash\"></i></button>" +
            "                                </div>" +
            "                                <input id='input_number_count' type='hidden' name='input_number_count' value='" + form_size + "'> " +
            "                                <textarea rows=\"4\" class=\"rounded-md col-md-11 alert alert-secondary\"" +
            "                                          placeholder=\"Text Area\"></textarea>" +
            "                            </li>";
    }

    function input_number_component(form_size, question_title, question_key) {
        return "<li>" +
            "                                <div class=\"questions-title input-group input-group-sm mb-1   \">" +
            "                                       <span class=\"input-group-text\" id=\"inputGroup-sizing-sm\">Title</span>" +
            "                                       <input data-question_key='" + form_size + "' name='number'  value='" + question_title + "' type=\"text\" class=\"form-control\" aria-label=\"Sizing example input\" aria-describedby=\"inputGroup-sizing-sm\">" +
            "                                </div> <div class=\" float-right alert alert-secondary\">" +
            "                                    <button data-key-question='" + question_key + "' id=\"delete\" class=\"selector rounded-md btn-outline-primary\" title=\"delete\"><i" +
            "                                            class=\"bx bx-trash\"></i></button>" +
            "                                </div> " +
            "                                <input id='input_number_count' type='hidden' name='input_number_count' value='" + form_size + "'> " +
            "                                <input class=\"rounded-md col-md-11 alert alert-secondary\" type=\"number\"" +
            "                                       placeholder=\"Number\">" +
            "                            </li>";
    }

    function input_calender_component(form_size, question_title, question_key) {
        return "<li>" +
            "                                <div class=\"questions-title input-group input-group-sm mb-1   \">" +
            "                                       <span class=\"input-group-text\" id=\"inputGroup-sizing-sm\">Title</span>" +
            "                                       <input data-question_key='" + form_size + "' name='calender' value='" + question_title + "' type=\"text\" class=\"form-control\" aria-label=\"Sizing example input\" aria-describedby=\"inputGroup-sizing-sm\">" +
            "                                </div><div class=\" float-right alert alert-secondary\">" +
            "                                    <button data-key-question='" + question_key + "' id=\"delete\" class=\"selector rounded-md btn-outline-primary\" title=\"delete\"><i" +
            "                                            class=\"bx bx-trash\"></i></button>" +
            "                                </div>" +
            "                                <input id='input_number_count' type='hidden' name='input_number_count' value='" + form_size + "'> " +
            "                                <input class=\"rounded-md col-md-11 alert alert-secondary\" type=\"date\"" +
            "                                       placeholder=\"Calender\">" +
            "                            </li>";
    }

    function input_image_component(form_size, question_title, question_key) {
        return "<li>" +
            "                                <div class=\"questions-title input-group input-group-sm mb-1   \">" +
            "                                       <span class=\"input-group-text\" id=\"inputGroup-sizing-sm\">Title</span>" +
            "                                       <input data-question_key='" + form_size + "' name='image' value='" + question_title + "' type=\"text\" class=\"form-control\" aria-label=\"Sizing example input\" aria-describedby=\"inputGroup-sizing-sm\">" +
            "                                </div><div class=\" float-right alert alert-secondary\">" +
            "                                    <button data-key-question='" + question_key + "' id=\"delete\" class=\"selector rounded-md btn-outline-primary\" title=\"delete\"><i" +
            "                                            class=\"bx bx-trash\"></i></button>" +
            "                                </div>" +
            "                                <input id='input_number_count' type='hidden' name='input_number_count' value='" + form_size + "'> " +
            "                                <button class=\"rounded-md col-md-11 alert alert-secondary text-left\"" +
            "                                       ><i class=\"button_icon las la-cloud-upload-alt\"></i>&nbsp; Upload Image</button>" +
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

    /*Edit question component*/
    function input_field_edit_component(data_question_key, question_title, question_key) {
        //console.log(question_key)
        return "<li>" +
            "                                <div class=\"questions-title input-group input-group-sm mb-1   \">" +
            "                                       <span class=\"input-group-text\" id=\"inputGroup-sizing-sm\">Title</span>" +
            "                                       <input data-question_key='" + data_question_key + "' name='field' value='" + question_title + "' type=\"text\" class=\"form-control\" aria-label=\"Sizing example input\" aria-describedby=\"inputGroup-sizing-sm\">" +
            "                                </div> <div class=\" float-right alert alert-secondary\">" +
            "                                    <button data-key-question='" + question_key + "' id=\"delete\" class=\"selector rounded-md btn-outline-primary\" title=\"delete\"><i" +
            "                                            class=\"bx bx-trash\"></i></button>" +
            "                                </div>" +
            "                                <input id='input_number_count' type='hidden' name='input_number_count' value='" + data_question_key + "'> " +
            "                                <input class=\"rounded-md col-md-11 alert alert-secondary\" type=\"text\"" +
            "                                       placeholder=\"Text Field\">" +
            "                            </li>";
    }

    function input_area_edit_component(data_question_key, question_title, question_key) {
        return " <li>" +
            "                                <div class=\"questions-title input-group input-group-sm mb-1   \">" +
            "                                       <span class=\"input-group-text\" id=\"inputGroup-sizing-sm\">Title</span>" +
            "                                       <input data-question_key='" + data_question_key + "' name='area' value='" + question_title + "' type=\"text\" class=\"form-control\" aria-label=\"Sizing example input\" aria-describedby=\"inputGroup-sizing-sm\">" +
            "                                </div> <div class=\" float-right alert alert-secondary\">" +
            "                                    <button data-key-question='" + question_key + "' id=\"delete\" class=\"selector rounded-md btn-outline-primary\" title=\"delete\"><i" +
            "                                            class=\"bx bx-trash\"></i></button>" +
            "                                </div>" +
            "                                <input id='input_number_count' type='hidden' name='input_number_count' value='" + data_question_key + "'> " +
            "                                <textarea rows=\"4\" class=\"rounded-md col-md-11 alert alert-secondary\"" +
            "                                          placeholder=\"Text Area\"></textarea>" +
            "                            </li>";
    }

    function input_number_edit_component(data_question_key, question_title, question_key) {
        return "<li>" +
            "                                <div class=\"questions-title input-group input-group-sm mb-1   \">" +
            "                                       <span class=\"input-group-text\" id=\"inputGroup-sizing-sm\">Title</span>" +
            "                                       <input data-question_key='" + data_question_key + "' name='number'  value='" + question_title + "' type=\"text\" class=\"form-control\" aria-label=\"Sizing example input\" aria-describedby=\"inputGroup-sizing-sm\">" +
            "                                </div> <div class=\" float-right alert alert-secondary\">" +
            "                                    <button data-key-question='" + question_key + "' id=\"delete\" class=\"selector rounded-md btn-outline-primary\" title=\"delete\"><i" +
            "                                            class=\"bx bx-trash\"></i></button>" +
            "                                </div> " +
            "                                <input id='input_number_count' type='hidden' name='input_number_count' value='" + data_question_key + "'> " +
            "                                <input class=\"rounded-md col-md-11 alert alert-secondary\" type=\"number\"" +
            "                                       placeholder=\"Number\">" +
            "                            </li>";
    }

    function input_calender_edit_component(data_question_key, question_title, question_key) {
        return "<li>" +
            "                                <div class=\"questions-title input-group input-group-sm mb-1   \">" +
            "                                       <span class=\"input-group-text\" id=\"inputGroup-sizing-sm\">Title</span>" +
            "                                       <input data-question_key='" + data_question_key + "' name='calender' value='" + question_title + "' type=\"text\" class=\"form-control\" aria-label=\"Sizing example input\" aria-describedby=\"inputGroup-sizing-sm\">" +
            "                                </div><div class=\" float-right alert alert-secondary\">" +
            "                                    <button data-key-question='" + question_key + "' id=\"delete\" class=\"selector rounded-md btn-outline-primary\" title=\"delete\"><i" +
            "                                            class=\"bx bx-trash\"></i></button>" +
            "                                </div>" +
            "                                <input id='input_number_count' type='hidden' name='input_number_count' value='" + data_question_key + "'> " +
            "                                <input class=\"rounded-md col-md-11 alert alert-secondary\" type=\"date\"" +
            "                                       placeholder=\"Calender\">" +
            "                            </li>";
    }

    function input_image_edit_component(data_question_key, question_title, question_key) {
        return "<li>" +
            "                                <div class=\"questions-title input-group input-group-sm mb-1   \">" +
            "                                       <span class=\"input-group-text\" id=\"inputGroup-sizing-sm\">Title</span>" +
            "                                       <input data-question_key='" + data_question_key + "' name='image' value='" + question_title + "' type=\"text\" class=\"form-control\" aria-label=\"Sizing example input\" aria-describedby=\"inputGroup-sizing-sm\">" +
            "                                </div><div class=\" float-right alert alert-secondary\">" +
            "                                    <button data-key-question='" + question_key + "' id=\"delete\" class=\"selector rounded-md btn-outline-primary\" title=\"delete\"><i" +
            "                                            class=\"bx bx-trash\"></i></button>" +
            "                                </div>" +
            "                                <input id='input_number_count' type='hidden' name='input_number_count' value='" + data_question_key + "'> " +
            "                                <button class=\"rounded-md col-md-11 alert alert-secondary text-left\"" +
            "                                       ><i class=\"button_icon las la-cloud-upload-alt\"></i>&nbsp; Upload Image</button>" +
            "                            </li>";
    }
});


//TODO: question type: 0:text field, 1:text area, 2: number, 3:calender
