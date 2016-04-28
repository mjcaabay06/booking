<?php
    include "resources/check-page.php";
    include "resources/ajax/insert-logs.php";
?>
<!DOCTYPE html>
<html>
    <head>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/main.css"></link>
        <link rel="stylesheet" type="text/css" href="css/style.css">

        <script type="text/javascript">
            sessionStorage.userId = <?php echo $_SESSION['userId'] ?>;
            // PICK DATE
            function pickDate(day){
                var lastSel = document.getElementById('sc-date-adj').value;
                document.getElementById('pd-' + lastSel).style.textDecoration = 'none';
                document.getElementById('pd-' + day).style.textDecoration = 'underline';
                document.getElementById('sc-date-adj').value = day;

                var mm = document.getElementById("sc-hidMonth").value;
                var yyyy = document.getElementById("sc-hidYear").value;

                var iMM = mm < 10 ? "0" + mm : mm;
                var iDD = day < 10 ? "0" + day : day;

                document.getElementById("selected-date").value = yyyy + '-' + iMM + '-' + iDD;

                var data = new Object();
                data.date = yyyy + '-' + mm + '-' + day;

                ajaxLoad(data, "resources/ajax/fetch-limit.php", function(req){
                    console.log(req);
                    document.getElementById("lbl-limit").innerHTML = req.limit;
                });
            }
        </script>
    </head>
    <body>
        <div class="header-div">
            Welcome <span><?php echo $_SESSION['name'] ?></span> !
            <a href="logout.php" style="float: right;"><i style="margin-right: 7px;" class="fa fa-sign-out"></i>Logout</a>
        </div>

        <div class="calendar-content" id="calendar-content">
            <div class="left">
                <div class="selector">
                    <button onclick="changeMonth(-1, ['bookOpen', 'admin-popupDiv'])" class="first" id="btn-prev"><i class="fa fa-chevron-left"></i></button>
                    
                    <label id="disMonth"></label>

                    <button onclick="changeMonth(1, ['bookOpen', 'admin-popupDiv'])" class="last" id="btn-next"><i class="fa fa-chevron-right"></i></button>

                    <div style="clear: both"></div>
                    <!--<select id="selMonth" onchange="updateCalendar()"></select>
                    <select id="selYear" onchange="updateCalendar()"></select>-->
                </div>

                <input type="hidden" id="hidMonth" value="">
                <input type="hidden" id="hidYear" value="">

                <div class="days" id="days" style="">
                    <div class="iday w first">SUN</div>
                    <div class="iday w first">MON</div>
                    <div class="iday w first">TUE</div>
                    <div class="iday w first">WED</div>
                    <div class="iday w first">THU</div>
                    <div class="iday w first">FRI</div>
                    <div class="iday w first">SAT</div>
                    <div style="clear: both"></div>
                </div>
                <div class="week" id="week">
                </div>
            </div>

            <div class="right" style="width: 17%">
                <div class="head">Set Entry Limit</div>
                <div class="s-calendar-content" style="margin: 0 5px">

                    <div class="head" style="border:0;">
                        <input type="hidden" id="sc-hidMonth">
                        <input type="hidden" id="sc-hidYear">
                        <input type="hidden" id="hidPopResId-adj" />
                        <input type="hidden" id="sc-date-adj" />
                        <input type="hidden" id="selected-date" />

                        <button onclick="scChangeMonth(-1)" class="l" id="sc-btn-prev"><i class="fa fa-chevron-left"></i></button>
                        <label id="sc-disMonth"></label>
                        <button onclick="scChangeMonth(1)" class="r" id="sc-btn-next"><i class="fa fa-chevron-right"></i></button>
                        <div style="clear: both"></div>
                    </div>

                    <div class="days" style="margin-left: 8px;">
                        <div class="iday w first">Su</div>
                        <div class="iday w first">Mo</div>
                        <div class="iday w first">Tu</div>
                        <div class="iday w first">We</div>
                        <div class="iday w first">Th</div>
                        <div class="iday w first">Fr</div>
                        <div class="iday w first">Sa</div>
                        <div style="clear: both"></div>
                    </div>

                    <div class="weeks" id="sc-week" style="margin-left: 8px;">
                    </div>

                    <div style="clear: both"></div>

                    <div>
                        <div id="limit-div" style="margin-top: 20px">
                            Limit: <label id="lbl-limit"></label>
                            <button onclick="fUpLimit()" class="in-btn" style="float: right; margin-top: -8px">Update Limit</button>
                        </div>

                        <div style="display: none; clear: both; margin-top: 20px" id="up-limit-div">
                            Limit: <!--<input type="text" id="tb-limit" /> <br/>-->
                            <select id="selLimit">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                            <div style="margin-top: 10px;">
                                <button onclick="fSetLimit()" class="in-btn">Save</button>
                                <button onclick="fCLimit()" class="in-btn">Cancel</button>    
                            </div>
                        </div>

                        <!-- <textarea id="tb-remarks-adj" placeholder="Remarks"></textarea>
                        <button onclick="fBookingAdj()">Submit</button>
                        <button onclick="fhide('popupDivAdj')">Cancel</button> -->
                    </div>
                    <div style="clear: both"></div>
                </div>
            </div>
            <div style="clear: both"></div>
        </div>

        <!-- POPUP DIV -->
        <div id="admin-popupDiv" class="ontop">
            <!-- <form action="" id="bookingForm">
                <input type="text" id="hidPopDate" />
            </form> -->
            <button onclick="fhide('admin-popupDiv')" class="in-btn" style="position: absolute; right: 19px;">Close</button>
            <h1 style="text-align: center; padding: 0 0 10px; margin: 0; border-bottom: 1px solid #cecece">List of Reservation</h1>

            <div id="reservation-list" class="admin-reserve-list">
            </div>

            <label id="lbl-status"></label>

            <input type="hidden" id="hidPopDate" />
            <input type="hidden" id="hidPopUserId" value="3" />
            <textarea id="tb-remarks" placeholder="Remarks" class="ta" style="display: none"></textarea>

            <!-- <button onclick="fBooking()">Submit</button> -->
        </div>

        <div id="fade" class="black_overlay"></div>


        <!--<script src="js/jquery-1.12.0.js"></script>
        <script src="js/jquery-1.12.0.min.js"></script>-->
        <script src="js/myCalendar.js"></script>
        <script src="js/myJs.js"></script>
        <script type="text/javascript">
            firstLoad(['bookOpen', 'admin-popupDiv']);

            document.getElementById("sc-btn-prev").style.display = "none";
            document.getElementById("sc-hidMonth").value = curDate.getMonth() + 1;
            document.getElementById("sc-hidYear").value = curDate.getFullYear();

            var weekContent = document.getElementById("sc-week");
            weekContent.innerHTML = null;
            document.getElementById("sc-disMonth").innerHTML = fGetMonth(curDate.getMonth()) + " " + curDate.getFullYear();
            document.getElementById("sc-date-adj").value = curDate.getDate();
            drawSmallCalendar(curDate.getFullYear(), curDate.getMonth() + 1);
            pickDate(curDate.getDate());
        </script>
        </script>
    </body>
</html>