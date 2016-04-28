function getDaysInMonth(yyyy, mm) {
    var newDate = new Date(yyyy, mm, 0);
    return newDate.getDate();
}

function createCalendar(yyyy, mm) {
    var dMonth = new Array();

    var calendarDate = new Date(yyyy, mm - 1, 1);
    var dayFirst = calendarDate.getDay();
    var daysInMonth = getDaysInMonth(yyyy, mm);
    var varDate = 1;

    dMonth[1] = new Array(7);
    for (var days = dayFirst; days < 7; days++){
        dMonth[1][days] = varDate;
        varDate++;
    }

    dMonth[2] = new Array(7);
    dMonth[3] = new Array(7);
    dMonth[4] = new Array(7);
    dMonth[5] = new Array(7);
    dMonth[6] = new Array(7);
    for (var weeks = 2; weeks < 7; weeks++){
        for (var days = 0; days < 7; days++){
            if (varDate <= daysInMonth) {
                dMonth[weeks][days] = varDate;
                varDate++;
            }
        }
    }

    return dMonth;
}

function drawCalendar(yyyy, mm, arr){
    var curDate = new Date();

    var thisMonth;
    thisMonth = createCalendar(yyyy, mm);

    var weekContent = document.getElementById("week");
    var cnt = 1;
    var dis = "";

    for (var weeks = 1; weeks < 7; weeks++) {
        for (var days = 0; days < 7; days++) {
            cur = curDate.getFullYear() + '-' + (curDate.getMonth() + 1) + '-' + curDate.getDate();
            sel = yyyy + '-' + mm + '-' + thisMonth[weeks][days];
            now = cur == sel ? "now" : "";
            
            if (cnt % 7 == 1) {
                if (!isNaN(thisMonth[weeks][days])) {
                    if (curDate.getMonth() + 1 == mm && yyyy <= curDate.getFullYear()) {
                        if (arr[1] != 'admin-popupDiv') {
                            dis = thisMonth[weeks][days] < curDate.getDate() ? "disabled" : "ena";
                        } else {
                            dis = "ena";
                        }
                    } else {
                        dis = "ena";
                    }
                    weekContent.innerHTML += '<div class="day not-empty w h first"><button class="' + dis + ' ' + now + '" onclick="' + arr[0] + '(' + thisMonth[weeks][days] + ',\'' + arr[1] + '\')' + '" ' + dis + '>' + thisMonth[weeks][days] + '</button></div>';
                } else {
                    weekContent.innerHTML += '<div class="day w h first"></div>';
                }
            } else {
                if (!isNaN(thisMonth[weeks][days])) {
                    if (curDate.getMonth() + 1 == mm && yyyy <= curDate.getFullYear()) {
                        if (arr[1] != 'admin-popupDiv') {
                            dis = thisMonth[weeks][days] < curDate.getDate() ? "disabled" : "ena";
                        } else {
                            dis = "ena";
                        }
                    } else {
                        dis = "ena";
                    }
                    weekContent.innerHTML += '<div class="day not-empty w h"><button class="' + dis + ' ' + now + '" onclick="' + arr[0] + '(' + thisMonth[weeks][days] + ',\'' + arr[1] + '\')' + '" ' + dis + '>' + thisMonth[weeks][days] + '</button></div>';
                } else {
                    weekContent.innerHTML += '<div class="day w h"></div>';
                }
            }
            cnt++;
        }
    }
    weekContent.innerHTML += '<div style="clear: both; border-top: 1px solid #000; "></div>';
    
}

function changeMonth(val, arr){
    var curDate = new Date();

    var hidmm = document.getElementById("hidMonth");
    var hidyyyy = document.getElementById("hidYear");

    var newMonth = parseInt(hidmm.value) + parseInt(val);
    newMonth = newMonth < 13 && newMonth > 0 ? newMonth : newMonth - 12;

    
    var newYear = parseInt(hidyyyy.value);
    if (val > 0) {
        if (parseInt(hidmm.value) == 12) {
            newYear = parseInt(hidyyyy.value) + 1;
        }
    } else if (val < 0) {
        if (parseInt(hidmm.value) == 1) {
            newYear = parseInt(hidyyyy.value) - 1;
        }
    }

    hidmm.value = Math.abs(newMonth);
    hidyyyy.value = newYear;

    document.getElementById("disMonth").innerHTML = fGetMonth(hidmm.value - 1) + " " + hidYear.value;
    
    if (arr[1] != 'admin-popupDiv') {
        if (curDate.getMonth() + 1 == parseInt(hidmm.value) && parseInt(hidyyyy.value) <= curDate.getFullYear()){
            document.getElementById("btn-prev").style.display = "none";
        } else {
            document.getElementById("btn-prev").style.display = "block";
        }
    }

    var weekContent = document.getElementById("week");
    weekContent.innerHTML = null;
    drawCalendar(hidYear.value, hidmm.value, arr);
}

