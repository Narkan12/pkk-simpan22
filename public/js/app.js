/* ===== bootstrap: axios ===== */
(function () {
    if (typeof axios !== "undefined") {
        window.axios = axios;
        window.axios.defaults.headers.common["X-Requested-With"] =
            "XMLHttpRequest";
    }
})();

/* ===== Modal ===== */
window.openModal = function (id) {
    const el = document.getElementById(id);
    if (!el) return;

    // Reset & render page untuk modal multi-step SEBELUM membuka
    if (id === "modalTambahPegawai") {
        window.tambahPage = 1;
        if (typeof window.renderTambah === "function") {
            window.renderTambah();
        }
    }
    if (id === "modalEditPegawai") {
        window.editPage = 1;
        if (typeof window.renderEdit === "function") {
            window.renderEdit();
        }
    }

    // Buka modal
    el.classList.remove("hidden");
    el.style.display = "flex";
    document.body.style.overflow = "hidden";
};

window.closeModal = function (id) {
    const el = document.getElementById(id);
    if (!el) return;
    el.classList.add("hidden");
    el.style.display = "none";
    document.body.style.overflow = "";
};

window.openLogoutModal = function () {
    openModal("modalLogout");
};
window.closeLogoutModal = function () {
    closeModal("modalLogout");
};

document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('[id^="modal"]').forEach(function (el) {
        el.addEventListener("click", function (e) {
            if (e.target === this) closeModal(this.id);
        });
    });
});

/* ===== Toggle Sidebar ===== */

window.toggleDropdown = function (id, btn) {
    const menu = document.getElementById(id);
    const arrow = btn.querySelector('[class*="bi-chevron"]');
    const isOpen = !menu.classList.contains("hidden");

    document.querySelectorAll('#sidebar [id^="menu"]').forEach(function (el) {
        el.classList.add("hidden");
    });
    document.querySelectorAll("#sidebar .bi-chevron-up").forEach(function (el) {
        el.classList.replace("bi-chevron-up", "bi-chevron-down");
    });

    if (!isOpen) {
        menu.classList.remove("hidden");
        if (arrow) arrow.classList.replace("bi-chevron-down", "bi-chevron-up");
    }
};

window.toggleSidebar = function () {
    const sidebar = document.getElementById("sidebar");
    const header = document.getElementById("topHeader");
    const content = document.getElementById("mainContent");
    if (!sidebar) return;

    const isExpanded = sidebar.dataset.expanded !== "false";

    if (isExpanded) {
        // Collapse
        sidebar.style.width = "60px";
        if (header) header.style.left = "60px";
        if (content) content.style.marginLeft = "60px";
        sidebar.querySelectorAll(".sidebar-text").forEach(function (el) {
            el.classList.add("hidden");
        });
        document
            .querySelectorAll('#sidebar [id^="menu"]')
            .forEach(function (el) {
                el.classList.add("hidden");
            });
        sidebar.dataset.expanded = "false";
    } else {
        // Expand
        sidebar.style.width = "210px";
        if (header) header.style.left = "210px";
        if (content) content.style.marginLeft = "210px";
        sidebar.querySelectorAll(".sidebar-text").forEach(function (el) {
            el.classList.remove("hidden");
        });
        sidebar.dataset.expanded = "true";
    }
};

/* ===== Clock ===== */
function currentTime() {
    const el = document.getElementById("currentTime");
    if (!el) return;
    const now = new Date();
    el.innerText =
        String(now.getHours()).padStart(2, "0") +
        ":" +
        String(now.getMinutes()).padStart(2, "0") +
        ":" +
        String(now.getSeconds()).padStart(2, "0");
}
setInterval(currentTime, 1000);
currentTime();

/* ===== Dashboard Pegawai clock ===== */
document.addEventListener("DOMContentLoaded", function () {
    const jamEl = document.getElementById("jamPegawai");
    if (jamEl) {
        function tick() {
            jamEl.textContent = new Date().toLocaleTimeString("id-ID");
        }
        setInterval(tick, 1000);
        tick();
    }
    ["modalAbsensi", "modalCuti"].forEach(function (id) {
        const el = document.getElementById(id);
        if (el)
            el.addEventListener("click", function (e) {
                if (e.target === this) closeModal(id);
            });
    });
});

