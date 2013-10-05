var _showModal = function(_url, _title) {
        $('#misModalTitle').html(_title);
        $("#modal-frame").attr("src", _url);
        $('#misModal').modal('toggle');
    }

var _charmForm = function(_u, _t, _id) {
        $('#charm-title').html(_t);
        $("#charm-frame").attr("src", _u + '/' + (_id !== undefined ? _id : ""));
        $('#charms').charms('showSection', 'theme-charms-section');
    }

var multiArchive = function() {
        console.log($('#gridForm').serialize());
        if (confirm('Are you sure to delete these records?')) {
            $.post(
            document.location.href + '/archive-all/0', $('#gridForm').serialize()).success(function(response) {
                data = JSON.parse(response);
                $('#genMsg').addClass(data.flagClass).html(data.Message).fadeIn();
                SetupDatatable();
            });
        }
    }

var _constructDetails = function() {
        $('a.showit').click(function() {
            var _elem = $(this);
            var _row = _elem.parent().parent().parent();
            var _tid = $(_row).data('rowid');
            var _url = document.location.href + '/detail/' + _tid
            $.ajax({
                "type": "POST",
                "url": _url,
                "dataType": "html",
                "success": function(data) {
                    $('div#detailsModel').html(data);
                    $('div#modalRowDetails').modal({
                        'hidden': function() {
                            alert('closed');
                            $('div#detailsModel').hide();
                        }
                    });
                    $('div#detailsModel').show();
                }
            });
        });
    };

var _constructArchive = function() {
        $('a.removeit').click(function() {
            var _elem = $(this);
            if (confirm('Are you sure to delete this record?')) {
                blockForm('Deleting record');
                var _row = _elem.parent().parent().parent();
                var _tid = $(_row).data('rowid');
                var _url = document.location.href + '/archive/' + _tid
                $.ajax({
                    "type": "POST",
                    "url": _url,
                    "dataType": "html",
                    "success": function(data) {
                        unBlockForm();
                        data = JSON.parse(data);
                        $('#genMsg').addClass(data.flagClass).html(data.Message).fadeIn();
                        SetupDatatable();
                    }
                });
            }
        });
    };

var _constructEdit = function() {
        $('a.editit').click(function() {
            var _elem = $(this);
            blockForm('Editing record');
            var _row = _elem.parent().parent().parent();
            var _tid = $(_row).data('rowid');
            var _url = document.location.href;
            if (isNaN(_tid)) {
                _url = _url + '/edit/' + _tid;
            } else {
                _url = _url + '/edit/' + _tid;
            }

            $.ajax({
                "type": "POST",
                "url": _url,
                "dataType": "html",
                "success": function(data) {
                    unBlockForm();
                    data = JSON.parse(data);
                    $.each(data, function() {
                        $.each(this, function(key, value) {
                            var _element = key;
                            this.name = key;
                            this.value = value;
                            if (document.getElementById(_element) != null) {
                                if (document.getElementById(_element).type == "checkbox") {
                                    if (value == 'true') document.getElementById(_element).checked = true;
                                }
                                $('#' + _element).each(function() {
                                    if (this.name.indexOf('Date') >= 0 || this.name.indexOf('date') >= 0 || this.name.indexOf('DOB') >= 0) {
                                        this.value = value.replace('T00:00:00+05:30', '').split("-").reverse().join("-");
                                    } else {
                                        this.value = value;
                                    }
                                });

                                if (document.getElementById(_element).type == "select-one" || document.getElementById(_element).type == "select-multiple") {
                                    console.log(document.getElementById(_element).type);
                                    $('#' + _element).trigger("liszt:updated");
                                }

                                $('.' + _element).each(function() {
                                    if (this.name.indexOf('Date') >= 0 || this.name.indexOf('date') >= 0 || this.name.indexOf('DOB') >= 0) {
                                        this.value = value.replace('T00:00:00+05:30', '').split("-").reverse().join("-");
                                    } else {
                                        this.value = value;
                                    }
                                });
                            }
                        });
                    });
                }
            });
        });
    }

var ModelPopForm = function(url, height, width) {
        var src = url;
        $.modal('<iframe src="' + src + '" height="380" width="1030" style="border:1">', {
            closeHTML: "",
            containerCss: {
                backgroundColor: "#fff",
                borderColor: "#fff",
                height: 380,
                //650,
                padding: 0,
                width: 1030 //930
            },
            overlayClose: true
        });
    }

