<?php
    
    // if(isset($_SERVER['HTTP_REFERER']) && str_contains($_SERVER['HTTP_REFERER'], HOST_URL)) {
    if(true) {
        // echo $_SERVER['HTTP_REFERER'];
        // echo "<br>";

        echo (json_encode($_POST));        
        
        $oneWay   = $selectedFlight['oneWay'];
        $flights  = $selectedFlight['legs']['leg'];
?>
<div id="main">
    <div class="container">
        <div class="row py-3">
            <div class="col-12 text-end">
                <button class="btn btn-danger px-4 btn-theme shadow text-light" onclick="history.back()"><i class="bi bi-arrow-left me-2"></i>Back</button>
            </div>
        </div>
        <div class="row pb-3">
            
            <div class="col-12 mb-3">
                <div class="card shadow">
                    <div class="card-header">Complete your Booking</div>
                    <div class="card-body py-3">
                        <div id="booking-details">
                            <?php 
                                $obArrivalDate = null;
                                $ibDepartureDate = null;
                                foreach($flights as $key=>$flight){
                                    $segments       = $flight['segments']['segment'];
                                    $stops          = count($segments)-1;
                                    $direction      = strtolower($flight['direction']);
                                    $initials       = $key==0? 'ob':'ib';

                                    $depSeg = $flight['segments']['segment'][0];
                                    $arvSeg = $flight['segments']['segment'][$stops];

                                    $directionIcon = '<i class="fa-solid fa-plane-departure me-2"></i>';
                                    
                                    if($key==0){
                                        $obArrivalDate = $arvSeg['strArrivalDateTime'];
                                    }
                                    if($key==1){
                                        $directionIcon = '<i class="fa-solid fa-plane-arrival me-2"></i>';
                                        echo "<div class='my-3' style='position:relative;height:1px; border: 1px dashed #9f79e4'><span style='position:absolute;top:50%;left:50%;transform:translate(-50%, -50%);padding: 0 10px;background: #fff;'>" . $timeClass->getAirTimeDiff($obArrivalDate, $depSeg['strArrivalDateTime']) . "</span></div>";
                                    }
                            ?>
                            <div class="accordion" id="<?php echo $initials; ?>FlightSummary">
                                <div class="accordion-item border-0">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed p-2 px-md-3 pt-md-3 bg-white" type="button" data-bs-toggle="collapse" data-bs-target="#<?php echo $initials; ?>FlightDetails" aria-expanded="false" aria-controls="<?php echo $initials; ?>FlightDetails">
                                            <div class="d-flex w-100 me-3">
                                                <?php 
                                                    if($screen['width']<768){
                                                        echo '<div class="me-3"><img loading="lazy" width="40" height="40" src="/assets/images/airline/' . strtolower($depSeg['carrier']) . '.jpg" alt="'. $depSeg['carrierName'] . '"></div>';
                                                    } else{
                                                        echo '<div><img loading="lazy" width="108" height="42" src="/assets/images/airline/logo/' . strtolower($depSeg['carrier']) . '.jpg" alt="'. $depSeg['carrierName'] . '"></div>';
                                                    }
                                                ?>

                                                <div class="me-auto w-100 d-flex center justify-content-around text-muted">
                                                    <div class="text-start">
                                                        <div class="strong text-primary"><?php echo date('H:i', strtotime($depSeg['strDeparatureDateTime'])); ?></div>
                                                        <small><?php echo $depSeg['deparatureAirportCode']; ?></small>
                                                    </div>
                                                    <div class="path-line mx-3">
                                                        <div class="flight-time"><?php echo $timeClass->flightDuration($depSeg['flightDuration']); ?></div>
                                                    </div>
                                                    <div class="text-end">
                                                        <div class="strong text-primary"><?php echo date('H:i', strtotime($arvSeg['strArrivalDateTime'])); ?></div>
                                                        <small><?php echo $arvSeg['destinationAirportCode']; ?></small>
                                                    </div>
                                                </div>
                                            </div>
                                        </button>
                                    </h2>
                                    <div id="<?php echo $initials; ?>FlightDetails" class="accordion-collapse collapse" data-bs-parent="#<?php echo $initials; ?>FlightSummary">
                                        <div class="accordion-body small">
                                            
                                            <div class="card pt-4 mt-3">
                                                <span class="ribbon shimmer">
                                                    <?php echo $directionIcon; echo ucfirst($direction) ?>
                                                </span>
                                                <?php
                                                    foreach($segments as $segKey=>$seg){
                                                        if($segKey>0){
                                                            echo '<div class="my-3 px-3 py-2" style="background: #f5f5dc">Stopover at ' . $seg['departureAirportName'] . ', for '. $timeClass->getAirTimeDiff($segments[$segKey-1]['strArrivalDateTime'], $seg['strDeparatureDateTime']) . '</div>';
                                                        }
                                                ?>
                                                <div class="p-3">
                                                <div class="d-flex align-items-center mb-3">
                                                    <img loading="lazy" class="img-thumbnail" width="45" height="45" src="/assets/images/airline/<?php echo strtolower($seg['carrier']) ?>.jpg" alt="<?php echo strtolower($seg['carrierName']) ?>">
                                                    <div class="ms-2">
                                                        <strong>(<?php echo $cabinClass ?>) | <?php echo $seg['carrier'] ?> - <?php echo $seg['flightNumber'] ?></strong>
                                                        <div class="text-muted">Equipment - <?php echo $seg['equipment'] ?></div>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <div class="fw-bold text-center">
                                                        <div><?php echo $cityData[$seg['deparatureAirportCode']] ?></div>
                                                        <div class="fw-normal">(India)</div>
                                                        <div class="my-2 fs-5 text-primary"><?php echo date('H:i', strtotime(explode(".", $seg['strDeparatureDateTime'])[0])) ?></div>
                                                        <div class="text-muted"><?php echo date('M d, Y', strtotime(explode(".", $seg['strDeparatureDateTime'])[0])) ?></div>
                                                    </div>
                                                    <div class="text-center p-3">
                                                        <div class="fw-bold"><?php echo $timeClass->flightTime($seg['flightTime']) ?></div>
                                                        <div class="text-muted">Duration</div>
                                                        <div style="width: 100%;height: 1px;border: 1px dashed #ccc;position: relative;margin-top: 10px;"><i class="fa-solid fa-plane text-muted" style="position: absolute;transform: translate(10px, -50%);top: calc(50% + .5px);right: 0%;"></i></div>
                                                    </div>
                                                    <div class="fw-bold text-center">
                                                        <div><?php echo $cityData[$seg['destinationAirportCode']] ?></div>
                                                        <div class="fw-normal">(Netherlands)</div>
                                                        <div class="my-2 fs-5 text-primary"><?php echo date('H:i', strtotime(explode(".", $seg['strArrivalDateTime'])[0])) ?></div>
                                                        <div class="text-muted"><?php echo date('M d, Y', strtotime(explode(".", $seg['strArrivalDateTime'])[0])) ?></div>
                                                    </div>
                                                </div>
                                                </div>
                                                <?php
                                                    }
                                                ?>
                                                <div class="p-3">
                                                    <div class="info-badge d-flex justify-content-between"><span><i class="fa-solid fa-suitcase-rolling"></i> Checked Bag</span> <strong>Free Checked Bag Upto 25Kg</strong></div>
                                                    <div class="info-badge d-flex justify-content-between"><span><i class="fa-solid fa-suitcase"></i> Carry On</span> <strong>Hand baggage included</strong></div>
                                                    <div class="info-badge d-flex justify-content-between"><span><i class="fa-solid fa-person-seat-reclined"></i>  Seat Selection</span> <strong>Seat reservation at check-in</strong></div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                                }
                            ?>



                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 mb-3">
                <div class="card shadow">
                    <div class="card-header">Passengers</div>
                    <div class="card-body py-3">
                        <?php
                            $paxCounter = 0;
                            $paxTypeCode = array("ADT","YTH","CHD","INF");
                            foreach (array('adults','youth','childs','infants') as $key=>$value) {
                                $count = $searchRequest[$value];
                                for ($i=0;$i<$count;$i++) {
                                    $paxCounter++;
                        ?>
                            <form action="" method="POST" id="pax_info_<?php echo $value ."_".$paxCounter; ?>" class="bk_form needs-validation" novalidate>
                                <div class="row">
                                    <input type="hidden" name="paxType" value="<?php echo $paxTypeCode[$key]; ?>">
                                    <div class="col-md-2 col-12 my-2">
                                        <div class="form-floating">
                                            <select name="title" id="title_<?php echo $paxCounter; ?>" class="form-select" placeholder="Select Title" required>
                                                <option value="Mr" <?php echo isset($paxes) && $paxes[$paxCounter-1]['title'] == 'Mr' ? 'selected' : '' ?>>Mr</option>
                                                <option value="Ms" <?php echo isset($paxes) && $paxes[$paxCounter-1]['title'] == 'Ms' ? 'selected' : '' ?>>Ms</option>
                                                <option value="Miss" <?php echo isset($paxes) && $paxes[$paxCounter-1]['title'] == 'Miss' ? 'selected' : '' ?>>Miss</option>
                                                <option value="Mrs" <?php echo isset($paxes) && $paxes[$paxCounter-1]['title'] == 'Mrs' ? 'selected' : '' ?>>Mrs</option>
                                                <option value="Dr" <?php echo isset($paxes) && $paxes[$paxCounter-1]['title'] == 'Dr' ? 'selected' : '' ?>>Dr</option>
                                            </select>
                                            <label for="title_<?php echo $paxCounter; ?>">Title:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-4 my-2 pe-0">
                                        <div class="form-floating">
                                            <input type="text" class="form-control rounded-0 rounded-start" id="fname_<?php echo $paxCounter; ?>" name="firstName" value="<?php echo isset($paxes) ? $paxes[$paxCounter-1]['firstName'] : null; ?>" titlecase placeholder="First Name" required>
                                            <label for="fname_<?php echo $paxCounter; ?>">First name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-4 my-2 px-0">
                                        <div class="form-floating">
                                            <input type="text" class="form-control rounded-0 border-start-0" id="mname_<?php echo $paxCounter; ?>" name="middleName" value="<?php echo isset($paxes) ? $paxes[$paxCounter-1]['middleName'] : null; ?>" titlecase placeholder="Middle Name">
                                            <label for="mname_<?php echo $paxCounter; ?>">Middle name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-4 my-2 ps-0">
                                        <div class="form-floating">
                                            <input type="text" class="form-control rounded-0 rounded-end border-start-0" id="lname_<?php echo $paxCounter; ?>" name="lastName" value="<?php echo isset($paxes) ? $paxes[$paxCounter-1]['lastName'] : null; ?>" titlecase placeholder="Last Name" required>
                                            <label for="lname_<?php echo $paxCounter; ?>">Last name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-6 my-2">
                                        <div class="form-floating">
                                            <select name="gender" id="gender_<?php echo $paxCounter; ?>" class="form-select" placeholder="Gender" required>
                                                <option value="M" <?php echo isset($paxes) && $paxes[$paxCounter-1]['gender'] == 'M' ? 'selected' : '' ?>>Male</option>
                                                <option value="F" <?php echo isset($paxes) && $paxes[$paxCounter-1]['gender'] == 'F' ? 'selected' : '' ?>>Female</option>
                                            </select>
                                            <label for="gender_<?php echo $paxCounter; ?>">Gender:</label>
                                        </div>
                                    </div>
                                    <div class="col-md-2 col-6 my-2">
                                        <div class="form-floating">
                                            <input type="text" class="form-control dob" maxlength="10" max="<?php echo date('Y-m-d') ?>" id="dob_<?php echo $paxCounter; ?>" name="dob" value="<?php echo isset($paxes) ? $paxes[$paxCounter-1]['dob'] : null; ?>" titlecase placeholder="DOB" required>
                                            <label for="dob_<?php echo $paxCounter; ?>">DD-MM-YYYY</label>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        <?php
                                }
                            }
                        ?>
                    </div>
                    
                </div>
            </div>
            
            <div class="col-12 mb-3">
                <div class="card shadow">
                    <div class="card-header">
                        Click here for additional information
                    </div>
                    <div class="card-body">
                        <form class="row needs-validation pt-3" action="" method="post" novalidate>
                            <div class="col-12 col-lg-6 mb-3">
                                <label for="" class="form-label">Seat preference (optional)</label>
                                <select class="form-select">
                                    <option>No Preference</option>
                                    <option>Window</option>
                                    <option>Aisle</option>
                                </select>
                            </div>
                            <div class="col-12 col-lg-6 mb-3">
                                <label for="" class="form-label">Meal preference (optional)</label>
                                <select class="form-select">
                                    <option>No Preference</option>
                                    <option>Vegetarian</option>
                                    <option>Non-Vegetarian</option>
                                    <option>Vegan</option>
                                </select>
                            </div>
                            <div class="col-12 col-lg-6 mb-3">
                                <label for="" class="form-label">Frequent flyer programme (optional)</label>
                                <select class="form-select">
                                    <option>-- Select Frequent Flyer Type --</option>
                                    <option>Airline 1</option>
                                    <option>Airline 2</option>
                                </select>
                            </div>
                            <div class="col-12 col-lg-6 mb-3">
                                <label for="" class="form-label">Frequent flyer number (optional)</label>
                                <input type="text" class="form-control" placeholder="Enter Frequent Flyer Number">
                            </div>
                            <div class="col-12 col-lg-6 mb-3">
                                <label for="" class="form-label">Assistance (optional)</label>
                                <select class="form-select">
                                    <option>No Preference</option>
                                    <option>Wheelchair Assistance</option>
                                    <option>Medical Assistance</option>
                                </select>
                            </div>
                            <div class="info-text">
                                * Please note that with regards to assistance, seating, meals, and frequent flyer type, the above are only requests to the airlines. We cannot guarantee that your requests will be honoured and recommend that you confirm with the airline before departure.
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-12 mb-3">
                <div class="accordion shadow" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button dark" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Choose Your Service Pack
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="p-3">
                                    <ul>
                                        <li>Test</li>
                                        <li>Test</li>
                                    </ul>
                                    <div class="d-flex align-items-center justify-content-between mt-5">
                                        <div class="fw-bold">&pound;9.28</div>
                                        <button class="btn btn-warning px-5">Add</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button dark collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Flexible Ticket Plans - Full Refund
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="p-3">
                                    <ul>
                                        <li>Test</li>
                                        <li>Test</li>
                                    </ul>
                                    <div class="d-flex align-items-center justify-content-between mt-5">
                                        <div class="fw-bold">&pound;9.28</div>
                                        <button class="btn btn-warning px-5">Add</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button dark collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Web Check-In Assistance
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="p-3">
                                    <ul>
                                        <li>Test</li>
                                        <li>Test</li>
                                    </ul>
                                    <div class="d-flex align-items-center justify-content-between mt-5">
                                        <div class="fw-bold">&pound;9.28</div>
                                        <button class="btn btn-warning px-5">Add</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button dark collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                Airline Failure Protection
                            </button>
                        </h2>
                        <div id="collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="p-3">
                                    <ul>
                                        <li>Test</li>
                                        <li>Test</li>
                                    </ul>
                                    <div class="d-flex align-items-center justify-content-between mt-5">
                                        <div class="fw-bold">&pound;9.28</div>
                                        <button class="btn btn-warning px-5">Add</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


    <form id="extrasForm" style="display: none;">
        <input type="hidden" id="selectedService" name="selectedService" value="">
        <input type="hidden" id="selectedPrice" name="selectedPrice" value="">
        <input type="hidden" id="atolProtection" name="atolProtection" value="ATOL Protection">
    </form>


            <div class="col-12 mb-3">
                <div class="card shadow">
                    <div class="card-header">
                        Proceed With Booking
                    </div>
                    <div class="card-body text-center">
                        <h5 class="card-title">Total: <span>&pound; 910.28</span></h5>
                        <a href="#" class="btn btn-warning my-3 cs1 <?php echo $screen['width']<576? 'w-100':'w-50'?>">CONTINUE</a>
                        <p>This price includes flight taxes & fule supplements</p>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<?php
    } else {
?>
<div id="main">
    <div class="container">
        <div class="row py-3">
            <div class="col-12">
                <h2 class="pb-5">Unauthorize Access</h2>
                <button class="btn btn-danger btn-theme shadow d-flex align-items-center" onclick="history.back()"><i class="bi bi-arrow-left"></i> Go To Results</button>
            </div>
        </div>
    </div>
</div>
<?php
    }
