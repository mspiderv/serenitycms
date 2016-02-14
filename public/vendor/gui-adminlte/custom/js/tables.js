$(function() {
    // Classes
    datatable = {};
    datatable.sortgroupped_class = 'ui-sortable-grouped';
    datatable.sortgroupped_class_main = 'ui-sortable-grouped-main';
    datatable.unactive_class = 'ui-sortable-unactive';
    datatable.sorting_class = 'ui-sortable-sorting';

    // Return a helper with preserved width of cells
    datatable.fixHelper = function(e, ui){
        ui.children().each(function(){
            $(this).width($(this).width());
        });
        return ui;
    };

    /* Functions */
    datatable.saveSort = function(model, oldIDs, newIDs)
    {
        $.ajax({
            url: cfg['table.sortURL'],
            dataType: 'json',
            method: 'post',
            data:
            {
                'model': model,
                'oldIDs': oldIDs,
                'newIDs': newIDs
            },
            success: function(data)
            {
                if(data.result)
                {
                    // Log to console
                    if (typeof data.console == "string" && data.console.length > 0)
                    {
                        console.log("Sorting success: " + data.console);
                    }

                    // Show notification
                    window.notify.success(data.title, data.message);
                }
                else
                {
                    // Log to console
                    if (typeof data.console == "string" && data.console.length > 0)
                    {
                        console.error("Sorting failed: " + data.console);
                    }

                    // Show notification
                    window.notify.error(data.title, data.message);
                }
            },
            error: function(e)
            {
                console.log(e);
            }
        });
    }

    datatable.stop_sorting = function()
    {
        $('.datatable tbody').removeClass(datatable.sorting_class);
        $('.datatable tbody tr').removeClass(datatable.unactive_class);
    }

    datatable.findNested = function(element)
    {
        var cur_level = element.data('level');
        if(typeof cur_level == 'undefined') cur_level = 0;
        var go_next = true;
        var next = element;
        while(go_next)
        {
            next = next.next();
            var next_level = next.data('level');
            if(typeof next_level == 'undefined') next_level = 0;
            if(next_level > cur_level) next.addClass('temporary_class');
            else go_next = false;
        }
        var result = $('.temporary_class');
        result.removeClass('temporary_class');
        return result;
    }

    $('.datatable tbody tr[data-sortgroup]')
    .unbind('mouseover mouseout')
    .on('mouseover', function() {
        $('.datatable tbody tr[data-sortgroup]').removeClass(datatable.sortgroupped_class);
        $(this).addClass(datatable.sortgroupped_class + ' ' + datatable.sortgroupped_class_main);
        datatable.findNested($(this)).addClass(datatable.sortgroupped_class);
        if($('tr[data-sortgroup="' + $(this).data('sortgroup') + '"]').length > 1)
        {
            $(this).parent('tbody').find('tr td .handle').on('mousedown', function(){
                datatable.length_dropdown.val(datatable.length_dropdown.find('option').last().val())
                datatable.stop_sorting();
            });
            var sortable_group = $(this).data('sortgroup');
            var sortable_items_selector = 'tr[data-sortgroup="' + sortable_group + '"]:visible';
            var sortable_items_object = $(sortable_items_selector);
            $(this).parent('tbody').sortable({
                helper: datatable.fixHelper,
                items: sortable_items_selector,
                axis: 'y',
                handle: '.handle',
                start: function(event, ui) {
                    $(this).addClass(datatable.sorting_class);
                    $(this).find('tr').removeClass(datatable.unactive_class).each(function(){
                        if($(this).data('sortgroup') != ui.helper.data('sortgroup')) $(this).addClass(datatable.unactive_class);
                    });
                    datatable.main_row = $(this).find('tr[data-sortgroup].' + datatable.sortgroupped_class + '.' + datatable.sortgroupped_class_main);
                    datatable.sub_rows = $(this).find('tr[data-sortgroup].' + datatable.sortgroupped_class + ':not(.' + datatable.sortgroupped_class_main + ')');
                    datatable.this_prev = $($(ui.item).prevAll('tr[data-sortgroup="' + $(ui.item).data('sortgroup') + '"]')[0]);
                    datatable.this_prev_childs = datatable.findNested(datatable.this_prev);
                    datatable.this_next = $($(ui.item).nextAll('tr[data-sortgroup="' + $(ui.item).data('sortgroup') + '"]')[0]);
                    datatable.this_next_childs = datatable.findNested(datatable.this_next);
                    datatable.last_row = sortable_items_object.last();
                    datatable.last_childs = datatable.findNested(datatable.last_row);
                },
                update: function(event, ui)
                {
                    datatable.main_row.after(datatable.sub_rows);
                    datatable.this_prev.after(datatable.this_prev_childs);
                    datatable.this_next.after(datatable.this_next_childs);
                    datatable.last_row.after(datatable.last_childs);

                    var result = $(this).sortable('toArray', {
                        'attribute': 'data-id'
                    });
                    var sortable_items_ids = new Array();
                    sortable_items_object.each(function(){
                        sortable_items_ids.push($(this).data('id'));
                    });
                    datatable.saveSort(ui.item.data('model'), sortable_items_ids, result);

                    var aoData = datatable.object.fnSettings().aoData;
                    var aoData_sort = [];
                    sortable_items_object.each(function()
                    {
                        for(var aoData_index in datatable.object.fnSettings().aoData)
                        {
                            if(typeof aoData[aoData_index] == "object" && aoData[aoData_index].nTr == this)
                            {
                                aoData_sort.push(aoData_index);
                            }
                        }
                    });

                    function getNode(id)
                    {
                        for(var node in aoData)
                        {
                            if(typeof aoData[node] == "object" && aoData[node].nTr.id == id && $(aoData[node].nTr).data('sortgroup') == sortable_group)
                            {
                                return aoData[node];
                            }
                        }
                    }

                    var new_aoData = [];
                    aoData.forEach(function(item){
                        new_aoData.push(item);
                    });

                    for(var index in aoData_sort)
                    {
                        var new_object = getNode(result[index]);

                        if(typeof new_object == "object")
                        {
                            new_aoData[aoData_sort[index]] = new_object;
                        }
                    }

                    datatable.object.fnSettings().aoData = new_aoData;
                    sorting_changing = false;
                },
                stop: function(event, ui)
                {
                    datatable.stop_sorting();
                    $(this).find('tr').show().css('display', 'table-row');
                    sorting_changing = false;
                }
            });
        }
    })
    .on('mouseout', function(){
        $('.datatable tbody tr[data-sortgroup]').removeClass(datatable.sortgroupped_class + ' ' + datatable.sortgroupped_class_main);
    });

    datatable.languages = new Array();

    datatable.languages['sk'] = {
        "sProcessing":   "Pracujem...",
        "sLengthMenu":   "Zobraz _MENU_ záznamov",
        "sZeroRecords":  "Neboli nájdené žiadne záznamy",
        "sInfo":         "Záznamy _START_ až _END_ z celkovo _TOTAL_",
        "sInfoEmpty":    "Záznamy 0 až 0 z celkovo 0",
        "sInfoFiltered": "(filtrovanť z celkovo _MAX_ záznamov)",
        "sInfoPostFix":  "",
        "sSearch":       "Hľadaj:",
        "sUrl":          "",
        "oPaginate": {
            "sFirst":    "Prvá",
            "sPrevious": "Predchádzajúca",
            "sNext":     "Ďalšia",
            "sLast":     "Posledná"
        }
    };

    // TODO: Zlangovat datatables

    datatable.languages['en'] = {
        "sEmptyTable":     "No data available in table",
        "sInfo":           "Showing _START_ to _END_ of _TOTAL_ entries",
        "sInfoEmpty":      "Showing 0 to 0 of 0 entries",
        "sInfoFiltered":   "(filtered from _MAX_ total entries)",
        "sInfoPostFix":    "",
        "sInfoThousands":  ",",
        "sLengthMenu":     "Show _MENU_ entries",
        "sLoadingRecords": "Loading...",
        "sProcessing":     "Processing...",
        "sSearch":         "Search:",
        "sZeroRecords":    "No matching records found",
        "oPaginate": {
            "sFirst":    "First",
            "sLast":     "Last",
            "sNext":     "Next",
            "sPrevious": "Previous"
        },
        "oAria": {
            "sSortAscending":  ": activate to sort column ascending",
            "sSortDescending": ": activate to sort column descending"
        }
    };

    /* Create Datatables */
    $('.datatable').each(function()
    {
        var $this = $(this);

        if($this.find('tr[data-sortgroup]').length > 0)
        {
            $this.removeClass('datatable-sorting');
        }

        datatable.object = $this.dataTable({
            "bJQueryUI": true,
            "bSort": $this.hasClass('datatable-sorting'),
            "iDisplayLength": -1,
            "aLengthMenu": [
                [10, 20, 30, 60, 100, 200, -1],
                [10, 20, 30, 60, 100, 200, "všetky"]
            ],
            // TODO
            "oLanguage": datatable.languages['sk'],
            //"fnDrawCallback": page.ezmark
            paging: $this.data('paging'),
        });

        $('.dataTables_filter input, .dataTables_length select').addClass('form-control');

        datatable.length_dropdown = $(this).parent('.dataTables_wrapper').find('.dataTables_length select');
        datatable.filter_input = $(this).parent('.dataTables_wrapper').find('.dataTables_filter input');

    });

    /* Keyboard Controlled Datatables */
    $(window).on('keydown', function(e){
        if(!$('*:focus').is('textarea, input, select') && $('.datatable').is(':visible')) {
            if(e.keyCode == $.ui.keyCode.LEFT) datatable.object.fnPageChange('previous');
            else if(e.keyCode == $.ui.keyCode.UP){
                var $DataTables_length = $('#DataTables_Table_0_length');
                var $prev = $DataTables_length.find(':selected').prev();
                if($prev.is('option')){
                    $DataTables_length.find('option').removeAttr('selected');
                    $prev.attr('selected', 'selected');
                }
                $DataTables_length.find('select').trigger('change');
            }
            else if(e.keyCode == $.ui.keyCode.DOWN){
                var $DataTables_length = $('#DataTables_Table_0_length');
                var $next = $DataTables_length.find(':selected').next();
                if($next.is('option')){
                    $DataTables_length.find('option').removeAttr('selected');
                    $next.attr('selected', 'selected');
                }
                $DataTables_length.find('select').trigger('change');
            }
            else if(e.keyCode == $.ui.keyCode.RIGHT) datatable.object.fnPageChange('next');
            else if(e.keyCode == $.ui.keyCode.ENTER){
                var $first_row = $('.datatable').find('a').first();
                if(typeof $first_row != 'undefined') $first_row.trigger('click');
            }
            else if(!e.ctrlKey && e.keyCode >= 32) $('.dataTables_filter :input').focus();
        }
    });

});
