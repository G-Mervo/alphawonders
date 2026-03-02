<?php defined('FCPATH') OR exit('No direct script access allowed'); ?>

<?php
$daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, $year);
$firstDayOfWeek = date('w', mktime(0, 0, 0, $month, 1, $year));
$monthName = date('F', mktime(0, 0, 0, $month, 1, $year));

$prevMonth = $month - 1;
$prevYear = $year;
if ($prevMonth < 1) { $prevMonth = 12; $prevYear--; }
$nextMonth = $month + 1;
$nextYear = $year;
if ($nextMonth > 12) { $nextMonth = 1; $nextYear++; }

// Group events by date
$eventsByDate = [];
foreach ($events as $ev) {
    $eventsByDate[$ev['date']][] = $ev;
}
?>

<div class="d-flex justify-content-between align-items-center mb-4">
	<h3 class="fw-bold mb-0">Content Calendar</h3>
	<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addEventModal">
		<i class="fa-solid fa-plus me-1"></i> Add Event
	</button>
</div>

<?php if (session()->getFlashdata('success')): ?>
	<div class="alert alert-success alert-dismissible fade show" role="alert">
		<?= session()->getFlashdata('success'); ?>
		<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
	</div>
<?php endif; ?>

<!-- Legend -->
<div class="d-flex gap-3 mb-3">
	<span><span class="badge" style="background:#3788d8">&nbsp;&nbsp;</span> Blog</span>
	<span><span class="badge" style="background:#28a745">&nbsp;&nbsp;</span> Social</span>
	<span><span class="badge" style="background:#ff9800">&nbsp;&nbsp;</span> Campaign</span>
</div>

<div class="row g-4">
	<!-- Calendar Grid -->
	<div class="col-lg-9">
		<div class="card border-0 shadow-sm">
			<div class="card-header bg-white d-flex justify-content-between align-items-center">
				<a href="<?= base_url('aw-cp/calendar?year=' . $prevYear . '&month=' . $prevMonth); ?>" class="btn btn-sm btn-outline-secondary">
					<i class="fa-solid fa-chevron-left"></i>
				</a>
				<h5 class="mb-0 fw-bold"><?= $monthName; ?> <?= $year; ?></h5>
				<a href="<?= base_url('aw-cp/calendar?year=' . $nextYear . '&month=' . $nextMonth); ?>" class="btn btn-sm btn-outline-secondary">
					<i class="fa-solid fa-chevron-right"></i>
				</a>
			</div>
			<div class="card-body p-0">
				<table class="table table-bordered mb-0" style="table-layout:fixed">
					<thead class="table-light">
						<tr>
							<th class="text-center py-2">Sun</th>
							<th class="text-center py-2">Mon</th>
							<th class="text-center py-2">Tue</th>
							<th class="text-center py-2">Wed</th>
							<th class="text-center py-2">Thu</th>
							<th class="text-center py-2">Fri</th>
							<th class="text-center py-2">Sat</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$dayCounter = 1;
						$today = date('Y-m-d');
						$totalCells = ceil(($firstDayOfWeek + $daysInMonth) / 7) * 7;

						for ($i = 0; $i < $totalCells; $i++):
							if ($i % 7 === 0) echo '<tr>';

							if ($i < $firstDayOfWeek || $dayCounter > $daysInMonth):
								echo '<td class="bg-light" style="height:100px"></td>';
							else:
								$dateStr = sprintf('%04d-%02d-%02d', $year, $month, $dayCounter);
								$isToday = $dateStr === $today;
								$dayEvents = $eventsByDate[$dateStr] ?? [];
						?>
								<td style="height:100px;vertical-align:top;<?= $isToday ? 'background:#e3f2fd;' : ''; ?>">
									<div class="d-flex justify-content-between">
										<span class="<?= $isToday ? 'badge bg-primary rounded-pill' : 'small text-muted'; ?>"><?= $dayCounter; ?></span>
									</div>
									<?php foreach (array_slice($dayEvents, 0, 3) as $de): ?>
										<div class="small text-truncate mt-1 px-1 rounded" style="background:<?= esc($de['color']); ?>20;border-left:3px solid <?= esc($de['color']); ?>;font-size:0.7rem" title="<?= esc($de['title']); ?>">
											<?php if ($de['time']): ?><span class="fw-bold"><?= $de['time']; ?></span> <?php endif; ?>
											<?= esc(mb_substr($de['title'], 0, 20)); ?>
										</div>
									<?php endforeach; ?>
									<?php if (count($dayEvents) > 3): ?>
										<div class="small text-muted text-center" style="font-size:0.65rem">+<?= count($dayEvents) - 3; ?> more</div>
									<?php endif; ?>
								</td>
						<?php
								$dayCounter++;
							endif;

							if ($i % 7 === 6) echo '</tr>';
						endfor;
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>

	<!-- Sidebar: Upcoming -->
	<div class="col-lg-3">
		<div class="card border-0 shadow-sm">
			<div class="card-header bg-white fw-semibold">
				<i class="fa-solid fa-clock me-2"></i>Upcoming
			</div>
			<div class="card-body p-0">
				<?php if (!empty($upcoming)): ?>
					<div class="list-group list-group-flush">
						<?php foreach ($upcoming as $up): ?>
							<div class="list-group-item px-3 py-2">
								<div class="d-flex align-items-center gap-2">
									<span class="rounded" style="width:10px;height:10px;background:<?= esc($up['color']); ?>;display:inline-block"></span>
									<div class="flex-grow-1">
										<div class="small fw-semibold text-truncate"><?= esc($up['title']); ?></div>
										<div style="font-size:0.7rem" class="text-muted">
											<?= date('M d', strtotime($up['scheduled_date'])); ?>
											<?= $up['scheduled_time'] ? 'at ' . $up['scheduled_time'] : ''; ?>
										</div>
									</div>
									<span class="badge bg-<?= $up['content_type'] === 'blog' ? 'primary' : ($up['content_type'] === 'social' ? 'success' : 'warning'); ?> text-white" style="font-size:0.6rem"><?= $up['content_type']; ?></span>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
				<?php else: ?>
					<div class="text-center py-3 text-muted small">No upcoming events.</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>

