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
    color1: "#f85e5e",
    color2: "#a80a8e",
    color3: "#2d2d2d",
    color4: "#4c81ea",
    color5: "#e35c21",
    color6: "#8a4e00",
    color7: "#ffc400",
    color8: "#079a07",
    color9: "#8932b7",
    color10: "#5bd25b",
    color11: "#ef62ef",
    color12: "#b02525",
    color13: "#ff9e00",
    color14: "#ffc0cb",
    color15: "#17d3d3",
    color16: "#20be79"
};
Colors.random = function() {
    var result;
    var count = 0;
    for (var prop in this.names)
        if (Math.random() < 1/++count)
            result = prop;
    return { name: result, rgb: this.names[result]};
};