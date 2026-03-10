<?php defined('FCPATH') OR exit('No direct script access allowed'); ?>

<!-- Hire Hero Section -->
<section class="py-5 bg-primary text-white" style="background: linear-gradient(135deg, #041640 0%, #0a2a5a 100%); margin-top: 0; padding: 5rem 0;">
	<div class="container">
		<div class="row justify-content-center text-center">
			<div class="col-lg-8">
				<span class="badge bg-warning text-dark px-3 py-2 mb-3 d-inline-block rounded-pill fw-bold">Hire Us</span>
				<h1 class="display-4 fw-bold mb-3">Hire Skilled ICT Professionals</h1>
				<p class="lead mb-0">Need developers, system administrators, designers, or marketing experts for your project? Tell us what you need and we'll respond within 24 hours.</p>
			</div>
		</div>
	</div>
</section>

<!-- Hire Form Section -->
<section class="py-5">
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-lg-10">
				<div class="card border-0 shadow-lg rounded-4 p-4 p-md-5">
					<div class="text-center mb-4">
						<h2 class="fw-bold mb-2">Project Request Form</h2>
						<p class="text-muted mb-1">Fill out the form below and we'll get back to you as soon as possible.</p>
						<p class="small text-success fw-semibold mb-0"><i class="fas fa-clock me-1"></i>We respond within 24 hours. No spam, no obligation.</p>
					</div>

					<form action="<?php echo base_url('hire-submit'); ?>" method="POST" class="row g-4" id="hireForm">
						<!-- Personal Information -->
						<div class="col-12">
							<h5 class="fw-bold text-primary mb-3">
								<i class="fas fa-user-circle me-2"></i>Personal Information
							</h5>
						</div>

						<div class="col-md-4">
							<label for="name" class="form-label fw-bold">
								<i class="fas fa-user text-primary me-2"></i>Full Name <span class="text-danger">*</span>
							</label>
							<input type="text" class="form-control form-control-lg" id="name" name="name" placeholder="Your full name" required style="border-radius: 10px;">
						</div>

						<div class="col-md-4">
							<label for="email" class="form-label fw-bold">
								<i class="fas fa-envelope text-primary me-2"></i>Email Address <span class="text-danger">*</span>
							</label>
							<input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="your.email@example.com" required style="border-radius: 10px;">
						</div>

						<div class="col-md-4">
							<label for="country" class="form-label fw-bold">
								<i class="fas fa-globe-africa text-primary me-2"></i>Country <span class="text-danger">*</span>
							</label>
							<select class="form-select form-select-lg" id="country" name="country" required style="border-radius: 10px;"></select>
							<small class="text-muted"><i class="fas fa-info-circle me-1"></i>Sets phone code, city &amp; currency</small>
						</div>

						<div class="col-md-4">
							<label for="city" class="form-label fw-bold">
								<i class="fas fa-map-marker-alt text-primary me-2"></i>City
							</label>
							<input type="text" class="form-control form-control-lg" id="city" name="city" list="cityList" placeholder="e.g. Nairobi" autocomplete="off" style="border-radius: 10px;">
							<datalist id="cityList"></datalist>
						</div>

						<div class="col-md-4">
							<label for="telno" class="form-label fw-bold">
								<i class="fas fa-phone text-primary me-2"></i>Telephone No. <span class="text-danger">*</span>
							</label>
							<div class="input-group input-group-lg">
								<span class="input-group-text phone-code-display" id="telCodeDisplay" style="border-radius: 10px 0 0 10px; min-width: 100px; justify-content: center; font-size: 0.9rem;"></span>
								<input type="hidden" id="tel_code" name="tel_code" value="+254">
								<input type="tel" class="form-control" id="telno" name="telno" placeholder="700 000 000" required style="border-radius: 0 10px 10px 0;">
							</div>
						</div>

						<div class="col-md-4">
							<label for="whts" class="form-label fw-bold">
								<i class="fab fa-whatsapp text-success me-2"></i>WhatsApp No.
							</label>
							<div class="input-group input-group-lg">
								<span class="input-group-text phone-code-display" id="whtsCodeDisplay" style="border-radius: 10px 0 0 10px; min-width: 100px; justify-content: center; font-size: 0.9rem;"></span>
								<input type="hidden" id="whts_code" name="whts_code" value="+254">
								<input type="tel" class="form-control" id="whts" name="whts" placeholder="700 000 000" style="border-radius: 0 10px 10px 0;">
							</div>
							<div class="form-check mt-1">
								<input class="form-check-input" type="checkbox" id="whts_same">
								<label class="form-check-label small text-muted" for="whts_same">Same as telephone</label>
							</div>
							<input type="hidden" name="sky" value="">
						</div>

						<!-- Company Information -->
						<div class="col-12 mt-3">
							<h5 class="fw-bold text-primary mb-3">
								<i class="fas fa-building me-2"></i>Company Information
							</h5>
						</div>

						<div class="col-md-6">
							<label for="client" class="form-label fw-bold">
								<i class="fas fa-users text-primary me-2"></i>Client Type <span class="text-danger">*</span>
							</label>
							<select name="client" id="client" class="form-select form-select-lg" required style="border-radius: 10px;" onchange="toggleCompanyFields()">
								<option value="">Select client type</option>
								<option value="individual">Individual</option>
								<option value="company">Company</option>
							</select>
						</div>

						<div class="col-md-6" id="companyNameField" style="display: none;">
							<label for="company_name" class="form-label fw-bold">
								<i class="fas fa-building text-primary me-2"></i>Company Name <span class="text-danger">*</span>
							</label>
							<input type="text" class="form-control form-control-lg" id="company_name" name="company_name" placeholder="Your company name" style="border-radius: 10px;">
						</div>

						<div class="col-md-6" id="industryField" style="display: none;">
							<label for="industry" class="form-label fw-bold">
								<i class="fas fa-industry text-primary me-2"></i>Industry <span class="text-danger">*</span>
							</label>
							<select name="industry" id="industry" class="form-select form-select-lg" style="border-radius: 10px;">
								<option value="">Select your industry</option>
								<option value="technology">Technology / IT</option>
								<option value="finance">Finance / Banking</option>
								<option value="healthcare">Healthcare</option>
								<option value="education">Education</option>
								<option value="retail">Retail / E-commerce</option>
								<option value="manufacturing">Manufacturing</option>
								<option value="real-estate">Real Estate</option>
								<option value="hospitality">Hospitality / Tourism</option>
								<option value="media">Media / Entertainment</option>
								<option value="non-profit">Non-Profit</option>
								<option value="government">Government</option>
								<option value="other">Other</option>
							</select>
						</div>

						<!-- Project Information -->
						<div class="col-12 mt-3">
							<h5 class="fw-bold text-primary mb-3">
								<i class="fas fa-project-diagram me-2"></i>Project Information
							</h5>
						</div>

						<div class="col-md-6">
							<label for="work" class="form-label fw-bold">
								<i class="fas fa-briefcase text-primary me-2"></i>Nature of Work <span class="text-danger">*</span>
							</label>
							<select name="work" id="work" class="form-select form-select-lg" required style="border-radius: 10px;">
								<option value="">Select nature of work</option>
								<option value="software-development">Software Development</option>
								<option value="web-development">Web Development</option>
								<option value="mobile-development">Mobile App Development</option>
								<option value="system-administration">System Administration</option>
								<option value="digital-marketing">Digital Marketing</option>
								<option value="design">Design (Web/Graphic)</option>
								<option value="it-consultancy">IT Consultancy</option>
								<option value="it-support">IT Support</option>
								<option value="data-science">Data Science / Analytics</option>
								<option value="cyber-security">Cyber Security</option>
								<option value="cloud-services">Cloud Services</option>
								<option value="other">Other</option>
							</select>
						</div>

						<div class="col-md-6">
							<label for="project_type" class="form-label fw-bold">
								<i class="fas fa-calendar-alt text-primary me-2"></i>Project Type
							</label>
							<select name="project_type" id="project_type" class="form-select form-select-lg" style="border-radius: 10px;">
								<option value="">Select project type</option>
								<option value="one-time">One-Time Project</option>
								<option value="ongoing">Ongoing Support</option>
								<option value="contract">Contract Basis</option>
								<option value="full-time">Full-Time Position</option>
								<option value="part-time">Part-Time Position</option>
							</select>
						</div>

						<div class="col-md-6">
							<label for="budget" class="form-label fw-bold">
								<i class="fas fa-dollar-sign text-primary me-2"></i>Project Budget <span class="text-danger">*</span>
							</label>
							<div class="input-group input-group-lg">
								<span class="input-group-text fw-bold" id="currencyPrefix" style="border-radius: 10px 0 0 10px; min-width: 60px; justify-content: center;">$</span>
								<input type="text" class="form-control" id="budget" name="budget" placeholder="2,000" required style="border-radius: 0 10px 10px 0;">
								<input type="hidden" id="currency" name="currency" value="USD">
							</div>
							<small class="text-muted" id="currencyHint">Currency set based on your country selection</small>
						</div>

						<div class="col-md-6">
							<label for="timeline" class="form-label fw-bold">
								<i class="fas fa-clock text-primary me-2"></i>Expected Timeline
							</label>
							<select name="timeline" id="timeline" class="form-select form-select-lg" style="border-radius: 10px;">
								<option value="">Select timeline</option>
								<option value="asap">As Soon As Possible</option>
								<option value="1-month">Within 1 Month</option>
								<option value="2-3-months">2-3 Months</option>
								<option value="3-6-months">3-6 Months</option>
								<option value="6-months-plus">6+ Months</option>
								<option value="flexible">Flexible</option>
							</select>
						</div>

						<div class="col-md-12">
							<label for="proj_desc" class="form-label fw-bold">
								<i class="fas fa-file-alt text-primary me-2"></i>Project Description <span class="text-danger">*</span>
							</label>
							<textarea class="form-control form-control-lg" id="proj_desc" name="proj_desc" rows="6" placeholder="What does your project entail? Please provide as much detail as possible about your requirements, goals, and expectations..." required style="border-radius: 10px; resize: vertical;"></textarea>
							<small class="text-muted">Please include: project scope, specific requirements, technical details, and any other relevant information</small>
						</div>

						<div class="col-md-12 text-center mt-3">
							<button type="submit" class="btn btn-primary btn-lg rounded-pill px-5 py-3 fw-bold shadow-lg hover-lift">
								<i class="fas fa-paper-plane me-2"></i>Submit Request
							</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Why Hire Us Section -->
