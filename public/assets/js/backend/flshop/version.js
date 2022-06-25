define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'flbooth/version/index' + location.search,
                    add_url: 'flbooth/version/add',
                    edit_url: 'flbooth/version/edit',
                    del_url: 'flbooth/version/del',
                    multi_url: 'flbooth/version/multi',
                    import_url: 'flbooth/version/import',
                    table: 'flbooth_version',
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
                        {field: 'title', title: __('Title'), operate: 'LIKE'},
                        {field: 'versionName', title: __('Versionname'), operate: 'LIKE'},
                        {field: 'versionCode', title: __('Versioncode')},
                        {field: 'type', title: __('Type'), searchList: {"base":__('Type base'),"alpha":__('Type alpha'),"beta":__('Type beta'),"rc":__('Type rc'),"release":__('Type release')}, formatter: Table.api.formatter.normal},
                        {field: 'enforce', title: __('Enforce'), searchList: {"1": __('Yes'), "0": __('No')}, formatter: Table.api.formatter.toggle},
                        {field: 'created', title: __('created'), operate:'RANGE', addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime},
                        {field: 'modified', title: __('modified'), operate:'RANGE', addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime},
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