define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'exhibition/index' + location.search,
                    add_url: 'exhibition/add',
                    edit_url: 'exhibition/edit',
                    del_url: 'exhibition/del',
                    multi_url: 'exhibition/multi',
                    import_url: 'exhibition/import',
                    table: 'booth_exhibition',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'id',
                columns: [
                    [
                        {checkbox: true},
                        {field: 'id', title: __('Id')},
                        {field: 'exhibition_name', title: __('Exhibition_name'), operate: 'LIKE'},
                        {field: 'start_time', title: __('Start_time'), operate: 'LIKE'},
                        {field: 'end_time', title: __('End_time'), operate: 'LIKE'},
                        {field: 'status', title: __('Status'), searchList: {"11":__('Status 11')}, formatter: Table.api.formatter.status},
                        {field: 'remark', title: __('Remark'), operate: 'LIKE'},
                        {field: 'modifi1ed1', title: __('Modifi1ed1')},
                        {field: 'operate', title: __('Operate'), table: table, events: Table.api.events.operate, formatter: Table.api.formatter.operate}
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
