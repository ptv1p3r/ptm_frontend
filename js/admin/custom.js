/*!
* Start Bootstrap - SB Admin v7.0.5 (https://startbootstrap.com/template/sb-admin)
* Copyright 2013-2022 Start Bootstrap
* Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
*/

//sidebar toggle
window.addEventListener('DOMContentLoaded', event => {
    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        /*if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
            document.body.classList.toggle('sb-sidenav-toggled');
        }*/
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

});

//show tooltip & copy to clipbooard
function copy(text, target) {
    let concatTarget = '#'+target;
    //console.log(concatTarget);

    let concatCopyTip = '#copied_tip-'+target;
    //console.log(concatCopyTip);

    setTimeout(function() {
        $(concatCopyTip).remove();
    }, 800);

    $(concatTarget).append("<div class='copied_tip tip' id='copied_tip-"+target+"'>Copiado!</div>");

    var input = document.createElement('input');
    input.setAttribute('value', text);
    document.body.appendChild(input);
    input.select();

    var result = document.execCommand('copy');
    document.body.removeChild(input)

    return result;
}

//Get a random color from the colors array
Colors = {};
Colors.names = {
    red: "#f14a4a",
    purple: "#721f72",
    black: "#2d2d2d",
    blue: "#4c81ea",
    brown: "#a52a2a",
    darkorange: "#b26600",
    gold: "#ffc400",
    green: "#009a00",
    indigo: "#773d93",
    lime: "#6cef6c",
    magenta: "#ef62ef",
    maroon: "#942727",
    orange: "#ff9e00",
    pink: "#ffc0cb",
    cyan: "#3cffff",
    yellow: "#ffff3c"
};
Colors.random = function() {
    var result;
    var count = 0;
    for (var prop in this.names)
        if (Math.random() < 1/++count)
            result = prop;
    return { name: result, rgb: this.names[result]};
};