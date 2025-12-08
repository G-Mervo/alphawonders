<?php defined('FCPATH') OR exit('No direct script access allowed'); ?>

<!-- Hire Hero Section -->
<section class="py-5 bg-primary text-white" style="background: linear-gradient(135deg, #041640 0%, #0a2a5a 100%); margin-top: 0; padding: 5rem 0;">
	<div class="container">
		<div class="row justify-content-center text-center">
			<div class="col-lg-8">
				<span class="badge bg-warning text-dark px-3 py-2 mb-3 d-inline-block rounded-pill fw-bold">Hire Us</span>
				<h1 class="display-4 fw-bold mb-3">Hire Skilled Professionals</h1>
				<p class="lead mb-0">Do you have a job, a vacant post, or require a contractor in your company? Hire us today and get access to skilled and qualified professionals & technicians.</p>
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
						<p class="text-muted">Fill out the form below and we'll get back to you as soon as possible</p>
					</div>

					<form action="<?php echo base_url('hire-submit'); ?>" method="POST" class="row g-4" id="hireForm">
						<!-- Personal Information -->
						<div class="col-12">
							<h5 class="fw-bold text-primary mb-3">
								<i class="fas fa-user-circle me-2"></i>Personal Information
							</h5>
						</div>

						<div class="col-md-6">
							<label for="name" class="form-label fw-bold">
								<i class="fas fa-user text-primary me-2"></i>Full Name <span class="text-danger">*</span>
							</label>
							<input type="text" class="form-control form-control-lg" id="name" name="name" placeholder="Your full name" required style="border-radius: 10px;">
						</div>

						<div class="col-md-6">
							<label for="email" class="form-label fw-bold">
								<i class="fas fa-envelope text-primary me-2"></i>Email Address <span class="text-danger">*</span>
							</label>
							<input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="your.email@example.com" required style="border-radius: 10px;">
						</div>

						<div class="col-md-4">
							<label for="telno" class="form-label fw-bold">
								<i class="fas fa-phone text-primary me-2"></i>Telephone No. <span class="text-danger">*</span>
							</label>
							<input type="tel" class="form-control form-control-lg" id="telno" name="telno" placeholder="+254 700 000 000" required style="border-radius: 10px;">
						</div>

						<div class="col-md-4">
							<label for="whts" class="form-label fw-bold">
								<i class="fab fa-whatsapp text-success me-2"></i>WhatsApp No.
							</label>
							<input type="text" class="form-control form-control-lg" id="whts" name="whts" placeholder="+254 700 000 000" style="border-radius: 10px;">
						</div>

						<div class="col-md-4">
							<label for="sky" class="form-label fw-bold">
								<i class="fab fa-skype text-primary me-2"></i>Skype ID
							</label>
							<input type="text" class="form-control form-control-lg" id="sky" name="sky" placeholder="your.skype.id" style="border-radius: 10px;">
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

						<div class="col-md-6">
							<label for="loc" class="form-label fw-bold">
								<i class="fas fa-map-marker-alt text-primary me-2"></i>Location <span class="text-danger">*</span>
							</label>
							<input type="text" class="form-control form-control-lg" id="loc" name="loc" placeholder="City, Country" required style="border-radius: 10px;">
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
							<input type="text" class="form-control form-control-lg" id="budget" name="budget" placeholder="KSh 200,000 or USD 2,000" required style="border-radius: 10px;">
							<small class="text-muted">Enter amount in your preferred currency</small>
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
</style>

<script>
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
</script>
