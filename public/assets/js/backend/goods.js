define(['jquery', 'bootstrap', 'backend', 'table', 'form'], function ($, undefined, Backend, Table, Form) {

    var Controller = {
        index: function () {
            // 初始化表格参数配置
            Table.api.init({
                extend: {
                    index_url: 'goods/index' + location.search,
                    add_url: 'goods/add',
                    edit_url: 'goods/edit',
                    del_url: 'goods/del',
                    multi_url: 'goods/multi',
                    import_url: 'goods/import',
                    table: 'booth_goods',
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
                        {field: 'cat_id', title: __('Cat_id')},
                        {field: 'goods_sn', title: __('Goods_sn'), operate: 'LIKE'},
                        {field: 'name', title: __('Name'), operate: 'LIKE'},
                        {field: 'goods_name_style', title: __('Goods_name_style'), operate: 'LIKE'},
                        {field: 'click_count', title: __('Click_count')},
                        {field: 'brand_id', title: __('Brand_id')},
                        {field: 'provider_name', title: __('Provider_name'), operate: 'LIKE'},
                        {field: 'goods_number', title: __('Goods_number')},
                        {field: 'goods_weight', title: __('Goods_weight'), operate:'BETWEEN'},
                        {field: 'market_price', title: __('Market_price'), operate:'BETWEEN'},
                        {field: 'shop_id', title: __('Shop_id')},
                        {field: 'shop_price', title: __('Shop_price'), operate:'BETWEEN'},
                        {field: 'promote_price', title: __('Promote_price'), operate:'BETWEEN'},
                        {field: 'promote_start_date', title: __('Promote_start_date')},
                        {field: 'promote_end_date', title: __('Promote_end_date')},
                        {field: 'warn_number', title: __('Warn_number')},
                        {field: 'keywords', title: __('Keywords'), operate: 'LIKE'},
                        {field: 'goods_brief', title: __('Goods_brief'), operate: 'LIKE'},
                        {field: 'goods_thumb', title: __('Goods_thumb'), operate: 'LIKE'},
                        {field: 'goods_img', title: __('Goods_img'), operate: 'LIKE'},
                        {field: 'original_img', title: __('Original_img'), operate: 'LIKE'},
                        {field: 'is_real', title: __('Is_real')},
                        {field: 'extension_code', title: __('Extension_code'), operate: 'LIKE'},
                        {field: 'is_on_sale', title: __('Is_on_sale')},
                        {field: 'is_alone_sale', title: __('Is_alone_sale')},
                        {field: 'is_shipping', title: __('Is_shipping')},
                        {field: 'integral', title: __('Integral')},
                        {field: 'add_time', title: __('Add_time'), operate:'RANGE', addclass:'datetimerange', autocomplete:false, formatter: Table.api.formatter.datetime},
                        {field: 'sort_order', title: __('Sort_order')},
                        {field: 'is_delete', title: __('Is_delete')},
                        {field: 'is_best', title: __('Is_best')},
                        {field: 'is_new', title: __('Is_new')},
                        {field: 'is_hot', title: __('Is_hot')},
                        {field: 'is_promote', title: __('Is_promote')},
                        {field: 'bonus_type_id', title: __('Bonus_type_id')},
                        {field: 'last_update', title: __('Last_update')},
                        {field: 'goods_type', title: __('Goods_type')},
                        {field: 'seller_note', title: __('Seller_note'), operate: 'LIKE'},
                        {field: 'give_integral', title: __('Give_integral')},
                        {field: 'rank_integral', title: __('Rank_integral')},
                        {field: 'suppliers_id', title: __('Suppliers_id')},
                        {field: 'is_check', title: __('Is_check')},
                        {field: 'max_booking', title: __('Max_booking'), operate: 'LIKE'},
                        {field: 'unit_area', title: __('Unit_area'), operate:'BETWEEN'},
                        {field: 'is_pass', title: __('Is_pass')},
                        {field: 'reason', title: __('Reason'), operate: 'LIKE'},
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
