$(document).ready ->
  $('#posts-table').dataTable
    aoColumnDefs: [
      { sWidth: '75px', aTargets: [0] }
      { sWidth: '75px', bSortable: false, aTargets: [-1] }
    ]

  $('#short_body').summernote
    height: 150

  $('#body').summernote
    height: 300