?>

<style>.error{color:red;border-color:#E91E63;}.valid{color:green;border-color: #8BC34A;}</style>
<script src="https://cdn.jsdelivr.net/npm/jquery.redirect@1.2.0/jquery.redirect.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js"></script>
<script>
    $(".dob").keydown(function(){
    $(this).val($(this).val().replace(/^(\d\d)(\d)$/g,"$1-$2").replace(/^(\d\d\-\d\d)(\d+)$/g,"$1-$2").replace(/[^\d\-]/g,''));
})


    $(document).ready(function(){
    console.log("DOM Ready");

    $('.cs1').click(function(e){
        e.preventDefault();  

        const forms = $('form');
        let contact = {};
        let paxes = [];
        
        var isFormValid = true;

        $('form.bk_form').each(function(formIndex, form) {
    
            if (!$(form).valid()) {
                isFormValid = false;
            }

            var values = {};
            $.each($(this).serializeArray(), function(i, field) {
                values[field.name] = field.value;
            });

            if ($(form).prop("id").includes("pax_info_")) {
                paxes.push(values);
            } else if ($(form).prop("id").includes("prefereces")) {
                contact['preferences'] = values;  
            } else if ($(form).prop("id").includes("extras")) {
                contact['extras'] = values;  
            }
        });

        if (isFormValid) {
            // Ensure contact['other'] exists before assigning host
            // contact['preferences'] = contact['preferences'] || {};  
            contact.host = location.host;
            
            contact['paxes'] = paxes;

            console.log("Redirecting with data:", contact);
            var redirectUri = window.location.href.slice(0,-1) + '3';
            console.log(contact)
            $.redirect(redirectUri, contact);

        }
    });
});

</script>
<style>
div.sticky {
  position: sticky;
  top: 70px;
}
.bg-light-pink{background-color: #fff9fc}
.trv-form select, .trv-form select option, .trv-form input{border-radius: 0px;outline: none !important}
.form-control:focus, .form-select:focus{box-shadow: unset}
.shine{background:#f6f7f8;background-image:-webkit-gradient(linear, left top, right top, from(#f6f7f8), color-stop(20%, #edeef1), color-stop(40%, #f6f7f8), to(#f6f7f8));background-image:linear-gradient(to right, #f6f7f8 0%, #edeef1 20%, #f6f7f8 40%, #f6f7f8 100%);background-repeat:no-repeat;background-size:800px 104px;display:inline-block;position:relative;-webkit-animation-duration:1s;-webkit-animation-fill-mode:forwards;-webkit-animation-iteration-count:infinite;-webkit-animation-name:placeholderShimmer;-webkit-animation-timing-function:linear}box{height:104px;width:100px}.sWrap{display:-webkit-inline-box;display:-ms-inline-flexbox;display:inline-flex;-webkit-box-orient:vertical;-webkit-box-direction:normal;-ms-flex-direction:column;flex-direction:column;margin-left:25px;margin-top:0;vertical-align:top}lines{height:10px;margin-bottom:10px;width:100%;min-width:320px}photo{display:block !important;width:100%;min-width:320px;height:100px;margin-bottom:15px}
/* .dark{
    background: var(--default-color) !important;
    color: #ffffff !important;
}
.accordion-button.dark:focus:not(.collapsed){color: var(--bs-yellow);}
.accordion-button.dark::after {
  background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23ffc107'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
}
.accordion-button.dark.collapsed::after {
  background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23fff'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
}
.card-header{background-color: var(--default-color);color: var(--contrast-color)}
.btn-warning{background: var(--theme-color-1);border-color: var(--theme-border-color-1);color: var(--default-color)} */
</style>