/* ===== Pagination (multi-step modal) ===== */
window.tambahPage = 1;
window.editPage = 1;
window.tambahNext = function () {
    window.tambahPage = 2;
    window.renderTambah();
};
window.tambahPrev = function () {
    window.tambahPage = 1;
    window.renderTambah();
};
window.editNext = function () {
    window.editPage = 2;
    window.renderEdit();
};
window.editPrev = function () {
    window.editPage = 1;
    window.renderEdit();
};

window.renderTambah = function () {
    // PAGE 1
    const page1 = document.getElementById("tambahPage1");
    if (page1) {
        if (window.tambahPage === 1) {
            page1.classList.remove("hidden");
            page1.style.display = "grid";
        } else {
            page1.classList.add("hidden");
            page1.style.display = "none";
        }
    }

    // PAGE 2
    const page2 = document.getElementById("tambahPage2");
    if (page2) {
        if (window.tambahPage === 2) {
            page2.classList.remove("hidden");
            page2.style.display = "grid";
        } else {
            page2.classList.add("hidden");
            page2.style.display = "none";
        }
    }

    // TITLE
    const title = document.getElementById("tambahTitle");
    if (title) {
        title.textContent =
            window.tambahPage === 1 ? "Data Pribadi" : "Data Kepegawaian";
    }

    // SUBTITLE
    const sub = document.getElementById("tambahSub");
    if (sub) {
        sub.textContent = "Halaman " + window.tambahPage + " / 2";
    }

    // BUTTON PREV
    const btnPrev = document.getElementById("tambahBtnPrev");
    if (btnPrev) {
        if (window.tambahPage === 1) {
            btnPrev.classList.add("hidden");
            btnPrev.style.display = "none";
        } else {
            btnPrev.classList.remove("hidden");
            btnPrev.style.display = "";
        }
    }

    // BUTTON NEXT
    const btnNext = document.getElementById("tambahBtnNext");
    if (btnNext) {
        if (window.tambahPage === 2) {
            btnNext.classList.add("hidden");
            btnNext.style.display = "none";
        } else {
            btnNext.classList.remove("hidden");
            btnNext.style.display = "flex";
        }
    }

    // BUTTON SIMPAN
    const btnSimpan = document.getElementById("tambahBtnSimpan");
    if (btnSimpan) {
        if (window.tambahPage === 2) {
            btnSimpan.classList.remove("hidden");
            btnSimpan.style.display = "flex";
        } else {
            btnSimpan.classList.add("hidden");
            btnSimpan.style.display = "none";
        }
    }
};
window.renderEdit = function () {
    // PAGE 1
    const page1 = document.getElementById("editPage1");
    if (page1) {
        if (window.editPage === 1) {
            page1.classList.remove("hidden");
            page1.style.display = "grid";
        } else {
            page1.classList.add("hidden");
            page1.style.display = "none";
        }
    }

    // PAGE 2
    const page2 = document.getElementById("editPage2");
    if (page2) {
        if (window.editPage === 2) {
            page2.classList.remove("hidden");
            page2.style.display = "grid";
        } else {
            page2.classList.add("hidden");
            page2.style.display = "none";
        }
    }

    // TITLE
    const title = document.getElementById("editTitle");
    if (title) {
        title.textContent =
            window.editPage === 1 ? "Edit Data Pribadi" : "Edit Data Kepegawaian";
    }

    // SUBTITLE
    const sub = document.getElementById("editSub");
    if (sub) {
        sub.textContent = "Halaman " + window.editPage + " / 2";
    }

    // BUTTON PREV
    const btnPrev = document.getElementById("editBtnPrev");
    if (btnPrev) {
        if (window.editPage === 1) {
            btnPrev.classList.add("hidden");
            btnPrev.style.display = "none";
        } else {
            btnPrev.classList.remove("hidden");
            btnPrev.style.display = "";
        }
    }

    // BUTTON NEXT
    const btnNext = document.getElementById("editBtnNext");
    if (btnNext) {
        if (window.editPage === 2) {
            btnNext.classList.add("hidden");
            btnNext.style.display = "none";
        } else {
            btnNext.classList.remove("hidden");
            btnNext.style.display = "flex";
        }
    }

    // BUTTON SIMPAN
    const btnSimpan = document.getElementById("editBtnSimpan");
    if (btnSimpan) {
        if (window.editPage === 2) {
            btnSimpan.classList.remove("hidden");
            btnSimpan.style.display = "flex";
        } else {
            btnSimpan.classList.add("hidden");
            btnSimpan.style.display = "none";
        }
    }
};

/* ===== DataTable ===== */
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll("table.datatable").forEach(function (table) {
        initDataTable(table);
    });
});

