define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'advert/index' + location.search,
                    add_url: 'advert/add',
                    edit_url: 'advert/edit',
                    del_url: 'advert/del',
                    multi_url: 'advert/multi',
                    import_url: 'advert/import',
                    table: 'booth_advert',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'weigh',
                fixedColumns: true,
                fixedRightNumber: 1,
                columns: [
                    [
                        {checkbox: true},
                        {field: 'id', title: __('Id')},
                        {field: 'admin_id', title: __('Admin_id')},
                        {field: 'module', title: __('Module'), searchList: {"open":__('Module open'),"page":__('Module page'),"category":__('Module category'),"first":__('Module first'),"other":__('Module other')}, formatter: Table.api.formatter.normal},
                        {field: 'category_id', title: __('Category_id')},
                        {field: 'type', title: __('Type'), searchList: {"banner":__('Type banner'),"image":__('Type image'),"video":__('Type video')}, formatter: Table.api.formatter.normal},
                        {field: 'media', title: __('Media'), operate: 'LIKE'},
                        {field: 'url', title: __('Url'), operate: 'LIKE', formatter: Table.api.formatter.url},
                        {field: 'title', title: __('Title'), operate: 'LIKE'},
                        {field: 'city', title: __('City'), operate: 'LIKE'},
                        {field: 'startdate', title: __('Startdate'), operate:'RANGE', addclass:'datetimerange', autocomplete:false},
                        {field: 'enddate', title: __('Enddate'), operate:'RANGE', addclass:'datetimerange', autocomplete:false},
                        {field: 'views', title: __('Views')},
                        {field: 'show', title: __('Show')},
                        {field: 'created', title: __('Created')},
                        {field: 'modified', title: __('Modified')},
                        {field: 'weigh', title: __('Weigh'), operate: false},
                        {field: 'status', title: __('Status'), searchList: {"normal":__('Normal'),"hidden":__('Hidden')}, formatter: Table.api.formatter.status},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
        },
        recyclebin: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    'dragsort_url': ''
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: 'advert/recyclebin' + location.search,
                pk: 'id',
                sortName: 'id',
                columns: [
                    [
                        {checkbox: true},
                        {field: 'id', title: __('Id')},
                        {field: 'title', title: __('Title'), align: 'left'},
                        {
                            field: 'deleted',
                            title: __('deleted'),
                            operate: 'RANGE',
                            addclass: 'datetimerange',
                            formatter: Table.api.formatter.datetime
                        },
                        {
                            field: 'operate',
                            width: '130px',
                            title: __('Operate'),
                            table: table,
                            events: Table.api.events.operate,
                            buttons: [
                                {
                                    name: 'Restore',
                                    text: __('Restore'),
                                    classname: 'btn btn-xs btn-info btn-ajax btn-restoreit',
                                    icon: 'fa fa-rotate-left',
                                    url: 'advert/restore',
                                    refresh: true
                                },
                                {
                                    name: 'Destroy',
                                    text: __('Destroy'),
                                    classname: 'btn btn-xs btn-danger btn-ajax btn-destroyit',
                                    icon: 'fa fa-times',
                                    url: 'advert/destroy',
                                    refresh: true
                                }
                            ],
                            formatter: Table.api.formatter.operate
                        }
                    ]
                ]
            });

            // 为表格绑定事件
            Table.api.bindevent(table);
        },

        add: function () {
            Controller.api.bindevent();
        },
        edit: function () {
            Controller.api.bindevent();
        },
        api: {
            bindevent: function () {
                Form.api.bindevent($("form[role=form]"));
            }
        }
    };
    return Controller;
});
