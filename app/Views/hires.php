<?php defined('FCPATH') OR exit('No direct script access allowed'); ?>

<!-- Hire Hero Section -->
<section class="py-5 bg-primary text-white" style="background: linear-gradient(135deg, #041640 0%, #0a2a5a 100%); margin-top: 0; padding: 4rem 0;">
	<div class="container">
		<div class="row align-items-center">
			<div class="col-lg-7 mb-4 mb-lg-0">
				<span class="badge bg-warning text-dark px-3 py-2 mb-3 d-inline-block rounded-pill fw-bold">Hire Us</span>
				<h1 class="display-4 fw-bold mb-3">Hire Skilled ICT Professionals</h1>
				<p class="lead mb-4" style="color: #ccd6e0;">Need developers, system administrators, designers, or marketing experts? Tell us what you need and we'll respond within 24 hours.</p>
				<div class="d-flex flex-wrap gap-4">
					<div class="d-flex align-items-center gap-2">
						<div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; background: rgba(255,176,0,0.2);">
							<i class="fas fa-clock text-warning" style="font-size: 0.85rem;"></i>
						</div>
						<span class="small">24-hour response</span>
					</div>
					<div class="d-flex align-items-center gap-2">
						<div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; background: rgba(40,167,69,0.2);">
							<i class="fas fa-check text-success" style="font-size: 0.85rem;"></i>
						</div>
						<span class="small">No obligation</span>
					</div>
					<div class="d-flex align-items-center gap-2">
						<div class="rounded-circle d-flex align-items-center justify-content-center" style="width: 36px; height: 36px; background: rgba(13,202,240,0.2);">
							<i class="fas fa-shield-alt text-info" style="font-size: 0.85rem;"></i>
						</div>
						<span class="small">NDA available</span>
					</div>
				</div>
			</div>
			<div class="col-lg-5 d-none d-lg-block">
				<div class="row g-2 justify-content-center">
					<div class="col-6">
						<div class="rounded-3 p-3 text-center" style="background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1);">
							<i class="fas fa-code fa-lg text-warning mb-2 d-block"></i>
							<div class="small fw-semibold">Developers</div>
						</div>
					</div>
					<div class="col-6">
						<div class="rounded-3 p-3 text-center" style="background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1);">
							<i class="fas fa-server fa-lg text-info mb-2 d-block"></i>
							<div class="small fw-semibold">Sysadmins</div>
						</div>
					</div>
					<div class="col-6">
						<div class="rounded-3 p-3 text-center" style="background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1);">
							<i class="fas fa-palette fa-lg text-danger mb-2 d-block"></i>
							<div class="small fw-semibold">Designers</div>
						</div>
					</div>
					<div class="col-6">
						<div class="rounded-3 p-3 text-center" style="background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1);">
							<i class="fas fa-bullhorn fa-lg text-success mb-2 d-block"></i>
							<div class="small fw-semibold">Marketers</div>
						</div>
					</div>
				</div>
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
							<label for="countrySearch" class="form-label fw-bold">
								<i class="fas fa-globe-africa text-primary me-2"></i>Country <span class="text-danger">*</span>
							</label>
							<div class="position-relative" id="countryWrapper">
								<input type="text" class="form-control form-control-lg" id="countrySearch" placeholder="Type to search country..." autocomplete="off" style="border-radius: 10px;">
								<input type="hidden" id="country" name="country" required>
								<div class="country-dropdown" id="countryDropdown"></div>
							</div>
							<small class="text-muted"><i class="fas fa-info-circle me-1"></i>Sets phone code, city &amp; currency</small>
						</div>

						<div class="col-md-4">
							<label for="city" class="form-label fw-bold">
								<i class="fas fa-map-marker-alt text-primary me-2"></i>City / Nearest Town <span class="text-danger">*</span>
							</label>
							<input type="text" class="form-control form-control-lg" id="city" name="city" list="cityList" placeholder="e.g. Nairobi" required autocomplete="off" style="border-radius: 10px;">
							<datalist id="cityList"></datalist>
							<small class="text-muted">Select from suggestions or type your own</small>
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

						<div class="col-md-6" id="addressField" style="display: none;">
							<label for="address" class="form-label fw-bold">
								<i class="fas fa-map-marker-alt text-primary me-2"></i>Address
							</label>
							<input type="text" class="form-control form-control-lg" id="address" name="address" placeholder="Street address, building, floor" style="border-radius: 10px;">
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

.country-dropdown {
	display: none;
	position: absolute;
	top: 100%;
	left: 0;
	right: 0;
	max-height: 280px;
	overflow-y: auto;
	background: #fff;
	border: 1px solid #dee2e6;
	border-top: none;
	border-radius: 0 0 10px 10px;
	z-index: 1050;
	box-shadow: 0 8px 16px rgba(0,0,0,0.12);
}

.country-dropdown.show {
	display: block;
}

.country-dropdown .cd-group {
	padding: 6px 12px;
	font-size: 0.7rem;
	font-weight: 700;
	color: #6c757d;
	background: #f8f9fa;
	text-transform: uppercase;
	letter-spacing: 0.5px;
	position: sticky;
	top: 0;
	z-index: 1;
}

.country-dropdown .cd-item {
	padding: 8px 14px;
	cursor: pointer;
	font-size: 0.95rem;
	transition: background 0.15s;
}

.country-dropdown .cd-item:hover,
.country-dropdown .cd-item.cd-active {
	background: #e8f0fe;
}

.country-dropdown .cd-empty {
	padding: 12px 14px;
	color: #999;
	font-size: 0.9rem;
	text-align: center;
}

#countrySearch.country-selected {
	background-color: #f8f9fa;
}
</style>