<section class="py-5 bg-light">
	<div class="container">
		<div class="text-center mb-5">
			<h2 class="display-6 fw-bold mb-3">Why Hire Alphawonders?</h2>
			<p class="lead text-muted">We bring expertise, reliability, and professionalism to every project</p>
		</div>

		<div class="row g-4">
			<div class="col-lg-4 col-md-6">
				<div class="card border-0 shadow-sm h-100 text-center p-4 hover-lift">
					<div class="bg-primary bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
						<i class="fas fa-users fa-2x text-primary"></i>
					</div>
					<h5 class="fw-bold mb-3">Expert Team</h5>
					<p class="text-muted mb-0">Skilled professionals with years of experience in various technologies and industries.</p>
				</div>
			</div>

			<div class="col-lg-4 col-md-6">
				<div class="card border-0 shadow-sm h-100 text-center p-4 hover-lift">
					<div class="bg-success bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
						<i class="fas fa-clock fa-2x text-success"></i>
					</div>
					<h5 class="fw-bold mb-3">Timely Delivery</h5>
					<p class="text-muted mb-0">We respect deadlines and deliver projects on time without compromising quality.</p>
				</div>
			</div>

			<div class="col-lg-4 col-md-6">
				<div class="card border-0 shadow-sm h-100 text-center p-4 hover-lift">
					<div class="bg-warning bg-opacity-10 rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 70px; height: 70px;">
						<i class="fas fa-shield-alt fa-2x text-warning"></i>
					</div>
					<h5 class="fw-bold mb-3">Reliable & Secure</h5>
					<p class="text-muted mb-0">Enterprise-grade security and reliability for all our solutions and services.</p>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- CTA Section -->
