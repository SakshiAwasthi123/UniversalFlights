<?php
    // if(isset($_SERVER['HTTP_REFERER']) && str_contains($_SERVER['HTTP_REFERER'], HOST_URL)) {
    if(true) {
        echo json_encode($_POST);
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

        <div class="col-12 mb-3">
            <div class="card shadow">
            <div class="container" style="max-width: 1100px; margin: 20px auto; background: #fff; border-radius: 10px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); padding: 20px;">
        <div class="text-center mb-3">
            <div class="d-flex justify-content-between align-items-center" style="background: #00aaff; padding: 15px; border-radius: 10px;">
                <div style="color: white; font-size: 14px;">
                    <span style="width: 20px; height: 20px; background: #4caf50; border-radius: 50%; display: inline-block; margin-right: 5px;"></span> Add Extras
                </div>
                <div style="color: white; font-size: 14px;">
                    <span style="width: 20px; height: 20px; background: #4caf50; border-radius: 50%; display: inline-block; margin-right: 5px;"></span> Your Details
                </div>
                <div style="color: white; font-size: 14px;">
                    <span style="width: 20px; height: 20px; background: #ccc; border-radius: 50%; display: inline-block; margin-right: 5px;"></span> Completed
                </div>
            </div>
        </div>

        <h4 style="margin-top: 10px;">My Booking Summary</h4>

        <div class="accordion" id="bookingAccordion">

            
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="font-weight: bold; display: flex; justify-content: space-between; align-items: center;">
                    <i class="fa-solid fa-plane-departure"></i> Flights 
                        <span style="margin-left: 100px; font-weight: normal;">£729.12</span>
                    </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#bookingAccordion">
                    <div class="accordion-body"></div>  
                </div>
            </div>

            
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo" style="font-weight: bold; display: flex; justify-content: space-between; align-items: center;">
                    <i class="fa-brands fa-ups"></i> Service Pack 
                        <span style="margin-left: auto; font-weight: normal;">£15.00</span>
                    </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#bookingAccordion">
                    <div class="accordion-body"></div>  
                </div>
            </div>

        </div>

        
        <div class="total" style="font-size: 18px; font-weight: bold; color: #333; margin-top: 15px; display: flex; justify-content: space-between;">
            <span>Total Price:</span> <strong>£744.12</strong>
        </div>

    </div>
            </div>
        </div>
        
            
           
            
         <div class="col 12 mb-3">
            <div class="card shadow">
            <div style="width: 100%; max-width: 1100px; border: 1px solid #dee2e6; border-radius: 10px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); background-color: #fff; padding: 20px;">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h5 style="font-size: 18px; font-weight: bold; margin: 0;">Promotional code</h5>
        <i class="bi bi-chevron-down"></i> <!-- Bootstrap icon -->
    </div>
    <p style="font-size: 14px; color: #6c757d; margin: 15px 0;">If you have a promotion code please enter it here.</p>
    
    <div class="input-group mb-3">
        <input type="text" class="form-control" placeholder="Enter Promotion Code" aria-label="Promotion Code">
        <button class="btn" 
            style="background-color: #007bff; color: #fff; border: none; padding: 8px 20px; transition: background 0.3s;"
            onmouseover="this.style.backgroundColor='#0056b3';"
            onmouseout="this.style.backgroundColor='#007bff';">
            SUBMIT
        </button>
    </div>
</div>

            </div>
         </div> 




    
    <div class="billing-form" style="  background-color: #ffffff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        max-width: 1100px;
        margin: 20px auto;
   " >
    <h4>Billing Address</h4>
    <p class="text-muted"><i>The billing address entered below must match the address on the account holder's statement</i></p>
    <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" id="samePassenger" checked>
        <label class="form-check-label" style="color: hsl(186, 87%, 54%);
        text-decoration: none;
" for="samePassenger">
            First name & last name same as lead passenger.
        </label>
    </div>
    <div class="mb-3">
        <label class="form-label">First name *</label>
        <input type="text" class="form-control" value="JAMES">
    </div>
    <div class="mb-3">
        <label class="form-label">Last name *</label>
        <input type="text" class="form-control" value="MILNER">
    </div>
    <div class="mb-3">
        <label class="form-label">House number/name *</label>
        <input type="text" class="form-control" value="124-128">
    </div>
    <div class="mb-3">
        <label class="form-label">Street *</label>
        <input type="text" class="form-control" value="City Road">
    </div>
    <div class="mb-3">
        <label class="form-label">City/town *</label>
        <input type="text" class="form-control" value="London">
    </div>
    <div class="mb-3">
        <label class="form-label">Postcode *</label>
        <input type="text" class="form-control" value="EC1V 2NX">
    </div>
    <div class="mb-3">
        <label class="form-label">Country *</label>
        <select class="form-select">
            <option selected>United Kingdom</option>
            <option>United States</option>
            <option>Canada</option>
        </select>
    </div>
    <div class="mb-3">
        <p class="text-primary">Find another address</p>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="checkbox" id="terms" checked>
        <label class="form-check-label" for="terms">
            I Mr. James Milner confirm that I have read and agree to the <a href="#">terms and conditions</a>, <a href="#">fare rules</a> and <a href="#">privacy policy</a> and  I acknowledge that tickets and travel arrangements are purchased solely from travelup.com and processed by travelup.com and their agents. I agree to pay the total sum of <strong>£982.05</strong>. This will serve as my electronic signature.
        </label>
    </div>
</div>




<div class="card" style="border: none; box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1); border-radius: 12px; padding: 30px; text-align: center;">
    <button class="btn" 
        style="background-color: #00aeff; color: white; font-weight: bold; border: none; padding: 15px 40px; border-radius: 8px; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1); transition: all 0.3s ease; text-transform: uppercase;"
        onmouseover="this.style.backgroundColor='#009ee3'; this.style.boxShadow='0 6px 12px rgba(0, 0, 0, 0.15)';"
        onmouseout="this.style.backgroundColor='#00aeff'; this.style.boxShadow='0 4px 10px rgba(0, 0, 0, 0.1)';">
        Confirm Booking
    </button>
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
        const forms = $('form');
        contact = {};
        paxes = [];
        
        var isFormValid = true;
        $('form.bk_form').each(function(formIndex, form) {
            /** Check invalid forms */
            if(!$(form).valid()){
                isFormValid = false;
            }

            var values = {};
            $.each($(this).serializeArray(), function(i, field) {
                values[field.name] = field.value;
            });
            if($(form).prop("id").includes("pax_info_")){
                paxes.push(values)                
            } else if($(form).prop("id").includes("pax_other_info")){
                contact['other'] = values;
            }
        })
        if(isFormValid){
            contact['other'].host = location.host;
            contact['paxes'] = paxes;
            // console.log("contact:", contact);
            
            var redirect = `${location.origin}/payments/payOnline.php`;
            $.redirect(redirect, contact);
        }
    });
})


</script>
