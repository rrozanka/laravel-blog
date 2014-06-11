// This is a manifest file that'll be compiled into application.js, which will include all the files
// listed below.
//
// Any JavaScript/Coffee file within this directory, lib/assets/javascripts, vendor/assets/javascripts,
// can be referenced here using a relative path.
//
// It's not advisable to add code directly here, but if you do, it'll appear in whatever order it 
// gets included (e.g. say you have require_tree . then the code will appear after all the directories 
// but before any files alphabetically greater than 'application.js' 
//
// The available directives right now are require, require_directory, and require_tree
//
// require jquery
// require_directory ../../../provider/assets/javascripts
// require_tree .
//
//= require jquery
//= require bootstrap
//= require jquery.dataTables
//= require jquery.noty.packaged
//= require summernote
//= require global
//= require categories
//= require comments
//= require posts
//= require tags
//= require users
//= require plugins
//= require jquery.easing
//= require jquery.appear
//= require jquery.cookie
//= require jquery.validate
//= require theme

$(document).ready(function() {
    if (flashMessage.length) {
        noty({
            text: flashMessage,
            layout: 'bottomLeft',
            type: flashMessageType,
            timeout: 2500
        });
    }
});
