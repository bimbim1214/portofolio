/**
 * ═══════════════════════════════════════════════════════════════
 *  Admin Dashboard — JavaScript
 *  Portfolio Admin Panel
 * ═══════════════════════════════════════════════════════════════
 */

// ── Tab Switching ─────────────────────────────────────────────

function switchTab(name, btn) {
    // Hide all tabs
    document.querySelectorAll('.tab-section').forEach(el => el.classList.remove('active'));
    document.querySelectorAll('.nav-tab').forEach(el => el.classList.remove('active'));

    // Show active tab
    document.getElementById('tab-' + name).classList.add('active');
    btn.classList.add('active');

    // Update breadcrumb
    const sectionName = name.charAt(0).toUpperCase() + name.slice(1);
    document.getElementById('breadcrumb-section').textContent = sectionName;

    // Save tab preference to URL history
    const url = new URL(window.location);
    url.searchParams.set('tab', name);
    window.history.pushState({}, '', url);
}

// ── Modal Helpers ─────────────────────────────────────────────

function openModal(id) {
    document.getElementById(id).classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeModal(id) {
    document.getElementById(id).classList.add('hidden');
    document.body.style.overflow = '';
}

// Keyboard ESC close
document.addEventListener('keydown', e => {
    if (e.key === 'Escape') {
        ['modal-add-exp', 'modal-edit-exp', 'modal-edit-proj'].forEach(id => closeModal(id));
    }
});

// ── Photo Preview ─────────────────────────────────────────────

function previewPhoto(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            document.getElementById('photo-preview').src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
        document.getElementById('photo-name').textContent = input.files[0].name;
    }
}

// ── Project Cover Preview ─────────────────────────────────────

function previewCoverImage(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            const preview = document.getElementById('cover-preview');
            preview.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
        document.getElementById('cover-file-name').textContent = input.files[0].name;
    }
}

// ── Rich Text Editor Helper ────────────────────────────────────

function wrapText(textareaId, openTag, closeTag) {
    const textarea = document.getElementById(textareaId);
    if (!textarea) return;

    const start = textarea.selectionStart;
    const end = textarea.selectionEnd;
    const text = textarea.value;
    const selectedText = text.substring(start, end);
    const replacement = openTag + selectedText + closeTag;

    textarea.value = text.substring(0, start) + replacement + text.substring(end);
    textarea.focus();

    // Set selection after inserted text
    textarea.selectionStart = start + openTag.length;
    textarea.selectionEnd = start + openTag.length + selectedText.length;
}

// ── Dynamic Tags Helper ────────────────────────────────────────

const activeTagsMap = new Map(); // stores tag lists per container ID

function initTagList(containerId, hiddenFieldId, existingTagsStr = '') {
    const hiddenField = document.getElementById(hiddenFieldId);
    if (!hiddenField) return;

    const tagsArray = existingTagsStr ? existingTagsStr.split(',').map(t => t.trim()).filter(t => t !== '') : [];
    activeTagsMap.set(containerId, tagsArray);

    renderTagPills(containerId, hiddenFieldId);
}

function renderTagPills(containerId, hiddenFieldId) {
    const container = document.getElementById(containerId);
    if (!container) return;

    // Remove any existing tags-pill elements
    container.querySelectorAll('.tags-pill').forEach(el => el.remove());

    const tagsArray = activeTagsMap.get(containerId) || [];

    // Render pills before the text input element
    const textInput = container.querySelector('.tags-text-input');
    tagsArray.forEach(tag => {
        const pill = document.createElement('span');
        pill.className = 'tags-pill';
        pill.innerHTML = `${tag} <button type="button" class="tags-pill-close" onclick="removeTagPill('${containerId}', '${hiddenFieldId}', '${tag.replace(/'/g, "\\'")}')">&times;</button>`;
        container.insertBefore(pill, textInput);
    });

    // Update hidden input
    const hiddenField = document.getElementById(hiddenFieldId);
    if (hiddenField) {
        hiddenField.value = tagsArray.join(',');
    }
}