<section class="py-5 bg-primary text-white" style="background: linear-gradient(135deg, #041640 0%, #0a2a5a 100%);">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-lg-8 mb-4 mb-lg-0">
				<h2 class="display-6 fw-bold mb-3">Have Questions?</h2>
				<p class="lead mb-0">Feel free to contact us directly if you need more information or have specific requirements.</p>
			</div>
			<div class="col-lg-4 text-lg-end">
				<a href="<?php echo base_url('/contact-us'); ?>" class="btn btn-warning btn-lg rounded-pill px-5 py-3 fw-bold shadow-lg hover-lift">
					<i class="fas fa-envelope me-2"></i>Contact Us
				</a>
			</div>
		</div>
	</div>
</section>

<style>
.hover-lift {
	transition: all 0.3s ease;
}

.hover-lift:hover {
	transform: translateY(-5px);
	box-shadow: 0 10px 30px rgba(0,0,0,0.1) !important;
}

.form-control:focus, .form-select:focus {
	border-color: var(--primary-color);
	box-shadow: 0 0 0 0.2rem rgba(4, 22, 64, 0.25);
}

.form-label {
	margin-bottom: 0.5rem;
}

h5.text-primary {
	border-bottom: 2px solid var(--primary-color);
	padding-bottom: 0.5rem;
}

