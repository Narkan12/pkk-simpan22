/**
 * MODAL MANAGEMENT
 * Handle opening/closing modals and multi-step page navigation
 */

/**
 * Open modal by ID and initialize based on modal type
 * @param {string} id - Modal element ID
 */
window.openModal = function(id) {
    if (!id || typeof id !== 'string') {
        console.error('openModal: invalid id parameter', id);
        return;
    }

    const modal = document.getElementById(id);
    if (!modal) {
        console.error('openModal: modal not found - ' + id);
        return;
    }

    // Remove hidden class and set display to flex
    modal.classList.remove('hidden');
    modal.style.display = 'flex';

    // Initialize based on modal type
    if (id === 'modalTambahPegawai') {
        window.renderTambah();
    } else if (id === 'modalEditPegawai') {
        window.renderEdit();
    }
};

/**
 * Close modal by ID
 * @param {string} id - Modal element ID
 */
window.closeModal = function(id) {
    if (!id || typeof id !== 'string') {
        console.error('closeModal: invalid id parameter', id);
        return;
    }

    const modal = document.getElementById(id);
    if (!modal) {
        console.error('closeModal: modal not found - ' + id);
        return;
    }

    // Add hidden class and set display to none
    modal.classList.add('hidden');
    modal.style.display = 'none';

    // Reset form if exists
    if (id === 'modalTambahPegawai') {
        const form = document.getElementById('formTambahPegawai');
        if (form) form.reset();
    } else if (id === 'modalEditPegawai') {
        const form = document.getElementById('formEditPegawai');
        if (form) form.reset();
    }
};

/**
 * Initialize TAMBAH (Add) modal to page 1
 * Reset form, hide page 2, show navigation buttons correctly
 */
window.renderTambah = function() {
    // Get all required elements
    const page1 = document.getElementById('tambahPage1');
    const page2 = document.getElementById('tambahPage2');
    const btnNext = document.getElementById('tambahBtnNext');
    const btnPrev = document.getElementById('tambahBtnPrev');
    const btnSimpan = document.getElementById('tambahBtnSimpan');
    const form = document.getElementById('formTambahPegawai');
    const title = document.getElementById('tambahTitle');
    const subtitle = document.getElementById('tambahSub');

    // Defensive null-check
    if (!page1) {
        console.error('renderTambah: tambahPage1 element not found');
        return;
    }
    if (!page2) {
        console.error('renderTambah: tambahPage2 element not found');
        return;
    }
    if (!btnNext) {
        console.error('renderTambah: tambahBtnNext element not found');
        return;
    }
    if (!btnPrev) {
        console.error('renderTambah: tambahBtnPrev element not found');
        return;
    }
    if (!btnSimpan) {
        console.error('renderTambah: tambahBtnSimpan element not found');
        return;
    }

    // Reset form
    if (form) {
        form.reset();
    }

    // Reset to page 1
    // Show page 1: remove hidden class AND set display to grid
    page1.classList.remove('hidden');
    page1.style.display = 'grid';

    // Hide page 2: add hidden class AND set display to none
    page2.classList.add('hidden');
    page2.style.display = 'none';

    // Show Next button: remove hidden class AND set display to flex
    btnNext.classList.remove('hidden');
    btnNext.style.display = 'flex';

    // Hide Previous button: add hidden class AND set display to none
    btnPrev.classList.add('hidden');
    btnPrev.style.display = 'none';

    // Hide Simpan button: add hidden class AND set display to none
    btnSimpan.classList.add('hidden');
    btnSimpan.style.display = 'none';

    // Update title and subtitle
    if (title) {
        title.textContent = 'Data Pribadi';
    }
    if (subtitle) {
        subtitle.textContent = 'Halaman 1 / 2';
    }

    console.log('renderTambah: Modal initialized to page 1');
};

/**
 * Initialize EDIT modal to page 1
 * Reset form to page 1, hide page 2, show navigation buttons correctly
 */
window.renderEdit = function() {
    // Get all required elements
    const page1 = document.getElementById('editPage1');
    const page2 = document.getElementById('editPage2');
    const btnNext = document.getElementById('editBtnNext');
    const btnPrev = document.getElementById('editBtnPrev');
    const btnSimpan = document.getElementById('editBtnSimpan');
    const title = document.getElementById('editTitle');
    const subtitle = document.getElementById('editSub');

    // Defensive null-check
    if (!page1) {
        console.error('renderEdit: editPage1 element not found');
        return;
    }
    if (!page2) {
        console.error('renderEdit: editPage2 element not found');
        return;
    }
    if (!btnNext) {
        console.error('renderEdit: editBtnNext element not found');
        return;
    }
    if (!btnPrev) {
        console.error('renderEdit: editBtnPrev element not found');
        return;
    }
    if (!btnSimpan) {
        console.error('renderEdit: editBtnSimpan element not found');
        return;
    }

    // Reset to page 1
    // Show page 1: remove hidden class AND set display to grid
    page1.classList.remove('hidden');
    page1.style.display = 'grid';

    // Hide page 2: add hidden class AND set display to none
    page2.classList.add('hidden');
    page2.style.display = 'none';

    // Show Next button: remove hidden class AND set display to flex
    btnNext.classList.remove('hidden');
    btnNext.style.display = 'flex';

    // Hide Previous button: add hidden class AND set display to none
    btnPrev.classList.add('hidden');
    btnPrev.style.display = 'none';

    // Hide Simpan button: add hidden class AND set display to none
    btnSimpan.classList.add('hidden');
    btnSimpan.style.display = 'none';

    // Update title
    if (title) {
        title.textContent = 'Edit Data Pribadi';
    }
    if (subtitle) {
        subtitle.textContent = 'Halaman 1 / 2';
    }

    console.log('renderEdit: Modal initialized to page 1');
};