function addTagPill(containerId, textInputId, hiddenFieldId) {
    const textInput = document.getElementById(textInputId);
    if (!textInput || !textInput.value.trim()) return;

    const newTag = textInput.value.trim().replace(/,/g, '');
    const tagsArray = activeTagsMap.get(containerId) || [];

    if (newTag && !tagsArray.includes(newTag)) {
        tagsArray.push(newTag);
        activeTagsMap.set(containerId, tagsArray);
        renderTagPills(containerId, hiddenFieldId);
    }

    textInput.value = '';
    textInput.focus();
}

function removeTagPill(containerId, hiddenFieldId, tagToRemove) {
    let tagsArray = activeTagsMap.get(containerId) || [];
    tagsArray = tagsArray.filter(t => t !== tagToRemove);
    activeTagsMap.set(containerId, tagsArray);
    renderTagPills(containerId, hiddenFieldId);
}

// ── Edit Experience Trigger ────────────────────────────────────

function openEditExp(id, startDate, endDate, title, company, url, desc, tags) {
    document.getElementById('edit-exp-form').action = `/admin/experience/${id}`;
    document.getElementById('edit-exp-start').value = startDate ? startDate.split(' ')[0] : '';
    document.getElementById('edit-exp-end').value = endDate ? endDate.split(' ')[0] : '';
    document.getElementById('edit-exp-title').value = title;
    document.getElementById('edit-exp-company').value = company;
    document.getElementById('edit-exp-url').value = url;
    document.getElementById('edit-exp-desc').value = desc;

    // Initialize tags pills
    initTagList('edit-exp-tags-wrapper', 'edit-exp-tags-hidden', tags);

    openModal('modal-edit-exp');
}

// ── Edit Project Trigger ───────────────────────────────────────

function openEditProj(id, startDate, endDate, title, madeAt, url, linkLabel, desc, tags, showOnHome) {
    document.getElementById('edit-proj-form').action = `/admin/project/${id}`;
    document.getElementById('edit-proj-start').value = startDate ? startDate.split(' ')[0] : '';
    document.getElementById('edit-proj-end').value = endDate ? endDate.split(' ')[0] : '';
    document.getElementById('edit-proj-title').value = title;
    document.getElementById('edit-proj-made-at').value = madeAt;
    document.getElementById('edit-proj-url').value = url;
    document.getElementById('edit-proj-link-label').value = linkLabel;
    document.getElementById('edit-proj-desc').value = desc;
    document.getElementById('edit-show-home').checked = showOnHome;
    document.getElementById('edit-cover-file-name').textContent = '';

    // Initialize tags pills
    initTagList('edit-proj-tags-wrapper', 'edit-proj-tags-hidden', tags);

    openModal('modal-edit-proj');
}

// ── DOMContentLoaded Initializations ──────────────────────────

document.addEventListener('DOMContentLoaded', () => {
    // Restore active tab on page load
    // `activeTab` is set as a global variable from the Blade view
    if (typeof activeTab !== 'undefined') {
        const tabBtn = document.getElementById('tab-' + activeTab + '-btn');
        if (tabBtn) switchTab(activeTab, tabBtn);
    }

    // Auto-dismiss alert after 4s
    setTimeout(() => {
        const flash = document.getElementById('flash-alert');
        const flashError = document.getElementById('flash-alert-error');
        if (flash) flash.style.display = 'none';
        if (flashError) flashError.style.display = 'none';
    }, 4000);

    // Listen for enter keys on tag inputs to add tag instead of submit form
    ['add-tags-input', 'add-exp-tags-input', 'edit-exp-tags-input', 'edit-proj-tags-input'].forEach(id => {
        const el = document.getElementById(id);
        if (el) {
            el.addEventListener('keydown', e => {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    const btn = el.nextElementSibling;
                    if (btn && btn.classList.contains('tags-add-btn')) {
                        btn.click();
                    }
                }
            });
        }
    });

    // Initialize tag lists for project create
    initTagList('add-tags-wrapper', 'add-tags-hidden', '');
});
