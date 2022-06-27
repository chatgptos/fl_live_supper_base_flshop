define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'hall/index' + location.search,
                    add_url: 'hall/add',
                    edit_url: 'hall/edit',
                    del_url: 'hall/del',
                    multi_url: 'hall/multi',
                    import_url: 'hall/import',
                    table: 'booth_hall',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'id',
                sortName: 'id',
                fixedColumns: true,
                fixedRightNumber: 1,
                columns: [
                    [
                        {checkbox: true},
                        {field: 'id', title: __('Id')},
                        {field: 'exhibition_id', title: __('Exhibition_id')},
                        {field: 'hall_name', title: __('Hall_name'), operate: 'LIKE'},
                        {field: 'name', title: __('Name'), operate: 'LIKE'},
                        {field: 'booths_num', title: __('Booths_num')},
                        {field: 'hall_map', title: __('Hall_map'), operate: 'LIKE'},
                        {field: 'hall_addr', title: __('Hall_addr'), operate: 'LIKE'},
                        {field: 'map_height', title: __('Map_height')},
                        {field: 'modified', title: __('Modified')},
                        {field: 'created', title: __('Created')},
                        {field: 'map_width', title: __('Map_width')},
                        {field: 'hall_namein', title: __('Hall_namein'), operate: 'LIKE'},
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