/**
 * Navigate to page 2 in TAMBAH modal
 */
window.tambahNext = function() {
    const page1 = document.getElementById('tambahPage1');
    const page2 = document.getElementById('tambahPage2');
    const btnNext = document.getElementById('tambahBtnNext');
    const btnPrev = document.getElementById('tambahBtnPrev');
    const btnSimpan = document.getElementById('tambahBtnSimpan');
    const title = document.getElementById('tambahTitle');
    const subtitle = document.getElementById('tambahSub');

    // Defensive null-check
    if (!page1 || !page2 || !btnNext || !btnPrev || !btnSimpan) {
        console.error('tambahNext: One or more required elements not found');
        return;
    }

    // Hide page 1: add hidden class AND set display to none
    page1.classList.add('hidden');
    page1.style.display = 'none';

    // Show page 2: remove hidden class AND set display to grid
    page2.classList.remove('hidden');
    page2.style.display = 'grid';

    // Hide Next button: add hidden class AND set display to none
    btnNext.classList.add('hidden');
    btnNext.style.display = 'none';

    // Show Previous button: remove hidden class AND set display to flex
    btnPrev.classList.remove('hidden');
    btnPrev.style.display = 'flex';

    // Show Simpan button: remove hidden class AND set display to flex
    btnSimpan.classList.remove('hidden');
    btnSimpan.style.display = 'flex';

    // Update title and subtitle
    if (title) {
        title.textContent = 'Data Kepegawaian';
    }
    if (subtitle) {
        subtitle.textContent = 'Halaman 2 / 2';
    }

    console.log('tambahNext: Navigated to page 2');
};

/**
 * Navigate back to page 1 in TAMBAH modal
 */
window.tambahPrev = function() {
    const page1 = document.getElementById('tambahPage1');
    const page2 = document.getElementById('tambahPage2');
    const btnNext = document.getElementById('tambahBtnNext');
    const btnPrev = document.getElementById('tambahBtnPrev');
    const btnSimpan = document.getElementById('tambahBtnSimpan');
    const title = document.getElementById('tambahTitle');
    const subtitle = document.getElementById('tambahSub');

    // Defensive null-check
    if (!page1 || !page2 || !btnNext || !btnPrev || !btnSimpan) {
        console.error('tambahPrev: One or more required elements not found');
        return;
    }

    // Show page 1: remove hidden class AND set display to grid
    page1.classList.remove('hidden');
    page1.style.display = 'grid';

    // Hide page 2: add hidden class AND set display to none
    page2.classList.add('hidden');
    page2.style.display = 'none';

    // Show Next button: remove hidden class AND set display to flex
    btnNext.classList.remove('hidden');
    btnNext.style.display = 'flex';

    // Hide Previous button: add hidden class AND set display to none
    btnPrev.classList.add('hidden');
    btnPrev.style.display = 'none';

    // Hide Simpan button: add hidden class AND set display to none
    btnSimpan.classList.add('hidden');
    btnSimpan.style.display = 'none';

    // Update title and subtitle
    if (title) {
        title.textContent = 'Data Pribadi';
    }
    if (subtitle) {
        subtitle.textContent = 'Halaman 1 / 2';
    }

    console.log('tambahPrev: Navigated back to page 1');
};

/**
 * Navigate to page 2 in EDIT modal
 */
