var curDate = new Date();
//firstLoad();

function firstLoad(arr){
    //setMonth(curDate.getMonth() + 1);
    //setYear(curDate.getFullYear());
    if (arr[1] != 'admin-popupDiv') {
		document.getElementById("btn-prev").style.display = "none";
    }
    

    document.getElementById("hidMonth").value = curDate.getMonth() + 1;
    document.getElementById("hidYear").value = curDate.getFullYear();
    
    document.getElementById("disMonth").innerHTML = fGetMonth(curDate.getMonth()) + " " + curDate.getFullYear();
    drawCalendar(curDate.getFullYear(), curDate.getMonth() + 1, arr);
    //drawCalendar(2016, 2);
}

function bookOpen(val, div){
	var yyyy = document.getElementById("hidYear").value;
	var mm = document.getElementById("hidMonth").value;
	var dd = val;
	if (div == 'admin-popupDiv') {
		var adiv = document.getElementById('reservation-list');
		adiv.innerHTML = null;

		fetchReservationByDate(yyyy + '-' + mm + '-' + dd);
	}
	fResetPopUser();
    document.getElementById('hidPopDate').value = val;
    fpop(div);
}

function fBooking(){
	var yyyy = document.getElementById("hidYear").value;
	var mm = document.getElementById("hidMonth").value;
	var dd = document.getElementById("hidPopDate").value;

	var data = new Object();
	data.reserveDate = yyyy + "-" + mm + "-" + dd;
	data.userId = document.getElementById("hidPopUserId").value;
	data.remarks = document.getElementById("tb-remarks").value;

	ajaxLoad(data, "resources/ajax/insert-booking.php", function(req){
		document.getElementById("lbl-status").innerHTML = req.message;
		if (req.status == 'success') {
			fFetchReservation(sessionStorage.userId);
			fhide('popupDiv');
		}
	});
	//document.getElementById('bookingForm').submit();
}

function adjOpen(resId, remarks, reserveDate){
	document.getElementById('hidPopResId-adj').value = resId;
	document.getElementById('tb-remarks-adj').value = remarks;

	//var lastSel = document.getElementById('sc-date-adj').value;
    //document.getElementById('pd-' + lastSel).style.textDecoration = 'none';
    var d = new Date(reserveDate);

    if ((curDate.getMonth() + 1) == (d.getMonth() + 1)) {
    	document.getElementById("sc-btn-prev").style.display = "none";
    }
	/*document.getElementById("sc-btn-prev").style.display = "none";*/
    document.getElementById("sc-hidMonth").value = d.getMonth() + 1;
    document.getElementById("sc-hidYear").value = d.getFullYear();
    document.getElementById("sc-date-adj").value = d.getDate();
    document.getElementById("sc-disMonth").innerHTML = fGetMonth(d.getMonth()) + " " + d.getFullYear();
    
	var weekContent = document.getElementById("sc-week");
    weekContent.innerHTML = null;
	drawSmallCalendar(d.getFullYear(), d.getMonth() + 1);

	var iMM = (d.getMonth() + 1) < 10 ? "0" + (d.getMonth() + 1) : (d.getMonth() + 1);
	var iDD = d.getDate() < 10 ? "0" + d.getDate() : d.getDate();

	document.getElementById("selected-date").value = d.getFullYear() + '-' + iMM + '-' + iDD;
	document.getElementById("prev-date").value = d.getFullYear() + '-' + iMM + '-' + iDD;
	document.getElementById('pd-' + d.getDate()).style.textDecoration = 'underline';

	fpop('popupDivAdj');
}

function fBookingAdj(){
	var mm = document.getElementById("sc-hidMonth").value;
	var yyyy = document.getElementById("sc-hidYear").value;
	var dd = document.getElementById("sc-date-adj").value;

	mm = mm < 10 ? "0" + mm : mm;
	dd = dd < 10 ? "0" + dd : dd;

	var data = new Object();
	data.reserveDate = yyyy + '-' + mm + '-' + dd;
	data.resId = document.getElementById("hidPopResId-adj").value;
	data.remarks = document.getElementById("tb-remarks-adj").value;
	data.prevDate = document.getElementById("prev-date").value;
	data.userId = sessionStorage.userId;

	ajaxLoad(data, "resources/ajax/adjust-booking.php", function(req){
		document.getElementById("lbl-status-adj").innerHTML = req.message;
		fFetchReservation(sessionStorage.userId);
		fhide('popupDivAdj');
	});
}