.phone-code-display {
	background: #f8f9fa;
	font-weight: 600;
	letter-spacing: 0.5px;
	cursor: default;
}
</style>

<script>
// Country data: [code, flag, name, phoneCode, region, currencySymbol, currencyCode]
const countries = [
	['KE','\u{1F1F0}\u{1F1EA}','Kenya','+254','East Africa','KSh','KES'],
	['UG','\u{1F1FA}\u{1F1EC}','Uganda','+256','East Africa','$','USD'],
	['TZ','\u{1F1F9}\u{1F1FF}','Tanzania','+255','East Africa','$','USD'],
	['RW','\u{1F1F7}\u{1F1FC}','Rwanda','+250','East Africa','$','USD'],
	['ET','\u{1F1EA}\u{1F1F9}','Ethiopia','+251','East Africa','$','USD'],
	['SS','\u{1F1F8}\u{1F1F8}','South Sudan','+211','East Africa','$','USD'],
	['SO','\u{1F1F8}\u{1F1F4}','Somalia','+252','East Africa','$','USD'],
	['BI','\u{1F1E7}\u{1F1EE}','Burundi','+257','East Africa','$','USD'],
	['ER','\u{1F1EA}\u{1F1F7}','Eritrea','+291','East Africa','$','USD'],
	['DJ','\u{1F1E9}\u{1F1EF}','Djibouti','+253','East Africa','$','USD'],
	['NG','\u{1F1F3}\u{1F1EC}','Nigeria','+234','Africa','$','USD'],
	['ZA','\u{1F1FF}\u{1F1E6}','South Africa','+27','Africa','$','USD'],
	['GH','\u{1F1EC}\u{1F1ED}','Ghana','+233','Africa','$','USD'],
	['EG','\u{1F1EA}\u{1F1EC}','Egypt','+20','Africa','$','USD'],
	['CD','\u{1F1E8}\u{1F1E9}','DR Congo','+243','Africa','$','USD'],
	['SN','\u{1F1F8}\u{1F1F3}','Senegal','+221','Africa','$','USD'],
	['CM','\u{1F1E8}\u{1F1F2}','Cameroon','+237','Africa','$','USD'],
	['CI',"\u{1F1E8}\u{1F1EE}",'Cote d\'Ivoire','+225','Africa','$','USD'],
	['MZ','\u{1F1F2}\u{1F1FF}','Mozambique','+258','Africa','$','USD'],
	['ZW','\u{1F1FF}\u{1F1FC}','Zimbabwe','+263','Africa','$','USD'],
	['ZM','\u{1F1FF}\u{1F1F2}','Zambia','+260','Africa','$','USD'],
	['MW','\u{1F1F2}\u{1F1FC}','Malawi','+265','Africa','$','USD'],
	['AO','\u{1F1E6}\u{1F1F4}','Angola','+244','Africa','$','USD'],
	['MA','\u{1F1F2}\u{1F1E6}','Morocco','+212','Africa','$','USD'],
	['TN','\u{1F1F9}\u{1F1F3}','Tunisia','+216','Africa','$','USD'],
	['BW','\u{1F1E7}\u{1F1FC}','Botswana','+267','Africa','$','USD'],
	['NA','\u{1F1F3}\u{1F1E6}','Namibia','+264','Africa','$','USD'],
	['MU','\u{1F1F2}\u{1F1FA}','Mauritius','+230','Africa','$','USD'],
	['AE','\u{1F1E6}\u{1F1EA}','United Arab Emirates','+971','Middle East','$','USD'],
	['SA','\u{1F1F8}\u{1F1E6}','Saudi Arabia','+966','Middle East','$','USD'],
	['QA','\u{1F1F6}\u{1F1E6}','Qatar','+974','Middle East','$','USD'],
	['OM','\u{1F1F4}\u{1F1F2}','Oman','+968','Middle East','$','USD'],
	['BH','\u{1F1E7}\u{1F1ED}','Bahrain','+973','Middle East','$','USD'],
	['KW','\u{1F1F0}\u{1F1FC}','Kuwait','+965','Middle East','$','USD'],
	['IL','\u{1F1EE}\u{1F1F1}','Israel','+972','Middle East','$','USD'],
	['JO','\u{1F1EF}\u{1F1F4}','Jordan','+962','Middle East','$','USD'],
	['GB','\u{1F1EC}\u{1F1E7}','United Kingdom','+44','Europe','\u{00A3}','GBP'],
	['DE','\u{1F1E9}\u{1F1EA}','Germany','+49','Europe','\u{20AC}','EUR'],
	['FR','\u{1F1EB}\u{1F1F7}','France','+33','Europe','\u{20AC}','EUR'],
	['NL','\u{1F1F3}\u{1F1F1}','Netherlands','+31','Europe','\u{20AC}','EUR'],
	['SE','\u{1F1F8}\u{1F1EA}','Sweden','+46','Europe','\u{20AC}','EUR'],
	['NO','\u{1F1F3}\u{1F1F4}','Norway','+47','Europe','\u{20AC}','EUR'],
	['CH','\u{1F1E8}\u{1F1ED}','Switzerland','+41','Europe','\u{20AC}','EUR'],
	['IT','\u{1F1EE}\u{1F1F9}','Italy','+39','Europe','\u{20AC}','EUR'],
	['ES','\u{1F1EA}\u{1F1F8}','Spain','+34','Europe','\u{20AC}','EUR'],
	['PT','\u{1F1F5}\u{1F1F9}','Portugal','+351','Europe','\u{20AC}','EUR'],
	['BE','\u{1F1E7}\u{1F1EA}','Belgium','+32','Europe','\u{20AC}','EUR'],
	['AT','\u{1F1E6}\u{1F1F9}','Austria','+43','Europe','\u{20AC}','EUR'],
	['IE','\u{1F1EE}\u{1F1EA}','Ireland','+353','Europe','\u{20AC}','EUR'],
	['DK','\u{1F1E9}\u{1F1F0}','Denmark','+45','Europe','\u{20AC}','EUR'],
	['FI','\u{1F1EB}\u{1F1EE}','Finland','+358','Europe','\u{20AC}','EUR'],
	['PL','\u{1F1F5}\u{1F1F1}','Poland','+48','Europe','\u{20AC}','EUR'],
	['US','\u{1F1FA}\u{1F1F8}','United States','+1','Americas','$','USD'],
	['CA','\u{1F1E8}\u{1F1E6}','Canada','+1','Americas','$','USD'],
	['BR','\u{1F1E7}\u{1F1F7}','Brazil','+55','Americas','$','USD'],
	['MX','\u{1F1F2}\u{1F1FD}','Mexico','+52','Americas','$','USD'],
	['CO','\u{1F1E8}\u{1F1F4}','Colombia','+57','Americas','$','USD'],
	['AR','\u{1F1E6}\u{1F1F7}','Argentina','+54','Americas','$','USD'],
	['CL','\u{1F1E8}\u{1F1F1}','Chile','+56','Americas','$','USD'],
	['IN','\u{1F1EE}\u{1F1F3}','India','+91','Asia & Pacific','$','USD'],
	['CN','\u{1F1E8}\u{1F1F3}','China','+86','Asia & Pacific','$','USD'],
	['JP','\u{1F1EF}\u{1F1F5}','Japan','+81','Asia & Pacific','$','USD'],
	['AU','\u{1F1E6}\u{1F1FA}','Australia','+61','Asia & Pacific','$','USD'],
	['SG','\u{1F1F8}\u{1F1EC}','Singapore','+65','Asia & Pacific','$','USD'],
	['MY','\u{1F1F2}\u{1F1FE}','Malaysia','+60','Asia & Pacific','$','USD'],
	['PH','\u{1F1F5}\u{1F1ED}','Philippines','+63','Asia & Pacific','$','USD'],
	['KR','\u{1F1F0}\u{1F1F7}','South Korea','+82','Asia & Pacific','$','USD'],
	['ID','\u{1F1EE}\u{1F1E9}','Indonesia','+62','Asia & Pacific','$','USD'],
	['TH','\u{1F1F9}\u{1F1ED}','Thailand','+66','Asia & Pacific','$','USD'],
	['PK','\u{1F1F5}\u{1F1F0}','Pakistan','+92','Asia & Pacific','$','USD'],
	['BD','\u{1F1E7}\u{1F1E9}','Bangladesh','+880','Asia & Pacific','$','USD'],
	['VN','\u{1F1FB}\u{1F1F3}','Vietnam','+84','Asia & Pacific','$','USD'],
	['NZ','\u{1F1F3}\u{1F1FF}','New Zealand','+64','Asia & Pacific','$','USD'],
];