function initDataTable(table) {
    var PER_PAGE = 5;
    var tbody = table.querySelector("tbody");
    var headers = Array.from(table.querySelectorAll("thead th"));
    var searchId = table.dataset.search;
    var search = searchId ? document.getElementById(searchId) : null;
    var allRows = Array.from(tbody.querySelectorAll("tr"));
    var filtered = allRows.slice();
    var page = 1,
        sortCol = -1,
        sortAsc = true;

    allRows.forEach(function (tr) {
        tr.dataset.cells = Array.from(tr.querySelectorAll("td"))
            .map(function (td) {
                return td.textContent.trim().toLowerCase();
            })
            .join("|");
    });

    var wrapper = table.closest(".table-dark-custom") || table.parentElement;
    var footer = document.createElement("div");
    footer.className = "dt-footer";
    footer.style.cssText =
        "display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:0.5rem;padding:0.75rem 1rem;border-top:1px solid #30363d;background:#161b22;border-radius:0 0 10px 10px;";
    footer.innerHTML =
        '<span class="dt-info" style="font-size:0.75rem;color:#8b949e;"></span>' +
        '<div class="dt-pag" style="display:flex;align-items:center;gap:4px;"></div>';
    wrapper.appendChild(footer);

    var infoEl = footer.querySelector(".dt-info");
    var pagEl = footer.querySelector(".dt-pag");

    if (search) {
        search.addEventListener("input", function () {
            page = 1;
            doFilter(this.value);
            render();
        });
    }

    headers.forEach(function (th, idx) {
        if (th.dataset.sortable === "false") return;
        th.style.cursor = "pointer";
        th.addEventListener("click", function () {
            sortAsc = sortCol === idx ? !sortAsc : true;
            sortCol = idx;
            page = 1;
            doSort();
            render();
        });
    });

    function doFilter(q) {
        q = q.trim().toLowerCase();
        filtered = q
            ? allRows.filter(function (tr) {
                  return tr.dataset.cells.includes(q);
              })
            : allRows.slice();
        doSort();
    }
    function doSort() {
        if (sortCol < 0) return;
        var asc = sortAsc ? 1 : -1;
        filtered.sort(function (a, b) {
            var tA = (
                (a.querySelectorAll("td")[sortCol] || {}).textContent || ""
            ).trim();
            var tB = (
                (b.querySelectorAll("td")[sortCol] || {}).textContent || ""
            ).trim();
            var nA = parseFloat(tA.replace(/[^0-9.-]/g, "")),
                nB = parseFloat(tB.replace(/[^0-9.-]/g, ""));
            if (!isNaN(nA) && !isNaN(nB)) return (nA - nB) * asc;
            return tA.localeCompare(tB, "id") * asc;
        });
    }
    function render() {
        var total = filtered.length,
            totalPages = Math.max(1, Math.ceil(total / PER_PAGE));
        if (page > totalPages) page = totalPages;
        var start = (page - 1) * PER_PAGE,
            end = Math.min(start + PER_PAGE, total);
        tbody.innerHTML = "";
        if (total === 0) {
            tbody.innerHTML =
                '<tr><td colspan="' +
                headers.length +
                '" style="text-align:center;color:#8b949e;font-size:0.875rem;padding:2rem;">Tidak ada data ditemukan.</td></tr>';
        } else {
            filtered.slice(start, end).forEach(function (tr) {
                tbody.appendChild(tr);
            });
        }
        infoEl.style.color = "#ffffff";
        infoEl.textContent =
            total === 0
                ? "0 data"
                : "Menampilkan " +
                  (start + 1) +
                  "–" +
                  end +
                  " dari " +
                  total +
                  " data";
        renderPagination(totalPages);
        headers.forEach(function (th, idx) {
            var icon = th.querySelector(".dt-sort-icon");
            if (icon) icon.remove();
            if (idx === sortCol && th.dataset.sortable !== "false") {
                var i = document.createElement("i");
                i.className =
                    "dt-sort-icon bi bi-caret-" +
                    (sortAsc ? "up" : "down") +
                    "-fill";
                i.style.cssText =
                    "margin-left:4px;font-size:10px;color:#58a6ff;";
                th.appendChild(i);
            }
        });
    }
    function renderPagination(totalPages) {
        var btnStyle =
            "display:inline-flex;align-items:center;justify-content:center;min-width:28px;height:28px;padding:0 6px;font-size:0.75rem;border-radius:6px;border:1px solid #30363d;background:#21262d;color:#c9d1d9;cursor:pointer;transition:background 0.15s;";
        var html = "";
        html +=
            '<button style="' +
            btnStyle +
            '" data-page="' +
            (page - 1) +
            '" ' +
            (page === 1 ? "disabled" : "") +
            '><i class="bi bi-chevron-left" style="font-size:10px"></i></button>';
        pageRange(page, totalPages).forEach(function (p) {
            if (p === "...") {
                html +=
                    '<span style="padding:0 4px;font-size:0.75rem;color:#8b949e;">…</span>';
            } else {
                var active =
                    p === page
                        ? "background:#238636;border-color:#238636;color:#fff;font-weight:600;"
                        : "";
                html +=
                    '<button style="' +
                    btnStyle +
                    active +
                    '" data-page="' +
                    p +
                    '">' +
                    p +
                    "</button>";
            }
        });
        html +=
            '<button style="' +
            btnStyle +
            '" data-page="' +
            (page + 1) +
            '" ' +
            (page === totalPages ? "disabled" : "") +
            '><i class="bi bi-chevron-right" style="font-size:10px"></i></button>';
        pagEl.innerHTML = html;
        pagEl
            .querySelectorAll("button[data-page]:not([disabled])")
            .forEach(function (btn) {
                btn.addEventListener("click", function () {
                    page = parseInt(this.dataset.page);
                    render();
                });
            });
    }
    function pageRange(cur, total) {
        if (total <= 7)
            return Array.from({ length: total }, function (_, i) {
                return i + 1;
            });
        if (cur <= 4) return [1, 2, 3, 4, 5, "...", total];
        if (cur >= total - 3)
            return [
                1,
                "...",
                total - 4,
                total - 3,
                total - 2,
                total - 1,
                total,
            ];
        return [1, "...", cur - 1, cur, cur + 1, "...", total];
    }
    render();
}

