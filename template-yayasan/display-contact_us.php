<?php
/* Array
(
    [area_of_interest] => blog
    [fullname] => test
    [email] => testfishermen@email.com
    [phone] => 0135553333
    [state] => terengganu
    [subject] => donation
    [focus] => environment
    [message] => 123123 (max_length: 500)
    [form_id] => contact-us
) */
if (WP_DEBUG) {
    echo "<pre>WPDEBUG_ON<br>";
    var_dump($_POST);
    echo "</pre>";
}
?>
<form id="contact-us" class="contact-us" method="post" action="./">

    <div class="row mb-2">
        <label class="col-sm-3 col-form-label" for="area_of_interest">
            Area of Interest
        </label>
        <div class="col-auto flex-fill">
            <select class="form-select" id="area_of_interest" name="area_of_interest" required>
                <option selected disabled value>-- Select Area of Interest --</option>
                <option value="volunteer">Volunteer</option>
                <option value="newsletter">Newsletter</option>
                <option value="annual_report">Annual Report</option>
                <option value="blog">Blog</option>
                <option value="others">Others</option>
            </select>
        </div>
    </div>

    <div class="row mb-2">
        <label class="col-sm-3 col-form-label" for="fullname">
            Full name <span class="text-danger">*</span>
        </label>
        <div class="col-auto flex-fill">
            <input type="text" class="form-control" id="fullname" name="fullname" placeholder="e.g. John Smith" required>
        </div>
    </div>

    <div class="row mb-2">
        <label class="col-sm-3 col-form-label" for="email">
            Email <span class="text-danger">*</span>
        </label>
        <div class="col-auto flex-fill">
            <input type="email" class="form-control" id="email" name="email" placeholder="e.g. john.smith@email.com" required>
        </div>
    </div>

    <div class="row mb-2">
        <label class="col-sm-3 col-form-label" for="phone">
            Mobile Phone <span class="text-danger">*</span>
        </label>
        <div class="col-auto flex-fill">
            <input type="text" class="form-control" id="phone" name="phone" placeholder="e.g. 010-1234567" required>
        </div>
    </div>

    <div class="row mb-2">
        <label class="col-sm-3 col-form-label" for="state">
            Address (State/Town) <span class="text-danger">*</span>
        </label>
        <div class="col-auto flex-fill">
            <select class="form-select" id="state" name="state" required>
                <option selected disabled value>-- Select a State --</option>
                <option value="johor">Johor</option>
                <option value="kedah">Kedah</option>
                <option value="kelantan">Kelantan</option>
                <option value="melaka">Melaka</option>
                <option value="negeri-sembilan">Negeri Sembilan</option>
                <option value="pahang">Pahang</option>
                <option value="pulau-pinang">Pulau Pinang</option>
                <option value="perak">Perak</option>
                <option value="perlis">Perlis</option>
                <option value="sabah">Sabah</option>
                <option value="sarawak">Sarawak</option>
                <option value="selangor">Selangor</option>
                <option value="terengganu">Terengganu</option>
                <option value="kuala-lumpur">W.P. Kuala Lumpur</option>
                <option value="labuan">Labuan</option>
                <option value="putrajaya">Putrajaya</option>
                <option value="none">None</option>
            </select>
        </div>
    </div>

    <div class="row mb-2">
        <label class="col-sm-3 col-form-label" for="subject">
            Enquiry Subject <span class="text-danger">*</span>
        </label>
        <div class="col-auto flex-fill">
            <select class="form-select" id="subject" name="subject" required>
                <option selected disabled value>-- Select a Subject --</option>
                <option value="collaboration">Collaboration</option>
                <option value="programs">Programs</option>
                <option value="donation">Donation</option>
                <option value="other">Others</option>
            </select>
        </div>
    </div>

    <div class="row mb-2">
        <label class="col-sm-3 col-form-label" for="focus">
            Area of Interest's Focus <span class="text-danger">*</span>
        </label>
        <div class="col-auto flex-fill">
            <select class="form-select" id="focus" name="focus" required>
                <option selected disabled value>-- Select the Focus --</option>
                <option value="education">Education</option>
                <option value="community">Community Well-being &amp; Development</option>
                <option value="environment">Environment</option>
            </select>
        </div>
    </div>

    <div class="row mb-2">
        <label class="col-sm-3 col-form-label" for="message">
            Message <span class="text-danger">*</span>
        </label>
        <div class="col-auto flex-fill">
            <textarea class="form-control" id="message" name="message" rows="4" placeholder="Please leave your message here..." maxlength="500" aria-describedby="messageHelp"></textarea>
            <div id="messageHelp" class="form-text text-end">500 Characters</div>
        </div>
    </div>

    <div class="row">
        <hr class="offset-sm-3 col-auto flex-fill">
    </div>
    <div class="row mb-2">
        <label class="col-sm-3 col-form-label">
            I agree to the following:
        </label>
        <div class="col-auto flex-fill">
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="pdpa" required>
                <label class="form-check-label" for="pdpa">
                    Personal Data Protection Act (PDPA) - Permission to collect data <span class="text-danger">*</span>
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="update">
                <label class="form-check-label" for="update">
                    Receive Updates from Yayasan PETRONAS
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="accurate_info" required>
                <label class="form-check-label" for="accurate_info">
                    The information provided is accurate <span class="text-danger">*</span>
                </label>
            </div>
            <input type="hidden" name="form_id" value="contact-us">
            <button type="submit" class="btn btn-primary my-3">Submit</button>
        </div>
    </div>
</form>

<style>
    form .form-check-label {
        font-size: 0.9rem;
    }

    @media (min-width: 768px) {
        .contact-us label.col-sm-3 {
            text-align: right;
        }
    }
</style>