//FETCH RESERVATION HISTORY
function fFetchReservation(userId){
	var historyCon = document.getElementById('history-content');
	historyCon.innerHTML = "";

	var data = new Object();
	data.userId = userId;

	ajaxLoad(data, "resources/ajax/fetch-history.php", function(req){
		console.log(req);

		var div = '';
		for (prod in req.reservations) {
			div += '<a href="#" onclick="adjOpen(' + req.reservations[prod].reservation_id + ', \'' + req.reservations[prod].remarks + '\', \'' + req.reservations[prod].reserve_date + '\')"><div class="his-list"><div class="top">'
				+ '<label>' + req.reservations[prod].reserve_date + '</label>'
				+ '<span>Approved</span>'
				+ '</div><div class="bottom">' + req.reservations[prod].remarks + '</div></div></a>';
		}
		historyCon.innerHTML = div;
	});
}

/*POPUP DIV*/
function fpop(div) {
    document.getElementById(div).style.display = 'block';
    document.getElementById('fade').style.display='block';
}
function fhide(div) {
    document.getElementById(div).style.display = 'none';
    document.getElementById('fade').style.display='none';
}

var ajax = {
	load : function(data, url, callback){
		var req = new XMLHttpRequest();
		req.onreadystatechange = function(){
			if (req.readyState == 4 && req.status == 200) {
				var request = JSON.parse(req.response);
				callback(request);
			}
		};

		req.open("POST", url, true);
		req.send(JSON.stringify(data));
	}
};

function ajaxLoad(data, url, callback) {
	//a
	var req = new XMLHttpRequest();
	req.onreadystatechange = function(){
		if (req.readyState == 4 && req.status == 200) {
			console.log(req.response);
			var request = JSON.parse(req.response);
			callback(request);
		}
	};

	req.open("POST", url, true);
	req.send(JSON.stringify(data));
}

/* ADMIN */
function fetchReservationByDate(pdate) {
	var data = new Object();
	data.reserveDate = pdate;

	ajaxLoad(data, "resources/ajax/fetch-reservations.php", function(req){
		console.log(req);
		var div = document.getElementById('reservation-list');

		var list = '<table><tr style="font-weight: bold"><td>Name</td><td>Remark</td></tr>';
		for (prod in req.reservations) {
			list += '<tr><td>' + req.reservations[prod].fname + ' ' + req.reservations[prod].lname + '</td><td>' + req.reservations[prod].remarks + '</td></tr>';
		}
		list += '</table>';
		div.innerHTML = list;
	});
}

function fUpLimit(){
	/*var limit = document.getElementById('lbl-limit').innerHTML;
	limit = limit == 'Unlimited' ? null : limit;
	document.getElementById('tb-limit').value = limit;*/
	var limit = document.getElementById('lbl-limit').innerHTML;
	document.getElementById('selLimit').value = parseInt(limit);

	document.getElementById('limit-div').style.display = 'none';
	document.getElementById('up-limit-div').style.display = 'block';
}

function fCLimit(){
	document.getElementById('limit-div').style.display = 'block';
	document.getElementById('up-limit-div').style.display = 'none';
}

function fSetLimit() {
    var mm = document.getElementById("sc-hidMonth").value;
	var yyyy = document.getElementById("sc-hidYear").value;
	var dd = document.getElementById("sc-date-adj").value;
	var lim = document.getElementById("selLimit").value;

	var data = new Object();
	data.date = yyyy + '-' + mm + '-' + dd;
	data.limit = lim;

	ajaxLoad(data, "resources/ajax/setlimit-booking.php", function(req){
		console.log(req);
		if (req.status == 'success') {
			document.getElementById('lbl-limit').innerHTML = req.limit;
			fCLimit();
		}
	});
}

function fResetPopUser(){
	document.getElementById("lbl-status").value = null;
	document.getElementById("tb-remarks").innerHTML = null;
}