<form class="container needs-validation form__contact" method="post" novalidate="novalidate">
    <input type="hidden" name="autoresponder" value="1">
    <div class="row form-group">
        <div class="col-4 label__box">
            <label for="contact__areaofinterest">Area of Interest</label>
        </div>
        <div class="col-8 input__box">
            <select class="form-control contact__areaofinterest" id="contact__areaofinterest" name="contact__areaofinterest">
                <option value="volunteer">Volunteer</option>
                <option value="newsletter">Newsletter</option>
                <option value="annual_report">Annual Report</option>
                <option value="blog">Blog</option>
                <option value="others">Others</option>
            </select>
        </div>
    </div>

    <div class="row form-group">
        <div class="col-4 label__box">
            <label for="contact__fullname">Full Name *</label>
        </div>
        <div class="col-8 input__box">
            <input type="text" class="form-control contact__fullname" id="contact__fullname" name="contact__fullname" placeholder="e.g. John Smith">
            <label class="d-none"></label>
        </div>
    </div>

    <div class="row form-group">
        <div class="col-4 label__box">
            <label for="contact__email">Email *</label>
        </div>
        <div class="col-8 input__box">
            <input type="email" class="form-control contact__email" id="contact__email" name="contact__email" placeholder="e.g. john@email.com">
            <label class="d-none"></label>
        </div>
    </div>

    <div class="row form-group">
        <div class="col-4 label__box">
            <label for="contact__mobile">Mobile Phone</label>
        </div>
        <div class="col-8 input__box">
            <input type="text" class="form-control contact__mobile" id="contact__mobile" name="contact__mobile" placeholder="e.g. 010-1234567">
            <label class="d-none"></label>
        </div>
    </div>

    <div class="row form-group">
        <div class="col-4 label__box">
            <label for="contact__state">Address (State/Town) *</label>
        </div>
        <div class="col-8 input__box">
            <select class="form-control contact__state" id="contact__state" name="contact__state">
                <option disabled="" selected="" value=""> -- Select a State --</option>
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
                <option value="all-states">All States</option>
            </select>
            <label class="d-none"></label>
        </div>
    </div>

    <div class="row form-group">
        <div class="col-4 label__box">
            <label for="contact__subject">Enquiry Subject *</label>
        </div>
        <div class="col-8 input__box">
            <select class="form-control contact__subject" id="contact__subject" name="contact__subject">
                <option value="collaboration">Collaboration</option>
                <option value="programs">Programs</option>
                <option value="donation">Donation</option>
                <option value="other">Others</option>
            </select>
        </div>
    </div>

    <div class="row form-group">
        <div class="col-4 label__box">
            <label for="contact__focus">Area of Interest: Focus</label>
        </div>
        <div class="col-8 input__box">
            <select class="form-control contact__focus" id="contact__focus" name="contact__focus">
                <option value="education">Education</option>
                <option value="community">Community Well-being &amp; Development</option>
                <option value="environment">Environment</option>
            </select>
        </div>
    </div>

    <div class="row form-group">
        <div class="col-4 label__box">
            <label for="contact__message">Message</label>
        </div>
        <div class="col-12 input__box" style="padding: 0;">
            <textarea class="form-control contact__message" id="contact__message" name="contact__message" rows="4" placeholder="Please leave your message here..." maxlength="500"></textarea>
        </div>
        <span id="remain">500 Characters</span>
    </div>

    <div class="row form-group">
        <p style="margin-left: 0;">I agree to the following</p>
        <div class="col-12">
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input contact__ppd" id="contact__ppd" name="contact__ppd">
                <label class="form-check-label" for="contact__ppd">Personal Data Protection Act (PDPA) - Permission to
                    collect data*</label>
            </div>
        </div>
        <div class="col-12">
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input contact__update" id="contact__update" name="contact__update">
                <label class="form-check-label" for="contact__update">Receive Updates from Yayasan PETRONAS</label>
            </div>
        </div>
        <div class="col-12">

            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input contact__info" id="contact__info" name="contact__info">
                <label class="form-check-label" for="contact__info">The information provided is accurate*</label>
            </div>
        </div>
    </div>

    <div class="row">
        <button type="submit" class="btn btn-primary contact__submit" disabled="disabled">Submit</button>
    </div>
    <div class="row">
        <span class="output"></span>
    </div>
</form>