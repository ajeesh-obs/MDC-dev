/**
 * Created by rafienleo on 8/5/19.
 */

var expertise = ["Public Speaking", "Copywriting", "Marketing", "Management", "Monitoring"];

$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip({
        html: true,
        trigger: 'hover',
        offset: 50
    });

    $('[data-toggle="popover"]').popover({
        html: true,
        trigger: 'focus',
        offset: 30
    });

    $('a#appointment-scheduling').popover({
        html: true,
        trigger: 'focus',
        content: function () {
            var content = $(this).attr("data-popover-content");
            return $(content).html();
        }
    });

    $('a#user-following').popover({
        html: true,
        trigger: 'focus',
        offset: 30,
        template: '<div class="popover user-following" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>',
        content: function () {
            var content = $(this).attr("data-popover-content");
            return $(content).html();
        }
    });

    $('a#user-pin').popover({
        html: true,
        trigger: 'focus',
        template: '<div class="popover user-pin" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>',
        content: function () {
            var content = $(this).attr("data-popover-content");
            return $(content).html();
        }
    });

    if ($('#coaches_calendar')[0]) {
        $('#coaches_calendar').datepicker();
    }

    $('.times .dropdown-menu a').click(function () {
        $('.times #selected').text($(this).text());
    });

    $('.account1 .dropdown-menu a').click(function () {
        $('.account1 #selected').text($(this).text());
    });

    $('.account2 .dropdown-menu a').click(function () {
        $('.account2 #selected').text($(this).text());
    });

    $('.legacy-dash .dropdown-menu a').click(function () {
        $('.legacy-dash #selected').text($(this).text());
    });

    if (document.getElementById("search")) {
        autocomplete(document.getElementById("search"), expertise);
    }

    $('li.dropdown.dropdown-chat a.dropdown-toggle').on('click', function (event) {
        $(this).parent().toggleClass('show');
        $(this).next().toggleClass('show');
    });

    $('body').on('click', function (e) {
        if (!$('li.dropdown.dropdown-chat').is(e.target)
            && $('li.dropdown.dropdown-chat').has(e.target).length === 0
            && $('.open').has(e.target).length === 0
        ) {
            $('li.dropdown.dropdown-chat').removeClass('open');
        }
    });
});

function autocomplete(inp, arr) {
    /*the autocomplete function takes two arguments,
     the text field element and an array of possible autocompleted values:*/
    var currentFocus;
    /*execute a function when someone writes in the text field:*/
    inp.addEventListener("input", function (e) {
        var w, a, b, i, val = this.value;
        /*close any already open lists of autocompleted values*/
        closeAllLists();
        if (!val) {
            return false;
        }
        currentFocus = -1;
        /*create a DIV element that will contain the items (values):*/
        a = document.createElement("DIV");
        a.setAttribute("id", this.id + "autocomplete-list");
        a.setAttribute("class", "autocomplete-items");
        /*append the DIV element as a child of the autocomplete container:*/
        this.parentNode.appendChild(a);
        /*create a DIV element that will contain the items (values):*/
        w = document.createElement("DIV");
        w.setAttribute("class", "autocomplete-items-wrapper");
        /*append the DIV element as a child of the autocomplete container:*/
        a.appendChild(w);
        /*for each item in the array...*/
        for (i = 0; i < arr.length; i++) {
            /*check if the item starts with the same letters as the text field value:*/
            if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                /*create a DIV element for each matching element:*/
                b = document.createElement("DIV");
                b.setAttribute("class", "autocomplete-item");
                /*make the matching letters bold:*/
                b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                b.innerHTML += arr[i].substr(val.length);
                /*insert a input field that will hold the current array item's value:*/
                b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                /*execute a function when someone clicks on the item value (DIV element):*/
                b.addEventListener("click", function (e) {
                    /*insert the value for the autocomplete text field:*/
                    inp.value = this.getElementsByTagName("input")[0].value;
                    /*close the list of autocompleted values,
                     (or any other open lists of autocompleted values:*/
                    closeAllLists();
                });
                w.appendChild(b);
            }
        }
    });

    /*execute a function presses a key on the keyboard:*/
    inp.addEventListener("keydown", function (e) {
        var x = document.getElementById(this.id + "autocomplete-list");
        if (x) x = x.getElementsByTagName("div");
        if (e.keyCode == 40) {
            /*If the arrow DOWN key is pressed,
             increase the currentFocus variable:*/
            currentFocus++;
            /*and and make the current item more visible:*/
            addActive(x);
        } else if (e.keyCode == 38) { //up
            /*If the arrow UP key is pressed,
             decrease the currentFocus variable:*/
            currentFocus--;
            /*and and make the current item more visible:*/
            addActive(x);
        } else if (e.keyCode == 13) {
            /*If the ENTER key is pressed, prevent the form from being submitted,*/
            e.preventDefault();
            if (currentFocus > -1) {
                /*and simulate a click on the "active" item:*/
                if (x) x[currentFocus].click();
            }
        }
    });

    function addActive(x) {
        /*a function to classify an item as "active":*/
        if (!x) return false;
        /*start by removing the "active" class on all items:*/
        removeActive(x);
        if (currentFocus >= x.length) currentFocus = 0;
        if (currentFocus < 0) currentFocus = (x.length - 1);
        /*add class "autocomplete-active":*/
        x[currentFocus].classList.add("autocomplete-active");
    }

    function removeActive(x) {
        /*a function to remove the "active" class from all autocomplete items:*/
        for (var i = 0; i < x.length; i++) {
            x[i].classList.remove("autocomplete-active");
        }
    }

    function closeAllLists(elmnt) {
        /*close all autocomplete lists in the document,
         except the one passed as an argument:*/
        var x = document.getElementsByClassName("autocomplete-items");
        for (var i = 0; i < x.length; i++) {
            if (elmnt != x[i] && elmnt != inp) {
                x[i].parentNode.removeChild(x[i]);
            }
        }
    }

    /*execute a function when someone clicks in the document:*/
    document.addEventListener("click", function (e) {
        closeAllLists(e.target);
    });
}