var blockForm = function(_m) {
        $('div.formcontainer').block({
            message: '<h1>' + _m + '</h1>',
            css: {
                border: 'none',
                padding: '15px',
                backgroundColor: '#000',
                '-webkit-border-radius': '10px',
                '-moz-border-radius': '10px',
                opacity: .5,
                color: '#fff'
            }
        });
    }

var unBlockForm = function() {
        $('div.formcontainer').unblock();
    }

$(document).ready(function() {
    $('.dropdown-toggle').dropdown();
    $('div.form-container').prepend('<div id="genMsg" class="alert hide"></div>');

    $('#genMsg').click(function() {
        $('#genMsg').fadeOut();
    });

    $('form').not('.reportform').each(function() {
        var _currentForm = $(this);
        _currentForm.ajaxForm({
            beforeSubmit: validate,
            success: function(data) {
                unBlockForm();
                data = JSON.parse(data);
                $('#genMsg').addClass(data.flagClass).html(data.Message).fadeIn();
                if (data.flag == 1) {
                    $("input:hidden").each(

                    function() {
                        this.value = 0;
                    });
                }
                SetupDatatable();
            }
        });
    });

    //$(document).ready(function () {
    //    $('select').multiselect({
    //        enableFiltering: true
    //    });
    //});
    if ($('div#gridView').length > 0) {
        SetupDatatable();
    };
    $('a#gridRefresh').click(function() {
        SetupDatatable();
    });

    _constructArchive();
    _constructEdit();
    $('input[name$="Date"]').datepicker({
        dateFormat: 'dd-mm-yy',
        changeYear: true,
        changeMonth: true
    });
    $('input[name^="Date"]').datepicker({
        dateFormat: 'dd-mm-yy',
        changeYear: true,
        changeMonth: true
    });
    $('input[name^="DOB"]').datepicker({
        dateFormat: 'dd-mm-yy',
        changeYear: true,
        changeMonth: true
    });

    $('#SelectTable').each(function() {
        $(this).dataTable({
            "sPaginationType": "full_numbers",
            "bStateSave": true,
            "bScrollCollapse": true
        });
    });
});

var validate = function(formData, jqForm, options) {
        var _valSection = jqForm.attr('valsection');
        _valSection = _valSection === undefined || _valSection === '' ? 'main' : _valSection;
        var _valRsult = subCommonForm($('form').index(jqForm), _valSection);
        if (_valRsult) {
            blockForm('Please wait...');
        }
        return _valRsult;
    }

var AppendLabelText = function(elem, label, lblValue, isPost) {
        var _appendText = '';
        var _currentVal = $('#' + elem).val();
        $('#' + elem).children().each(function() {
            if ($(this).attr('value') === _currentVal) {
                _appendText = $(this).html();
                !isPost ? $('#' + label).html(_appendText + ' ' + lblValue) : $('#' + label).html(lblValue + ' ' + _appendText);
                return;
            }
        });
    }

var higlightSelect = function(_sender, _id, _totalChecks) {
        $('.boldSelect').removeClass('boldSelect');
        _sender.parent().parent().addClass('boldSelect');
        var _allRadios = document.getElementsByName(_totalChecks);
        for (var i = 0; i < _allRadios.length; i++) {
            var _radio = $(_allRadios[i]);
            _radio.removeAttr('checked');
        }
        $('#dataTableRowRadio' + _id).attr('checked', 'checked');
    }

var LoadDataTable = function() {
        //blockForm('Loading...');
        var _intTableSection = 0;
        var _hidden = $(document.forms[0]).find('input[id^="trasht"]')[0];
        //var oTable = $('#datatable').dataTable();
        var _url = document.location.href + '/grid/0';
        $.ajax({
            "type": "POST",
            "url": _url,
            "async": true,
            "success": function(data) {
                //oTable.fnDestroy();
                $('#gridView').html(data);
                _constructArchive();
                _constructEdit();
                _constructDetails();
                $('table#datatable').each(function() {
                    if (jQuery().dataTable) {
                        $(this).dataTable({
                            aLengthMenu: [
                                [5, 10, 15, 25, 50, 100, -1],
                                [5, 10, 15, 25, 50, 100, "All"]
                            ],
                            iDisplayLength: 5,
                            oLanguage: {
                                sLengthMenu: "Show _MENU_ Records per page",
                                sInfo: "Showing _START_ - _END_ of _TOTAL_ Records",
                                sInfoEmpty: "0 - 0 of 0",
                                oPaginate: {
                                    sPrevious: "Prev",
                                    sNext: "Next"
                                }
                            },
                            aoColumnDefs: [{
                                bSortable: false,
                                aTargets: [0]
                            }]
                        })
                    }
                });
                $('.table > thead > tr > th:first-child > input[type="checkbox"]').change(function() {
                    var e = false;
                    if ($(this).is(":checked")) {
                        e = true
                    }
                    $(this).parents("thead").next().find('tr > td:first-child > input[type="checkbox"]').prop("checked", e)
                });
                $("html").niceScroll({
                    zindex: 999
                });
                $(".show-tooltip").tooltip({
                    container: "body",
                    delay: {
                        show: 500
                    }
                });
                //unBlockForm();
            }
        });
    }