<script>
// Country data: [code, flag, name, phoneCode, region, currencySymbol, currencyCode]
// Currency: KSh=Kenya, EUR=Eurozone, GBP=UK, $=everyone else
const countries = [
	// ── East Africa ──
	['KE','\u{1F1F0}\u{1F1EA}','Kenya','+254','East Africa','KSh','KES'],
	['UG','\u{1F1FA}\u{1F1EC}','Uganda','+256','East Africa','$','USD'],
	['TZ','\u{1F1F9}\u{1F1FF}','Tanzania','+255','East Africa','$','USD'],
	['RW','\u{1F1F7}\u{1F1FC}','Rwanda','+250','East Africa','$','USD'],
	['BI','\u{1F1E7}\u{1F1EE}','Burundi','+257','East Africa','$','USD'],
	['ET','\u{1F1EA}\u{1F1F9}','Ethiopia','+251','East Africa','$','USD'],
	['ER','\u{1F1EA}\u{1F1F7}','Eritrea','+291','East Africa','$','USD'],
	['DJ','\u{1F1E9}\u{1F1EF}','Djibouti','+253','East Africa','$','USD'],
	['SO','\u{1F1F8}\u{1F1F4}','Somalia','+252','East Africa','$','USD'],
	['SS','\u{1F1F8}\u{1F1F8}','South Sudan','+211','East Africa','$','USD'],
	['SD','\u{1F1F8}\u{1F1E9}','Sudan','+249','East Africa','$','USD'],
	// ── West Africa ──
	['NG','\u{1F1F3}\u{1F1EC}','Nigeria','+234','West Africa','$','USD'],
	['GH','\u{1F1EC}\u{1F1ED}','Ghana','+233','West Africa','$','USD'],
	['SN','\u{1F1F8}\u{1F1F3}','Senegal','+221','West Africa','$','USD'],
	['CI',"\u{1F1E8}\u{1F1EE}",'Cote d\'Ivoire','+225','West Africa','$','USD'],
	['CM','\u{1F1E8}\u{1F1F2}','Cameroon','+237','West Africa','$','USD'],
	['ML','\u{1F1F2}\u{1F1F1}','Mali','+223','West Africa','$','USD'],
	['BF','\u{1F1E7}\u{1F1EB}','Burkina Faso','+226','West Africa','$','USD'],
	['NE','\u{1F1F3}\u{1F1EA}','Niger','+227','West Africa','$','USD'],
	['GN','\u{1F1EC}\u{1F1F3}','Guinea','+224','West Africa','$','USD'],
	['BJ','\u{1F1E7}\u{1F1EF}','Benin','+229','West Africa','$','USD'],
	['TG','\u{1F1F9}\u{1F1EC}','Togo','+228','West Africa','$','USD'],
	['SL','\u{1F1F8}\u{1F1F1}','Sierra Leone','+232','West Africa','$','USD'],
	['LR','\u{1F1F1}\u{1F1F7}','Liberia','+231','West Africa','$','USD'],
	['MR','\u{1F1F2}\u{1F1F7}','Mauritania','+222','West Africa','$','USD'],
	['GM','\u{1F1EC}\u{1F1F2}','Gambia','+220','West Africa','$','USD'],
	['GW','\u{1F1EC}\u{1F1FC}','Guinea-Bissau','+245','West Africa','$','USD'],
	['CV','\u{1F1E8}\u{1F1FB}','Cape Verde','+238','West Africa','$','USD'],
	['GA','\u{1F1EC}\u{1F1E6}','Gabon','+241','West Africa','$','USD'],
	['GQ','\u{1F1EC}\u{1F1F6}','Equatorial Guinea','+240','West Africa','$','USD'],
	['TD','\u{1F1F9}\u{1F1E9}','Chad','+235','West Africa','$','USD'],
	['CF','\u{1F1E8}\u{1F1EB}','Central African Republic','+236','West Africa','$','USD'],
	['CG','\u{1F1E8}\u{1F1EC}','Republic of the Congo','+242','West Africa','$','USD'],
	['ST','\u{1F1F8}\u{1F1F9}','Sao Tome and Principe','+239','West Africa','$','USD'],
	// ── Southern Africa ──
	['ZA','\u{1F1FF}\u{1F1E6}','South Africa','+27','Southern Africa','$','USD'],
	['CD','\u{1F1E8}\u{1F1E9}','DR Congo','+243','Southern Africa','$','USD'],
	['AO','\u{1F1E6}\u{1F1F4}','Angola','+244','Southern Africa','$','USD'],
	['MZ','\u{1F1F2}\u{1F1FF}','Mozambique','+258','Southern Africa','$','USD'],
	['ZM','\u{1F1FF}\u{1F1F2}','Zambia','+260','Southern Africa','$','USD'],
	['ZW','\u{1F1FF}\u{1F1FC}','Zimbabwe','+263','Southern Africa','$','USD'],
	['MW','\u{1F1F2}\u{1F1FC}','Malawi','+265','Southern Africa','$','USD'],
	['BW','\u{1F1E7}\u{1F1FC}','Botswana','+267','Southern Africa','$','USD'],
	['NA','\u{1F1F3}\u{1F1E6}','Namibia','+264','Southern Africa','$','USD'],
	['LS','\u{1F1F1}\u{1F1F8}','Lesotho','+266','Southern Africa','$','USD'],
	['SZ','\u{1F1F8}\u{1F1FF}','Eswatini','+268','Southern Africa','$','USD'],
	['MG','\u{1F1F2}\u{1F1EC}','Madagascar','+261','Southern Africa','$','USD'],
	['MU','\u{1F1F2}\u{1F1FA}','Mauritius','+230','Southern Africa','$','USD'],
	['SC','\u{1F1F8}\u{1F1E8}','Seychelles','+248','Southern Africa','$','USD'],
	['KM','\u{1F1F0}\u{1F1F2}','Comoros','+269','Southern Africa','$','USD'],
	['RE','\u{1F1F7}\u{1F1EA}','Reunion','+262','Southern Africa','$','USD'],
	// ── North Africa ──
	['EG','\u{1F1EA}\u{1F1EC}','Egypt','+20','North Africa','$','USD'],
	['MA','\u{1F1F2}\u{1F1E6}','Morocco','+212','North Africa','$','USD'],
	['DZ','\u{1F1E9}\u{1F1FF}','Algeria','+213','North Africa','$','USD'],
	['TN','\u{1F1F9}\u{1F1F3}','Tunisia','+216','North Africa','$','USD'],
	['LY','\u{1F1F1}\u{1F1FE}','Libya','+218','North Africa','$','USD'],
	// ── Middle East ──
	['AE','\u{1F1E6}\u{1F1EA}','United Arab Emirates','+971','Middle East','$','USD'],
	['SA','\u{1F1F8}\u{1F1E6}','Saudi Arabia','+966','Middle East','$','USD'],
	['QA','\u{1F1F6}\u{1F1E6}','Qatar','+974','Middle East','$','USD'],
	['KW','\u{1F1F0}\u{1F1FC}','Kuwait','+965','Middle East','$','USD'],
	['BH','\u{1F1E7}\u{1F1ED}','Bahrain','+973','Middle East','$','USD'],
	['OM','\u{1F1F4}\u{1F1F2}','Oman','+968','Middle East','$','USD'],
	['JO','\u{1F1EF}\u{1F1F4}','Jordan','+962','Middle East','$','USD'],
	['LB','\u{1F1F1}\u{1F1E7}','Lebanon','+961','Middle East','$','USD'],
	['IQ','\u{1F1EE}\u{1F1F6}','Iraq','+964','Middle East','$','USD'],
	['IL','\u{1F1EE}\u{1F1F1}','Israel','+972','Middle East','$','USD'],
	['PS','\u{1F1F5}\u{1F1F8}','Palestine','+970','Middle East','$','USD'],
	['SY','\u{1F1F8}\u{1F1FE}','Syria','+963','Middle East','$','USD'],
	['YE','\u{1F1FE}\u{1F1EA}','Yemen','+967','Middle East','$','USD'],
	['IR','\u{1F1EE}\u{1F1F7}','Iran','+98','Middle East','$','USD'],
	['TR','\u{1F1F9}\u{1F1F7}','Turkey','+90','Middle East','$','USD'],
	['CY','\u{1F1E8}\u{1F1FE}','Cyprus','+357','Middle East','\u{20AC}','EUR'],
	// ── Europe ──
	['GB','\u{1F1EC}\u{1F1E7}','United Kingdom','+44','Europe','\u{00A3}','GBP'],
	['DE','\u{1F1E9}\u{1F1EA}','Germany','+49','Europe','\u{20AC}','EUR'],
	['FR','\u{1F1EB}\u{1F1F7}','France','+33','Europe','\u{20AC}','EUR'],
	['IT','\u{1F1EE}\u{1F1F9}','Italy','+39','Europe','\u{20AC}','EUR'],
	['ES','\u{1F1EA}\u{1F1F8}','Spain','+34','Europe','\u{20AC}','EUR'],
	['PT','\u{1F1F5}\u{1F1F9}','Portugal','+351','Europe','\u{20AC}','EUR'],
	['NL','\u{1F1F3}\u{1F1F1}','Netherlands','+31','Europe','\u{20AC}','EUR'],
	['BE','\u{1F1E7}\u{1F1EA}','Belgium','+32','Europe','\u{20AC}','EUR'],
	['AT','\u{1F1E6}\u{1F1F9}','Austria','+43','Europe','\u{20AC}','EUR'],
	['CH','\u{1F1E8}\u{1F1ED}','Switzerland','+41','Europe','\u{20AC}','EUR'],
	['SE','\u{1F1F8}\u{1F1EA}','Sweden','+46','Europe','\u{20AC}','EUR'],
	['NO','\u{1F1F3}\u{1F1F4}','Norway','+47','Europe','\u{20AC}','EUR'],
	['DK','\u{1F1E9}\u{1F1F0}','Denmark','+45','Europe','\u{20AC}','EUR'],
	['FI','\u{1F1EB}\u{1F1EE}','Finland','+358','Europe','\u{20AC}','EUR'],
	['IE','\u{1F1EE}\u{1F1EA}','Ireland','+353','Europe','\u{20AC}','EUR'],
	['PL','\u{1F1F5}\u{1F1F1}','Poland','+48','Europe','\u{20AC}','EUR'],
	['CZ','\u{1F1E8}\u{1F1FF}','Czech Republic','+420','Europe','\u{20AC}','EUR'],
	['RO','\u{1F1F7}\u{1F1F4}','Romania','+40','Europe','\u{20AC}','EUR'],
	['HU','\u{1F1ED}\u{1F1FA}','Hungary','+36','Europe','\u{20AC}','EUR'],
	['GR','\u{1F1EC}\u{1F1F7}','Greece','+30','Europe','\u{20AC}','EUR'],
	['BG','\u{1F1E7}\u{1F1EC}','Bulgaria','+359','Europe','\u{20AC}','EUR'],
	['HR','\u{1F1ED}\u{1F1F7}','Croatia','+385','Europe','\u{20AC}','EUR'],
	['SK','\u{1F1F8}\u{1F1F0}','Slovakia','+421','Europe','\u{20AC}','EUR'],
	['SI','\u{1F1F8}\u{1F1EE}','Slovenia','+386','Europe','\u{20AC}','EUR'],
	['RS','\u{1F1F7}\u{1F1F8}','Serbia','+381','Europe','\u{20AC}','EUR'],
	['BA','\u{1F1E7}\u{1F1E6}','Bosnia and Herzegovina','+387','Europe','\u{20AC}','EUR'],
	['ME','\u{1F1F2}\u{1F1EA}','Montenegro','+382','Europe','\u{20AC}','EUR'],
	['MK','\u{1F1F2}\u{1F1F0}','North Macedonia','+389','Europe','\u{20AC}','EUR'],
	['AL','\u{1F1E6}\u{1F1F1}','Albania','+355','Europe','\u{20AC}','EUR'],
	['XK','\u{1F1FD}\u{1F1F0}','Kosovo','+383','Europe','\u{20AC}','EUR'],
	['LT','\u{1F1F1}\u{1F1F9}','Lithuania','+370','Europe','\u{20AC}','EUR'],
	['LV','\u{1F1F1}\u{1F1FB}','Latvia','+371','Europe','\u{20AC}','EUR'],
	['EE','\u{1F1EA}\u{1F1EA}','Estonia','+372','Europe','\u{20AC}','EUR'],
	['UA','\u{1F1FA}\u{1F1E6}','Ukraine','+380','Europe','\u{20AC}','EUR'],
	['BY','\u{1F1E7}\u{1F1FE}','Belarus','+375','Europe','\u{20AC}','EUR'],
	['MD','\u{1F1F2}\u{1F1E9}','Moldova','+373','Europe','\u{20AC}','EUR'],
	['GE','\u{1F1EC}\u{1F1EA}','Georgia','+995','Europe','\u{20AC}','EUR'],
	['AM','\u{1F1E6}\u{1F1F2}','Armenia','+374','Europe','\u{20AC}','EUR'],
	['AZ','\u{1F1E6}\u{1F1FF}','Azerbaijan','+994','Europe','\u{20AC}','EUR'],
	['IS','\u{1F1EE}\u{1F1F8}','Iceland','+354','Europe','\u{20AC}','EUR'],
	['LU','\u{1F1F1}\u{1F1FA}','Luxembourg','+352','Europe','\u{20AC}','EUR'],
	['MT','\u{1F1F2}\u{1F1F9}','Malta','+356','Europe','\u{20AC}','EUR'],
	['MC','\u{1F1F2}\u{1F1E8}','Monaco','+377','Europe','\u{20AC}','EUR'],
	['LI','\u{1F1F1}\u{1F1EE}','Liechtenstein','+423','Europe','\u{20AC}','EUR'],
	['AD','\u{1F1E6}\u{1F1E9}','Andorra','+376','Europe','\u{20AC}','EUR'],
	['SM','\u{1F1F8}\u{1F1F2}','San Marino','+378','Europe','\u{20AC}','EUR'],
	// ── North America ──
	['US','\u{1F1FA}\u{1F1F8}','United States','+1','North America','$','USD'],
	['CA','\u{1F1E8}\u{1F1E6}','Canada','+1','North America','$','USD'],
	['MX','\u{1F1F2}\u{1F1FD}','Mexico','+52','North America','$','USD'],
	// ── Central America & Caribbean ──
	['GT','\u{1F1EC}\u{1F1F9}','Guatemala','+502','Central America & Caribbean','$','USD'],
	['HN','\u{1F1ED}\u{1F1F3}','Honduras','+504','Central America & Caribbean','$','USD'],
	['SV','\u{1F1F8}\u{1F1FB}','El Salvador','+503','Central America & Caribbean','$','USD'],
	['NI','\u{1F1F3}\u{1F1EE}','Nicaragua','+505','Central America & Caribbean','$','USD'],
	['CR','\u{1F1E8}\u{1F1F7}','Costa Rica','+506','Central America & Caribbean','$','USD'],
	['PA','\u{1F1F5}\u{1F1E6}','Panama','+507','Central America & Caribbean','$','USD'],
	['BZ','\u{1F1E7}\u{1F1FF}','Belize','+501','Central America & Caribbean','$','USD'],
	['CU','\u{1F1E8}\u{1F1FA}','Cuba','+53','Central America & Caribbean','$','USD'],
	['DO','\u{1F1E9}\u{1F1F4}','Dominican Republic','+1','Central America & Caribbean','$','USD'],
	['HT','\u{1F1ED}\u{1F1F9}','Haiti','+509','Central America & Caribbean','$','USD'],
	['JM','\u{1F1EF}\u{1F1F2}','Jamaica','+1','Central America & Caribbean','$','USD'],
	['TT','\u{1F1F9}\u{1F1F9}','Trinidad and Tobago','+1','Central America & Caribbean','$','USD'],
	['BB','\u{1F1E7}\u{1F1E7}','Barbados','+1','Central America & Caribbean','$','USD'],
	['BS','\u{1F1E7}\u{1F1F8}','Bahamas','+1','Central America & Caribbean','$','USD'],
	['PR','\u{1F1F5}\u{1F1F7}','Puerto Rico','+1','Central America & Caribbean','$','USD'],
	// ── South America ──
	['BR','\u{1F1E7}\u{1F1F7}','Brazil','+55','South America','$','USD'],
	['AR','\u{1F1E6}\u{1F1F7}','Argentina','+54','South America','$','USD'],
	['CO','\u{1F1E8}\u{1F1F4}','Colombia','+57','South America','$','USD'],
	['CL','\u{1F1E8}\u{1F1F1}','Chile','+56','South America','$','USD'],
	['PE','\u{1F1F5}\u{1F1EA}','Peru','+51','South America','$','USD'],
	['VE','\u{1F1FB}\u{1F1EA}','Venezuela','+58','South America','$','USD'],
	['EC','\u{1F1EA}\u{1F1E8}','Ecuador','+593','South America','$','USD'],
	['BO','\u{1F1E7}\u{1F1F4}','Bolivia','+591','South America','$','USD'],
	['PY','\u{1F1F5}\u{1F1FE}','Paraguay','+595','South America','$','USD'],
	['UY','\u{1F1FA}\u{1F1FE}','Uruguay','+598','South America','$','USD'],
	['GY','\u{1F1EC}\u{1F1FE}','Guyana','+592','South America','$','USD'],
	['SR','\u{1F1F8}\u{1F1F7}','Suriname','+597','South America','$','USD'],
	// ── Central Asia ──
	['KZ','\u{1F1F0}\u{1F1FF}','Kazakhstan','+7','Central Asia','$','USD'],
	['UZ','\u{1F1FA}\u{1F1FF}','Uzbekistan','+998','Central Asia','$','USD'],
	['TM','\u{1F1F9}\u{1F1F2}','Turkmenistan','+993','Central Asia','$','USD'],
	['KG','\u{1F1F0}\u{1F1EC}','Kyrgyzstan','+996','Central Asia','$','USD'],
	['TJ','\u{1F1F9}\u{1F1EF}','Tajikistan','+992','Central Asia','$','USD'],
	['AF','\u{1F1E6}\u{1F1EB}','Afghanistan','+93','Central Asia','$','USD'],
	['MN','\u{1F1F2}\u{1F1F3}','Mongolia','+976','Central Asia','$','USD'],
	// ── South Asia ──
	['IN','\u{1F1EE}\u{1F1F3}','India','+91','South Asia','$','USD'],
	['PK','\u{1F1F5}\u{1F1F0}','Pakistan','+92','South Asia','$','USD'],
	['BD','\u{1F1E7}\u{1F1E9}','Bangladesh','+880','South Asia','$','USD'],
	['LK','\u{1F1F1}\u{1F1F0}','Sri Lanka','+94','South Asia','$','USD'],
	['NP','\u{1F1F3}\u{1F1F5}','Nepal','+977','South Asia','$','USD'],
	['BT','\u{1F1E7}\u{1F1F9}','Bhutan','+975','South Asia','$','USD'],
	['MV','\u{1F1F2}\u{1F1FB}','Maldives','+960','South Asia','$','USD'],
	// ── East Asia ──
	['CN','\u{1F1E8}\u{1F1F3}','China','+86','East Asia','$','USD'],
	['JP','\u{1F1EF}\u{1F1F5}','Japan','+81','East Asia','$','USD'],
	['KR','\u{1F1F0}\u{1F1F7}','South Korea','+82','East Asia','$','USD'],
	['KP','\u{1F1F0}\u{1F1F5}','North Korea','+850','East Asia','$','USD'],
	['TW','\u{1F1F9}\u{1F1FC}','Taiwan','+886','East Asia','$','USD'],
	['HK','\u{1F1ED}\u{1F1F0}','Hong Kong','+852','East Asia','$','USD'],
	['MO','\u{1F1F2}\u{1F1F4}','Macau','+853','East Asia','$','USD'],
	// ── Southeast Asia ──
	['SG','\u{1F1F8}\u{1F1EC}','Singapore','+65','Southeast Asia','$','USD'],
	['MY','\u{1F1F2}\u{1F1FE}','Malaysia','+60','Southeast Asia','$','USD'],
	['ID','\u{1F1EE}\u{1F1E9}','Indonesia','+62','Southeast Asia','$','USD'],
	['PH','\u{1F1F5}\u{1F1ED}','Philippines','+63','Southeast Asia','$','USD'],
	['TH','\u{1F1F9}\u{1F1ED}','Thailand','+66','Southeast Asia','$','USD'],
	['VN','\u{1F1FB}\u{1F1F3}','Vietnam','+84','Southeast Asia','$','USD'],
	['MM','\u{1F1F2}\u{1F1F2}','Myanmar','+95','Southeast Asia','$','USD'],
	['KH','\u{1F1F0}\u{1F1ED}','Cambodia','+855','Southeast Asia','$','USD'],
	['LA','\u{1F1F1}\u{1F1E6}','Laos','+856','Southeast Asia','$','USD'],
	['BN','\u{1F1E7}\u{1F1F3}','Brunei','+673','Southeast Asia','$','USD'],
	['TL','\u{1F1F9}\u{1F1F1}','Timor-Leste','+670','Southeast Asia','$','USD'],
	// ── Oceania ──
	['AU','\u{1F1E6}\u{1F1FA}','Australia','+61','Oceania','$','USD'],
	['NZ','\u{1F1F3}\u{1F1FF}','New Zealand','+64','Oceania','$','USD'],
	['PG','\u{1F1F5}\u{1F1EC}','Papua New Guinea','+675','Oceania','$','USD'],
	['FJ','\u{1F1EB}\u{1F1EF}','Fiji','+679','Oceania','$','USD'],
	['WS','\u{1F1FC}\u{1F1F8}','Samoa','+685','Oceania','$','USD'],
	['TO','\u{1F1F9}\u{1F1F4}','Tonga','+676','Oceania','$','USD'],
	['VU','\u{1F1FB}\u{1F1FA}','Vanuatu','+678','Oceania','$','USD'],
	['SB','\u{1F1F8}\u{1F1E7}','Solomon Islands','+677','Oceania','$','USD'],
	['GU','\u{1F1EC}\u{1F1FA}','Guam','+1','Oceania','$','USD'],
];

