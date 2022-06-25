define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'cat/index' + location.search,
                    add_url: 'cat/add',
                    edit_url: 'cat/edit',
                    del_url: 'cat/del',
                    multi_url: 'cat/multi',
                    import_url: 'cat/import',
                    table: 'booth_article_cat',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'cat_id',
                sortName: 'cat_id',
                columns: [
                    [
                        {checkbox: true},
                        {field: 'cat_id', title: __('Cat_id')},
                        {field: 'name', title: __('Name'), operate: 'LIKE'},
                        {field: 'cat_type', title: __('Cat_type')},
                        {field: 'keywords', title: __('Keywords'), operate: 'LIKE'},
                        {field: 'cat_desc', title: __('Cat_desc'), operate: 'LIKE'},
                        {field: 'sort_order', title: __('Sort_order')},
                        {field: 'show_in_nav', title: __('Show_in_nav')},
                        {field: 'parent_id', title: __('Parent_id')},
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