/* ===== CRUD ===== */
window.showDetailPegawai = function (data) {
    var ttl =
        (data.viewTempatLahir || "-") + ", " + (data.viewTanggalLahir || "-");
    var ttlEl = document.getElementById("viewTTL");
    if (ttlEl) ttlEl.textContent = ttl;
    var map = {
        viewNIK: "viewNIK",
        viewNIP: "viewNIP",
        viewNama: "viewNamaTitle",
        viewJenisKelamin: "viewJenisKelamin",
        viewAgama: "viewAgama",
        viewStatusPernikahan: "viewStatusNikah",
        viewNoTelepon: "viewTelp",
        viewAlamat: "viewAlamat",
        viewJabatan: "viewJabatan",
        viewDepartemen: "viewDepartemen",
        viewGolongan: "viewGolongan",
        viewPendidikan: "viewPendidikan",
        viewTglMasuk: "viewTglMasuk",
        viewJenisPegawai: "viewJenisPegawai",
    };
    Object.entries(data).forEach(function (entry) {
        if (entry[0] === "viewTempatLahir" || entry[0] === "viewTanggalLahir")
            return;
        var elId = map[entry[0]];
        if (elId) {
            var el = document.getElementById(elId);
            if (el) el.textContent = entry[1] || "-";
        }
    });

    // Handle Foto
    var fotoImg = document.getElementById("viewFoto");
    var fotoPlaceholder = document.getElementById("viewFotoPlaceholder");
    var nipElement = document.getElementById("viewNipTitle");

    if (data.viewFoto && fotoImg && fotoPlaceholder) {
        if (data.viewFoto.trim()) {
            fotoImg.src = '/storage/' + data.viewFoto;
            fotoImg.style.display = 'block';
            fotoPlaceholder.style.display = 'none';
        } else {
            fotoImg.style.display = 'none';
            fotoPlaceholder.style.display = 'flex';
            // Extract initials from nama
            var nama = data.viewNama || '?';
            var initials = nama.split(' ').map(function (n) { return n[0]; }).join('').substring(0, 2).toUpperCase();
            fotoPlaceholder.textContent = initials || '?';
        }
    }

    if (nipElement) nipElement.textContent = data.viewNIP || '-';

    var status = document.getElementById("viewStatus");
    if (status)
        status.innerHTML =
            '<span class="' +
            data.viewStatusClass +
            ' mt-1 inline-block">' +
            data.viewStatus +
            "</span>";
    var dept = document.getElementById("viewDepartemen");
    if (dept)
        dept.innerHTML =
            '<span class="status-departemen mt-1 inline-block">' +
            data.viewDepartemen +
            "</span>";
    openModal("modalViewPegawai");
};