<!-- Add Event Modal -->
<div class="modal fade" id="addEventModal" tabindex="-1">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title"><i class="fa-solid fa-calendar-plus me-2"></i>Add Calendar Event</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
			</div>
			<div class="modal-body">
				<div class="mb-3">
					<label class="form-label">Title <span class="text-danger">*</span></label>
					<input type="text" class="form-control" id="event_title" required>
				</div>
				<div class="row g-3">
					<div class="col-md-6">
						<label class="form-label">Date <span class="text-danger">*</span></label>
						<input type="date" class="form-control" id="event_date" required>
					</div>
					<div class="col-md-6">
						<label class="form-label">Time</label>
						<input type="time" class="form-control" id="event_time">
					</div>
				</div>
				<div class="row g-3 mt-1">
					<div class="col-md-6">
						<label class="form-label">Type</label>
						<select class="form-select" id="event_type">
							<option value="campaign">Campaign</option>
							<option value="blog">Blog</option>
							<option value="social">Social</option>
						</select>
					</div>
					<div class="col-md-6">
						<label class="form-label">Color</label>
						<input type="color" class="form-control form-control-color w-100" id="event_color" value="#ff9800">
					</div>
				</div>
				<div class="mt-3">
					<label class="form-label">Notes</label>
					<textarea class="form-control" id="event_notes" rows="2"></textarea>
				</div>
				<div id="event_error" class="alert alert-danger mt-3 d-none"></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
				<button type="button" class="btn btn-primary btn-sm" id="saveEventBtn">
					<span class="spinner-border spinner-border-sm d-none me-1" id="saveEventSpinner"></span>
					Save Event
				</button>
			</div>
		</div>
	</div>
</div>

<script>
document.getElementById('saveEventBtn')?.addEventListener('click', function() {
	const title = document.getElementById('event_title').value.trim();
	const date = document.getElementById('event_date').value;
	const time = document.getElementById('event_time').value;
	const type = document.getElementById('event_type').value;
	const color = document.getElementById('event_color').value;
	const notes = document.getElementById('event_notes').value;
	const errorEl = document.getElementById('event_error');
	const spinner = document.getElementById('saveEventSpinner');

	if (!title || !date) {
		errorEl.textContent = 'Title and date are required.';
		errorEl.classList.remove('d-none');
		return;
	}

	errorEl.classList.add('d-none');
	spinner.classList.remove('d-none');
	this.disabled = true;

	const body = 'title=' + encodeURIComponent(title) +
		'&scheduled_date=' + encodeURIComponent(date) +
		'&scheduled_time=' + encodeURIComponent(time) +
		'&content_type=' + encodeURIComponent(type) +
		'&color=' + encodeURIComponent(color) +
		'&notes=' + encodeURIComponent(notes);

	fetch('<?= base_url('aw-cp/calendar/add'); ?>', {
		method: 'POST',
		headers: {'Content-Type': 'application/x-www-form-urlencoded', 'X-Requested-With': 'XMLHttpRequest'},
		body: body
	})
	.then(r => r.json())
	.then(data => {
		if (data.success) {
			bootstrap.Modal.getInstance(document.getElementById('addEventModal')).hide();
			location.reload();
		} else {
			errorEl.textContent = data.error || 'Failed to save event.';
			errorEl.classList.remove('d-none');
		}
	})
	.catch(() => {
		errorEl.textContent = 'Network error.';
		errorEl.classList.remove('d-none');
	})
	.finally(() => {
		spinner.classList.add('d-none');
		this.disabled = false;
	});
});
</script>
