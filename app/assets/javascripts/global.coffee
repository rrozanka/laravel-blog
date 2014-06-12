$(document).ready ->
  if flashMessage.length
    noty
      text: flashMessage,
      layout: 'bottomLeft',
      type: flashMessageType,
      timeout: 2500

$(document).on 'click', '.delete-record', ->
  if confirm('Czy na pewno chcesz usunąć ten wpis?')
    $.ajax
        url: $(this).attr('href'),
        type: 'DELETE',
        success: () ->
          location.reload()

  return false