import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

$(function () {
    $("#product_table").DataTable({
        ajax: '/all-products',
        columns: [
            { data: 'id' },
            { data: 'name' },
            { data: 'qty' },
            { data: 'price' },
            {
                data: '',
                render: function (data, type, row) {
                    return `<button class='btn btn-warning btn-update'>Update</button> <button class='btn btn-danger btn-delete'>Delete</button>`
                }
            }
        ]
    })
    $("#create_product").on("click", function () {
        $("#modalCreate").modal("show")
    })

    $("#form_product").on("submit", function (e) {
        e.preventDefault()
        const all_data = $(this).serializeArray()
        $("#modalCreate").modal("hide")
        $.ajax({
            type: "POST",
            data: all_data,
            url: "/products",
            success: function (params) {
                console.log(params)
                $("#form_product")[0].reset()
            },
            fail: function (err) {
                console.log(err);
                $("#modalCreate").modal("hide")
            }

        })
        console.log("submitted", all_data)
    })
})