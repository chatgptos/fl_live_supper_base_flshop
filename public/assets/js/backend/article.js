define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'article/index' + location.search,
                    add_url: 'article/add',
                    edit_url: 'article/edit',
                    del_url: 'article/del',
                    multi_url: 'article/multi',
                    import_url: 'article/import',
                    table: 'booth_article',
                }
            });

            var table = $("#table");

            // 初始化表格
            table.bootstrapTable({
                url: $.fn.bootstrapTable.defaults.extend.index_url,
                pk: 'article_id',
                sortName: 'article_id',
                fixedColumns: true,
                fixedRightNumber: 1,
                columns: [
                    [
                        {checkbox: true},
                        {field: 'article_id', title: __('Article_id')},
                        {field: 'cat_id', title: __('Cat_id')},
                        {field: 'title', title: __('Title'), operate: 'LIKE'},
                        {field: 'content', title: __('Content')},
                        {field: 'author', title: __('Author'), operate: 'LIKE'},
                        {field: 'author_email', title: __('Author_email'), operate: 'LIKE'},
                        {field: 'keywords', title: __('Keywords'), operate: 'LIKE'},
                        {field: 'article_type', title: __('Article_type')},
                        {field: 'is_open', title: __('Is_open')},
                        {field: 'add_time', title: __('Add_time'), operate:'RANGE', addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime},
                        {field: 'file_url', title: __('File_url'), operate: 'LIKE', formatter: Table.api.formatter.url},
                        {field: 'open_type', title: __('Open_type')},
                        {field: 'link', title: __('Link'), operate: 'LIKE'},
                        {field: 'description', title: __('Description'), operate: 'LIKE'},
                        {field: 'order_num', title: __('Order_num')},
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