var RefreshDataTable = function() {
        var _intTableSection = 0;
        var _hidden = $(document.forms[0]).find('input[id^="trasht"]')[0];
        var oTable = $('#datatable').dataTable();
        var _url = document.location.href + '/table/';
        $.ajax({
            "type": "POST",
            "url": _url,
            "success": function(data) {
                oTable.fnDestroy();
                $('#gridView').html(data);
                _constructArchive();
                _constructEdit();
                $('#datatable').dataTable({
                    "sPaginationType": "full_numbers",
                    "bStateSave": true,
                    "sDom": "<'row-fluid'<'span6'l><'span3'T><'span3'f>r>t<'row-fluid'<'span2'i><'span10'p>>",
                    "oTableTools": {
                        "sSwfPath": "/content/swf/copy_csv_xls_pdf.swf",
                        "aButtons": [{
                            "sExtends": 'copy',
                            "sButtonText": '<i aria-hidden="true" class="icon-copy"></i>'
                        }, {
                            "sExtends": 'print',
                            "sButtonText": '<i aria-hidden="true" class="icon-printer"></i>'
                        }, {
                            "sExtends": "collection",
                            "sButtonText": ' <i aria-hidden="true" class="icon-export"></i> Export <span class="caret" />',
                            "aButtons": [{
                                "sExtends": 'csv',
                                "sButtonText": '<i aria-hidden="true" class="icon-grid-view"></i> CSV'
                            }, {
                                "sExtends": 'xls',
                                "sButtonText": '<i aria-hidden="true" class="icon-file-excel"></i> Excel'
                            }, {
                                "sExtends": 'pdf',
                                "sButtonText": '<i aria-hidden="true" class="icon-file-pdf"></i> PDF'
                            }, ]
                        }]
                    },
                    "bScrollCollapse": true
                });
            }
        });
    }

var ToggleElement = function(flag, elem1, elem2) {
        if (flag) {
            $('#' + elem1).show();
            $('#' + elem2).hide();
            $('#' + elem1).attr('req', 'true');
            $('#' + elem2).attr('req', '');
        } else {
            $('#' + elem2).show();
            $('#' + elem1).hide();
            $('#' + elem2).attr('type', 'true');
            $('#' + elem1).attr('type', '');
        }
    }

var ToggleElementForDropDown = function(flag, Type, elem1, elem2) {
        if (flag && $('#' + Type).val() == '5') {

            $('#' + elem1).show();
            $('#' + elem2).hide();
            $('#' + elem1).attr('req', 'true');
            $('#' + elem2).attr('req', '');
        } else {
            $('#' + elem2).show();
            $('#' + elem1).hide();
            $('#' + elem2).attr('type', 'true');
            $('#' + elem1).attr('type', '');
        }
    }

var EditTabRecord = function(ID, _dataKey) {
        var _url = '/Common/TableData';
        $.ajax({
            "type": "POST",
            "url": _url,
            "data": "ID=" + ID + "&key=" + _dataKey,
            "dataType": "xml",
            "success": function(data) {
                $(data).find('Table').children().each(function() {
                    var _element = this.nodeName;
                    var node = $(this);
                    if (document.getElementById(_element) != null) {
                        if (document.getElementById(_element).type == "checkbox") {
                            if (node.text() == 'true') document.getElementById(_element).checked = true;
                        }
                        $('#' + _element).each(function() {
                            if (this.name.indexOf('Date') >= 0 || this.name.indexOf('date') >= 0) {
                                this.value = node.text().replace('T00:00:00+05:30', '').split("-").reverse().join("-");
                            } else {
                                this.value = node.text();
                            }

                        });

                        $('.' + _element).each(function() {
                            if (this.name.indexOf('Date') >= 0 || this.name.indexOf('date') >= 0) {
                                this.value = node.text().replace('T00:00:00+05:30', '').split("-").reverse().join("-");
                            } else {
                                this.value = node.text();
                            }
                        });
                    }
                });
            }
        });
    }

