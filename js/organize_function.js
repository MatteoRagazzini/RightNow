document.addEventListener('DOMContentLoaded', function() {
  var elems = document.querySelectorAll('select');
  var instances = M.FormSelect.init(elems);
});


document.addEventListener('DOMContentLoaded', function() {
  var elems = document.querySelectorAll('.datepicker');
  var currentTime = new Date();
  var options = {autoClose: true, format: 'yyyy-mm-dd', minDate: currentTime};
  var instances = M.Datepicker.init(elems, options);
});

$(document).ready(function() {
  $('textarea#preview, textarea#description').characterCounter();
  $('.collapsible').collapsible();
  $('.tooltipped').tooltip();

});