window.editNext = function() {
    const page1 = document.getElementById('editPage1');
    const page2 = document.getElementById('editPage2');
    const btnNext = document.getElementById('editBtnNext');
    const btnPrev = document.getElementById('editBtnPrev');
    const btnSimpan = document.getElementById('editBtnSimpan');
    const title = document.getElementById('editTitle');
    const subtitle = document.getElementById('editSub');

    // Defensive null-check
    if (!page1 || !page2 || !btnNext || !btnPrev || !btnSimpan) {
        console.error('editNext: One or more required elements not found');
        return;
    }

    // Hide page 1: add hidden class AND set display to none
    page1.classList.add('hidden');
    page1.style.display = 'none';

    // Show page 2: remove hidden class AND set display to grid
    page2.classList.remove('hidden');
    page2.style.display = 'grid';

    // Hide Next button: add hidden class AND set display to none
    btnNext.classList.add('hidden');
    btnNext.style.display = 'none';

    // Show Previous button: remove hidden class AND set display to flex
    btnPrev.classList.remove('hidden');
    btnPrev.style.display = 'flex';

    // Show Simpan button: remove hidden class AND set display to flex
    btnSimpan.classList.remove('hidden');
    btnSimpan.style.display = 'flex';

    // Update title and subtitle
    if (title) {
        title.textContent = 'Edit Data Kepegawaian';
    }
    if (subtitle) {
        subtitle.textContent = 'Halaman 2 / 2';
    }

    console.log('editNext: Navigated to page 2');
};

/**
 * Navigate back to page 1 in EDIT modal
 */
window.editPrev = function() {
    const page1 = document.getElementById('editPage1');
    const page2 = document.getElementById('editPage2');
    const btnNext = document.getElementById('editBtnNext');
    const btnPrev = document.getElementById('editBtnPrev');
    const btnSimpan = document.getElementById('editBtnSimpan');
    const title = document.getElementById('editTitle');
    const subtitle = document.getElementById('editSub');

    // Defensive null-check
    if (!page1 || !page2 || !btnNext || !btnPrev || !btnSimpan) {
        console.error('editPrev: One or more required elements not found');
        return;
    }

    // Show page 1: remove hidden class AND set display to grid
    page1.classList.remove('hidden');
    page1.style.display = 'grid';

    // Hide page 2: add hidden class AND set display to none
    page2.classList.add('hidden');
    page2.style.display = 'none';

    // Show Next button: remove hidden class AND set display to flex
    btnNext.classList.remove('hidden');
    btnNext.style.display = 'flex';

    // Hide Previous button: add hidden class AND set display to none
    btnPrev.classList.add('hidden');
    btnPrev.style.display = 'none';

    // Hide Simpan button: add hidden class AND set display to none
    btnSimpan.classList.add('hidden');
    btnSimpan.style.display = 'none';

    // Update title and subtitle
    if (title) {
        title.textContent = 'Edit Data Pribadi';
    }
    if (subtitle) {
        subtitle.textContent = 'Halaman 1 / 2';
    }

    console.log('editPrev: Navigated back to page 1');
};

/**
 * Open EDIT modal with prefilled data
 * Generic function for opening edit modal and populating form fields
 * @param {string} formId - Form element ID
 * @param {string} modalId - Modal element ID
 * @param {object} data - Object containing field IDs as keys and values
 */
window.openModalEditGeneric = function(formId, modalId, data) {
    if (!modalId || typeof modalId !== 'string') {
        console.error('openModalEditGeneric: invalid modalId parameter', modalId);
        return;
    }

    const form = document.getElementById(formId);
    if (form && data && typeof data === 'object') {
        // Populate form fields from data object
        Object.keys(data).forEach(key => {
            const element = document.getElementById(key);
            if (element) {
                element.value = data[key];
            }
        });

        // Update form action URL
        if (data.action) {
            form.action = data.action;
        }
    }

    // Open the modal
    window.openModal(modalId);
};

/**
 * Open DELETE modal confirmation
 * Generic function for delete confirmation
 * @param {string} formId - Form element ID
 * @param {string} modalId - Modal element ID
 * @param {string} actionUrl - Delete action URL
 * @param {string} nama - Item name for confirmation text
 * @param {string} identifier - Item identifier (e.g., NIP)
 */
window.openModalHapusGeneric = function(formId, modalId, actionUrl, nama, identifier) {
    if (!formId || !modalId || !actionUrl) {
        console.error('openModalHapusGeneric: missing required parameters');
        return;
    }

    const form = document.getElementById(formId);
    if (form) {
        form.action = actionUrl;
    }

    // Update confirmation text if modal has a content area
    const modalContent = document.getElementById(modalId);
    if (modalContent) {
        const contentDiv = modalContent.querySelector('[role="dialog"]') || modalContent;
        // Confirmation text is typically in the delete modal template
        // Update if you have a specific element for it
    }

    window.openModal(modalId);
};

/**
 * Show detail pegawai in view modal
 * @param {object} data - Object containing view field IDs and values
 */
window.showDetailPegawai = function(data) {
    if (!data || typeof data !== 'object') {
        console.error('showDetailPegawai: invalid data parameter', data);
        return;
    }

    // Populate view fields
    Object.keys(data).forEach(key => {
        const element = document.getElementById(key);
        if (element) {
            if (key === 'viewStatusClass') {
                // Handle class assignment separately if needed
                return;
            }
            element.textContent = data[key];
        }
    });

    // Open the view modal
    window.openModal('modalViewPegawai');
};

console.log('Modal.js loaded');
