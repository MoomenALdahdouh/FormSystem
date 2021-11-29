$(function () {
    let form_size = 0;
    let form_body_ul = $('#form-body');
    let form_body = form_body_ul.html();

    $(document).ready(function () {
        $(document).on('click', '#text-field-button', function () {
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
            $(this).closest('li').remove();
            if_empty_body();
        });
    })

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
            form_size = 0;
        }
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
        "                                    <button id=\"edit\" class=\"rounded-md btn-outline-danger\" title=\"edit\"><i" +
        "                                            class=\"las la-edit\"></i></button>" +
        "                                    <button id=\"delete\" class=\"rounded-md btn-outline-primary\" title=\"delete\"><i" +
        "                                            class=\"bx bx-trash\"></i></button>" +
        "                                </div>" +
        "                                <input class=\"rounded-md col-sm-11 alert alert-secondary\" type=\"text\" name=\"field\"" +
        "                                       placeholder=\"Text Field\">" +
        "                            </li>";
    let input_area = " <li>" +
        "                                <div class=\" float-right alert alert-dark\">" +
        "                                    <button id=\"edit\" class=\"rounded-md btn-outline-danger\" title=\"edit\"><i" +
        "                                            class=\"las la-edit\"></i></button>" +
        "                                    <button id=\"delete\" class=\"rounded-md btn-outline-primary\" title=\"delete\"><i" +
        "                                            class=\"bx bx-trash\"></i></button>" +
        "                                </div>" +
        "                                <textarea class=\"rounded-md col-sm-11 alert alert-secondary\" name=\"area\"" +
        "                                          placeholder=\"Text Area\"></textarea>" +
        "                            </li>";
    let input_number = "<li>" +
        "                                <div class=\" float-right alert alert-dark\">" +
        "                                    <button id=\"edit\" class=\"rounded-md btn-outline-danger\" title=\"edit\"><i" +
        "                                            class=\"las la-edit\"></i></button>" +
        "                                    <button id=\"delete\" class=\"rounded-md btn-outline-primary\" title=\"delete\"><i" +
        "                                            class=\"bx bx-trash\"></i></button>" +
        "                                </div>" +
        "                                <input class=\"rounded-md col-sm-11 alert alert-secondary\" type=\"number\" name=\"number\"" +
        "                                       placeholder=\"Number\">" +
        "                            </li>";
    let input_calender = "<li>" +
        "                                <div class=\" float-right alert alert-dark\">" +
        "                                    <button id=\"edit\" class=\"rounded-md btn-outline-danger\" title=\"edit\"><i" +
        "                                            class=\"las la-edit\"></i></button>" +
        "                                    <button id=\"delete\" class=\"rounded-md btn-outline-primary\" title=\"delete\"><i" +
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