const countryMap = {};
countries.forEach(c => { countryMap[c[0]] = { flag: c[1], name: c[2], phone: c[3], region: c[4], currSym: c[5], currCode: c[6] }; });

// Build country dropdown grouped by region
(function buildCountrySelect() {
	const sel = document.getElementById('country');
	sel.innerHTML = '<option value="">Select country</option>';
	const regions = {};
	countries.forEach(c => { (regions[c[4]] = regions[c[4]] || []).push(c); });
	for (const region in regions) {
		const grp = document.createElement('optgroup');
		grp.label = region;
		regions[region].forEach(c => {
			const opt = document.createElement('option');
			opt.value = c[0];
			opt.textContent = c[1] + ' ' + c[2];
			grp.appendChild(opt);
		});
		sel.appendChild(grp);
	}
})();

// Major cities per country (datalist suggestions)
const citiesByCountry = {
	KE: ['Nairobi','Mombasa','Kisumu','Nakuru','Eldoret','Thika','Malindi','Nanyuki','Nyeri','Machakos'],
	UG: ['Kampala','Entebbe','Jinja','Gulu','Mbarara','Lira','Mbale'],
	TZ: ['Dar es Salaam','Dodoma','Arusha','Mwanza','Zanzibar City','Mbeya','Tanga'],
	RW: ['Kigali','Butare','Gisenyi','Ruhengeri','Gitarama'],
	ET: ['Addis Ababa','Dire Dawa','Mekelle','Gondar','Hawassa','Bahir Dar'],
	SS: ['Juba','Malakal','Wau','Bor'],
	SO: ['Mogadishu','Hargeisa','Kismayo','Berbera'],
	BI: ['Bujumbura','Gitega','Ngozi','Rumonge'],
	NG: ['Lagos','Abuja','Port Harcourt','Kano','Ibadan','Benin City','Enugu'],
	ZA: ['Johannesburg','Cape Town','Durban','Pretoria','Soweto','Port Elizabeth'],
	GH: ['Accra','Kumasi','Tamale','Takoradi','Tema'],
	EG: ['Cairo','Alexandria','Giza','Sharm El Sheikh','Luxor','Aswan'],
	CD: ['Kinshasa','Lubumbashi','Mbuji-Mayi','Kisangani','Goma'],
	SN: ['Dakar','Thies','Saint-Louis','Ziguinchor'],
	CM: ['Douala','Yaounde','Bamenda','Bafoussam','Garoua'],
	CI: ['Abidjan','Bouake','Yamoussoukro','Daloa'],
	ZM: ['Lusaka','Kitwe','Ndola','Livingstone','Kabwe'],
	ZW: ['Harare','Bulawayo','Chitungwiza','Mutare','Gweru'],
	AE: ['Dubai','Abu Dhabi','Sharjah','Ajman','Ras Al Khaimah'],
	SA: ['Riyadh','Jeddah','Mecca','Medina','Dammam'],
	QA: ['Doha','Al Wakrah','Al Khor'],
	GB: ['London','Manchester','Birmingham','Edinburgh','Glasgow','Leeds','Liverpool','Bristol'],
	DE: ['Berlin','Munich','Frankfurt','Hamburg','Cologne','Stuttgart','Dusseldorf'],
	FR: ['Paris','Lyon','Marseille','Toulouse','Nice','Bordeaux','Strasbourg'],
	NL: ['Amsterdam','Rotterdam','The Hague','Utrecht','Eindhoven'],
	IT: ['Rome','Milan','Naples','Turin','Florence','Venice','Bologna'],
	ES: ['Madrid','Barcelona','Valencia','Seville','Bilbao','Malaga'],
	CH: ['Zurich','Geneva','Bern','Basel','Lausanne'],
	SE: ['Stockholm','Gothenburg','Malmo','Uppsala'],
	NO: ['Oslo','Bergen','Trondheim','Stavanger'],
	US: ['New York','Los Angeles','Chicago','Houston','Phoenix','San Francisco','Seattle','Austin','Miami','Denver'],
	CA: ['Toronto','Vancouver','Montreal','Calgary','Ottawa','Edmonton'],
	BR: ['Sao Paulo','Rio de Janeiro','Brasilia','Salvador','Belo Horizonte','Curitiba'],
	MX: ['Mexico City','Guadalajara','Monterrey','Cancun','Puebla'],
	IN: ['Mumbai','Delhi','Bangalore','Hyderabad','Chennai','Kolkata','Pune'],
	CN: ['Shanghai','Beijing','Shenzhen','Guangzhou','Chengdu','Hangzhou'],
	JP: ['Tokyo','Osaka','Kyoto','Yokohama','Nagoya','Fukuoka'],
	AU: ['Sydney','Melbourne','Brisbane','Perth','Adelaide','Canberra'],
	SG: ['Singapore'],
	MY: ['Kuala Lumpur','George Town','Johor Bahru','Kota Kinabalu'],
	PH: ['Manila','Cebu City','Davao','Quezon City'],
	KR: ['Seoul','Busan','Incheon','Daegu'],
};