const countryMap = {};
countries.forEach(c => { countryMap[c[0]] = { flag: c[1], name: c[2], phone: c[3], region: c[4], currSym: c[5], currCode: c[6] }; });

// Searchable country dropdown
(function initCountrySearch() {
	const search = document.getElementById('countrySearch');
	const hidden = document.getElementById('country');
	const dropdown = document.getElementById('countryDropdown');
	let activeIdx = -1;

	function renderDropdown(filter) {
		dropdown.innerHTML = '';
		const q = (filter || '').toLowerCase().trim();
		const regions = {};
		countries.forEach(c => { (regions[c[4]] = regions[c[4]] || []).push(c); });

		let items = [];
		for (const region in regions) {
			const matches = regions[region].filter(c =>
				!q || c[2].toLowerCase().includes(q) || c[0].toLowerCase() === q || c[3].includes(q)
			);
			if (matches.length === 0) continue;
			const grp = document.createElement('div');
			grp.className = 'cd-group';
			grp.textContent = region;
			dropdown.appendChild(grp);
			matches.forEach(c => {
				const item = document.createElement('div');
				item.className = 'cd-item';
				item.dataset.code = c[0];
				item.textContent = c[1] + ' ' + c[2] + '  ' + c[3];
				item.addEventListener('mousedown', e => {
					e.preventDefault();
					selectCountry(c[0]);
				});
				dropdown.appendChild(item);
				items.push(item);
			});
		}
		if (items.length === 0) {
			const empty = document.createElement('div');
			empty.className = 'cd-empty';
			empty.textContent = 'No countries found';
			dropdown.appendChild(empty);
		}
		activeIdx = -1;
		return items;
	}

	function selectCountry(code) {
		const c = countryMap[code];
		if (!c) return;
		hidden.value = code;
		search.value = c.flag + ' ' + c.name;
		search.classList.add('country-selected');
		dropdown.classList.remove('show');
		onCountryChange();
	}

	search.addEventListener('focus', function() {
		if (hidden.value) {
			// Clear to show all options, let user re-search
			this.select();
		}
		renderDropdown(this.value === (countryMap[hidden.value]?.flag + ' ' + countryMap[hidden.value]?.name) ? '' : this.value);
		dropdown.classList.add('show');
	});

	search.addEventListener('input', function() {
		search.classList.remove('country-selected');
		hidden.value = '';
		renderDropdown(this.value);
		dropdown.classList.add('show');
	});

	search.addEventListener('blur', function() {
		setTimeout(() => {
			dropdown.classList.remove('show');
			// Restore selection if user blurred without picking
			if (!hidden.value && search.value) {
				// Try exact match
				const q = search.value.toLowerCase().trim();
				const match = countries.find(c => c[2].toLowerCase() === q);
				if (match) {
					selectCountry(match[0]);
				} else {
					search.value = '';
				}
			}
		}, 200);
	});

	search.addEventListener('keydown', function(e) {
		const items = dropdown.querySelectorAll('.cd-item');
		if (!items.length) return;

		if (e.key === 'ArrowDown') {
			e.preventDefault();
			activeIdx = Math.min(activeIdx + 1, items.length - 1);
			items.forEach((el, i) => el.classList.toggle('cd-active', i === activeIdx));
			items[activeIdx]?.scrollIntoView({ block: 'nearest' });
		} else if (e.key === 'ArrowUp') {
			e.preventDefault();
			activeIdx = Math.max(activeIdx - 1, 0);
			items.forEach((el, i) => el.classList.toggle('cd-active', i === activeIdx));
			items[activeIdx]?.scrollIntoView({ block: 'nearest' });
		} else if (e.key === 'Enter') {
			e.preventDefault();
			if (activeIdx >= 0 && items[activeIdx]) {
				selectCountry(items[activeIdx].dataset.code);
			}
		} else if (e.key === 'Escape') {
			dropdown.classList.remove('show');
			search.blur();
		}
	});

	// Expose for programmatic selection
	window.selectCountry = selectCountry;
})();