var EditRecord = function(ID) {
        var _url = '/Common/TableData';
        $.ajax({
            "type": "POST",
            "url": _url,
            "data": "ID=" + ID + "&key=" + _recordKey,
            "dataType": "xml",
            "success": function(data) {
                $(data).find('Table').children().each(function() {
                    var _element = this.nodeName;
                    var node = $(this);
                    if (document.getElementById(_element) != null) {
                        if (document.getElementById(_element).type == "checkbox") {
                            if (node.text() == 'true') document.getElementById(_element).checked = true;
                        }
                        $('#' + _element).each(function() {
                            if (this.name.indexOf('Date') >= 0 || this.name.indexOf('date') >= 0) {
                                this.value = node.text().replace('T00:00:00+05:30', '').split("-").reverse().join("-");
                            } else {
                                this.value = node.text();
                            }

                        });

                        $('.' + _element).each(function() {
                            if (this.name.indexOf('Date') >= 0 || this.name.indexOf('date') >= 0) {
                                this.value = node.text().replace('T00:00:00+05:30', '').split("-").reverse().join("-");
                            } else {
                                this.value = node.text();
                            }
                        });
                    }
                });
            }
        });
    }

var CascadeFormData = function(_spKey, ID, _otherParams) {
        var _url = '/Common/CascadeForm';
        $.ajax({
            "type": "POST",
            "url": _url,
            "data": "ID=" + ID + "&key=" + _spKey + '&data=' + _otherParams,
            "dataType": "xml",
            "success": function(data) {
                $(data).find('Table').children().each(function() {
                    var _element = this.nodeName;
                    var node = $(this);
                    if (document.getElementById(_element) != null) {
                        if (document.getElementById(_element).type == "checkbox") {
                            if (node.text() == 'true') document.getElementById(_element).checked = true;
                        }
                        $('#' + _element).each(function() {
                            this.value = node.text();
                            console.log(this.name + '=' + this.value);
                        });

                        $('.' + _element).each(function() {
                            this.value = node.text();
                            console.log(this.name + '=' + this.value);
                        });
                    }
                });
            }

        });
    }

var dragDropOptions = function(_source, _target, _appendText) {
        $('#' + _source).children().each(function() {
            if (this.selected) {
                var _optionVal = new String();
                _optionVal = this.value;
                if (_appendText) {
                    this.value = _optionVal + '$' + this.text;
                } else {
                    this.value = _optionVal.substring(0, _optionVal.indexOf('$'));
                }
                $('#' + _target).append(this);
            }
        });
    }

var cascadeOptions = function(spKey, nameField, pkField, data, target, _callBack) {
        blockForm('Loading...');
        var _url = document.location.href + '/cascade/0'

        $.ajax({
            "type": "POST",
            "url": _url,
            "data": "spKey=" + spKey + "&nameField=" + nameField + "&pkField=" + pkField + "&data=" + data,
            "dataType": "html",
            "success": function(responsedata) {
                target.html('<option value="0">Select...</option>' + responsedata).trigger("liszt:updated");
                if (_callBack != undefined) {
                    _callBack(responsedata);
                }
                unBlockForm();
            }
        });

    }

var cascadeOptionsWithOutSelect = function(spKey, nameField, data, target) {
        var _url = '/Common/Cascade'
        //target.html('<option><option>');
        $.ajax({
            "type": "POST",
            "url": _url,
            "data": "spKey=" + spKey + "&nameField=" + nameField + "&data=" + data,
            "dataType": "html",
            "success": function(responsedata) {
                target.html(responsedata);
            }
        });
    }

var cascadeJson = function(spKey, data, target) {
        var _url = '/Common/CascadeJson'

        $.ajax({
            "type": "POST",
            "url": _url,
            "data": "spKey=" + spKey + "&data=" + data,
            "dataType": "html",
            "success": function(responsedata) {
                responsedata = responsedata.replace('<' + target + '>', '');
                responsedata = responsedata.replace('</' + target + '>', '');
                $('#' + target).val(responsedata);
            }
        });
    }

var CheckHorizontalRow = function(_object) {
        _object.parent().parent().children().each(function() {

            if (_object.attr('checked')) {
                $(this).children().attr('checked', 'checked');
            } else {
                $(this).children().removeAttr('checked');
            }
        });
    }

var CheckVerticalColumn = function(_object) {
        var _objectId = _object.attr('id');
        console.log(_object.attr('id'));
        console.log();
        $('input[id$="' + _objectId + '"]').each(function() {
            if (_object.attr('checked')) {
                $(this).attr('checked', 'checked');
            } else {
                $(this).removeAttr('checked');
            }
        });
    }

$('#wholeWeek').click(function() {
    if ($(this).attr('checked')) {
        $('.attendance-sheet').find('input').attr('checked', 'checked')
    } else {
        $('.attendance-sheet').find('input').removeAttr('checked');
    }
});

