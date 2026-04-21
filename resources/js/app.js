import './bootstrap';
import './ToggleSidebar'
import './Times'
import './Modal'
import './Pagination'
import './DataTable'
import './DashboardPegawai'
import './Login'
import './CRUD'

// AOS Animation
import AOS from 'aos';
import 'aos/dist/aos.css';

AOS.init({
            duration: 800,
            once: true,
            easing: 'ease-out-quad',
        });



console.log('app.js loaded');
console.log('openModal:', typeof window.openModal);
console.log('tables found:', document.querySelectorAll('table.datatable').length);
