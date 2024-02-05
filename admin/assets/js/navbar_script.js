// navbar_script.js
document.querySelector('.hamburger').addEventListener('click', (e) => {
    e.currentTarget.classList.toggle('is-active');
});

// JavaScript function to toggle collapse state
function toggleCollapse(collapseId) {
    $('#' + collapseId).toggleClass('show');
    localStorage.setItem(collapseId, $('#' + collapseId).hasClass('show') ? 'open' : 'closed');
}

// JavaScript function to toggle sidebar collapse
function toggleCollapseSidebar() {
    $('#sidebar').toggleClass('collapsed');
}

// Apply the state from local storage on document ready
$(document).ready(function () {
    if (localStorage.getItem('manageWorkloadCollapse') === 'open') {
        $('#manageWorkloadCollapse').addClass('show');
    }
});