// Update phone codes, city suggestions, and currency from country
function onCountryChange() {
	const code = document.getElementById('country').value;
	if (!code || !countryMap[code]) return;
	const c = countryMap[code];

	// Phone codes (read-only display + hidden input)
	document.getElementById('telCodeDisplay').textContent = c.flag + ' ' + c.phone;
	document.getElementById('tel_code').value = c.phone;
	document.getElementById('whtsCodeDisplay').textContent = c.flag + ' ' + c.phone;
	document.getElementById('whts_code').value = c.phone;

	// City datalist
	const cityInput = document.getElementById('city');
	const datalist = document.getElementById('cityList');
	datalist.innerHTML = '';
	const cities = citiesByCountry[code] || [];
	cities.forEach(city => {
		const opt = document.createElement('option');
		opt.value = city;
		datalist.appendChild(opt);
	});
	cityInput.value = '';
	cityInput.placeholder = cities.length ? 'e.g. ' + cities[0] : 'Enter your city';

	// Currency
	document.getElementById('currencyPrefix').textContent = c.currSym;
	document.getElementById('currency').value = c.currCode;
	const hints = { KES: 'Kenyan Shillings (KSh)', EUR: 'Euros (\u{20AC})', GBP: 'British Pounds (\u{00A3})', USD: 'US Dollars ($)' };
	document.getElementById('currencyHint').textContent = hints[c.currCode] || 'US Dollars ($)';
}

