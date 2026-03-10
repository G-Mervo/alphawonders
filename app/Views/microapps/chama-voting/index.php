<?php defined('FCPATH') OR exit('No direct script access allowed'); ?>

<style>
    .chama-app .nav-tabs .nav-link { font-weight: 500; }
    .chama-app .nav-tabs .nav-link.active { border-bottom: 3px solid #0d6efd; }
    .chama-app .stat-card { border-left: 4px solid; }
    .chama-app .stat-card.blue { border-left-color: #0d6efd; }
    .chama-app .stat-card.green { border-left-color: #198754; }
    .chama-app .stat-card.orange { border-left-color: #fd7e14; }
    .chama-app .stat-card.red { border-left-color: #dc3545; }
    .chama-app .bar-chart-bar {
        height: 24px;
        border-radius: 4px;
        transition: width 0.5s ease;
        min-width: 2px;
    }
    .chama-app .bar-chart-row { margin-bottom: 8px; }
    .chama-app .vote-card { border-left: 4px solid #6f42c1; }
    .chama-app .vote-option-btn { cursor: pointer; transition: all 0.2s; }
    .chama-app .vote-option-btn:hover { transform: translateX(4px); }
    .chama-app .vote-option-btn.voted { background-color: #e8f5e9; border-color: #198754; }
    .chama-app .badge-active { background-color: #198754; }
    .chama-app .badge-inactive { background-color: #6c757d; }
    .chama-app .badge-paid { background-color: #198754; }
    .chama-app .badge-pending { background-color: #fd7e14; }
    .chama-app .contribution-summary {
        background: linear-gradient(135deg, #0d6efd 0%, #6f42c1 100%);
        color: #fff;
        border-radius: 12px;
    }
    .chama-app .member-avatar {
        width: 40px; height: 40px;
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        font-weight: 700; color: #fff; font-size: 16px;
    }
    .chama-app .deadline-badge { font-size: 0.75rem; }
    .chama-app .empty-state { padding: 48px 16px; text-align: center; color: #6c757d; }
    .chama-app .empty-state i { font-size: 3rem; margin-bottom: 12px; display: block; opacity: 0.4; }
</style>

<div class="chama-app">
    <!-- Header -->
    <div class="d-flex flex-wrap justify-content-between align-items-start mb-4">
        <div>
            <h2 class="mb-1"><i class="fas fa-users-cog me-2 text-primary"></i>Chama Voting System</h2>
            <p class="text-muted mb-0">Manage your investment group members, run votes, and track contributions. <span class="badge bg-info">Demo &mdash; data stored in browser</span></p>
        </div>
        <button class="btn btn-outline-danger btn-sm mt-2" onclick="ChamaApp.resetDemo()"><i class="fas fa-redo me-1"></i>Reset Demo</button>
    </div>

    <!-- Stats row -->
    <div class="row g-3 mb-4" id="stats-row"></div>

    <!-- Tabs -->
    <ul class="nav nav-tabs mb-4" role="tablist">
        <li class="nav-item">
            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-members" type="button"><i class="fas fa-users me-1"></i>Members</button>
        </li>
        <li class="nav-item">
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-voting" type="button"><i class="fas fa-vote-yea me-1"></i>Voting</button>
        </li>
        <li class="nav-item">
            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-contributions" type="button"><i class="fas fa-hand-holding-usd me-1"></i>Contributions</button>
        </li>
    </ul>

    <div class="tab-content">

        <!-- ==================== MEMBERS TAB ==================== -->
        <div class="tab-pane fade show active" id="tab-members">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0">Group Members</h5>
                <button class="btn btn-primary btn-sm" onclick="ChamaApp.showMemberForm()"><i class="fas fa-plus me-1"></i>Add Member</button>
            </div>

            <!-- Add/Edit member form (hidden by default) -->
            <div class="card mb-3 d-none" id="member-form-card">
                <div class="card-body">
                    <h6 class="card-title" id="member-form-title">Add New Member</h6>
                    <form id="member-form" onsubmit="ChamaApp.saveMember(event)">
                        <input type="hidden" id="member-edit-id" value="">
                        <div class="row g-2">
                            <div class="col-md-3">
                                <label class="form-label">Full Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="member-name" required>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Role</label>
                                <select class="form-select form-select-sm" id="member-role">
                                    <option value="Member">Member</option>
                                    <option value="Chairman">Chairman</option>
                                    <option value="Treasurer">Treasurer</option>
                                    <option value="Secretary">Secretary</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Monthly Contribution</label>
                                <input type="number" class="form-control form-control-sm" id="member-contribution" value="5000" min="0" step="100">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Status</label>
                                <select class="form-select form-select-sm" id="member-status">
                                    <option value="Active">Active</option>
                                    <option value="Inactive">Inactive</option>
                                </select>
                            </div>
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-save me-1"></i>Save</button>
                            <button type="button" class="btn btn-secondary btn-sm" onclick="ChamaApp.hideMemberForm()">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width:40px"></th>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Monthly Contribution</th>
                            <th>Status</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="members-tbody"></tbody>
                </table>
            </div>
            <div class="empty-state d-none" id="members-empty">
                <i class="fas fa-user-friends"></i>
                <p>No members yet. Add your first member to get started.</p>
            </div>
        </div>

        <!-- ==================== VOTING TAB ==================== -->
        <div class="tab-pane fade" id="tab-voting">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="mb-0">Voting Sessions</h5>
                <button class="btn btn-primary btn-sm" onclick="ChamaApp.showVoteForm()"><i class="fas fa-plus me-1"></i>Create Vote</button>
            </div>

            <!-- Create vote form (hidden by default) -->
            <div class="card mb-3 d-none" id="vote-form-card">
                <div class="card-body">
                    <h6 class="card-title">Create New Vote</h6>
                    <form id="vote-form" onsubmit="ChamaApp.saveVote(event)">
                        <div class="row g-2">
                            <div class="col-md-6">
                                <label class="form-label">Topic <span class="text-danger">*</span></label>
                                <input type="text" class="form-control form-control-sm" id="vote-topic" required placeholder="e.g. Investment in Treasury Bonds">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label">Deadline</label>
                                <input type="date" class="form-control form-control-sm" id="vote-deadline">
                            </div>
                        </div>
                        <div class="mt-2">
                            <label class="form-label">Options (2-4)</label>
                            <div id="vote-options-inputs">
                                <div class="input-group input-group-sm mb-1">
                                    <span class="input-group-text">1</span>
                                    <input type="text" class="form-control vote-option-input" required placeholder="Option 1">
                                </div>
                                <div class="input-group input-group-sm mb-1">
                                    <span class="input-group-text">2</span>
                                    <input type="text" class="form-control vote-option-input" required placeholder="Option 2">
                                </div>
                            </div>
                            <button type="button" class="btn btn-outline-secondary btn-sm mt-1" onclick="ChamaApp.addVoteOption()"><i class="fas fa-plus me-1"></i>Add Option</button>
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-success btn-sm"><i class="fas fa-check me-1"></i>Create Vote</button>
                            <button type="button" class="btn btn-secondary btn-sm" onclick="ChamaApp.hideVoteForm()">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>

            <div id="votes-container"></div>
            <div class="empty-state d-none" id="votes-empty">
                <i class="fas fa-poll"></i>
                <p>No voting sessions yet. Create one to start collecting votes.</p>
            </div>
        </div>

        <!-- ==================== CONTRIBUTIONS TAB ==================== -->
        <div class="tab-pane fade" id="tab-contributions">
            <h5 class="mb-3">Contributions Tracker</h5>

            <!-- Summary card -->
            <div class="contribution-summary p-4 mb-4" id="contribution-summary"></div>

            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Member</th>
                            <th>Month</th>
                            <th>Amount (KES)</th>
                            <th>Status</th>
                            <th class="text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody id="contributions-tbody"></tbody>
                </table>
            </div>
            <div class="empty-state d-none" id="contributions-empty">
                <i class="fas fa-coins"></i>
                <p>No contribution records yet.</p>
            </div>
        </div>

    </div><!-- /tab-content -->
</div><!-- /chama-app -->


<script>
const ChamaApp = (() => {

    // ===================== STORAGE HELPERS =====================
    const KEYS = {
        members: 'chama_members',
        votes: 'chama_votes',
        contributions: 'chama_contributions',
        seeded: 'chama_seeded'
    };

    function load(key) {
        try { return JSON.parse(localStorage.getItem(key)) || []; }
        catch(e) { return []; }
    }
    function save(key, data) { localStorage.setItem(key, JSON.stringify(data)); }
    function uid() { return Date.now().toString(36) + Math.random().toString(36).substr(2, 5); }

    const avatarColors = ['#0d6efd','#6f42c1','#d63384','#fd7e14','#198754','#0dcaf0','#dc3545','#20c997'];
    function avatarColor(name) { let h = 0; for(let i=0;i<name.length;i++) h = name.charCodeAt(i) + ((h<<5)-h); return avatarColors[Math.abs(h) % avatarColors.length]; }
    function initials(name) { return name.split(' ').map(w => w[0]).join('').toUpperCase().substring(0,2); }
    function formatNum(n) { return Number(n).toLocaleString(); }

    // ===================== SEED DATA =====================
    function seedIfNeeded() {
        if (localStorage.getItem(KEYS.seeded)) return;

        const members = [
            { id: uid(), name: 'James Mwangi',   role: 'Chairman',  contribution: 10000, status: 'Active' },
            { id: uid(), name: 'Alice Wanjiku',   role: 'Treasurer', contribution: 10000, status: 'Active' },
            { id: uid(), name: 'Peter Ochieng',   role: 'Secretary', contribution: 5000,  status: 'Active' },
            { id: uid(), name: 'Grace Nyambura',  role: 'Member',    contribution: 5000,  status: 'Active' }
        ];
        save(KEYS.members, members);

        const today = new Date();
        const months = ['Jan 2026','Feb 2026','Mar 2026'];
        const contribs = [];
        members.forEach(m => {
            months.forEach((month, idx) => {
                const isPaid = idx < 2; // first two months paid
                contribs.push({
                    id: uid(),
                    memberId: m.id,
                    memberName: m.name,
                    month: month,
                    amount: m.contribution,
                    status: isPaid ? 'Paid' : 'Pending'
                });
            });
        });
        save(KEYS.contributions, contribs);

        const deadline = new Date();
        deadline.setDate(deadline.getDate() + 7);
        const votes = [
            {
                id: uid(),
                topic: 'Should we invest in Treasury Bonds?',
                options: ['Yes, invest 60%', 'Yes, invest 30%', 'No, keep in savings', 'Defer decision'],
                deadline: deadline.toISOString().split('T')[0],
                votes: { 0: 2, 1: 1, 2: 0, 3: 1 },
                voters: [members[0].id, members[1].id, members[2].id, members[3].id],
                status: 'active',
                createdAt: new Date().toISOString()
            },
            {
                id: uid(),
                topic: 'Increase monthly contribution to KES 15,000?',
                options: ['Yes', 'No'],
                deadline: new Date(today.getTime() - 86400000).toISOString().split('T')[0],
                votes: { 0: 3, 1: 1 },
                voters: [members[0].id, members[1].id, members[2].id, members[3].id],
                status: 'closed',
                createdAt: new Date(today.getTime() - 86400000 * 10).toISOString()
            }
        ];
        save(KEYS.votes, votes);

        localStorage.setItem(KEYS.seeded, '1');
    }

    // ===================== STATS =====================
    function renderStats() {
        const members = load(KEYS.members);
        const votes = load(KEYS.votes);
        const contribs = load(KEYS.contributions);
        const activeMembers = members.filter(m => m.status === 'Active').length;
        const activeVotes = votes.filter(v => v.status === 'active').length;
        const totalCollected = contribs.filter(c => c.status === 'Paid').reduce((s, c) => s + Number(c.amount), 0);
        const totalPending = contribs.filter(c => c.status === 'Pending').reduce((s, c) => s + Number(c.amount), 0);

        document.getElementById('stats-row').innerHTML = `
            <div class="col-6 col-md-3"><div class="card stat-card blue p-3"><div class="text-muted small">Total Members</div><div class="h4 mb-0">${members.length}</div><div class="text-muted small">${activeMembers} active</div></div></div>
            <div class="col-6 col-md-3"><div class="card stat-card green p-3"><div class="text-muted small">Active Votes</div><div class="h4 mb-0">${activeVotes}</div><div class="text-muted small">${votes.length} total</div></div></div>
            <div class="col-6 col-md-3"><div class="card stat-card orange p-3"><div class="text-muted small">Collected</div><div class="h4 mb-0">KES ${formatNum(totalCollected)}</div><div class="text-muted small">contributions</div></div></div>
            <div class="col-6 col-md-3"><div class="card stat-card red p-3"><div class="text-muted small">Pending</div><div class="h4 mb-0">KES ${formatNum(totalPending)}</div><div class="text-muted small">outstanding</div></div></div>
        `;
    }

    // ===================== MEMBERS =====================
    function renderMembers() {
        const members = load(KEYS.members);
        const tbody = document.getElementById('members-tbody');
        const empty = document.getElementById('members-empty');

        if (!members.length) {
            tbody.innerHTML = '';
            empty.classList.remove('d-none');
            return;
        }
        empty.classList.add('d-none');

        const roleBadge = (role) => {
            const colors = { Chairman: 'primary', Treasurer: 'success', Secretary: 'info', Member: 'secondary' };
            return `<span class="badge bg-${colors[role] || 'secondary'}">${role}</span>`;
        };

        tbody.innerHTML = members.map(m => `
            <tr>
                <td><div class="member-avatar" style="background:${avatarColor(m.name)}">${initials(m.name)}</div></td>
                <td class="fw-semibold">${m.name}</td>
                <td>${roleBadge(m.role)}</td>
                <td>KES ${formatNum(m.contribution)}</td>
                <td><span class="badge badge-${m.status.toLowerCase()}">${m.status}</span></td>
                <td class="text-end">
                    <button class="btn btn-outline-primary btn-sm me-1" onclick="ChamaApp.editMember('${m.id}')" title="Edit"><i class="fas fa-pen"></i></button>
                    <button class="btn btn-outline-danger btn-sm" onclick="ChamaApp.deleteMember('${m.id}')" title="Delete"><i class="fas fa-trash"></i></button>
                </td>
            </tr>
        `).join('');
    }

    function showMemberForm(editId) {
        const card = document.getElementById('member-form-card');
        const title = document.getElementById('member-form-title');
        card.classList.remove('d-none');

        if (editId) {
            const m = load(KEYS.members).find(x => x.id === editId);
            if (!m) return;
            title.textContent = 'Edit Member';
            document.getElementById('member-edit-id').value = m.id;
            document.getElementById('member-name').value = m.name;
            document.getElementById('member-role').value = m.role;
            document.getElementById('member-contribution').value = m.contribution;
            document.getElementById('member-status').value = m.status;
        } else {
            title.textContent = 'Add New Member';
            document.getElementById('member-form').reset();
            document.getElementById('member-edit-id').value = '';
            document.getElementById('member-contribution').value = 5000;
        }
        document.getElementById('member-name').focus();
    }

    function hideMemberForm() {
        document.getElementById('member-form-card').classList.add('d-none');
        document.getElementById('member-form').reset();
        document.getElementById('member-edit-id').value = '';
    }

    function saveMember(e) {
        e.preventDefault();
        const members = load(KEYS.members);
        const editId = document.getElementById('member-edit-id').value;
        const data = {
            name: document.getElementById('member-name').value.trim(),
            role: document.getElementById('member-role').value,
            contribution: Number(document.getElementById('member-contribution').value),
            status: document.getElementById('member-status').value
        };

        if (editId) {
            const idx = members.findIndex(m => m.id === editId);
            if (idx !== -1) { members[idx] = { ...members[idx], ...data }; }
        } else {
            members.push({ id: uid(), ...data });
        }
        save(KEYS.members, members);
        hideMemberForm();
        renderMembers();
        renderStats();
    }

    function editMember(id) { showMemberForm(id); }

    function deleteMember(id) {
        if (!confirm('Remove this member?')) return;
        const members = load(KEYS.members).filter(m => m.id !== id);
        save(KEYS.members, members);
        renderMembers();
        renderStats();
    }

    // ===================== VOTING =====================
    function renderVotes() {
        const votes = load(KEYS.votes);
        const container = document.getElementById('votes-container');
        const empty = document.getElementById('votes-empty');

        // auto-close past deadline
        const today = new Date().toISOString().split('T')[0];
        let changed = false;
        votes.forEach(v => {
            if (v.status === 'active' && v.deadline && v.deadline < today) {
                v.status = 'closed';
                changed = true;
            }
        });
        if (changed) save(KEYS.votes, votes);

        if (!votes.length) {
            container.innerHTML = '';
            empty.classList.remove('d-none');
            return;
        }
        empty.classList.add('d-none');

        // sort: active first, then by creation date desc
        const sorted = [...votes].sort((a, b) => {
            if (a.status === 'active' && b.status !== 'active') return -1;
            if (a.status !== 'active' && b.status === 'active') return 1;
            return new Date(b.createdAt) - new Date(a.createdAt);
        });

        container.innerHTML = sorted.map(v => {
            const totalVotes = Object.values(v.votes).reduce((s, n) => s + n, 0);
            const maxVote = Math.max(...Object.values(v.votes), 1);
            const isActive = v.status === 'active';
            const statusBadge = isActive
                ? '<span class="badge bg-success">Active</span>'
                : '<span class="badge bg-secondary">Closed</span>';
            const deadlineStr = v.deadline
                ? `<span class="badge bg-light text-dark deadline-badge"><i class="fas fa-clock me-1"></i>${v.deadline}</span>`
                : '';

            const optionsHtml = v.options.map((opt, idx) => {
                const count = v.votes[idx] || 0;
                const pct = totalVotes > 0 ? Math.round((count / totalVotes) * 100) : 0;
                const barWidth = maxVote > 0 ? Math.round((count / maxVote) * 100) : 0;
                const barColor = ['#0d6efd','#198754','#fd7e14','#dc3545'][idx % 4];

                return `
                    <div class="bar-chart-row">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="small fw-medium">${opt}</span>
                            <span class="small text-muted">${count} vote${count !== 1 ? 's' : ''} (${pct}%)</span>
                        </div>
                        <div class="d-flex align-items-center gap-2">
                            <div class="flex-grow-1 bg-light rounded" style="height:24px">
                                <div class="bar-chart-bar" style="width:${barWidth}%; background:${barColor}"></div>
                            </div>
                            ${isActive ? `<button class="btn btn-outline-primary btn-sm vote-option-btn" onclick="ChamaApp.castVote('${v.id}', ${idx})" title="Vote for this"><i class="fas fa-vote-yea"></i></button>` : ''}
                        </div>
                    </div>
                `;
            }).join('');

            return `
                <div class="card vote-card mb-3">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-start mb-2">
                            <div>
                                <h6 class="mb-1">${v.topic}</h6>
                                <div class="d-flex gap-2 align-items-center">${statusBadge} ${deadlineStr} <span class="text-muted small">${totalVotes} total vote${totalVotes !== 1 ? 's' : ''}</span></div>
                            </div>
                            <div>
                                ${isActive ? `<button class="btn btn-outline-warning btn-sm me-1" onclick="ChamaApp.closeVote('${v.id}')" title="Close vote"><i class="fas fa-lock"></i></button>` : ''}
                                <button class="btn btn-outline-danger btn-sm" onclick="ChamaApp.deleteVote('${v.id}')" title="Delete"><i class="fas fa-trash"></i></button>
                            </div>
                        </div>
                        ${optionsHtml}
                    </div>
                </div>
            `;
        }).join('');
    }

    function showVoteForm() {
        document.getElementById('vote-form-card').classList.remove('d-none');
        document.getElementById('vote-form').reset();
        // reset to 2 option inputs
        const container = document.getElementById('vote-options-inputs');
        container.innerHTML = `
            <div class="input-group input-group-sm mb-1"><span class="input-group-text">1</span><input type="text" class="form-control vote-option-input" required placeholder="Option 1"></div>
            <div class="input-group input-group-sm mb-1"><span class="input-group-text">2</span><input type="text" class="form-control vote-option-input" required placeholder="Option 2"></div>
        `;
        // set default deadline to 7 days from now
        const d = new Date(); d.setDate(d.getDate() + 7);
        document.getElementById('vote-deadline').value = d.toISOString().split('T')[0];
        document.getElementById('vote-topic').focus();
    }

    function hideVoteForm() {
        document.getElementById('vote-form-card').classList.add('d-none');
    }

    function addVoteOption() {
        const container = document.getElementById('vote-options-inputs');
        const count = container.querySelectorAll('.vote-option-input').length;
        if (count >= 4) { alert('Maximum 4 options allowed.'); return; }
        const div = document.createElement('div');
        div.className = 'input-group input-group-sm mb-1';
        div.innerHTML = `<span class="input-group-text">${count + 1}</span><input type="text" class="form-control vote-option-input" required placeholder="Option ${count + 1}"><button type="button" class="btn btn-outline-danger btn-sm" onclick="this.parentElement.remove()"><i class="fas fa-times"></i></button>`;
        container.appendChild(div);
    }

    function saveVote(e) {
        e.preventDefault();
        const topic = document.getElementById('vote-topic').value.trim();
        const deadline = document.getElementById('vote-deadline').value;
        const optionInputs = document.querySelectorAll('.vote-option-input');
        const options = [];
        optionInputs.forEach(inp => { if (inp.value.trim()) options.push(inp.value.trim()); });

        if (options.length < 2) { alert('Please provide at least 2 options.'); return; }

        const votes = load(KEYS.votes);
        const voteObj = {
            id: uid(),
            topic,
            options,
            deadline: deadline || null,
            votes: {},
            voters: [],
            status: 'active',
            createdAt: new Date().toISOString()
        };
        options.forEach((_, idx) => { voteObj.votes[idx] = 0; });
        votes.unshift(voteObj);
        save(KEYS.votes, votes);
        hideVoteForm();
        renderVotes();
        renderStats();
    }

    function castVote(voteId, optionIdx) {
        const votes = load(KEYS.votes);
        const vote = votes.find(v => v.id === voteId);
        if (!vote || vote.status !== 'active') return;

        vote.votes[optionIdx] = (vote.votes[optionIdx] || 0) + 1;
        save(KEYS.votes, votes);
        renderVotes();
    }

    function closeVote(id) {
        if (!confirm('Close this vote? No more votes will be accepted.')) return;
        const votes = load(KEYS.votes);
        const vote = votes.find(v => v.id === id);
        if (vote) vote.status = 'closed';
        save(KEYS.votes, votes);
        renderVotes();
        renderStats();
    }

    function deleteVote(id) {
        if (!confirm('Delete this voting session?')) return;
        save(KEYS.votes, load(KEYS.votes).filter(v => v.id !== id));
        renderVotes();
        renderStats();
    }

    // ===================== CONTRIBUTIONS =====================
    function renderContributions() {
        const contribs = load(KEYS.contributions);
        const tbody = document.getElementById('contributions-tbody');
        const empty = document.getElementById('contributions-empty');
        const summary = document.getElementById('contribution-summary');

        const totalExpected = contribs.reduce((s, c) => s + Number(c.amount), 0);
        const totalPaid = contribs.filter(c => c.status === 'Paid').reduce((s, c) => s + Number(c.amount), 0);
        const totalPending = totalExpected - totalPaid;
        const paidPct = totalExpected > 0 ? Math.round((totalPaid / totalExpected) * 100) : 0;

        summary.innerHTML = `
            <div class="row align-items-center">
                <div class="col-md-4 mb-3 mb-md-0">
                    <div class="small opacity-75">Total Expected</div>
                    <div class="h3 mb-0">KES ${formatNum(totalExpected)}</div>
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <div class="small opacity-75"><i class="fas fa-check-circle me-1"></i>Collected</div>
                    <div class="h4 mb-0">KES ${formatNum(totalPaid)}</div>
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <div class="small opacity-75"><i class="fas fa-exclamation-circle me-1"></i>Pending</div>
                    <div class="h4 mb-0">KES ${formatNum(totalPending)}</div>
                </div>
                <div class="col-md-2 text-center">
                    <div class="h2 mb-0">${paidPct}%</div>
                    <div class="small opacity-75">collected</div>
                </div>
            </div>
            <div class="progress mt-3" style="height:8px; background:rgba(255,255,255,0.2); border-radius:4px">
                <div class="progress-bar bg-light" style="width:${paidPct}%; border-radius:4px"></div>
            </div>
        `;

        if (!contribs.length) {
            tbody.innerHTML = '';
            empty.classList.remove('d-none');
            return;
        }
        empty.classList.add('d-none');

        tbody.innerHTML = contribs.map(c => `
            <tr>
                <td class="fw-medium">${c.memberName}</td>
                <td>${c.month}</td>
                <td>KES ${formatNum(c.amount)}</td>
                <td><span class="badge badge-${c.status.toLowerCase()}">${c.status}</span></td>
                <td class="text-end">
                    ${c.status === 'Pending'
                        ? `<button class="btn btn-outline-success btn-sm" onclick="ChamaApp.markPaid('${c.id}')"><i class="fas fa-check me-1"></i>Mark Paid</button>`
                        : `<button class="btn btn-outline-warning btn-sm" onclick="ChamaApp.markPending('${c.id}')"><i class="fas fa-undo me-1"></i>Undo</button>`
                    }
                </td>
            </tr>
        `).join('');
    }

    function markPaid(id) {
        const contribs = load(KEYS.contributions);
        const c = contribs.find(x => x.id === id);
        if (c) c.status = 'Paid';
        save(KEYS.contributions, contribs);
        renderContributions();
        renderStats();
    }

    function markPending(id) {
        const contribs = load(KEYS.contributions);
        const c = contribs.find(x => x.id === id);
        if (c) c.status = 'Pending';
        save(KEYS.contributions, contribs);
        renderContributions();
        renderStats();
    }

    // ===================== RESET =====================
    function resetDemo() {
        if (!confirm('Reset all demo data? This will clear members, votes, and contributions.')) return;
        Object.values(KEYS).forEach(k => localStorage.removeItem(k));
        seedIfNeeded();
        renderAll();
    }

    // ===================== INIT =====================
    function renderAll() {
        renderStats();
        renderMembers();
        renderVotes();
        renderContributions();
    }

    // Bootstrap tab events - re-render on tab switch for freshness
    document.addEventListener('DOMContentLoaded', () => {
        seedIfNeeded();
        renderAll();

        // Fallback for Bootstrap 5 tabs if data-bs-toggle works natively
        document.querySelectorAll('[data-bs-toggle="tab"]').forEach(tab => {
            tab.addEventListener('shown.bs.tab', renderAll);
        });
    });

    // Also try immediate init in case DOMContentLoaded already fired
    if (document.readyState !== 'loading') {
        seedIfNeeded();
        renderAll();
    }

    // Public API
    return {
        showMemberForm: (id) => showMemberForm(id),
        hideMemberForm,
        saveMember,
        editMember,
        deleteMember,
        showVoteForm,
        hideVoteForm,
        addVoteOption,
        saveVote,
        castVote,
        closeVote,
        deleteVote,
        markPaid,
        markPending,
        resetDemo
    };

})();
</script>
