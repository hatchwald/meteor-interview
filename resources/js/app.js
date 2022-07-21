import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

$(function () {
    const datatable_data = $("#product_table").DataTable({
        ajax: '/all-products',
        columns: [
            { data: 'id' },
            { data: 'name' },
            { data: 'qty' },
            { data: 'price' },
            {
                data: '',
                render: function (data, type, row) {
                    return `<button class='btn btn-warning btn-update' data-ids='${row.id}'>Update</button> <button class='btn btn-danger btn-delete'>Delete</button>`
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
                $("#toast_success .toast-body").text(params.message)
                $("#toast_success").toast("show")
                datatable_data.ajax.reload()
            },
            fail: function (xhr, status, err) {
                const responsejson = xhr.responseJSON
                $("#toast_error .toast-body").text(responsejson.message)
                $("#toast_error").toast("show")
                setTimeout(() => {
                    $("#modalCreate").modal("show")
                }, 1000);
            }

        })
        console.log("submitted", all_data)
    })

    $("#product_table").click(".btn-update", function (e) {
        const data_ids = $(e.target).data("ids")
        $.ajax({
            url: `/products/${data_ids}`,

        }).done(function (data) {
            $("#product_id").val(data.id)
            $("#product_name_update").val(data.name)
            $("#product_qty_update").val(data.qty)
            $("#product_price_update").val(data.price)
            $("#modalUpdate").modal("show")
        }).fail(function (err) {
            console.log(err);
        })


    })

    $("#form_product_update").on("submit", function (e) {
        e.preventDefault()
        const all_data = $(this).serializeArray()
        $("#modalUpdate").modal("hide")
        // console.log(all_data);
        $.ajax({
            url: `/products/${all_data[2]['value']}`,
            data: all_data,
            type: "POST"
        }).done(function (data) {
            $("#form_product_update")[0].reset()
            $("#toast_success .toast-body").text(data.message)
            $("#toast_success").toast("show")
            datatable_data.ajax.reload()
            console.log(data);
        }).fail(function (xhr, status, err) {
            const responsejson = xhr.responseJSON
            $("#toast_error .toast-body").text(responsejson.message)
            $("#toast_error").toast("show")
            setTimeout(() => {
                $("#modalUpdate").modal("show")
            }, 1000);
        })
    })


})