define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'activity/index' + location.search,
                    add_url: 'activity/add',
                    edit_url: 'activity/edit',
                    del_url: 'activity/del',
                    multi_url: 'activity/multi',
                    import_url: 'activity/import',
                    table: 'booth_activity',
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
                        {field: 'is_recommend', title: __('Is_recommend')},
                        {field: 'name', title: __('Name'), operate: 'LIKE'},
                        {field: 'act_add', title: __('Act_add'), operate: 'LIKE'},
                        {field: 'act_date', title: __('Act_date')},
                        {field: 'act_time', title: __('Act_time'), operate: 'LIKE'},
                        {field: 'act_content', title: __('Act_content'), operate: 'LIKE'},
                        {field: 'linkman', title: __('Linkman'), operate: 'LIKE'},
                        {field: 'tel', title: __('Tel'), operate: 'LIKE'},
                        {field: 'registrant_id', title: __('Registrant_id')},
                        {field: 'pass', title: __('Pass')},
                        {field: 'act_time_minute', title: __('Act_time_minute'), operate: 'LIKE'},
                        {field: 'end_time', title: __('End_time'), operate: 'LIKE'},
                        {field: 'act_time_minute_end', title: __('Act_time_minute_end'), operate: 'LIKE'},
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