$("input:reset").click(function() {
    $("input:hidden").each(

    function() {
        this.value = 0;
    })
});

var SetupDatatable = function() {
        var _url = document.location.href + '/grid/1';//'./grid/1';
        $.post(_url).success(function(response) {
            $('div#gridView').html(response);
            var _datatable = $('table#datatable').dataTable({
                "bProcessing": false,
                "bServerSide": true,
                "sAjaxSource": document.location.href + "/server-grid",
                aLengthMenu: [
                    [5, 10, 15, 25, 50, 100, -1],
                    [5, 10, 15, 25, 50, 100, "All"]
                ],
                iDisplayLength: 5,
                "oLanguage": {
                    sLengthMenu: "Show _MENU_ Records per page",
                    sInfo: "Showing _START_ - _END_ of _TOTAL_ Records",
                    sInfoEmpty: "0 - 0 of 0",
                    oPaginate: {
                        sPrevious: "Prev",
                        sNext: "Next"
                    },
                    "sSearch": "Search all columns:"
                },
                aoColumnDefs: [{
                    bSortable: false,
                    aTargets: [0]
                },
                {
                    bSortable: false,
                    aTargets: [-1]
                }
                ],
                "fnDrawCallback": function( oSettings ) {
                },
                "fnServerData": function ( sUrl, aoData, fnCallback, oSettings ) {
                    blockForm('Loading grid data.');
                    var footerFilters = $('input[name^="filter[]"]')
                                          .map(function() {
                                            return this.value;
                                          }).get().join();
                    
                    aoData.push( { "name": "footerFilters", "value": footerFilters } );

                    oSettings.jqXHR = $.ajax( {
                        "url":  sUrl,
                        "data": aoData,
                        "success": function (json) {
                            unBlockForm();
                            if ( json.sError ) {
                                oSettings.oApi._fnLog( oSettings, 0, json.sError );
                            }

                            $.fn.dataTableExt.oApi.fnPagingInfo(oSettings);
                            $.fn.dataTableExt.oPagination.bootstrap.fnUpdate(
                                oSettings,
                                oSettings.aoDrawCallback[3].fn
                            );
                            $(oSettings.oInstance).trigger('xhr', [oSettings, json]);
                            
                            fnCallback( json );
                            $(oSettings.nTBody).html(json.aaRowHtml);
                            
                            _constructArchive();
                            _constructEdit();
                            _constructDetails();
                            afterTableLoad();

                            SetupTableFilter(_datatable, oSettings);
                        },
                        "dataType": "json",
                        "cache": false,
                        "type": oSettings.sServerMethod,
                        "error": function (xhr, error, thrown) {
                            unBlockForm();
                            if ( error == "parsererror" ) {
                                oSettings.oApi._fnLog( oSettings, 0, "DataTables warning: JSON data from "+
                                    "server could not be parsed. This is caused by a JSON formatting error." );
                            }
                        }
                    });
                }
            });
            var _oSettings = _datatable.fnSettings();
        }).fail(function(response) {

        });
    }

var SetupTableFilter = function (oTable, oSettings) {
    var asInitVals = new Array();
    
    $("td.dtFoot button").click( function () {
        /* Filter on the column (the index) of this element */
        // oSettings.oApi._fnFilter( oSettings, this.value);
        oTable.fnFilter( $(this).prev().val(), $("tfoot input").index(this) );
        oTable.fnFilterClear();
    } );
    
    /*
     * Support functions to provide a little bit of 'user friendlyness' to the textboxes in 
     * the footer
     */
    $("td.dtFoot > input").each( function (i) {
        asInitVals[i] = this.value;
    } );
    
    $("td.dtFoot > input").focus( function () {
        if ( this.className == "search_init" )
        {
            this.className = "";
            this.value = "";
        }
    } );
    
    $("td.dtFoot > input").blur( function (i) {
        if ( this.value == "" )
        {
            this.className = "search_init";
            this.value = asInitVals[$("tfoot input").index(this)];
        }
    } );
}

var afterTableLoad = function () {
    $('.table > thead > tr > th:first-child > input[type="checkbox"]').change(function() {
        var e = false;
        if ($(this).is(":checked")) {
            e = true
        }
        $(this).parents("thead").next().next().find('tr > td:first-child > input[type="checkbox"]').prop("checked", e)
    });
    $("html").niceScroll({
        zindex: 999
    });
    $(".show-tooltip").tooltip({
        container: "body",
        delay: {
            show: 500
        }
    });
}

// SetupDatatable();