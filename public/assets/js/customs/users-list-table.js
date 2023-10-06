var usersListTable = $('#usersList').DataTable({
    language: {
        url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/fa.json'
    },
    retrieve: true,
    columnDefs: [
        {
            // For Responsive
            className: 'control',
            orderable: false,
            searchable: false,
            responsivePriority: 2,
            targets: 0,
        },
        {
            // For Checkboxes
            targets: 1, orderable: false, searchable: false, responsivePriority: 3, render: function () {
                return '<input type="checkbox" class="dt-checkboxes form-check-input">';
            }, checkboxes: {
                selectAllRender: '<input type="checkbox" class="form-check-input">'
            }
        },
        {
            targets: 2, searchable: false, visible: false
        },
        {
            targets: 8, searchable: false, orderable: false,
        },
    ]
})