// "Same as telephone" checkbox
document.getElementById('whts_same').addEventListener('change', function() {
	const whtsInput = document.getElementById('whts');
	if (this.checked) {
		whtsInput.value = document.getElementById('telno').value;
		whtsInput.readOnly = true;
		whtsInput.style.opacity = '0.6';
	} else {
		whtsInput.readOnly = false;
		whtsInput.style.opacity = '1';
	}
});

// Keep WhatsApp synced while checkbox is checked
document.getElementById('telno').addEventListener('input', function() {
	if (document.getElementById('whts_same').checked) {
		document.getElementById('whts').value = this.value;
	}
});

function toggleCompanyFields() {
	const clientType = document.getElementById('client').value;
	const companyNameField = document.getElementById('companyNameField');
	const industryField = document.getElementById('industryField');
	const companyNameInput = document.getElementById('company_name');
	const industrySelect = document.getElementById('industry');

	if (clientType === 'company') {
		companyNameField.style.display = 'block';
		industryField.style.display = 'block';
		companyNameInput.setAttribute('required', 'required');
		industrySelect.setAttribute('required', 'required');
	} else {
		companyNameField.style.display = 'none';
		industryField.style.display = 'none';
		companyNameInput.removeAttribute('required');
		industrySelect.removeAttribute('required');
		companyNameInput.value = '';
		industrySelect.value = '';
	}
}

// Default to Kenya and wire up country change
document.getElementById('country').value = 'KE';
onCountryChange();
document.getElementById('country').addEventListener('change', onCountryChange);
</script>
