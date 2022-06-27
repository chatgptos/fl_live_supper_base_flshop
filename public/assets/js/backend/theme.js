define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'theme/index' + location.search,
                    add_url: 'theme/add',
                    edit_url: 'theme/edit',
                    del_url: 'theme/del',
                    multi_url: 'theme/multi',
                    import_url: 'theme/import',
                    table: 'booth_theme',
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
                        {field: 'name', title: __('Name'), operate: 'LIKE'},
                        {field: 'act_id', title: __('Act_id')},
                        {field: 'theme_add', title: __('Theme_add'), operate: 'LIKE'},
                        {field: 'theme_date', title: __('Theme_date')},
                        {field: 'theme_time', title: __('Theme_time'), operate: 'LIKE'},
                        {field: 'theme_content', title: __('Theme_content'), operate: 'LIKE'},
                        {field: 'linkman', title: __('Linkman'), operate: 'LIKE'},
                        {field: 'tel', title: __('Tel'), operate: 'LIKE'},
                        {field: 'registrant_id', title: __('Registrant_id')},
                        {field: 'pass', title: __('Pass')},
                        {field: 'theme_time_minute', title: __('Theme_time_minute'), operate: 'LIKE'},
                        {field: 'theme_time_end', title: __('Theme_time_end'), operate: 'LIKE'},
                        {field: 'theme_time_minute_end', title: __('Theme_time_minute_end'), operate: 'LIKE'},
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
