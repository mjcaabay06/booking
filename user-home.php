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
                    <button onclick="changeMonth(-1, ['bookOpen', 'popupDiv'])" class="first" id="btn-prev"><i class="fa fa-chevron-left"></i></button>
                    
                    <label id="disMonth"></label>

                    <button onclick="changeMonth(1, ['bookOpen', 'popupDiv'])" class="last" id="btn-next"><i class="fa fa-chevron-right"></i></button>

                    <div style="clear: both"></div>
                    <!--<select id="selMonth" onchange="updateCalendar()"></select>
                    <select id="selYear" onchange="updateCalendar()"></select>-->
                </div>

                <input type="hidden" id="hidMonth" value="">
                <input type="hidden" id="hidYear" value="">

                <div class="days" id="days">
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

            <div class="right">
                <div class="head">Your reservation history.</div>
                <div id="history-content">
                    <div class="his-list">
                        <div class="top">
                            <label>Jan 15, 2016</label>
                            <span>Approved</span>
                        </div>
                        <div class="bottom">
                            this is remark
                        </div>
                    </div>
                </div>
            </div>

            <div style="clear: both"></div>
        </div>

        <!-- POPUP DIV -->
        <div id="popupDiv" class="ontop">
            <h1 style="text-align: center; padding: 0 0 10px; margin: 0; border-bottom: 1px solid #cecece">Reservation Form</h1>
            <!-- <form action="" id="bookingForm">
                <input type="text" id="hidPopDate" />
            </form> -->
            <label id="lbl-status"></label>

            <input type="hidden" id="hidPopDate" />
            <input type="hidden" id="hidPopUserId" value="3" />

            <textarea id="tb-remarks" placeholder="Remarks" class="ta"></textarea>
            <div align="center">
                <button onclick="fBooking()" class="in-btn">Save</button>
                <button onclick="fhide('popupDiv')" class="in-btn">Cancel</button>    
            </div>
        </div>

        <!-- POPUP DIV ADJUST -->
        <div id="popupDivAdj" class="ontop">
            <h1 style="text-align: center; padding: 0 0 10px; margin: 0 0 20px; border-bottom: 1px solid #cecece">Adjustment Form</h1>
            <!-- <form action="" id="bookingForm">
                <input type="text" id="hidPopDate" />
            </form> -->
            <div class="s-calendar-content">
                <div class="left">
                    <div class="head">
                        <input type="hidden" id="sc-hidMonth">
                        <input type="hidden" id="sc-hidYear">
                        <input type="hidden" id="hidPopResId-adj" />
                        <input type="hidden" id="sc-date-adj" />
                        <input type="hidden" id="selected-date" />
                        <input type="hidden" id="prev-date" />

                        <button onclick="scChangeMonth(-1)" class="l" id="sc-btn-prev"><i class="fa fa-chevron-left"></i></button>
                        <label id="sc-disMonth"></label>
                        <button onclick="scChangeMonth(1)" class="r" id="sc-btn-next"><i class="fa fa-chevron-right"></i></button>
                        <div style="clear: both"></div>
                    </div>
                    <div class="days">
                        <div class="iday w first">Su</div>
                        <div class="iday w first">Mo</div>
                        <div class="iday w first">Tu</div>
                        <div class="iday w first">We</div>
                        <div class="iday w first">Th</div>
                        <div class="iday w first">Fr</div>
                        <div class="iday w first">Sa</div>
                        <div style="clear: both"></div>
                    </div>

                    <div class="weeks" id="sc-week">
                    </div>
                </div>
                <div class="right">
                    <label id="lbl-status-adj" style="font-weight: normal"></label>
                    <textarea id="tb-remarks-adj" placeholder="Remarks" class="ta"></textarea>
                    <div align="center">
                        <button onclick="fBookingAdj()" class="in-btn">Save</button>
                        <button onclick="fhide('popupDivAdj')" class="in-btn">Cancel</button>    
                    </div>
                    
                </div>
                <div style="clear: both"></div>
            </div>
        </div>
        <div id="fade" class="black_overlay"></div>


        <!--<script src="js/jquery-1.12.0.js"></script>
        <script src="js/jquery-1.12.0.min.js"></script>-->
        <script src="js/myCalendar.js"></script>
        <script src="js/myJs.js"></script>
        <script type="text/javascript">
            firstLoad(['bookOpen', 'popupDiv']);
            fFetchReservation(sessionStorage.userId);
        </script>
        </script>
    </body>
</html>