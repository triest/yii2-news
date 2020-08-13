var rubrick_id;
$(document).ready(function () {
    dataTable = $("#example");
    rubrick_id = $('#rubric_id').val();
    getData();
});

function getData() {

    $.ajax({
        type: "GET",
        url: '/news/rubrics/' + rubrick_id,
        dataType: "json",
        contentType: "application/json; charset=utf-8",
        success: function (data) {
            myData = data;
            dataTable.DataTable({
                "data": myData,
                "bProcessing": true,
                "destroy": true,
                "language": {
                    "sProcessing": "Загрузка...",
                    "sLengthMenu": "Показывать _MENU_ новостей на странице",
                    "sZeroRecords": "Нет данных",
                    "sEmptyTable": "Нет данных",
                    "sInfo": "новости с  _START_ по _END_, всего _TOTAL_ ",
                    "sInfoEmpty": "Страница 1 из 1, всего _TOTAL_ записей",
                    "sInfoFiltered": "(отфильтровано из _MAX_ новостей)",
                    "sInfoPostFix": "",
                    "sSearch": "Поиск:",
                    "sUrl": "",
                    "sInfoThousands": ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst": "Первая страница",
                        "sLast": "Последняя страница",
                        "sNext": "Следующая страница",
                        "sPrevious": "Предыдущая страница"
                    },
                    "oAria": {
                        "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    }
                },
                "columns": [
                    {"data": "title"},
                    {"data": "description"},
                ]
            });

        }
    });
}