window.openModalEditGeneric = function (formId, modalId, fields) {
    var form = document.getElementById(formId);
    if (!form) return;
    form.action = fields.action;
    Object.entries(fields).forEach(function (entry) {
        var el = document.getElementById(entry[0]);
        if (el) el.value = entry[1];
    });
    openModal(modalId);
};

window.openModalHapusGeneric = function (formId, modalId, action, nama, kode) {
    var form = document.getElementById(formId);
    if (form) form.action = action;
    var elNama = document.getElementById("hapusNama");
    var elKode = document.getElementById("hapusKode");
    if (elNama) elNama.textContent = nama;
    if (elKode) elKode.textContent = kode || "";
    openModal(modalId);
};

/* ===== Login ===== */
document.addEventListener("DOMContentLoaded", function () {
    var loginData = document.getElementById("loginData");
    if (loginData) {
        var redirectUrl = loginData.dataset.success;
        var isError = loginData.dataset.error;
        if (redirectUrl) {
            var btnLanjutkan = document.getElementById("btnLanjutkan");
            if (btnLanjutkan) btnLanjutkan.href = redirectUrl;
            var modal = document.getElementById("modalLoginSuccess");
            if (modal) {
                modal.classList.remove("hidden");
                modal.style.display = "flex";
            }
            var sisa = 3;
            var timer = setInterval(function () {
                sisa--;
                var el = document.getElementById("countdown");
                if (el) el.textContent = sisa;
                if (sisa <= 0) {
                    clearInterval(timer);
                    window.location.href = redirectUrl;
                }
            }, 1000);
        }
        if (isError) {
            var errModal = document.getElementById("modalLoginError");
            if (errModal) {
                errModal.classList.remove("hidden");
                errModal.style.display = "flex";
            }
        }
    }
    var toggleBtn = document.getElementById("togglePassword");
    if (toggleBtn) {
        toggleBtn.addEventListener("click", function () {
            var input = document.getElementById("password");
            var eyeIcon = document.getElementById("eyeIcon");
            var hidden = input.type === "password";
            input.type = hidden ? "text" : "password";
            eyeIcon.className = hidden ? "bi bi-eye-slash" : "bi bi-eye";
        });
    }
});

window.closeLoginModal = function () {
    var s = document.getElementById("modalLoginSuccess");
    var e = document.getElementById("modalLoginError");
    if (s) {
        s.classList.add("hidden");
        s.style.display = "none";
    }
    if (e) {
        e.classList.add("hidden");
        e.style.display = "none";
    }
};

/* ===== PHOTO PREVIEW & VALIDATION ===== */
document.addEventListener("DOMContentLoaded", function () {
    // Photo preview for Add Employee modal
    var fotoInput = document.getElementById("fotoInputAdd");
    if (fotoInput) {
        fotoInput.addEventListener("change", function (e) {
            handlePhotoPreview(e, "fotoPreviewAdd", "fotoPreviewImg");
        });
    }

    // Photo preview for Edit Employee modal (if exists)
    var fotoInputEdit = document.getElementById("fotoInputEdit");
    if (fotoInputEdit) {
        fotoInputEdit.addEventListener("change", function (e) {
            handlePhotoPreview(e, "fotoPreviewEdit", "fotoPreviewImgEdit");
        });
    }
});

window.handlePhotoPreview = function (event, previewContainerId, previewImgId) {
    var file = event.target.files[0];
    var maxSize = 2 * 1024 * 1024; // 2MB
    var allowedTypes = ["image/jpeg", "image/png", "image/jpg"];

    // Reset preview
    var container = document.getElementById(previewContainerId);
    var img = document.getElementById(previewImgId);

    if (!file) {
        if (container) container.style.display = "none";
        return;
    }

    // Validate file type
    if (!allowedTypes.includes(file.type)) {
        alert("Format file tidak didukung. Gunakan JPG, JPEG, atau PNG.");
        event.target.value = "";
        if (container) container.style.display = "none";
        return;
    }

    // Validate file size
    if (file.size > maxSize) {
        alert("Ukuran file terlalu besar. Maksimal 2MB.");
        event.target.value = "";
        if (container) container.style.display = "none";
        return;
    }

    // Show preview
    var reader = new FileReader();
    reader.onload = function (e) {
        if (img) {
            img.src = e.target.result;
            if (container) container.style.display = "block";
        }
    };
    reader.readAsDataURL(file);
};
