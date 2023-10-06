/**
 * DataTables Basic
 */

'use strict';

let fv;

// datatable (jquery)
$(function () {
    var dt_basic_table = $('.datatables-basic'),
        dt_basic;

    // DataTable with buttons
    // --------------------------------------------------------------------

    if (dt_basic_table.length) {
        dt_basic = dt_basic_table.DataTable({
            ajax: assetsPath + 'json/table-datatable.json',
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/fa.json',
            },
            columns: [
                {data: ''},
                {data: 'id'},
                {data: 'id'},
                {data: 'full_name'},
                {data: 'email'},
                {data: 'start_date'},
                {data: 'salary'},
                {data: 'status'},
            ],
            columnDefs: [
                {
                    // For Responsive
                    className: 'control',
                    orderable: false,
                    searchable: false,
                    responsivePriority: 2,
                    targets: 0,
                    render: function (data, type, full, meta) {
                        return '';
                    }
                },
                {
                    // For Checkboxes
                    targets: 1,
                    orderable: false,
                    searchable: false,
                    responsivePriority: 3,
                    checkboxes: true,
                    render: function () {
                        return '<input type="checkbox" class="dt-checkboxes form-check-input">';
                    },

                },
                {
                    targets: 2,
                    searchable: false,
                    visible: false
                },
                {
                    // Avatar image/badge, Name and post
                    targets: 3,
                    responsivePriority: 4,
                    render: function (data, type, full, meta) {
                        var $user_img = full['avatar'],
                            $name = full['full_name'],
                            $post = full['post'];
                        if ($user_img) {
                            //! For Avatar image
                            var $output =
                                '<img src="' + assetsPath + 'img/avatars/' + $user_img + '" alt="Avatar" class="rounded-circle">';
                        } else {
                            //! For Avatar badge
                            var stateNum = Math.floor(Math.random() * 6);
                            var states = ['success', 'danger', 'warning', 'info', 'dark', 'primary', 'secondary'];
                            var $state = states[stateNum],
                                $name = full['full_name'],
                                $initials = $name.match(/\b\w/g) || [];
                            $initials = (($initials.shift() || '') + ($initials.pop() || ''));
                            $output = '<span class="avatar-initial rounded-circle bg-label-' + $state + '">' + $initials + '</span>';
                        }
                        // Creates full output for row
                        var $row_output =
                            '<div class="d-flex justify-content-start align-items-center user-name">' +
                            '<div class="avatar-wrapper">' +
                            '<div class="avatar me-2">' +
                            $output +
                            '</div>' +
                            '</div>' +
                            '<div class="d-flex flex-column">' +
                            '<span class="emp_name text-truncate">' +
                            $name +
                            '</span>' +
                            '</div>' +
                            '</div>';
                        return $row_output;
                    }
                },
                {
                    responsivePriority: 1,
                    targets: 4
                },
                {
                    // Label
                    targets: -2,
                    render: function (data, type, full, meta) {
                        var $status_number = full['status'];
                        var $status = {
                            1: {title: 'Current', class: 'bg-label-primary'},
                            2: {title: 'Professional', class: ' bg-label-success'},
                            3: {title: 'Rejected', class: ' bg-label-danger'},
                            4: {title: 'Resigned', class: ' bg-label-warning'},
                            5: {title: 'Applied', class: ' bg-label-info'}
                        };
                        if (typeof $status[$status_number] === 'undefined') {
                            return data;
                        }
                        return (
                            '<span class="badge ' + $status[$status_number].class + '">' + $status[$status_number].title + '</span>'
                        );
                    }
                },
                {
                    // Actions
                    targets: -1,
                    title: 'عملیات',
                    orderable: false,
                    searchable: false,
                    render: function (data, type, full, meta) {
                        return (
                            '<div class="d-inline-block">' +
                            '<a href="javascript:;" class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="bx bx-dots-vertical-rounded"></i></a>' +
                            '<ul class="dropdown-menu dropdown-menu-end m-0">' +
                            '<li><a href="javascript:;" class="dropdown-item">تغییر وضعیت</a></li>' +
                            '<div class="dropdown-divider"></div>' +
                            '<li><a href="javascript:;" class="dropdown-item text-danger delete-record">حذف کاربر</a></li>' +
                            '</ul>' +
                            '</div>' +
                            '<a href="javascript:;" class="btn btn-sm btn-icon item-edit" title="ویرایش"><i class="bx bxs-edit"></i></a>'
                        );
                    }
                }
            ],
            order: [[2, 'desc']],
            displayLength: 10,
            lengthMenu: [10, 25, 50, 75, 100],

            responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.modal({
                        header: function (row) {
                            var data = row.data();
                            return 'Details of ' + data['full_name'];
                        }
                    }),
                    type: 'column',
                    renderer: function (api, rowIdx, columns) {
                        var data = $.map(columns, function (col, i) {
                            return col.title !== '' // ? Do not show row in modal popup if title is blank (for check box)
                                ? '<tr data-dt-row="' +
                                col.rowIndex +
                                '" data-dt-column="' +
                                col.columnIndex +
                                '">' +
                                '<td>' +
                                col.title +
                                ':' +
                                '</td> ' +
                                '<td>' +
                                col.data +
                                '</td>' +
                                '</tr>'
                                : '';
                        }).join('');

                        return data ? $('<table class="table"/><tbody />').append(data) : false;
                    }
                }
            }
        });
        $('div.head-label').html('<h5 class="card-title mb-0">لیست کاربران</h5>');
    }


    // Filter form control to default size
    // ? setTimeout used for multilingual table initialization
    setTimeout(() => {
        $('.dataTables_filter .form-control').removeClass('form-control-sm');
        $('.dataTables_length .form-select').removeClass('form-select-sm');
    }, 300);
});
