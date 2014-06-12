$(document).ready ->
  if flashMessage.length
    noty
      text: flashMessage,
      layout: 'bottomLeft',
      type: flashMessageType,
      timeout: 2500

$(document).on 'click', '.delete-record', ->
  if confirm('Do you really want to delete this record?')
    $.ajax
        url: $(this).attr('href'),
        type: 'DELETE',
        success: () ->
          location.reload()

  return false