$(function () {
    'use strict';
    var dtUserTable = $('.plans-list-table'),
        newUserSidebar = $('.new-user-modal'),
        newUserForm = $('.add-new-user'),
        statusObj = {
            0: { title: 'Inactive', class: 'badge-light-secondary' },
            1: { title: 'Active', class: 'badge-light-success' }
        };

    var assetPath = '../assets/',
        planView = 'plans/edit/',
        planEdit = 'plans/edit/',
        planDelete = 'plans/delete/';
    if ($('body').attr('data-framework') === 'laravel') {
        assetPath = $('body').attr('data-asset-path');
        planView = assetPath + 'app/user/view';
        planEdit = assetPath + 'app/user/edit';
    }
    let n = 0;
  // Users List datatable
    if (dtUserTable.length) {
        dtUserTable.DataTable({
            processing: false,
            serverSide: false,
            autoWidth: true,
            ajax: 'admin/plans/getPlans',
            headers: {'X-Requested-With': 'XMLHttpRequest'},
            // JSON file to add data
            columns: [
        // columns according to JSON
            { data: 'id' },
            { data: 'title' },            
            { data: 'days' },
            { data: 'returns' },          
            { data: 'active' },
            { data: 'created_at' },
            { data: 'description' },
            { data: '' }
            ],
            responsive: true,
            columnDefs: [
                {
                    // For Responsive
                    className: 'control',
                    orderable: false,
                    responsivePriority: 1,
                    targets: 0
                    
                },
                
                {
                    // Title
                    targets: 1,
                    width: '180px',
                    responsivePriority: 2,
                    render: function (data, type, full, meta) {
                       
                        var $name = full['title'];
                        var $output;
                       
                        
                        // For Avatar badge
                        var stateNum = Math.floor(Math.random() * 6) + 1;
                        var states = ['success', 'danger', 'warning', 'info', 'dark', 'primary', 'secondary'];
                        var $state = states[stateNum],
                            $initials = $name.match(/\b\w/g) || [];
                        $initials = (($initials.shift() || '') + ($initials.pop() || '')).toUpperCase();
                        $output = '<span class="avatar-content">' + $initials + '</span>';
                        
                        var colorClass = ' bg-light-' + $state + ' ';
                        // Creates full output for row
                        var $row_output =
                            '<div class="d-flex justify-content-left align-items-center">' +
                            '<div class="avatar-wrapper">' +
                            '<div class="avatar ' +
                            colorClass +
                            ' mr-1">' +
                            $output +
                            '</div>' +
                            '</div>' +
                            '<div class="d-flex flex-column">' +
                            '<a href="' +
                            planView + full['id'] +
                            '" class="user_name text-truncate"><span class="font-weight-bold">' +
                            $name +
                            '</span></a>' +
                            '</div>' +
                            '</div>';
                        return $row_output;
                    }
                },
                {
                    // days
                    targets: 2,
                    width: '10px',
                    responsivePriority: 3
                },
                 {
                    // Returns
                    targets: 3,
                    width: '10px',
                    responsivePriority: 4
                },
                {
                    // Status
                    targets: 4,
                    render: function (data, type, full, meta) {
                        var $status = full['active'];

                        return (
                            '<span class="badge badge-pill ' +
                            statusObj[$status].class +
                            '" text-capitalized>' +
                            statusObj[$status].title +
                            '</span>'
                        );
                    }
                },
                {
                // Description
                targets: 5,
                
                render: function (data, type, full, meta) {
                    var $total = full['description'];
                    return '<div class="col-2 text-truncate"> <span class="d-none text-wrap text-truncate">' + $total + '</span> </div>'+ $total ;
                }
                },
                {
                //Date Created
                targets: 6,
                width: '180px',
                render: function (data, type, full, meta) {
           
                var $dueDate = new Date(full['created_at'].date);
                //console.log($dueDate);
                // Creates full output for row
                var $rowOutput =
                '<span class="d-none">' +
                moment($dueDate).format('YYYYMMDD') +
                '</span>' +
                moment($dueDate).format(' ddd DD-MM-YYYY HH:mm');
                
                return $rowOutput;
                }
                },
                {
                    // Actions
                    targets: 7,
                    title: 'Actions',
                    responsivePriority: 5,
                    orderable: false,
                    render: function (data, type, full, meta) {
                        return (
                            '<div class="btn-group">' +
                            '<a class="btn btn-sm dropdown-toggle hide-arrow" data-toggle="dropdown">' +
                            feather.icons['more-vertical'].toSvg({class: 'font-small-4'}) +
                            '</a>' +
                            '<div class="dropdown-menu dropdown-menu-right">' +
                            '<a href="' +
                            planView + full['id'] +
                            '" class="dropdown-item">' +
                            feather.icons['file-text'].toSvg({class: 'font-small-4 mr-50'}) +
                            'Details</a>' +
                            '<a href="' +
                            planEdit + full['id'] +
                            '" class="dropdown-item">' +
                            feather.icons['archive'].toSvg({class: 'font-small-4 mr-50'}) +
                            'Edit</a>' +
                            '<a href="' +
                            planDelete + full['id'] +
                            '" class="dropdown-item delete-record">' +
                            feather.icons['trash-2'].toSvg({class: 'font-small-4 mr-50'}) +
                            'Delete</a></div>' +
                            '</div>' +
                            '</div>'
                        );
                    }
                }
            ],
            order: [[2, 'desc']],
            dom:
                '<"d-flex justify-content-between align-items-center header-actions mx-1 row mt-75"' +
                '<"col-lg-12 col-xl-6" l>' +
                '<"col-lg-12 col-xl-6 pl-xl-75 pl-0"<"dt-action-buttons text-xl-right text-lg-left text-md-right text-left d-flex align-items-center justify-content-lg-end align-items-center flex-sm-nowrap flex-wrap mr-1"<"mr-1"f>B>>' +
                '>t' +
                '<"d-flex justify-content-between mx-2 row mb-1"' +
                '<"col-sm-12 col-md-6"i>' +
                '<"col-sm-12 col-md-6"p>' +
                '>',
            language: {
                sLengthMenu: 'Show _MENU_',
                search: 'Search',
                searchPlaceholder: 'Search..'
            },
            // Buttons with Dropdown
            buttons: [
                {
                    text: 'Add New Plan',
                    className: 'add-new btn btn-primary mt-50',
                    attr: {                        
                        'data-toggle': 'modal',
                        'data-target': '#modals-slide-in'
                    },
                    init: function (api, node, config) {
                        $(node).removeClass('btn-secondary');
                    }
                }
            ],
            // For responsive popup
            responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.modal({
                        header: function (row) {
                            var data = row.data();
                             return 'Details of ' + data['title'];
                        }
                    }),
                    type: 'column',
                    renderer: $.fn.dataTable.Responsive.renderer.tableAll({
                        tableClass: 'table',
                        columnDefs: [
                            {
                                targets: 2,
                                visible: false
                            },
                            {
                                targets: 3,
                                visible: false
                            }
                        ]
                    })
                }
            },
            language: {
                paginate: {
                    // remove previous & next text from pagination
                    //previous: '&nbsp;',
                    //next: '&nbsp;'
                }
            },
            initComplete: function () {
                /* Adding role filter once table initialized
                this.api()
                    .columns(3)
                    .every(function () {
                        var column = this;
                        var select = $(
                            '<select id="UserRole" class="form-control text-capitalize mb-md-0 mb-2"><option value=""> Select Role </option></select>'
                        )
                            .appendTo('.user_role')
                            .on('change', function () {
                                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                column.search(val ? '^' + val + '$' : '', true, false).draw();
                            });

                        column
                            .data()
                            .unique()
                            .sort()
                            .each(function (d, j) {
                                select.append('<option value="' + d + '" class="text-capitalize">' + d + '</option>');
                            });
                    });
                // Adding plan filter once table initialized
                this.api()
                    .columns(4)
                    .every(function () {
                        var column = this;
                        var select = $(
                            '<select id="UserPlan" class="form-control text-capitalize mb-md-0 mb-2"><option value=""> Select Plan </option></select>'
                        )
                            .appendTo('.user_plan')
                            .on('change', function () {
                                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                column.search(val ? '^' + val + '$' : '', true, false).draw();
                            });

                        column
                            .data()
                            .unique()
                            .sort()
                            .each(function (d, j) {
                                select.append('<option value="' + d + '" class="text-capitalize">' + d + '</option>');
                            });
                    });*/
                // Adding status filter once table initialized
               // var index = this.api().columns().names().indexOf('Status');
                this.api()
                    .columns(4)
                    .every(function () {
                        var column = this;
                        var select = $(
                            '<select id="FilterTransaction" class="form-control text-capitalize mb-md-0 mb-2xx"><option value=""> Select Status </option></select>'
                        )
                            .appendTo('.user_status')
                            .on('change', function () {
                                var val = $.fn.dataTable.util.escapeRegex($(this).val());
                                column.search(val ? '^' + val + '$' : '', true, false).draw();
                            });

                        column
                            .data()
                            .unique()
                            .sort()
                            .each(function (value, index) {
                                
                                select.append(
                                    '<option value="' +
                                    statusObj[value].title +
                                    '" class="text-capitalize">' +
                                    statusObj[value].title +
                                    '</option>'
                                );
                            });
                    });
            }
        });
    }


});