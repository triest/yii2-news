let dataTable;
let myData;
$(document).ready(function () {
    dataTable = $("#example");
    getData();
});

function getData() {
    $.ajax({
        type: "GET",
        url: '/news/rubrics/'+1,
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
                    "sLengthMenu": "Показывать _MENU_ пользователей на странице",
                    "sZeroRecords": "Нет данных",
                    "sEmptyTable": "Нет данных",
                    "sInfo": "Пользователи с  _START_ по _END_, всего _TOTAL_ ",
                    "sInfoEmpty": "Страница 1 из 1, всего _TOTAL_ записей",
                    "sInfoFiltered": "(отфильтровано из _MAX_ пользователей)",
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
                    {"data": "user.name"},
                    {"data": "city.name"},
                    {
                        "mData": null,
                        "bSortable": true,
                        "mRender": function (data, type, full) {
                            let string = "";
                            let arraySkills = data.skills;
                            let count = 0;
                            arraySkills.forEach(function (item) {
                                count++;
                                if (item.name != "undefined") {
                                    string += item.name;
                                    if (count < arraySkills.length) {
                                        string += ", ";
                                    }
                                }
                            });
                            return string;
                        }
                    },
                    {
                        "mData": null,
                        "bSortable": false,
                        "mRender": function (data, type, full) {
                            return '<a class="btn btn-danger" href=#/' + data.user.id + ' onclick=deleteUser(' + data.user.id + ')>' + 'Удалить' + '</a>';
                        }
                    }
                ]
            });

        }
    });
}