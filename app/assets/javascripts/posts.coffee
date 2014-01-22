$(document).ready ->
  $('#posts-table').dataTable
    aoColumnDefs: [
      { sWidth: '75px', aTargets: [0] }
      { sWidth: '75px', bSortable: false, aTargets: [-1] }
    ]