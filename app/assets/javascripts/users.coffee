$(document).ready ->
  $('#users-table').dataTable
    aoColumnDefs: [
      sWidth: '50px', bSortable: false, aTargets: [-1]
    ]