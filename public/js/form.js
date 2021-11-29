$(function () {
    let form_size = 0;
    let form_body_ul = $('#form-body');
    let form_body = form_body_ul.html();
    let form_input_id = $('#form_id');
    let form_id = form_input_id.value;
    let input_field_num = 0;
    let input_area_num = 0;
    let input_number_num = 0;
    let input_calender_num = 0;

    $(document).ready(function () {
        //TODO:: Add Selector in class each tag you need to click it
        $(document).on('click', '.selector', function () {
            var button_id = $(this).attr('id');
            console.log(button_id)
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

            }
        });

        /*$(document).on('click', '#text-field-button', function () {
            add_input_field();
        });

        $(document).on('click', '#text-area-button', function () {
            add_input_area();
        });

        $(document).on('click', '#number-button', function () {
            add_input_number();
        });

        $(document).on('click', '#calender-button', function () {
            add_calender_field();
        });

        $(document).on('click', '#delete', function () {
            delete_question();
        });

        $(document).on('click', '#clean_form', function () {
            $('#ask-remove').modal('show');
        });

        $(document).on('click', '#confirm-remove', function () {
            clear_form();
        });*/

        /*Array.from(document.querySelectorAll('#text-field-button')).forEach(bttn => {
            bttn.addEventListener('click', (e) => {
                e.preventDefault();
                let button_id = e.target.parentNode.querySelector('#text-field-button');

            });
        });*/

    });

    function add_input_field() {
        check_form_size();
        form_body = form_body + input_field;
        form_body_ul.html(form_body);
    }

    function add_input_area() {
        check_form_size();
        form_body = form_body + input_area;
        form_body_ul.html(form_body);
    }

    function add_input_number() {
        check_form_size();
        form_body = form_body + input_number;
        form_body_ul.html(form_body);
    }

    function add_calender_field() {
        check_form_size();
        form_body = form_body + input_calender;
        form_body_ul.html(form_body);
    }

    function clear_form() {
        form_body = "";
        form_body_ul.html("");
        if_empty_body();
    }

    function delete_question() {
        if_empty_body();
    }

    function check_form_size() {
        if (form_size == 0) {
            form_body = "";
            form_size = 1;
        } else {
            form_body = form_body_ul.html();
        }
    }

    function if_empty_body() {
        form_body = form_body_ul.html();
        if (form_body.trim() === "") {
            form_body_ul.html(empty_body);
            reset_values();
        }
    }

    function reset_values() {
        form_size = 0;
        input_field_num = 0;
        input_area_num = 0;
        input_number_num = 0;
        input_calender_num = 0;
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

    let input_field = "<li>" +
        "                                <div class=\" float-right alert alert-dark\">" +
        "                                    <button id=\"edit\" class=\"selector rounded-md btn-outline-danger\" title=\"edit\"><i" +
        "                                            class=\"las la-edit\"></i></button>" +
        "                                    <button id=\"delete\" class=\"selector rounded-md btn-outline-primary\" title=\"delete\"><i" +
        "                                            class=\"bx bx-trash\"></i></button>" +
        "                                </div>" +
        "                                <input class=\"rounded-md col-sm-11 alert alert-secondary\" type=\"text\" name=\"field\"" +
        "                                       placeholder=\"Text Field\">" +
        "                            </li>";
    let input_area = " <li>" +
        "                                <div class=\" float-right alert alert-dark\">" +
        "                                    <button id=\"edit\" class=\"selector rounded-md btn-outline-danger\" title=\"edit\"><i" +
        "                                            class=\"las la-edit\"></i></button>" +
        "                                    <button id=\"delete\" class=\"selector rounded-md btn-outline-primary\" title=\"delete\"><i" +
        "                                            class=\"bx bx-trash\"></i></button>" +
        "                                </div>" +
        "                                <textarea class=\"rounded-md col-sm-11 alert alert-secondary\" name=\"area\"" +
        "                                          placeholder=\"Text Area\"></textarea>" +
        "                            </li>";
    let input_number = "<li>" +
        "                                <div class=\" float-right alert alert-dark\">" +
        "                                    <button id=\"edit\" class=\"selector rounded-md btn-outline-danger\" title=\"edit\"><i" +
        "                                            class=\"las la-edit\"></i></button>" +
        "                                    <button id=\"delete\" class=\"selector rounded-md btn-outline-primary\" title=\"delete\"><i" +
        "                                            class=\"bx bx-trash\"></i></button>" +
        "                                </div>" +
        "                                <input class=\"rounded-md col-sm-11 alert alert-secondary\" type=\"number\" name=\"number\"" +
        "                                       placeholder=\"Number\">" +
        "                            </li>";
    let input_calender = "<li>" +
        "                                <div class=\" float-right alert alert-dark\">" +
        "                                    <button id=\"edit\" class=\"selector rounded-md btn-outline-danger\" title=\"edit\"><i" +
        "                                            class=\"las la-edit\"></i></button>" +
        "                                    <button id=\"delete\" class=\"selector rounded-md btn-outline-primary\" title=\"delete\"><i" +
        "                                            class=\"bx bx-trash\"></i></button>" +
        "                                </div>" +
        "                                <input class=\"rounded-md col-sm-11 alert alert-secondary\" type=\"date\" name=\"calender\"" +
        "                                       placeholder=\"calender\">" +
        "                            </li>";

    let empty_body = "<li class=\"btn btn-light text-center\">" +
        "                                <br>" +
        "                                <br>" +
        "                                <div>" +
        "                                    <i class=\"las la-boxes\" style=\"font-size: 50px\"></i>" +
        "                                    <p>Drag Components here!</p>" +
        "                                </div>" +
        "                                <br>" +
        "                                <br>" +
        "                            </li>";
});