function fGetMonth(mm){
    var aMonth = [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December"
    ];

    return aMonth[mm];
}

/* SMALL CALENDAR */
function drawSmallCalendar(yyyy, mm){
    var curDate = new Date();

    var thisMonth;
    thisMonth = createCalendar(yyyy, mm);

    var weekContent = document.getElementById("sc-week");
    var cnt = 1;
    var dis = "";
    var cur, sel, now;

    for (var weeks = 1; weeks < 7; weeks++) {
        for (var days = 0; days < 7; days++) {
            cur = curDate.getFullYear() + '-' + (curDate.getMonth() + 1) + '-' + curDate.getDate();
            sel = yyyy + '-' + mm + '-' + thisMonth[weeks][days];
            now = cur == sel ? "now" : "";

            if (cnt % 7 == 1) {
                if (!isNaN(thisMonth[weeks][days])) {
                    if (curDate.getMonth() + 1 == mm && yyyy <= curDate.getFullYear()) {
                        dis = thisMonth[weeks][days] < curDate.getDate() ? "disabled" : "ena";
                    } else {
                        dis = "ena";
                    }
                    weekContent.innerHTML += '<div id="pd-' + thisMonth[weeks][days] + '" class="day ne w h first"><button class="' + dis + ' ' + now + '" onclick="pickDate(' + thisMonth[weeks][days] + ')" ' + dis + '>' + thisMonth[weeks][days] + '</button></div>';
                } else {
                    weekContent.innerHTML += '<div class="day w h first"></div>';
                }
            } else {
                if (!isNaN(thisMonth[weeks][days])) {
                    if (curDate.getMonth() + 1 == mm && yyyy <= curDate.getFullYear()) {
                        dis = thisMonth[weeks][days] < curDate.getDate() ? "disabled" : "ena";
                    } else {
                        dis = "ena";
                    }
                    weekContent.innerHTML += '<div id="pd-' + thisMonth[weeks][days] + '" class="day ne w h"><button class="' + dis + ' ' + now + '" onclick="pickDate(' + thisMonth[weeks][days] + ')" ' + dis + '>' + thisMonth[weeks][days] + '</button></div>';
                } else {
                    weekContent.innerHTML += '<div class="day w h"></div>';
                }
            }
            cnt++;
        }
    }
    weekContent.innerHTML += '<div style="clear: both; border-top: 1px solid #cecece; width: 280px;"></div>';
    
}

function scChangeMonth(val){
    var curDate = new Date();

    var hidmm = document.getElementById("sc-hidMonth");
    var hidyyyy = document.getElementById("sc-hidYear");

    var newMonth = parseInt(hidmm.value) + parseInt(val);
    newMonth = newMonth < 13 && newMonth > 0 ? newMonth : newMonth - 12;

    
    var newYear = parseInt(hidyyyy.value);
    if (val > 0) {
        if (parseInt(hidmm.value) == 12) {
            newYear = parseInt(hidyyyy.value) + 1;
        }
    } else if (val < 0) {
        if (parseInt(hidmm.value) == 1) {
            newYear = parseInt(hidyyyy.value) - 1;
        }
    }

    hidmm.value = Math.abs(newMonth);
    hidyyyy.value = newYear;

    document.getElementById("sc-disMonth").innerHTML = fGetMonth(hidmm.value - 1) + " " + hidYear.value;
    
    if (curDate.getMonth() + 1 == parseInt(hidmm.value) && parseInt(hidyyyy.value) <= curDate.getFullYear()){
        document.getElementById("sc-btn-prev").style.display = "none";
    } else {
        document.getElementById("sc-btn-prev").style.display = "block";
    }

    var weekContent = document.getElementById("sc-week");
    weekContent.innerHTML = null;
    drawSmallCalendar(hidYear.value, hidmm.value);

    var selectedDateDiv = document.getElementById("selected-date").value;
    var selectedDate = new Date(selectedDateDiv);

    /*console.log(selectedDate.getFullYear() + '-' + hidYear.value);
    console.log((selectedDate.getMonth() + 1) + '-' + hidmm.value);*/

    if (selectedDate.getFullYear() == hidYear.value && selectedDate.getMonth() + 1 == hidmm.value) {
        var lastSel = document.getElementById('sc-date-adj').value;
        document.getElementById('pd-' + lastSel).style.textDecoration = 'underline';
    }

    
}