// Major cities per country (datalist suggestions — user can always type their own)
const citiesByCountry = {
	// East Africa
	KE: ['Nairobi','Mombasa','Kisumu','Nakuru','Eldoret','Thika','Malindi','Nanyuki','Nyeri','Machakos','Kitale','Garissa','Lamu'],
	UG: ['Kampala','Entebbe','Jinja','Gulu','Mbarara','Lira','Mbale','Fort Portal'],
	TZ: ['Dar es Salaam','Dodoma','Arusha','Mwanza','Zanzibar City','Mbeya','Tanga','Morogoro'],
	RW: ['Kigali','Butare','Gisenyi','Ruhengeri','Gitarama','Byumba'],
	BI: ['Bujumbura','Gitega','Ngozi','Rumonge'],
	ET: ['Addis Ababa','Dire Dawa','Mekelle','Gondar','Hawassa','Bahir Dar','Jimma'],
	ER: ['Asmara','Keren','Massawa'],
	DJ: ['Djibouti City','Ali Sabieh'],
	SO: ['Mogadishu','Hargeisa','Kismayo','Berbera','Garowe','Bosaso'],
	SS: ['Juba','Malakal','Wau','Bor','Rumbek'],
	SD: ['Khartoum','Omdurman','Port Sudan','Kassala','Nyala'],
	// West Africa
	NG: ['Lagos','Abuja','Port Harcourt','Kano','Ibadan','Benin City','Enugu','Kaduna'],
	GH: ['Accra','Kumasi','Tamale','Takoradi','Tema','Cape Coast'],
	SN: ['Dakar','Thies','Saint-Louis','Ziguinchor','Kaolack'],
	CI: ['Abidjan','Bouake','Yamoussoukro','Daloa','San Pedro'],
	CM: ['Douala','Yaounde','Bamenda','Bafoussam','Garoua','Maroua'],
	ML: ['Bamako','Timbuktu','Sikasso','Mopti'],
	BF: ['Ouagadougou','Bobo-Dioulasso'],
	NE: ['Niamey','Zinder','Maradi'],
	GN: ['Conakry','Kankan','Labe'],
	BJ: ['Cotonou','Porto-Novo','Parakou'],
	TG: ['Lome','Sokode','Kara'],
	SL: ['Freetown','Bo','Kenema'],
	LR: ['Monrovia','Gbarnga'],
	GA: ['Libreville','Port-Gentil'],
	TD: ['N\'Djamena','Moundou'],
	CF: ['Bangui','Bimbo'],
	CG: ['Brazzaville','Pointe-Noire'],
	// Southern Africa
	ZA: ['Johannesburg','Cape Town','Durban','Pretoria','Soweto','Port Elizabeth','Bloemfontein'],
	CD: ['Kinshasa','Lubumbashi','Mbuji-Mayi','Kisangani','Goma','Bukavu'],
	AO: ['Luanda','Huambo','Lobito','Benguela'],
	MZ: ['Maputo','Beira','Nampula','Quelimane'],
	ZM: ['Lusaka','Kitwe','Ndola','Livingstone','Kabwe'],
	ZW: ['Harare','Bulawayo','Chitungwiza','Mutare','Gweru','Masvingo'],
	MW: ['Lilongwe','Blantyre','Mzuzu','Zomba'],
	BW: ['Gaborone','Francistown','Maun'],
	NA: ['Windhoek','Walvis Bay','Swakopmund'],
	MG: ['Antananarivo','Toamasina','Antsirabe','Fianarantsoa'],
	MU: ['Port Louis','Curepipe','Vacoas'],
	SC: ['Victoria'],
	LS: ['Maseru'],
	SZ: ['Mbabane','Manzini'],
	// North Africa
	EG: ['Cairo','Alexandria','Giza','Sharm El Sheikh','Luxor','Aswan','Hurghada'],
	MA: ['Casablanca','Rabat','Marrakech','Fez','Tangier','Agadir'],
	DZ: ['Algiers','Oran','Constantine','Annaba'],
	TN: ['Tunis','Sfax','Sousse','Kairouan'],
	LY: ['Tripoli','Benghazi','Misrata'],
	// Middle East
	AE: ['Dubai','Abu Dhabi','Sharjah','Ajman','Ras Al Khaimah','Al Ain'],
	SA: ['Riyadh','Jeddah','Mecca','Medina','Dammam','Khobar'],
	QA: ['Doha','Al Wakrah','Al Khor'],
	KW: ['Kuwait City','Hawalli','Salmiya'],
	BH: ['Manama','Riffa','Muharraq'],
	OM: ['Muscat','Salalah','Sohar'],
	JO: ['Amman','Zarqa','Irbid','Aqaba'],
	LB: ['Beirut','Tripoli','Sidon','Jounieh'],
	IQ: ['Baghdad','Basra','Erbil','Mosul','Sulaymaniyah'],
	IL: ['Tel Aviv','Jerusalem','Haifa','Beer Sheva'],
	TR: ['Istanbul','Ankara','Izmir','Antalya','Bursa'],
	IR: ['Tehran','Isfahan','Mashhad','Tabriz','Shiraz'],
	SY: ['Damascus','Aleppo','Homs','Latakia'],
	YE: ['Sanaa','Aden','Taiz'],
	CY: ['Nicosia','Limassol','Larnaca','Paphos'],
	// Europe
	GB: ['London','Manchester','Birmingham','Edinburgh','Glasgow','Leeds','Liverpool','Bristol','Cardiff','Belfast'],
	DE: ['Berlin','Munich','Frankfurt','Hamburg','Cologne','Stuttgart','Dusseldorf','Leipzig'],
	FR: ['Paris','Lyon','Marseille','Toulouse','Nice','Bordeaux','Strasbourg','Lille','Nantes'],
	IT: ['Rome','Milan','Naples','Turin','Florence','Venice','Bologna','Palermo','Genoa'],
	ES: ['Madrid','Barcelona','Valencia','Seville','Bilbao','Malaga','Zaragoza'],
	PT: ['Lisbon','Porto','Braga','Faro'],
	NL: ['Amsterdam','Rotterdam','The Hague','Utrecht','Eindhoven','Groningen'],
	BE: ['Brussels','Antwerp','Ghent','Bruges','Liege'],
	AT: ['Vienna','Salzburg','Innsbruck','Graz','Linz'],
	CH: ['Zurich','Geneva','Bern','Basel','Lausanne','Lucerne'],
	SE: ['Stockholm','Gothenburg','Malmo','Uppsala'],
	NO: ['Oslo','Bergen','Trondheim','Stavanger'],
	DK: ['Copenhagen','Aarhus','Odense','Aalborg'],
	FI: ['Helsinki','Espoo','Tampere','Turku'],
	IE: ['Dublin','Cork','Galway','Limerick'],
	PL: ['Warsaw','Krakow','Wroclaw','Gdansk','Poznan','Lodz'],
	CZ: ['Prague','Brno','Ostrava','Plzen'],
	RO: ['Bucharest','Cluj-Napoca','Timisoara','Iasi','Brasov'],
	HU: ['Budapest','Debrecen','Szeged','Pecs'],
	GR: ['Athens','Thessaloniki','Patras','Heraklion'],
	UA: ['Kyiv','Kharkiv','Odesa','Lviv','Dnipro'],
	RS: ['Belgrade','Novi Sad','Nis'],
	HR: ['Zagreb','Split','Rijeka','Dubrovnik'],
	BG: ['Sofia','Plovdiv','Varna','Burgas'],
	SK: ['Bratislava','Kosice'],
	SI: ['Ljubljana','Maribor'],
	BA: ['Sarajevo','Banja Luka','Mostar'],
	AL: ['Tirana','Durres','Vlore'],
	LT: ['Vilnius','Kaunas','Klaipeda'],
	LV: ['Riga','Daugavpils','Liepaja'],
	EE: ['Tallinn','Tartu'],
	GE: ['Tbilisi','Batumi','Kutaisi'],
	AM: ['Yerevan','Gyumri'],
	AZ: ['Baku','Ganja','Sumgait'],
	IS: ['Reykjavik'],
	LU: ['Luxembourg City'],
	MT: ['Valletta','Sliema'],
	BY: ['Minsk','Gomel','Mogilev'],
	MD: ['Chisinau','Tiraspol','Balti'],
	// North America
	US: ['New York','Los Angeles','Chicago','Houston','Phoenix','San Francisco','Seattle','Austin','Miami','Denver','Atlanta','Dallas','Boston','Washington DC'],
	CA: ['Toronto','Vancouver','Montreal','Calgary','Ottawa','Edmonton','Winnipeg','Halifax'],
	MX: ['Mexico City','Guadalajara','Monterrey','Cancun','Puebla','Tijuana','Leon'],
	// Central America & Caribbean
	GT: ['Guatemala City','Antigua'],
	HN: ['Tegucigalpa','San Pedro Sula'],
	SV: ['San Salvador'],
	NI: ['Managua','Leon'],
	CR: ['San Jose','Heredia','Alajuela'],
	PA: ['Panama City','Colon','David'],
	CU: ['Havana','Santiago de Cuba','Camaguey'],
	DO: ['Santo Domingo','Santiago','Punta Cana'],
	JM: ['Kingston','Montego Bay'],
	TT: ['Port of Spain','San Fernando'],
	// South America
	BR: ['Sao Paulo','Rio de Janeiro','Brasilia','Salvador','Belo Horizonte','Curitiba','Fortaleza','Recife','Manaus'],
	AR: ['Buenos Aires','Cordoba','Rosario','Mendoza','Mar del Plata','Tucuman'],
	CO: ['Bogota','Medellin','Cali','Barranquilla','Cartagena','Bucaramanga'],
	CL: ['Santiago','Valparaiso','Concepcion','Antofagasta','Temuco'],
	PE: ['Lima','Arequipa','Cusco','Trujillo','Chiclayo'],
	VE: ['Caracas','Maracaibo','Valencia','Barquisimeto'],
	EC: ['Quito','Guayaquil','Cuenca'],
	BO: ['La Paz','Santa Cruz','Cochabamba','Sucre'],
	PY: ['Asuncion','Ciudad del Este','Encarnacion'],
	UY: ['Montevideo','Punta del Este','Salto'],
	GY: ['Georgetown','Linden'],
	SR: ['Paramaribo'],
	// Central Asia
	KZ: ['Almaty','Astana','Shymkent','Karaganda'],
	UZ: ['Tashkent','Samarkand','Bukhara','Namangan'],
	KG: ['Bishkek','Osh'],
	TJ: ['Dushanbe','Khujand'],
	TM: ['Ashgabat','Turkmenabat'],
	AF: ['Kabul','Herat','Kandahar','Mazar-i-Sharif'],
	MN: ['Ulaanbaatar','Erdenet','Darkhan'],
	// South Asia
	IN: ['Mumbai','Delhi','Bangalore','Hyderabad','Chennai','Kolkata','Pune','Ahmedabad','Jaipur','Lucknow'],
	PK: ['Karachi','Lahore','Islamabad','Rawalpindi','Faisalabad','Peshawar'],
	BD: ['Dhaka','Chittagong','Khulna','Sylhet','Rajshahi'],
	LK: ['Colombo','Kandy','Galle','Jaffna'],
	NP: ['Kathmandu','Pokhara','Lalitpur','Biratnagar'],
	MV: ['Male'],
	BT: ['Thimphu','Paro'],
	// East Asia
	CN: ['Shanghai','Beijing','Shenzhen','Guangzhou','Chengdu','Hangzhou','Wuhan','Nanjing','Chongqing','Xi\'an'],
	JP: ['Tokyo','Osaka','Kyoto','Yokohama','Nagoya','Fukuoka','Sapporo','Kobe'],
	KR: ['Seoul','Busan','Incheon','Daegu','Daejeon','Gwangju'],
	TW: ['Taipei','Kaohsiung','Taichung','Tainan'],
	HK: ['Hong Kong','Kowloon'],
	// Southeast Asia
	SG: ['Singapore'],
	MY: ['Kuala Lumpur','George Town','Johor Bahru','Kota Kinabalu','Ipoh','Malacca'],
	ID: ['Jakarta','Surabaya','Bandung','Medan','Bali','Yogyakarta','Semarang'],
	PH: ['Manila','Cebu City','Davao','Quezon City','Makati'],
	TH: ['Bangkok','Chiang Mai','Pattaya','Phuket','Nonthaburi'],
	VN: ['Ho Chi Minh City','Hanoi','Da Nang','Hai Phong','Nha Trang'],
	MM: ['Yangon','Mandalay','Naypyidaw'],
	KH: ['Phnom Penh','Siem Reap','Battambang'],
	LA: ['Vientiane','Luang Prabang'],
	BN: ['Bandar Seri Begawan'],
	// Oceania
	AU: ['Sydney','Melbourne','Brisbane','Perth','Adelaide','Canberra','Gold Coast','Darwin','Hobart'],
	NZ: ['Auckland','Wellington','Christchurch','Hamilton','Queenstown'],
	PG: ['Port Moresby','Lae'],
	FJ: ['Suva','Nadi','Lautoka'],
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
	const addressField = document.getElementById('addressField');
	const companyNameInput = document.getElementById('company_name');
	const industrySelect = document.getElementById('industry');

	if (clientType === 'company') {
		companyNameField.style.display = 'block';
		industryField.style.display = 'block';
		addressField.style.display = 'block';
		companyNameInput.setAttribute('required', 'required');
		industrySelect.setAttribute('required', 'required');
	} else {
		companyNameField.style.display = 'none';
		industryField.style.display = 'none';
		addressField.style.display = 'none';
		companyNameInput.removeAttribute('required');
		industrySelect.removeAttribute('required');
		companyNameInput.value = '';
		industrySelect.value = '';
		document.getElementById('address').value = '';
	}
}

// Default to Kenya
selectCountry('KE');

// Validate country is selected before submit
document.getElementById('hireForm').addEventListener('submit', function(e) {
	if (!document.getElementById('country').value) {
		e.preventDefault();
		document.getElementById('countrySearch').focus();
		document.getElementById('countrySearch').classList.add('is-invalid');
		return false;
	}
});
</script>
