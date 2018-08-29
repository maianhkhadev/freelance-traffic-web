$(document).ready(function () {
  document.querySelector('select[name=week_id]').addEventListener('change', function (event) {
    window.location.href = `/members/${memberId}/week/${event.target.value}`
  })
})
